<?php
    
    include('private/autoloads.php');
    if(!isset($_SESSION['user']['id'])){
        header('Location: login-register.php');
        exit();
    }

?>
<?php


    $id = "";
    $allProduct = selectProduct(); $allSlide = selectSlide(); $allCategory = selectCategory();
    $allBanner = selectBanner(); $allFeaturedBanner = selectFeaturedBanner(); $settings = selectSetting();
    $allAbout = selectAbout(); $allTeam = selectTeam(); $allTestimonial = selectTestimonial();
    deleteProduct($id); deleteSlide($id); deleteCategory($id); deleteBanner($id); deleteFeaturedBanner($id);
    deleteTeam($id); deleteTestimonial($id);
    $sn = 1; $sn1 = 1; $sn2 = 1; $sn3 = 1; $sn4 = 1; $sn5 = 1; $sn6 = 1; $sn7 = 1;
?>

<?php

    $user_id = $_SESSION['user']['id'];
    $Error = "";

    //Product insert function call
    if(isset($_POST['product_btn']))
    {
        insertProduct(
            $product_name = htmlspecialchars(trim($_POST['product_name'])),
            $product_price = htmlspecialchars(trim($_POST['product_price'])),
            $category_id = htmlspecialchars(trim($_POST['category_id'])),
            $product_image = $_FILES['product_image'],
            $product_manufacturer = htmlspecialchars(trim($_POST['product_manufacturer'])),
            $product_link = htmlspecialchars(trim($_POST['product_link'])),
            $product_desc = htmlspecialchars(trim($_POST['product_desc'])),
        );
    }



    if(isset($_POST['btn_logout']))
    {
        adminLogout();
    }

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

<?php

        $stmt_about_update = $connection->prepare('SELECT * FROM about_us_tbl');
        $stmt_about_update->execute();
        $result = $stmt_about_update->get_result();


        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $description = $row['description'];
            $image = $row['image'];
        }
        $stmt_about_update->close();
        // echo $logo;

?>

<?php

        $stmt_banner_update = $connection->prepare('SELECT * FROM ads_banner');
        $stmt_banner_update->execute();
        $result = $stmt_banner_update->get_result();


        while ($row = $result->fetch_assoc()) {
            $banner_title = $row['banner_title'];
            $button_name = $row['button_name'];
            $short_desc = $row['short_desc'];
            $banner_img = $row['banner_img'];
        }
        $stmt_banner_update->close();
        // echo $logo;

?>

<?php

$stmt_featured_banner_update = $connection->prepare('SELECT * FROM featured_banner');
$stmt_featured_banner_update->execute();
$result = $stmt_featured_banner_update->get_result();


