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
$total   = count($submissions);
$unviewed = count(array_filter($submissions, fn($s) => !$s['viewed']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Submissions — Secure Portal</title>
    <meta name="robots" content="noindex, nofollow">
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

        header {
            max-width: 860px;
            margin: 0 auto 2rem;
            display: flex;
            align-items: baseline;
            gap: 1rem;
        }

        header h1 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 700;
            background: #5b6af0;
            color: #fff;
            border-radius: 20px;
            padding: 0.2em 0.7em;
        }

        .badge.zero { background: #2c2f3e; color: #8b8fa8; }

        .empty {
            max-width: 860px;
            margin: 0 auto;
            color: #8b8fa8;
            font-size: 0.9rem;
            padding: 3rem 0;
            text-align: center;
        }

        .submission {
            max-width: 860px;
            margin: 0 auto 1.25rem;
            background: #1a1d27;
            border: 1px solid #2c2f3e;
            border-radius: 10px;
            padding: 1.25rem 1.5rem;
        }

        .submission.viewed {
            opacity: 0.55;
        }

        .sub-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .sub-meta {
            font-size: 0.8rem;
            color: #8b8fa8;
        }

        .sub-meta strong {
            color: #c8cadb;
            font-weight: 600;
        }

        .new-dot {
            display: inline-block;
            width: 8px;
            height: 8px;
            background: #5b6af0;
            border-radius: 50%;
            margin-right: 0.4rem;
            vertical-align: middle;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            font-family: inherit;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 0.35rem 0.8rem;
            border-radius: 5px;
            border: 1px solid;
            cursor: pointer;
            transition: opacity 0.15s;
        }

        .btn:hover { opacity: 0.8; }

        .btn-copy {
            background: #5b6af0;
            border-color: #5b6af0;
            color: #fff;
        }

        .btn-viewed {
            background: transparent;
            border-color: #3d4060;
            color: #8b8fa8;
        }

        .btn-delete {
            background: transparent;
            border-color: #6a2828;
            color: #c07070;
        }

        .payload-box {
            background: #0f1117;
            border: 1px solid #2c2f3e;
            border-radius: 6px;
            padding: 0.85rem;
            font-family: 'Courier New', monospace;
            font-size: 0.72rem;
            color: #8b8fa8;
            word-break: break-all;
            white-space: pre-wrap;
            max-height: 160px;
            overflow-y: auto;
        }

        .copy-hint {
            font-size: 0.75rem;
            color: #5b6af0;
            margin-top: 0.4rem;
        }

        .copy-hint.copied { color: #5b8a5b; }
    </style>
</head>
<body>

<header>
    <h1>🔐 Submissions</h1>
    <span class="badge <?= $unviewed === 0 ? 'zero' : '' ?>">
        <?= $unviewed ?> new
    </span>
    <span class="sub-meta" style="margin-left:auto"><?= $total ?> total</span>
</header>

<?php if (empty($submissions)): ?>
    <div class="empty">No submissions yet.</div>
<?php else: ?>

    <?php foreach ($submissions as $s): ?>
    <?php
        $payloadJson = json_encode($s['payload'], JSON_PRETTY_PRINT);
        $ts = date('D M j, Y — g:ia', strtotime($s['timestamp']));
    ?>
    <div class="submission <?= $s['viewed'] ? 'viewed' : '' ?>">
        <div class="sub-header">
            <div class="sub-meta">
                <?php if (!$s['viewed']): ?>
                    <span class="new-dot"></span>
                <?php endif; ?>
                <strong><?= htmlspecialchars($ts) ?></strong>
                &nbsp;·&nbsp; ID: <code><?= htmlspecialchars($s['id']) ?></code>
            </div>
            <div class="actions">
                <button class="btn btn-copy" data-payload="<?= htmlspecialchars($payloadJson) ?>">Copy Payload</button>
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

        <div class="payload-box" id="payload-<?= htmlspecialchars($s['id']) ?>"><?= htmlspecialchars($payloadJson) ?></div>
        <div class="copy-hint" id="hint-<?= htmlspecialchars($s['id']) ?>">Copy this, then paste into <code>decrypt.js</code> when prompted.</div>
    </div>
    <?php endforeach; ?>

<?php endif; ?>

<script>
document.querySelectorAll('.btn-copy').forEach(function (btn) {
    btn.addEventListener('click', function () {
        const payload = btn.dataset.payload;
        navigator.clipboard.writeText(payload).then(function () {
            btn.textContent = 'Copied!';
            setTimeout(function () { btn.textContent = 'Copy Payload'; }, 2000);
        });
    });
});
</script>
</body>
</html>
