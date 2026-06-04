document.addEventListener('DOMContentLoaded', () => {
    if (typeof jQuery === 'undefined') {
        return;
    }

    const sliders = document.querySelectorAll('.slider-track');

    if (!sliders.length) {
        return;
    }

    jQuery(sliders).slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });
});