<?php
session_start();

require_once 'connect.php';


if((!isset($_POST["login"])) || (!isset($_POST['haslo']))) {
	header("location:index.php");
	exit();
}

?>




<?php


if(isset($_POST["login"])) {
$email = trim($_POST["email"] ?? "");
$haslo = trim($_POST["haslo"] ?? "");

	if($email == "" || $haslo == "") {

		$_SESSION["pustylogin"] = "WPISZ DANE";
		header('location:index.php');
		exit();
		

		
	} else {
		
$stmt = $polaczenie->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$wynik = $stmt->get_result();

if($wynik->num_rows > 0) {
	$user = $wynik->fetch_assoc();

	if(password_verify($haslo, $user["pass"])) {
		$_SESSION["user_id"] = $user["ID"];
		$_SESSION["email"] = $user["email"];

		
		header('location:panel.php');
		exit();

		
	} else {
		$_SESSION["pustylogin"] = "BŁEDNE HASŁO";
		header('location:index.php');
		exit();
		
	}
	} else {
		$_SESSION["pustylogin"] = "Uzytkownik nie istnieje";
		header('location:index.php');
		exit();
		
	}
	$stmt->close();
}


}


?>
