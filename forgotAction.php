<?php
session_start();

if(isset($_SESSION["user_id"])) {
	header("location:panel.php");
	exit();
}
if(!isset($_POST['reset'])) {
	header("Location:forgot.php");
	exit();
}

require_once 'connect.php';


if(isset($_POST['reset'])) {
	$email = trim($_POST['email'] ?? "") ;
	if($email == "") {
		$_SESSION['zlymail'] = "Wpisz email";
		
	} 	else {
			
		$stmt = $polaczenie->prepare("SELECT id FROM users WHERE email = ?");
		$stmt->bind_param("s", $email);
		$stmt->execute();

		$rezultat = $stmt->get_result();
			if($rezultat->num_rows == 1) {
				$token = bin2hex(random_bytes(32));
				$expires = date("Y-m-d H:i:s", time() + 1000);
				
				$stmt = $polaczenie->prepare("UPDATE users SET resetToken=?, resetExpires=? WHERE email=?");
				$stmt->bind_param("sss",$token, $expires, $email);
				$stmt->execute();
				
				echo "<a href='reset.php?token=$token'>Kliknij aby zresetować hasło</a>";
				
				
			} else {
				$_SESSION['zlymail'] = "Email nieprawidłowy";
				header("Location:forgot.php");
				exit();
				
			}
		}	
}


?>



