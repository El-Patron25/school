<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
include "dbconnection.class.php";

class Login Extends components {

	public function loginUser($email, $pass){
				try{
					$db = new PDO("mysql:host=localhost;dbname=project1;", "root", "");
					$searchUser = "SELECT * fROM account WHERE email = :email";
					$getUserStmt = $db->prepare($searchUser);
					$getUserStmt->execute(array(
										":email" => $email
					));
					$result = $getUserStmt->fetch(PDO::FETCH_ASSOC);
					// var_dump($result);
					$passhash = $result['password'];
					$usertype_id = $result['usertype_id'];
					$username = $result['username'];
					
					
					
					if(!password_verify($pass, $passhash)){
						
						$this->textValue("error", "an error occured line 45 In login.class.php");
					}
						else{
							

								$user = "SELECT * FROM usertype WHERE usertype_id  = :usertype_id";
								$stmt_user = $db->prepare($user);
								$stmt_user->execute(array(
														":usertype_id" => $usertype_id
								));
								$check = $stmt_user->fetch(PDO::FETCH_ASSOC);
								// var_dump($check['type']);
								if($check['type'] != "user"){
								$_SESSION['username'] = $result['username'];
								// echo $_SESSION['username'];
								header("Location: admin.php");
							}elseif($check['type'] != "admin"){
								$_SESSION['username'] = $result['username'];
								// echo $_SESSION['username'];
								header("Location: index.php");
							}
						
					
					}


				}catch(PDOException $e){
					$this->textValue("error", "an error occured: ". $e->getMessage());
				}
			
		}
	

}



?>