(function (window) {

    jQuery.easing['jswing'] = jQuery.easing['swing'];

    jQuery.extend( jQuery.easing,
        {
           easeOutBounce: function (x, t, b, c, d) {
                if ((t/=d) < (1/2.75)) {
                    return c*(7.5625*t*t) + b;
                } else if (t < (2/2.75)) {
                    return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
                } else if (t < (2.5/2.75)) {
                    return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
                } else {
                    return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
                }
            },
            easeOutElastic: function (x, t, b, c, d) {
                var s=1.70158;var p=0;var a=c;
                if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
                if (a < Math.abs(c)) { a=c; var s=p/4; }
                else var s = p/(2*Math.PI) * Math.asin (c/a);
                return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
            },
            easeOutExpo: function (x, t, b, c, d) {
                return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
            }
        });


    window.BXReady = {
        showAjaxShadow: function(element, idArea, localeShadow){

            if (localeShadow == true){
                $(element).addClass('ajax-shadow');
                $(element).addClass('ajax-shadow-r');
            }
            else{
                if ($('div').is('#'+idArea)){

                }
                else
                {
                    $('<div id="'+idArea+'" class="ajax-shadow"></div>').appendTo('body');
                }

                $('#'+idArea).show();
                $('#'+idArea).width($(element).width());
                $('#'+idArea).height($(element).outerHeight());
                $('#'+idArea).css('top', $(element).offset().top+'px');
                $('#'+idArea).css('left', $(element).offset().left+'px');
            }

        },

        closeAjaxShadow: function(idArea, localShadow){
            if (localShadow == true){
                $(idArea).removeClass('ajax-shadow-r');
                $(idArea).removeClass('ajax-shadow');
            }
            else{
                $('#'+idArea).hide();
            }
        },

        scrollTo: function(targetElement){

            $("html, body").animate({
                scrollTop: $(targetElement).offset().top-20 + "px"
            }, {
                duration: 500
            });
        },

        autosizeVertical: function(){
            maxHeight = 0;
            $('div.bxr-v-autosize').each(function(){
                if ($(this).height()> maxHeight){
                    maxHeight = $(this).height();
                };
            });
            $('div.bxr-v-autosize').each(function(){

                    delta = Math.round((maxHeight - $(this).height())/2);
                    $(this).css({'padding-top': delta+'px', 'padding-bottom': delta+'px'});
            });
        }
    };

    window.BXReady.Market = {
        loader: [],
        
        setPriceCents: function(){

            $('.bxr-format-price').each(function(){
                price = $(this).html();

                newPrice = price.replace(/(\.\d\d)/g, '<sup>$1</sup>');
                newPrice = newPrice.replace(/(\.)/g, '');

                $(this).html(newPrice);
            });
        },

        bestsellersAjaxUrl: '/ajax/bestsellers.php',
        markersAjaxUrl: '/ajax/markers.php'
    };
    
    $(document).on('click', '.search-btn', function() {
        var search = $('#searchline');
        if(search.is(":visible"))
            search.fadeOut();
        else
            search.fadeIn(); 
    });

    $(document).on('click', '.bxr-mobile-login-icon', function() {
        $('.bxr-mobile-login-area').fadeOut(200, function(){
            $('.bxr-mobile-phone-area').fadeIn(200);
        });
    });

    $(document).on('click', '.bxr-mobile-phone-icon', function() {
        $('.bxr-mobile-phone-area').fadeOut(200, function(){
            $('.bxr-mobile-login-area').fadeIn(200);
        });
    });

    $('.checkman-label').click(function(event){
        if (!$('#checkman').prop('checked')) {
            $('#robot').val('a-man');
            $('input[name="Register"]').prop('disabled', false);
        } else {
            $('#robot').val('not-a-man');
            $('input[name="Register"]').prop('disabled', true);
        }
    });

    $(window).on ('resize', function() {
        if ($(window).width() > 960) {
            $('.bxr-mobile-phone-area').fadeOut(200, function(){
                $('.bxr-mobile-login-area').fadeIn(200);
            });
	} else {
            $('.bxr-mobile-phone-area').fadeIn(200, function(){
                $('.bxr-mobile-login-area').fadeOut(200);
            });
	}
    });
    
    $(document).on('click', '.mobile-footer-menu-tumbl', function() {
        $(this).next().toggle();
    });
    
    $(document).on('click', '.delivery-item-more', function() {
        if ($(this).prev('.delivery-item-text').css('display') == 'none'){
            $(this).prev('.delivery-item-text').slideDown();
            $(this).html('<span class="fa fa-angle-up"></span> Скрыть информацию');
        } else {
            $(this).prev('.delivery-item-text').slideUp();
            $(this).html('<span class="fa fa-angle-down"></span> Узнать больше');
        }
    });
    
    $('.page-links-a').click(function(event){
        event.preventDefault();
        $("html, body").animate({
             scrollTop: $($(this).attr("href")).offset().top - 100 + "px"
        }, {
             duration: 500,
             easing: "swing"
        });
    });
    
    $('.bxr-view-mode').click(function(event){
        event.preventDefault();
        window.location.assign($(this).data('link'));
    });
    
    $('.bxr-sortbutton').click(function(event){
        event.preventDefault();
        window.location.assign($(this).data('link'));
    });

//    window.onload = function() {
//        BXReady.autosizeVertical();
//    };
    
    window.onload = function()
    {
        if (typeof window.BXReady.Market.loader != 'object')
            window.BXReady.Market.loader = [];
        for ( var i in window.BXReady.Market.loader )
        {
            if ( typeof( window.BXReady.Market.loader[i] ) == 'function' ) window.BXReady.Market.loader[i](); 
        }
    };
    
    if (typeof window.BXReady.Market.loader != 'object')
            window.BXReady.Market.loader = [];
    window.BXReady.Market.loader.push(BXReady.autosizeVertical);

    
    $( window ).resize(function() {
        BXReady.autosizeVertical();
    });
})(window);

