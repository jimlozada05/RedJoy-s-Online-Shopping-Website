
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="nav-profile-image">
          <img <?php echo "src='data:image/jpeg;base64,".base64_encode($_SESSION['picture'])."'"; ?> alt="profile">
          <span class="login-status online"></span>
          <!--change to offline or busy as needed-->
        </div>
        <div class="nav-profile-text d-flex flex-column">
          <span class="font-weight-bold mb-2"><?php echo $_SESSION['last_name'];  echo ", &nbsp;";
            preg_match_all('/[A-Z]/', $_SESSION['first_name'], $matches);
            $result = implode('. ', $matches[0]);
            echo $result;
            echo ".";  
          ?></span>
          <span class="text-secondary text-small"><?php echo $_SESSION['position'];?></span>
        </div>
        <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="admin.php">
        <span class="menu-title">Dashboard</span>
        <i class="mdi mdi-chart-line menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="product.php">
        <span class="menu-title">Products</span>
        <i class="mdi mdi-animation menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Update Board</span>
        <i class="mdi mdi-bulletin-board menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="transaction.php">
        <span class="menu-title">Transactions</span>
        <i class="mdi mdi-book-open-page-variant menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="order.php">
        <span class="menu-title">Orders</span>
        <i class="mdi mdi-cart-outline menu-icon"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">
        <span class="menu-title">Employee</span>
        <i class="mdi mdi-account-multiple-outline menu-icon"></i>
      </a>
    </li>
    <li class="nav-item sidebar-actions">
      <span class="nav-link">
        <div class="border-bottom">
          <h6 class="font-weight-normal mb-3">Promote</h6>
        </div>
        <button class="btn btn-block btn-lg btn-gradient-primary mt-4">+ Add New Admin</button>
      </span>
    </li>
  </ul>
</nav>
<!-- partial -->