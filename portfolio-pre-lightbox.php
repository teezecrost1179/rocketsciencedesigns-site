<?php
$pageTitle = "Portfolio | Rocket Science Designs - Winnipeg Web and Digital Marketing Specialists";
$pageDescription = "Learn more about Robert Bond and the freelance web design and content work he does for Winnipeg businesses.";
include 'header.php';
?>

<?php
$portfolioItems = [
  ['slug'=>'portfolio-ad-peachhover','title'=>'Peach Hover Ad','category'=>'Digital Ads','thumbnail'=>'portfolio/portfolio-ad-peachhover-thumb.jpg','video'=>'portfolio/portfolio-ad-peachhover.mp4','image'=>'','description'=>'A playful ad featuring hover effect animations for a fruit delivery brand.'],
  ['slug'=>'portfolio-photo-jarscoop','title'=>'Jar Scoop Photography','category'=>'Photography and Photo Enhancement','thumbnail'=>'portfolio/portfolio-photo-jarscoop-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-photo-jarscoop.jpg','description'=>'Crisp product photo used in digital and print.'],
  ['slug'=>'portfolio-photo-jarice','title'=>'Jar with Ice Photo','category'=>'Photography and Photo Enhancement','thumbnail'=>'portfolio/portfolio-photo-jarice-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-photo-jarice.jpg','description'=>'Styled shot emphasizing refreshment.'],
  ['slug'=>'portfolio-ad-jarrotate','title'=>'Rotating Jar Ad','category'=>'Digital Ads','thumbnail'=>'portfolio/portfolio-ad-jarrotate-thumb.jpg','video'=>'portfolio/portfolio-ad-jarrotate.mp4','image'=>'','description'=>'Looping video ad showcasing packaging from all angles.'],
  ['slug'=>'portfolio-ad-explainer','title'=>'Explainer Graphic','category'=>'Digital Ads','thumbnail'=>'portfolio/portfolio-ad-explainer-thumb.jpg','video'=>'portfolio/portfolio-ad-explainer.mp4','image'=>'','description'=>'Infographic-style visual used in paid campaigns.'],
  ['slug'=>'portfolio-ad-doallthethings','title'=>'Do All The Things Ad','category'=>'Digital Ads','thumbnail'=>'portfolio/portfolio-ad-doallthethings-thumb.jpg','video'=>'portfolio/portfolio-ad-doallthethings.mp4','image'=>'','description'=>'Quick-cut video ad for multitasking parents.'],
  ['slug'=>'portfolio-ad-lovecoffee','title'=>'Love Coffee Ad','category'=>'Digital Ads','thumbnail'=>'portfolio/portfolio-ad-lovecoffee-thumb.jpg','video'=>'portfolio/portfolio-ad-lovecoffee.mp4','image'=>'','description'=>'A/B test ad for targeting coffee-loving audiences.'],
  ['slug'=>'portfolio-ad-explainerslomo','title'=>'Slo-mo Explainer Ad','category'=>'Digital Ads','thumbnail'=>'portfolio/portfolio-ad-explainerslomo-thumb.jpg','video'=>'portfolio/portfolio-ad-explainerslomo.mp4','image'=>'','description'=>'Slow-motion overlay for visual storytelling.'],
  ['slug'=>'portfolio-email-fxrgoggles','title'=>'FXR Goggles Email','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-fxrgoggles-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-fxrgoggles.jpg','description'=>'Promotional email for FXR’s seasonal gear.'],
  ['slug'=>'portfolio-email-adb','title'=>'Adulting Done Bright Email','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-adb-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-adb.jpg','description'=>'Customer email design for launch sequence of Adulting Done Bright.'],
  ['slug'=>'portfolio-email-mpgleggings','title'=>'MPG Leggings Promo','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-mpgleggings-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-mpgleggings.jpg','description'=>'Sale announcement and CTA-focused design.'],
  ['slug'=>'portfolio-email-mpgxmas','title'=>'MPG Christmas Email','category'=>'Email Marketing','thumbnail'=>'portfolio/portfolio-email-mpgxmas-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-email-mpgxmas.jpg','description'=>'Holiday-themed promotional email.'],
  ['slug'=>'portfolio-web-fxrhome','title'=>'FXR Homepage Redesign','category'=>'Web Design and Development','thumbnail'=>'portfolio/portfolio-web-fxrhome-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-web-fxrhome.jpg','description'=>'Modernized homepage for FXR.'],
  ['slug'=>'portfolio-web-mpghome','title'=>'MPG Homepage','category'=>'Web Design and Development','thumbnail'=>'portfolio/portfolio-web-mpghome-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-web-mpghome.jpg','description'=>'Landing page UX improvements and redesign.'],
  ['slug'=>'portfolio-web-adbhome','title'=>'Adulting Done Bright Homepage','category'=>'Web Design and Development','thumbnail'=>'portfolio/portfolio-web-adbhome-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-web-adbhome.jpg','description'=>'Homepage design for Adulting Done Bright’s direct-to-consumer Shopify site.'],
  ['slug'=>'portfolio-graphics-jarrefreshingly','title'=>'Jar Illustration','category'=>'Graphic Design and Illustration','thumbnail'=>'portfolio/portfolio-graphics-jarrefreshingly-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-graphics-jarrefreshingly.jpg','description'=>'Packaging concept artwork.'],
  ['slug'=>'portfolio-graphics-energypdf','title'=>'Energy PDF Design','category'=>'Graphic Design and Illustration','thumbnail'=>'portfolio/portfolio-graphics-energypdf-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-graphics-energypdf.jpg','description'=>'Downloadable quick-reference guide designed for print and web, focused on functional energy ingredients. Download the <a href="https://cdn.shopify.com/s/files/1/0611/0337/4414/files/parenity-adb-energy-guide.pdf?v=1749831455" target="_blank">PDF version here</a>.'],
  ['slug'=>'portfolio-graphics-rocketlogo','title'=>'Rocket Science Logo','category'=>'Graphic Design and Illustration','thumbnail'=>'portfolio/portfolio-graphics-rocketlogo-thumb.jpg','video'=>'','image'=>'portfolio/portfolio-graphics-rocketlogo.jpg','description'=>'Original branding concept for Rocket Science Designs — clean, minimal, and tech-forward.'],
  ['slug'=>'portfolio-social-newlabels','title'=>'New Labels Teaser','category'=>'Social Posts and Content Creation','thumbnail'=>'portfolio/portfolio-social-newlabels-thumb.jpg','video'=>'portfolio/portfolio-social-newlabels.mp4','image'=>'','description'=>'Brand refresh announcement teaser.'],
  ['slug'=>'portfolio-social-ants','title'=>'Ants and Peonies Post','category'=>'Social Posts and Content Creation','thumbnail'=>'portfolio/portfolio-social-ants-thumb.jpg','video'=>'portfolio/portfolio-social-ants.mp4','image'=>'','description'=>'Organic social post with macro video and inspirational tone.'],
  ['slug'=>'portfolio-social-plantnote','title'=>'Plant Note Graphic','category'=>'Social Posts and Content Creation','thumbnail'=>'portfolio/portfolio-social-plantnote-thumb.jpg','video'=>'portfolio/portfolio-social-plantnote.mp4','image'=>'','description'=>'Animated quote overlay for organic reach.'],
  ['slug'=>'portfolio-social-embraceprocess','title'=>'Embrace the Process','category'=>'Social Posts and Content Creation','thumbnail'=>'portfolio/portfolio-social-embraceprocess-thumb.jpg','video'=>'portfolio/portfolio-social-embraceprocess.mp4','image'=>'','description'=>'Motivational carousel frame.']

];
?>



  <section class="video-hero">
    <video autoplay muted loop playsinline>
      <source src="https://rocketsciencedesigns.com/video%20pixel%20loop.mp4" type="video/mp4" />
    </video>
    <div class="content">
        <h1>Selected Work & Case Studies</h1>
        <p>This portfolio is a small (and growing) sample of the digital work I've done—spanning web design, email marketing, Shopify builds, and content strategy.</p>
        <p style="margin-top: 1rem;"><em>Heads up: This page is under heavy construction. Many examples are still being added, and the ones here only scratch the surface of what I’ve built over the years.</em></p>
    </div>
  </section>

<section class="section" id="workExamples">
  <div class="container">
    <?php
        $grouped = [];

        // Group portfolio items by category
        foreach ($portfolioItems as $item) {
        $grouped[$item['category']][] = $item;
        }

        // Define desired category order
        $categoryOrder = [
        'Web Design and Development',
        'Email Marketing',
        'Digital Ads',
        'Social Posts and Content Creation',
        'Graphic Design and Illustration',
        'Photography and Photo Enhancement'
        ];

        // Output sections in specified order
        foreach ($categoryOrder as $category) {
        if (!isset($grouped[$category])) continue;

        echo "<h2 style='margin-top:3rem;'>$category</h2>";
        echo "<div class='grid'>";

        foreach ($grouped[$category] as $item) {
            echo "<div>";
            echo "<img src='{$item['thumbnail']}' alt='{$item['title']}' style='width:100%; border-radius:8px;' />";
            echo "<p style='margin:0.5rem 0 0; font-weight:bold;'>{$item['title']}</p>";
            echo "<p style='font-size:0.9rem; color:#555;'>{$item['description']}</p>";
            echo "</div>";
        }

        echo "</div>";
        }
    ?>
    </div>

</section>

  <?php include 'footer.php'; ?>