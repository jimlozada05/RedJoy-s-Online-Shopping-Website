<?php 
	include ('DataBase/connect.php');

	$result = mysqli_query($con, "SELECT * FROM redjoy.order INNER JOIN product ON order.product_id = product.product_id WHERE customer_id = ".$_SESSION['customer_id']) or die($con->error);

 ?>