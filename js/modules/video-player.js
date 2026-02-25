// VIDEO PLAYER CONTROLS
export function videoPlayer() {
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
}