<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

?><div class="mobile_auth"></div><?

if ($USER->GetID()) {
    ?><a href="/personal/profile/"><?=$arResult["USER_NAME"];?></a> | <a href="/auth/?logout=yes"><?=GetMessage("AUTH_LOGOUT_TEXT");?></a><?
} else {
    ?><a href="/auth/">Войти</a> | <a href="/auth/?register=yes"><?=GetMessage("AUTH_REGISTER_TEXT");?></a><?
}

?></div><?