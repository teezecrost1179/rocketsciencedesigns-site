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

$fromEmail = trim((string)($data['fromEmail'] ?? ''));
$fromName  = trim((string)($data['fromName'] ?? ''));
$subject   = trim((string)($data['subject'] ?? ''));
$html      = (string)($data['html'] ?? '');
$emails    = $data['emails'] ?? [];

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

// Confirmation email
$recipientList = implode("\n", $validEmails);
$confirmHtml   =
    '<p><strong>Sent from:</strong> ' . htmlspecialchars($fromFormatted, ENT_QUOTES, 'UTF-8') . '</p>' .
    '<p><strong>The following message was sent to:</strong></p>' .
    '<ul>' . implode('', array_map(fn($e) => "<li>{$e}</li>", $validEmails)) . '</ul>' .
    '<hr style="margin:20px 0; border:none; border-top:1px solid #ddd">' .
    '<p><strong>Subject:</strong> ' . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . '</p>' .
    '<br>' . $html;

$confirmText =
    "Sent from: {$fromFormatted}\n\n" .
    "The following message was sent to:\n{$recipientList}\n\n" .
    "Subject: {$subject}\n\n{$textBody}";

postmark_send($token, [
    'From'     => $fromEmail,
    'To'       => $confirm,
    'Subject'  => "Bulk Send Confirmation: {$subject}",
    'HtmlBody' => $confirmHtml,
    'TextBody' => $confirmText,
]);

echo json_encode(['sent' => $sent, 'failed' => $failed, 'errors' => $errors]);
