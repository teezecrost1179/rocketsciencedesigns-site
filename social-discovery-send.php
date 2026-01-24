<?php

$configPath = __DIR__ . "/social-discovery-send-config.php";
if (!file_exists($configPath)) {
  http_response_code(500);
  echo "Missing config.";
  exit;
}

$config = require $configPath;

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);
if (!is_array($data)) {
  http_response_code(400);
  echo "Invalid payload.";
  exit;
}

$honeypot = trim((string)($data["honeypot"] ?? ""));
if ($honeypot !== "") {
  http_response_code(204);
  exit;
}

$nowMs = (int)(microtime(true) * 1000);
$startedAt = (int)($data["startedAt"] ?? 0);
$minElapsed = (int)($config["min_elapsed_ms"] ?? 8000);
$elapsed = $nowMs - $startedAt;

if ($startedAt <= 0 || $elapsed < $minElapsed || $elapsed > 86400000) {
  http_response_code(204);
  exit;
}

$payload = $data;
unset($payload["honeypot"]);
$payload["receivedAt"] = gmdate("c");

$subject = "Social Discovery Results";
$textBody = "Social Discovery Results\n\n" . json_encode($payload, JSON_PRETTY_PRINT);

$postmarkPayload = [
  "From" => $config["from_email"] ?? "",
  "To" => $config["to_email"] ?? "",
  "Subject" => $subject,
  "TextBody" => $textBody,
];

if ($postmarkPayload["From"] === "" || $postmarkPayload["To"] === "") {
  http_response_code(500);
  echo "Missing email configuration.";
  exit;
}

$ch = curl_init("https://api.postmarkapp.com/email");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Accept: application/json",
  "Content-Type: application/json",
  "X-Postmark-Server-Token: " . ($config["postmark_token"] ?? ""),
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postmarkPayload));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($response === false || $status >= 400) {
  http_response_code(500);
  echo "Postmark error: " . $error;
  exit;
}

http_response_code(200);
echo "Sent.";
