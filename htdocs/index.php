<?php require('DataBase/connect.php') 

?>
<!DOCTYPE html>
<html>
<head>
	<title>RedJoy's</title>
	<link rel="icon" type="image/gif" href="assets/img/redjoyberry.png">
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome/web/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/st_style.css">
</head>
<body>
	<a href="login.php"><i class="fal fa-address-card"></i> Modulate</a>
	<br>
	<a href="#" data-toggle="modal" data-target="#view-customer-order"> <i class="far fa-search"></i> See Past Order</a>
	<form class="shop-form" action="Database/process.php" method="POST">
		<button name="st_submit" class="button btn-icon-text" value="st_submit" type="st_submit"><i class="fal fa-shopping-bag btn-icon-prepend"></i> Shop</button>
	</form>
	


<div class="modal fade" id="view-customer-order" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
    <form method="POST" action="transaction_page/all_result.php">
      <div class="modal-header">
        <h5 class="modal-title">View Past Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

      	<label for="first_name">First Name</label>
      	<input class="form-control" type="text" name="first_name" id="first_name" required
        style="text-transform: capitalize;">

      	<label for="last_name">Last Name</label>
      	<input class="form-control" type="text" name="last_name" id="last_name" required
        style="text-transform: capitalize;">

      	<label for="email">Email</label>
      	<input class="form-control" type="email" name="email" id="email" required>

      <div class="modal-footer">
        <button type="sbumit" name="check_submit" value="check_submit" class="btn btn-primary">Check</button>
      </div>
    </form>
    </div>
  </div>
</div>


	<script type="text/javascript" src="assets/jquery/jquery-3.5.1.js"></script>
	<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>