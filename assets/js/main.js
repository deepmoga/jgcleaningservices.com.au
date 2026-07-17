(() => {
    'use strict';

    const header = document.querySelector('#site-header');
    const nav = document.querySelector('#primary-nav');
    const navToggle = document.querySelector('.nav-toggle');
    const backToTop = document.querySelector('.back-to-top');

    const updateHeader = () => {
        const scrolled = window.scrollY > 24;
        header?.classList.toggle('is-scrolled', scrolled);
        backToTop?.classList.toggle('is-visible', window.scrollY > 650);

        if (header && nav) {
            const topbarHeight = document.querySelector('.topbar')?.offsetHeight || 0;
            document.documentElement.style.setProperty('--nav-top', `${header.offsetHeight + topbarHeight + 8}px`);
        }
    };

    updateHeader();
    window.addEventListener('scroll', updateHeader, { passive: true });
    window.addEventListener('resize', updateHeader, { passive: true });

    const closeMenu = () => {
        if (!nav || !navToggle) return;
        nav.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
        navToggle.setAttribute('aria-label', 'Open navigation menu');
        document.body.classList.remove('nav-open');
    };

    navToggle?.addEventListener('click', () => {
        const willOpen = !nav?.classList.contains('is-open');
        nav?.classList.toggle('is-open', willOpen);
        navToggle.setAttribute('aria-expanded', String(willOpen));
        navToggle.setAttribute('aria-label', willOpen ? 'Close navigation menu' : 'Open navigation menu');
        document.body.classList.toggle('nav-open', willOpen);
    });

    nav?.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeMenu();
    });
    document.addEventListener('click', (event) => {
        if (nav?.classList.contains('is-open') && !nav.contains(event.target) && !navToggle?.contains(event.target)) closeMenu();
    });

    backToTop?.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    // Scroll reveal animations.
    const revealItems = document.querySelectorAll('.reveal:not(.is-visible)');
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -35px' });
        revealItems.forEach((item) => revealObserver.observe(item));
    } else {
        revealItems.forEach((item) => item.classList.add('is-visible'));
    }

    // Count-up figures in the trust strip.
    const counters = document.querySelectorAll('[data-counter]');
    const runCounter = (counter) => {
        const target = Number(counter.dataset.counter || 0);
        const duration = 1000;
        const startTime = performance.now();

        const tick = (now) => {
            const progress = Math.min((now - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            counter.textContent = Math.round(target * eased).toString();
            if (progress < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };

    if ('IntersectionObserver' in window) {
        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) return;
                runCounter(entry.target);
                observer.unobserve(entry.target);
            });
        }, { threshold: 0.65 });
        counters.forEach((counter) => counterObserver.observe(counter));
    } else {
        counters.forEach(runCounter);
    }

    // Accessible testimonial slider.
    const reviewCards = Array.from(document.querySelectorAll('[data-review-card]'));
    let activeReview = 0;
    let reviewTimer;

    const showReview = (index) => {
        if (!reviewCards.length) return;
        activeReview = (index + reviewCards.length) % reviewCards.length;
        reviewCards.forEach((card, cardIndex) => {
            const isActive = cardIndex === activeReview;
            card.classList.toggle('is-active', isActive);
            card.setAttribute('aria-hidden', String(!isActive));
        });
    };

    const restartReviewTimer = () => {
        window.clearInterval(reviewTimer);
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            reviewTimer = window.setInterval(() => showReview(activeReview + 1), 7000);
        }
    };

    document.querySelector('[data-review-prev]')?.addEventListener('click', () => {
        showReview(activeReview - 1);
        restartReviewTimer();
    });
    document.querySelector('[data-review-next]')?.addEventListener('click', () => {
        showReview(activeReview + 1);
        restartReviewTimer();
    });
    showReview(0);
    restartReviewTimer();

    // Friendly client-side validation; PHP repeats essential validation.
    const quoteForm = document.querySelector('[data-quote-form]');
    quoteForm?.addEventListener('submit', (event) => {
        const requiredFields = quoteForm.querySelectorAll('[required]');
        let firstInvalid = null;

        requiredFields.forEach((field) => {
            const invalid = !field.checkValidity();
            field.classList.toggle('is-invalid', invalid);
            if (invalid && !firstInvalid) firstInvalid = field;
        });

        if (firstInvalid) {
            event.preventDefault();
            firstInvalid.focus();
            firstInvalid.reportValidity();
        }
    });

    quoteForm?.querySelectorAll('input, select, textarea').forEach((field) => {
        field.addEventListener('input', () => field.classList.remove('is-invalid'));
        field.addEventListener('change', () => field.classList.remove('is-invalid'));
    });
})();
