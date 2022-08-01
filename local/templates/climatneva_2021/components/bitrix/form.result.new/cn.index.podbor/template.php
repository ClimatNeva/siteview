<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo "<pre>",print_r($arResult),"</pre>";

?><div class="triz__left bg-image" style="background-image:url('<?=$arResult["BACKGROUNDS"][0]["PATH"];?>');"></div>
<div class="triz__right">
    <div class="triz__right-bg bg-image" style="background-image:url('<?=$arResult["BACKGROUNDS"][0]["PATH"];?>');"></div>
    <div class="triz__wrapper">
        <h2><?=$arResult["FORM_TITLE"]?></h2>
        <div class="web-form-<?=$arResult["arForm"]["ID"];?>-box webform" data-webform="<?=$arResult["arForm"]["ID"];?>"><?
            ?><?=strtr($arResult["FORM_HEADER"],["<form" => "<form id=\"".$arResult["WEB_FORM_NAME"]."\""])?><?
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
            {
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
                {
                    echo $arQuestion["HTML_CODE"];
                }
            }
            ?><input type="hidden" name="NAME">
            <input type="hidden" name="properties">
            <div class="triz__outer">
                <div class="triz__inner owl-carousel">
                    <div class="triz__item" data-src="<?=$arResult["BACKGROUNDS"][0]["PATH"];?>">
                        <h3><?=GetMessage("ROOM_CONTAINER_TITLE");?> <span class="triz__room-counter">1</span></h3>
                        <div class="triz__room-box">
                            <div class="input-box room-square triz__full-width">
                                <label for="square_0" class="input-box__label"><?=GetMessage("ROOM_SQUARE_TITLE");?></label>
                                <input type="text" name="square_0" id="square_0" class="text-input" require="Y" data-wrapper="room-square">
                            </div>
                            <div class="input-box room-type triz__full-width"><?
                                $fieldWords = GetMessage("ROOM_TYPE_TITLE");
                                ?><label for="type_0" class="input-box__label"><?=$fieldWords;?></label>
                                <input type="hidden" name="type_0" id="type_0" require="Y" data-wrapper="room-type">
                                <div class="input__downlist type">
                                    <div class="input__show" data-list="type" data-id="type_0"></div>
                                    <div class="input__outer">
                                        <div class="input__inner"><?
                                            foreach ($arResult["arAnswers"][$arResult["FIELDS"][$fieldWords]] as $key => $field) {
                                                ?><input type="radio" class="hidden-input" name="type_0_<?=$key;?>" id="type_0_<?=$key;?>" data-text="<?=$field["MESSAGE"];?>" value="<?=$field["ID"];?>">
                                                <label for="type_0_<?=$key;?>" class="radio-input"><?=$field["MESSAGE"];?></label><?
                                            }
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box house-side"><?
                                $fieldWords = GetMessage("HOUSE_SIDE_TITLE");
                                ?><label for="side_0" class="input-box__label"><?=$fieldWords;?></label>
                                <input type="hidden" name="side_0" id="side_0" require="Y" data-wrapper="house-side">
                                <div class="input__downlist side">
                                    <div class="input__show" data-list="side" data-id="side_0"></div>
                                    <div class="input__outer">
                                        <div class="input__inner"><?
                                            foreach ($arResult["arAnswers"][$arResult["FIELDS"][$fieldWords]] as $key => $field) {
                                                ?><input type="radio" class="hidden-input" name="side_0_<?=$key;?>" id="side_0_<?=$key;?>" data-text="<?=$field["MESSAGE"];?>" value="<?=$field["ID"];?>">
                                                <label for="side_0_<?=$key;?>" class="radio-input"><?=$field["MESSAGE"];?></label><?
                                            }
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box window-type"><?
                                $fieldWords = GetMessage("WINDOW_TYPE_TITLE");
                                ?><label for="window_0" class="input-box__label"><?=$fieldWords;?></label>
                                <input type="hidden" name="window_0" id="window_0" require="Y" data-wrapper="window-type">
                                <div class="input__downlist window">
                                    <div class="input__show" data-list="window" data-id="window_0"></div>
                                    <div class="input__outer">
                                        <div class="input__inner"><?
                                            foreach ($arResult["arAnswers"][$arResult["FIELDS"][$fieldWords]] as $key => $field) {
                                                ?><input type="radio" class="hidden-input" name="window_0_<?=$key;?>" id="window_0_<?=$key;?>" data-text="<?=$field["MESSAGE"];?>" value="<?=$field["ID"];?>">
                                                <label for="window_0_<?=$key;?>" class="radio-input"><?=$field["MESSAGE"];?></label><?
                                            }
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn-blue btn-addroom"><?=GetMessage("BUTTON_ADD_ROOM_TITLE");?></button>
                            <button class="btn-empty btn-nextslide"><?=GetMessage("BUTTON_NEXT_PAGE_TITLE");?></button>
                        </div>
                    </div>
                    <div class="triz__item" data-src="<?=(!empty($arResult["BACKGROUNDS"][1]["PATH"]) ? $arResult["BACKGROUNDS"][1]["PATH"] : $arResult["BACKGROUNDS"][0]["PATH"]);?>">
                        <h3>&nbsp;</h3>
                        <div class="triz__room-box">
                            <div class="input-box cond-type triz__full-width"><?
                                $fieldWords = GetMessage("SPLIT_SYSTEM_TYPE_TITLE");
                                ?><label for="cond_0" class="input-box__label"><?=$fieldWords;?></label>
                                <input type="hidden" name="cond" id="cond" require="Y" data-wrapper="cond-type">
                                <div class="input__downlist cond">
                                    <div class="input__show" data-list="cond" data-id="cond"></div>
                                    <div class="input__outer">
                                        <div class="input__inner"><?
                                            foreach ($arResult["arAnswers"][$arResult["FIELDS"][$fieldWords]] as $key => $field) {
                                                ?><input type="radio" class="hidden-input" name="cond_<?=$key;?>" id="cond_<?=$key;?>" data-text="<?=$field["MESSAGE"];?>" value="<?=$field["ID"];?>">
                                                <label for="cond_<?=$key;?>" class="radio-input"><?=$field["MESSAGE"];?></label><?
                                            }
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box country-type triz__full-width"><?
                                $fieldWords = GetMessage("ORIGIN_COUNTRY_TITLE");
                                ?><label for="country" class="input-box__label"><?=$fieldWords;?></label>
                                <input type="hidden" name="country" id="country" require="Y" data-wrapper="country-type">
                                <div class="input__downlist country">
                                    <div class="input__show" data-list="country" data-id="country"></div>
                                    <div class="input__outer">
                                        <div class="input__inner"><?
                                            foreach ($arResult["arAnswers"][$arResult["FIELDS"][$fieldWords]] as $key => $field) {
                                                ?><input type="radio" class="hidden-input" name="country_<?=$key;?>" id="country_<?=$key;?>" data-text="<?=$field["MESSAGE"];?>" value="<?=$field["ID"];?>">
                                                <label for="country_<?=$key;?>" class="radio-input"><?=$field["MESSAGE"];?></label><?
                                            }
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-box cost-type triz__full-width"><?
                                $fieldWords = GetMessage("EQUIPMENT_CLASS_TITLE");
                                ?><label for="cost" class="input-box__label"><?=$fieldWords;?></label>
                                <input type="hidden" name="cost" id="cost" require="Y" data-wrapper="cost-type">
                                <div class="input__downlist cost">
                                    <div class="input__show" data-list="cost" data-id="cost"></div>
                                    <div class="input__outer">
                                        <div class="input__inner"><?
                                            foreach ($arResult["arAnswers"][$arResult["FIELDS"][$fieldWords]] as $key => $field) {
                                                ?><input type="radio" class="hidden-input" name="cost_<?=$key;?>" id="cost_<?=$key;?>" data-text="<?=$field["MESSAGE"];?>" value="<?=$field["ID"];?>">
                                                <label for="cost_<?=$key;?>" class="radio-input"><?=$field["MESSAGE"];?></label><?
                                            }
                                        ?></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn-blue btn-addroom"><?=GetMessage("BUTTON_ADD_ROOM_TITLE");?></button>
                            <button class="btn-empty btn-nextslide"><?=GetMessage("BUTTON_NEXT_PAGE_TITLE");?></button>
                            </div>
                    </div>
                    <div class="triz__item" data-src="<?=(!empty($arResult["BACKGROUNDS"][2]["PATH"]) ? $arResult["BACKGROUNDS"][2]["PATH"] : $arResult["BACKGROUNDS"][0]["PATH"]);?>">
                        <h3>&nbsp;</h3>
                        <div class="triz__room-box">
                            <div class="input-box fio-type triz__full-width"><?
                                $fieldWords = GetMessage("NAME_INPUT_TITLE");
                                $field_SID = $arResult["QUESTIONS"][$arResult["FIELDS"][$fieldWords]]["STRUCTURE"][0];
                                $field_ID = "form_".$field_SID["FIELD_TYPE"]."_".$field_SID["ID"];
                                ?><label for="fio" class="input-box__label"><?=GetMessage("NAME_INPUT_TITLE");?></label>
                                <input type="text" name="fio" id="fio" require="Y" data-wrapper="fio-type" class="inputtext">
                            </div>
                            <div class="input-box phone-type triz__full-width">
                                <label for="phone" class="input-box__label"><?=GetMessage("PHONE_INPUT_TITLE");?></label>
                                <input type="text" name="phone" id="phone" require="Y" data-wrapper="phone-type" class="inputtext">
                            </div>
                            <button class="btn-blue btn-triz-submit"><?=$arResult["arForm"]["BUTTON"];?></button>
                            <div class="agreement triz__full-width"><?=GetMessage("TRIZ_AGREEMENT_TEXT");?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="triz__counter"><span class="triz__current">1</span> / <span class="triz__overall">3</span></div>
        </div>
        <?=$arResult["FORM_FOOTER"]?>
    </div>
