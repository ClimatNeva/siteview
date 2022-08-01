domReadyQueue.push(function(){
    $('.header-search').click(function(e){
        e.stopPropagation();
        if (!$(this).is(e.target)) return;
        let searchWidth = $('.header-container').width() - $('.header-phone').width();
        if ($(window).width() > 1300 && $(window).width() < 1400) searchWidth += 55;
        if ($(this).hasClass('opened')) {
            $('.top-search').animate({'padding':'0','width': '0','overflow':'hidden'},300);
        } else {
            $('.top-search').animate({'padding':'0 15px','width': searchWidth + 'px','overflow':'visible'},300);
        }
        $(this).toggleClass('opened');
    })

    $('.search-close-container').click(function(){
        $('.top-search').animate({'padding':'0','width': '0'},300);
        setTimeout(function(){
            $('.header-search').toggleClass('opened');
            $('#title-search-input').val('');
            $('.title-search-result').html('');
        },300)
    })
})