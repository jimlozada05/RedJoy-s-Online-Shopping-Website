<?php 
	include('../DataBase/connect.php');
	 session_start();
	$result = mysqli_query($con, "SELECT * FROM product WHERE product_id=".$_GET['id']) or die($con->error);
	$row = $result->fetch_assoc();
?>
<div class="modal-header">
	<h5 class="modal-title">Edit Product</h5>
		<span type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" style="background-color: transparent;">&times;</span>
</div>
<form id="form-edit-product" enctype="multipart/form-data">
	<div class="modal-body">
		<div class="container-fluid">

			<table>
				<tr>
					<td>
						<input type="text" class="form-control" name="product_id" value="<?php echo $_GET['id'];?>" id="product_id" hidden>
					</td>
				</tr>
				<tr>
					<td width="50%">
						<label for="product_name">Product: </label>
						<input type="text" class="form-control" name="product_name" value="<?php echo $row['product_name'];?>" id="product_name">
					</td>
					<td  width="50%" rowspan="2">
						<img alt="Product Image" 
			<?php echo "src='data:image/jpeg;base64,".base64_encode($row['product_img'])."'"; ?>
						/>
					</td>
				</tr>

				<tr>
					<td>
						<label for="product_price">Price</label>
						<div class="input-group">
							<div class="input-group-prepend">
							    <span class="input-group-text" id="basic-addon1">&#8369;</span>
							  </div>
							<input type="text" class="form-control" name="product_price" value="<?php echo $row['product_price'];?>" id="product_price">
						</div>
					</td>
				</tr>
				
				<tr>
					<td>
						<label for="stock">Stock:</label>
						<input type="number" class="form-control" placeholder="Quantity" name="stock" id="stock" value="<?php echo $row['stock'];?>">
					</td>
					<td>
						<div class="form-group">
	                        <label style="cursor: pointer; color: blue;" onclick="change_image()">Change Product Image ?</label>
	                        <input type="file" class="form-control-file" id="product_img" disabled>
	                        <input type="hidden" id="image_value" name="image_value" readonly>
                     	</div>
			        </td>
				</tr>
			</table>
		</div>
	</div>

	<div class="modal-footer">
		<button class="btn btn-outline-primary" type="submit" id="submit"><i class="fal fa-edit"></i> Edit Product</button>						
	</div>

</form>
<script type="text/javascript">
	$("#form-edit-product").submit( function(e) {
		e.preventDefault();
		edit_product();
		}); 
	$("#form-edit-product").keypress(function(e){
		if(e.which == '13'){
			e.preventDefault();
			edit_product();
		}
	});
</script>
	<script type="text/javascript">
		function edit_product(){
			var form = $('form').get(0);
				$.ajax({
					type: "POST",
					url: "../DataBase/edit_product.php",
					data: new FormData(form),
					contentType: false,
					processData: false,
					success:function(data){
						Swal.fire({
							title: 'Product Changed!',
							text: 'Your product has been edited.',
							icon: 'success',
							timer: 2000
						}).then(function(){
							window.location.reload(true);
						});
					}
				});
			}
	</script>
<script type="text/javascript">
	function change_image(){
		$('#product_img').attr({
			'disabled': false,
			'name': "product_img",
			'required': true
		});
		$('#image_value').attr({
			'value': "stored"
		});
	}
</script>