<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rocket Science Designs | Web Design & Digital Creative in Winnipeg</title>

    <!-- Basic SEO -->
    <meta name="description" content="Rocket Science Designs is a Winnipeg-based digital generalist studio offering web design, branding, Shopify builds, email marketing, photography, and video production for small businesses and growing brands.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="https://rocketsciencedesigns.com/">

    <meta name="keywords" content="web design Winnipeg, freelance web designer, Shopify developer, branding, email marketing, Rocket Science Designs">

    <!-- Open Graph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="Rocket Science Designs | Web Design & Digital Creative in Winnipeg">
    <meta property="og:description" content="Freelance web design and digital creative studio helping brands look sharp, load fast, and sell more online.">
    <meta property="og:url" content="https://rocketsciencedesigns.com/">
    <meta property="og:image" content="https://rocketsciencedesigns.com/assets/rocket-logo-26.png">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Rocket Science Designs | Web Design & Digital Creative in Winnipeg">
    <meta name="twitter:description" content="Websites, branding, Shopify, email, and content creation for teams that need a flexible digital generalist.">
    <meta name="twitter:image" content="https://rocketsciencedesigns.com/assets/rocket-logo-26.png">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/rocket-favicon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700&family=Kameron:wght@400;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-header: #08060f;
            --accent: #d91818;
            --text-light: #ffffff;      /* for header */
            --text-body: #111111;       /* main/body text */
            --text-muted: #666666;      /* secondary text on white */
            --max-width: 1500px;
            --nav-height: 72px;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: "Kameron", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #ffffff;
            color: var(--text-body);
            font-size: 19px; /* body copy size */
        }

        img {
            max-width: 100%;
            display: block;
        }

        a {
            color: inherit;
        }

        .page-bg {
            min-height: 100vh;
            background: #ffffff;
        }

        .max-width {
            max-width: var(--max-width);
            margin: 0 auto;
            padding-inline: 24px;
        }

        /* HEADER (sticky, logo + nav only) */

        .site-header {
            background-color: var(--bg-header); /* outside 1500px */
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-inner {
            position: relative;
            /* let dropdowns extend beyond the bottom of the header */
            overflow: visible;
            min-height: var(--nav-height);
            padding-top:0px; 
            padding-bottom:0px;
            z-index: 2;
        }

        .header-video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            pointer-events: none;
        }

        .header-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(270deg,
                    rgba(0, 0, 0, 1) 0%,
                    rgba(0, 0, 0, 0) 25%);
            z-index: 1;
        }

        .header-bar {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 22px;
            min-height: var(--nav-height);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            font-family: "Manrope", system-ui, sans-serif;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 18px; /* increased by 1px */
            color: var(--text-light);
            position: relative;
        }

        .brand img {
            height: 56px;
            width: auto;
            margin: 12px 0 12px 0;
        }


        .brand span {
            white-space: nowrap;
            position: relative;
            top: 3px; /* nudge text down */
        }

        nav.main-nav {
            display: flex;
            align-items: stretch;
            font-family: "Manrope", system-ui, sans-serif;
            font-size: 17px;
            text-transform: none;
        }

        .nav-link {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 18px;
            text-decoration: none;
            color: var(--text-light);
            font-weight: 500;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            white-space: nowrap;
            transition: background-color 0.18s ease, color 0.18s ease, transform 0.18s ease;
        }

        .nav-link:hover,
        .nav-link:focus-visible {
            background: #ffffff;
            color: var(--accent);
            text-shadow: none;
            transform: translateY(-1px);
            outline: none;
        }

        /* Dropdown + submenu structure */

        .main-nav .nav-list {
            display: flex;
            align-items: stretch;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .nav-item {
            position: relative;
        }

        .nav-item-header {
            display: flex;
            align-items: stretch;
        }

        .has-menu .submenu-toggle {
            border: 0;
            background: none;
            padding: 0 0 0 4px;
            cursor: pointer;
            display: none; /* shown on mobile only */
            align-items: center;
            justify-content: center;
        }

        .has-menu .submenu-toggle:focus {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
        }

        .has-menu .chevron {
            display: inline-block;
            width: 8px;
            height: 8px;
            border: solid currentColor;
            border-width: 0 1.5px 1.5px 0;
            transform: rotate(45deg); /* ▼ by default */
            transition: transform 0.18s ease;
        }

        .nav-item.open .chevron {
            transform: rotate(-135deg);   /* ◀ when open on mobile */
        }

        .dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 220px;
            margin: 0;
            padding: 10px 0;
            list-style: none;
            background: #ffffff;
            color: #111111;
            border-radius: 0 0 4px 4px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            display: none;
            z-index: 40;
        }

        .dropdown li {
            white-space: nowrap;
        }

        .dropdown a {
            display: block;
            padding: 6px 20px;
            text-decoration: none;
            color: inherit;
        }

        .dropdown a:hover,
        .dropdown a:focus-visible {
            background: rgba(0, 0, 0, 0.04);
            color: inherit;
        }

        /* Show dropdowns on hover / focus on desktop only */
        @media (min-width: 901px) {
            .nav-item.has-menu:hover > .dropdown,
            .nav-item.has-menu:focus-within > .dropdown {
                display: block;
            }
        }

        /* Right-edge protection: flip dropdown on edge items */
        .nav-item--edge > .dropdown {
            right: 0;
            left: auto;
        }

        /* Hamburger toggle */

        .nav-toggle {
            display: none; /* shown only on mobile */
            background: none;
            border: 0;
            padding: 0 4px;
            margin-left: 8px;
            cursor: pointer;
            color: var(--text-light);
            align-items: center;
            justify-content: center;
        }

        .nav-toggle-box {
            width: 24px;
            height: 18px;
            position: relative;
        }

        .nav-toggle-line {
            position: absolute;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--text-light);
            border-radius: 1px;
            transition: transform 0.2s ease, opacity 0.2s ease, top 0.2s ease, bottom 0.2s ease;
        }

        .nav-toggle-line:nth-child(1) {
            top: 0;
        }

        .nav-toggle-line:nth-child(2) {
            top: 8px;
        }

        .nav-toggle-line:nth-child(3) {
            bottom: 0;
        }

        .nav-toggle.is-open .nav-toggle-line:nth-child(1) {
            top: 8px;
            transform: rotate(45deg);
        }

        .nav-toggle.is-open .nav-toggle-line:nth-child(2) {
            opacity: 0;
        }

        .nav-toggle.is-open .nav-toggle-line:nth-child(3) {
            bottom: auto;
            top: 8px;
            transform: rotate(-45deg);
        }

        /* HERO (main content) */

        .hero {
            max-width: 720px;
        }

        .hero-kicker {
            font-family: "Manrope", system-ui, sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.17em;
            font-size: 20px;              /* eyebrow mobile */
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .hero h1 {
            font-family: "Manrope", system-ui, sans-serif;
            font-weight: 700;
            font-size: 40px;              /* H1 mobile */
            line-height: 1.1;
            margin: 0 0 16px;
            color: var(--text-body);
        }

        .hero p {
            margin: 0 0 28px;
            font-size: 19px;              /* body copy */
            color: var(--text-muted);
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        /* Buttons */

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 11px 22px;
            border-radius: 10px;          /* 10px radius */
            border: 1px solid transparent;
            font-family: "Manrope", system-ui, sans-serif;
            font-size: 16px;              /* button text size */
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.18s ease, color 0.18s ease, border-color 0.18s ease, transform 0.18s ease;
        }

        .btn-primary {
            background: var(--accent);
            color: #ffffff;
            border-color: var(--accent);
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #ff4a82;
            border-color: #ff4a82;
            transform: translateY(-1px);
        }

        .btn-ghost {
            background: transparent;
            color: var(--text-body);
            border-color: #cccccc;
        }

        .btn-ghost:hover {
            background: #f5f5f5;
            border-color: #bbbbbb;
            transform: translateY(-1px);
        }

        /* SECTIONS (for layout; main markup lives in temp.php) */

        main {
            padding-block: 56px 96px;
        }

        .service-card .service-link { margin-top:12px; display:block; }

        .section {
            padding-block: 72px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.06);
            scroll-margin-top: var(--nav-height);
        }

        .section:last-of-type {
            border-bottom: none;
        }

        .section-header {
            margin-bottom: 24px;
        }

        .section-kicker {
            font-family: "Manrope", system-ui, sans-serif;
            font-size: 20px;              /* eyebrow mobile */
            text-transform: uppercase;
            letter-spacing: 0.18em;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .section-title {
            font-family: "Manrope", system-ui, sans-serif;
            font-size: 40px;              /* H2 mobile */
            margin: 0;
            color: var(--text-body);
        }

        /* Content headings */
        h1,
        h2 {
            font-family: "Manrope", system-ui, sans-serif;
            font-weight: 700;
            font-size: 40px;        /* mobile size */
            line-height: 1.1;
            margin: 32px 0 12px;
            color: var(--text-body);
        }

        /* tighten the main top H1 since it's already in a section-header */
        .section-title {
            margin-top: 0;
        }

        /* Sub-heads for process steps */
        h3 {
            font-family: "Manrope", system-ui, sans-serif;
            font-weight: 600;
            font-size: 24px;
            line-height: 1.2;
            margin: 24px 0 8px;
            color: var(--text-body);
        }


        .section p {
            max-width: 800px;
            color: var(--text-muted);
        }

        /* ABOUT split layout on home */
        #about .about-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 32px;
            align-items: stretch;
        }

        #about .about-copy {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #about .about-copy p {
            max-width: 100%;
        }

        #about .about-media {
            min-height: 420px;
        }

        #about .about-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* SERVICES GRID + CARDS */

        .services-grid {
            display: grid;
            gap: 24px;
        }

        .service-card {
            background: #f9f9f9;
            border-radius: 10px;          /* card radius */
            border: 1px solid rgba(0, 0, 0, 0.06);
            padding: 24px;
        }

        .service-title {
            font-family: "Manrope", system-ui, sans-serif;
            font-size: 22px;
            margin: 0 0 10px;
            color: var(--text-body);
        }

        .service-card p {
            margin: 0;
            color: var(--text-muted);
        }

        /* VOICE CALL SECTION */
        #contact .voice-call-wrap {
            text-align: left;
        }

        #contact .call-us-title {
            margin-bottom: 8px;
        }

        #contact .call-us-number,
        #contact .call-us-number a {
            color: var(--accent);
        }

        #contact .rr-call-label {
            margin: 0 0 14px;
            color: var(--text-muted);
        }

        #contact .rr-form {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        #contact .rr-form input[type="tel"] {
            min-width: 260px;
            max-width: 420px;
            width: 100%;
            font-family: "Kameron", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 19px;
            line-height: 1.4;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.12);
            background: #fafafa;
            color: var(--text-body);
            outline: none;
        }

        #contact .rr-form input[type="tel"]:focus {
            background: #ffffff;
            border-color: var(--accent);
            box-shadow: 0 0 0 1px rgba(217, 24, 24, 0.12);
        }

        #contact .rr-form-status {
            display: block;
            width: 100%;
            min-height: 1.2em;
            font-size: 14px;
            color: var(--text-muted);
        }

        #contact .rr-powered-by {
            margin-top: 12px;
            font-size: 14px;
            color: var(--text-muted);
        }

        #contact .rr-form .btn-primary:hover,
        #contact .rr-form .btn-primary:focus-visible {
            background: #b31212;
            border-color: #b31212;
        }

        /* FOOTER – styles; markup in footer.php */

        .site-footer {
            background: #ffffff;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            color: var(--text-muted);
            padding-block: 32px 40px;
        }

        .footer-inner {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            justify-content: space-between;
            align-items: flex-start;
        }

        .footer-small {
            font-size: 13px;
        }

        .footer-nav {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            font-size: 13px;
        }

        .footer-nav a {
            text-decoration: none;
            color: var(--text-muted);
        }

        .footer-nav a:hover {
            color: var(--accent);
        }

        /* RESPONSIVE */

        @media (max-width: 900px) {
            .header-bar {
                align-items: center;
                padding-block: 8px;
                flex-wrap: wrap;           /* 👈 this allows rows */
            }

            #about .about-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            #about .about-media {
                order: -1;
                min-height: 0;
                display: flex;
                justify-content: center;
            }

            #about .about-media img {
                width: 85vw;
                max-width: 85vw;
                height: auto;
            }

            #contact .rr-form {
                flex-direction: column;
            }

            #contact .rr-form input[type="tel"] {
                min-width: 0;
                width: min(85vw, 480px);
            }

            .nav-toggle {
                display: flex;             /* show hamburger on mobile */
            }

            nav.main-nav {
                order: 3;                  /* put nav AFTER logo + hamburger */
                flex-basis: 100%;          /* take full width of row 2 */
                width: 100%;
                margin-top: 8px;
                flex-direction: column;
                align-items: flex-start;
                flex-wrap: nowrap;
                border-top: 1px solid rgba(255, 255, 255, 0.25);
                padding-top: 12px;
            }

            /* Hide/show nav only when JS is available */
            .has-js nav.main-nav {
                display: none;             /* hidden by default when JS works */
            }

            .has-js nav.main-nav.is-open {
                display: flex;             /* stacked vertically below logo */
            }

            /* Stack items vertically (you probably already have this bit) */
            .main-nav .nav-list {
                flex-direction: column;
                width: 100%;
            }

            .nav-item {
                width: 100%;
            }

            .nav-item-header {
                display: flex;
                align-items: center;
                justify-content: center;   /* center the group */
                gap: 8px;                  /* space between text and chevron */
                width: 100%;
            }

            /* Show the arrow button on mobile */
            .has-menu .submenu-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0;                /* snug up against the text */
                border: 0;
                background: transparent;
                cursor: pointer;
            }

            /* The little triangle */
            .chevron {
                display: inline-block;
                width: 8px;
                height: 8px;
                color:white;
                border: solid currentColor;
                border-width: 0 1.5px 1.5px 0;
                transform: rotate(45deg);          /* ▼ when closed */
                transition: transform 0.18s ease;
            }

            /* Rotate when the submenu is open */
            .nav-item.open .chevron {
                transform: rotate(-135deg);        /* ▲ / ◀ depending how you see it */
            }

            /* Mobile dropdowns: collapse/expand instead of hover */
            .dropdown {
                position: static;
                min-width: 0;
                background: transparent;
                color:white;
                border-radius: 0;
                box-shadow: none;
                padding: 0 0 8px 18px;
                display: none;
            }

            .nav-item.open > .dropdown {
                display: block;
            }

            .dropdown a {
                padding-inline: 0;
            }

            .nav-link {
                flex: 0 0 auto;            /* shrink to text width */
                padding: 16px 0;           /* vertical padding only */
                background: transparent;
            }

            .nav-link:hover,
            .nav-link:focus,
            .nav-link:focus-visible,
            .nav-link:active {
                background: transparent;     /* no white bar */
                outline: none;
            }

            .brand span {
                font-size: 16px;
            }
        }

        @media (max-width: 640px) {
            .max-width {
                padding-inline: 16px;
            }

            .hero p {
                font-size: 19px; /* keep body size on mobile too */
            }

            .section {
                padding-block: 48px;
            }
        }

        @media (min-width: 640px) {
            .services-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .services-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (min-width: 901px) {
            .site-header .header-inner {
                overflow: visible;
            }
            .has-menu .submenu-toggle {
                display: none;
            }

            /* bump eyebrow + headings on desktop */
            .hero-kicker,
            .section-kicker {
                font-size: 22px;
            }

            .section-title,
            .hero h1,
            h1,
            h2 {
                font-size: 48px;
            }
        }

        /* START A PROJECT – FORM */

        #start-project #contact-form {
            margin-top: 28px;
            display: grid;
            gap: 14px;
        }

        /* Inputs + textarea */

        #contact-form input,
        #contact-form textarea {
            width: 100%;
            font-family: "Kameron", system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 19px;
            line-height: 1.4;
            padding: 14px 16px;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.12);
            background: #fafafa;
            color: var(--text-body);
            outline: none;
            transition:
                border-color 0.18s ease,
                background-color 0.18s ease,
                box-shadow 0.18s ease;
            resize: vertical;
        }

        #contact-form textarea {
            min-height: 160px;
        }

        /* Placeholder styling */

        #contact-form input::placeholder,
        #contact-form textarea::placeholder {
            color: #999999;
            opacity: 1;
        }

        /* Hover + focus states */

        #contact-form input:hover,
        #contact-form textarea:hover {
            background: #ffffff;
        }

        #contact-form input:focus,
        #contact-form textarea:focus {
            background: #ffffff;
            border-color: var(--accent);
            box-shadow: 0 0 0 1px rgba(217, 23, 23, 0.12);
        }

        /* Submit button – match your button spec (16px, 10px radius) */

        #contact-form button[type="submit"] {
            align-self: flex-start;
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-family: "Manrope", system-ui, sans-serif;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            background: var(--accent);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition:
                background-color 0.18s ease,
                transform 0.18s ease,
                box-shadow 0.18s ease;
            box-shadow: 0 12px 26px rgba(0, 0, 0, 0.18);
        }

        #contact-form button[type="submit"]:hover {
            background: #f03939;
            transform: translateY(-1px);
            box-shadow: 0 16px 32px rgba(0, 0, 0, 0.22);
        }

        #contact-form button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 10px 22px rgba(0, 0, 0, 0.18);
        }

        /* Response message */

        #form-response {
            font-size: 14px;
            color: var(--text-muted);
        }

        /* Two-column layout on wider screens */

        @media (min-width: 720px) {
            #start-project #contact-form {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            #contact-form input[name="name"],
            #contact-form input[name="email"],
            #contact-form input[name="topic"],
            #contact-form input[name="timeframe"] {
                grid-column: span 1;
            }

            #contact-form textarea,
            #contact-form button[type="submit"],
            #form-response {
                grid-column: 1 / -1;
            }
        }

    </style>


    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ProfessionalService",
      "name": "Rocket Science Designs",
      "url": "https://rocketsciencedesigns.com/",
      "image": "https://rocketsciencedesigns.com/assets/rocket-logo-26.png",
      "description": "Web design, branding, Shopify development, email marketing, photography, and video production for small businesses and growing brands.",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Winnipeg",
        "addressRegion": "MB",
        "addressCountry": "CA"
      },
      "areaServed": "CA"
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
