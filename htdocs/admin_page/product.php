<?php session_start(); 
  if(isset($_SESSION['username']) && isset($_SESSION['password'])){
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Redjoy's Admin</title>
    <!-- plugins:css -->
    <?php include('../templates/link.php');?>
    <link rel="stylesheet" href="../assets/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/admin_style.css">

    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/img/redjoyberry.png" />
    <style type="text/css">
      .table-hover img{
        width: 80px !important;
        height: 80px !important;
        border-radius: 0 !important;
      }
      #edit_product .modal-body table img{
        object-fit: cover;
        height: 200px;
        widows: 200px;
      }
      #edit_product #product_name, #edit_product #stock, #edit_product .input-group{
        width: 75%;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include('../templates/admin_navbar.php');?>
      <div class="container-fluid page-body-wrapper">
      <!-- partial -->
        <?php include('../templates/admin_sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Products</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="" class="btn-add-product" data-toggle="modal" data-target="#add_product">Add Product</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Product Items</li>
                </ol>
              </nav>
            </div>
            <div class="row justify-content-center">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Products</h4>
                  <table class="table table-hover" id="product-table">
                    <thead>
                      <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php include('../DataBase/all_product.php');
                    while($row = $result->fetch_assoc()):
                    ?>
                      <tr>
                        <td>
                          <img <?php echo "src='data:image/jpeg;base64,".base64_encode($row['product_img'])."'"; ?> alt="Product Image">
                        </td>
                        <td><?php echo $row['product_name'];?></td>
                        <td class="text-success">&#8369; <?php echo $row['product_price'];?></td>
                        <td><?php echo $row['stock'];?></td>
                        
                        <td>
                          <?php if($row['stock']==0){
                            echo '<label class="badge badge-success">Out of  Stock</label>';
                            }
                            else if($row['stock']<=25){
                            echo '<label class="badge badge-warning">Low Stock</label>';
                            }
                            else if($row['stock']<=50){
                            echo '<label class="badge badge-success">Available</label>';
                            }
                            else if($row['stock']>=51){
                            echo '<label class="badge badge-info">Fresh</label>';
                            }
                          ?>
                        </td>
                        <td> 
                          <button class="btn btn-social-icon btn-twitter btn-rounded btn-edit-product" data-toggle="modal" data-target="#edit_product" data-id="<?php echo $row['product_id'];?>"><i class="mdi mdi-table-edit"></i></button>
                          &nbsp;
                          <button class="btn btn-social-icon btn-youtube btn-rounded btn-delete-product" data-id="<?php echo $row['product_id'];?>"><i class="mdi mdi-delete-forever"></i></button>
                        </td>
                      </tr>
                     <?php endwhile; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-------------Modal-------------->
            <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="edit_product">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">     
                        
                </div>
              </div>
            </div>

            <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="add_product">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">     
                        
                </div>
              </div>
            </div>
            <!--------------Modal ends-------->
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <?php include('../templates/js_link.php');?>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/chart.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
<script type="text/javascript">
    $(document).on("click", ".btn-delete-product", function() {
        Swal.fire({
          title: 'Remove Product?',
          text: "Your product will be remove from the shop",
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
                    url: "../DataBase/delete_product.php",
                    data: {
                        "id": $(this).data("id")
                    },
                    success:function(data){
                        Swal.fire({
                        title: 'Removed!',
                        text: 'Your product has been removed.',
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
<script type="text/javascript">
    $(document).on("click", ".btn-edit-product", function() {
        $.ajax({
            type: "GET",
            url: "../templates/edit_product_form.php",
            data: {
                "id": $(this).data("id")
            }
        }).then(function(data) {
            $("#edit_product > .modal-dialog > .modal-content").html(data);
        });
    });
</script>
<script type="text/javascript">
    $(document).on("click", ".btn-add-product", function() {
        $.ajax({
            type: "GET",
            url: "../templates/add_product_form.php"
        }).then(function(data) {
            $("#add_product > .modal-dialog > .modal-content").html(data);
        });
    });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#product-table').DataTable();
  });
</script>

  </body>
</html>
<?php } 
else{
  header('Location:../login.php');
}?>