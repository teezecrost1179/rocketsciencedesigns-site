<?php
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

$raw  = file_get_contents('php://input');
$data = json_decode($raw, true);
if (!is_array($data)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid payload.']);
    exit;
}

$fromName = trim((string)($data['fromName'] ?? ''));
$subject  = trim((string)($data['subject'] ?? ''));
$html     = (string)($data['html'] ?? '');
$emails   = $data['emails'] ?? [];

if ($subject === '' || $html === '' || !is_array($emails) || empty($emails)) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields.']);
    exit;
}

// Re-validate and deduplicate server-side
$validEmails = array_values(array_unique(
    array_filter(
        array_map('trim', $emails),
        fn($e) => (bool) filter_var($e, FILTER_VALIDATE_EMAIL)
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

$token   = $config['postmark_token'] ?? '';
$from    = $config['from_email'] ?? '';
$confirm = $config['confirm_email'] ?? $from;

// Use payload fromName, fall back to config default, fall back to bare address
$resolvedName = $fromName !== '' ? $fromName : ($config['from_name'] ?? '');
$fromFormatted = $resolvedName !== '' ? "\"{$resolvedName}\" <{$from}>" : $from;

if ($token === '' || $from === '') {
    http_response_code(500);
    echo json_encode(['error' => 'Missing Postmark configuration.']);
    exit;
}

$textBody = trim(strip_tags(html_entity_decode($html)));

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
    $result = postmark_send($token, [
        'From'     => $fromFormatted,
        'ReplyTo'  => $fromFormatted,
        'To'       => $email,
        'Subject'  => $subject,
        'HtmlBody' => $html,
        'TextBody' => $textBody,
    ]);

    if ($result['status'] >= 200 && $result['status'] < 300) {
        $sent++;
    } else {
        $failed++;
        $detail = $result['curl_error'] ?: "HTTP {$result['status']}";
        $errors[] = "Failed to send to {$email} ({$detail})";
    }
}

// Confirmation email to support@rocketreception.ca
$recipientList = implode("\n", $validEmails);
$confirmHtml   =
    '<p><strong>The following message was sent to:</strong></p>' .
    '<ul>' . implode('', array_map(fn($e) => "<li>{$e}</li>", $validEmails)) . '</ul>' .
    '<hr style="margin:20px 0; border:none; border-top:1px solid #ddd">' .
    '<p><strong>Subject:</strong> ' . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . '</p>' .
    '<br>' . $html;

$confirmText =
    "The following message was sent to:\n{$recipientList}\n\n" .
    "Subject: {$subject}\n\n{$textBody}";

postmark_send($token, [
    'From'     => $from,
    'To'       => $confirm,
    'Subject'  => "Bulk Send Confirmation: {$subject}",
    'HtmlBody' => $confirmHtml,
    'TextBody' => $confirmText,
]);

echo json_encode(['sent' => $sent, 'failed' => $failed, 'errors' => $errors]);
