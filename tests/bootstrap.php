#!/usr/bin/env phpunit
<?php
defined('TEST_ROOT') or define('TEST_ROOT', __DIR__);
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
require_once dirname(TEST_ROOT) . DS . 'src' . DS . 'HandlerSocket.php';


function autoload($class)
{
    if (strpos($class, $GLOBALS['UNIT_NAME']) === false) {
        return false;
    }
    $path = str_replace('\\', DS, trim($class, '\\'));
    require_once TEST_ROOT . DS . $path . '.php';
    return class_exists($class, false);
}

spl_autoload_register('autoload');
