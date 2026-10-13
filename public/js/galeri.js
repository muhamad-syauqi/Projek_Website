document.addEventListener('DOMContentLoaded', () => {
    const box = document.getElementById('lightbox');
    const img = document.getElementById('lightbox-img');
    const caption = document.getElementById('lightbox-caption');
    const close = document.getElementById('lightbox-close');
    if (!box || !img) return;

    const open = (src, text) => {
        img.src = src;
        img.alt = text || '';
        caption.textContent = text || '';
        box.hidden = false;
        document.body.classList.add('lightbox-open');
        close.focus();
    };

    const hide = () => {
        box.hidden = true;
        img.src = '';
        document.body.classList.remove('lightbox-open');
    };

    document.querySelectorAll('.galeri-photo').forEach((btn) => {
        btn.addEventListener('click', () => open(btn.dataset.full, btn.dataset.caption));
    });

    close.addEventListener('click', hide);

    // Klik area gelap di luar foto untuk menutup
    box.addEventListener('click', (event) => {
        if (event.target === box) hide();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !box.hidden) hide();
    });
});