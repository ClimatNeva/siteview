<?
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

$request = \Bitrix\Main\Context::getCurrent()->getRequest();

if ($request->get('ajax') == 'Y'
    && $request->get('user_name') == ''
    && $request->get('sessid') == check_bitrix_sessid()) {

    CModule::IncludeModule('iblock');

    $rating = array(161,162,163,164,165);
    $arRadio = array(
        "Ужасный товар",
        "Плохой товар",
        "Обычный товар",
        "Хороший товар",
        "Отличный товар",
    );
    $arEl = array(
        "NAME" => htmlspecialchars($request->get('man').' / '.$request->get('element')),
        "ACTIVE" => "Y",
        "IBLOCK_SECTION_ID" => false,
        "IBLOCK_ID" => "19",
        "ACTIVE_FROM" => date('d.m.Y'),
        "PROPERTY_VALUES" => array(
            "REV_AUTHOR" => $request->get('man'),
            "REV_RATING" => $rating[intval($request->get('rating'))-1],
            "REV_EMAIL" => htmlspecialchars($request->get('email')),
            "REV_PRODUCT" => $request->get('element_id'),
        ),
    );
    if (null !== $request->get('pr-values') && strlen($request->get('pr-values'))>0) $arEl["PROPERTY_VALUES"]["REV_VALUES"] = htmlspecialchars($request->get('pr-values'));
    if (null !== $request->get('pr-downsides') && strlen($request->get('pr-downsides'))>0) $arEl["PROPERTY_VALUES"]["REV_DOWNSIDES"] = htmlspecialchars($request->get('pr-downsides'));
    if (null !== $request->get('pr-comment') && strlen($request->get('pr-comment'))>0) $arEl["PROPERTY_VALUES"]["REV_COMMENT"] = htmlspecialchars($request->get('pr-comment'));
    if ($USER->IsAuthorized()) $arEl["PROPERTY_VALUES"]["REV_AUTHOR_ID"] = $USER->GetID();
    $el = new CIBlockElement;
    if ($newID = $el->Add($arEl)) {
        $randID = randString(10);
        ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="pr-author">
                    <span class="pr-author-head"><?=$request->get('man')?></span>
                    <span class="pr-explain">Сейчас</span>
                </div>
                <div class="pr-stars">
                    <div class="bx_stars_container" style="width: <?=intval($request->get('rating'))*15;?>px;">
                        <div class="bx_stars_bg"></div>
                        <div class="bx_stars_progres"></div>
                    </div>
                    <div class="pr-explain"><?=$arRadio[intval($request->get('rating'))-1]?></div>
                </div>
                <?if (mb_strlen($request->get('pr-values')) > 0):?>
                <div class="pr-text">
                    <div class="pr-text-head">Достоинства</div>
                    <div class="pr-text-plain"><?
                    if (mb_strlen($request->get('pr-values')) > 325) {
                        $search2space = mb_strpos(htmlspecialchars($request->get('pr-values')), ' ', 300);
                        echo mb_substr($request->get('pr-values'),0,$search2space)
                            ,'<span class="show-text" data-stid="values_'.$randID.'"></span>'
                            ,'<span class="hidden-text" data-stid="values_'.$randID.'">'
                            ,mb_substr($request->get('pr-values'),$search2space)
                            ,'</span>';
                    } else {
                        echo $request->get('pr-values');
                    }
                    ?></div>
                </div>
                <?endif;?>
                <?if (mb_strlen($request->get('pr-downsides')) > 0):?>
                <div class="pr-text">
                    <div class="pr-text-head">Недостатки</div>
                    <div class="pr-text-plain"><?
                    if (mb_strlen($request->get('pr-downsides')) > 325) {
                        $search2space = mb_strpos($request->get('pr-downsides'), ' ', 300);
                        echo mb_substr($request->get('pr-downsides'),0,$search2space)
                            ,'<span class="show-text" data-stid="downsides_'.$randID.'"></span>'
                            ,'<span class="hidden-text" data-stid="downsides_'.$randID.'">'
                            ,mb_substr($request->get('pr-downsides'),$search2space)
                            ,'</span>';
                    } else {
                        echo $request->get('pr-downsides');
                    }
                    ?></div>
                </div>
                <?endif;?>
                <?if (mb_strlen($request->get('pr-comment')) > 0):?>
                <div class="pr-text">
                    <div class="pr-text-head">Комментарий</div>
                    <div class="pr-text-plain"><?
                    if (mb_strlen($request->get('pr-comment')) > 325) {
                        $search2space = mb_strpos($request->get('pr-comment'), ' ', 300);
                        echo mb_substr($request->get('pr-comment'),0,$search2space)
                            ,'<span class="show-text" data-stid="comment_'.$randID.'"></span>'
                            ,'<span class="hidden-text" data-stid="comment_'.$randID.'">'
                            ,mb_substr($request->get('pr-comment'),$search2space)
                            ,'</span>';
                    } else {
                        echo $request->get('pr-comment');
                    }
                    ?></div>
                </div>
                <?endif;?>
            </div>
        </div>
        <script>
        $(document).ready(function(){
            $('.pr-counter').text(parseInt($('.pr-counter').text())+1);
            $('.show-text').click(function(){
                $(this).css('display','none');
                $('.hidden-text[data-stid="' + $(this).data('stid') + '"]').css('display','unset');
            });
        });
        </script>

    <?} else {
        $outVar = '';
        if ($ex = $APPLICATION->GetException()) 
            $outVar = "\nSomething wrong; ".$ex->GetString();
        echo "При сохранении отзыва произошла ошибка.\n".$outVar;
        echo $el->LAST_ERROR;
    }
    //echo $el->LAST_ERROR;
    //print_r($arEl);
} else {
?>
<form action='/' method='post' enctype='multipart/form-data' id='catalog_review_add'>
    <div class="pr-ro-row">
        <div class="pr-ro-cont">
            <label for="user_name" class="pr-textinput">
                Имя пользователя:
                <input type="text" name="user_name" id="user_name">
            </label>
        </div>
    </div>
    <?= bitrix_sessid_post();?>
    <div class="row pr-form">
        <div class="col-xs-12" id="input-man">
            <label for="man" class="pr-label">Ваше имя<span class="pr-red"></span>:</label>
            <input type="text" name="man" id="man">
        </div>
        <div class="col-xs-12" id="input-email">
            <label for="email" class="pr-label">Электронная почта (не показывается)<span class="pr-red"></span>:</label>
            <input type="text" name="email" id="email">
        </div>
        <div class="col-xs-12">
            <div class="pr-label" id="radioboxes">Оценка товара<span class="pr-red"></span>:</div>
            <div class="pr-radioboxes">
                <div class="bx_stars_container_form">
                    <label for="input_1" class="bx_stars_box box_1" data-boxid="20%" data-showtext="Ужасный товар"></label>
                    <label for="input_2" class="bx_stars_box box_2" data-boxid="40%" data-showtext="Плохой товар"></label>
                    <label for="input_3" class="bx_stars_box box_3" data-boxid="60%" data-showtext="Обычный товар"></label>
                    <label for="input_4" class="bx_stars_box box_4" data-boxid="80%" data-showtext="Хороший товар"></label>
                    <label for="input_5" class="bx_stars_box box_5" data-boxid="100%" data-showtext="Отличный товар"></label>
                    <div class="bx_stars_bg_form"></div>
                    <div class="bx_stars_progres_form"></div>
                    <div class="bx_stars_comment"></div>
                </div>
                <input class="radio-input" type="radio" name="rating" id="input_1" value="1">
                <input class="radio-input" type="radio" name="rating" id="input_2" value="2">
                <input class="radio-input" type="radio" name="rating" id="input_3" value="3">
                <input class="radio-input" type="radio" name="rating" id="input_4" value="4">
                <input class="radio-input" type="radio" name="rating" id="input_5" value="5">
                <?/*
                $arRadio = array(
                    "Ужасный товар",
                    "Плохой товар",
                    "Обычный товар",
                    "Хороший товар",
                    "Отличный товар",
                );
                for ($i=sizeof($arRadio);$i>0;$i--) {?>
                <input type="radio" name="rating" id="rating_<?=$i?>" value="<?=$i?>">
                <label for="rating_<?=$i?>" class="pr-input-radio"><?=$arRadio[$i-1]?></label>?>
                <div class="clear"></div>
                <?}
                */?>
            </div>
        </div>
        <div class="col-xs-12">
            <label for="pr-values" class="pr-label">Достоинства</label>
            <textarea name="pr-values" id="pr-values"></textarea>
        </div>
        <div class="col-xs-12">
            <label for="pr-downsides" class="pr-label">Недостатки</label>
            <textarea name="pr-downsides" id="pr-downsides"></textarea>
        </div>
        <div class="col-xs-12">
            <label for="pr-comment" class="pr-label">Комментарий</label>
            <textarea name="pr-comment" id="pr-comment"></textarea>
        </div>
        <?/*<div class="col-xs-12">
            <div class="form-element form-element-PERSONAL">
                <div class="input-wrapper">
                    <input type="checkbox" class="checkman" id="checkman">
                    <label for="checkman" class="checkman-label">Я не робот</label>
                </div>
            </div>
       </div>*/?>
        <div class="col-xs-12">
            <input type="submit" name="form_apply" value="Отправить"/>
        </div>
    </div>
</form>
<script>
let radioChecked = '';
$(document).ready(function(){
    $('.bx_stars_box').click(function(){
        let myStr = ''+$(this).prop('class');
        radioChecked = myStr.substring(myStr.length-5);
    })
    $('.bx_stars_box').mouseout(function(){
        if (radioChecked != '') {
            $('.bx_stars_progres_form').css('width',$('.' + radioChecked).data('boxid'));
            $('.bx_stars_comment').text($('.' + radioChecked).data('showtext'));
        } else {
            $('.bx_stars_progres_form').css('width','0');
            $('.bx_stars_comment').text('');
        }
    });
    $('.bx_stars_box').mouseover(function(){
        $('.bx_stars_progres_form').css('width',$(this).data('boxid'));
        $('.bx_stars_comment').text($(this).data('showtext'));
    });
    $('form#catalog_review_add').submit(function(e){
        e.preventDefault();
        options = $(this).serializeArray();
        console.log(options);
        if (options[2].value.length < 2) {
            showNotFilledModalWindow('input-man','Надо заполнить поле');
            return;
        }
        if (!validateEmail(options[3].value)) {
            showNotFilledModalWindow('input-email','Надо заполнить поле');
            return;
        }
        if (options[4].name != 'rating') {
            showNotFilledModalWindow('radioboxes','Надо поставить оценку');
            return;
        }
        options.push(
            {name: 'ajax', value: 'Y'},
            {name: 'element_id', value : $('.bxr-button-left-product-review').data('itemid')},
            {name: 'element', value : $('h1').text()}
        );
        console.log(options);
        $.ajax({
            url : '/include/catalog_product_review_add.php',
            method: 'POST',
            data: options
        }).always(function(data){
            $('.bxr-button-left-product-review').removeClass('clicked').text('Оставить отзыв');
            $('form#catalog_review_add').detach();
            $('.pr-add-form-place').append(data).setShow();
//                console.log(data);
        })
    });
});

function showNotFilledModalWindow(fieldName, alertString) {
    let modalAgree = '';
    let modalAlertWin = `<div class="modal_alert${modalAgree}">${alertString}</div>`;
    let modalElement = 'input';
    $('div[id=' + fieldName + ']').append(modalAlertWin);
    setTimeout(function(){
        $('.modal_alert').detach();
    }, 1500);
}

function setShow() {
    $('.pr-counter').text(parseInt($('.pr-counter').text())+1);
    $('.show-text').click(function(){
        $(this).css('display','none');
        $('.hidden-text[data-stid="' + $(this).data('stid') + '"]').css('display','unset');
    });
}
</script>
<?
}
?>
