// HERO LOGO ANIMATION (Homepage only)
export function heroAnimation() {
    if (document.querySelector("#hero-logo")) {
        gsap.from("#hero-logo", {
            opacity: 0,
            y: -40,
            scale: 0.85,
            duration: 1.2,
            ease: "power3.out"
        });

        gsap.from("#text-hero", {
            opacity: 0,
            y: 20,
            duration: 1,
            delay: 0.4,
            ease: "power2.out"
        });

        gsap.from("#hero-squiggle", {
            opacity: 0,
            y: 80,
            duration: 1.8,
            ease: "power3.out"
        });
    }
}