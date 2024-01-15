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

const slides = document.querySelectorAll(".slide");

let maxSlide = slides.length - 1;

let curSlide = 0;

slides.forEach((slide, indx) => {
    slide.style.transform = `translateX(${indx * 100}%)`;
});

let nextSlide = document.querySelector("#btn-next");

nextSlide.addEventListener("click", function () {
    if (curSlide === maxSlide) {
        curSlide = 0;
    } else {
        curSlide++;
    }

    slides.forEach((slide, indx) => {
        slide.style.transform = `translateX(${100 * (indx - curSlide)}%)`;
    });
});

const prevSlide = document.querySelector("#btn-prev");

prevSlide.addEventListener("click", function () {
    if (curSlide === 0) {
        curSlide = maxSlide;
    } else {
        curSlide--;
    }

    slides.forEach((slide, indx) => {
        slide.style.transform = `translateX(${100 * (indx - curSlide)}%)`;
    });
});

let slideIndex = 1;
showSlides(slideIndex);

function currentSlide(n) {
    showSlides(slideIndex = n);
}