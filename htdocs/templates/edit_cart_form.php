<?php 
	include("../DataBase/connect.php");
	session_start();
	foreach ($_SESSION['cart'] as $key => $row) {
		if($key == $_GET['id']){
?>
<div class="modal-header">
	<h5 class="modal-title">Edit Cart</h5>
		<span type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" style="background-color: transparent;">&times;</span>
</div>
<form id="form-edit-cart">
	<div class="modal-body">
		<label>Product Name: </label>
			<br>
		<label><?php echo $row['product_name'];?></label>
			<br>

		<input type="text" name="product_id" value="<?php echo $key;?>" id="product_id" hidden>
		<input type="text" name="old_price" value="<?php echo $row['price'];?>" id="old_price" hidden>

		<label>Product Price: </label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">&#8369;</span>
			</div>
			<input type="text" class="form-control" aria-describedby="basic-addon1"
			value="<?php echo $row['product_price']?>" id="product_price" readonly>
		</div>

		<label>Quantity, Stock left:&nbsp;</label><label id="max-qty">Many</label>
		<div class="input-group mb-3">
			<input type="number" class="form-control" name="quantity" onkeyup="calculate_price()" onchange="calculate_price()" id="quantity" value="<?php echo $row['quantity']?>">
		</div>

		<label>Total Price: </label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text" id="basic-addon1">&#8369;</span>
			</div>
			<input type="text" class="form-control" aria-describedby="basic-addon1"
			value="<?php echo $row['price']?>" name="price" id="price" readonly>
		</div>

	</div>

	<div class="modal-footer">
		<button class="btn btn-outline-primary" type="submit" id="submit"><i class="fal fa-edit"></i> Edit Order</button>						
	</div>

</form>
<?php } } ?>
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
		$("#form-edit-cart").submit( function(e) {
			e.preventDefault();
			edit_cart();
			}); 
		$("#form-edit-cart").keypress(function(e){
			if(e.which == '13'){
				e.preventDefault();
				edit_cart();
			}
		});
	</script>
	<script type="text/javascript">
		function edit_cart(){	
			var product_id = $('#product_id').val();
			var quantity = $('#quantity').val();
			var price = $('#price').val();
			var old_price = $('#old_price').val();
				$.ajax({
					type: "POST",
					url: "../DataBase/edit_order.php",
					data: {
						"product_id": product_id,
						"quantity": quantity,
						"old_price": old_price,
						"price": price
					},
					success:function(data){
						Swal.fire({
							title: 'Cart Edited!',
							text: 'Your order has been edited.',
							icon: 'success',
							timer: 2000
						}).then(function(){
							window.location.reload(true);
						});
					}
				});
			}
	</script>