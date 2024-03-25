<?php require('../DataBase/connect.php'); 
	session_start();
	if($_SESSION['customer_id']!=null){	
		if(!isset($_GET['page'])){
			header("Location:?page=1");
		}
		else if(!isset($_GET['filter'])){
			header("Location:?page=".$_GET['page']."&filter=product_price");
		}
		else if(!isset($_GET['sort'])){
			header("Location:?page=".$_GET['page']."&filter=".$_GET['filter']."&sort=ASC");
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>RedJoy's Gift Shop</title>
	<?php include('../templates/link.php'); ?>
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/h_style.css">

</head>
<body>

	<header>
		<img class="h_logo" src="../assets/img/redjoy's.png"/>
		<div class="h_menu">

			<label id="total">&#8369; <?php echo $_SESSION['total'];?></label>
			<button class="btn btn-outline-primary-p btn-icon-text" onclick="window.location='cart.php'">
				<i class="fas fa-shopping-cart btn-icon-prepend"></i> Show Cart
			</button>
		</div>
	</header>

	<section id="promotion-area">
		<div class="row justify-content-center">
			<p>Thoughtful gift for everyone you can think of</p>
		</div>
		<div class="row justify-content-center">
			<div class="contacts">
				<button type="button" class="btn btn-gradient-info btn-rounded btn-icon" onclick="window.open('https://www.facebook.com/redjoys.giftshop', '_blank')">
					<i class="fab fa-facebook-square"></i>
				</button>

				<button type="button" class="btn btn-gradient-primary btn-rounded btn-icon" onclick="window.open('https://www.instagram.com/red.joys', '_blank')">
					<i class="fab fa-instagram"></i>
				</button>

				<button type="button" class="btn btn-gradient-danger btn-rounded btn-icon" onclick="window.open('https://www.gmail.com', '_blank')">
					<i class="far fa-envelope"></i>
				</button>

				<button type="button" class="btn btn-gradient-success btn-rounded btn-icon" onclick="window.open('https://www.googlemaps.com', '_blank')">
					<i class="mdi mdi-map-marker"></i>
				</button>
			</div>
		</div>
	</section>

	<section id="menus">
		<div class="container-fluid">
<!---Filter / Sort---->
		<div class="row justify-content-center">
			<nav class="navbar navbar-expand-lg navbar-light" style="width: 90%;">
			  <span class="navbar-brand">Sort <span class="fal fa-filter"></span></span>

			  <div class="collapse navbar-collapse">
			    <ul class="navbar-nav mr-auto" >
			      <?php if($_GET['filter'] == "product_price"){?>
			      <li class="nav-item active px-3">
			      	<?php if($_GET['sort'] == "ASC"){$sort = 'DESC';} 
			      	 if($_GET['sort'] == "DESC"){$sort = 'ASC';}?>
			        <a class="nav-link" href="?<?php echo "page=".$_GET['page']."&filter=".$_GET['filter']."&sort=".$sort;?>">Price 
			        <?php if($_GET['sort'] == "ASC"){?> 
			        	<i class="fa fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fal fa-level-down"></i>
			        <?php } if($_GET['sort'] == "DESC"){?>
			        	<i class="fal fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fa fa-level-down"></i>	        	
			        <?php } ?>
			        </a>
			      </li>
			      <?php } else{?>
			      <li class="nav-item px-3">
			        <a class="nav-link" href="?<?php echo "page=".$_GET['page']."&filter=product_price&sort=".$_GET['sort'];?>">Price 
			        	<i class="fal fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fal fa-level-down"></i>	
			        </a>
			      </li>
			      <?php } ?>

			      <?php if($_GET['filter'] == "product_name"){?>
			      <li class="nav-item active px-3">
			      	<?php if($_GET['sort'] == "ASC"){$sort = 'DESC';} 
			      	 if($_GET['sort'] == "DESC"){$sort = 'ASC';}?>
			        <a class="nav-link" href="?<?php echo "page=".$_GET['page']."&filter=".$_GET['filter']."&sort=".$sort;?>">Name 
			        <?php if($_GET['sort'] == "ASC"){?> 
			        	<i class="fa fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fal fa-level-down"></i>
			        <?php } if($_GET['sort'] == "DESC"){?>
			        	<i class="fal fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fa fa-level-down"></i>	        	
			        <?php } ?>	
			        </a>
			      </li>
			      <?php } else{?>      
			      <li class="nav-item px-3">
			        <a class="nav-link" href="?<?php echo "page=".$_GET['page']."&filter=product_name&sort=".$_GET['sort'];?>">Name 
			        	<i class="fal fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fal fa-level-down"></i>
			        </a>
			      </li>
			  	  <?php } ?>

			      <?php if($_GET['filter'] == "stock"){?>
			      <li class="nav-item active px-3">
			      	<?php if($_GET['sort'] == "ASC"){$sort = 'DESC';} 
			      	 if($_GET['sort'] == "DESC"){$sort = 'ASC';}?>
			        <a class="nav-link" href="?<?php echo "page=".$_GET['page']."&filter=".$_GET['filter']."&sort=".$sort;?>">Stock
			        <?php if($_GET['sort'] == "ASC"){?> 
			        	<i class="fa fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fal fa-level-down"></i>
			        <?php } if($_GET['sort'] == "DESC"){?>
			        	<i class="fal fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fa fa-level-down"></i>	        	
			        <?php } ?>
			        </a>
			      </li>
			      <?php } else{?> 
			      <li class="nav-item px-3">
			        <a class="nav-link" href="?<?php echo "page=".$_GET['page']."&filter=stock&sort=".$_GET['sort'];?>">Stock 
			        	<i class="fal fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fal fa-level-down"></i>	
			        </a>
			      </li>
			  	<?php } ?>

			      <?php if($_GET['filter'] == "date"){?>
			      <li class="nav-item active px-3">
			      	<?php if($_GET['sort'] == "ASC"){$sort = 'DESC';} 
			      	 if($_GET['sort'] == "DESC"){$sort = 'ASC';}?>
			        <a class="nav-link" href="?<?php echo "page=".$_GET['page']."&filter=".$_GET['filter']."&sort=".$sort;?>">Arrival 
			        <?php if($_GET['sort'] == "ASC"){?> 
			        	<i class="fa fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fal fa-level-down"></i>
			        <?php } if($_GET['sort'] == "DESC"){?>
			        	<i class="fal fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fa fa-level-down"></i>	        	
			        <?php } ?>
			        </a>
			      </li>
			      <?php } else{?> 
			      <li class="nav-item px-3">
			        <a class="nav-link disabled" href="?<?php echo "page=".$_GET['page']."&filter=date&sort=".$_GET['sort'];?>" tabindex="-1" aria-disabled="true">Arrival 
			        	<i class="fal fa-level-up fa-flip-horizontal"></i> 
			        	<i class="fal fa-level-down"></i>	        	
			        </a>
			      </li>			      	
			      <?php } ?>	
			    </ul>
			    <form class="form-inline my-2 my-lg-0 search-box">
			      <input class="search-product" type="search" placeholder="Find Item/s" aria-label="Search" onkeyup="search_product()" onchange="search_product()" id="search">
			      <i class="fal fa-search"></i>
			    </form>
			  </div>
			</nav>
		</div>
<!---End Filter / Sort---->
<!-------Gallery for all the Products--------->	
		<div id="product_menu">
			<?php
			include('../DataBase/show_product.php');
			$divider=1;
				while($row = $result->fetch_assoc()):
					if ($divider==1){
						echo "<div class='row justify-content-center'>";
					}
			?>
					<div class="col-sm-2">
						<div class="card btn-view-product" data-toggle="modal" data-id="<?php echo $row['product_id'];?>" data-target="#buy_product">
					    	
					    		<img class="card-img-top" alt="Card image cap"
			<?php echo "src='data:image/jpeg;base64,".base64_encode($row['product_img'])."'"; ?>					/>		
					  		
					    	<div class="card-body">
					    		<h3><?php echo $row['product_name'];?></h3>
					    		<h5>&#8369; <?php echo $row['product_price'];?></h5>
					    	</div>
					  	</div>
					</div>

			<?php 
			$divider++; 
			if ($divider >= 6) {
				$divider = 1;
				echo "</div>";
			}?>
			<?php endwhile; ?>
		</div>

		<nav aria-label="Page navigation example" style="padding-top: 2%;">
		  <ul class="pagination justify-content-end">
		    <li class="page-item">
		      <a class="page-link" href="?page=1" tabindex="-1" aria-disabled="true">First Page</a>
		    </li>
		    <?php
		    for($pages_number = $page - 2; $pages_number <= $page + 2; $pages_number++ ){
		    	if($pages_number == $page){
		    		?>
		    <li class="page-item active"><a class="page-link" href="?<?php echo "page=".$pages_number."&filter=".$_GET['filter']."&sort=".$_GET['sort'];?>"><?php echo $pages_number;?></a></li>
		    <?php }
		    	else if($pages_number > 0 && $pages_number <= $num_rows){ ?>
		    <li class="page-item"><a class="page-link" href="?<?php echo "page=".$pages_number."&filter=".$_GET['filter']."&sort=".$_GET['sort'];?>"><?php echo $pages_number;?></a></li>
			<?php }
			}?>
		    <li class="page-item">
		      <a class="page-link" href="?<?php echo "page=".$num_rows."&filter=".$_GET['filter']."&sort=".$_GET['sort'];?>">Last Page</a>
		    </li>
		  </ul>
		</nav>
<!-------End Gallery for all the Products--------->
<!------------------------Dynamin Modal-------------------->
			<div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" 
			id="buy_product">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">		
					
					</div>
				</div>
			</div>
		</div>
<!-----------End of Dyanmin Modal-------------->

	</section>

<?php include('../templates/js_link.php');?>
<script type="text/javascript">
	$(document).on("click", ".btn-view-product", function() {
		$.ajax({
		    type: "GET",
		    url: "../templates/add_cart_form.php",
		    data: {
		         "id": $(this).data("id")
		    }
		}).then(function(data) {
		    $("#buy_product > .modal-dialog > .modal-content").html(data);
		});
	});
</script>
<script type="text/javascript">
	function search_product(){
		var search = $('#search').val();
		let params = new URLSearchParams(location.search);
		var filter =  params.get('filter');
		var page =  params.get('page');
		var sort =  params.get('sort');
		$.ajax({
			type: "POST",
			url: "../DataBase/show_product.php",
			data:{
				"search": search,
				"filter": filter,
				"page": page,
				"sort": sort
			},
			success:function(data){
				if(data == "reload"){
					window.location.reload();
				}
				else{
					$('#product_menu').html(data);
				}
			}
		});
	}
</script>
</body>
</html>
<?php }
else{
	header('Location:../index.php');
}
?>