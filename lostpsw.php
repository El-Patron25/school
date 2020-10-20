<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

ini_set('display_errors',1); 
error_reporting(E_ALL);




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
<body>

	<h1>Reset your password</h1>
	<fieldset>
	<form action="lostpsw.php" method="GET">
		<div class="container" style="padding-top: 10px;">
			<label>E-mail:</label><br>
			<i class="fas fa-at"></i><input type="mail" name="pmail">
		</div>

		<div class="container">
			<button type="submit" name="sub" style="margin-top: 10px;">Send<i class="fas fa-sign-in-alt"></i></button>
		</div>
	</fieldset>

</body>
</html>

<?php

if(isset($_GET['sub'])) {




	$subject = "Reset your password";

	$message = "<p>We recieved a password reset request. The link to reset your password is below, if you did not make this request, you can ignore this email</p>";
	$message .= "<p>Here is your password reset link: </br>";


	$headers = "From: diego <difeloac21@gmail.com\r\n";

	$headers .= "Reply-To: difeloac21@gmail.com\r\n";

	$headers .= "Content-type: text/html\r\n";

	// mail($to, $subject, $message, $headers);




	try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'willekeurig mail adres';                     // SMTP username
    $mail->Password   = 'willekeurig wachtwoord';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('willekeurig mail adres');
    $mail->addAddress($_GET['pmail']);     // Add a recipient
    $mail->addReplyTo('willekeurig mail adres');

    // Attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}

?>