<?php 
include('connect.php');
session_start();

if($_POST['image_value'] == "stored"){
	$image = addslashes(file_get_contents($_FILES['product_img']['tmp_name']));
		mysqli_query($con, "UPDATE product SET product_name='".$_POST['product_name']."', product_price='".$_POST['product_price']."', product_img='".$image."', stock='".$_POST['stock']."' WHERE product_id=".$_POST['product_id']) or die($con->error);
}
if(empty($_POST['image_value'])){
	mysqli_query($con, "UPDATE product SET product_name='".$_POST['product_name']."', product_price='".$_POST['product_price']."', stock='".$_POST['stock']."' WHERE product_id=".$_POST['product_id']) or die($con->error);
}
?>