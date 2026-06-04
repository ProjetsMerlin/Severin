document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.querySelector('.gallery');

    if (!gallery) {
        return;
    }

    if (typeof GLightbox === 'undefined') {
        return;
    }

    GLightbox({
        selector: '.gallery-lightbox',
        touchNavigation: true,
        keyboardNavigation: true,
        closeOnOutsideClick: true,
        loop: true,
        zoomable: true,
        draggable: true,
        openEffect: 'zoom',
        closeEffect: 'zoom',
        slideEffect: 'slide'
    });
});