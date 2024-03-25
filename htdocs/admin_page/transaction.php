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
              <h3 class="page-title"> Transaction</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="" class="btn-add-transaction" data-toggle="modal" data-target="#add_transaction">Add Transaction</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Transaction Items</li>
                </ol>
              </nav>
            </div>
            <div class="row justify-content-center">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">All Transaction</h4>
                  <table class="table table-hover" id="transaction-table">
                    <thead>
                      <tr>
                        <th>Transaction</th>
                        <th width="50%">Transaction Description</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                          <button type="button" class="btn btn-inverse-info btn-rounded btn-icon">
                            <i class="mdi mdi-border-color "></i>
                          </button> 
                          &nbsp; 
                          <button type="button" class="btn btn-inverse-danger btn-rounded btn-icon">
                            <i class="mdi mdi mdi-undo"></i>
                          </button> 
                        </td>
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
    $(document).on("click", ".btn-delete-transaction", function() {
        Swal.fire({
          title: 'Remove Transaction?',
          text: "Your transaction will be remove from accounting",
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
                    url: "../DataBase/delete_transaction.php",
                    data: {
                        "id": $(this).data("id")
                    },
                    success:function(data){
                        Swal.fire({
                        title: 'Removed!',
                        text: 'Your transaction has been removed.',
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
    $(document).on("click", ".btn-edit-transaction", function() {
        $.ajax({
            type: "GET",
            url: "../templates/edit_transaction_form.php",
            data: {
                "id": $(this).data("id")
            }
        }).then(function(data) {
            $("#edit_transaction > .modal-dialog > .modal-content").html(data);
        });
    });
</script>
<script type="text/javascript">
    $(document).on("click", ".btn-add-transaction", function() {
        $.ajax({
            type: "GET",
            url: "../templates/add_transaction_form.php"
        }).then(function(data) {
            $("#add_transaction > .modal-dialog > .modal-content").html(data);
        });
    });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#transaction-table').DataTable();
  });
</script>

  </body>
</html>
<?php } 
else{
  header('Location:../login.php');
}?>