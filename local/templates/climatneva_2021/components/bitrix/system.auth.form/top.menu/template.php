<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($USER->GetID()) {
    ?><li><a href="/personal/profile/"><?=$arResult["USER_NAME"];?></a></li>
    <li><a href="/auth/?logout=yes"><?=GetMessage("AUTH_LOGOUT_TEXT");?></a></li><?
} else {
?><li><a href="/auth/"><img src="/img/svg/icon_auth.svg" alt="" class="img-inline"><?=GetMessage("AUTH_LOGIN_TEXT");?></a></li>
    <li><a href="/auth/?register=yes"><?=GetMessage("AUTH_REGISTER_TEXT");?></a></li><?
}