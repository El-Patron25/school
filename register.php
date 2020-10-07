<?php
	ini_set('display_errors', 1);
error_reporting(E_ALL);
	require "includes/autoloader.inc.php";
	// require 'classes/dbconnection.class.php';
	

// todo: fixme 
if(isset($_GET['sub'])){
	$fieldnames = ['voornaam', 'achternaam', 'uan', 'mail', 'pass', 'passr'];

$error = false;

foreach($fieldnames as $fieldname){
	if(!isset($_GET[$fieldname]) || empty($_GET[$fieldname])){
$error = true;
echo "Error occurred: $error";

	}

if(!$error){
	 
	$voornaam = $_GET['voornaam'];
	$achternaam = $_GET['achternaam'];
	$tussenvoegsel = $_GET['tvl'];
	$user = $_GET['uan'];
	$mail = $_GET['mail'];
	$pass = $_GET['pass'];
	$passr = $_GET['passr'];
	$pattern = "/^[a-zA-Z0-9]*$/";
// todo: check if pass == passr
	if(!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match($pattern, $user)){
					echo "an error ocurred: something went wrong!";
			}elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
				echo "an error ocurred: Email Check";
			}elseif(!preg_match($pattern, $user)){
				echo "an error ocurred: wrong user";
			}elseif($pass !== $passr){
		echo "wrong password combination";
			}
}
}
$connect = new dbconnection("localhost", "project1", "root", "", "utf8");
$connect->signUp($voornaam, $tussenvoegsel, $achternaam, $mail, $user, $pass);



}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Register</title>

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

	<h2 id="h2-register">Registreer je in het<p> formulier hieronder!</p></h2>
	<fieldset id="field-form">
	<form action="register.php" method="GET" id="form-r">
		<div class="container">
		<label><b>Voornaam:</b></label><br>	
		<input type="text" name="voornaam"><br>
		</div>

		<div class="container">
			<label><b>Tussenvoegsel:</b></label><br>
		<input type="text" name="tvl"><br>
		</div>

		<div class="container">
			<label><b>Achternaam:</b></label><br>
		<input type="text" name="achternaam"><br>
		</div>

		<div class="container">
			<label><b>Username:</b></label><br>
		<input type="text" name="uan"><br>
		</div>
		<div class="container">
			<label><b>Email:</b></label><br>
		<input type="email" name="mail"><br>
		</div>

		<div class="container">
			<label><b>Password:</b></label><br>
		<input type="password" name="pass"><br>
		</div>

		<div class="container">
			<label><b>Repeat Password:</b></label><br>
		<input type="password" name="passr"><br>
		</div>

		<div class="container">
		<a href="login.php"><small>already account ? login!</small></a>
		</div>

		<div class="container">
			<button class="" type="submit" href="index.php" name="sub">Submit</button>
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

