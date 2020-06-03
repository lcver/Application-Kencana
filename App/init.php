<?php
/**
 * PATH MVC
 * Directories of Core, Model, View, Controller.
 * 
 * @return Directory
 */
define('CORE_PATH', __DIR__.'/core/');
define('MPATH', __DIR__.'/models/');
define('VPATH', __DIR__.'/views/');
define('CPATH', __DIR__.'/controllers/');
define('LPATH', __DIR__.'/library/');

/**
 * Configuration
 * 
 * @return PATH
 * MPATH, VPATH, CPATH, LPATH
 */
require 'config/config.php';

/**
 * Autoload Vendor
 * @return vendor
 */
require APPPATH.'/public/vendor/autoload.php';

/**
 * Autoload Class
 * @return class
 */
require 'core/Autoload.php';
$load = new App\Core\Autoload;