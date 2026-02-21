export function initReveal() {
    const elements = document.querySelectorAll("[data-reveal]");

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove("opacity-0", "translate-y-6");
                    entry.target.classList.add("opacity-100", "translate-y-0");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15 },
    );

    elements.forEach((el) => {
        el.classList.add(
            "opacity-0",
            "translate-y-6",
            "transition-all",
            "duration-700",
            "ease-out",
        );

        observer.observe(el);
    });
}
