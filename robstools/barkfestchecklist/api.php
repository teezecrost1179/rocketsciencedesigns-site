<?php
/* api.php — load & save the checklist JSON. */

require __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');
header('X-Robots-Tag: noindex, nofollow');
header('Cache-Control: no-store');

if (!pp_check_auth()) { pp_deny(true); }

$method = $_SERVER['REQUEST_METHOD'];

/* ---------- LOAD ---------- */
if ($method === 'GET') {
    if (!file_exists(DATA_FILE)) {
        echo json_encode(['error' => 'data.json is missing on the server.']);
        exit;
    }
    $raw = file_get_contents(DATA_FILE);
    $decoded = json_decode($raw, true);
    if ($decoded === null) {
        http_response_code(500);
        echo json_encode(['error' => 'data.json is not valid JSON.']);
        exit;
    }
    echo json_encode(['ok' => true, 'data' => $decoded]);
    exit;
}

/* ---------- SAVE ---------- */
if ($method === 'POST') {
    $body = file_get_contents('php://input');
    if (strlen($body) > 4 * 1024 * 1024) {
        http_response_code(413);
        echo json_encode(['error' => 'Payload too large.']);
        exit;
    }

    $incoming = json_decode($body, true);
    if (!is_array($incoming) || !isset($incoming['tasks']) || !is_array($incoming['tasks'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Malformed payload — refusing to overwrite good data.']);
        exit;
    }

    $pretty = json_encode($incoming, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($pretty === false) {
        http_response_code(400);
        echo json_encode(['error' => 'Could not encode payload.']);
        exit;
    }

    // Rolling backup of the previous good copy, then an atomic-ish write.
    if (file_exists(DATA_FILE)) {
        @copy(DATA_FILE, DATA_FILE . '.bak');
    }

    $fh = @fopen(DATA_FILE, 'c+');
    if (!$fh) {
        http_response_code(500);
        echo json_encode(['error' => 'Cannot open data.json for writing. Check file permissions (try 664).']);
        exit;
    }
    if (!flock($fh, LOCK_EX)) {
        fclose($fh);
        http_response_code(503);
        echo json_encode(['error' => 'File is locked, try again.']);
        exit;
    }
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, $pretty);
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);

    echo json_encode(['ok' => true, 'savedAt' => gmdate('c')]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Method not allowed']);
