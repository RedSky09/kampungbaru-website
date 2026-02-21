/**
 * @param {number} offset
 * @param {number} duration
 */
export function initSmoothScroll(offset = 0, duration = 700) {
    document
        .querySelectorAll('a[href^="#"]:not([href="#"])')
        .forEach((anchor) => {
            anchor.addEventListener("click", function (e) {
                e.preventDefault();

                const target = document.querySelector(
                    this.getAttribute("href"),
                );
                if (!target) return;

                const start = document.documentElement.scrollTop;
                const end = target.getBoundingClientRect().top + start - offset;
                const distance = end - start;
                let startTime = null;

                function easeInOutCubic(t) {
                    return t < 0.5
                        ? 4 * t * t * t
                        : 1 - Math.pow(-2 * t + 2, 3) / 2;
                }

                function step(timestamp) {
                    if (!startTime) startTime = timestamp;

                    const elapsed = timestamp - startTime;
                    const progress = Math.min(elapsed / duration, 1);
                    const ease = easeInOutCubic(progress);

                    document.documentElement.scrollTop =
                        start + distance * ease;

                    if (progress < 1) {
                        requestAnimationFrame(step);
                    }
                }

                requestAnimationFrame(step);
            });
        });
}
