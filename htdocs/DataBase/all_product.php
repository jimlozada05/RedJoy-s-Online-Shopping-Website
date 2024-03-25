<?php 
	include ('../DataBase/connect.php');

	$result = mysqli_query($con,"SELECT * FROM product") or die($con->error); 
 ?>