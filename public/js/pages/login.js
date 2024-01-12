$(document).ready(function () {
    const slider = new Splide('.splide', {
        type: 'loop',
        autoplay: true,
        interval: 3500,
        pagination: false,
        arrows: false,
        cover: true,
        heightRatio: 1,
    });
    slider.mount();
});