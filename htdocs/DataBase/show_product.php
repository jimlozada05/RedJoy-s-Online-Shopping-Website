<?php 
	include ('../DataBase/connect.php');
	if(!isset($_POST['search']) && empty($_POST['search'])){
		$filter = 'product_price';
			if(isset($_GET['filter'])){
				$filter = $_GET['filter'];
			}
		$sort = 'ASC';
			if(isset($_GET['sort'])){
				$sort = $_GET['sort'];
			}	
		$page = 1;
			if(isset($_GET['page'])){
				$page = $_GET['page'];
			}
		$limit = 25;
		$offset = $limit * ($page - 1);

		$result = mysqli_query($con, "SELECT * FROM product WHERE NOT stock = 0") or die($con->error);
		$num_rows = ceil(mysqli_num_rows($result) / $limit);

		$result = mysqli_query($con, "SELECT * FROM product WHERE NOT stock = 0 ORDER BY ".$filter." ".$sort." LIMIT ".$limit." OFFSET ".$offset) or die($con->error);
	}
	else{
		if(!empty($_POST['search']) && $_POST['search'] != ""){
			$result = mysqli_query($con, "SELECT * FROM product WHERE product_name LIKE '%".$_POST['search']."%' AND NOT stock = 0") or die($con->error);
			
			if(mysqli_num_rows($result) == 0){
				echo "<div class='row justify-content-center'>";
				echo "<h4 class='justify-content-center'>No existing product with '".$_POST['search']."' name<h4>";
				echo "</div>";
			}

			$divider=1;
			while($row = $result->fetch_assoc()):
				if ($divider==1){
					echo "<div class='row justify-content-center'>";
				}
				echo "<div class='col-sm-2'>";
				echo "<div class='card btn-view-product' data-toggle='modal' data-id='".$row['product_id']."' data-target='#buy_product'>";
				echo "<img class='card-img-top' alt='Card image cap' src='data:image/jpeg;base64,".base64_encode($row['product_img'])."' />";
				echo "<div class='card-body'>";
				echo "<h3>".$row['product_name']."</h3>";
				echo "<h5>&#8369; ".$row['product_price']."</h5>";
				echo "</div>";
				echo "</div>";
				echo "</div>";

				$divider++;
				if ($divider >= 6) {
					$divider = 1;
					echo "</div>";
				}
			endwhile;
		}
		if($_POST['search'] == "" || $_POST['search'] == " "){
			echo "reload";
		}
	}
 ?>