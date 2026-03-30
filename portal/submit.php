<?php
require __DIR__ . '/config.php';
$mailConfig = require dirname(__DIR__) . '/../email-config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$raw     = file_get_contents('php://input');
$payload = json_decode($raw, true);

if (!$payload || !isset($payload['encryptedKey'], $payload['iv'], $payload['ciphertext'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid payload']);
    exit;
}

// Validate all three fields are base64
foreach (['encryptedKey', 'iv', 'ciphertext'] as $field) {
    if (!is_string($payload[$field]) || !preg_match('/^[A-Za-z0-9+\/=]+$/', $payload[$field])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid payload format']);
        exit;
    }
}

$submission = [
    'id'        => bin2hex(random_bytes(8)),
    'timestamp' => date('c'),
    'viewed'    => false,
    'payload'   => [
        'encryptedKey' => $payload['encryptedKey'],
        'iv'           => $payload['iv'],
        'ciphertext'   => $payload['ciphertext'],
    ],
];

// Write to flat JSON file with locking
$dataFile = RSD_DATA_FILE;
$dir      = dirname($dataFile);

if (!is_dir($dir)) {
    mkdir($dir, 0750, true);
}

$fp = fopen($dataFile, 'c+');
if (!$fp) {
    http_response_code(500);
    echo json_encode(['error' => 'Storage unavailable']);
    exit;
}

flock($fp, LOCK_EX);
$content     = stream_get_contents($fp);
$submissions = ($content !== '' && $content !== false) ? json_decode($content, true) : [];
if (!is_array($submissions)) {
    $submissions = [];
}

$submissions[] = $submission;

ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($submissions, JSON_PRETTY_PRINT));
flock($fp, LOCK_UN);
fclose($fp);

// Send notification
$ch = curl_init('https://api.postmarkapp.com/email');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_HTTPHEADER     => [
        'Accept: application/json',
        'Content-Type: application/json',
        'X-Postmark-Server-Token: ' . ($mailConfig['postmark_token'] ?? ''),
    ],
    CURLOPT_POSTFIELDS => json_encode([
        'From'     => 'Rocket Science Designs <hello@rocketsciencedesigns.com>',
        'To'       => 'hello@rocketsciencedesigns.com',
        'Subject'  => 'A client sent secure info from the portal',
        'TextBody' => "A new encrypted credential submission was received via the secure portal.\n\nView it at: https://rocketsciencedesigns.com/portal/viewer/",
    ]),
]);
curl_exec($ch);
curl_close($ch);

echo json_encode(['ok' => true]);
