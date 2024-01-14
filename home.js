const button = document.querySelector("#musicbtn");
const icon = document.querySelector("#musicbtn > i");
const audio = document.querySelector("audio");

button.addEventListener("click", () => {
    if (audio.paused) {
    audio.volume = 0.2;
    audio.play();
    icon.classList.remove("music-on");
    icon.classList.add("music-off");
    } else {
    audio.pause();
    icon.classList.remove("music-off");
    icon.classList.add("music-on");
    }
});