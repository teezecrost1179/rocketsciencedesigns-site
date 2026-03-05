<?php
$bypassUntil = strtotime('2026-03-07 00:00:00 UTC');
if (time() >= $bypassUntil && ($_SERVER['REMOTE_ADDR'] ?? '') !== '24.78.157.169') {
    http_response_code(403);
    exit('Forbidden');
}
$config = require __DIR__ . '/../bulk-send-config.php';
$fromAddresses = $config['from_addresses'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bulk Email — Rocket Science Designs</title>
  <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      background: #1a1a1a;
      color: #e0e0e0;
      min-height: 100vh;
      padding: 48px 20px;
    }

    .container {
      max-width: 780px;
      margin: 0 auto;
    }

    h1 {
      font-size: 1.4rem;
      font-weight: 600;
      color: #fff;
      margin-bottom: 36px;
      padding-bottom: 16px;
      border-bottom: 1px solid #2e2e2e;
    }

    .field {
      margin-bottom: 28px;
    }

    label {
      display: block;
      font-size: 0.78rem;
      font-weight: 600;
      color: #888;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      margin-bottom: 8px;
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      background: #242424;
      border: 1px solid #333;
      border-radius: 6px;
      color: #e0e0e0;
      font-size: 1rem;
      padding: 12px 14px;
      outline: none;
      font-family: inherit;
      transition: border-color 0.15s;
    }

    input[type="text"]:focus,
    textarea:focus {
      border-color: #555;
    }

    textarea {
      resize: vertical;
      min-height: 90px;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    .hint {
      font-size: 0.78rem;
      color: #555;
      margin-top: 6px;
    }

    /* Quill dark theme overrides */
    .ql-toolbar.ql-snow {
      background: #242424;
      border: 1px solid #333;
      border-radius: 6px 6px 0 0;
    }

    .ql-container.ql-snow {
      background: #242424;
      border: 1px solid #333;
      border-top: none;
      border-radius: 0 0 6px 6px;
      font-size: 1rem;
    }

    .ql-editor {
      min-height: 240px;
      color: #e0e0e0;
      line-height: 1.7;
    }

    .ql-editor.ql-blank::before {
      color: #444;
    }

    .ql-snow .ql-stroke { stroke: #888; }
    .ql-snow .ql-fill { fill: #888; }
    .ql-snow .ql-picker { color: #888; }
    .ql-snow .ql-picker-options { background: #2a2a2a; border-color: #444; }
    .ql-snow .ql-picker-label:hover,
    .ql-snow .ql-picker-item:hover { color: #fff; }
    .ql-snow .ql-toolbar button:hover .ql-stroke,
    .ql-snow .ql-toolbar button.ql-active .ql-stroke { stroke: #fff; }
    .ql-snow .ql-toolbar button:hover .ql-fill,
    .ql-snow .ql-toolbar button.ql-active .ql-fill { fill: #fff; }
    .ql-snow .ql-color-picker .ql-picker-label svg,
    .ql-snow .ql-icon-picker .ql-picker-label svg { right: 4px; }

    /* Buttons */
    .btn {
      display: inline-block;
      padding: 12px 28px;
      border-radius: 6px;
      font-size: 0.95rem;
      font-weight: 600;
      cursor: pointer;
      border: none;
      font-family: inherit;
      transition: background 0.15s, color 0.15s;
    }

    .btn-primary {
      background: #e8451e;
      color: #fff;
    }

    .btn-primary:hover:not(:disabled) { background: #c93a18; }
    .btn-primary:disabled { background: #444; color: #666; cursor: not-allowed; }

    .btn-ghost {
      background: transparent;
      color: #aaa;
      border: 1px solid #3a3a3a;
    }

    .btn-ghost:hover:not(:disabled) { background: #2a2a2a; color: #fff; border-color: #555; }

    /* Modal */
    .modal-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.75);
      z-index: 100;
      align-items: center;
      justify-content: center;
    }

    .modal-overlay.active { display: flex; }

    .modal {
      background: #222;
      border: 1px solid #363636;
      border-radius: 10px;
      padding: 32px;
      max-width: 540px;
      width: 92%;
      max-height: 80vh;
      overflow-y: auto;
    }

    .modal h2 {
      font-size: 1.15rem;
      color: #fff;
      margin-bottom: 10px;
    }

    .modal-desc {
      color: #888;
      font-size: 0.9rem;
      margin-bottom: 16px;
    }

    .email-preview {
      background: #181818;
      border: 1px solid #2e2e2e;
      border-radius: 6px;
      padding: 12px 14px;
      font-size: 0.83rem;
      color: #bbb;
      max-height: 200px;
      overflow-y: auto;
      margin-bottom: 24px;
      line-height: 1.8;
      white-space: pre;
      font-family: 'Courier New', monospace;
    }

    .modal-actions {
      display: flex;
      gap: 12px;
    }

    /* Result banner */
    #result {
      margin-top: 28px;
      padding: 16px 20px;
      border-radius: 6px;
      display: none;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    #result.sending {
      background: #1a1c2e;
      border: 1px solid #2e3260;
      color: #9090d8;
    }

    #result.success {
      background: #152315;
      border: 1px solid #2a4f2a;
      color: #7dc47d;
    }

    #result.error {
      background: #2e1515;
      border: 1px solid #5a2828;
      color: #cc7878;
    }

    #result ul {
      margin-top: 8px;
      padding-left: 20px;
    }

    /* Attachments */
    .file-btn {
      display: inline-block;
      padding: 10px 18px;
      background: #242424;
      border: 1px dashed #444;
      border-radius: 6px;
      color: #888;
      font-size: 0.88rem;
      cursor: pointer;
      transition: border-color 0.15s, color 0.15s;
    }

    .file-btn:hover { border-color: #666; color: #ccc; }

    #attachments { display: none; }

    .attachment-list {
      margin-top: 10px;
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }

    .attachment-chip {
      background: #2a2a2a;
      border: 1px solid #3a3a3a;
      border-radius: 4px;
      padding: 5px 10px;
      font-size: 0.8rem;
      color: #ccc;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .attachment-chip .remove {
      background: none;
      border: none;
      color: #555;
      cursor: pointer;
      font-size: 1.1rem;
      line-height: 1;
      padding: 0;
      font-family: inherit;
    }

    .attachment-chip .remove:hover { color: #cc7878; }

    #modal-attachments {
      color: #777;
      font-size: 0.82rem;
      margin-bottom: 16px;
      font-style: italic;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Bulk Email Sender</h1>

    <div class="field">
      <label for="from-email">From Address</label>
      <select id="from-email">
        <?php foreach ($fromAddresses as $addr): ?>
          <option value="<?= htmlspecialchars($addr, ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($addr, ENT_QUOTES, 'UTF-8') ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="field">
      <label for="from-name">Sender Name <span style="color:#555;font-weight:400;text-transform:none;letter-spacing:0">(optional)</span></label>
      <input type="text" id="from-name" value="" placeholder="Leave blank to send without a display name">
    </div>

    <div class="field">
      <label for="subject">Subject Line</label>
      <input type="text" id="subject" placeholder="Enter email subject…">
    </div>

    <div class="field">
      <label for="recipients">Recipients</label>
      <textarea id="recipients" placeholder="email@example.com, another@example.com, …"></textarea>
      <p class="hint">Comma-separated. Up to 50 addresses. Invalid addresses are skipped.</p>
    </div>

    <div class="field">
      <label>Message</label>
      <div id="editor"></div>
    </div>

    <div class="field">
      <label>Attachments <span style="color:#555;font-weight:400;text-transform:none;letter-spacing:0">(optional)</span></label>
      <label class="file-btn" for="attachments">+ Add files</label>
      <input type="file" id="attachments" multiple>
      <div class="attachment-list" id="attachment-list"></div>
      <p class="hint">Max 10 MB per file. Attached to every email sent.</p>
    </div>

    <button class="btn btn-primary" id="submit-btn">Review &amp; Send</button>

    <div id="result"></div>
  </div>

  <!-- Confirmation modal -->
  <div class="modal-overlay" id="modal-overlay">
    <div class="modal">
      <h2>Confirm Send</h2>
      <p class="modal-desc" id="modal-desc"></p>
      <div class="email-preview" id="modal-email-list"></div>
      <p id="modal-attachments"></p>
      <div class="modal-actions">
        <button class="btn btn-primary" id="confirm-btn">Yes, Send</button>
        <button class="btn btn-ghost" id="cancel-btn">Cancel</button>
      </div>
    </div>
  </div>

  <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
  <script>
    const quill = new Quill('#editor', {
      theme: 'snow',
      placeholder: 'Compose your email…',
      modules: {
        toolbar: [
          [{ header: [1, 2, 3, false] }],
          ['bold', 'italic', 'underline'],
          [{ color: [] }],
          [{ list: 'ordered' }, { list: 'bullet' }],
          ['link'],
          ['clean'],
        ]
      }
    });

    function parseEmails(raw) {
      const seen = new Set();
      return raw
        .split(/[\s,]+/)
        .map(e => e.trim().toLowerCase())
        .filter(e => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(e))
        .filter(e => { if (seen.has(e)) return false; seen.add(e); return true; });
    }

    // --- Attachment management ---
    let _attachmentFiles = [];

    function renderAttachmentList() {
      const list = document.getElementById('attachment-list');
      list.innerHTML = '';
      _attachmentFiles.forEach((file, i) => {
        const chip = document.createElement('div');
        chip.className = 'attachment-chip';
        chip.innerHTML =
          `<span>${file.name} <span style="color:#555">(${(file.size / 1024).toFixed(0)} KB)</span></span>` +
          `<button class="remove" type="button" data-index="${i}" title="Remove">&times;</button>`;
        list.appendChild(chip);
      });
    }

    document.getElementById('attachments').addEventListener('change', function () {
      Array.from(this.files).forEach(f => {
        if (!_attachmentFiles.find(x => x.name === f.name && x.size === f.size)) {
          _attachmentFiles.push(f);
        }
      });
      this.value = ''; // reset so same file can be re-added after removal
      renderAttachmentList();
    });

    document.getElementById('attachment-list').addEventListener('click', function (e) {
      const btn = e.target.closest('.remove');
      if (!btn) return;
      _attachmentFiles.splice(parseInt(btn.dataset.index, 10), 1);
      renderAttachmentList();
    });

    function readFileAsBase64(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload  = () => resolve({
          name:        file.name,
          content:     reader.result.split(',')[1], // strip data:...;base64, prefix
          contentType: file.type || 'application/octet-stream',
        });
        reader.onerror = reject;
        reader.readAsDataURL(file);
      });
    }

    // --- Form ---
    const overlay    = document.getElementById('modal-overlay');
    const submitBtn  = document.getElementById('submit-btn');
    const confirmBtn = document.getElementById('confirm-btn');
    const cancelBtn  = document.getElementById('cancel-btn');
    const resultEl   = document.getElementById('result');

    submitBtn.addEventListener('click', function () {
      const fromEmail = document.getElementById('from-email').value;
      const fromName  = document.getElementById('from-name').value.trim();
      const subject   = document.getElementById('subject').value.trim();
      const rawRecipients = document.getElementById('recipients').value;
      const html = quill.root.innerHTML;
      const text = quill.getText().trim();

      if (!subject)            { alert('Please enter a subject line.'); return; }
      if (!rawRecipients.trim()) { alert('Please enter at least one recipient.'); return; }
      if (!text)               { alert('Please enter a message.'); return; }

      const emails = parseEmails(rawRecipients);
      if (emails.length === 0) { alert('No valid email addresses found.'); return; }
      if (emails.length > 50)  { alert('Maximum 50 recipients allowed.'); return; }

      const oversized = _attachmentFiles.filter(f => f.size > 10 * 1024 * 1024);
      if (oversized.length > 0) {
        alert('These files exceed the 10 MB limit:\n' + oversized.map(f => f.name).join('\n'));
        return;
      }

      Promise.all(_attachmentFiles.map(readFileAsBase64)).then(attachments => {
        document.getElementById('modal-desc').textContent =
          `Send ${emails.length} individual email${emails.length !== 1 ? 's' : ''} to:`;
        document.getElementById('modal-email-list').textContent = emails.join('\n');

        const attNote = document.getElementById('modal-attachments');
        if (attachments.length > 0) {
          attNote.textContent =
            `Attachments: ${attachments.map(a => a.name).join(', ')}`;
        } else {
          attNote.textContent = '';
        }

        overlay.classList.add('active');
        window._pendingSend = { fromEmail, fromName, subject, html, emails, attachments };
      });
    });

    cancelBtn.addEventListener('click', () => overlay.classList.remove('active'));

    overlay.addEventListener('click', function (e) {
      if (e.target === this) this.classList.remove('active');
    });

    confirmBtn.addEventListener('click', function () {
      overlay.classList.remove('active');
      doSend(window._pendingSend);
    });

    function doSend(data) {
      submitBtn.disabled = true;
      confirmBtn.disabled = true;

      resultEl.className = 'sending';
      resultEl.style.display = 'block';
      resultEl.innerHTML = 'Sending&hellip; please wait.';

      fetch('bulk-send-handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data),
      })
        .then(r => {
          if (r.status === 413) throw new Error('Attachment too large — the server rejected the request. Contact your host to increase the upload limit.');
          const ct = r.headers.get('content-type') || '';
          if (!ct.includes('application/json')) {
            return r.text().then(function(t) {
              throw new Error('Unexpected server response (HTTP ' + r.status + '). Check server error logs.');
            });
          }
          return r.json();
        })
        .then(res => {
          submitBtn.disabled = false;
          confirmBtn.disabled = false;

          if (res.error) {
            resultEl.className = 'error';
            resultEl.innerHTML = '<strong>Error:</strong> ' + res.error;
            return;
          }

          const allOk = res.failed === 0;
          resultEl.className = allOk ? 'success' : 'error';
          let out = `<strong>Done.</strong> Sent: ${res.sent}` +
                    (res.failed > 0 ? `, Failed: ${res.failed}` : '') + '.';

          if (res.errors && res.errors.length) {
            out += '<ul>' + res.errors.map(e => `<li>${e}</li>`).join('') + '</ul>';
          }
          if (allOk) {
            out += '<br>A confirmation has been sent to support@rocketreception.ca.';
          }
          resultEl.innerHTML = out;
        })
        .catch(err => {
          submitBtn.disabled = false;
          confirmBtn.disabled = false;
          resultEl.className = 'error';
          resultEl.innerHTML = '<strong>Network error:</strong> ' + err.message;
        });
    }
  </script>
</body>
</html>
