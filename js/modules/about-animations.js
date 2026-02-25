// ABOUT PAGE ANIMATIONS
export function aboutAnimation(){
    if (document.querySelector("#about")) {
        gsap.from(".profile-photo img", {
            opacity: 0,
            y: 40,
            scale: 0.9,
            duration: 1.3,
            ease: "power3.out"
        });

        gsap.from("#about h3", {
            opacity: 0,
            y: 25,
            duration: 1.1,
            ease: "power3.out",
            delay: 0.2
        });
    }
}