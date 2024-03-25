<?php 

include('connect.php');
session_start();

	if( isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['password']) && isset($_POST['total']) && isset($_POST['contact_no']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['province']) && isset($_POST['zip']) && isset($_POST['email']) && isset($_POST['m_pay']) ){
		
		$_POST['first_name'] = ucwords($_POST['first_name']);
		$_POST['last_name'] = ucwords($_POST['last_name']);

		mysqli_query($con, "INSERT INTO customer (first_name, last_name, password, total, contact_no, address, city, province, zip, email, m_pay, date, status, deliver) VALUES ('".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['password']."', '".$_POST['total']."', '".$_POST['contact_no']."', '".$_POST['address']."', '".$_POST['city']."', '".$_POST['province']."', '".$_POST['zip']."', '".$_POST['email']."', '".$_POST['m_pay']."', CURDATE(), 'Freshly Ordered', '0') ") or die($con->error);

		$result = mysqli_query($con, "SELECT last_insert_id() FROM customer") or die($con->error);
		$row_id = $result->fetch_assoc();

		foreach ($_SESSION['cart'] as $key => $row){
			mysqli_query($con, "INSERT INTO redjoy.order (product_id, product_name, quantity, price, customer_id) VALUES ('".$key."','".$row['product_name']."','".$row['quantity']."','".$row['price']."','".$row_id['last_insert_id()']."')") or die($con->error);

			$result = mysqli_query($con, "SELECT * FROM product WHERE product_id=".$key) or die($con->error);
			$row_stock = $result->fetch_assoc();
			$stock = $row_stock['stock'];
			$stock = $stock - $row['quantity'];

			mysqli_query($con, "UPDATE product SET stock =".$stock." WHERE product_id=".$key) or die($con->error);
		}

        $result = mysqli_query($con, "SELECT * FROM customer WHERE customer_id = ".$row_id['last_insert_id()']) or die($con->error);
        $row = $result->fetch_assoc();

        $result_count = mysqli_query($con, "SELECT COUNT(product_name) FROM redjoy.order WHERE customer_id=".$row['customer_id']) or die($con->error);
        $row_count = $result_count->fetch_assoc();

		echo "<ul class='list-group list-group-flush'>";
		echo "	<li class='list-group-item'>Order No. ".$row['customer_id']."</li>";
		echo "	<li class='list-group-item'>".$row['first_name']." ".$row['last_name']."</li>";
		echo "	<li class='list-group-item'>Number: ".$row['contact_no']."</li>";
		echo "	<li class='list-group-item'>Payment: ".$row['m_pay']."</li>";
		echo "	<li class='list-group-item'>Total: ".$row['total']."</li>";
		echo "	<li class='list-group-item'>Items Ordered: ".$row_count['COUNT(product_name)']."</li>";
		echo "	<li class='list-group-item'>Pin: ".$row['password']."</li>";
		echo "</ul>";
		$_SESSION['customer_id'] = $row['customer_id'];
	}
 ?>