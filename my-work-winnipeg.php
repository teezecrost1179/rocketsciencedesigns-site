<?php
$pageTitle = "My Work | Rocket Science Designs - Winnipeg Web and Digital Creative";
$pageDescription = "Selected work and case studies from Rocket Science Designs – web design, Shopify builds, email marketing, photography, video, and more, based in Winnipeg, Manitoba.";
include 'header25.php';

$portfolioItems = [
  ['slug'=>'portfolio-photo-jarscoop','title'=>'Jar Scoop Photography','category'=>'Photography and Photo Enhancement','thumbnail'=>'portfolio/portfolio-photo-jarscoop-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-photo-jarscoop.jpg','description'=>'Crisp product photo used in digital and print.'],
  ['slug'=>'portfolio-photo-jarice','title'=>'Jar with Ice Photo','category'=>'Photography and Photo Enhancement','thumbnail'=>'portfolio/portfolio-photo-jarice-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-photo-jarice.jpg','description'=>'Styled shot emphasizing refreshment.'],
  ['slug'=>'portfolio-ad-brollbenefits','title'=>'Product Benefits Ad','category'=>'Horizontal Video Content','thumbnail'=>'portfolio/portfolio-ad-brollbenefits-thumb.jpg','video'=>'portfolio/broll-benefits-square.mp4','image'=>'','description'=>'Blending product B-roll shots with benefits mentions for an effective square-format digital ad.'],
  ['slug'=>'portfolio-ad-hero-site-video','title'=>'ADB Hero Video','category'=>'Horizontal Video Content','thumbnail'=>'portfolio/portfolio-ad-hero-site-video-thumb.jpg','video'=>'portfolio/Adb-Hero-Video-With-End-Text.mp4','image'=>'','description'=>'When I needed to build a landing page for ADB, I also needed a "Hero Video" for the top of the page. This video incorporates lots of UGC video, as well as video I shot myself.'],
  ['slug'=>'portfolio-ad-ultimate-sisters','title'=>'Ultimate Sisters Mystery','category'=>'Horizontal Video Content','thumbnail'=>'portfolio/portfolio-ad-ultimate-sisters.jpg','video'=>'portfolio/Ultimate Sisters - Mystery Light.mp4','image'=>'','description'=>'A fun project I did with my daughters. Scripted at shot at home, shot right across the street, editing and compositing done in Davinci Resolve.'],
  ['slug'=>'portfolio-ad-peachhover','title'=>'Peach Hover Ad','category'=>'Horizontal Video Content','thumbnail'=>'portfolio/portfolio-ad-peachhover-thumb.jpg','video'=>'portfolio/portfolio-ad-peachhover.mp4','image'=>'','description'=>'A playful ad featuring hover effect animations for Adulting Done Bright\'s Peach Mango flavour.'],
  ['slug'=>'portfolio-ad-doallthethings','title'=>'Do All The Things Ad','category'=>'Horizontal Video Content','thumbnail'=>'portfolio/portfolio-ad-doallthethings-thumb.jpg','video'=>'portfolio/portfolio-ad-doallthethings.mp4','image'=>'','description'=>'Quick-cut video ad for multitasking parents.'],
  ['slug'=>'portfolio-ad-lovecoffee','title'=>'Love Coffee Ad','category'=>'Horizontal Video Content','thumbnail'=>'portfolio/portfolio-ad-lovecoffee-thumb.jpg','video'=>'portfolio/portfolio-ad-lovecoffee.mp4','image'=>'','description'=>'A/B test ad for targeting coffee-loving audiences.'],
  ['slug'=>'portfolio-email-adb-sun','title'=>'Adulting Done Bright "Sun" Email','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-adb-sun-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-adb-sun.jpg','description'=>'Part of <a href="https://adb.parenity.com" target="_blank">Adulting Done Bright</a>\'s &quot;GET BRIGHT&quot; email campaign series that highlights natural things we can do to get a better start, including the benefits of their natural energy beverage mix.'],
  ['slug'=>'portfolio-email-adb-water','title'=>'Adulting Done Bright "Water" Email','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-adb-water-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-adb-water.jpg','description'=>'Part of <a href="https://adb.parenity.com" target="_blank">Adulting Done Bright</a>\'s &quot;GET BRIGHT&quot; email campaign series that highlights natural things we can do to get a better start, including the benefits of their natural energy beverage mix.'],
  ['slug'=>'portfolio-email-fxrgoggles','title'=>'FXR Goggles Email','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-fxrgoggles-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-fxrgoggles.jpg','description'=>'Promotional email for FXR’s seasonal gear.'],
  ['slug'=>'portfolio-email-mpgleggings','title'=>'MPG Leggings Promo','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-mpgleggings-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-mpgleggings.jpg','description'=>'Sale announcement email campaign for Mondetta\'s MPG Sport brand. A CTA-focused design.'],
  ['slug'=>'portfolio-email-mpgxmas','title'=>'MPG Christmas Email','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-mpgxmas-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-mpgxmas.jpg','description'=>'Holiday-themed promotional email built and scheduled in Klaviyo. Special note: the snow flakes at the top were done as an animated gif so we could have a dynamic snow falling effect.'],
  ['slug'=>'portfolio-web-adblanding','title'=>'Adulting Done Bright Landing Page','category'=>'Web Design and Development','thumbnail'=>'portfolio/portfolio-web-adblanding-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-web-adblanding.jpg','description'=>'I built and customized the entire website Parenity\'s <a href="https://adb.parenity.com" target="_blank">Adulting Done Bright</a> website, but more recently, I built a new <a href="https://parenity.com/pages/adulting-done-bright-the-wake-up-drink-coffee-wishes-it-was" target="_blank">landing page</a> for the product with many UGC videos on it.'],
  ['slug'=>'portfolio-web-fxrhome','title'=>'FXR Website Rebuild','category'=>'Web Design and Development','thumbnail'=>'portfolio/portfolio-web-fxrhome-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-web-fxrhome.jpg','description'=>'We were responsible for migrating FXR\'s entire website and data from the magento ecommerce platform to Shopify. We were launched in 3 months.'],
  ['slug'=>'portfolio-web-mpghome','title'=>'MPG Website Migration','category'=>'Web Design and Development','thumbnail'=>'portfolio/portfolio-web-mpghome-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-web-mpghome.jpg','description'=>'We migrated the MPG Sport website from Suite Commerce Advance to Shopify, and never looked back!'],
  ['slug'=>'portfolio-web-adbhome','title'=>'Adulting Done Bright Homepage','category'=>'Web Design and Development','thumbnail'=>'portfolio/portfolio-web-adbhome-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-web-adbhome.jpg','description'=>'We built and customized the entire website and product page experience for Parenity\'s <a href="https://adb.parenity.com" target="_blank">Adulting Done Bright</a> direct-to-consumer Shopify site.'],
  ['slug'=>'portfolio-graphics-jarrefreshingly','title'=>'Jar Illustration','category'=>'Graphic Design and Illustration','thumbnail'=>'portfolio/portfolio-graphics-jarrefreshingly-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-graphics-jarrefreshingly.jpg','description'=>'Packaging concept artwork and graphical layout treatment of product features and benefits used as an online product photo.'],
  ['slug'=>'portfolio-graphics-energypdf','title'=>'Energy PDF Design','category'=>'Graphic Design and Illustration','thumbnail'=>'portfolio/portfolio-graphics-energypdf-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-graphics-energypdf.jpg','description'=>'Downloadable quick-reference guide designed for print and web, focused on functional energy ingredients. Download the <a href="https://cdn.shopify.com/s/files/1/0611/0337/4414/files/parenity-adb-energy-guide.pdf?v=1749831455" target="_blank">PDF version here</a>.'],
  ['slug'=>'portfolio-graphics-rocketlogo','title'=>'Rocket Science Logo','category'=>'Graphic Design and Illustration','thumbnail'=>'portfolio/portfolio-graphics-rocketlogo-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-graphics-rocketlogo.jpg','description'=>'Original branding concept for Rocket Science Designs — clean, minimal, and tech-forward.'],
  ['slug'=>'portfolio-social-stew-sugar-on-my-tongue','title'=>'Zero Sugar on my Tongue','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-stew-sugar-on-my-tongue-thumb.jpg','video'=>'portfolio/sugar-on-my-tongue.mp4','image'=>'','description'=>'Organic social post incorporating trending audio and some AI video. Edited in Davinci Resolve.'],
  ['slug'=>'portfolio-social-stew-gilmore','title'=>'Zero Sugar on my Tongue','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-stew-gilmore-thumb.jpg','video'=>'portfolio/social-gilmore-girls.mp4','image'=>'','description'=>'Organic social post incorporating trending audio and some AI video. Edited in Davinci Resolve.'],
  ['slug'=>'portfolio-social-potato-bacon-soup','title'=>'Potato Bacon Soup Done Right','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-potato-bacon-soup-thumb.jpg','video'=>'portfolio/potato-bacon-soup.mp4','image'=>'','description'=>'Repurposed some otherwise unused soup-making footage and gave it a product-related twist at the end. Edited in Davinci Resolve.'],
  ['slug'=>'portfolio-social-sobr-market','title'=>'Sobr Market Visit','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-sobr-market-thumb.jpg','video'=>'portfolio/sobr-market-trip.mp4','image'=>'','description'=>'Organic social post showing ADB\'s arrival in Sobr Market locations.'],
  ['slug'=>'portfolio-social-rouge-browning','title'=>'Rouge and Browning Video','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-rouge-browning-thumb.jpg','video'=>'portfolio/rouge-browning-re-export.mp4','image'=>'','description'=>'Social collaboration post promoting ADB and Rouge & Browning\'s Opening.'],
  ['slug'=>'portfolio-social-slowdown','title'=>'Slow Down','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-slowdown-thumb.jpg','video'=>'portfolio/life-too-much-this-3.mp4','image'=>'','description'=>'Organic social post with macro video and inspirational tone.'],
  ['slug'=>'portfolio-social-oatballs','title'=>'Power Oat Balls','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-oatballs-thumb.jpg','video'=>'portfolio/power oat balls.mp4','image'=>'','description'=>'Organic social post demonstrating a healthy snack recipe.'],
  ['slug'=>'portfolio-social-newlabels','title'=>'New Labels Teaser Video','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-newlabels-thumb.jpg','video'=>'portfolio/portfolio-social-newlabels.mp4','image'=>'','description'=>'Brand refresh announcement teaser.'],
  ['slug'=>'portfolio-social-embraceprocess','title'=>'Embrace the Process','category'=>'Vertical Video & Social','thumbnail'=>'portfolio/portfolio-social-embraceprocess-thumb.jpg','video'=>'portfolio/portfolio-social-embraceprocess.mp4','image'=>'','description'=>'Motivational post-it shortform video post for organic reach.']
];
?>

