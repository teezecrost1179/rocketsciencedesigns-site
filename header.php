<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle ?? 'Web Design, Shopify & Automation Winnipeg | Rocket Science Designs') ?></title>

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-3VFDBYTHWG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-3VFDBYTHWG');
    </script>

    <!-- Basic SEO -->
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? 'Rocket Science Designs is a Winnipeg-based digital generalist studio offering web design, branding, Shopify builds, email marketing, photography, and video production for small businesses and growing brands.') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://rocketsciencedesigns.com<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>">

    <meta name="keywords" content="web design Winnipeg, freelance web designer, Shopify developer, branding, email marketing, Rocket Science Designs">

    <!-- Open Graph / Social -->
    <?php
    $og_type  = $og_type  ?? 'website';
    $og_title = $pageTitle ?? 'Rocket Science Designs | Web Design & Digital Creative in Winnipeg';
    $og_desc  = $metaDescription ?? 'Freelance web design and digital creative studio helping brands look sharp, load fast, and sell more online.';
    $og_url   = 'https://rocketsciencedesigns.com' . strtok($_SERVER['REQUEST_URI'], '?');
    $og_image = $og_image ?? 'https://rocketsciencedesigns.com/assets/rocket-logo-26.png';
    ?>
    <meta property="og:type"        content="<?php echo $og_type; ?>">
    <meta property="og:title"       content="<?php echo htmlspecialchars($og_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($og_desc); ?>">
    <meta property="og:url"         content="<?php echo $og_url; ?>">
    <meta property="og:image"       content="<?php echo $og_image; ?>">
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="<?php echo htmlspecialchars($og_title); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($og_desc); ?>">
    <meta name="twitter:image"       content="<?php echo $og_image; ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/rocket-favicon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Kameron:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/assets/style.css?v=1">


    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Rocket Science Designs",
      "url": "https://rocketsciencedesigns.com",
      "logo": "https://rocketsciencedesigns.com/assets/logo-white-bg.png",
      "image": "https://rocketsciencedesigns.com/assets/main-site-imagery.jpg",
      "description": "Winnipeg-based web design, Shopify development, branding, AI automation and API integrations for small businesses and growing brands.",
      "telephone": "+12048082733",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "157 Browning Blvd",
        "addressLocality": "Winnipeg",
        "addressRegion": "MB",
        "postalCode": "R3K 0L1",
        "addressCountry": "CA"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "49.87200415417694",
        "longitude": "-97.29598290452624"
      },
      "areaServed": [
        "Winnipeg",
        "Manitoba",
        "Canada"
      ],
      "priceRange": "$$",
      "sameAs": [
        "https://www.linkedin.com/in/robertcbond/",
        "https://maps.app.goo.gl/2hm8WYJw3GFGLH9R6"
      ]
    }
    </script>
</head>
<body>
<div class="page-bg">

    <!-- Sticky header: logo + nav + hamburger -->
    <header id="top" class="site-header">
        <video class="header-video" autoplay muted loop playsinline>
            <source src="https://rocketsciencedesigns.com/video%20pixel%20loop.mp4" type="video/mp4">
            Your browser does not support HTML5 video.
        </video>
        <div class="header-overlay"></div>

        <div class="max-width header-inner">
            <div class="header-bar">
                <a href="/" class="brand">
                    <img src="/assets/logo-white-bg.png" alt="Rocket Science Designs logo">
                </a>

                <!-- Desktop / mobile nav -->
                <nav class="main-nav" aria-label="Primary">
                    <ul class="nav-list">
                        <!-- ABOUT (no submenu) -->
                        <li class="nav-item">
                            <div class="nav-item-header">
                                <a href="/#about" class="nav-link">About</a>
                            </div>
                        </li>

                        <!-- SERVICES (only item with submenu) -->
                        <li class="nav-item has-menu">
                            <div class="nav-item-header">
                                <a href="/#services" class="nav-link">Services</a>
                                <button class="submenu-toggle" type="button"
                                        aria-expanded="false"
                                        aria-label="Toggle Services submenu">
                                    <span class="chevron" aria-hidden="true"></span>
                                </button>
                            </div>
                            <ul class="dropdown">
                                <li><a href="/logo-branding-design-winnipeg">Logos &amp; Branding</a></li>
                                <li><a href="/web-design-services-winnipeg">Website Design</a></li>
                                <li><a href="/shopify-design-winnipeg">Shopify Sites &amp; Mods</a></li>
                                <li><a href="/print-packaging-design-winnipeg">Print &amp; Packaging Layout</a></li>
                                <li><a href="/product-photography-winnipeg">Product Photography</a></li>
                                <li><a href="/email-marketing-winnipeg">Email Marketing</a></li>
                                <li><a href="/video-content-winnipeg">Video Content</a></li>
                            </ul>
                        </li>

                        <!-- ROCKET RECEPTION (external) -->
                        <li class="nav-item">
                            <div class="nav-item-header">
                                <a href="https://rocketreception.ca" class="nav-link" target="_blank" rel="noopener noreferrer">Rocket Reception</a>
                            </div>
                        </li>

                        <!-- WORK (no submenu) -->
                        <li class="nav-item">
                            <div class="nav-item-header">
                                <a href="/my-work-winnipeg" class="nav-link">Work</a>
                            </div>
                        </li>

                        <!-- CONTACT (no submenu, keep edge class) -->
                        <li class="nav-item nav-item--edge">
                            <div class="nav-item-header">
                                <a href="/#contact" class="nav-link">Contact</a>
                            </div>
                        </li>
                    </ul>
                </nav>



                <!-- Hamburger for mobile -->
                <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
                    <span class="nav-toggle-box">
                        <span class="nav-toggle-line"></span>
                        <span class="nav-toggle-line"></span>
                        <span class="nav-toggle-line"></span>
                    </span>
                </button>
            </div>
        </div>
    </header>
