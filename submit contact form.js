
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
        if (res.ok) {
          const modal = document.getElementById('form-success-modal');
          document.getElementById('form-success-text').innerText = text;
          modal.classList.remove('is-fading');
          modal.hidden = false;
          form.reset();
          setTimeout(function () {
            modal.classList.add('is-fading');
            setTimeout(function () {
              modal.hidden = true;
              modal.classList.remove('is-fading');
            }, 600);
          }, 7000);
        } else {
          responseEl.innerText = text;
        }
      } catch (err) {
        responseEl.innerText = 'Sorry, something went wrong. Please email me directly.';
      }
    });
  }
