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
 
 <form method="POST" action="forgotAction.php">
 
 Podaj email: <br> <input type="email" name="email"/><br>
 <br>
 <button name="reset">Resetuj hasło</button>
 
 
 </form>
 
<?php

if (isset($_SESSION["zlymail"])) {
    echo "<span style = 'color:red'>". htmlspecialchars($_SESSION['zlymail']). "</span>";
    unset($_SESSION["zlymail"]);
}
	echo "<br>";
	echo "<span style = 'color:red'>". htmlspecialchars($brak ?? "") ."</span>";
	echo "<br>";
	


?>


</body>



</html>