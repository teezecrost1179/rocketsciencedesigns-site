<?php
ini_set('display_errors', 0);

if (($_SERVER['REMOTE_ADDR'] ?? '') !== '24.78.157.169') {
    http_response_code(403);
    exit;
}

header('Content-Type: application/json');

$configPath = __DIR__ . '/../bulk-send-config.php';
if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode(['error' => 'Missing config.']);
    exit;
}
$config = require $configPath;

$raw = file_get_contents('php://input');

// If post_max_size was exceeded, PHP empties php://input silently
if ($raw === '' && (int)($_SERVER['CONTENT_LENGTH'] ?? 0) > 0) {
    http_response_code(413);
    echo json_encode(['error' => 'Payload too large — reduce attachment file size or check server post_max_size.']);
    exit;
}

$data = json_decode($raw, true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid payload.']);
    exit;
}

$fromEmail   = trim((string)($data['fromEmail'] ?? ''));
$fromName    = trim((string)($data['fromName'] ?? ''));
$subject     = trim((string)($data['subject'] ?? ''));
$html        = (string)($data['html'] ?? '');
$emails      = $data['emails'] ?? [];
$attachments = $data['attachments'] ?? [];

if ($fromEmail === '' || $subject === '' || $html === '' || !is_array($emails) || empty($emails)) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields.']);
    exit;
}

// Validate fromEmail against server-side whitelist
$allowedFromAddresses = $config['from_addresses'] ?? [];
if (!in_array($fromEmail, $allowedFromAddresses, true)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid from address.']);
    exit;
}

// Re-validate and deduplicate recipients server-side
$validEmails = array_values(array_unique(
    array_filter(
        array_map('trim', $emails),
        function($e) { return (bool) filter_var($e, FILTER_VALIDATE_EMAIL); }
    )
));

if (count($validEmails) === 0) {
    http_response_code(400);
    echo json_encode(['error' => 'No valid recipient addresses.']);
    exit;
}

if (count($validEmails) > 50) {
    http_response_code(400);
    echo json_encode(['error' => 'Too many recipients (max 50).']);
    exit;
}

// Validate and sanitize attachments
$validAttachments = [];
if (is_array($attachments)) {
    foreach ($attachments as $att) {
        $name        = basename(trim((string)($att['name'] ?? '')));
        $content     = (string)($att['content'] ?? '');
        $contentType = trim((string)($att['contentType'] ?? 'application/octet-stream'));
        if ($name === '' || $content === '') continue;
        // Verify it's valid base64 and within 10 MB decoded
        $decoded = base64_decode($content, true);
        if ($decoded === false || strlen($decoded) > 10 * 1024 * 1024) continue;
        $validAttachments[] = [
            'Name'        => $name,
            'Content'     => $content,
            'ContentType' => $contentType,
        ];
    }
}

$token   = $config['postmark_token'] ?? '';
$confirm = $config['confirm_email'] ?? $fromEmail;

if ($token === '') {
    http_response_code(500);
    echo json_encode(['error' => 'Missing Postmark configuration.']);
    exit;
}

$fromFormatted = $fromName !== '' ? "\"{$fromName}\" <{$fromEmail}>" : $fromEmail;
$textBody      = trim(strip_tags(html_entity_decode($html)));

function postmark_send(string $token, array $payload): array
{
    $ch = curl_init('https://api.postmarkapp.com/email');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/json',
        'X-Postmark-Server-Token: ' . $token,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $status   = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErr  = curl_error($ch);
    curl_close($ch);
    return ['status' => $status, 'response' => $response, 'curl_error' => $curlErr];
}

$sent   = 0;
$failed = 0;
$errors = [];

foreach ($validEmails as $email) {
    $payload = [
        'From'     => $fromFormatted,
        'ReplyTo'  => $fromFormatted,
        'To'       => $email,
        'Subject'  => $subject,
        'HtmlBody' => $html,
        'TextBody' => $textBody,
    ];
    if (!empty($validAttachments)) {
        $payload['Attachments'] = $validAttachments;
    }
    $result = postmark_send($token, $payload);

    if ($result['status'] >= 200 && $result['status'] < 300) {
        $sent++;
    } else {
        $failed++;
        $detail = $result['curl_error'] ?: "HTTP {$result['status']}";
        $errors[] = "Failed to send to {$email} ({$detail})";
    }
}

// Confirmation email
$recipientList   = implode("\n", $validEmails);
$attachmentNames = array_map(function($a) { return $a['Name']; }, $validAttachments);
$attachmentLine  = !empty($attachmentNames)
    ? '<p><strong>Attachments:</strong> ' . htmlspecialchars(implode(', ', $attachmentNames), ENT_QUOTES, 'UTF-8') . '</p>'
    : '';
$attachmentText  = !empty($attachmentNames)
    ? "Attachments: " . implode(', ', $attachmentNames) . "\n\n"
    : '';

$confirmHtml =
    '<p><strong>Sent from:</strong> ' . htmlspecialchars($fromFormatted, ENT_QUOTES, 'UTF-8') . '</p>' .
    '<p><strong>The following message was sent to:</strong></p>' .
    '<ul>' . implode('', array_map(function($e) { return "<li>{$e}</li>"; }, $validEmails)) . '</ul>' .
    $attachmentLine .
    '<hr style="margin:20px 0; border:none; border-top:1px solid #ddd">' .
    '<p><strong>Subject:</strong> ' . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . '</p>' .
    '<br>' . $html;

$confirmText =
    "Sent from: {$fromFormatted}\n\n" .
    "The following message was sent to:\n{$recipientList}\n\n" .
    $attachmentText .
    "Subject: {$subject}\n\n{$textBody}";

postmark_send($token, [
    'From'     => $fromEmail,
    'To'       => $confirm,
    'Subject'  => "Bulk Send Confirmation: {$subject}",
    'HtmlBody' => $confirmHtml,
    'TextBody' => $confirmText,
]);

echo json_encode(['sent' => $sent, 'failed' => $failed, 'errors' => $errors]);
