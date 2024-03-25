<?php 
	$con = mysqli_connect('127.0.0.1','root','root','redjoy');

	if(!$con){
		echo 'Connection error' . mysqli_connect_error();
	}

 ?>