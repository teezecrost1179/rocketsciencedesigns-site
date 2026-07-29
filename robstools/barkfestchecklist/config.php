<?php
/* ============================================================
   Paw Prints Calm K9 Corner — Checklist
   config.php  —  the only file you normally need to edit
   ============================================================ */

// --- MAGIC LINK TOKEN -------------------------------------------------
// Anyone with this token can view AND edit the checklist.
// Change it to anything you like (letters/numbers/dashes, 20+ chars).
// The share link is:  https://yourdomain.com/barkfest/?k=THE_TOKEN
define('MAGIC_TOKEN', 'barkfest-uPXs5t1tuPctjt71bC5AhJyd');

// --- WHERE THE DATA LIVES --------------------------------------------
// Default: data.json next to this file. Must be writable by PHP (644 or 664).
define('DATA_FILE', __DIR__ . '/data.json');

// --- HOW LONG THE BROWSER STAYS SIGNED IN ----------------------------
// After following the magic link once, a cookie keeps them in for this long.
define('COOKIE_DAYS', 120);

// --- PAGE TITLE -------------------------------------------------------
define('PAGE_TITLE', 'Paw Prints Calm K9 Corner — BarkFest Checklist');


/* ============================================================
   Nothing below here needs editing.
   ============================================================ */

function pp_check_auth() {
    $cookieName = 'pp_k9';
    $expected   = hash('sha256', MAGIC_TOKEN);

    // 1. Token in the URL (?k=...) — set cookie and remember them.
    if (isset($_GET['k']) && hash_equals(MAGIC_TOKEN, (string)$_GET['k'])) {
        $expires = time() + (COOKIE_DAYS * 86400);
        $path    = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/') . '/';
        $secure  = !empty($_SERVER['HTTPS']);
        if (PHP_VERSION_ID >= 70300) {
            setcookie($cookieName, $expected, [
                'expires'  => $expires,
                'path'     => $path,
                'httponly' => true,
                'samesite' => 'Lax',
                'secure'   => $secure,
            ]);
        } else {
            // Older PHP: no SameSite support in the signature.
            setcookie($cookieName, $expected, $expires, $path, '', $secure, true);
        }
        return true;
    }

    // 2. Token in a header (used by the save/load API calls).
    $hdr = $_SERVER['HTTP_X_PP_TOKEN'] ?? '';
    if ($hdr !== '' && hash_equals(MAGIC_TOKEN, (string)$hdr)) {
        return true;
    }

    // 3. Existing cookie.
    if (isset($_COOKIE[$cookieName]) && hash_equals($expected, (string)$_COOKIE[$cookieName])) {
        return true;
    }

    return false;
}

function pp_deny($json = false) {
    http_response_code(403);
    header('X-Robots-Tag: noindex, nofollow');
    if ($json) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Not authorised']);
    } else {
        header('Content-Type: text/html; charset=utf-8');
        echo '<!doctype html><meta name="viewport" content="width=device-width,initial-scale=1">'
           . '<title>Private</title>'
           . '<div style="font:16px/1.6 system-ui,sans-serif;max-width:32rem;margin:18vh auto;padding:0 1.5rem;'
           . 'text-align:center;color:#323338">'
           . '<div style="font-size:2.5rem">&#128062;</div>'
           . '<h1 style="font-size:1.25rem;margin:.5rem 0">This page is private</h1>'
           . '<p style="color:#676879">You need the shared link to view this checklist. '
           . 'Ask Rob or Leanne to send it to you again.</p></div>';
    }
    exit;
}