$(document).ready(function(){
  $(function(){
      if (typeof domReadyQueue != 'undefined')
          while (domReadyQueue.length) {
              domReadyQueue.shift()($);
          }
  });
    /*$('.bxr-recall-link').click(function(){
        yaCounter31317263.reachGoal('call_me_back');
    });
    
    $('button.buy-cheaper').click(function(){
        yaCounter31317263.reachGoal('cheaper');
    });
    
    $('button.bxr-one-click-buy').click(function(){
        yaCounter31317263.reachGoal('buy_in_1_click');
    });
    
    $('button.bxr-basket-add').click(function(){
        yaCounter31317263.reachGoal('buy');
    });
    
    $('input#submitForm_20').click(function(){
        yaCounter31317263.reachGoal('send_cheaper');
    });*/

    $('.head_mobile__opener').click(function(){
        $('.mobile_header').animate({'left':'0'}, 300);
    })
    
    $('.mobile_close').click(function(){
        $('.mobile_header').animate({'left':'-100vw'}, 300);
    })

    /*scrollWindow();
    $(window).scroll(function(){
        scrollWindow();
    });*/
    
	$('#toTop').on("click",function() {
		$('body,html').animate({scrollTop:0},500);
    });
})

function scrollWindow() {
    if ($(window).scrollTop() > $('#panel').height()) {
        $('body').addClass('fixed');
    } else {
        $('body').removeClass('fixed');
    }
}
function showNotFilledModalWindow(fieldName, alertString) {
    console.log(fieldName, alertString);
    let modalAgree = '';
    let modalAlertWin = `<div class="modal_alert${modalAgree}">${alertString}</div>`;
    $('div[id=' + fieldName + ']').append(modalAlertWin);
    setTimeout(function(){
        $('.modal_alert').detach();
    }, 15000);
}

function validatePhone(phone) {
    if (phone.length > 19) return false;
    let pattern = /^[\+\(\)\-0-9 ]+$/;
    return pattern.test(phone);
}

function validateEmail(email) {
    let pattern  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(String(email).toLowerCase());
}
