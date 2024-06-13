<?php
// Specify domains from which requests are allowed
header('Access-Control-Allow-Origin: *');
#####################################
#  Session Setting					#
#####################################
session_start(); 

ini_set('memory_limit','384M');
ini_set('post_max_size','384M');
date_default_timezone_set('Africa/Lagos'); 

?>
<?php 

#####################################
#  Database Configration			#
#####################################
define('DB_SERVER','localhost');
define('DB_USERNAME','sabis');
define('DB_PASSWORD','*IQqHI+4srRLEJ93');
define('DB_DATABASE','sabis_jarabeachresort');

#####################################
#  Site Configration				#
#####################################
define('SERVER_URL','https://sabis.jarabeachresort.com/admintool/');
// server path mac
// define('SERVER_PATH','/var/www/html/admintool/');
//server path
define('SERVER_PATH','/var/www/html/admintool/');
define('HTTP_URL','https://sabis.jarabeachresort.com/admintool/');
define('HTTPS_URL','https://sabis.jarabeachresort.com/admintool/');
define('ADMIN_URL',SERVER_URL.'');
define('ADMIN_PATH',SERVER_PATH.'');
define('FUNCTION_PATH',SERVER_PATH.'system/function/');
define('CLASS_PATH',SERVER_PATH.'system/class/');
define('CONFIG_PATH',SERVER_PATH.'system/config/');
define('JAVASCRIPT_PATH',SERVER_PATH.'js/');
define("ADMIN_IMAGES_PATH", ADMIN_PATH.'images/');


#####################################
#  Database Settings 			    #
#####################################
include_once CLASS_PATH.'dbclass.php';
$dbobj = new dbclass(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

#####################################
#  Include File Settings			#
#####################################
include_once FUNCTION_PATH.'general.php';

#####################################
#  Configure Paging Variables		#
#####################################
$record_limit=20; // for paging
$pg_limit=5;  // for paging  
define('PAGE_COMBO',$record_limit);

#####################################
#  Image Parameters					#
#####################################
define('IMAGE_HEIGHT','100');
define('IMAGE_WIDTH','100');

#####################################
#  File Settings					#
#####################################
define('INDEX_FILE','index.php?file=');

#####################################
#  General Setting					#
#####################################
//error_reporting(E_ALL ^ E_NOTICE ^ E_ERROR ^ E_WARNING ^ E_DEPRECATED);
ini_set('display_errors', 0); // display all errors
@ini_set('register_globals', 'Off'); // make globals off runtime
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('CHARSET', 'utf-8');
getconfigure();
######################################
# API verification key#
######################################
define("API_KEY", "790faa0d-369f-47d7-b0ce-5e2888067f39");

?>