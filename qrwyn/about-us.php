<?php
        include('Contentcontrol/private/database.php');

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
    <title><?= $siteTitle; ?> | About Us</title>
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" /> -->
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font-Awesome CSS -->
    <link href="assets/css/font-awesome.css" rel="stylesheet">
    <!-- IonIcon CSS -->
    <link href="assets/css/ionicons.min.css" rel="stylesheet">
    <!-- helper class css -->
    <link href="assets/css/helper.min.css" rel="stylesheet">
    <!-- Plugins CSS -->
    <link href="assets/css/plugins.css" rel="stylesheet">
    <!-- Main Style CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
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
                                <img src="images/<?=$logo;?>" alt="Brand logo" width="130">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="main-header-inner">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li><a href="home">Home</a></li>

                                        <li><a href="shop">shop</a> </li>
                                        <li class="active"><a href="about">About-us</a></li>
                                        <li><a href="contact">Contact us</a></li>
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
                                <li class="breadcrumb-item"><a href="home">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">about us</li>
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
        <!-- about wrapper start -->
        <div class="about-us-wrapper pt-98 pb-100 pt-sm-58 pb-sm-58">

            <?php

            $stmt_about = $connection->prepare('SELECT * FROM about_us_tbl');
            $stmt_about->execute();
            $result1 = $stmt_about->get_result();


            while ($row = $result1->fetch_assoc()) {
                $title = $row['title'];
                $description = $row['description'];
                $image = $row['image'];
            }
            $stmt_about->close();
            // echo $logo;

            ?>
            <div class="container">
                <div class="row">
                    <!-- About Text Start -->
                    <div class="col-xl-6 col-lg-6">
                        <div class="about-text-wrap" style="width: 100%;">
                            <h2><?=$title;?></h2>
                           <p style="width: 100%;"><?=$description;?></p>
                        </div>
                    </div>
                    <!-- About Text End -->
                    <!-- About Image Start -->
                    <div class="col-xl-5 col-lg-6 ms-auto">
                        <div class="about-image-wrap">
                            <img src="images/<?=$image;?>" alt="About" />
                        </div>
                    </div>
                    <!-- About Image End -->
                </div>
            </div>
        </div>
        <!-- about wrapper end -->

        <!-- team area start -->
        <div class="team-area bg-gray pt-100 pb-58 pt-sm-56 pb-sm-16">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center pb-44">
                            <p>our creative team member</p>
                            <h2>our creative team</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                            $stmt_team = $connection->prepare('SELECT * FROM team_tbl LIMIT 0,4');
                            $stmt_team->execute();
                            $result2 = $stmt_team->get_result();
                    
                    
                            while ($row = $result2->fetch_assoc()) {

                                $full_name = $row['full_name'];
                                $position = $row['position'];
                                $description = $row['description'];
                                $image = $row['image'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="team-member mb-30">
                            <div class="team-thumb img-full" style="height: 300px">
                                <img src="images/<?=$image;?>" alt="team-image" style="width: 100%; height: 100;">
                                <!-- <div class="team-social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </div> -->
                            </div>
                            <div class="team-content text-center">
                                <h3><?=$full_name;?></h3>
                                <h6><?=$position;?></h6>
                                <p><?=$description;?></p>
                            </div>
                        </div>
                    </div> <!-- end single team member -->
                    <?php
                            }
                            $stmt_team->close();
                    ?>
                </div>
            </div>
        </div>
        <!-- team area end -->

        <!-- testimonial area start -->
        <div class="testimonial-area pt-98 pb-132 pt-sm-58 pb-sm-92">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center pb-44">
                            <p class="text-white">our client say</p>
                            <h2 class="text-white">testimonial</h2>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="testimonial-carousel-active slick-dot-style">
                            <?php
                                $stmt_testimonial = $connection->prepare('SELECT * FROM testimonial LIMIT 0,3');
                                $stmt_testimonial->execute();
                                $result3 = $stmt_testimonial->get_result();
                        
                        
                                while ($row = $result3->fetch_assoc()) {

                                    $full_name = $row['full_name'];
                                    $description = $row['description'];
                                    $image = $row['image'];

                            ?>
                            <div class="testimonial-item text-center">
                                <div class="testimonial-thumb">
                                    <img src="images/<?=$image;?>" alt="" style="height: 100%; width: 100%; border-radius: 50%;">
                                </div>
                                <div class="testimonial-content">
                                    <p><?=$description;?></p>
                                    <h3><a href="#"><?=$full_name;?></a></h3>
                                </div>
                            </div> <!-- end single testimonial item -->
                            <?php
                            }
                            $stmt_testimonial->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- testimonial area end -->

    </main>
    <!-- page main wrapper end -->

    <!-- footer area start -->
    <footer>

        <!-- newsletter area start -->
        <div class="newsletter-area bg-gray pt-64 pb-64 pt-sm-56 pb-sm-58">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 ms-auto">
                        <div class="social-share-area">
                            <h3> follow us</h3>
                            <div class="social-icon">
                                <a href="<?=$fb_link;?>"><i class="fa fa-facebook"></i></a>
                                <a href="<?=$twitter_link;?>"><i class="fa fa-twitter"></i></a>
                                <a href="<?=$youtube_link;?>"><i class="fa fa-youtube"></i></a>
                                <a href="<?=$instagram_link;?>"><i class="fa fa-instagram"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- newsletter area end -->

        <!-- footer widget area start -->
        <!-- <div class="footer-widget-area pt-62 pb-56 pb-md-26 pt-sm-56 pb-sm-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <div class="footer-widget-title">
                                <h3>shipping and delivery</h3>
                            </div>
                            <div class="footer-widget-body">
                                <p>Here you can read some details about a nifty little lifecycle of your order's journey from the time you place your order to your new treasures arriving at your doorstep.</p>
                            </div>
                            <div class="footer-widget-title mt-20">
                                <h3>payment method</h3>
                            </div>
                            <div class="footer-widget-body">
                                <p>It is equally important to choose the solution which offers a specific selection of credit cards. We take Visa & MasterCard as they are widely used by cyber customers.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <div class="footer-widget-title">
                                <h3>useful link</h3>
                            </div>
                            <div class="footer-widget-body">
                                <ul class="useful-link">
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Legal Notice</a></li>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">New products</a></li>
                                    <li><a href="#">best sales</a></li>
                                    <li><a href="#">wishlist</a></li>
                                    <li><a href="#">my account</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <div class="footer-widget-title">
                                <h3>our company</h3>
                            </div>
                            <div class="footer-widget-body">
                                <ul class="useful-link">
                                    <li><a href="#">Delivery</a></li>
                                    <li><a href="#">Legal Notice</a></li>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">secure payment</a></li>
                                    <li><a href="#">contact us</a></li>
                                    <li><a href="#">site map</a></li>
                                    <li><a href="#">login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="footer-widget">
                            <div class="footer-widget-title">
                                <div class="footer-logo">
                                    <a href="index.html">
                                        <img src="assets/img/logo/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="footer-widget-body">
                                <ul class="address-box">
                                    <li>
                                        <span>ADDRESS:</span>
                                        <p>Melani - Responsive Prestashop Theme<br>
                                        169-C, Technohub, Dubai Silicon</p>
                                    </li>
                                    <li>
                                        <span>call us now:</span>
                                        <p>+880123456789</p>
                                    </li>
                                    <li>
                                        <span>email:</span>
                                        <p>demo@yourdomain.com</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- footer widget area end -->

        <!-- footer bottom area start -->
        <div class="footer-bottom-area">
            <div class="container">
                <div class="bdr-top pt-18 pb-18">
                    <div class="row align-items-center">
                        <div class="col-md-6 order-2 order-md-1">
                            <div class="copyright-text">
                                <p>&copy; <?=date('Y');?><b> Qrwyn</b></p>
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