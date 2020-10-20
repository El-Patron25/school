<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include "security.php";

?>
<!DOCTYPE html>
<html>
<head>
	<title>dghdf</title>

	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
<div class="hero">
	<div class="navbar">
		<?php if(isset($_SESSION['username'])){ ?>


<button type="button"><a href="login.php">Log out</a></button>
<a href="https://www.mckinsey.com/"><img src="img/logo.png" class="logo"></a>
		<?php }else{ ?>
		<a href="https://www.mckinsey.com/"><img src="img/logo.png" class="logo"></a>
		<button type="button"><a href="usertype.php">Sign Up</a></button>
	<?php } ?>
	</div>
	<div class="content">
		<small style="font-size: 55px; color: black;">Welcome <b style="color: grey;"><?php if(isset($_SESSION['username'])){
					echo $_SESSION['username'];
		} ?></b> to our</small>
		<h1>World's<br> Creative studio</h1>
		<button type="button" style="font-size: 20px; width: 115px;">Take a tour</button>
	</div>
	<div class="side-bar">
		<img src="img/menu.jpg" class="menu">

		<div class="social-links">
			<img src="img/fb.png">
			<img src="img/ig.png">
			<img src="img/twitter.png">
		</div>
	</div>

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