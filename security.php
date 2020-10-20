<?php

// include "classes/dbconnection.class.php";
require "includes/autoloader.inc.php";
// include "classes/components.class.php";
// include "classes/login.class.php";
session_start();
if(!$_SESSION['username']){
	header("Location: usertype.php");
}


?>