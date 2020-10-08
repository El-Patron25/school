<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

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
	}catch(PDOException $e){

		$this->textValue("error", "database connection fail ".$e->getMessage()); 
	}
	}

// 		Check if user exists
	private function userExists($user){
		try{
			$sql = "SELECT * FROM account WHERE username = :username";
		
		$err = "";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array(":username" => $user));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(!count($result) < 0) {
				$err .= $this->textValue("error", "username already exists");
	}
}catch(PDOException $e){
	$err .= $this->textValue("error", "an error ocurred ► ". $e->getMessage());
}
}
// 		Check if email exists
	private function emailExists($email){
		try{
			$sql = "SELECT * FROM account WHERE email = :email";
		
		$err = "";

			$stmt = $this->conn->prepare($sql);
			$stmt->execute(array(":email" => $email));
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if(!count($result) < 0) {
				$err .= $this->textValue("error", "email already exists");
	}
}catch(PDOException $e){
	$err .= $this->textValue("error", "an error ocurred ► ". $e->getMessage());
}
}
// 				Creates an account if user or mail not exists already
	private function create_account($usertype_id,$user, $email, $pass){
		
		$err = '';		

				try{

					$sqlo = "INSERT INTO account (username, email, password, usertype_id) VALUES (:username, :email, :password, :usertype_id);";
						
					$stmti = $this->conn->prepare($sqlo);
					$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
				
					$stmti->execute(array(
											":username" => $user,
											":email" => $email,
											":password" => $hashedPass,
											":usertype_id" => $usertype_id
										));
					$account_id = $this->conn->lastInsertId();
					return $account_id;

				}catch(PDOException $e){
					$err .= $this->textValue("error", "<br>insert account errror <br> <b>". $e->getMessage()."</b><br>");
				}
	
}

// ☼ alt 15 shortkey
		private function create_persoon($account_id, $voornaam, $tussenvoegsel, $achternaam){

			try{
			
					$sqli = "INSERT INTO persoon(voornaam, tussenvoegsel, achternaam, account_id) VALUES (:voornaam, :tussenvoegsel, :achternaam, :account_id);";
					
					$stmt2 = $this->conn->prepare($sqli);
					if(!$stmt2->execute(array(
											":voornaam" => $voornaam,
											":tussenvoegsel" => $tussenvoegsel,
											":achternaam" => $achternaam,
											":account_id" => $account_id
											)));
				}catch(PDOException $e){
					print_r($account_id);
					echo "<br>persoon error <br><b>" . $e->getMessage()."</b><br>";
				}

	}

		private function create_usertype(){
		
		$usertype_id = 7;
		$type = "user";
		$err = '';		
try{
		$sql = "INSERT INTO usertype (usertype_id, type) VALUES(:usertype_id, :type);";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(array(
							":usertype_id" => $usertype_id,
							":type" => $type
		));
		$usertype_id = $this->conn->lastInsertId();
		return $usertype_id;
	}catch(PDOException $e){
		echo "<br>usertype error <br><b>" . $e->getMessage()."</b><br>";
	}
}

		/*function to insert Users in Tabel account & table persoon*/
	public function signUp($voornaam, $tussenvoegsel, $achternaam, $email, $user, $pass) {

		$err = '';
		$pattern = "/^[a-zA-Z0-9]*$/";
		
		if(!preg_match($pattern, $user) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
			$err .= $this->textValue("error", "Syntax error");
		}else{
				try{
					$succes = "";
					$usertype_id = $this->create_usertype();
					$account_id = $this->create_account($usertype_id, $user, $email, $pass); 

					


					$this->create_persoon($account_id, $voornaam, $tussenvoegsel, $achternaam);
					$succes = $this->textValue("succes", "☼ het registreren is gelukt! ☼");
				}
					catch(PDOException $e){
						$err .= $this->textValue("error", "sign in error ► ".$e->getMessage());
					}
			}
		}


		public function userCheck(){

				try{

					$sql = "SELECT password fROM account WHERE email = ? AND password = ?";

					$stmt = $this->conn->prepare($sql);
					$stmt->execute(array('email' => $_REQUEST[$user],
										 'password' => $_REQUEST[$pass]));

					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$passhash = $result[0];
					print_r($passhash);
					$count = $stmt->rowCount();
					if(password_verify($pass, $passhash)){
							if($count > 0){
								$email = $_SESSION['email'];
								// $user = $_SESSION['username'];
							}
					}else{
						$this->textValue("error", "an error occured line 132");
					}


				}catch(PDOException $e){
					$this->textValue("error", "an error occured: ". $e->getMessage());
				}
		}

public function login($user, $pass){

		// $user = $this->userCheck();
		$email = $this->userCheck();
		$pattern = "/^[a-zA-Z0-9]*$/";

		if(!$email){
			$this->textValue("error", "an error occured");
		}else{
			if(empty($email) || empty($pass)){
				$this->textValue("error", "an error ocurred: empty fields");
			}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match($pattern, $user)){
					$this->textValue("error", "an error ocurred: something went wrong!");
			}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$this->textValue("error", "an error ocurred: Email Check");
			}elseif(!preg_match($pattern, $user)){
				$this->textValue("error", "an error ocurred: wrong user");
			}
		}

	}

}

?>