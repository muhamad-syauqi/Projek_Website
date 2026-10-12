document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.getElementById('detail-gallery');
    const next = document.getElementById('detail-next');
    if (!gallery || !next) return;

    // Geser satu foto per klik; di ujung kanan, kembali ke awal
    next.addEventListener('click', () => {
        const item = gallery.querySelector('img');
        const step = item ? item.getBoundingClientRect().width + 16 : 240;
        const atEnd = gallery.scrollLeft + gallery.clientWidth >= gallery.scrollWidth - 4;

        gallery.scrollTo({
            left: atEnd ? 0 : gallery.scrollLeft + step,
            behavior: 'smooth',
        });
    });
});