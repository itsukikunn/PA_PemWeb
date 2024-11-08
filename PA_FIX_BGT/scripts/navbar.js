document.getElementById("hamburger").addEventListener("click", function () {
    const headerButtons = document.querySelector(".header-buttons");
    if (headerButtons) {
        headerButtons.classList.toggle("active");
    }
})