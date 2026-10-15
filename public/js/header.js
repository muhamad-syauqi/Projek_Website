(function () {
    var header = document.querySelector('.site-header.paket-header');
    if (!header) return;

    var ticking = false;

    function update() {
        header.classList.toggle('is-scrolled', window.scrollY > 24);
        ticking = false;
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
            window.requestAnimationFrame(update);
            ticking = true;
        }
    }, { passive: true });

    update();
})();