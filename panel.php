<?php
session_start();

if(!isset($_SESSION["user_id"])) {
	header("location:index.php");
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
echo "Witaj " . $_SESSION["email"];
?>
 
 |  <a href = "wyloguj.php">Wyloguj sie</a>
 


</body>



</html>