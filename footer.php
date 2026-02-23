    <footer class="site-footer">
        <div class="max-width footer-inner">
            <div class="footer-small">
                © <?php echo date('Y'); ?> Rocket Science Designs. All rights reserved.
            </div>

            <!-- Footer nav: mirror top-level header nav -->
            <div class="footer-nav">
                <a href="/#about">About</a>
                <a href="/#services">Services</a>
                <a href="https://rocketreception.ca" target="_blank" rel="noopener noreferrer">Rocket Reception</a>
                <a href="/my-work-winnipeg">Work</a>
                <a href="/#start-project">Contact</a>
            </div>
        </div>
    </footer>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.documentElement.classList.add('has-js');

    const navToggle = document.querySelector('.nav-toggle');
    const mainNav   = document.querySelector('.main-nav');
    const header    = document.querySelector('.site-header');

    if (!navToggle || !mainNav || !header) return;

    const mobileQuery = window.matchMedia('(max-width: 900px)');

    // Main mobile nav toggle (hamburger)
    navToggle.addEventListener('click', function (e) {
        e.stopPropagation();
        const isOpen = mainNav.classList.toggle('is-open');
        navToggle.classList.toggle('is-open', isOpen);
        navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

        if (!isOpen) {
            closeAllSubmenus();
        }
    });

    const items = Array.from(mainNav.querySelectorAll('.nav-item.has-menu'));

    function closeAllSubmenus(except) {
        items.forEach(function (item) {
            if (item === except) return;
            item.classList.remove('open');
            const btn = item.querySelector('.submenu-toggle');
            if (btn) btn.setAttribute('aria-expanded', 'false');
        });
    }

    function toggleSubmenu(item, button, evt) {
        // Only treat as expandable on mobile widths
        if (!mobileQuery.matches) return;

        if (evt) {
            evt.preventDefault();
            evt.stopPropagation();
        }

        const isOpen = item.classList.toggle('open');
        if (button) {
            button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }

        if (isOpen) {
            closeAllSubmenus(item);
        }
    }

    // Submenu toggles (arrow + label on mobile)
    items.forEach(function (item) {
        const btn  = item.querySelector('.submenu-toggle');
        const link = item.querySelector('.nav-link');
        const headerRow = item.querySelector('.nav-item-header');

        // Click on arrow
        if (btn) {
            btn.addEventListener('click', function (e) {
                toggleSubmenu(item, btn, e);
            });
        }

        // Click on the text link should open submenu on mobile instead of navigating
        if (link) {
            link.addEventListener('click', function (e) {
                toggleSubmenu(item, btn, e);
            });
        }

        // (Optional) click anywhere in the row (padding area)
        if (headerRow) {
            headerRow.addEventListener('click', function (e) {
                // Avoid double-handling if the click was already on the button
                if (e.target.closest('.submenu-toggle')) return;
                if (e.target.closest('.nav-link')) return; // handled above
                toggleSubmenu(item, btn, e);
            });
        }
    });

    // When switching between mobile/desktop, close any open submenus
    if (mobileQuery.addEventListener) {
        mobileQuery.addEventListener('change', function () {
            closeAllSubmenus();
        });
    } else if (mobileQuery.addListener) {
        // older browsers
        mobileQuery.addListener(function () {
            closeAllSubmenus();
        });
    }

    // Close whole nav when any link inside it is clicked (normal behavior)
    mainNav.addEventListener('click', function (e) {
        if (e.target.closest('a')) {
            mainNav.classList.remove('is-open');
            navToggle.classList.remove('is-open');
            navToggle.setAttribute('aria-expanded', 'false');
            closeAllSubmenus();
        }
    });

    // Close nav when clicking outside of the header
    document.addEventListener('click', function (e) {
        if (!mainNav.classList.contains('is-open')) return;
        if (!header.contains(e.target)) {
            mainNav.classList.remove('is-open');
            navToggle.classList.remove('is-open');
            navToggle.setAttribute('aria-expanded', 'false');
            closeAllSubmenus();
        }
    });
});
</script>

<script src="submit contact form.js"></script>


</body>
</html>
