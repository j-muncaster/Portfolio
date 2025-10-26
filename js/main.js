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
    player.currentTime = 1;
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
videoControls.addEventListener("mouse-enter", showControls);
videoControls.addEventListener("mouse-leave", hideControls);
player.addEventListener("mouse-enter", showControls);
player.addEventListener("mouse-leave", hideControls);


// LIGHTBOX

const triggers = document.querySelectorAll(".lightbox-trigger");
const lightbox = document.querySelector("lightbox");
const lightboxImg = lightbox.querySelector(".lightbox-image");
const closeBtn = lightbox.querySelector(".close");

triggers.forEach(trigger => {
    trigger.addEventListener("click", (event) => {
      event.preventDefault();
      lightbox.classList.add("active");
      lightboxImg.src = trigger.src;
    });
});

closeBtn.addEventListener("click", () => {
    lightbox.classList.remove("active");
    lightboxImg.src = "";
});