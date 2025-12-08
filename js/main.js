(() => {

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
    
    // VIDEO PLAYER

    const playerCon = document.querySelector("#player-container");
    const player = document.querySelector("video");
    const videoControls = document.querySelector("#video-controls");
    const playButton = document.querySelector("#play-button");
    const pauseButton = document.querySelector("#pause-button");
    const stopButton = document.querySelector("#stop-button");
    const volumeSlider = document.querySelector("#change-vol");
    const fullScreen = document.querySelector("#full-screen");

    // Functions
    function playVideo() {
        console.log("Play Video Called!");
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
        console.log(volumeSlider.value);
        player.volume = volumeSlider.value
    }

    function toggleFullScreen() {
        if(document.fullscreenElement) {
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

    // Event Listeners
    playButton.addEventListener("click", playVideo);
    pauseButton.addEventListener("click", pauseVideo);
    stopButton.addEventListener("click", stopVideo);
    volumeSlider.addEventListener("change", changeVolume);
    fullScreen.addEventListener("click", toggleFullScreen);
    videoControls.addEventListener("mouseenter", showControls);
    videoControls.addEventListener("mouseleave", hideControls);
    player.addEventListener("mouseenter", showControls);
    player.addEventListener("mouseleave", hideControls);

})();