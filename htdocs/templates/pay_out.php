<?php 
	include("../DataBase/connect.php");
	session_start();
?>
<div class="modal-header">
	<h5 class="modal-title">Transaction</h5>
		<span type="button" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true" style="background-color: transparent;">&times;</span>
</div>
<form id="form-pay-out" style="overflow-y: auto !important;">
	<div class="modal-body">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="first_name">First Name</label>
				<input type="text" class="form-control" name="first_name" id="first_name" required style="text-transform: capitalize;">
			</div>
			<div class="form-group col-md-6">
				<label for="last_name">Last Name</label>
				<input type="text" class="form-control" name="last_name" id="last_name" required style="text-transform: capitalize;">
			</div>
		</div>

		<div class="form-group">
			<label for="address">Address</label>
			<input type="text" class="form-control" id="address" name="address" placeholder="Unit No# House # Street" required>
		</div>

		<div class="form-row">
			<div class="form-group col-md-5">
				<label for="province">Province</label>
				<select class="form-control" id="province" name="province" onkeyup="select_city()" onchange="select_city()" required>
					<option selected>Choose...</option>
					<?php include('province_option.php');?>
				</select>
			</div>
			<div class="form-group col-md-5">
				<label for="city">City</label>
				<select class="form-control" id="city" name="city" required>
				</select>
			</div>
			<div class="form-group col-md-2">
				<label for="zip">Zip</label>
				<input type="text" class="form-control" id="zip" name="zip" required>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="contact_no">Contact No.</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">#</span>
					</div>
					<input type="text" class="form-control" name="contact_no" id="contact_no" required>
				</div>	
			</div>
			<div class="form-group col-md-6">
				<label for="email">Email</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">@</span>
					</div>
					<input type="email" class="form-control" name="email" id="email" required>
				</div>	
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="total">Total Amount</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">&#8369;</span>
					</div>
					<input type="text" class="form-control" name="total" id="total" value="<?php echo $_SESSION['total'];?>" readonly>
				</div>	
			</div>
			<div class="form-group col-md-6">
				<label for="m_pay">Mode of Payment</label>
				<select id="m_pay" name="m_pay" class="form-control" required>
					<option>Smart Padala</option>
					<option>G Cash</option>
					<option>C.O.D.</option>
					<option>Credit Card</option>
					<option>Palawan</option>
					<option>7-11</option>
				</select>
			</div>
		</div>

		<div class="form-row" id="password_message_box">
			<p id="password_message"></p>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="password" id="password" onkeyup="verify_password()" onchange="verify_password()" required>
			</div>
			<div class="form-group col-md-6">
				<label for="confirm_password">Confirm Password</label>
				<input type="password" class="form-control" name="confirm_password" id="confirm_password" onkeyup="verify_password()" onchange="verify_password()" required>
			</div>

		</div>

	</div>
	<div class="modal-footer">
		<button class="btn btn-outline-primary" type="submit" id="submit"><i class="fal fa-edit"></i>Pay Out</button>						
	</div>
</form>
<script type="text/javascript">
		$("#form-pay-out").submit( function(e) {
			e.preventDefault();
			pay_out();
		}); 
		$("#form-pay-out").keypress( function(e) {
			if(e.which == '13'){
				e.preventDefault();
				pay_out();
			}
		}); 
</script>
<script type="text/javascript">
		function pay_out(){
				Swal.fire({
				  title: 'Proceed?',
				  text: "You can view your order later",
				  icon: 'info',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Continue'
				}).then((result) => {
				  if (result.value) {
				    $.ajax({
						type: "POST",
						url: "../DataBase/customer_pay_out.php",
						data: $('#form-pay-out').serialize(),
						success:function(data){
							Swal.fire({
								title: 'Thank You!',
								icon: 'success',
								html: data,
								footer: '<a href="#" onclick="print_receipt()">Download Receipt / Information</a>'
							}).then(function(){
								window.location.href = "../logout.php";
							});
						}
					});
				  }
				})
		}
</script>
<script type="text/javascript">
	function verify_password(){
		var pass = $("#password").val();
		var c_pass = $("#confirm_password").val();

		if(pass != "" && c_pass != ""){
			if(pass != c_pass || c_pass != pass){
				$('#password_message_box').removeClass('message_success');
				$('#password_message_box').addClass('message_error');
				$('#password_message').html("Password Do Not Match!");
				$('#submit').attr('disabled',true);
			}
			if(pass == c_pass){
				$('#password_message_box').removeClass('message_error');
				$('#password_message_box').addClass('message_success');
				$('#password_message').html("Password Match");
				$('#submit').attr('disabled',false);
			}

			if(pass == "" || c_pass == ""){
				$('#password_message_box').removeClass('message_error');
				$('#password_message_box').removeClass('message_success');
				$('#password_message').html("");
				$('#submit').attr('disabled',false);
			}
		}
	}
</script>
<script type="text/javascript">
	function select_city(){
		var selector = document.getElementById('province');
		var id = selector[selector.selectedIndex].id;
		$.ajax({
			type: "POST",
			url: "../templates/city_option.php",
			data:{
				"id": id
			},
			success:function(data){
				$('#city').html(data);
			}
		});
	}
</script>
<script type="text/javascript">
	var c_id = $('#c_id').val();
	function print_receipt(){
		$.ajax({
			url: "../receipt.php"
		});
	}
</script>