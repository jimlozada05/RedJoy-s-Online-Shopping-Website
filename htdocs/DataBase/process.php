<?php 
	include('connect.php');
	session_start();
	if(isset($_POST['st_submit'])){
		$_SESSION['customer_id'] = 'active';
		$_SESSION['total'] = '0';

		if($_SESSION['customer_id']!=null){
			header('Location:../customer_page/catalogue.php');
		}	 
	}

	if(isset($_POST['login_submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$result = mysqli_query($con, "SELECT * FROM admin WHERE username='".$username."' AND password='".$password."'") or die($con->error);
		if(mysqli_num_rows($result) == 1){
			$row = $result->fetch_assoc();
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$_SESSION['position'] = $row['position'];
			$_SESSION['picture'] = $row['picture'];
			header('Location:../admin_page/admin.php');
		}
		else{
			header("Location: ".$_SERVER['HTTP_REFERER']."?message=wrong");
		}
	}

	if(isset($_POST['customer_submit'])){
		$result = mysqli_query($con, "SELECT * FROM customer WHERE customer_id = '".$_POST['customer_id']."' AND password = '".$_POST['password']."'") or die($con->error);
		if($row = $result->fetch_assoc()){
			$_SESSION['customer_id'] = $row['customer_id'];
			header('Location:../transaction_page/see_order.php');
		}
	}
?>