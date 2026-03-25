<?php
session_start();
require_once 'connect.php';

if(isset($_SESSION["user_id"])) {
	header("location:panel.php");
	exit();
}



if(isset($_POST["rejestracja"])) {
	$email = trim($_POST["email"] ?? "");
	$haslo = trim($_POST["haslo"] ?? "");
	
	if($email == "" || $haslo == "") {
		echo "<span style = 'color:red;'> Wypełnij wszystkie pola</span>";
	} else {
		$stmt = $polaczenie->prepare("SELECT id FROM users WHERE email = ?");
		
		if(!$stmt) {
			die("Błąd zapytania: " . $polaczenie->error);
		}	
		
		$stmt->bind_param("s" , $email);
		$stmt->execute();
		$rezultat = $stmt->get_result();
		$stmt->close();
		
		if($rezultat->num_rows == 0) {
			
	
			
		$hash = password_hash($haslo, PASSWORD_DEFAULT);
	
		$stmt = $polaczenie->prepare("INSERT INTO users (email, pass) VALUES (?, ?)");
			if(!$stmt) {
				die("Błąd zapytania: " . $polaczenie->error);
			}
		$stmt->bind_param("ss", $email, $hash);
		$stmt->execute();
		$stmt->close();
	
		echo "<p style = 'color:blue;'>Zarejestrowano uzytkownika</p>";
		}	else { 
			echo "Podany email juz istnieje. Podaj inna.";
	}
	}
	
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	

</head>

<body>
 

 <form method="POST">
 
 Email: <br> <input type="email" name="email"/><br>
 Hasło: <br> <input type="password" name="haslo"/><br><br>
 <input type="submit" name="rejestracja" value="Zarejestruj"/>
 
 </form>
 <br>
  [<a href = "index.php">Zaloguj sie</a>]

</body>
</html>