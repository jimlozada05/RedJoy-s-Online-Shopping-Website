<?php 
    include('../DataBase/connect.php');
    session_start();
    if(isset($_SESSION['customer_id'])){
        $result = mysqli_query($con, "SELECT * FROM customer WHERE customer_id = ".$_SESSION['customer_id']) or die($con->error);
        $row = $result->fetch_assoc();

        $result_count = mysqli_query($con, "SELECT COUNT(product_name) FROM redjoy.order WHERE customer_id=".$row['customer_id']) or die($con->error);
        $row_count = $result_count->fetch_assoc();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!--====== Title ======-->
    <title>Redjoy's Customer</title>

    <!--====== Bootstrap css ======-->
    <?php include('../templates/link.php');?>
    <!--====== Animate css ======-->
    <link rel="stylesheet" href="../assets/css/animate.css">
    
    <!--====== Magnific Popup css ======-->
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    
    <!--====== Slick css ======-->
    <link rel="stylesheet" href="../assets/css/slick.css">
    
    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="../assets/css/LineIcons.css">
    
    <!--====== Default css ======-->
    <link rel="stylesheet" href="../assets/css/default.css">
    
    <!--====== Style css ======-->
    <link rel="stylesheet" href="../assets/css/customer_style.css">
    
    <!--====== Responsive css ======-->
    <link rel="stylesheet" href="../assets/css/responsive.css">
  
  
</head>

<body>
    
    <!--====== HEADER PART START ======-->
    
    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="navbar-brand">
                            <img src="../assets/img/redjoy's.png" alt="Logo">
                        </div> <!-- Logo -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="bar-icon"></span>
                            <span class="bar-icon"></span>
                            <span class="bar-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <p data-scroll-nav="0">Order No. <?php echo $row['customer_id'];?></p>
                                </li>
                                <li class="nav-item">
                                    <p data-scroll-nav="0"><?php echo $row['first_name'];?>&nbsp; <?php echo $row['last_name'];?></p>
                                </li>
                                <li class="nav-item">
                                    <a data-scroll-nav="0" href="../logout.php">Sign Out</a>
                                </li>
                            </ul> <!-- navbar nav -->
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </header>
    
    <!--====== HEADER PART ENDS ======-->

    <!--====== SERVICES PART START ======-->
    
    <section id="service" class="services-area pt-125 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-30">
                        <h5 class="mb-15">Information</h5>
                    </div> <!-- section title -->
                </div>
            <div class="slider-social">
                <div class="row justify-content-end">
                    <div class="col-lg-7 col-md-6">
                        <ul class="social text-right">
                            <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                            <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                            <li><a href="#"><i class="lni-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>

            <div class="row">
                <div class="col-lg-6">

                    <div class="services-right mt-45">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-8">
                                <div class="single-services text-center">
                                    <div class="services-icon">
                                        <i>&#8369;</i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Total Amount</h5>
                                        <p>
                                            <?php echo $row['total'];?>
                                            <br>
                                            <?php echo $row_count['COUNT(product_name)'];?> order/s
                                        </p>
                                    </div>
                                </div> <!-- single services -->
                                
                                <div class="single-services text-center mt-30">
                                    <div class="services-icon">
                                        <i class="fal fa-phone"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Contact</h5>
                                        <p><?php echo $row['contact_no'];?></p>
                                    </div>
                                </div> <!-- single services -->
                            </div>
                            <div class="col-md-6 col-sm-8">
                                <div class="single-services text-center mt-30">
                                    <div class="services-icon">
                                        <i class="fal fa-map-marked-alt"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Address</h5>
                                        <p><?php echo $row['address'];?></p>
                                    </div>
                                </div> <!-- single services -->
                                
                                <div class="single-services text-center mt-30">
                                    <div class="services-icon">
                                        <i class="fal fa-calendar-plus"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Date Ordered</h5>
                                        <p><?php echo $row['date'];?></p>
                                    </div>
                                </div> <!-- single services -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- services right -->     

                </div>
                <div class="col-lg-6">
                    
                    <div class="services-right mt-45">
                        <div class="row justify-content-center">
                            <div class="col-md-6 col-sm-8">
                                <div class="single-services text-center">
                                    <div class="services-icon">
                                        <i class="fal fa-map-marker-alt"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Location</h5>
                                        <p>
                                            <?php echo $row['province'];?>
                                            <br>
                                            <?php echo $row['city'];?>
                                            <br>
                                            <?php echo $row['zip'];?>
                                        </p>
                                    </div>
                                </div> <!-- single services -->
                                
                                <div class="single-services text-center mt-30">
                                    <div class="services-icon">
                                        <i class="fal fa-money-bill-wave-alt"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Payment</h5>
                                        <p>
                                            <?php echo $row['m_pay'];?>
                                            <br>
                                            Other Information
                                        </p>
                                    </div>
                                </div> <!-- single services -->
                            </div>
                            <div class="col-md-6 col-sm-8">
                                <div class="single-services text-center mt-30">
                                    <div class="services-icon">
                                        <i class="lni-customer"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Email</h5>
                                        <p><?php echo $row['email'];?></p>
                                    </div>
                                </div> <!-- single services -->
                                
                                <div class="single-services text-center mt-30">
                                    <div class="services-icon">
                                        <i class="fal fa-info"></i>
                                    </div>
                                    <div class="services-content mt-20">
                                        <h5 class="title mb-10">Status</h5>
                                        <p>
                                            <?php echo $row['status'];?>  
                                        </p>
                                    </div>
                                </div> <!-- single services -->
                            </div>
                        </div> <!-- row -->
                    </div> <!-- services right -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== SERVICES PART ENDS ======-->
   
    <!--====== PRODUCT PART START ======-->
    
    <section id="product" class="product-area pt-100 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="collection-menu text-center mt-30">
                        <h4 class="collection-tilte">My Order/s</h4>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="active" id="v-pills-name-tab" data-toggle="pill" href="#v-pills-name" role="tab" aria-controls="v-pills-name" aria-selected="true">Name</a>
                        </div> <!-- nav -->
                    </div> <!-- collection menu -->
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="tab-content" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-name" role="tabpanel" aria-labelledby="v-pills-name-tab">
                            <div class="product-items mt-30">
                                <div class="row product-items-active">
                        <?php $result_order = mysqli_query($con, "SELECT product.product_img, product.product_name, product.product_price, redjoy.order.quantity, redjoy.order.price FROM redjoy.order JOIN product ON redjoy.order.product_id = product.product_id WHERE customer_id =".$row['customer_id']) or die($con->error);
                        while ($row_order = $result_order->fetch_assoc()):
                        ?>
                                    <div class="col-md-10">
                                        <div class="single-product-items">
                                            <div class="product-item-image">
                                                <a href="#">
                                                    <img alt="Product" 
                            <?php echo "src='data:image/jpeg;base64,".base64_encode($row_order['product_img'])."'"; ?>/>
                                                </a>
                                                <div class="product-discount-tag">
                                                    <p>&#8369; <?php echo $row_order['product_price'];?></p>
                                                </div>
                                            </div>
                                            <div class="product-item-content text-center mt-30">
                                                <h5 class="product-title"><a href="#"><?php echo $row_order['product_name'];?></a></h5>
                                                <span> <?php echo $row_order['quantity'];?> pcs. </span>
                                                <br>
                                                <span class="regular-price">&#8369; <?php echo $row_order['price'];?></span>
                                            </div>
                                        </div> <!-- single product items -->
                                    </div>
                        <?php endwhile; ?>
                                </div> <!-- row -->
                            </div> <!-- product items -->
                        </div> <!-- tab pane -->

                    </div> <!-- tab content --> 
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PRODUCT PART ENDS ======-->

    <!--====== TEAM PART START ======-->
    
    <section id="team" class="team-area pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-25">
                        <h3 class="title mb-15">Delivery Man</h3>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 col-sm-8">
                    <div class="single-temp text-center mt-30">
                        <?php $delivery_result =  mysqli_query($con, "SELECT * FROM customer JOIN employee on customer.deliver = employee.employee_id WHERE customer_id = ".$row['customer_id']) or die($con->error);
                        if($delivery_row = $delivery_result->fetch_assoc()){
                        ?>
                        <div class="team-content mt-30">
                            <img style="height: 100px; width: 100px;" <?php echo "src='data:image/jpeg;base64,".base64_encode($delivery_row['picture'])."'"; ?>>
                            <h4 class="title mb-10"><?php echo $delivery_row['first_name'];?>&nbsp;<?php echo $delivery_row['last_name'];?></h4>
                            <span>Age: <?php echo $delivery_row['age'];?></span>
                            <span>Contact Number: <?php echo $delivery_row['contact_no'];?></span>
                            <span></span>
                            <ul class="social mt-15">
                                <li><i class="fab fa-google-plus-g"></i></li>
                            </ul>
                        </div>
                        <?php } 
                        else{ ?>
                        <div class="team-content mt-30">
                            <h2 class="title mb-10">There is no delivery personnel assigned yet.</h2>
                        </div>
                        <?php } ?>
                    </div> <!-- single temp -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== TEAM PART ENDS ======-->

    <!--====== CONTACT PART START ======-->
    
    <section id="contact" class="contact-area pt-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="contact-title text-center">
                        <h2 class="title">Get In Touch</h2>
                    </div> <!-- contact title -->
                </div>
            </div> <!-- row -->
            <div class="contact-box mt-70">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact-info pt-25">
                            <h4 class="info-title">Contact Info</h4>
                            <ul>
                                <li>
                                    <div class="single-info mt-30">
                                        <div class="info-icon">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>+88 1234 56789</p>
                                        </div>
                                    </div> <!-- single info -->
                                </li>
                                <li>
                                    <div class="single-info mt-30">
                                        <div class="info-icon">
                                            <i class="lni-envelope"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>contact@yourmail.com</p>
                                        </div>
                                    </div> <!-- single info -->
                                </li>
                                <li>
                                    <div class="single-info mt-30">
                                        <div class="info-icon">
                                            <i class="lni-home"></i>
                                        </div>
                                        <div class="info-content">
                                            <p>203, Envato Labs, Behind Alis Steet,Australia</p>
                                        </div>
                                    </div> <!-- single info -->
                                </li>
                            </ul>
                        </div> <!-- contact info -->
                    </div> 
                    <div class="col-lg-8">
                        <div class="contact-form">
                            <form id="contact-form" action="../assets/contact.php" method="post" data-toggle="validator">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-form form-group">
                                            <input type="text" name="name" placeholder="Enter Your Name" data-error="Name is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-form form-group">
                                            <input type="email" name="email" placeholder="Enter Your Email"  data-error="Valid email is required." required="required">
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single-form form-group">
                                            <textarea name="message" placeholder="Enter Your Message" data-error="Please,leave us a message." required="required"></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div> <!-- single form -->
                                    </div>
                                    <p class="form-message"></p>
                                    <div class="col-lg-12">
                                        <div class="single-form form-group">
                                            <button class="main-btn" type="submit">CONTACT NOW</button>
                                        </div> <!-- single form -->
                                    </div>
                                </div> <!-- row -->
                            </form>
                        </div> <!-- row -->
                    </div> 
                </div> <!-- row -->
            </div> <!-- contact box -->
        </div> <!-- container -->
    </section>
    
    <!--====== CONTACT PART ENDS ======-->
    
    <!--====== BACK TO TOP PART START ======-->
    
    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>
    
    <!--====== BACK TO TOP PART ENDS ======-->
    
    
    <!--====== jquery js ======-->
    <script src="../assets/js/modernizr-3.6.0.min.js"></script>
    

    <!--====== Bootstrap js ======-->
    <?php include('../templates/js_link.php');?>
    
    
    <!--====== Slick js ======-->
    <script src="../assets/js/slick.min.js"></script>
    
    <!--====== Magnific Popup js ======-->
    <script src="../assets/js/jquery.magnific-popup.min.js"></script>

    
    <!--====== nav js ======-->
    <script src="../assets/js/jquery.nav.js"></script>
    
    <!--====== Nice Number js ======-->
    <script src="../assets/js/jquery.nice-number.min.js"></script>
    
    <!--====== Main js ======-->
    <script src="../assets/js/customer.js"></script>

</body>
</html>
<?php 
} 
else{
    header("Location:../index.php");
}
?>
