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
});
