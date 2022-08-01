domReadyQueue.push(function(){
    $('.linked-hover').mouseover(function(){
        $('.linked-hover[data-decision="' + $(this).data('decision') + '"]').addClass('hovered');
    })

    $('.linked-hover').mouseout(function(){
        $('.linked-hover[data-decision="' + $(this).data('decision') + '"]').removeClass('hovered');
    })
})