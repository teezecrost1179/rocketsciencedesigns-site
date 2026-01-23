<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$isHome = $currentPage === 'index.php';
$linkPrefix = $isHome ? '' : 'index.php';
?>
<footer style="background:#eee; text-align:center; padding:1.5rem;">
  <nav style="margin-bottom: 1rem;">
    <div class="footer-links">
      <a href="<?= $linkPrefix ?>#services">Services</a>
      <a href="portfolio.php">Portfolio</a>
      <a href="<?= $linkPrefix ?>#about">About</a>
      <a href="<?= $linkPrefix ?>#contact">Contact</a>
      <a href="<?= $linkPrefix ?>#contact" class="cta-button">Start a Project</a>
    </div>
  </nav>
  <p style="font-size: 0.9rem;">&copy; 2025 Rocket Science Designs — Serving Winnipeg businesses with freelance digital services built for today.</p>

  <style>
    .footer-links {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .footer-links a {
      color: #333;
      text-decoration: none;
      font-weight: 500;
      font-size: 0.95rem;
    }

    @media (max-width: 600px) {
      footer {
        padding: 2rem 1rem;
      }

      .footer-links {
        flex-direction: column;
        gap: 0.75rem;
      }

      .footer-links a {
        font-size: 1rem;
      }
    }
  </style>
</footer>


<script>
  const menuButton = document.getElementById('mobile-menu-button');
  const menuOverlay = document.getElementById('mobile-menu-overlay');

  menuButton.addEventListener('click', () => {
    const isOpen = menuOverlay.style.display === 'block';
    menuOverlay.style.display = isOpen ? 'none' : 'block';
    document.body.classList.toggle('menu-open', !isOpen);
  });

  menuOverlay.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      menuOverlay.style.display = 'none';
      document.body.classList.remove('menu-open');
    });
  });

  const contactForm = document.getElementById('contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', async function (e) {
      e.preventDefault();
      const form = e.target;
      const formData = new FormData(form);
      const responseEl = document.getElementById('form-response');
      try {
        const res = await fetch('/submit.php', {
          method: 'POST',
          body: formData,
        });
        const text = await res.text();
        responseEl.innerText = text;
        form.reset();
      } catch (err) {
        responseEl.innerText = 'Sorry, something went wrong. Please email me directly.';
      }
    });
  }
</script>
</body>
</html>
