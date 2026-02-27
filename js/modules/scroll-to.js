// SCROLL TO PROJECTS
export function scrollTo() {
    gsap.registerPlugin(ScrollToPlugin);

    function scrollToProjects() {
        gsap.to(window, {
            duration: 1.5,
            scrollTo: {
                y: "#project-scroll",
                offsetY: 100
            },
            ease: "power1.out"
        });
    }

    const heroArrow = document.querySelector("#hero-arrow");
    if (heroArrow) {
        heroArrow.addEventListener("click", function (e) {
            e.preventDefault();
            scrollToProjects();
        });
    }

    const projectLinks = document.querySelectorAll(".scroll-projects");
    projectLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            scrollToProjects();
        });
    });

    if (window.location.hash === "#project-scroll") {
        setTimeout(() => {
            scrollToProjects();
        }, 100);
    }
}