<?php
require dirname(__DIR__) . '/config.php';

$dataFile    = RSD_DATA_FILE;
$submissions = [];

if (file_exists($dataFile)) {
    $content = file_get_contents($dataFile);
    if ($content) {
        $submissions = json_decode($content, true) ?: [];
    }
}

// Handle actions via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id     = $_POST['id']     ?? '';

    if ($id && in_array($action, ['mark_viewed', 'delete'], true)) {
        foreach ($submissions as $i => $s) {
            if ($s['id'] === $id) {
                if ($action === 'delete') {
                    array_splice($submissions, $i, 1);
                } else {
                    $submissions[$i]['viewed'] = true;
                }
                break;
            }
        }
        file_put_contents($dataFile, json_encode($submissions, JSON_PRETTY_PRINT), LOCK_EX);
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Newest first
$submissions = array_reverse($submissions);
$total    = count($submissions);
$unviewed = count(array_filter($submissions, function($s) { return !$s['viewed']; }));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Submissions — Secure Portal</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" href="/assets/rocket-favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Manrope', sans-serif;
            background: #0f1117;
            color: #e8eaf0;
            min-height: 100vh;
            padding: 2rem 1.5rem;
        }

        .page { max-width: 860px; margin: 0 auto; }

        /* Key prompt overlay */
        #key-overlay {
            position: fixed;
            inset: 0;
            background: #0f1117;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 2rem;
        }

        .key-card {
            background: #1a1d27;
            border: 1px solid #2c2f3e;
            border-radius: 12px;
            padding: 2.5rem;
            width: 100%;
            max-width: 520px;
        }

        .key-card .lock { font-size: 2rem; margin-bottom: 1rem; }

        .key-card h2 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .key-card p {
            font-size: 0.85rem;
            color: #8b8fa8;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }

        .key-input-wrap { position: relative; margin-bottom: 0.75rem; }

        textarea.key-input {
            width: 100%;
            background: #0f1117;
            border: 1px solid #2c2f3e;
            border-radius: 6px;
            color: #e8eaf0;
            font-family: 'Courier New', monospace;
            font-size: 0.78rem;
            padding: 0.75rem;
            outline: none;
            resize: none;
            height: 90px;
            transition: border-color 0.15s;
        }

        textarea.key-input:focus { border-color: #5b6af0; }

        .key-error {
            color: #f08080;
            font-size: 0.82rem;
            margin-bottom: 0.75rem;
            min-height: 1.2em;
        }

        .btn-primary {
            width: 100%;
            background: #5b6af0;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 700;
            padding: 0.8rem;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-primary:hover:not(:disabled) { background: #4a59e0; }
        .btn-primary:disabled { opacity: 0.6; cursor: not-allowed; }

        /* Main content */
        #main-content { display: none; }

        header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        header h1 { font-size: 1.3rem; font-weight: 700; color: #fff; }

        .badge {
            font-size: 0.75rem;
            font-weight: 700;
            background: #5b6af0;
            color: #fff;
            border-radius: 20px;
            padding: 0.2em 0.7em;
        }

        .badge.zero { background: #2c2f3e; color: #8b8fa8; }

        .forget-key {
            margin-left: auto;
            font-size: 0.78rem;
            color: #8b8fa8;
            background: none;
            border: 1px solid #2c2f3e;
            border-radius: 5px;
            padding: 0.3rem 0.7rem;
            cursor: pointer;
            font-family: inherit;
            transition: color 0.15s, border-color 0.15s;
        }

        .forget-key:hover { color: #f08080; border-color: #6a2828; }

        .empty {
            color: #8b8fa8;
            font-size: 0.9rem;
            padding: 3rem 0;
            text-align: center;
        }

        /* Submission cards */
        .submission {
            background: #1a1d27;
            border: 1px solid #2c2f3e;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.25rem;
            transition: opacity 0.2s;
        }

        .submission.viewed { opacity: 0.5; }

        .sub-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .sub-meta { font-size: 0.8rem; color: #8b8fa8; }
        .sub-meta strong { color: #c8cadb; }

        .new-dot {
            display: inline-block;
            width: 8px; height: 8px;
            background: #5b6af0;
            border-radius: 50%;
            margin-right: 0.4rem;
            vertical-align: middle;
        }

        .actions { display: flex; gap: 0.5rem; flex-wrap: wrap; }

        .btn {
            font-family: inherit;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 0.35rem 0.8rem;
            border-radius: 5px;
            border: 1px solid;
            cursor: pointer;
            transition: opacity 0.15s;
            background: transparent;
        }

        .btn:hover { opacity: 0.75; }
        .btn-viewed  { border-color: #3d4060; color: #8b8fa8; }
        .btn-delete  { border-color: #6a2828; color: #c07070; }

        /* Decrypted fields */
        .fields { display: grid; gap: 0.6rem; }

        .field-row {
            display: grid;
            grid-template-columns: 110px 1fr;
            gap: 0.5rem;
            align-items: start;
            font-size: 0.88rem;
        }

        .field-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: #8b8fa8;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding-top: 0.1rem;
        }

        .field-value { color: #e8eaf0; word-break: break-all; line-height: 1.4; }

        .pw-row { display: flex; align-items: center; gap: 0.5rem; }

        .pw-value { font-family: 'Courier New', monospace; letter-spacing: 0.05em; }

        .toggle-pw-btn {
            font-family: inherit;
            font-size: 0.72rem;
            font-weight: 600;
            color: #5b6af0;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            white-space: nowrap;
        }

        .toggle-pw-btn:hover { color: #7b8af8; }

        .decrypting {
            font-size: 0.85rem;
            color: #8b8fa8;
            font-style: italic;
        }

        .decrypt-error {
            font-size: 0.85rem;
            color: #f08080;
        }
    </style>
</head>
<body>

<!-- Private key prompt (shown if no key in localStorage) -->
<div id="key-overlay">
    <div class="key-card">
        <div class="lock">🔑</div>
        <h2>Enter Your Private Key</h2>
        <p>Paste your private key once and it will be saved in this browser. You won't be asked again.</p>
        <div class="key-input-wrap">
            <textarea class="key-input" id="key-input" placeholder="Paste your base64 private key here…" spellcheck="false" autocomplete="off"></textarea>
        </div>
        <div class="key-error" id="key-error"></div>
        <button class="btn-primary" id="unlock-btn">Unlock & Decrypt</button>
    </div>
</div>

<!-- Main submissions view -->
<div id="main-content">
    <div class="page">
        <header>
            <h1>🔐 Submissions</h1>
            <span class="badge <?= $unviewed === 0 ? 'zero' : '' ?>"><?= $unviewed ?> new</span>
            <span class="sub-meta" style="color:#8b8fa8"><?= $total ?> total</span>
            <button class="forget-key" id="forget-key-btn">Forget Key</button>
        </header>

        <?php if (empty($submissions)): ?>
            <div class="empty">No submissions yet.</div>
        <?php else: ?>
            <?php foreach ($submissions as $s): ?>
            <?php
                $payloadJson = json_encode($s['payload']);
                $ts = date('D M j, Y — g:ia', strtotime($s['timestamp']));
            ?>
            <div class="submission <?= $s['viewed'] ? 'viewed' : '' ?>">
                <div class="sub-header">
                    <div class="sub-meta">
                        <?php if (!$s['viewed']): ?>
                            <span class="new-dot"></span>
                        <?php endif; ?>
                        <strong><?= htmlspecialchars($ts) ?></strong>
                        &nbsp;·&nbsp; ID: <?= htmlspecialchars($s['id']) ?>
                    </div>
                    <div class="actions">
                        <?php if (!$s['viewed']): ?>
                        <form method="POST" style="display:inline">
                            <input type="hidden" name="action" value="mark_viewed">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($s['id']) ?>">
                            <button type="submit" class="btn btn-viewed">Mark Viewed</button>
                        </form>
                        <?php endif; ?>
                        <form method="POST" style="display:inline" onsubmit="return confirm('Delete this submission?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($s['id']) ?>">
                            <button type="submit" class="btn btn-delete">Delete</button>
                        </form>
                    </div>
                </div>

                <div class="fields" data-payload="<?= htmlspecialchars($payloadJson) ?>">
                    <span class="decrypting">Decrypting…</span>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
(function () {
    'use strict';

    const STORAGE_KEY = 'rsd_portal_pk';

    const overlay      = document.getElementById('key-overlay');
    const mainContent  = document.getElementById('main-content');
    const keyInput     = document.getElementById('key-input');
    const unlockBtn    = document.getElementById('unlock-btn');
    const keyError     = document.getElementById('key-error');
    const forgetKeyBtn = document.getElementById('forget-key-btn');

    let privateKey = null;

    // On load, check localStorage
    const stored = localStorage.getItem(STORAGE_KEY);
    if (stored) {
        importAndDecrypt(stored);
    } else {
        overlay.style.display = 'flex';
    }

    unlockBtn.addEventListener('click', async function () {
        const val = keyInput.value.trim();
        if (!val) { keyError.textContent = 'Please paste your private key.'; return; }
        keyError.textContent = '';
        unlockBtn.disabled = true;
        unlockBtn.textContent = 'Verifying…';

        const ok = await importAndDecrypt(val);
        if (ok) {
            localStorage.setItem(STORAGE_KEY, val);
        } else {
            unlockBtn.disabled = false;
            unlockBtn.textContent = 'Unlock & Decrypt';
        }
    });

    forgetKeyBtn.addEventListener('click', function () {
        localStorage.removeItem(STORAGE_KEY);
        location.reload();
    });

    async function importAndDecrypt(keyB64) {
        try {
            const keyBuffer = Uint8Array.from(atob(keyB64), c => c.charCodeAt(0));
            privateKey = await crypto.subtle.importKey(
                'pkcs8',
                keyBuffer,
                { name: 'RSA-OAEP', hash: 'SHA-256' },
                false,
                ['decrypt']
            );
        } catch (e) {
            keyError.textContent = 'Invalid key — make sure you pasted the private key, not the public key.';
            return false;
        }

        overlay.style.display  = 'none';
        mainContent.style.display = 'block';

        // Decrypt all submissions
        const cards = document.querySelectorAll('.fields[data-payload]');
        for (const card of cards) {
            try {
                const payload = JSON.parse(card.dataset.payload);
                const data    = await decryptPayload(payload);
                renderFields(card, data);
            } catch (e) {
                card.innerHTML = '<span class="decrypt-error">Could not decrypt — key may not match.</span>';
            }
        }

        return true;
    }

    async function decryptPayload(payload) {
        const fromB64 = b64 => Uint8Array.from(atob(b64), c => c.charCodeAt(0));

        // Decrypt the wrapped AES key
        const rawAesKey = await crypto.subtle.decrypt(
            { name: 'RSA-OAEP' },
            privateKey,
            fromB64(payload.encryptedKey)
        );

        // Import AES key
        const aesKey = await crypto.subtle.importKey(
            'raw', rawAesKey, { name: 'AES-GCM' }, false, ['decrypt']
        );

        // Decrypt payload
        const decrypted = await crypto.subtle.decrypt(
            { name: 'AES-GCM', iv: fromB64(payload.iv) },
            aesKey,
            fromB64(payload.ciphertext)
        );

        return JSON.parse(new TextDecoder().decode(decrypted));
    }

    function renderFields(container, data) {
        const fields = [
            { key: 'clientName', label: 'Client'   },
            { key: 'siteUrl',    label: 'Site URL'  },
            { key: 'username',   label: 'Username'  },
            { key: 'password',   label: 'Password', password: true },
            { key: 'notes',      label: 'Notes'     },
        ];

        const rows = fields
            .filter(f => data[f.key])
            .map(f => {
                const val = escHtml(data[f.key]);
                let valueHtml;

                if (f.password) {
                    const masked = '•'.repeat(Math.min(data[f.key].length, 20));
                    valueHtml = `
                        <span class="pw-row">
                            <span class="pw-value field-value" data-plain="${val}" data-masked="${masked}" data-hidden="true">${masked}</span>
                            <button type="button" class="toggle-pw-btn">Show</button>
                        </span>`;
                } else {
                    valueHtml = `<span class="field-value">${val}</span>`;
                }

                return `<div class="field-row">
                    <span class="field-label">${f.label}</span>
                    ${valueHtml}
                </div>`;
            })
            .join('');

        container.innerHTML = rows || '<span class="decrypt-error">No fields found.</span>';

        // Wire up show/hide toggles
        container.querySelectorAll('.toggle-pw-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const span  = btn.previousElementSibling;
                const hidden = span.dataset.hidden === 'true';
                span.textContent  = hidden ? span.dataset.plain : span.dataset.masked;
                span.dataset.hidden = hidden ? 'false' : 'true';
                btn.textContent   = hidden ? 'Hide' : 'Show';
            });
        });
    }

    function escHtml(str) {
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
})();
</script>
</body>
</html>
