<?
include_once '../../system/config/configure.php';
$bReturnAbsolute=false;

define('DIR_WS',SERVER_URL,true);
define('DIR_FS','../',true);

echo DIR_WS;
$sBaseVirtual0=DIR_WS."admin/js/imageslogo/upimages";  //Assuming that the path is http://yourserver/Editor/assets/ ("Relative to Root" Path is required)
//$sBase0="c:/inetpub/wwwroot/Editor/assets"; //The real path
$sBase0=DIR_FS."imageslogo/upimages"; //The real path
//$sBase0="/home/yourserver/web/Editor/assets"; //example for Unix server
$sName0="UpImages";

$sBaseVirtual1="";
$sBase1="";
$sName1="";

$sBaseVirtual2="";
$sBase2="";
$sName2="";

$sBaseVirtual3="";
$sBase3="";
$sName3="";
?>