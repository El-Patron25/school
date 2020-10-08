<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

$user = "root";
$pass = "";

$pdo = new PDO('mysql:host=localhost;dbname=test', $user, $pass);



?>

<!DOCTYPE html>
<html>
<head>
	<title>Lost Password</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />


</head>
<body style="background-color: yellowgreen;">

	<h1 style="margin-top: 150px; margin-left: 100px;">Reset your password</h1>
	<fieldset style="background-color: lightblue; margin-top: 250px; margin-left: 500px; width: 250px;
	height: 150px;">
	<form action="" method="POST">
		<div class="container" style="padding-top: 10px;">
			<label>E-mail:</label><br>
			<i class="fas fa-at"></i><input type="mail" name="mail">
		</div>

		<div class="container">
			<button style="margin-top: 10px;">Send<i class="fas fa-sign-in-alt"></i></button>
		</div>
	</fieldset>

</body>
</html>

<?php

if(isset($_POST['sub'])){

	$userEmail = $_POST['mail'];

	$selector = bin2hex(random_bytes(8));
	$token = random_bytes(32);

	$url = "localhost/form.php/lostpsw.php?selector=".$selector."&validator=".bin2hex($token);

	$expires = date("U") + 1800;

	$sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";

	$stmt = $pdo->prepare($sql);
	if(!$stmt->execute()){
		header("Location: lostpsw.php?error=sqlfail");
		exit();
	}

	else{

		mysqli_stmt_bind_param($stmt, "s", $userEmail);
		// $stmt->execute();
	}

	$sqli = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";

	$stmt2 = $pdo->prepare($sqli);
	if(!$stmt2->execute()){
		header("Location: lostpsw.php?error=sqlfail");
		exit();
	}else{
		$hashedToken = password_hash($token, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);

	}


	$to = $userEmail;

	$subject = "Reset your password";

	$message = "<p>We recieved a password reset request. The link to reset your password is below, if you did not make this request, you can ignore this email</p>";
	$message .= "<p>Here is your password reset link: </br>";
	$message .= "<a href='".$url."'>'".$url."'</a></p>";

	$headers = "From: diego <2028341@talnet.nl\r\n";

	$headers .= "Reply-To: 2028341@talnet.nl\r\n";

	$headers .= "Content-type: text/html\r\n";

	mail($to, $subject, $message, $headers);

	header("Location: lostpsw?reset=success");

}

?>