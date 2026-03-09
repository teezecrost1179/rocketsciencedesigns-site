<?php
$pageTitle = 'Web Design FAQ Winnipeg | Questions | Rocket Science Designs';
include 'header.php';
?>
<main>

    <!-- WEBSITE DESIGN FAQ -->
    <section id="website-design-faq" class="section">
        <div class="max-width">
            <div class="section-header">
                <div class="section-kicker">WEBSITE DESIGN FAQ</div>
                <h1 class="section-title">
                    Website design questions, answered.
                </h1>
            </div>

            <p>
                Have questions about working with a web designer in Winnipeg or anywhere in Canada? 
                Here are clear, straight answers to some of the most common things people ask me 
                before we start a project together.
            </p>

            <div class="faq-list">

                <article class="faq-item" id="faq-website-cost">
                    <h2>How much does a small business website cost?</h2>
                    <p>
                        Most small business websites I design for Winnipeg and Canadian clients typically fall into a range 
                        based on complexity, content volume, and any special features you need. After a quick discovery call, 
                        I’ll give you a clear, no-surprises quote and outline exactly what’s included.
                    </p>
                </article>

                <article class="faq-item" id="faq-website-timeline">
                    <h2>How long does it take to build and launch my website?</h2>
                    <p>
                        For most small business websites, the full process—from discovery to launch—takes around 3–6 weeks. 
                        Timelines depend on how quickly content and feedback are provided, and whether we’re doing a simple 
                        refresh or a full ground-up build.
                    </p>
                </article>

            </div>
        </div>
    </section>

    <!-- FAQ SCHEMA MARKUP -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How much does a small business website cost?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Most small business websites I design for Winnipeg and Canadian clients typically fall into a range based on complexity, content volume, and any special features you need. After a quick discovery call, I’ll give you a clear, no-surprises quote and outline exactly what’s included."
          }
        },
        {
          "@type": "Question",
          "name": "How long does it take to build and launch my website?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "For most small business websites, the full process—from discovery to launch—takes around 3–6 weeks. Timelines depend on how quickly content and feedback are provided, and whether we’re doing a simple refresh or a full ground-up build."
          }
        }
      ]
    }
    </script>

    <?php include 'rocket-contact-form.php'; ?>

</main>
<?php include 'footer.php'; ?>
