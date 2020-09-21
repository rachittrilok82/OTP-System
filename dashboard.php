<?php

session_start();
if(isset($_SESSION['IS_LOGIN'])){
	echo "<h1>Login Successfull</h1>";
}else{
	header('location:index.php');
	die();
}
?>
<a href="logout.php">Logout</a>