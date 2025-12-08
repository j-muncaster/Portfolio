(() => {
    console.log("IIFE Loaded");

    // MAIN HAMBURGER (Homepage)
    const hamburger = document.querySelector("#hamburger");
    const mobileMenu = document.querySelector("#mobile-menu");

    if (hamburger && mobileMenu) {

        function toggleMenu() {
            mobileMenu.classList.toggle("open");
            hamburger.classList.toggle("active");
        }

        hamburger.addEventListener("click", toggleMenu);

        mobileMenu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", toggleMenu);
        });
    }

    // INNER HAMBURGER (Subpages)
    const innerHamburger = document.querySelector("#inner-hamburger");
    const innerMobileMenu = document.querySelector("#inner-mobile-menu");

    if (innerHamburger && innerMobileMenu) {

        function toggleInnerMenu() {
            innerMobileMenu.classList.toggle("open");
            innerHamburger.classList.toggle("active");
        }

        innerHamburger.addEventListener("click", toggleInnerMenu);

        innerMobileMenu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", toggleInnerMenu);
        });
    }

    // SCROLL TO PROJECTS
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

    // VIDEO PLAYER CONTROLS
    const playerCon = document.querySelector("#player-container");
    const player = document.querySelector("video");
    const videoControls = document.querySelector("#video-controls");

    const playButton = document.querySelector("#play-button");
    const pauseButton = document.querySelector("#pause-button");
    const stopButton = document.querySelector("#stop-button");
    const volumeSlider = document.querySelector("#change-vol");
    const fullScreen = document.querySelector("#full-screen");

    if (player) {

        function playVideo() {
            player.play();
        }

        function pauseVideo() {
            player.pause();
        }

        function stopVideo() {
            player.pause();
            player.currentTime = 0;
        }

        function changeVolume() {
            player.volume = volumeSlider.value;
        }

        function toggleFullScreen() {
            if (document.fullscreenElement) {
                document.exitFullscreen();
            } else {
                playerCon.requestFullscreen();
            }
        }

        function hideControls() {
            videoControls.classList.add('hide');
        }

        function showControls() {
            videoControls.classList.remove('hide');
        }

        // Listeners
        playButton?.addEventListener("click", playVideo);
        pauseButton?.addEventListener("click", pauseVideo);
        stopButton?.addEventListener("click", stopVideo);
        volumeSlider?.addEventListener("change", changeVolume);
        fullScreen?.addEventListener("click", toggleFullScreen);

        videoControls?.addEventListener("mouseenter", showControls);
        videoControls?.addEventListener("mouseleave", hideControls);

        player?.addEventListener("mouseenter", showControls);
        player?.addEventListener("mouseleave", hideControls);
    }

    // GSAP PAGE ANIMATIONS
    gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

    // HERO LOGO ANIMATION (Homepage only)
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

    // PROJECT PAGE ANIMATIONS
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

        gsap.utils.toArray('img[src*="orbitz_project_hero.jpg"], img[src*="orbitz_cans.jpg"]').forEach(img => {
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

    // ABOUT PAGE ANIMATIONS
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

    // CONTACT PAGE ANIMATIONS
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

})();