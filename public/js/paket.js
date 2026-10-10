
document.addEventListener('DOMContentLoaded', () => {
    // Filter kategori paket
    const filterButtons = document.querySelectorAll('.filter-btn');
    const paketCards = document.querySelectorAll('.paket-card');

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const category = button.dataset.filter;

            filterButtons.forEach((item) => {
                item.classList.remove('active');
            });

            button.classList.add('active');

            paketCards.forEach((card) => {
                const show = category === 'semua' ||
                    card.dataset.category === category;

                card.hidden = !show;
            });
        });
    });

    // Pilih paket dan konsultasi melalui WhatsApp
    const whatsappNumber = '6281234567890';

    document.querySelectorAll('[data-package]').forEach((link) => {
        link.addEventListener('click', (event) => {
            event.preventDefault();

            const packageName = link.dataset.package;
            const message =
                `Halo Fahira Wedding, saya ingin konsultasi mengenai ${packageName}.`;

            const whatsappUrl =
                `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;

            window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
        });
    });
});
