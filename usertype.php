<?php

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
	require "includes/autoloader.inc.php";


	// if(isset($_GET['user'])){
	// 	header("Location: register.php");
	// }elseif(isset($_GET['admin'])){
	// 	header("Location: register.php");
	// }
	
			

	

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

<h2 id="h2-login">Login as<p> Admin or User!</p></h2>
	<fieldset id="field-form-login">
<form id="form-l" method="GET" action="register.php">

	<div>
		<button type="submit">User</button>
	</div>
</form>

<form id="form-l" method="GET" action="register.php">

	<div>
		<button type="submit">Admin</button>
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