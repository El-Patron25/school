<?php

spl_autoload_register("autoloader");

function autoloader($classname){

	$path = "classes/";
	$extension = ".class.php";

	$fullpath = $path . $classname . $extension;

	if(!$fullpath){
		return false;
	}else{
	

	include_once $fullpath;
}
}


?>