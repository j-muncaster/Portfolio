export function projectAnimation() {
    if (document.querySelector("#project-hero")) {

        gsap.utils.toArray("#project-hero p, #challenge-con p, #solution-con p, #process-con p").forEach(p => {
            gsap.from(p, {
                scrollTrigger: {
                    trigger: p,
                    start: "top 85%",
                },
                opacity: 0,
                y: 30,
                duration: 0.9,
                ease: "power2.out"
            });
        });

        gsap.utils.toArray("#project-hero img").forEach(img => {
            gsap.from(img, {
                scrollTrigger: {
                    trigger: img,
                    start: "top 85%",
                },
                opacity: 0,
                y: 20,
                duration: 1,
                ease: "power2.out"
            });
        });

        console.log("Project page animations are working");
    }
}