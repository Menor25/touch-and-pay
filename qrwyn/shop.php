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
    <title><?=$siteTitle;?> | Shop</title>
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

                                        <li class="active"><a href="shop">shop</a> </li>
                                        <li><a href="about">About-us</a></li>
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
        <div class="shop-main-wrapper pt-100 pb-100 pt-sm-58 pb-sm-58">
            <div class="container">
                <div class="row">
                    <!-- product view wrapper area start -->
                    <div class="col-xl-12">
                        <div class="shop-product-wrapper">
                            <!-- shop product top wrap start -->
                            <div class="shop-top-bar">
                                <div class="row">
                                    <div class="col-lg-7 col-md-6">
                                        <div class="top-bar-left">
                                            <div class="product-view-mode">
                                                <a href="#" data-target="grid"><i class="fa fa-th"></i></a>
                                                <a class="active" href="#" data-target="list"><i class="fa fa-list"></i></a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- shop product top wrap start -->

                            <!-- product view mode wrapper start -->
                            <div class="shop-product-wrap list row">
                                <?php
                                    $stmt_product = $connection->prepare('SELECT * FROM product_tbl ORDER BY RAND() LIMIT 0,10');
                                    $stmt_product->execute();
                                    $result = $stmt_product->get_result();
                            
                            
                                    while ($row = $result->fetch_assoc()) {

                                        $product_image = $row['product_image'];
                                        $product_manufacturer = $row['product_manufacturer'];
                                        $product_name = $row['product_name'];
                                        $product_price = $row['product_price'];
                                        $product_link = $row['product_link'];
                                        $product_desc = $row['product_desc'];
                                ?>
                                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                                    <!-- product grid item start -->
                                    <div class="product-item mb-20">
                                        <div class="product-thumb">
                                            <a href="product?id=<?= $row['id']; ?>" class="image-container-shop">
                                                <img src="images/<?=$product_image;?>" alt="product image">
                                            </a>

                                        </div>
                                        <div class="product-description text-center">
                                            <div class="manufacturer">
                                                <p><a href="product?id=<?= $row['id']; ?>"><?=$product_manufacturer;?></a></p>
                                            </div>
                                            <div class="product-name">
                                                <h3><a href="product?id=<?= $row['id']; ?>"><?=$product_name?></a></h3>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">$<?=$product_price;?></span>
                                                <span class="old-price"><del>$120.00</del></span>
                                            </div>
                                            <div class="product-btn">
                                                <a href="#"><i class="fa fa-shopping-bag"></i>Buy Now</a>
                                            </div>
                                            <div class="hover-box text-center">
                                                <div class="ratings">
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                    <span><i class="fa fa-star"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid item end -->
                                    <!-- product list item start -->
                                    <div class="product-list-item mb-20">
                                        <div class="product-thumb">
                                            <div class="img-container">
                                                <img src="images/<?=$product_image;?>" alt="product image">
                                            </div>
                                            
                                        </div>
                                        <div class="product-list-content">
                                            <h4><a href="product?id=<?= $row['id']; ?>"><?=$product_manufacturer;?></a></h4>
                                            <h3><a href="product?id=<?= $row['id']; ?>"><?=$product_name?></a></h3>
                                            <div class="ratings">
                                                <span class="good"><i class="fa fa-star"></i></span>
                                                <span class="good"><i class="fa fa-star"></i></span>
                                                <span class="good"><i class="fa fa-star"></i></span>
                                                <span class="good"><i class="fa fa-star"></i></span>
                                                <span><i class="fa fa-star"></i></span>
                                            </div>
                                            <div class="pricebox">
                                            <span class="regular-price">$<?=$product_price?></span>
                                                <span class="old-price"><del>$90.00</del></span>
                                            </div>
                                            <p><?=$product_desc;?></p>
                                            <div class="product-btn product-btn__color">
                                                <a href="<?=$product_link;?>"><i class="fa fa-shopping-bag"></i>Buy Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product list item end -->
                                </div>
                                <?php
                                    }
                                    $stmt_product->close();
                                ?>
                            </div>
                            <!-- product view mode wrapper start -->
                        </div>
                        <!-- start pagination area -->
                        <!-- <div class="paginatoin-area text-center mt-18">
                            <ul class="pagination-box">
                                <li><a class="Previous" href="#">Previous</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a class="Next" href="#"> Next </a></li>
                            </ul>
                        </div> -->
                        <!-- end pagination area -->
                    </div>
                </div>
            </div>
        </div>
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


    <!-- Quick view modal start -->
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="product-large-slider mb-20 slider-arrow-style slider-arrow-style__style-2">
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-details-img1.jpg" alt="" />
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-details-img2.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-details-img3.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-details-img4.jpg" alt=""/>
                                    </div>
                                    <div class="pro-large-img">
                                        <img src="assets/img/product/product-details-img4.jpg" alt=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7">
                                <div class="product-details-des pt-sm-30">
                                    <h3>Chaz Kangeroo Hoodies</h3>
                                    <div class="ratings">
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span class="good"><i class="fa fa-star"></i></span>
                                        <span><i class="fa fa-star"></i></span>
                                        <div class="pro-review">
                                            <span><a href="#">1 review(s)</a></span>
                                        </div>
                                    </div>
                                    <div class="pricebox">
                                        <span class="regular-price">$160.00</span>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.<br>
                                    Phasellus id nisi quis justo tempus mollis sed et dui. In hac habitasse platea dictumst.</p>
                                    <div class="quantity-cart-box d-flex align-items-center mb-24">
                                        <div class="product-btn product-btn__color">
                                            <a href="#"><i class="fa fa-shopping-bag"></i>Buy Now</a>
                                        </div>
                                    </div>
                                    <div class="availability mb-16">
                                        <h5>Availability:</h5>
                                        <span>in stock</span>
                                    </div>
                                    <div class="share-icon">
                                        <h5>share:</h5>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                        <a href="#"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details inner end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Quick view modal end -->


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