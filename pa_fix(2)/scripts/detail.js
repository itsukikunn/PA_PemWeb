// Deskripsi Lengkap
const isiDeskripsi = document.querySelector('.isi-deskripsi');
const button = document.querySelector('.selengkapnya');
var open = false;
if (isiDeskripsi.scrollHeight <= isiDeskripsi.clientHeight) {
    button.style.display = 'none';
} else {
    button.addEventListener('click', () => {
        if (!open) {
            isiDeskripsi.style.maxHeight = 'none';
            button.textContent = 'Lihat lebih sedikit';
            open = true;
        } else {
            isiDeskripsi.style.maxHeight = '100px';
            button.textContent = 'Baca Selengkapnya';
            open = false;
        }
    });
}
