<?php 
session_start();
include ('connect.php');
if(isset($_POST['product_id'])){

	$product_name = $_SESSION['cart'][$_POST['product_id']]['product_name'];
	$product_price = $_SESSION['cart'][$_POST['product_id']]['product_price'];
	$product_img = $_SESSION['cart'][$_POST['product_id']]['product_img'];

	$_SESSION['cart'][$_POST['product_id']] = array('product_name' => $product_name, 'product_price' => $product_price, 'quantity' => $_POST['quantity'], 'price' => $_POST['price'], 'product_img' => $product_img);		

	$price = $_POST['price'] - $_POST['old_price'];

	$_SESSION['total'] = $_SESSION['total'] + $price;

	if($_POST['price']==0){
		unset($_SESSION['cart'][$_POST['product_id']]);	
	}
}
?>