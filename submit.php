<?php
// Settings
$to = "hello@rocketsciencedesigns.com";
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

// Set headers
$headers = "From: Rocket Science Designs <no-reply@rocketsciencedesigns.com>\r\n";
$headers .= "Reply-To: $email\r\n";

// Send it
if (mail($to, $subject, $body, $headers)) {
  http_response_code(200);
  echo "Thanks! I'll get back to you shortly.";
} else {
  http_response_code(500);
  echo "Something went wrong. Please email me directly.";
}
?>
