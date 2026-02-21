/* =======================
   COUNTER ANIMASI
======================= */

function animateCounter(counter) {
    const target = +counter.dataset.target;
    const duration = 1500; // ms
    const stepTime = 20;
    const increment = Math.ceil(target / (duration / stepTime));

    let current = 0;

    const update = () => {
        current += increment;

        if (current >= target) {
            counter.textContent = target;
        } else {
            counter.textContent = current;
            setTimeout(update, stepTime);
        }
    };

    update();
}

function animateDecimalCounter(counter) {
    const target = parseFloat(counter.dataset.target);
    const decimals = parseInt(counter.dataset.decimals) || 0;
    const duration = 1500; // ms
    const stepTime = 20;
    const steps = duration / stepTime;
    const increment = target / steps;

    let current = 0;

    const update = () => {
        current += increment;
        if (current >= target) {
            counter.textContent = target.toFixed(decimals);
        } else {
            counter.textContent = current.toFixed(decimals);
            setTimeout(update, stepTime);
        }
    };

    update();
}

export function initCounters() {
    // ambil semua counter (integer + decimal)
    const counters = document.querySelectorAll(".counter, .counter-decimal");

    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    if (el.classList.contains("counter")) {
                        animateCounter(el);
                    } else if (el.classList.contains("counter-decimal")) {
                        animateDecimalCounter(el);
                    }
                    obs.unobserve(el); // hanya jalan sekali
                }
            });
        },
        { threshold: 0.5 }, // 50% terlihat baru jalan
    );

    counters.forEach((c) => observer.observe(c));
}
