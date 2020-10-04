<?php
	
	require "includes/autoloader.inc.php";

	$voornaam = isset($_GET['voornaam']);
	$achternaam = isset($_GET['achternaam']);
	$tussenvoegsel = isset($_GET['tvl']);
	$username = isset($_GET['uan']);
	$mail = isset($_GET['mail']);
	$pass = isset($_GET['pass']);
	$passr = isset($_GET['passr']);

	$connect = new dbconnection("localhost", "project1", "root", "", "utf8");
// 	if(!empty($voornaam) || !empty($tussenvoegsel) || !empty($achternaam) || !empty($username) || !empty($mail) || !empty($pass) || !empty($passr)){
// 	$connect->signIn($voornaam, $achternaam, $tussenvoegsel, $username, $mail, $pass, $passr);
// }
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

		<!-- <div class="container">
		<input hidden="" type="account_id" name="account_id"><br>
		</div> -->

		<div class="container">
			<button class="" type="submit" name="sub">Submit</button>
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

<?php
	if(isset($_GET['sub'])) {
if(!empty($voornaam) || !empty($tussenvoegsel) || !empty($achternaam) || !empty($username) || !empty($mail) || !empty($pass) || !empty($passr)){



if(!preg_match($pattern, $username) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
			// $errormsg .= $this->textValue("error", "Syntax error");
			echo("behh");
		}elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
			$errormsg .= $this->textValue("error", "please fill in valid email\n");
		}elseif($pass !== $passr){
			$errormsg .= $this->textValue("error", "password is not the same!\n");
		}else{
			$sql = "SELECT * FROM account WHERE username = :username";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array(":username" => $username));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(!count($result) < 0) {
				$errormsg .= $this->textValue("error", "Username already exists\n");
			}else{
				$sql = "INSERT INTO account (username, email, password) VALUES (:username, :email, :password)
						INSERT INTO persoon (voornaam, tussenvoegsel, achternaam) VALUES (:voornaam, :tussenvoegsel, :achternaam)";
				$stmt = $this->conn->prepare($sql);
				$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
				$stmt->execute(array(
										":voornaam" => $voornaam,
										":tussenvoegsel" => $tussenvoegsel,
										":achternaam" => $achternaam,
										":username" => $username,
										":email" => $email,
										":password" => $hashedPass
									));
			}
		}

	}else{
		echo "mehhhh";
	}
}

	?>