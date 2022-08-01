<?php
if (isset($_GET['noparams']) && !empty($_GET['noparams']))
{
    $strNoInit = strval($_GET['noparams']);
    if ($strNoInit == 'N')
    {
        if (isset($_SESSION['NO_INIT']))
            unset($_SESSION['NO_INIT']);
    }
    elseif ($strNoInit == 'Y')
    {
        $_SESSION['NO_INIT'] = 'Y';
    }
}
if (!(isset($_SESSION['NO_INIT']) && $_SESSION['NO_INIT'] == 'Y'))
{
    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/functions.php")) {
        require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/functions.php");
    }
    if (file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/handlers.php")) {
        require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/handlers.php");
    }
}
?>