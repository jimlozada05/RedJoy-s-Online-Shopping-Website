<?php 
	include("../DataBase/connect.php");
	session_start();
	$result = mysqli_query($con,"SELECT * FROM product WHERE product_id =".$_GET['id']);
	$row = $result->fetch_assoc();
?>
<div class="modal-header">
	<h5 class="modal-title">Add to Cart</h5>
		<span type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" style="background-color: transparent;">&times;</span>
</div>
<form id="form-add-to-cart">
	<div class="modal-body">
		<div class="container-fluid">

			<table>
				<input type="text" name="product_id" value="<?php echo $_GET['id'] ?>" id="product_id" hidden>
				<tr>
					<td width="50%">
						<label>Product: </label><br><?php echo $row['product_name'];?>
						<input type="text" name="product_name"  hidden value="<?php echo $row['product_name'];?>" id="product_name">
					</td>
					<td  width="50%" rowspan="2">
						<img alt="Product Image" 
			<?php echo "src='data:image/jpeg;base64,".base64_encode($row['product_img'])."'"; ?>
						/>
						<?php $_SESSION['product_img'] = $row['product_img'];?>
					</td>
				</tr>

				<tr>
					<td>
						<label>Price for Each:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">&#8369;</span>
							</div>
							<input type="text" class="form-control" name="product_price" value="<?php echo $row['product_price'];?>" id="product_price" readonly>
						</div>
					</td>
				</tr>
				
				<tr>
					<td>
						<label>Stock Left: &nbsp;</label><label id="max-qty">Many</label>
						<input type="number" class="form-control" placeholder="Quantity" name="quantity" onkeyup="calculate_price()" onchange="calculate_price()" id="quantity" required>
					</td>
					<td>
						<label>Total Price:</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">&#8369;</span>
							</div>
							<input type="text" class="form-control" name="price" readonly id="price" value="0">
			        		</div>
			        </td>
				</tr>
			</table>
		</div>
	</div>

	<div class="modal-footer">
		<button class="btn btn-outline-success" type="submit"><i class="far fa-cart-plus"></i> Add to Cart</button>
	</div>
</form>
<script type="text/javascript">
function calculate_price(){
	var product_price = document.getElementById('product_price').value;
	var quantity = document.getElementById('quantity').value;
	document.getElementById('price').value = product_price*quantity;
	}
</script>
<script type="text/javascript">
	$("#quantity").keypress(function(e){
		var product_id = $("#product_id").val();
		var quantity = $("#quantity").val();
		$.ajax({
			type: "POST",
			url: "../DataBase/check_stock.php",
			data:{
				"product_id": product_id,
				"quantity": quantity
			},success:function(result){
				$("#quantity").attr({
					"max": result,
					"min": 0
				});
				$("#max-qty").html(result);
			}
		});
	});
</script>

	<script type="text/javascript">
		$("#form-add-to-cart").submit( function(e) {
			e.preventDefault();
			add_to_cart();
		});

		$("#form-add-to-cart").keypress(function(e) {
			if( e.which == '13'){
				e.preventDefault();
				add_to_cart();
			}	
		});  
	</script>
	<script type="text/javascript">
	function add_to_cart(){
		$.ajax({
			type: "POST",
			url: "../DataBase/add_order.php",
			data: $('#form-add-to-cart').serialize(),
			success:function(result){
				if(result == "ordered"){
					Swal.fire({
					  icon: 'error',
					  title: 'Already in the cart',
					  text: 'You can change the quantity you want in the cart',
					  timer: 2000
					})
				}
				if(result == "none"){
					Swal.fire({
					  icon: 'info',
					  title: 'No Order?',
					  text: "Your order doesn't have any quantity",
					  timer: 2000
					})
				}
				else{	
					Swal.fire({
						title: 'Added to Cart!',
						text: 'Your order has been placed.',
						icon: 'success',
						timer: 2000
					}).then(function(){
						window.location.reload();
					});
				}
			}
		});
	}

	</script>