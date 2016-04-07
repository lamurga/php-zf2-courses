<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

//var_dump(PATH_SEPARATOR);

// Setup autoloading
include 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(include 'config/application.config.php')->run();

//ZendDeveloperTools
define('REQUEST_MICROTIME', microtime(true));

