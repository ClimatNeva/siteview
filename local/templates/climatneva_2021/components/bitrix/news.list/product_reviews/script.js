let radioChecked = '';
$(document).ready(function(){
    $('.bxr-btn-get-reviews').click(function(){
        options = {
            ID: $(this).data('itemid'),
            SHOWALL_1: 1
        }
        $.ajax('/include/catalog_product_reviews.php', {data: options})
            .always(function(data) {
                $('.bxr-btn-get-reviews').css('display','none');
                let div2add = $(data).find('.pr-body');
                $('.product-reviews').append(div2add);
            })
    });
    $('.bxr-button-left-product-review').click(function(){
        if ($(this).hasClass('clicked')) {
            $(this).removeClass('clicked').text('Оставить отзыв');
            $('form#catalog_review_add').detach();
        } else {
            $(this).addClass('clicked').text('Отменить');
            $.ajax('/include/catalog_product_review_add.php')
                .always(function(data){
                    $('.pr-add-form-place').append(data);
                });
        }
    });
});
