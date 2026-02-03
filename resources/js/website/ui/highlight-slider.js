import { id, $$ } from '../../core/dom';
import { ready, on } from '../../core/event';

ready(() => {
    const slider = id('highlight-slider');
    const slidesTrack = id('highlight-slides');
    if (!slider || !slidesTrack) return;

    const slides = $$('.highlight-slide', slidesTrack);
    if (slides.length <= 1) return;

    const prevBtn = id('highlight-prev');
    const nextBtn = id('highlight-next');
    const indicatorsContainer = id('highlight-indicators');
    const indicators = indicatorsContainer ? $$('button[data-slide]', indicatorsContainer) : [];

    let index = 0;
    const intervalMs = 3000; // Hardcoded to 3s for consistency, ignoring data attribute if needed or update default
    let timer = null;

    const clampIndex = (next) => {
        const total = slides.length;
        return ((next % total) + total) % total;
    };

    const render = () => {
        slidesTrack.style.transform = `translateX(-${index * 100}%)`;

        if (indicators.length > 0) {
            indicators.forEach((btn) => {
                const i = Number(btn.dataset.slide || 0);
                const active = i === index;
                if (active) {
                    btn.classList.add('bg-white');
                    btn.classList.remove('bg-white/50');
                } else {
                    btn.classList.remove('bg-white');
                    btn.classList.add('bg-white/50');
                }
            });
        }
    };

    const goTo = (next) => {
        index = clampIndex(next);
        render();
    };

    const stopAuto = () => {
        if (timer) {
            clearInterval(timer);
            timer = null;
        }
    };

    const startAuto = () => {
        stopAuto();
        timer = setInterval(() => {
            goTo(index + 1);
        }, intervalMs);
    };

    const restartAuto = () => {
        startAuto();
    };

    if (prevBtn) {
        on(prevBtn, 'click', (e) => {
            e.preventDefault();
            goTo(index - 1);
            restartAuto();
        });
    }

    if (nextBtn) {
        on(nextBtn, 'click', (e) => {
            e.preventDefault();
            goTo(index + 1);
            restartAuto();
        });
    }

    if (indicatorsContainer) {
        on(indicatorsContainer, 'click', 'button[data-slide]', function (e) {
            e.preventDefault();
            const next = Number(this.dataset.slide || 0);
            goTo(next);
            restartAuto();
        });
    }

    render();

    startAuto();

    // DISABLED: Pause on hover as requested
    // on(slider, 'mouseenter', () => stopAuto());
    // on(slider, 'mouseleave', () => startAuto());
    // on(slider, 'focusin', () => stopAuto());
    // on(slider, 'focusout', () => startAuto());

    on(document, 'visibilitychange', () => {
        if (document.hidden) stopAuto();
        else startAuto();
    });
});
