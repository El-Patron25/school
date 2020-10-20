<?php

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
	// require "includes/autoloader.inc.php";
// include "classes/dbconnection.class.php";
// include "classes/components.class.php";
// include "classes/login.class.php";

if(isset($_GET['login_btn'])){
	include "security.php";
	$login = ['uan', 'pass'];

		$error = false;
		foreach ($login as $log) {
			if(!isset($_GET[$log]) || empty($_GET[$log])){
				$error = true;
				echo "error occurred: $error";
			}
			


			if(!$error){
			$user = $_GET['uan'];
			$pass = $_GET['pass'];
			}

		}
	$userLogin = new Login();
	$userLogin->loginUser($user, $pass);
			

	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>login</title>

	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>

	<div class="hero">
	<div class="navbar">
		<img src="img/logo.png" class="logo">
		
	</div>
	
	<div class="side-bar">
		<img src="img/menu.jpg" class="menu">

		<div class="social-links">
			<img src="img/fb.png">
			<img src="img/ig.png">
			<img src="img/twitter.png">
		</div>
	</div>

<h2 id="h2-login">Login the<p> form here!</p></h2>
	<fieldset id="field-form-login">
<form id="form-l" method="GET" action="login.php">

	<div>
		<label><b>Username/email:</b></label><br>
		<input type="text" name="uan">
	</div>

	<div>
		<label><b>Password:</b></label><br>
		<input type="password" name="pass">
	</div>

	<div class="container">
		<a href="usertype.php"><small>Not an account ? register!</small></a>
	</div>

	<div class="container">
		<a href="lostpsw.php"><small>Forgot you password ?</small></a>
	</div>

	<div>
		<button name="login_btn" type="submit">submit</button>
	</div>
</form>
</fieldset>


<div class="bubbles">
		<img src="img/bubble.png" alt="">
		<img src="img/bubble.png" alt="">
		<img src="img/bubble.png" alt="">
		<img src="img/bubble.png" alt="">
		<img src="img/bubble.png" alt="">
		<img src="img/bubble.png" alt="">
		<img src="img/bubble.png" alt="">
	</div>
</div>
</body>
</html>