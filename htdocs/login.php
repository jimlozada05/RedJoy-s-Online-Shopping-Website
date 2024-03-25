<!DOCTYPE html>
<html>
<head>
	<title>RedJoy's</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="assets/sweetalert/dist/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login_style.css">

</head>
<body>

	<div class="loginbox">
	<img src="assets/img/redjoyberry.png" class="avatar">
		<h1>Login</h1>
		<input type="text" hidden name="message" id="message" value="<?php echo $_GET['message'];?>">
		<form method="post" action="DataBase/process.php">
			<p>Username</p>
				<input type="text" name="username" placeholder="Enter Username" required> 
			<p>Password</p>
				<input type="password" name="password" placeholder="Enter Password" required>
			<button type="submit" name="login_submit" value="login_login">Login</button>
			<a href="index.php">Back to Order Menu</a>
		</form>
	</div>
<script type="text/javascript" src="assets/jquery/jquery-3.5.1.js"></script>
<script type="text/javascript" src="assets/sweetalert/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
window.onload = verify();
function verify(){					
	var message = $('#message').val();
	if( message == "wrong"){
		Swal.fire({
		  icon: 'error',	
		  title: 'Missing',
		  text: "The username and password doesn't exist",
		  timer: 2000
		}).then(function(){
			window.location.replace('login.php');
		});
	}
}
</script>
</body>
</html>