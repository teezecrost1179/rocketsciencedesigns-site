<?php
$config  = require __DIR__ . '/../email-config.php';
$token   = $config['postmark_token'] ?? '';
$subject = "New Project Inquiry via Website";

// Sanitize & validate fields
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) : '';
$topic = isset($_POST['topic']) ? strip_tags(trim($_POST['topic'])) : '';
$timeframe = isset($_POST['timeframe']) ? strip_tags(trim($_POST['timeframe'])) : '';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

// Check required fields
if (!$name || !$email || !$topic || !$timeframe || !$message) {
  http_response_code(400);
  echo "Please complete all fields.";
  exit;
}

// Build email body
$body = "You received a new message from your website contact form:\n\n";
$body .= "Name: $name\n";
$body .= "Email: $email\n";
$body .= "What they need: $topic\n";
$body .= "Timeframe: $timeframe\n";
$body .= "Message:\n$message\n";

$ch = curl_init('https://api.postmarkapp.com/email');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => [
        'Accept: application/json',
        'Content-Type: application/json',
        'X-Postmark-Server-Token: ' . $token,
    ],
    CURLOPT_POSTFIELDS => json_encode([
        'From'     => 'Rocket Science Designs <hello@rocketsciencedesigns.com>',
        'To'       => 'hello@rocketsciencedesigns.com',
        'ReplyTo'  => $email,
        'Subject'  => $subject,
        'TextBody' => $body,
    ]),
]);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_exec($ch);
curl_close($ch);

if ($status === 200) {
    http_response_code(200);
    echo "Thanks! I'll get back to you shortly.";
} else {
    http_response_code(500);
    echo "Something went wrong. Please email me directly.";
}
?>
