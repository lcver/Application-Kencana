<?php
// if (!function_exists('base_url')) {
//     function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
//         if (isset($_SERVER['HTTP_HOST'])) {
//             $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on' ? 'https' : 'http';
//             $hostname = $_SERVER['HTTP_HOST'];
//             $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
//             $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
//             var_dump($dir);
//             $core = $core[0];
//             $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
//             $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
//             $base_url = sprintf( $tmplt, $http, $hostname, $end );
//         }
//         else $base_url = 'http://localhost/';
//         if ($parse) {
//             $base_url = parse_url($base_url);
//             if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
//         }
//         return $base_url;
//     }
// }
// $base_url = base_url(false,true,false);


/**
 * Start Session
 * 
 * @return Session
 */
session_start();

/**
 * Base URL
 * @return URL
 */
$base_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https' : 'http';
$base_url.= "://".$_SERVER['HTTP_HOST'];
$base_url.= str_replace(basename($_SERVER['SCRIPT_NAME']),'',$_SERVER['SCRIPT_NAME']);
define('BASEURL', $base_url);

/**
 * Database
 * Configuration const database
 * 
 * @var String
 */
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','application_kencana');

/**
 * APP PATH
 * Directories of app folder.
 * 
 * @return Directory
 */
// $parse = parse_url($base_url);
$app_path = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
$app_path = preg_replace('/config/', '', $app_path);
$app_path = preg_replace('/App\\\/', '', $app_path);
define('APPPATH', $_SERVER['DOCUMENT_ROOT']."/".$app_path[0]);

/**
 * Vendor all path
 * Const directories
 * 
 * @return Directory
 */
define('VNDRPATH',APPPATH.'public\vendor\\');