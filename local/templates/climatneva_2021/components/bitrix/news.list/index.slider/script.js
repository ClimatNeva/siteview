domReadyQueue.push(function(){
    $('.slider-carousel').owlCarousel({
        loop: true,
        margin: 0,
        lazyLoad: true,
        dots: true,
        nav: false,
        items: 1,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true
    });
})