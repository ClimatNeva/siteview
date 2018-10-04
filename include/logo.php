<?
$logoLinkArray = array('', '');
if ($APPLICATION->GetCurDir() != '/') {
    $logoLinkArray = array(
        '<a href="/" class="bxr-logo" title="Климат Нева">',
        '</a>',
    );
}
?><?=$logoLinkArray[0]?> <img src="<?=SITE_DIR?>images/logo.png" alt="Климат Нева"> <?=$logoLinkArray[1]?>