const gambar = [
    "uploads/banner1.png",
    "uploads/banner4.png",
    "uploads/banner5.png"
];
let indeksSaatIni = 0;

function gantiBanner() {
    const banner = document.getElementById("bannerLarge");
    indeksSaatIni = (indeksSaatIni + 1) % gambar.length;
    banner.src = gambar[indeksSaatIni];
}

setInterval(gantiBanner, 3000);

const kontainerBuku = document.querySelector('.book-container');
let sedangMenarik = false;
let awalX;
let scrollKiri;

kontainerBuku.addEventListener('mousedown', (e) => {
    sedangMenarik = true;
    awalX = e.pageX - kontainerBuku.offsetLeft;
    scrollKiri = kontainerBuku.scrollLeft;
});

kontainerBuku.addEventListener('mouseleave', () => {
    sedangMenarik = false;
});

kontainerBuku.addEventListener('mouseup', () => {
    sedangMenarik = false;
});

kontainerBuku.addEventListener('mousemove', (e) => {
    if (!sedangMenarik) return;
    e.preventDefault();
    const x = e.pageX - kontainerBuku.offsetLeft;
    const pergeseran = (x - awalX) * 2;
    kontainerBuku.scrollLeft = scrollKiri - pergeseran;
});
