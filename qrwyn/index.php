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
<?php
            $stmt_slide = $connection->prepare('SELECT * FROM slide_tbl');
            $stmt_slide->execute();
            $result = $stmt_slide->get_result();
    
    
            while ($row = $result->fetch_assoc()) {
                $slide_title = $row['slide_title'];
                $slide_img = $row['slide_img'];
                $slide_desc = $row['slide_desc'];
            }
            $stmt_slide->close();
?>
            <?php
                global $connection;
                $data = array();
            
                $stmt = $connection->prepare('SELECT * FROM slide_tbl');
                $stmt->execute();
                $results1 = $stmt->get_result();
            
                // if ($result->num_rows === 0) echo "No rows found";
                while ($row = $results1->fetch_assoc()) {
                    $data[] = $row;
                }
                $stmt->close();
        
 
            ?>
<?php
            $stmt_banner = $connection->prepare('SELECT * FROM ads_banner ORDER BY RAND() LIMIT 0,1');
            $stmt_banner->execute();
            $result = $stmt_banner->get_result();
    
    
            while ($row = $result->fetch_assoc()) {
                $banner_title = $row['banner_title'];
                $button_name = $row['button_name'];
                $short_desc = $row['short_desc'];
                $banner_img = $row['banner_img'];
            }
            $stmt_banner->close();
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">

    <!-- Site title -->
    <title><?= $siteTitle; ?></title>
    <!-- Favicon -->

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
        <div class="header-main transparent-menu sticky">
            <div class="container">
                <div class="row align-items-center" style="display: flex; justify-content: space-between;">
                    <div class="col-lg-3 col-md-6 col-6">
                        <div class="logo">
                            <a href="home">
                                <img src="images\<?= $logo; ?>" alt="Brand logo" width="130">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block">
                        <div class="main-header-inner">
                            <div class="main-menu">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="active"><a href="home">Home</a> </li>
                                        <li><a href="shop">shop</a></li>
                                        <li><a href="about">About us</a></li>
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

    <!-- slider area start -->
    <div class="hero-area">       
        <div class="hero-slider-active slider-arrow-style slick-dot-style hero-dot">
            <div class="hero-single-slide hero-1 d-flex align-items-center">
                <div class="container-fluid">
                    <div class="row">
                        <div id="demo" class="carousel slide" data-ride="carousel">

                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <?php
                                    $i = 0;
                                    foreach($results1 as $slide)
                                    {
                                        $actives = "";
                                        if($i == 0)
                                        {
                                            $actives = "active";
                                        }
                                    
                                ?>
                            <li data-target="#demo" data-slide-to="<?=$i;?>" class="<?=$actives;?>"></li>
                                <?php $i++; } ?>
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <?php
                                    $i = 0;
                                    foreach($results1 as $slide)
                                    {
                                        $actives = "";
                                        if($i == 0)
                                        {
                                            $actives = "active";
                                        }
                                   
                                ?>
                                <div class="carousel-item <?=$actives;?>">
                                    <img src="images\<?=$slide['slide_img']?>" width="100%" height="100%" alt="Product Slide">
                                    <div class="info">
                                    <div class="slider-content">
                                        <h1><?=$slide['slide_title'];?></h1>
                                        <h3><?=$slide['slide_title'];?></h3>
                                        <a href="shop" class="slider-btn">view product</a>
                                    </div>
                        </div>
                                </div>
                                <?php $i++;  }?>
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            </a>

                        </div>
                    </div>

                </div>
            </div>
            
        </div>
        
    </div>
    <!-- slider area end -->

    <!-- featured product area start -->
    <div class="page-section pt-100 pb-14 pt-sm-60 pb-sm-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center pb-44">
                        <h2>Featured products</h2>
                    </div>
                </div>
            </div>
            <div class="product-carousel-one spt slick-arrow-style slick-padding" data-row="2">
                    <?php
                            $stmt_product = $connection->prepare('SELECT * FROM product_tbl ORDER BY RAND() LIMIT 0,8');
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
                <div class="col">
                    <div class="product-item mb-20 product-style">
                        <input type="hidden" name="id" id="productId" value="<?= $row['id']; ?>">
                        <div class="product-thumb product-thumb-style">
                            <div class="image-container">
                                <img src="images\<?= $product_image;?>" alt="product image" style="width: 100%; height: 100%;">
                            </div>
                            <div class="box-label">
                                <div class="product-label new">
                                    <span>new</span>
                                </div>
                                <div class="product-label discount">
                                    <span>-5%</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-description text-center">
                            <div class="manufacturer">
                                <p><a href="product?id=<?= $row['id']; ?>"><?= $product_manufacturer;?></a></p>
                            </div>
                            <div class="product-name">
                                <h3><a href="product?id=<?= $row['id']; ?>"><?= $product_name;?></a></h3>
                            </div>
                            <div class="price-box">
                                <span class="regular-price">$100.00</span>
                                <span class="old-price"><del>$120.00</del></span>
                            </div>
                            <div class="product-btn">
                                <a href="<?= $product_link;?>"><i class="fa fa-shopping-bag"></i>Buy Now</a>
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
                </div>
                <?php
                            }
                            $stmt_product->close();
                ?>
            </div>
        </div>
    </div>
    <!-- featured product area end -->

    <!-- block container start -->
    <div class="page-section bg-gray-light">
        <div class="container-fluid p-0">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="block-container-banner img-full fix">
                        <a href="#">
                            <img src="images\<?= $banner_img;?>" alt="Banner_Image">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="bloc-container-inner text-center pt-sm-54 pb-sm-60">
                        <h2><?= $banner_title;?></h2>
                        <p><?= $short_desc; ?></p>
                        <a href="shop"><?= $button_name; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- block container end -->

    <!-- feature category area start -->
    <div class="feature-category-area pt-96 pb-14 pt-md-114 pt-sm-54 pb-sm-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tab-menu-one mb-58">
                        <ul class="nav justify-content-center">
                            <li>
                                <a class="active" data-bs-toggle="tab" href="#tab_one">soap</a>
                            </li>
                            <li>
                                <a data-bs-toggle="tab" href="#tab_two">bestseller</a>
                            </li>
                            <li>
                                <a data-bs-toggle="tab" href="#tab_three">cream</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content text-center">
                        <div class="tab-pane fade show active" id="tab_one">
                            <div class="feature-category-carousel slick-arrow-style spt slick-padding">
                                <?php
                                        $soap ="Soap";
                                        $stmt_product_soap = $connection->prepare('SELECT * FROM product_tbl WHERE category_id=? ORDER BY RAND() LIMIT 0,4');
                                        $stmt_product_soap->bind_param('s', $soap);
                                        $stmt_product_soap->execute();
                                        $result = $stmt_product_soap->get_result();

                                        while ($row = $result->fetch_assoc()) {

                                            $product_image = $row['product_image'];
                                            $product_manufacturer = $row['product_manufacturer'];
                                            $product_name = $row['product_name'];
                                            $product_price = $row['product_price'];
                                            $product_link = $row['product_link'];
                                            $product_desc = $row['product_desc'];        
                                ?>
                                <div class="col">
                                    <div class="product-item mb-20 product-style">
                                        <div class="product-thumb product-thumb-style">
                                            <div class="image-container">
                                                   <img src="images/<?= $product_image; ?>" alt="product image">
                                            </div>
                                            <div class="box-label">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-label discount">
                                                    <span>-5%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-description text-center">
                                            <div class="manufacturer">
                                                <p><a href="product?id=<?= $row['id']; ?>"><?=$product_manufacturer;?></a></p>
                                            </div>
                                            <div class="product-name">
                                                <h3><a href="product?id=<?= $row['id']; ?>"><?=$product_name;?></a></h3>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">$<?=$product_price;?>0</span>
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
                                </div>
                                <?php
                                    }
                                    $stmt_product_soap->close();
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_two">
                        <div class="feature-category-carousel slick-arrow-style spt slick-padding">
                          <?php
  
                           $stmt_product_soap = $connection->prepare('SELECT * FROM product_tbl ORDER BY RAND() LIMIT 0,4');
                           $stmt_product_soap->execute();
                           $result = $stmt_product_soap->get_result();

                           while ($row = $result->fetch_assoc()) {

                              $product_image = $row['product_image'];
                              $product_manufacturer = $row['product_manufacturer'];
                              $product_name = $row['product_name'];
                              $product_price = $row['product_price'];
                              $product_link = $row['product_link'];
                              $product_desc = $row['product_desc'];        
                          ?>
                                <div class="col">
                                    <div class="product-item mb-20 product-style">
                                        <div class="product-thumb product-thumb-style">
                                            <div class="image-container">
                                                   <img src="images/<?= $product_image; ?>" alt="product image">
                                            </div>
                                            <div class="box-label">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-label discount">
                                                    <span>-5%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-description text-center">
                                            <div class="manufacturer">
                                                <p><a href="product?id=<?= $row['id']; ?>"><?=$product_manufacturer;?></a></p>
                                            </div>
                                            <div class="product-name">
                                                <h3><a href="product?id=<?= $row['id']; ?>"><?=$product_name;?></a></h3>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">$<?=$product_price;?>0</span>
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
                                </div>
                                <?php
                                    }
                                    $stmt_product_soap->close();
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab_three">
                        <div class="feature-category-carousel slick-arrow-style spt slick-padding">
                              <?php
                                        $cream ="Cream";
                                        $stmt_product_soap = $connection->prepare('SELECT * FROM product_tbl WHERE category_id=? ORDER BY RAND() LIMIT 0,4');
                                        $stmt_product_soap->bind_param('s', $cream);
                                        $stmt_product_soap->execute();
                                        $result = $stmt_product_soap->get_result();

                                        while ($row = $result->fetch_assoc()) {

                                            $product_image = $row['product_image'];
                                            $product_manufacturer = $row['product_manufacturer'];
                                            $product_name = $row['product_name'];
                                            $product_price = $row['product_price'];
                                            $product_link = $row['product_link'];
                                            $product_desc = $row['product_desc'];        
                                ?>
                                <div class="col">
                                    <div class="product-item mb-20 product-style">
                                        <div class="product-thumb product-thumb-style">
                                            <div class="image-container">
                                                   <img src="images/<?= $product_image; ?>" alt="product image">
                                            </div>
                                            <div class="box-label">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                                <div class="product-label discount">
                                                    <span>-5%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-description text-center">
                                            <div class="manufacturer">
                                                <p><a href="product?id=<?= $row['id']; ?>"><?=$product_manufacturer;?></a></p>
                                            </div>
                                            <div class="product-name">
                                                <h3><a href="product?id=<?= $row['id']; ?>"><?=$product_name;?></a></h3>
                                            </div>
                                            <div class="price-box">
                                                <span class="regular-price">$<?=$product_price;?>0</span>
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
                                </div>
                                <?php
                                    }
                                    $stmt_product_soap->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature category area end -->

    <!-- banner statistics 02 start -->
    <!-- <div class="banner-statistic-two pt-100 pt-sm-60">
        <div class="container">
            <div class="row">
                    <?php
                            $sql_featured_banner = "SELECT * FROM featured_banner ORDER BY RAND() LIMIT 0,1";
                            $result2 = $connection->query($sql_featured_banner);

                            if($result2->num_rows > 0)
                            {
                                while($rows = $result2->fetch_assoc())
                                    {
                                        $banner_title = $rows['banner_title'];
                                        $button_name = $rows['button_name'];
                                        $short_desc = $rows['short_desc'];
                                        $banner_img = $rows['banner_img'];        
                        ?>
                <div class="col-12">
                    <div class="banner-content-inner overlay text-center banner-1">
                        <div class="banner-content">
                            <h2><?= $banner_title;?></h2>
                            <p><?= $short_desc;?></p>
                            <a href="shop" class="sqr-btn"><?= $button_name;?></a>
                        </div>
                    </div>
                </div>
                <?php
                                }
                            }
                ?>
            </div>
        </div>
    </div> -->
    <!-- banner statistics 02 end -->

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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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