<?php
/*
Plugin Name: Simple Minify
Description: WordPress plugin to minify JS and CSS assets (based on Assets Minify by Alessandro Carbone).
Author: Khouildi Salah
Version: 1.0.0
Author URI: http://salah-khouildi.fr
*/

//Autoloader
function amAutoloader( $classname ) {
	$filename = str_replace("\\", "/", __DIR__ . "/lib/$classname.php");

	if ( file_exists( $filename ) )
		include_once $filename;
}
spl_autoload_register('amAutoloader');

//Start
if ( !is_admin() )
	require_once 'SimpleMinifyInit.php';
else
	require_once 'SimpleMinifyAdmin.php';