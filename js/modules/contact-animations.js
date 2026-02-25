// CONTACT PAGE ANIMATIONS
export function contactAnimation() {
    if (document.querySelector("#contact-hero")) {
        gsap.from("#contact-hero .profile-photo img", {
            opacity: 0,
            y: 40,
            scale: 0.9,
            duration: 1.3,
            ease: "power3.out"
        });

        gsap.from("#contact-hero h3", {
            opacity: 0,
            y: 25,
            duration: 1.1,
            ease: "power3.out",
            delay: 0.2
        });
    }
}