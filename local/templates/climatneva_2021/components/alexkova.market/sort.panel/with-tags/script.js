$(document).ready(function () {
    $('.current-choice').click(function(){
        $('.all-choices').toggleClass('show');
        $('.current-choice-arrow').toggleClass('up');
    });
    
    $('.choice-link').click(function(event){
        event.preventDefault();
        window.location.assign($(this).data('selectlink'));
    });
    
    $(document).mouseup(function(e){
        if (!$('.all-choices').is(e.target) && $('.all-choices').hasClass('show')) {
            $('.all-choices').removeClass('show');
            $('.current-choice-arrow').removeClass('up');
        }
    })
});