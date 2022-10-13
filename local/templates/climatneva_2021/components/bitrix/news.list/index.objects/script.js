domReadyQueue.push(function(){
  setTimeout(() => {
    $('.objects__carousel').owlCarousel({
        loop: true,
        margin: 30,
        dots: false,
        nav: true,
        items: 1,
        lazyLoad: true,
        autoplay: false,
        responsive: {
            0: {dots: true, nav: false},
            992: {dots: false, nav: true}
        },
        onInitialized: function(e) {
            const height = $('.objects__carousel .owl-item:eq('+e.item.index+') .objects-slider__item').outerHeight(true);
            $('.objects__carousel.owl-carousel').height(height);
        },
        onChanged: function(e) {
            const height = $('.objects__carousel .owl-item:eq('+e.item.index+') .objects-slider__item').outerHeight(true);
            $('.objects__carousel.owl-carousel').height(height);
        }
    });
  }, docDelay ?? 3000);
})