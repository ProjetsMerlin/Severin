const links = document.querySelectorAll('a[href^="#"]');
links.forEach((link) => {
    link.addEventListener('click', (event) => {
        const anchor = link.getAttribute('href').replace('#', '');
        const target = document.querySelector(`[data-anchor="${anchor}"]` );

        if (!target) {
            return;
        }

        event.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start'});
    });
});