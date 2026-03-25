<?php
session_start();

if(isset($_SESSION["user_id"])) {
	header("location:panel.php");
	exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

</head>

<body>
 
<?php
if (isset($_SESSION["pustylogin"])) {
    echo $_SESSION["pustylogin"];
    unset($_SESSION["pustylogin"]);
}
?>
 
 <form action="logowanie.php" method="POST">
 
 Email: <br> <input type="email" name="email"/><br>
 Haslo: <br> <input type="password" name="haslo"/><br><br>
 <input type="submit" name="login" value="Zaloguj"/>
 
 
 </form>
<br>
  [<a href = "rejestracja.php">Zarejestruj sie</a>]


</body>



</html>