while ($row = $result->fetch_assoc()) {
    $banner_title = $row['banner_title'];
    $button_name = $row['button_name'];
    $short_desc = $row['short_desc'];
    $banner_img = $row['banner_img'];
}
$stmt_featured_banner_update->close();
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
    <title><?= $siteTitle; ?> | Admin Dashboard</title>
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
                            <a href="index.php">
                                <img src="../images/<?=$logo;?>" alt="Brand logo" width="130">
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
                                <li class="breadcrumb-item active" aria-current="page">my dashboard</li>
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
        <!-- my account wrapper start -->
        <div class="my-account-wrapper pt-100 pb-100 pt-sm-58 pb-sm-58">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
                        <?php
                            if(isset($_POST['product_btn']) || isset($_POST['category_btn']) || isset($_POST['slide_btn']) 
                                || isset($_POST['banner_btn']) || isset($_POST['featured_banner_btn']) || isset($_POST['about_btn']) 
                                || isset($_POST['team_btn']) || isset($_POST['testimonial_btn']) || isset($_POST['setting_btn'])){

                            if(isset($_SESSION[$Error])): ?>
                            <div class="alert alert-<?= $_SESSION['msg_type']; ?>">
                                <?php
                                    echo $_SESSION[$Error];
                                    unset($_SESSION[$Error]);

                                ?>
                            </div>
                            <?php endif; } 
                        ?>


                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboard" class="active" data-bs-toggle="tab"><i class="fa fa-dashboard"></i>
                                            Dashboard</a>
                                        <a href="#product" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Product</a>
                                        <a href="#slide" data-bs-toggle="tab"><i class="fa fa-image"></i> Slide</a>
                                        <a href="#category" data-bs-toggle="tab"><i class="fa fa-credit-card"></i> Category</a>
                                        <a href="#p_banner" data-bs-toggle="tab"><i class="fa fa-image"></i> Product Banner</a>
                                        <a href="#f_banner" data-bs-toggle="tab"><i class="fa fa-image"></i> Featured Banner</a>
                                        <a href="#about" data-bs-toggle="tab"><i class="fa fa-image"></i> About</a>
                                        <a href="#team" data-bs-toggle="tab"><i class="fa fa-image"></i> Team</a>
                                        <a href="#testimonial" data-bs-toggle="tab"><i class="fa fa-image"></i> Testimonial</a>
                                        <a href="#contact" data-bs-toggle="tab"><i class="fa fa-cog"></i> Website Setting</a>
                                        <!-- <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account Details</a> -->
                                        <a href="login-register.php" name="btn_logout"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->
        
                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Dashboard</h3>
                                                <div class="welcome">
                                                    <p>Hello, <strong><?php echo $_SESSION['full_name']['id']; ?></strong></p>
                                                </div>
                                                <p class="mb-0">From your account dashboard. you can easily manage & your recent product, and entire web app details.</p>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
        
                                        <!-- Tab For Product Content Start -->
                                        <div class="tab-pane fade" id="product" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Upload New Product</h3>
                                                <?php
                                                    if(isset($_POST['product_btn'])){
                                                        if(isset($_SESSION[$Error])): ?>
                                                            <div class="alert alert-<?= $_SESSION['msg_type']; ?>">
                                                                <?php
                                                                    echo $_SESSION[$Error];
                                                                    unset($_SESSION[$Error]);
                                
                                                                ?>
                                                            </div>
                                                        <?php endif;} ?>
                                                    

                                                

                                                    <!-- Product form Begin-->
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label for="Product-name" class="required">Product Name</label>
                                                                    <input type="text" id="product_name" name="product_name" placeholder="Product Name" />
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="Product-price" class="required">Product Price</label>
                                                                    <input type="text" id="product-price" name="product_price" placeholder="Product Price" />
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="Product-category" class="required">Product Category</label>
                                                                    <select name="category_id" id="category_id" class="form-control">
                                                                        <option value="" disabled selected>Select Category</option>
                                                                        <?php
                                                                            $stmt1 = $connection->prepare('SELECT * FROM category_tbl');
                                                                            $stmt1->execute();
                                                                            $result = $stmt1->get_result();
                                                                    
                                                                            while($row = $result->fetch_assoc()){
                                                                                $category_name = $row['category_name'];

                                                                        ?>
                                                                                <option value="<?= $category_name ?>"><?= $category_name ?></option>
                                                                        <?php


                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="Product-image" class="required">Product Image</label>
                                                                    <input type="file" id="product-image" name="product_image" placeholder="Product Image" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="Product-manufacturer" class="required">Product Manufacturer</label>
                                                                    <input type="text" id="product_manufacturer" name="product_manufacturer" placeholder="Product Manufacturer" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="Product-link" class="required">Product Link</label>
                                                                    <input type="text" id="product-link" name="product_link" placeholder="Product Link" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="product_description-name" class="required">Product Description</label>
                                                            <textarea class="textarea form-control tinymce" name="product_desc" id="form-message" cols="20"
                                                            rows="5"></textarea>
                                                        </div>

                                                        <div class="single-input-item mb-20">
                                                            <button class="check-btn sqr-btn" name="product_btn">Upload Product</button>
                                                        </div>
                                                    </form>
                                                    <!-- Product form end -->
                                                    <div></div>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Product Name</th>
                                                                <th>Product Category</th>
                                                                <th>Product Price</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                foreach($allProduct as $product):
                                                                               
                                                            ?>
                                                            <tr>
                                                                <td><?= $sn; ?></td>
                                                                <td><?= $product["product_name"]; ?></td>
                                                                <td><?= $product["category_id"]; ?></td>
                                                                <td><?= $product["product_price"]; ?></td>
                                                                <td>
                                                                    <!-- <a href="edit-class.php?edit=<?= $product['id']; ?>" class="btn btn-info">Edit</a> |  -->
                                                                    <a href="index.php?delete=<?= $product['id']; ?>" 
                                                                    onclick="return confirm('Are you sure, You want to delete this record?')" class="btn btn-danger">Delete</a>
                                                                </td>
                                                            </tr>
                                                            <?php

                                                                $sn++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tab For Product Content End -->
        
                                        <!-- Tab Content for Slide Start -->
                                        <div class="tab-pane fade" id="slide" role="tabpanel">
                                            <?php
                                                if(isset($_POST['slide_btn']))
                                                {
                                                    insertSlide(

                                                        $slide_title            = htmlspecialchars(trim($_POST['slide_title'])),
                                                        $slide_img              = $_FILES['slide_img'],
                                                        $slide_desc             = htmlspecialchars(trim($_POST['slide_desc'])),
                                                
                                                    );

                                                }
                                            ?>
                                            <div class="myaccount-content">
                                                <h3>Add New Slide</h3>
                                                    <!-- Slide form Begin-->
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="slide_title" class="required">Title</label>
                                                                    <input type="text" id="slide_title" name="slide_title" placeholder="Slide Title" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="slide_image" class="required">Slide Image</label>
                                                                    <input type="file" id="slide_image" name="slide_img" placeholder="Slide Image" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="product_description-name" class="required">Product Description</label>
                                                            <textarea class="textarea form-control tinymce" name="message" id="form-message" cols="20"
                                                            rows="5"></textarea>
                                                        </div>

                                                        <div class="single-input-item mb-20">
                                                            <button class="check-btn sqr-btn" name="slide_btn">Upload Slide</button>
                                                        </div>
                                                    </form>
                                                    <!-- Slide form end -->
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Slide Title</th>
                                                            <th>Slide Image</th>
                                                            <th>Slide Description</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                foreach($allSlide as $slide):
                                                                               
                                                            ?>
                                                            <tr>
                                                                <td><?= $sn1; ?></td>
                                                                <td><?= $slide['slide_title'];?></td>
                                                                <td><img src="<?= $slide['slide_img'];?>" alt="Slide_image" width="100"></td>
                                                                <td><?= htmlspecialchars_decode(stripcslashes($slide['slide_desc']));?></td>
                                                                <td>
                                                                    <a href="index.php?delete=<?= $slide['id']; ?>" 
                                                                    onclick="return confirm('Are you sure, You want to delete this record?')" class="btn btn-danger">Delete</a>
                                                                </td>
                                                            </tr>
                                                            <?php

                                                                $sn1++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Tab Content for Slide End -->
        
                                        <!-- Tab Content for category Start -->
                                        <div class="tab-pane fade" id="category" role="tabpanel">
                                            <?php
                                                if(isset($_POST['category_btn']))
                                                {
                                                    insertCategory(

                                                        $category_name           = htmlspecialchars(trim($_POST['category_name'])),
                                                
                                                    );
                                                }
                                            ?>
                                            <div class="myaccount-content">
                                                <h3>Add Category</h3>
                                                    <!-- Category form Begin-->
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="category_title" class="required">Category Name</label>
                                                                    <input type="text" id="category_name" name="category_name" placeholder="Category Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item mt-50">
                                                                    <button class="check-btn sqr-btn" name="category_btn">Upload Category</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <!-- Slide form end -->

                                                    <div class="myaccount-table table-responsive text-center mt-40">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Category Name</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                foreach($allCategory as $category):
                                                                               
                                                            ?>
                                                                <tr>
                                                                    <td><?= $sn2; ?></td>
                                                                    <td><?= $category['category_name']; ?></td>
                                                                    <td>
                                                                        <a href="index.php?delete=<?= $category['id']; ?>" 
                                                                        onclick="return confirm('Are you sure, You want to delete this record?')" class="btn btn-danger">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            <?php

                                                                $sn2++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                        </div>
                                        <!-- Tab Content for category End -->
        
                                        <!-- Tab Content Product ads Start -->
                                        <div class="tab-pane fade" id="p_banner" role="tabpanel">
                                            <?php
                                                if(isset($_POST['banner_btn']))
                                                {
                                                    updateBanner(

                                                        $banner_title           = htmlspecialchars(trim($_POST['banner_title'])),
                                                        $button_name            = htmlspecialchars(trim($_POST['button_name'])),
                                                        $short_desc             = htmlspecialchars(trim($_POST['short_desc'])),
                                                        $banner_img              = $_FILES['banner_img'],
                                                
                                                    );

                                                }
                                            ?>
                                            <div class="myaccount-content">
                                                <h3>Product Banner Ads</h3>
                                                    <!-- Product ads form Begin-->
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="banner-title" class="required">Tile</label>
                                                                    <input type="text" id="banner-title" value="<?=$banner_title;?>" name="banner_title" placeholder="Title" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="banner_img" class="required">Product Image</label>
                                                                    <input type="file" id="banner_img" name="banner_img" placeholder="Image" />
                                                                    <img src="<?=$banner_img;?>" alt="Banner_image" width="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="banner_description" class="required">Short Description</label>
                                                                    <input type="text" id="short_desc" value="<?=$short_desc;?>" name="short_desc" placeholder="Short Description" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="Button_name" class="required">Button Name</label>
                                                                    <input type="text" id="button-name" value="<?=$button_name;?>" name="button_name" placeholder="Button Name" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item mb-20">
                                                            <button class="check-btn sqr-btn" name="banner_btn">Update Banner</button>
                                                        </div>
                                                    </form>
                                                    <!-- Product form end -->

                                                    <div class="myaccount-table table-responsive text-center mt-40">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Banner Title</th>
                                                                    <th>Button Name</th>
                                                                    <th>Banner Description</th>
                                                                    <th>Banner Image</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                foreach($allBanner as $banner):
                                                                               
                                                            ?>
                                                                <tr>
                                                                    <td><?= $sn3; ?></td>
                                                                    <td><?= $banner['banner_title']; ?></td>
                                                                    <td><?= $banner['button_name']; ?></td>
                                                                    <td><?= $banner['short_desc']; ?></td>
                                                                    <td><img src="<?= $banner['banner_img']; ?>" alt="Banner Image" width="100"></td>
                                                                </tr>
                                                            <?php

                                                                $sn3++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div></div>
                                            </div>
                                        </div>
                                        <!-- Tab Content Product ads End -->

                                        <!-- Tab Content for featured banner Start -->
                                        <div class="tab-pane fade" id="f_banner" role="tabpanel">
                                            <?php
                                                if(isset($_POST['featured_banner_btn']))
                                                {
                                                    updateFeaturedBanner(

                                                        $banner_title           = htmlspecialchars(trim($_POST['banner_title'])),
                                                        $button_name            = htmlspecialchars(trim($_POST['button_name'])),
                                                        $short_desc             = htmlspecialchars(trim($_POST['short_desc'])),
                                                        $banner_img              = $_FILES['banner_img'],
                                                
                                                    );

                                                }
                                            ?>
                                            <div class="myaccount-content">
                                                <h3>Featured Product Banner Ads</h3>
                                                    <!-- Product ads form Begin-->
                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="banner-title" class="required">Tile</label>
                                                                    <input type="text" id="banner-title" value="<?=$banner_title;?>" name="banner_title" placeholder="Title" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="banner_img" class="required">Product Image</label>
                                                                    <input type="file" id="banner_img" value="<?=$banner_img;?>" name="banner_img" placeholder="Image" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="banner_description" class="required">Short Description</label>
                                                                    <input type="text" id="short_desc" value="<?=$short_desc;?>" name="short_desc" placeholder="Short Description" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="Button_name" class="required">Button Name</label>
                                                                    <input type="text" id="button-name" value="<?=$button_name;?>" name="button_name" placeholder="Button Name" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item mb-20">
                                                            <button class="check-btn sqr-btn" name="featured_banner_btn">Update Banner</button>
                                                        </div>
                                                    </form>
                                                    <!-- Product form end -->
                                                    <div class="myaccount-table table-responsive text-center mt-40">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Banner Title</th>
                                                                    <th>Button Name</th>
                                                                    <th>Banner Description</th>
                                                                    <th>Banner Image</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                foreach($allFeaturedBanner as $featured_banner):
                                                                               
                                                            ?>
                                                                <tr>
                                                                    <td><?= $sn4; ?></td>
                                                                    <td><?= $featured_banner['banner_title']; ?></td>
                                                                    <td><?= $featured_banner['button_name']; ?></td>
                                                                    <td><?= $featured_banner['short_desc']; ?></td>
                                                                    <td><img src="<?= $featured_banner['banner_img']; ?>" alt="Banner Image" width="100"></td>
                                                                </tr>
                                                            <?php

                                                                $sn4++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div></div>
                                            </div>
                                        </div>
                                        <!-- Tab Content for featured banner End -->

                                        <!-- Tab Content for about Start -->
                                        <div class="tab-pane fade" id="about" role="tabpanel">
                                            <?php
                                                if(isset($_POST['about_btn']))
                                                {
                                                    updateAbout(

                                                        $title                  = trim($_POST['title']),
                                                        $description             = trim($_POST['description']),
                                                        $image                  = $_FILES['image'],
                                                
                                                    );

                                                }
                                            ?>
                                            <div class="myaccount-content">
                                                <h3>About Page</h3>
                                                    <!-- Product ads form Begin-->
                                                    <form action="#" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="title" class="required">Title</label>
                                                                    <input type="text" id="title" name="title" value="<?=$title;?>" placeholder="Title" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="image" class="required">Image</label>
                                                                    <input type="file" id="image" name="image" placeholder="Image" />
                                                                    <img src="<?=$image;?>" alt="about_image" width="100">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="single-input-item">
                                                                <label for="product_description-name" class="required">Description</label>
                                                                <textarea name="description" class="form-control" id="product_description" cols="20" rows="5"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item mb-20">
                                                            <button class="check-btn sqr-btn" name="about_btn">Update</button>
                                                        </div>
                                                    </form>
                                                    <!-- Product form end -->
                                                    <div class="myaccount-table table-responsive text-center mt-40">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Title</th>
                                                                    <th>Description</th>
                                                                    <th>Image</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                foreach($allAbout as $about):
                                                                               
                                                            ?>
                                                                <tr>
                                                                    <td><?= $sn5; ?></td>
                                                                    <td><?= $about['title']; ?></td>
                                                                    <td><?= $about['description']; ?></td>
                                                                    <td><img src="<?= $about['image']; ?>" alt="Banner Image" width="100"></td>
                                                                </tr>
                                                            <?php

                                                                $sn5++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div></div>
                                            </div>
                                        </div>
                                        <!-- Tab Content for about End -->

                                        <!-- Tab Content team Start -->
                                        <div class="tab-pane fade" id="team" role="tabpanel">
                                            <?php
                                                if(isset($_POST['team_btn']))
                                                {
                                                    insertTeam(

                                                        $full_name                  = htmlspecialchars(trim($_POST['full_name'])),
                                                        $position                  = htmlspecialchars(trim($_POST['position'])),
                                                        $description             = htmlspecialchars(trim($_POST['description'])),
                                                        $image                  = $_FILES['image'],
                                                
                                                    );

                                                }
                                            ?>
                                            <div class="myaccount-content">
                                                <h3>Add Team</h3>
                                                     <!-- Product ads form Begin-->
                                                    <form action="#" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="full_name" class="required">Full Name</label>
                                                                    <input type="text" id="full_name" name="full_name" placeholder="Full Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="image" class="required">Image</label>
                                                                    <input type="file" id="image" name="image" placeholder="Image" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label for="position" class="required">Position (Role)</label>
                                                                    <input type="text" id="position" name="position" placeholder="Position" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="single-input-item">
                                                                <label for="product_description-name" class="required">Bio</label>
                                                                <textarea name="description" class="form-control" id="product_description" cols="20" rows="5"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item mb-20">
                                                            <button class="check-btn sqr-btn" name="team_btn">Add Team</button>
                                                        </div>
                                                    </form>
                                                    <!-- Product form end -->
                                                    <div class="myaccount-table table-responsive text-center mt-40">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Full Name</th>
                                                                    <th>Position (Role)</th>
                                                                    <th>Description</th>
                                                                    <th>Image</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                foreach($allTeam as $team):
                                                                               
                                                            ?>
                                                                <tr>
                                                                    <td><?= $sn6; ?></td>
                                                                    <td><?= $team['full_name']; ?></td>
                                                                    <td><?= $team['position']; ?></td>
                                                                    <td><?= $team['description']; ?></td>
                                                                    <td><img src="<?= $team['image']; ?>" alt="Banner Image" width="100"></td>
                                                                    <td>
                                                                        <a href="index.php?delete=<?= $team['id']; ?>" 
                                                                        onclick="return confirm('Are you sure, You want to delete this record?')" class="btn btn-danger">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            <?php

                                                                $sn6++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div></div>
                                            </div>
                                        </div>
                                        <!-- Tab Content team End -->

                                        <!-- Tab Content for Testimonial Start -->
                                        <div class="tab-pane fade" id="testimonial" role="tabpanel">
                                        <?php
                                                if(isset($_POST['testimonial_btn']))
                                                {
                                                    insertTestimonial(

                                                        $full_name                  = htmlspecialchars(trim($_POST['full_name'])),
                                                        $description             = htmlspecialchars(trim($_POST['description'])),
                                                        $image                  = $_FILES['image'],
                                                
                                                    );

                                                }
                                            ?>
                                            <div class="myaccount-content">
                                            <h3>Add Testimonial</h3>
                                                    <!-- Product ads form Begin-->
                                                    <form action="#" method="POST" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="full_name" class="required">Full Name</label>
                                                                    <input type="text" id="full_name" name="full_name" placeholder="Full Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="image" class="required">Image</label>
                                                                    <input type="file" id="image" name="image" placeholder="Image" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="single-input-item">
                                                                <label for="product_description-name" class="required">Description</label>
                                                                <textarea name="description" class="form-control" id="product_description" cols="20" rows="5"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item mb-20">
                                                            <button class="check-btn sqr-btn" name="testimonial_btn">Add Testimonial</button>
                                                        </div>
                                                    </form>
                                                    <!-- Product form end -->
                                                    <div class="myaccount-table table-responsive text-center mt-40">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>S/N</th>
                                                                    <th>Full Name</th>
                                                                    <th>Description</th>
                                                                    <th>Image</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                foreach($allTestimonial as $testimonial):
                                                                               
                                                            ?>
                                                                <tr>
                                                                    <td><?= $sn7; ?></td>
                                                                    <td><?= $testimonial['full_name']; ?></td>
                                                                    <td><?= $testimonial['description']; ?></td>
                                                                    <td><img src="<?= $testimonial['image']; ?>" alt="Testimonial Image" width="100"></td>
                                                                    <td>
                                                                        <a href="index.php?delete=<?= $testimonial['id']; ?>" 
                                                                        onclick="return confirm('Are you sure, You want to delete this record?')" class="btn btn-danger">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            <?php

                                                                $sn7++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div></div>
                                            </div>
                                        </div>
                                        <!-- Tab Content for Testimonial End -->

                                        <!-- Tab Content for Setting Start -->
                                        <div class="tab-pane fade" id="contact" role="tabpanel">
                                            <?php
                                                if(isset($_POST['setting_btn']))
                                                {
                                                    updateSetting(

                                                        $title                    = trim($_POST['title']),
                                                        $fb_link                    = trim($_POST['fb_link']),
                                                        $twitter_link               = trim($_POST['twitter_link']),
                                                        $youtube_link               = trim($_POST['youtube_link']),
                                                        $instagram_link             = trim($_POST['instagram_link']),
                                                        $logo                       = $_FILES['logo'],
                                                        $address                    = trim($_POST['address']),
                                                        $phone_number               = trim($_POST['phone_number']),
                                                        $email                      = trim($_POST['email']),

                                                
                                                    );

                                                }


                                            ?>
                                            <div class="myaccount-content">
                                                <h3>Website Setting</h3>
                                                    <!-- Product form Begin-->
                                                    <form action="#" method="POST" enctype="multipart/form-data">
                                                            <?php
                                                                foreach($settings as $setting):
                                                                               
                                                            ?>
                                                            <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="single-input-item">
                                                                    <label for="logo" class="required">Web Title</label>
                                                                    <input type="text" id="title" value="<?= $setting['title'] ?>" name="title" placeholder="title" />
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="logo" class="required">Logo</label>
                                                                    <input type="file" id="logo" name="logo" placeholder="Logo" />
                                                                    <img src="<?= $setting['logo'] ?>" alt="logo" width="100">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="Facebook Link" class="required">Facebook Link</label>
                                                                    <input type="text" id="fb_link" name="fb_link" value="<?= $setting['fb_link'] ?>" placeholder="Facebook Link" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="twitter_link" class="required">Twitter Link</label>
                                                                    <input type="text" id="twitter_link" value="<?= $setting['fb_link'] ?>" name="twitter_link" placeholder="Twitter Link" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="youtube_link" class="required">Youtube Link</label>
                                                                    <input type="text" id="youtube_link" value="<?= $setting['youtube_link'] ?>" name="youtube_link" placeholder="Youtube Link" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="instagram_link" class="required">Instagram Link</label>
                                                                    <input type="text" id="instagram_link" value="<?= $setting['instagram_link'] ?>" name="instagram_link" placeholder="Instagram Link" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="address" class="required">Address</label>
                                                                    <input type="text" id="address" value="<?= $setting['address'] ?>" name="address" placeholder="Address" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="phone_number" class="required">Phone Number</label>
                                                                    <input type="text" id="phone_number" value="<?= $setting['phone_number'] ?>" name="phone_number" placeholder="Phone Number" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="email" class="required">Email</label>
                                                                    <input type="text" id="email" value="<?= $setting['email'] ?>" name="email" placeholder="Email" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="single-input-item mb-20">
                                                            <button class="check-btn sqr-btn" name="setting_btn">Change Setting</button>
                                                        </div>
                                                            <?php

                                                                $sn7++;
                                                                endforeach;
                                                                            
                                                            ?>
                                                    </form>
                                                    <!-- Product form end -->
                                                    <div></div>
                                            </div>
                                        </div>
                                        <!-- Tab Content Setting End -->
        
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="account-info" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Account Details</h3>
                                                <div class="account-details-form">
                                                    <form action="#">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">First Name</label>
                                                                    <input type="text" id="first-name" placeholder="First Name" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last-name" class="required">Last Name</label>
                                                                    <input type="text" id="last-name" placeholder="Last Name" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="display-name" class="required">Display Name</label>
                                                            <input type="text" id="display-name" placeholder="Display Name" />
                                                        </div>
                                                        <div class="single-input-item">
                                                            <label for="email" class="required">Email Addres</label>
                                                            <input type="email" id="email" placeholder="Email Address" />
                                                        </div>
                                                        <fieldset>
                                                            <legend>Password change</legend>
                                                            <div class="single-input-item">
                                                                <label for="current-pwd" class="required">Current Password</label>
                                                                <input type="password" id="current-pwd" placeholder="Current Password" />
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="new-pwd" class="required">New Password</label>
                                                                        <input type="password" id="new-pwd" placeholder="New Password" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="confirm-pwd" class="required">Confirm Password</label>
                                                                        <input type="password" id="confirm-pwd" placeholder="Confirm Password" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                        <div class="single-input-item">
                                                            <button class="check-btn sqr-btn ">Save Changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> <!-- Single Tab Content End -->
                                    </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
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
                                    <button class="newsletter-btn" id="mc-submit"><i class="fa fa-send"></i></button>
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
    <script src="../assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- Jquery Min Js -->
    <script src="../assets/js/vendor/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap Min Js -->
    <script src="../assets/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- Plugins Js-->
    <script src="../assets/js/plugins.js"></script>
    <!-- Ajax Mail Js -->
    <script src="../assets/js/ajax-mail.js"></script>
    <!-- Active Js -->
    <script src="assets/js/main.js"></script>

    <!-- Tinymce Js -->
	<!-- javascript -->
	<!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
	<script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="plugin/tinymce/init-tinymce.js"></script>
</body>

</html>