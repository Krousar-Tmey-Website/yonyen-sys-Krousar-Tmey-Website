import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';

Alpine.plugin(focus);
Alpine.plugin(collapse);
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
