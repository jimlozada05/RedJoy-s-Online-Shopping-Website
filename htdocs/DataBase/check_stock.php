<?php 
	include('connect.php');
	session_start();
	if(isset($_POST['product_id'])){

		$result = mysqli_query($con, "SELECT * FROM product WHERE product_id = ".$_POST['product_id']) or die($con->error);

		$row = $result->fetch_assoc();
		echo $row['stock'];
	}
 ?>