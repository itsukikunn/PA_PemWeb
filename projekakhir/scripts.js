const images = [
    "uploads/banner1.png",
    "uploads/banner4.png", 
    "uploads/banner5.png"
];
let currentIndex = 0;

function changeBanner() {
    const banner = document.getElementById("bannerLarge");
    currentIndex = (currentIndex + 1) % images.length;
    banner.src = images[currentIndex];
}

setInterval(changeBanner, 3000);