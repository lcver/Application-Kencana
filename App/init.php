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
// require 'core/Autoload.php';
// $load = new App\Core\Autoload;
spl_autoload_register(function ($class_name) {
    $class_name = explode('\\', $class_name);

    // Class folder name
    $sub="";
    $i = count($class_name)-2;
    if( in_array('Core',$class_name) || $i < 0 ){
        $sub = "/core";
    }

    // Class name
    $class_name = end($class_name);
    if(file_exists(__DIR__ . $sub .'/'. $class_name .'.php'))
        require_once __DIR__ . $sub .'/'. $class_name .'.php';

});