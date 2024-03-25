<?php 
session_start();
include ('connect.php');
if(isset($_POST['product_id'])){

	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	if($_POST['quantity'] == 0){
		echo "none";
	}
	if(isset($_SESSION['cart']) && $_POST['quantity'] > 0){

		if(isset($_SESSION['cart'][$_POST['product_id']])){
			echo "ordered";
		}

		else{
			$_SESSION['cart'][$_POST['product_id']] = array('product_name' => $_POST['product_name'], 'product_price' => $_POST['product_price'], 'quantity' => $_POST['quantity'], 'price' => $_POST['price'], 'product_img' => $_SESSION['product_img']);	

			$_SESSION['total'] = $_POST['price'] + $_SESSION['total'];
		}
	}
}
 ?>