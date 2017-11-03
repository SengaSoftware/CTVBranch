<?php

$time = microtime(true);
$memory = memory_get_usage();
date_default_timezone_set('Europe/Warsaw');
defined('APPLICATION_PATH')
        || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

defined('PUBLIC_PATH')
        || define('PUBLIC_PATH', realpath(dirname(__FILE__) . '/..') . "/wwwroot");

defined('APPLICATION_ENV')
        || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

set_include_path(implode(PATH_SEPARATOR, array(
            realpath(APPLICATION_PATH . '/../library'),
            get_include_path(),
        )));

set_include_path(implode(PATH_SEPARATOR, array(
            realpath(APPLICATION_PATH . '/class'),
            get_include_path(),
        )));

require_once 'Zend/Application.php';

$application = new Zend_Application(
                APPLICATION_ENV,
                APPLICATION_PATH . '/configs/application.ini'
);

$application->bootstrap('config');
$application->bootstrap('DataBase');
$application->bootstrap('Autoload');

register_shutdown_function('__shutdown');

function __shutdown() {
    global $time, $memory;
    $endTime = microtime(true);
    $endMemory = memory_get_usage();
    echo 'Time [' . ($endTime - $time) . '] Memory [' . number_format(( $endMemory - $memory) / 1024) . 'Kb]' . "\n";
}
