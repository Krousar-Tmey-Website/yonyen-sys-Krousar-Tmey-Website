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
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-reveal]').forEach((el) => revealObserver.observe(el));
    });
}
