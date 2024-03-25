<?php 
	include('../DataBase/connect.php');
	session_start();
 ?>
<div class="modal-header">
	<h5 class="modal-title">Add Product</h5>
		<span type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" style="background-color: transparent;">&times;</span>
</div>
<form id="form-add-product" enctype="multipart/form-data">
	<div class="modal-body">
		<label for="product_name">Product Name:</label>
		<input type="text" class="form-control" name="product_name" id="product_name" required>
			<br>

		<label>Product Price: </label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">&#8369;</span>
			</div>
			<input type="text" class="form-control" id="product_price" name="product_price" required>
		</div>

		<label for="stock">Stock:</label>
		<div class="input-group mb-3">
			<input type="number" class="form-control" name="stock" id="stock" required>
		</div>

		<label>Product Image:</label>
		<input type="file" class="form-control-file" id="product_img" name="product_img" required>

	</div>

	<div class="modal-footer">
		<button class="btn btn-outline-primary" type="submit" id="submit"><i class="fal fa-edit"></i> Add Product</button>						
	</div>

</form>

<script type="text/javascript">
	$("#form-add-product").submit( function(e) {
		e.preventDefault();
		add_product();
	}); 
	$("#form-add-product").keypress(function(e){
		if(e.which == '13'){
			e.preventDefault();
			add_product();
		}
	});
</script>
	<script type="text/javascript">
		function add_product(){
			var form = $('form').get(0);
				$.ajax({
					type: "POST",
					url: "../DataBase/add_product.php",
					data: new FormData(form),
					contentType: false,
					processData: false,
					success:function(data){
						Swal.fire({
							title: 'Product Added!',
							text: 'Your product is now available.',
							icon: 'success',
							timer: 2000
						}).then(function(){
							window.location.reload(true);
						});
					}
				});
			}
	</script>