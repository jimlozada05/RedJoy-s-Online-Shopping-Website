<?php 
	include("connect.php");
	session_start();
	
	if(isset($_POST['id'])){
	
		$less_price = $_SESSION['cart'][$_POST['id']]['price'];
		$_SESSION['total'] = $_SESSION['total'] - $less_price;

		unset($_SESSION['cart'][$_POST['id']]);

 	}
 ?>