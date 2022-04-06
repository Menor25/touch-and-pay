<?php
        include('private/database.php');
        include('private/functions.php');


    $Error = "";
?>
<?php


        $stmt_setting = $connection->prepare('SELECT * FROM website_setting');
        $stmt_setting->execute();
        $result = $stmt_setting->get_result();


        while ($row = $result->fetch_assoc()) {
            $siteTitle = $row['title'];
            $fb_link = $row['fb_link'];
            $twitter_link = $row['twitter_link'];
            $youtube_link = $row['youtube_link'];
            $instagram_link = $row['instagram_link'];
            $logo = $row['logo'];
            $address = $row['address'];
            $phone_number = $row['phone_number'];
            $email = $row['email'];
        }
        $stmt_setting->close();
        // echo $logo;

?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">

    <!-- Site title -->
    <title><?= $siteTitle; ?> | Login-Register</title>
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" /> -->
    <!-- Bootstrap CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="../assets/css/font-awesome.css" rel="stylesheet">
    <!-- IonIcon CSS -->
    <link href="../assets/css/ionicons.min.css" rel="stylesheet">
    <!-- helper class css -->
    <link href="../assets/css/helper.min.css" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="../assets/css/plugins.css" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>


    <!-- header area start -->
    <header>

        <!-- main menu area start -->
        <div class="header-main sticky">
            <div class="container">
                <div class="row align-items-center" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="logo">
                            <a href="home">
                                <img src="images/../<?=$logo;?>" alt="Brand logo" width="130">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="main-header-inner">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li><a href="../home">Home</a></li>

                                        <li><a href="../shop">shop</a> </li>
                                        <li><a href="../about">About-us</a></li>
                                        <li><a href="../contact">Contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 d-block d-lg-none">
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main menu area end -->

    </header>
    <!-- header area end -->

    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Login-Register</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <main>
        <!-- login register wrapper start -->
        <div class="login-register-wrapper pt-100 pb-100 pt-sm-58 pb-sm-58">
            <div class="container">
                <div class="member-area-from-wrap">
                    <div class="row">
                        <!-- Login Content Start -->
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap  pr-lg-50">
                                <h2>Sign In</h2>
                                <?php
                                    if(isset($_POST['login_btn'])){
                                        $username = trim($_POST['username']);
                                        $password = trim($_POST['password']);
                                    
                                            adminLogin($username, $password);
                                      
                                    }
                                ?>
                                <form action="#" method="post">
                                    <?php 
                                        if(isset($_POST['login_btn'])){
                                            if(isset($_SESSION[$Error])): 
                                            ?>
                                            
                                        <div class="alert alert-<?= $_SESSION['msg_type']; ?>">
                                            <?php
                                                echo $_SESSION[$Error];
                                                unset($_SESSION[$Error]);
                                        
                                            ?>
                                        </div>
                                    <?php endif;} ?>
                                    <div class="single-input-item">
                                        <input type="text" name="username" placeholder="Username" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="password" name="password" placeholder="Enter your Password" required />
                                    </div>
                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="remember-meta">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="rememberMe">
                                                    <!-- <label class="custom-control-label" for="rememberMe">Remember Me</label> -->
                                                </div>
                                            </div>
                                            <!-- <a href="#" class="forget-pwd">Forget Password?</a> -->
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <button class="sqr-btn" name="login_btn">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Content End -->

                        <!-- Register Content Start -->
                        <div class="col-lg-6">
                            <div class="login-reg-form-wrap mt-md-100 mt-sm-58">
                                <h2>Signup Form</h2>
                                <?php
                                    if(isset($_POST['btn_register']))
                                    {
                                    
                                        insertUser(
                                    
                                            $full_name              = trim($_POST['full_name']),
                                            $email                  = trim($_POST['email']),
                                            $username               = trim($_POST['username']),
                                            $password               = trim($_POST['password']),
                                            $confirm_password       = trim($_POST['confirm_password']),
                                    
                                        );
                                        
                                        // header('Location: addd-class.php');
                                    }
                                ?>
                                <form action="#" method="post">
                                    <?php 
                                        if(isset($_POST['btn_register'])){
                                            if(isset($_SESSION[$Error])): 
                                            ?>
                                            
                                    <div class="alert alert-<?= $_SESSION['msg_type']; ?>">
                                        <?php
                                            echo $_SESSION[$Error];
                                            unset($_SESSION[$Error]);
                                    
                                        ?>
                                    </div>
                                    <?php endif;} ?>
                                    <div class="single-input-item">
                                        <input type="text" name="full_name" placeholder="Full Name" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="email" name="email" placeholder="Enter your Email" required />
                                    </div>
                                    <div class="single-input-item">
                                        <input type="text" name="username" placeholder="Enter your username" required />
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <input type="password" name="password" placeholder="Enter your Password" required />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="single-input-item">
                                                <input type="password" name="confirm_password" placeholder="Repeat your Password" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <div class="login-reg-form-meta">
                                            <div class="remember-meta">
                                                <!-- <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="subnewsletter">
                                                    <label class="custom-control-label" for="subnewsletter">Subscribe Our Newsletter</label>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="single-input-item">
                                        <button class="sqr-btn" name="btn_register">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Register Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>
    <!-- page main wrapper end -->

    <!-- footer area start -->
    <footer>

        <!-- newsletter area start -->
        <div class="newsletter-area bg-gray pt-64 pb-64 pt-sm-56 pb-sm-58">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="newsletter-inner">
                            <div class="newsletter-title">
                                <h3>newsletter signup</h3>
                            </div>
                            <div class="newsletter-box">
                                <form id="mc-form">
                                    <input type="email" id="mc-email" autocomplete="off" placeholder="Your Email address">
                                    <button class="newsletter-btn" id="mc-submit"><i class="ion-android-send"></i></button>
                                </form>
                            </div>
                        </div>
                        <!-- mailchimp-alerts Start -->
                        <div class="mailchimp-alerts">
                            <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                            <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                            <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                        </div>
                        <!-- mailchimp-alerts end -->
                    </div>
                    <div class="col-lg-6 col-md-6 ms-auto">
                        <div class="social-share-area">
                            <h3> follow us</h3>
                            <div class="social-icon">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-rss"></i></a>
                                <a href="#"><i class="fa fa-youtube"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- newsletter area end -->

        <!-- footer bottom area start -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="bdr-top pt-18 pb-18">
                    <div class="row align-items-center">
                        <div class="col-md-6 order-2 order-md-1">
                            <div class="copyright-text">
                                <p>&copy; 2021 <b>MMCSTUDIO</b> Made with <i class="fa fa-heart text-danger"></i> by <a href="#"><b>Theophilus Ajiri Menor</b></a></p>
                            </div>
                        </div>
                        <div class="col-md-6 ms-auto order-1 order-md-2">
                            <div class="footer-payment">
                                <img src="assets/img/payment.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer botton area end -->

    </footer>
    <!-- footer area end -->

    <!-- Scroll to top start -->
    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- Scroll to Top End -->



    <!--All jQuery, Third Party Plugins & Activation (main.js) Files-->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- Jquery Min Js -->
    <script src="assets/js/vendor/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap Min Js -->
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- Plugins Js-->
    <script src="assets/js/plugins.js"></script>
    <!-- Ajax Mail Js -->
    <script src="assets/js/ajax-mail.js"></script>
    <!-- Active Js -->
    <script src="assets/js/main.js"></script>
</body>

</html>