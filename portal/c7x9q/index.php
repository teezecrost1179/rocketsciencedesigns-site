<?php
require dirname(__DIR__) . '/config.php';

$pubKey     = RSD_PUBLIC_KEY_B64;
$configured = ($pubKey !== 'REPLACE_WITH_YOUR_PUBLIC_KEY');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Secure File Submission</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .container {
            width: 100%;
            max-width: 520px;
        }

        .card {
            background: #1a1d27;
            border: 1px solid #2c2f3e;
            border-radius: 12px;
            padding: 2.5rem;
        }

        .lock-icon { font-size: 2rem; margin-bottom: 1rem; }

        h1 {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }

        .subtitle {
            font-size: 0.85rem;
            color: #8b8fa8;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .field { margin-bottom: 1.25rem; }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #a0a3b5;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.4rem;
        }

        input, textarea {
            width: 100%;
            background: #0f1117;
            border: 1px solid #2c2f3e;
            border-radius: 6px;
            color: #e8eaf0;
            font-family: inherit;
            font-size: 0.95rem;
            padding: 0.65rem 0.85rem;
            outline: none;
            transition: border-color 0.15s;
        }

        input:focus, textarea:focus { border-color: #5b6af0; }

        textarea {
            resize: vertical;
            min-height: 90px;
        }

        .pw-wrap { position: relative; display: flex; }
        .pw-wrap input { padding-right: 4.5rem; }

        .toggle-pw {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            padding: 0 0.85rem;
            background: none;
            border: none;
            color: #5b6af0;
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
        }

        .toggle-pw:hover { color: #7b8af8; }

        .honeypot { display: none !important; }

        .error {
            background: #3d1a1a;
            border: 1px solid #7a2a2a;
            color: #f08080;
            border-radius: 6px;
            padding: 0.65rem 0.85rem;
            font-size: 0.85rem;
            margin-bottom: 1.25rem;
        }

        .submit-btn {
            width: 100%;
            background: #5b6af0;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 700;
            padding: 0.85rem;
            cursor: pointer;
            transition: background 0.15s;
        }

        .submit-btn:hover:not(:disabled) { background: #4a59e0; }
        .submit-btn:disabled { opacity: 0.6; cursor: not-allowed; }

        .lock-badge {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.75rem;
            color: #5b8a5b;
            margin-top: 1rem;
            justify-content: center;
        }

        .success-card { text-align: center; }
        .success-icon { font-size: 3rem; margin-bottom: 1rem; }
        .success-card h2 { font-size: 1.4rem; font-weight: 700; color: #ffffff; margin-bottom: 0.75rem; }
        .success-card p { font-size: 0.9rem; color: #8b8fa8; line-height: 1.6; }

        .config-error {
            background: #2d1f00;
            border: 1px solid #6b4a00;
            border-radius: 8px;
            padding: 1.5rem;
            color: #f0c060;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .config-error code {
            background: #1a1200;
            border-radius: 3px;
            padding: 0.1em 0.4em;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">

        <?php if (!$configured): ?>
        <div class="config-error">
            <strong>Portal not configured.</strong><br><br>
            Run <code>node keygen.js</code> to generate your keypair, then paste the public key into <code>portal/config.php</code>.
        </div>

        <?php else: ?>

        <div id="form-view">
            <div class="lock-icon">🔐</div>
            <h1>Secure Credential Submission</h1>
            <p class="subtitle">Your information is encrypted in your browser before it leaves your device. Only the recipient can decrypt it — nothing is stored in plaintext.</p>

            <form id="cred-form" novalidate>
                <!-- Honeypot — bots fill this, humans don't -->
                <div class="honeypot" aria-hidden="true">
                    <input type="text" name="website" tabindex="-1" autocomplete="off">
                </div>

                <div class="field">
                    <label>Your Name</label>
                    <input type="text" name="clientName" placeholder="Jane Smith" autocomplete="off" spellcheck="false">
                </div>

                <div class="field">
                    <label>Site / Platform URL</label>
                    <input type="text" name="siteUrl" placeholder="https://example.com" autocomplete="off" spellcheck="false">
                </div>

                <div class="field">
                    <label>Username or Login Email</label>
                    <input type="text" name="username" placeholder="admin@example.com" autocomplete="off" spellcheck="false">
                </div>

                <div class="field">
                    <label>Password <span style="color:#f06060">*</span></label>
                    <div class="pw-wrap">
                        <input type="password" name="password" id="password" required autocomplete="new-password">
                        <button type="button" class="toggle-pw" id="togglePw">Show</button>
                    </div>
                </div>

                <div class="field">
                    <label>Notes</label>
                    <textarea name="notes" placeholder="Any other details — 2FA codes, hosting panel URL, FTP info, etc."></textarea>
                </div>

                <div id="error-msg" class="error" hidden></div>

                <button type="submit" class="submit-btn" id="submit-btn">
                    <span id="btn-text">Send Securely</span>
                    <span id="btn-spinner" hidden>Encrypting &amp; Sending…</span>
                </button>

                <div class="lock-badge">
                    <span>🔒</span>
                    <span>Encrypted in your browser via Web Crypto API — plaintext never leaves your device</span>
                </div>
            </form>
        </div>

        <div id="success-view" class="success-card" hidden>
            <div class="success-icon">✅</div>
            <h2>Received & Secured</h2>
            <p>Your credentials were encrypted locally and transmitted securely. You can safely close this page.</p>
            <button class="submit-btn" id="send-another-btn" style="margin-top:1.5rem">Send Another</button>
            <a href="https://rocketsciencedesigns.com" class="submit-btn" style="margin-top:0.75rem;display:block;text-decoration:none;text-align:center">Go To Rocket Science Site</a>
        </div>

        <?php endif; ?>
    </div>
</div>

<script>
(function () {
    'use strict';

    // RSA public key (SPKI, base64) — safe to expose, useless without the private key
    const RECIPIENT_PUBLIC_KEY_B64 = <?= json_encode($pubKey) ?>;

    const form           = document.getElementById('cred-form');
    const submitBtn      = document.getElementById('submit-btn');
    const btnText        = document.getElementById('btn-text');
    const btnSpinner     = document.getElementById('btn-spinner');
    const errorMsg       = document.getElementById('error-msg');
    const formView       = document.getElementById('form-view');
    const successView    = document.getElementById('success-view');
    const sendAnotherBtn = document.getElementById('send-another-btn');
    const togglePw       = document.getElementById('togglePw');
    const pwInput        = document.getElementById('password');
    const nameInput      = form ? form.querySelector('[name="clientName"]') : null;

    if (!form) return;

    let lastClientName = '';

    togglePw.addEventListener('click', function () {
        const isHidden = pwInput.type === 'password';
        pwInput.type = isHidden ? 'text' : 'password';
        togglePw.textContent = isHidden ? 'Hide' : 'Show';
    });

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        showError(null);

        // Honeypot check
        if (form.querySelector('[name="website"]').value !== '') return;

        const password = form.querySelector('[name="password"]').value.trim();
        if (!password) {
            showError('Password is required.');
            return;
        }

        setLoading(true);

        try {
            const data = {
                clientName: nameInput.value.trim(),
                siteUrl:    form.querySelector('[name="siteUrl"]').value.trim(),
                username:   form.querySelector('[name="username"]').value.trim(),
                password:   password,
                notes:      form.querySelector('[name="notes"]').value.trim(),
            };

            lastClientName = data.clientName;

            const encrypted = await encryptPayload(data, RECIPIENT_PUBLIC_KEY_B64);

            const res  = await fetch('/portal/submit.php', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body:    JSON.stringify(encrypted),
            });

            const json = await res.json();

            if (!res.ok || !json.ok) {
                throw new Error(json.error || 'Submission failed. Please try again.');
            }

            formView.hidden    = true;
            successView.hidden = false;

        } catch (err) {
            showError(err.message || 'An unexpected error occurred.');
            setLoading(false);
        }
    });

    async function encryptPayload(data, publicKeyB64) {
        // Import the RSA public key
        const spkiBuffer = Uint8Array.from(atob(publicKeyB64), c => c.charCodeAt(0));
        const rsaPublicKey = await crypto.subtle.importKey(
            'spki',
            spkiBuffer,
            { name: 'RSA-OAEP', hash: 'SHA-256' },
            false,
            ['encrypt']
        );

        // Generate a one-time AES-GCM key for the actual payload
        const aesKey = await crypto.subtle.generateKey(
            { name: 'AES-GCM', length: 256 },
            true,
            ['encrypt']
        );

        // Encrypt the payload with AES-GCM
        const iv      = crypto.getRandomValues(new Uint8Array(12));
        const message = new TextEncoder().encode(JSON.stringify(data));
        const ciphertext = await crypto.subtle.encrypt(
            { name: 'AES-GCM', iv },
            aesKey,
            message
        );

        // Wrap the AES key with RSA-OAEP
        const rawAesKey    = await crypto.subtle.exportKey('raw', aesKey);
        const encryptedKey = await crypto.subtle.encrypt(
            { name: 'RSA-OAEP' },
            rsaPublicKey,
            rawAesKey
        );

        const toB64 = buf => btoa(String.fromCharCode(...new Uint8Array(buf)));

        return {
            encryptedKey: toB64(encryptedKey),
            iv:           toB64(iv),
            ciphertext:   toB64(ciphertext),
        };
    }

    sendAnotherBtn.addEventListener('click', function () {
        // Reset form, pre-fill name, show form again
        form.reset();
        nameInput.value    = lastClientName;
        pwInput.type       = 'password';
        togglePw.textContent = 'Show';
        showError(null);
        setLoading(false);
        successView.hidden = true;
        formView.hidden    = false;
    });

    function setLoading(on) {
        submitBtn.disabled = on;
        btnText.hidden     = on;
        btnSpinner.hidden  = !on;
    }

    function showError(msg) {
        if (msg) {
            errorMsg.textContent = msg;
            errorMsg.hidden = false;
        } else {
            errorMsg.hidden = true;
        }
    }
})();
</script>
</body>
</html>
