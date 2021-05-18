// Slick slider for articles
$(document).ready(function() {
    $(".articleslideshow").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: true,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            },
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 1,
            },
        }, ],
    });
});

// slick slider Testimonials

$(document).ready(function() {
    $(".testimonialslideshow").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: true,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
            },
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 1,
            },
        }, ],
    });
});