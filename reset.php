<?php
session_start();
if(isset($_SESSION["user_id"])) {
	header("location:panel.php");
	exit();
}
require_once 'connect.php';

$token = $_GET['token'] ?? "";

	$stmt = $polaczenie->prepare("SELECT * FROM users WHERE resetToken = ? AND resetExpires > NOW()");
	$stmt->bind_param("s", $token);
	$stmt->execute();
	
	$result = $stmt->get_result();
	$user = $result->fetch_assoc();
	if(!$user) {
		die("Token nieważny lub wygasł");
	}


if(isset($_POST['zapisz'])) {
	if(empty($_POST['haslo'])) {
		$_SESSION['pusteh'] = "Wpisz nowe hasło";
	} else {
		
	$haslo = password_hash($_POST['haslo'], PASSWORD_DEFAULT);
	$stmt = $polaczenie->prepare("UPDATE users SET pass = ?, resetToken = NULL, resetExpires = NULL WHERE id = ?");
	$stmt->bind_param("si", $haslo, $user['id']);
	$stmt->execute();
	
	$_SESSION['sukces'] = "Hasło zostało zmienione";
	header("Location:index.php");
	exit();
	}
}
?>

<html>
<head>
</head>
<body>
<form method="POST">
	<input type="password" name="haslo">
	<button name="zapisz">Zmień hasło</button>
</form>
<?php
if (isset($_SESSION["pusteh"])) {
    echo "<span style = 'color:red'>". htmlspecialchars($_SESSION['pusteh']). "</span>";
    unset($_SESSION["pusteh"]);
}

?>

</body>

</html>