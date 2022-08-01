domReadyQueue.push(function(){
    $('.brands__carousel').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        nav: false,
        autoplay: false,
        responsive: {
            0: {items: 3},
            500: {items: 4},
            768: {items: 5},
            992: {items: 6}
        }
    });
})