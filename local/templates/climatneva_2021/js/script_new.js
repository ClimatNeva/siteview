$(document).ready(function(){
    scrollWindow();
    $(window).scroll(function(){
        scrollWindow();
    });

    resizeWindow();
    $(window).resize(function(){
        resizeWindow();
    })

    $("a").click(function(event) {
        event.preventDefault();
        if ($(this).attr('href') == '' || $(this).attr('href') == '#') return;
    });
    
	$('#toTop').on("click",function() {
		$('body,html').animate({scrollTop:0},500);
    });

    $('.slider-carousel').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        nav: false,
        items: 1,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true
    });

    $('.certs__carousel').owlCarousel({
        loop: true,
        margin: 20,
        dots: false,
        nav: true,
        items: 3,
        autoplay: false
    });

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

    $('.objects__carousel').owlCarousel({
        loop: true,
        margin: 30,
        dots: false,
        nav: true,
        items: 1,
        autoplay: false,
        responsive: {
            0: {dots: true, nav: false},
            992: {dots: false, nav: true}
        }
    });

    $('.triz__inner').owlCarousel({
        loop: false,
        margin: 0,
        dots: false,
        nav: false,
        items: 1,
        autoplay: false,
        responsive: false,
        onInitialized: function(e) {
            $('.triz__current').text(e.item.index + 1);
            const newBG = $(`.triz__inner .owl-item:eq(${e.item.index}) .triz__item`).data('src');
            $('.triz__right-bg, .triz__left').animate({ 'opacity':'0' },150);
            setTimeout(function(){
                $('.triz__right-bg, .triz__left').css('background-image',`url(${newBG})`);
                $('.triz__right-bg, .triz__left').animate({'opacity':'1'},150);
            }, 150);
        },
        onChanged: function(e) {
            $('.triz__current').text(e.item.index + 1);
            const newBG = $(`.triz__inner .owl-item:eq(${e.item.index}) .triz__item`).data('src');
            $('.triz__right-bg, .triz__left').animate({ 'opacity':'0' },150);
            setTimeout(function(){
                $('.triz__right-bg, .triz__left').css('background-image',`url(${newBG})`);
                $('.triz__right-bg, .triz__left').animate({'opacity':'1'},150);
            }, 150);
        }
    });

    $('.btn-addroom').click(function(){
        const newRoomID = $('.triz__inner .owl-item').length - 2;
        const owlHeight = $('.triz__inner').height();
        const roomTpl = $('.triz__inner .owl-item:eq(0)').html().replaceAll(/\[0\]("|\[)/g,'[' + newRoomID + ']$1');
        $('.triz__inner').owlCarousel('add', roomTpl, newRoomID);
        $(`.triz__inner .owl-item:eq(${newRoomID}) .triz__room-counter`).text(newRoomID + 1);
        $('.triz__inner').height(owlHeight);
        $('.triz__inner').trigger('to.owl.carousel', newRoomID);
        $('.triz__overall').html($('.triz__inner .owl-item').length);
    });

    $(document).on('click', function(e) {
        if ($('.btn-nextslide').is(e.target)) {
            $('.triz__inner').trigger('next.owl.carousel');
        }
    })

    $(document).on('click',function(e){
        if ($('.input__show').is(e.target)) {
            if ($('.input__downlist.opened').length) $('.input__downlist.opened').removeClass('opened');
            $('.input__downlist.' + $(e.target).data('list')).toggleClass('opened');
        } else if ($('.radio-input').is(e.target)) {
            let parent = $(e.target).parents('.input__downlist')[0];
            let value = $(document.getElementById($(e.target).prop('for'))).val();
            $($(parent).children('.input__show')[0]).text(value);
            $(parent).toggleClass('opened');
        } else if ($('.input__downlist.opened').length) {
            $('.input__downlist.opened').removeClass('opened');
        }
    })

    $('.head_mobile__opener').click(function(){
        $('.mobile_header').animate({'left':'0'}, 300);
    })
    
    $('.mobile_close').click(function(){
        $('.mobile_header').animate({'left':'-100vw'}, 300);
    })
})

function resizeWindow() {
    $(".owl-carousel").each(function() {
        $(this).trigger('refresh.owl.carousel');
    });
}

function scrollWindow() {
    if ($(window).scrollTop() > 0) {
        $('body').addClass('fixed');
        $('#toTop').fadeIn();
    } else {
        $('body').removeClass('fixed');
        $('#toTop').fadeOut();
    }
}