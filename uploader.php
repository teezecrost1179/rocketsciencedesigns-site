<?php
// upload.php
declare(strict_types=1);
session_start();

// --- CONFIG ---
$maxBytes   = 50 * 1024 * 1024; // 50 MB
$allowedExt = ['pdf','jpg','jpeg','png','gif','zip','doc','docx','xls','xlsx','txt','mp4','mov'];
$uploadDir  = __DIR__ . '/uploads';

// Ensure uploads directory exists
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// CSRF token
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(16));
}

$msg = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['token'], $_POST['token'] ?? '')) {
        $msg = "Invalid request. Please refresh and try again.";
    } elseif (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $msg = "Upload failed. Try again.";
    } elseif ($_FILES['file']['size'] > $maxBytes) {
        $msg = "File too large. Limit is 50 MB.";
    } else {
        $origName = $_FILES['file']['name'];
        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));

        if ($allowedExt && !in_array($ext, $allowedExt, true)) {
            $msg = "File type not allowed.";
        } else {
            $safeBase = preg_replace('/[^a-zA-Z0-9_\-]/','_',pathinfo($origName, PATHINFO_FILENAME));
            if ($safeBase === '') $safeBase = 'file';
            $newName = $safeBase . '_' . uniqid() . '.' . $ext;
            $dest    = $uploadDir . '/' . $newName;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
                chmod($dest, 0644);
                $msg = "Upload successful! Saved as: " . htmlspecialchars($newName);
            } else {
                $msg = "Could not save file.";
            }
        }
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload</title>
</head>
<body>
<h2>Upload a File (max 50 MB)</h2>

<?php if ($msg): ?>
  <p><strong><?php echo htmlspecialchars($msg); ?></strong></p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="file" required>
  <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']); ?>">
  <button type="submit">Upload</button>
</form>

</body>
</html>
