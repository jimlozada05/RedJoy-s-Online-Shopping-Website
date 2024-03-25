<?php 
	include('../DataBase/connect.php');
	session_start();
	if(isset($_POST['check_submit'])){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Redjoy's Customer</title>
	<?php include('../templates/link.php');?>
	<style type="text/css">
	.btn.btn-icon {
	-webkit-appearance: button;
	color:white;
    width: 42px;
    height: 42px;
    padding: 0;
	}

	.btn.btn-rounded {
	    border-radius: 50px;
	}
	</style>
</head>
<body>
<h1>All Result</h1>
	<div class="row justify-content-center">
		<div class="container-fluid">
			<div class="col-lg-12">
			<table class="table table-hover">
				<thead class="thead-dark">
					<th>Order Number</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Amount</th>
					<th>Date</th>
					<th>Process</th>
					<th>Action</th>
				</thead>
				<tbody>
				<?php
				$result = mysqli_query($con, "SELECT * FROM customer WHERE first_name = '".$_POST['first_name']."' AND last_name = '".$_POST['last_name']."' AND email = '".$_POST['email']."' ORDER BY date DESC") or die($con->error);
				while($row = $result->fetch_assoc()):
				?>
				<tr>
					<td><?php echo $row['customer_id'];?></td>
					<td><?php echo $row['first_name'];?></td>
					<td><?php echo $row['last_name'];?></td>
					<td><?php echo $row['total'];?></td>
					<td><?php echo $row['date'];?></td>
					<td></td>
					<td>
					<form method="POST" action="../DataBase/process.php">
					<div class="form-row">
						<input type="hidden" name="customer_id" value="<?php echo $row['customer_id'];?>">

						<div class="form-group col-md-9">
						<input type="password" class="form-control" placeholder="Input Password" name="password" required>
						</div>

						<div class="form-group col-md-3">
						<button type="submit" name="customer_submit" value="customer_submit" class="btn btn-rounded btn-icon btn-primary"><i class="fal fa-sign-in"></i></button>
						</div>
					</div>
					</form>
					</td>
				</tr>
				<?php endwhile; ?>
				</tbody>
			</table>

			<button class="btn btn-outline-dark float-right px-5 mx-3" onclick="window.location.href='../logout.php'">Go Back</button>
			</div>
		</div>
	</div>


	<?php include('../templates/js_link.php');?>
</body>
</html>
<?php
}
else{
	header('Location:../index.php');
}
?>