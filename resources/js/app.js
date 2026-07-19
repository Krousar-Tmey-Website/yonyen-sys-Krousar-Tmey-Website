import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

Alpine.plugin(focus);
window.Alpine = Alpine;
Alpine.start();

// ── Scroll-reveal animations ──
// Fades/slides [data-reveal] elements into view as they cross the viewport.
// Skipped entirely for users who prefer reduced motion (CSS already forces
// them visible in that case too, so this is just a perf short-circuit).
if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches && 'IntersectionObserver' in window) {
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
            } else {
                // Remove the class when scrolled out of view so it animates again
                entry.target.classList.remove('is-revealed');
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

    document.addEventListener('DOMContentLoaded', () => {
        // Auto-tag each direct child of a rendered article body so long-form
        // news content (paragraphs, images, lists, embeds) animates in one by
        // one, without requiring data-reveal to be hand-authored into stored HTML.
        document.querySelectorAll('.article-content').forEach((container) => {
            Array.from(container.children).forEach((el, index) => {
                if (!el.hasAttribute('data-reveal')) {
                    el.setAttribute('data-reveal', 'up');
                    el.style.setProperty('--reveal-delay', Math.min(index * 60, 400));
                }
            });
        });

        document.querySelectorAll('[data-reveal]').forEach((el) => revealObserver.observe(el));
    });
}

// ── Staggered card reveal (once-only) ──
// Fades/slides [data-reveal-card] elements sequentially as they enter
// the viewport. Unlike [data-reveal], this observer unobserves after
// the first trigger, so the animation only plays once per card.
if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches && 'IntersectionObserver' in window) {
    const cardRevealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-card-revealed');
                cardRevealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-reveal-card]').forEach((el) => cardRevealObserver.observe(el));
    });
}

// ── Timeline year navigator scrollspy ──
// Highlights the year in the sidebar nav that matches the card currently in view.
if ('IntersectionObserver' in window) {
    const yearNavObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            const year = entry.target.getAttribute('data-year-anchor');
            const link = document.querySelector(`[data-year-nav="${year}"]`);
            if (link) {
                link.classList.toggle('is-active', entry.isIntersecting);
            }
        });
    }, { rootMargin: '-20% 0px -60% 0px' });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-year-anchor]').forEach((el) => yearNavObserver.observe(el));
    });
}
