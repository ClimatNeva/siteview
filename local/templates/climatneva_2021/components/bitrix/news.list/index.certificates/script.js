domReadyQueue.push(function(){
    $('.certs__carousel').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        nav: true,
        items: 3,
        autoplay: false
    });
})