<section id="website-design" class="section">
    <div class="max-width">
        <div class="section-header">
            <div class="section-kicker">MY WORK</div>
            <h1 class="section-title">
                Projects I've worked on recently.
            </h1>
        </div>

        <p>
            Heads up: This page is under heavy construction. Many examples are still being added, and the ones here only scratch
            the surface of what I’ve built over the years.
        </p>
    </div>
</section>

<section class="section" id="workExamples">
  <style>
    /* LIGHTBOX */
    #portfolio-lightbox {
      display: none;
      position: fixed;
      top: 0; 
      left: 0;
      width: 100%; 
      height: 100%;
      background: rgba(0, 0, 0, 0.85);
      z-index: 9999;
      overflow: auto;
      padding: 2rem 0.75rem;
    }

    #portfolio-lightbox img,
    #portfolio-lightbox video {
      max-width: 100%;
      height: auto;
      display: block;
      margin: 0 auto;
      border-radius: 10px;
    }

    #portfolio-lightbox .lightbox-inner {
      max-width: 900px;
      margin: 0 auto;
      background: #ffffff;
      padding: 2rem;
      border-radius: 10px;
      color: #111111;
      position: relative;
      box-shadow: 0 18px 45px rgba(0, 0, 0, 0.45);
    }

    #portfolio-lightbox h2 {
      margin-bottom: 0.75rem;
    }

    #portfolio-lightbox p {
      font-size: 1rem;
      margin-bottom: 1.5rem;
      color: #444444;
    }

    #portfolio-lightbox #lightbox-close {
      position: absolute;
      top: 0.75rem;
      right: 0.75rem;
      background: none;
      border: none;
      font-size: 1.75rem;
      cursor: pointer;
      color: #000;
      line-height: 1;
    }

    #portfolio-lightbox #lightbox-close:hover {
      opacity: 0.7;
    }

    @media (max-width: 768px) {
      #portfolio-lightbox .lightbox-inner {
        padding: 1.25rem;
      }
    }

    /* GRID + TILES */

    /* Matches the “4 across” look from your old site, but responsive */
    #workExamples .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 24px;
    }

    .portfolio-card {
      background: #f4f5f8;
      border-radius: 10px;
      overflow: hidden;
      padding: 0;
      box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.02);
      transition: transform 0.18s ease, box-shadow 0.18s ease, background 0.18s ease;
      cursor: pointer;
    }

    .portfolio-card:hover {
      transform: translateY(-3px);
      box-shadow: 0 16px 32px rgba(0, 0, 0, 0.14);
      background: #ffffff;
    }

    .portfolio-thumb {
      display: block;
      width: 100%;
      height: auto;
      border-radius: 0;
    }

    .portfolio-card-body {
      padding: 0.75rem 0.85rem 1rem;
    }

    .portfolio-title {
      margin: 0;
      font-weight: 600;
      font-size: 0.98rem;
      line-height: 1.3;
      color: #111111;
    }

    section#workExamples {
        padding-top:12px;
    }

    /* Small tweak on headings inside the work section */
    #workExamples .section-header {
      margin-top: 3rem;
      margin-bottom: 1.25rem;
    }

  </style>

  <?php
  function slugify($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
  }
  ?>

  <div class="max-width">
    <?php
      $grouped = [];
      foreach ($portfolioItems as $item) {
        $grouped[$item['category']][] = $item;
      }

      $categoryOrder = [
        'Web Design and Development',
        'Email Marketing',
        'Horizontal Video Content',
        'Vertical Video & Social',
        'Graphic Design and Illustration',
        'Photography and Photo Enhancement'
      ];

      foreach ($categoryOrder as $category) {
        if (!isset($grouped[$category])) continue;

        $id = slugify($category);

        echo "<div class='section-header'>";
        echo "<h2 class='section-title' id='$id'>$category</h2>";
        echo "</div>";

        echo "<div class='grid'>";

        foreach ($grouped[$category] as $item) {
          $dataTitle = htmlspecialchars($item['title'], ENT_QUOTES);
          $dataDescription = htmlspecialchars($item['description'], ENT_QUOTES);
          $dataSrc = $item['video'] ?: $item['image'];
          $dataType = $item['video'] ? 'video' : 'image';

          echo "<article class='portfolio-card'>";
          echo "<img src='{$item['thumbnail']}' alt='{$item['title']}' class='portfolio-thumb' data-title=\"{$dataTitle}\" data-description=\"{$dataDescription}\" data-src=\"{$dataSrc}\" data-type=\"{$dataType}\" />";
          echo "<div class='portfolio-card-body'>";
          echo "<p class='portfolio-title'>{$item['title']}</p>";
          echo "</div>";
          echo "</article>";
        }

        echo "</div>";
      }
    ?>
  </div>

  <div id="portfolio-lightbox">
    <div class="lightbox-inner">
      <button id="lightbox-close" aria-label="Close">&times;</button>
      <h2 id="lightbox-title"></h2>
      <p id="lightbox-description"></p>
      <div id="lightbox-content"></div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.portfolio-thumb').forEach(img => {
      img.addEventListener('click', () => {
        const title = img.getAttribute('data-title');
        const description = img.getAttribute('data-description');
        const src = img.getAttribute('data-src');
        const type = img.getAttribute('data-type');

        document.getElementById('lightbox-title').textContent = title;
        document.getElementById('lightbox-description').innerHTML = description;

        const container = document.getElementById('lightbox-content');
        container.innerHTML = '';

        if (type === 'video') {
          const video = document.createElement('video');
          video.src = src;
          video.controls = true;
          video.style.maxWidth = '100%';
          video.style.maxHeight = '80vh';
          video.style.display = 'block';
          video.style.margin = '0 auto';
          video.playsInline = true;
          container.appendChild(video);
        } else {
          const imgFull = document.createElement('img');
          imgFull.src = src;
          imgFull.style.maxWidth = '100%';
          imgFull.style.height = 'auto';
          imgFull.style.objectFit = 'contain';
          imgFull.style.borderRadius = '10px';
          container.appendChild(imgFull);
        }

        document.getElementById('portfolio-lightbox').style.display = 'block';
        document.body.style.overflow = 'hidden';
      });
    });

    document.getElementById('lightbox-close').addEventListener('click', () => {
      document.getElementById('portfolio-lightbox').style.display = 'none';
      document.getElementById('lightbox-content').innerHTML = '';
      document.body.style.overflow = '';
    });

    document.getElementById('portfolio-lightbox').addEventListener('click', (e) => {
      const inner = document.querySelector('#portfolio-lightbox .lightbox-inner');
      if (!inner.contains(e.target)) {
        document.getElementById('portfolio-lightbox').style.display = 'none';
        document.getElementById('lightbox-content').innerHTML = '';
        document.body.style.overflow = '';
      }
    });
  </script>
</section>

<?php include 'footer25.php'; ?>

