<?php

	class dbconnection extends components {

		/* Properties*/
		private $host;
		private $database;
		private $user;
		private $pass;
		private $conn;
		private $options;

		/* constructor*/ 
	public function __construct($host, $database, $user, $pass, $charset){

		$this->host = $host;
		$this->database = $database;
		$this->user = $user;
		$this->pass = $pass;
		$this->options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
		try{
		$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database;", $user, $pass, $this->options);
	}catch(Exceptions $e){
		textValue("error", "database connection fail ".$e);
	}
	}

	/*function to insert Users in Tabel*/
	public function signIn($voornaam, $tussenvoegsel, $achternaam, $email, $user, $pass, $passr) {


		$pattern = "/^[a-zA-Z0-9]*$/";
		$errormsg = $this->textValue("error", "");

		if(!preg_match($pattern, $user) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errormsg .= $this->textValue("error", "Syntax error");
		}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errormsg .= $this->textValue("error", "please fill in valid email\n");
		}elseif($pass !== $passr){
			$errormsg .= $this->textValue("error", "password is not the same!\n");
		}else{
			$sql = "SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array("gebruikersnaam" => $user));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(!count($result) < 0) {
				$errormsg .= $this->textValue("error", "Username already exists\n");
			}else{
				$sql = "INSERT INTO account (username, email, password) VALUES (:username, :email, :password);";
						
				$stmt = $this->conn->prepare($sql);
				$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
				$stmt->execute(array(
										":username" => $user,
										":email" => $email,
										":password" => $hashedPass
									));

				$sqli = "INSERT INTO persoon(voornaam, tussenvoegsel, achternaam) VALUES (:voornaam, :tussenvoegsel, :achternaam);";
				$stmt2 = $this->conn->prepare($sqli);
				$stmt2->execute(array(
										":voornaam" => $voornaam,
										":tussenvoegsel" => $tussenvoegsel,
										":achternaam" => $achternaam
										));
			}
		}

	}
}

?>