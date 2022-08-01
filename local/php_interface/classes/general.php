<?php
//регистрируем свой автолоадер
if (function_exists('__autoload')) {
    spl_autoload_register('__autoload');
}
//До бавим свой загрузчик классов
spl_autoload_register('autoload_custom');

function autoload_custom($className) {
    try {
        $classPath = getClassPath($className);
        if(empty($classPath)){
            throw new Exception('не удалось определить расположение класса');
        }
        
        if(file_exists($classPath['classes'].$className.'.php')){
            require_once $classPath['classes'].$className.'.php';
        }

        //load class traits
        if(file_exists($classPath['traits'].$className.'.php')){
            require_once $classPath['traits'].$className.'.php';
        }
    } catch (Exception $ex) {
        $ex->getTraceAsString();
    }
}

function getClassPath($className) {
    $arRet = array();
    if (preg_match('/([A-Z]?[-a-z0-9_]+)([-A-z0-9_]*)/', $className, $matches)) {
        $arModulePaths = array(
            //'className'=>'/special/path/to/module/'
        );
        $moduleClassName = isset($arModulePaths[$className]) ? $arModulePaths[$className] : ($matches[1] . '/');
        
        if ($matches[1] === 'trait' && preg_match('/([A-Z]?[-a-z0-9_]+)([-A-z0-9_]*)/', $matches[2], $arMatchesName)) {
            $moduleTraitName = isset($arModulePaths[$className]) ? $arModulePaths[$className] : (lcfirst($arMatchesName[1]) . '/');
        }
        
        $docroot = $_SERVER["DOCUMENT_ROOT"];
        /*if(CHK_EVENT === true){
            $docroot = $_SERVER["DOCUMENT_ROOT"];
        }
        else{
            $docroot = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
        }*/
        $arRet = array(
            'classes' => $docroot.'/local/php_interface/classes/'.$moduleClassName,
            'traits' => $moduleTraitName?$docroot.'/local/traits/'.$moduleTraitName:''
        );
    }
    return $arRet;
}

?>
