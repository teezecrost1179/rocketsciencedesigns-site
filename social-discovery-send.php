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
$platformSentence = trim((string)($data["platformSentence"] ?? ""));
$userEmailRaw = trim((string)($data["userEmail"] ?? ""));
$userEmail = filter_var($userEmailRaw, FILTER_VALIDATE_EMAIL) ? $userEmailRaw : "";
$sections = $data["results"]["sections"] ?? [];

$categoryMeta = [
  "where_we_show_up" => "Where we show up (platforms, reach, discovery vs validation)",
  "what_we_focus_on" => "What we focus on (content pillars, themes, proof, education)",
  "how_this_should_feel" => "How this should feel (tone, trust, positioning, personality)",
  "what_social_is_meant_to_do" => "What social is meant to do (conversion path, role in funnel, cadence, success definition)",
];

$categoryBuckets = array_fill_keys(array_keys($categoryMeta), []);
foreach ($sections as $section) {
  $selectedOptions = $section["selectedOptions"] ?? [];
  foreach ($selectedOptions as $option) {
    $category = $option["category"] ?? "";
    $meaning = $option["meaning"] ?? "";
    if ($category && isset($categoryBuckets[$category]) && $meaning !== "") {
      $categoryBuckets[$category][] = $meaning;
    }
  }
}

$lines = [];
$lines[] = "Social Discovery Results";
$lines[] = "";
if ($platformSentence !== "") {
  $lines[] = "Platform Recommendations";
  $lines[] = $platformSentence;
  $lines[] = "";
}

$lines[] = "Categorized Meanings";
foreach ($categoryMeta as $key => $label) {
  $lines[] = "";
  $lines[] = $label;
  $meanings = $categoryBuckets[$key] ?? [];
  if (!$meanings) {
    $lines[] = "- No responses selected.";
  } else {
    foreach ($meanings as $meaning) {
      $lines[] = "- " . $meaning;
    }
  }
}

$lines[] = "";
$lines[] = "Raw Results (JSON)";
$lines[] = json_encode($payload, JSON_PRETTY_PRINT);
$textBody = implode("\n", $lines);

$toList = [];
$primaryTo = $config["to_email"] ?? "";
if ($primaryTo !== "") {
  $toList[] = $primaryTo;
}
if ($userEmail !== "") {
  $toList[] = $userEmail;
}
$toList = array_values(array_unique($toList));
$toField = implode(", ", $toList);

$postmarkPayload = [
  "From" => $config["from_email"] ?? "",
  "To" => $toField,
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
