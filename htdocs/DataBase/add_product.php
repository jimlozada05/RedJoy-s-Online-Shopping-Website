<?php 
	include('connect.php');
	session_start();

	if(isset($_POST['product_name'])){
		$image = addslashes(file_get_contents($_FILES['product_img']['tmp_name']));
		mysqli_query($con, "INSERT INTO product (product_name, product_price, product_img, stock) VALUES('".$_POST['product_name']."', '".$_POST['product_price']."' ,'".$image."' ,'".$_POST['stock']."' )") or die($con->error);
	}
 ?>