// SCROLL TO PROJECTS
export function scrollTo() {
    gsap.registerPlugin(ScrollToPlugin);

    const heroArrow = document.querySelector("#hero-arrow");
    if (heroArrow) {
        heroArrow.addEventListener("click", function () {
            gsap.to(window, {
                duration: 1.5,
                scrollTo: {
                    y: "#project-scroll",
                    offsetY: 100,
                    ease: "power1.out"
                }
            });
        });
    }

// GSAP PAGE ANIMATIONS
    gsap.registerPlugin(ScrollTrigger);
}