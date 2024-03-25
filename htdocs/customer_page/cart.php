<?php require('../DataBase/connect.php'); 
    session_start();
    if($_SESSION['customer_id']!=null){
?>
<!DOCTYPE html>
<html>
<head>
	<title>RedJoy's Gift Shop</title>
	<?php include('../templates/link.php'); ?>
	<link rel="stylesheet" type="text/css" href="../assets/css/cart_style.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/h_style.css">
</head>
<body>

	<header>
		<img class="h_logo" src="../assets/img/redjoy's.png"/>
		<div class="h_menu">

            <label id="total">&#8369; <?php echo $_SESSION['total'];?></label>
			<button class="btn btn-outline-primary-p btn-icon-text" onclick="window.location='catalogue.php'">
				<i class="fal fa-list btn-icon-prepend"></i> Show Catalogue
			</button>
		</div>
	</header>
	<section id="cart">
		<div class="container">
			<button class="btn btn-outline-danger btn-rounded btn-icon-text btn-pay-out" data-toggle="modal" data-target="#pay_out"><i class="fas fa-credit-card btn-icon-prepend"></i> Pay Out</button>
            <div class="row justify-content-center">
            	
                <div class="col-lg-7">
                    <div class="cart-table">
                        <div class="table-header text-center">
                            <h2 class="table-title">Items</h2>
                        </div>
                        <div class="table-content">
                            <table width="100%">
                               <thead>
                                    <th width="30%">Product Image</th>
                                    <th width="55%">Product Name</th>
                                    <th width="15%">Price</th>
                                </thead>
                            <?php if(isset($_SESSION['cart'])){ 
                            foreach ($_SESSION['cart'] as $key => $row){                    
                            ?>
                                <tr>
                                	<td width="30%">
                                        <img alt="Product Image" 
        <?php echo "src='data:image/jpeg;base64,".base64_encode($row['product_img'])."'"; ?>
                                        />
                                    </td> 
                                	<td width="55%"> <?php echo $row['product_name']; ?> </td>
                                	<td width="15%">&#8369; <?php echo $row['product_price']; ?></td>
                                </tr>
                            <?php } } ?>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="cart-table price">
                        <div class="table-header text-center">
                            <h2 class="table-title">Price</h2>
                        </div>
                        <div class="table-content">
                        <table width="100%">
                        		<thead>
                            		<th width="25%">Quantity</th>
                            		<th width="50%">Total Price</th>
                            		<th width="25%">Action</th>
                            	</thead>
                        <?php if(isset($_SESSION['cart'])){
                            foreach ($_SESSION['cart'] as $key => $row){ ?>
                                <tr>    
                                	<td width="25%"><?php echo $row['quantity']; ?> pcs.</td> 
                                	<td width="50%">&#8369; <?php echo $row['price']; ?></td>
                                	<td width="25%"><i class="far fa-times-circle" data-id="<?php echo $key;?>"></i>	 | 
                                		<i class="far fa-edit btn-view-product" data-toggle="modal" data-target="#edit_order" data-id="<?php echo $key?>"></i></td>
                                </tr>
                        <?php } } ?>
                        </table>
                        </div>
                    </div>
                </div>     
            </div>
        </div>

        <button class="btn btn-outline-dark btn-icon-text float-right m-5 p-3" onclick="window.location.href='../logout.php'"><i class="fal fa-times-circle btn-icon-prepend"></i> Cancel Shopping</button>
<!------------------------Dynamin Modal-------------------->
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="edit_order">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">     
                    
                </div>
            </div>
        </div>

        <div id="pay_out" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                
                </div>
            </div>
        </div>
    </section>
<!-----------End of Dyanmin Modal-------------->
    <?php include ('../templates/js_link.php'); ?>
    <script type="text/javascript">
        $(document).on("click", ".btn-view-product", function() {
            $.ajax({
                type: "GET",
                url: "../templates/edit_cart_form.php",
                data: {
                    "id": $(this).data("id")
                }
            }).then(function(data) {
                $("#edit_order > .modal-dialog > .modal-content").html(data);
            });
        });
    </script>
        <script type="text/javascript">
        $(document).on("click", ".btn-pay-out", function() {
            $.ajax({
                type: "GET",
                url: "../templates/pay_out.php",
            }).then(function(data) {
                $("#pay_out > .modal-dialog-scrollable > .modal-content").html(data);
            });
        });
    </script>
<script type="text/javascript">
    $(document).on("click", ".fa-times-circle", function() {
        Swal.fire({
          title: 'Remove order?',
          text: "Your order will be removed on the cart",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => 
        {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "../DataBase/delete_order.php",
                    data: {
                        "id": $(this).data("id")
                    },
                    success:function(data){
                        Swal.fire({
                        title: 'Removed!',
                        text: 'Your order has been removed.',
                        icon: 'success',
                        }).then(function(){
                            window.location.reload(true);
                        });
                    }
                });
            }
        })
    });
</script>

</body>
</html>
<?php }
else{
    header('Location:../index.php');
}
?>