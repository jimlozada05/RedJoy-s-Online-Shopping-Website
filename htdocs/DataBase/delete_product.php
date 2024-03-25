<?php 
	include("connect.php");
	session_start();
	
	if(isset($_POST['id'])){
		mysqli_query($con, "DELETE FROM product WHERE product_id=".$_POST['id']) or die($con->error);
	}
 ?>