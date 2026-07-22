<?php
// Personal / unlisted page. Not linked from the site and excluded from crawlers.
$videoFile = 'farewell-chuck.mov';   // video file living in this same folder
$videoPath = __DIR__ . '/' . $videoFile;
$videoExists = is_file($videoPath);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>Farewell, Dad</title>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      background: #000;
      color: #fff;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }
    .wrap {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      box-sizing: border-box;
      padding: 24px;
      gap: 24px;
    }
    video {
      max-width: min(1000px, 100%);
      max-height: 80vh;
      width: auto;
      height: auto;
      background: #000;
      box-shadow: 0 0 40px rgba(0, 0, 0, 0.6);
    }
    .download {
      display: inline-block;
      padding: 12px 28px;
      border: 1px solid #fff;
      border-radius: 6px;
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      letter-spacing: 0.02em;
      transition: background 0.2s ease, color 0.2s ease;
    }
    .download:hover {
      background: #fff;
      color: #000;
    }
    .missing {
      opacity: 0.6;
      font-size: 15px;
      text-align: center;
      max-width: 480px;
      line-height: 1.5;
    }
  </style>
</head>
<body>
  <div class="wrap">
    <?php if ($videoExists): ?>
      <video controls playsinline preload="metadata">
        <source src="<?php echo htmlspecialchars($videoFile); ?>" type="video/quicktime">
        Your browser does not support the video tag.
      </video>
      <a class="download" href="<?php echo htmlspecialchars($videoFile); ?>" download>Download video</a>
    <?php else: ?>
      <p class="missing">Video not found. Drop <strong><?php echo htmlspecialchars($videoFile); ?></strong> into this folder.</p>
    <?php endif; ?>
  </div>
</body>
</html>
