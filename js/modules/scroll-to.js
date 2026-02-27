import gsap from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger.js";
import { ScrollToPlugin } from "gsap/ScrollToPlugin.js";

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

export function scrollTo() {
    const heroArrow = document.querySelector("#hero-arrow");

    if (heroArrow) {
        heroArrow.addEventListener("click", function () {
            gsap.to(window, {
                duration: 1.5,
                scrollTo: {
                    y: "#project-scroll",
                    offsetY: 100
                },
                ease: "power1.out"
            });
        });
    }
}