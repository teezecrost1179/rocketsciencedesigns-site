
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