</div>
<script><?
$arFields = [
    ["ROOM_SQUARE_TITLE", "text","many","square"],
    ["ROOM_TYPE_TITLE","dropdown","many","type"],
    ["HOUSE_SIDE_TITLE","dropdown","many","side"],
    ["WINDOW_TYPE_TITLE","dropdown","many","window"],
    ["SPLIT_SYSTEM_TYPE_TITLE","dropdown","single","cond"],
    ["ORIGIN_COUNTRY_TITLE","dropdown","single","country"],
    ["EQUIPMENT_CLASS_TITLE","dropdown","single","cost"],
    ["NAME_INPUT_TITLE", "text","single","fio"],
    ["PHONE_INPUT_TITLE", "text","single","phone"],
    ["ROOM_PROPERTIES_TITLE", "textarea", "single", "properties"]
];
?>var arFields = {<?
foreach ($arFields as $field) {
    $fieldCode = $arResult["FIELDS"][GetMessage($field[0])];
    if ($arResult["arAnswers"][$fieldCode][0]["FIELD_TYPE"] === 'dropdown') {
        $fieldSID = "form_dropdown_".$fieldCode;//;$arResult["QUESTIONS"][$fieldCode]["STRUCTURE"][0]["ID"]
    } else {
        $fieldSID = "form_".$field[1]."_".$arResult["QUESTIONS"][$fieldCode]["STRUCTURE"][0]["ID"];
    }
    ?><?=$field[3];?>: ["<?=$fieldSID;?>", "<?=$field[2];?>", "<?=GetMessage($field[0]);?>", "<?=$field[1];?>"],
    <?
}
?>};
</script>
