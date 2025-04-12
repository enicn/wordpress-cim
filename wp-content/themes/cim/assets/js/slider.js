/**
 * Carousel/Slider functionality for CIM theme
 */
jQuery(document).ready(function($) {
    // Initialize the carousel
    $('.cim-carousel').slick({
        dots: true,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>'
    });
});