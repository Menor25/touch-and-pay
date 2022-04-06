
<?php
session_start();

require "private/database.php";

// $user_id = $_SESSION['user']['id'];
// function for admin login
function adminLogin($username = NULL, $password = NULL){
    global $connection;
    global $Error;


    $stmt = $connection->prepare('SELECT * FROM user_tbl WHERE username = ? AND password = ?');
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 0)
    {
        $_SESSION[$Error] = "Username or password is incorrect";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        header('Location: login-register.php');
        exit();
    }
        
    else
    {
        while($rows = $result->fetch_assoc()){
            $_SESSION['user']['id'] = $rows['id'];
            $_SESSION['full_name']['id'] = $rows['full_name'];
            // $_SESSION['username']['id'] = $rows['username'];
            $_SESSION['email']['id'] = $rows['email'];
            

        }
        header('Location: index.php');
    }
    
    $stmt->close();

}

// function for admin logout
function adminLogout(){
    global $Error;

    unset($_SESSION['user']['id']);
    $_SESSION[$Error] = "You have logged out successfully.";
    $_SESSION['msg_type'] = "success";
    header('Location: login-register.php');
    exit();
}

//Insert User Function
function insertUser($full_name = NULL, $email = NULL, $username = NULL, $password = NULL, $confirm_password = NULL){
    global $Error;
    global $connection;
    $Error = "";

     //Check if it is a valid username
    if (!preg_match("/^[a-zA-Z]+[0-9]+$/", $username)) {
        $_SESSION[$Error] = "Please enter a valid username. Username must contain words and number.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        exit();
    }

    //Check if it is a valid password
    if (!preg_match("/^[a-zA-Z]+[0-9]+$/", $password)) {
        $_SESSION[$Error] = "Password must contain number and word";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }

    if($password !== $confirm_password)
    {
        $_SESSION[$Error] = "Password did not match!";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }

    if(empty($full_name)) {
        $_SESSION[$Error] = "Full name field cannot be empty.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        exit();
    }
    if(empty($email)) {
        $_SESSION[$Error] = "Email field cannot be empty.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        exit();
    }
    if(empty($username)) {
        $_SESSION[$Error] = "Username field cannot be empty.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        exit();
    }
    if(empty($password)) {
        $_SESSION[$Error] = "Password field cannot be empty.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        exit();
    }
    if(empty($confirm_password)) {
        $_SESSION[$Error] = "Repeat password field cannot be empty.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        exit();
    }

    if ($Error == "") {
        $stmt1 = $connection->prepare('SELECT * FROM user_tbl WHERE full_name = ? AND email = ?');
        $stmt1->bind_param('ss', $full_name, $email);
        $stmt1->execute();
        $result = $stmt1->get_result();
        if ($result->num_rows != 0) {

            $_SESSION[$Error] = "User already exist!";
            $_SESSION['msg_type'] = "danger";
            return ($_SESSION[$Error]);
        }


            $stmt = $connection->prepare('INSERT INTO user_tbl (full_name, email, username, password)
            VALUES(?,?,?,?)');
            $stmt->bind_param('ssss', $full_name, $email, $username, $password);
            $stmt->execute();

            $_SESSION[$Error] = "New user added successfully!";
            $_SESSION['msg_type'] = "success";
            return ($_SESSION[$Error]);
            $stmt->close();
        
    }
    else{
        $_SESSION[$Error] = "Unable to add user!";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        exit();
    }
}

//Insert Product
function insertProduct($user_id = NULL, $product_name = NULL, $product_price = NULL, $category_id = NULL, $product_image = NULL, 
            $product_manufacturer = NULL, $product_link = NULL, $product_desc = NULL)
{
    global $user_id;
    $Error = "";
    global $Error;
    global $connection;

    $product_name  = htmlspecialchars(trim($_POST['product_name']));
    $product_price      = htmlspecialchars(trim($_POST['product_price']));
    $category_id        = htmlspecialchars(trim($_POST['category_id']));
    $product_image      = $_FILES['product_image'];
    $product_manufacturer = htmlspecialchars(trim($_POST['product_manufacturer']));
    $product_link       = htmlspecialchars(trim($_POST['product_link']));
    $product_desc       = htmlspecialchars(trim($_POST['product_desc']));

    //image processing
    $target_dir = "../images/product/$product_name";
    $product_image = $target_dir . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($product_image, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check == false) {
        $_SESSION[$Error] = "File is not an image.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        // echo "File is not an image";
        exit();
    }
    // Check if file already exists
    if (file_exists($product_image)) {

        $_SESSION[$Error] = "Sorry, image already exist.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        header('Location: index.php');
        exit();

    }
    // Check file size
    if ($_FILES["product_image"]["size"] > 5000000) {
        $_SESSION[$Error] = "Sorry, your image is too large.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        // echo "image is too large";
        exit();
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION[$Error] = "Sorry, only JPG, JPEG and PNG files are allowed.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        // echo "File is not the accepted image format";
        exit();
    }


    move_uploaded_file($_FILES["product_image"]["tmp_name"], $product_image);

    $sql = "INSERT INTO product_tbl(user_id, product_name, product_price, category_id, product_image, 
            product_manufacturer, product_link, product_desc) 
            VALUES('".$user_id."','".$product_name."', '".$product_price."', '".$category_id."', '".$product_image."',
             '".$product_manufacturer."', '".$product_link."', '".$product_desc."')";
    // echo $sql;

    if(mysqli_query($connection, $sql))
    {
        $_SESSION[$Error] = "Product added successfully.";
        $_SESSION['msg_type'] = "Success";
        return ($_SESSION[$Error]);
        header('Location: ../index.php');
        // echo "Product added successfully!";
    }else
    {
        $_SESSION[$Error] = "Unable to add product";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
        header('Location: ../index.php');
        // echo "Unable to add product";
    }
}

//Select function for New product
function selectProduct(){
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM product_tbl');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

//Edit function for student details
function editProduct($product_name = NULL, $product_price = NULL, $category_id = NULL, $product_desc = NULL, 
                    $product_image = NULL, $product_manufacturer = NULL, $product_link = NULL)
{
    $Error = "";
    global $connection;

    $target_dir = "../images/product/$product_name";
    $product_image = $target_dir . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($product_image, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check == false) {
        $_SESSION[$Error] = "File is not an image.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }
    // Check if file already exists
    if (file_exists($product_image)) {
        $_SESSION[$Error] = "Sorry, image already exists.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }
    // Check file size
    if ($_FILES["product_image"]["size"] > 500000) {
        $_SESSION[$Error] = "Sorry, your image is too large.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $_SESSION[$Error] = "Sorry, only JPG, JPEG and PNG files are allowed.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }

    //Check if it is a valid product name
    if (!preg_match("/^[a-zA-Z]+[0-9]+$/", $product_name)) {
        $_SESSION[$Error] = "Please enter a valid product name.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }

        //Check if it is a valid product name
        if (!preg_match("/^[a-zA-Z]+$/", $category_id)) {
            $_SESSION[$Error] = "Please enter a valid product name.";
            $_SESSION['msg_type'] = "danger";
            return ($_SESSION[$Error]);
        }

    //Check if it is a valid product price
    if (!preg_match("/^[$]+[0-9]+$/", $product_price)) {
        $_SESSION[$Error] = "Price should contain dollar sign ($) numbers only";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }

    //Check if it is a valid username
    if (!preg_match("/^[a-zA-Z]+$/", $product_manufacturer)) {
        $_SESSION[$Error] = "Please enter a valid product manufacturer name.";
        $_SESSION['msg_type'] = "danger";
        return ($_SESSION[$Error]);
    }

    if ($Error == "") {
        move_uploaded_file($_FILES["product_image"]["tmp_name"], $product_image);

        $stmt = $connection->prepare("UPDATE product_tbl SET product_name = ?, product_price = ?, category_id = ?,
                                     product_desc = ?, product_image = ?, product_manufacturer = ?, product_link = ? WHERE id = ?");
        $stmt->bind_param('ssssssssssssssssssi', $product_name, $product_price, $category_id, $product_desc, $product_image, 
                                    $product_manufacturer, $product_link, $id);
        $stmt->execute();
        
        if ($stmt->affected_rows === 0) {

            $_SESSION[$Error] = "Unable to update product details!";
            $_SESSION['msg_type'] = "danger";
            return ($_SESSION[$Error]);
        } else {
    
            $_SESSION[$Error] = "Product details updated successfully!";
            $_SESSION['msg_type'] = "success";
            // header('Location: all-class.php');
            return ($_SESSION[$Error]);
        }
        $stmt->close();
    }
}

//Delete function for deleting student details
function deleteProduct($id){
    global $Error;
    global $connection;

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sel = $connection->prepare('SELECT product_image FROM product_tbl WHERE id = ?');
        $sel->bind_param('i', $id);
        $sel->execute();
        $result = $sel->get_result();
        
        
        while($row = $result->fetch_assoc()){
            $product_image_name = $row['product_image'];
            unlink($product_image_name);
        }

        $stmt = $connection->prepare('DELETE FROM product_tbl WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $_SESSION[$Error] = "Unable to delete product.";
            $_SESSION['msg_type'] = "danger";

            return ($_SESSION[$Error]);
            header('Location: index.php');
        } else {
            $_SESSION[$Error] = "Product deleted successfully!";
            $_SESSION['msg_type'] = "success";
            return ($_SESSION[$Error]);


            header('Location: index.php');
        }
        $stmt->close();
        header('Location: index.php');
    }
}

//Insert category
function insertCategory($category_name = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

    $sql1 = "SELECT * FROM category_tbl WHERE category_name = '".$category_name."' ";
    if($result = mysqli_query($connection, $sql1)){
        if(mysqli_num_rows($result) > 0 ){
            $_SESSION[$Error] = "Category with the same name already exist.";
            $_SESSION['msg_type'] = "danger";
            return ($_SESSION[$Error]);
            exit();
        }else
        {
            $sql = "INSERT INTO category_tbl(user_id, category_name) VALUES('".$user_id."', '".$category_name."')";
    
            if(mysqli_query($connection, $sql))
            {
                $_SESSION[$Error] = "Category added successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
                exit();
            }else{
                $_SESSION[$Error] = "Unable to add category.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
        }
    }
    

    


}


//Select function to display class
function selectCategory()
{
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM category_tbl');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

//Delete function for deleting category
function deleteCategory($id){
    global $Error;
    global $connection;

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $stmt = $connection->prepare('DELETE FROM category_tbl WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $_SESSION[$Error] = "Unable to delete category.";
            $_SESSION['msg_type'] = "danger";

            return ($_SESSION[$Error]);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION[$Error] = "Category deleted successfully!";
            $_SESSION['msg_type'] = "success";
            return ($_SESSION[$Error]);
            header('Location: ../index.php');
            exit();
        }
        $stmt->close();
        header('Location: index.php');
    }
}

//Insert category
function insertSlide($slide_title = NULL, $slide_img = NULL, $slide_desc = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

     //image processing
     $target_dir = "../images/slide/$slide_title";
     $slide_img = $target_dir . basename($_FILES["slide_img"]["name"]);
     $imageFileType = strtolower(pathinfo($slide_img, PATHINFO_EXTENSION));
 
 
            
     $sql1 = "SELECT * FROM slide_tbl WHERE slide_title = '".$slide_title."' ";
     if($result = mysqli_query($connection, $sql1)){
         if(mysqli_num_rows($result) > 0 ){
             $_SESSION[$Error] = "Slide already exist.";
             $_SESSION['msg_type'] = "danger";
             return ($_SESSION[$Error]);
             exit();
         }else
         {
            move_uploaded_file($_FILES["slide_img"]["tmp_name"], $slide_img);

            $sql = "INSERT INTO slide_tbl(user_id, slide_title, slide_img, slide_desc) 
                    VALUES('".$user_id."', '".$slide_title."', '".$slide_img."', '".$slide_desc."')";
    
            if(mysqli_query($connection, $sql))
            {
                $_SESSION[$Error] = "Slide added successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
                exit();
            }else{
                $_SESSION[$Error] = "Unable to add slide.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
         }
     }

 

        
}

//Select function to display slide
function selectSlide()
{
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM slide_tbl');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

//Delete function for deleting slide
function deleteSlide($id){
    global $Error;
    global $connection;

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sel = $connection->prepare('SELECT slide_img FROM slide_tbl WHERE id = ?');
        $sel->bind_param('i', $id);
        $sel->execute();
        $result = $sel->get_result();
        
        
        while($row = $result->fetch_assoc()){
            $slide_image_name = $row['product_image'];
            unlink($slide_image_name);
        }

        $stmt = $connection->prepare('DELETE FROM slide_tbl WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $_SESSION[$Error] = "Unable to delete slide.";
            $_SESSION['msg_type'] = "danger";

            return ($_SESSION[$Error]);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION[$Error] = "Slide deleted successfully!";
            $_SESSION['msg_type'] = "success";
            return ($_SESSION[$Error]);
            header('Location: ../index.php');
            exit();
        }
        $stmt->close();
        header('Location: index.php');
    }
}

//Update Product Banner
function updateBanner($banner_title = NULL, $button_name = NULL, $short_desc = NULL, $banner_img = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

     //image processing
     $target_dir = "../images/banner/$banner_title";
     $banner_img = $target_dir . basename($_FILES["banner_img"]["name"]);
     $imageFileType = strtolower(pathinfo($banner_img, PATHINFO_EXTENSION));
 
 
            

            move_uploaded_file($_FILES["banner_img"]["tmp_name"], $banner_img);

            $sql1 = "UPDATE ads_banner SET user_id = '".$user_id."', banner_title = '".$banner_title."', button_name = '".$button_name."', 
                    short_desc = '".$short_desc."', banner_img = '".$banner_img."' WHERE id=6";

            echo $sql1;
            if(mysqli_query($connection, $sql1))
            {
                $_SESSION[$Error] = "Product Banner updated successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
            }else{
                $_SESSION[$Error] = "Unable to update product banner.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
         
     

        
}

// //Insert Product banner ads
// function insertProductBanner($banner_title = NULL, $button_name = NULL, $short_desc = NULL, $banner_img = NULL)
// {
//     global $user_id;
//     global $Error;
//     global $connection;
//     $Error = "";

//      //image processing
//      $target_dir = "../images/banner/$banner_title";
//      $banner_img = $target_dir . basename($_FILES["banner_img"]["name"]);
//      $imageFileType = strtolower(pathinfo($banner_img, PATHINFO_EXTENSION));
 
 
            
//      $sql1 = "SELECT * FROM ads_banner WHERE banner_title = '".$banner_title."' ";
//      if($result = mysqli_query($connection, $sql1)){
//          if(mysqli_num_rows($result) > 0 ){
//              $_SESSION[$Error] = "Banner already exist.";
//              $_SESSION['msg_type'] = "danger";
//              return ($_SESSION[$Error]);
//              exit();
//          }else
//          {
//             move_uploaded_file($_FILES["banner_img"]["tmp_name"], $banner_img);

//             $sql = "INSERT INTO ads_banner(user_id, banner_title, button_name, short_desc, banner_img) 
//                     VALUES('".$user_id."', '".$banner_title."', '".$button_name."', '".$short_desc."', '".$banner_img."')";
    
//             if(mysqli_query($connection, $sql))
//             {
//                 $_SESSION[$Error] = "Banner added successfully.";
//                 $_SESSION['msg_type'] = "Success";
//                 return ($_SESSION[$Error]);
//             }else{
//                 $_SESSION[$Error] = "Unable to add Banner.";
//                 $_SESSION['msg_type'] = "danger";
//                 return ($_SESSION[$Error]);
//                 header('Location: ../index.php');
//             }
//          }
//      }

 

        
// }

//Select function to display banner
function selectBanner()
{
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM ads_banner');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

//Delete function for deleting banner
function deleteBanner($id){
    global $Error;
    global $connection;

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $stmt = $connection->prepare('DELETE FROM ads_banner WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $_SESSION[$Error] = "Unable to delete banner.";
            $_SESSION['msg_type'] = "danger";

            return ($_SESSION[$Error]);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION[$Error] = "Banner deleted successfully!";
            $_SESSION['msg_type'] = "success";
            return ($_SESSION[$Error]);
            header('Location: ../index.php');
            exit();
        }
        $stmt->close();
        header('Location: index.php');
    }
}

//Update Featured Banner
function updateFeaturedBanner($banner_title = NULL, $button_name = NULL, $short_desc = NULL, $banner_img = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

     //image processing
     $target_dir = "../images/featured/$banner_title";
     $banner_img = $target_dir . basename($_FILES["banner_img"]["name"]);
     $imageFileType = strtolower(pathinfo($banner_img, PATHINFO_EXTENSION));
 
 
            

            move_uploaded_file($_FILES["banner_img"]["tmp_name"], $banner_img);

            $sql1 = "UPDATE featured_banner SET user_id = '".$user_id."', banner_title = '".$banner_title."', button_name = '".$button_name."', 
                    short_desc = '".$short_desc."', banner_img = '".$banner_img."' WHERE id=3";

            echo $sql1;
            if(mysqli_query($connection, $sql1))
            {
                $_SESSION[$Error] = "Featured Banner updated successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
            }else{
                $_SESSION[$Error] = "Unable to update featured banner.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
         
     

        
}

//Insert Featured banner ads
function insertFeaturedBanner($banner_title = NULL, $button_name = NULL, $short_desc = NULL, $banner_img = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

     //image processing
     $target_dir = "../images/featured/$banner_title";
     $banner_img = $target_dir . basename($_FILES["banner_img"]["name"]);
     $imageFileType = strtolower(pathinfo($banner_img, PATHINFO_EXTENSION));
 
 
            
     $sql1 = "SELECT * FROM featured_banner WHERE banner_title = '".$banner_title."' ";
     if($result = mysqli_query($connection, $sql1)){
         if(mysqli_num_rows($result) > 0 ){
             $_SESSION[$Error] = "Banner already exist.";
             $_SESSION['msg_type'] = "danger";
             return ($_SESSION[$Error]);
             exit();
         }else
         {
            move_uploaded_file($_FILES["banner_img"]["tmp_name"], $banner_img);

            $sql = "INSERT INTO featured_banner(user_id, banner_title, button_name, short_desc, banner_img) 
                    VALUES('".$user_id."', '".$banner_title."', '".$button_name."', '".$short_desc."', '".$banner_img."')";
    
            if(mysqli_query($connection, $sql))
            {
                $_SESSION[$Error] = "Banner added successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
            }else{
                $_SESSION[$Error] = "Unable to add Banner.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
         }
     }

 

        
}

//Select function to display featured banner
function selectFeaturedBanner()
{
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM featured_banner');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

//Delete function for deleting  featured banner
function deleteFeaturedBanner($id){
    global $Error;
    global $connection;

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $stmt = $connection->prepare('DELETE FROM featured_banner WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $_SESSION[$Error] = "Unable to delete banner.";
            $_SESSION['msg_type'] = "danger";

            return ($_SESSION[$Error]);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION[$Error] = "Banner deleted successfully!";
            $_SESSION['msg_type'] = "success";
            return ($_SESSION[$Error]);
            header('Location: ../index.php');
            exit();
        }
        $stmt->close();
        header('Location: index.php');
    }
}


//Update About
function updateAbout($title = NULL, $description = NULL, $image = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

     //image processing
     $target_dir = "../images/about/$title";
     $image = $target_dir . basename($_FILES["image"]["name"]);
     $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
 
 
            

            move_uploaded_file($_FILES["image"]["tmp_name"], $image);

            $sql1 = "UPDATE about_us_tbl SET user_id = '".$user_id."', title = '".$title."', description = '".$description."', image = '".$image."' 
                    WHERE id=3";

            // echo $sql1;
            if(mysqli_query($connection, $sql1))
            {
                $_SESSION[$Error] = "About us updated successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
            }else{
                $_SESSION[$Error] = "Unable to update about us.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
         
     

        
}

// // Insert About
// function insertAbout($title = NULL, $description = NULL, $image = NULL)
// {
//     global $user_id;
//     global $Error;
//     global $connection;
//     $Error = "";

//      //image processing
//      $target_dir = "../images/about/$title";
//      $image = $target_dir . basename($_FILES["image"]["name"]);
//      $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
 
 
            
//      $sql1 = "SELECT * FROM about_us_tbl WHERE title = '".$title."' ";
//      if($result = mysqli_query($connection, $sql1)){
//          if(mysqli_num_rows($result) > 0 ){
//              $_SESSION[$Error] = "This about details already exist.";
//              $_SESSION['msg_type'] = "danger";
//              return ($_SESSION[$Error]);
//              exit();
//          }else
//          {
//             move_uploaded_file($_FILES["image"]["tmp_name"], $image);

//             $sql = "INSERT INTO about_us_tbl(user_id, title, description, image) 
//                     VALUES('".$user_id."', '".$title."', '".$description."', '".$image."')";
    
//             if(mysqli_query($connection, $sql))
//             {
//                 $_SESSION[$Error] = "About us details added successfully.";
//                 $_SESSION['msg_type'] = "Success";
//                 return ($_SESSION[$Error]);
//             }else{
//                 $_SESSION[$Error] = "Unable to add about details.";
//                 $_SESSION['msg_type'] = "danger";
//                 return ($_SESSION[$Error]);
//                 header('Location: ../index.php');
//             }
//          }
//      }

        
// }

//Select function to display featured banner
function selectAbout()
{
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM about_us_tbl');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

// //Delete function for deleting  featured banner
// function deleteAbout($id){
//     global $Error;
//     global $connection;

//     if (isset($_GET['delete'])) {
//         $id = $_GET['delete'];

//         $stmt = $connection->prepare('DELETE FROM about_us_tbl WHERE id = ?');
//         $stmt->bind_param('i', $id);
//         $stmt->execute();

//         if ($stmt->affected_rows === 0) {
//             $_SESSION[$Error] = "Unable to delete about us details.";
//             $_SESSION['msg_type'] = "danger";

//             return ($_SESSION[$Error]);
//             header('Location: index.php');
//             exit();
//         } else {
//             $_SESSION[$Error] = "About us details deleted successfully!";
//             $_SESSION['msg_type'] = "success";
//             return ($_SESSION[$Error]);
//             header('Location: ../index.php');
//             exit();
//         }
//         $stmt->close();
//         header('Location: index.php');
//     }
// }

//Insert Team
function insertTeam($full_name = NULL, $position = NULL, $description = NULL, $image = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

     //image processing
     $target_dir = "../images/team/$full_name";
     $image = $target_dir . basename($_FILES["image"]["name"]);
     $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
 
 
            
     $sql1 = "SELECT * FROM team_tbl WHERE full_name = '".$full_name."' ";
     if($result = mysqli_query($connection, $sql1)){
         if(mysqli_num_rows($result) > 0 ){
             $_SESSION[$Error] = "Team details already exist.";
             $_SESSION['msg_type'] = "danger";
             return ($_SESSION[$Error]);
             exit();
         }else
         {
            move_uploaded_file($_FILES["image"]["tmp_name"], $image);

            $sql = "INSERT INTO team_tbl(user_id, full_name, position, description, image) 
                    VALUES('".$user_id."', '".$full_name."', '".$position."', '".$description."', '".$image."')";
    
            if(mysqli_query($connection, $sql))
            {
                $_SESSION[$Error] = "Team details added successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
            }else{
                $_SESSION[$Error] = "Unable to add team details.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
         }
     }

        
}

//Select function to display Team
function selectTeam()
{
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM team_tbl');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

//Delete function for deleting  Team
function deleteTeam($id){
    global $Error;
    global $connection;

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sel = $connection->prepare('SELECT * FROM team_tbl WHERE id = ?');
        $sel->bind_param('i', $id);
        $sel->execute();
        $result = $sel->get_result();
        
        
        while($row = $result->fetch_assoc()){
            $team_image_name = $row['image'];
            unlink($team_image_name);
        }

        $stmt = $connection->prepare('DELETE FROM team_tbl WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $_SESSION[$Error] = "Unable to delete team details.";
            $_SESSION['msg_type'] = "danger";

            return ($_SESSION[$Error]);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION[$Error] = "Team details deleted successfully!";
            $_SESSION['msg_type'] = "success";
            return ($_SESSION[$Error]);
            header('Location: ../index.php');
            exit();
        }
        $stmt->close();
        header('Location: index.php');
    }
}

//Insert Testimonial
function insertTestimonial($full_name = NULL, $description = NULL, $image = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

     //image processing
     $target_dir = "../images/testimonial/$full_name";
     $image = $target_dir . basename($_FILES["image"]["name"]);
     $imageFileType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
 
 
            
     $sql1 = "SELECT * FROM testimonial WHERE full_name = '".$full_name."' ";
     if($result = mysqli_query($connection, $sql1)){
         if(mysqli_num_rows($result) > 0 ){
             $_SESSION[$Error] = "Testimonial details already exist.";
             $_SESSION['msg_type'] = "danger";
             return ($_SESSION[$Error]);
             exit();
         }else
         {
            move_uploaded_file($_FILES["image"]["tmp_name"], $image);

            $sql = "INSERT INTO testimonial(user_id, full_name, description, image) 
                    VALUES('".$user_id."', '".$full_name."', '".$description."', '".$image."')";
    
            if(mysqli_query($connection, $sql))
            {
                $_SESSION[$Error] = "Testimonial details added successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
            }else{
                $_SESSION[$Error] = "Unable to add testimonial details.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
         }
     }

        
}

//Select function to display Testimonial
function selectTestimonial()
{
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM testimonial');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

//Delete function for deleting  Testimonial
function deleteTestimonial($id){
    global $Error;
    global $connection;

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $stmt = $connection->prepare('DELETE FROM testimonial WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            $_SESSION[$Error] = "Unable to delete testimonial details.";
            $_SESSION['msg_type'] = "danger";

            return ($_SESSION[$Error]);
            header('Location: index.php');
            exit();
        } else {
            $_SESSION[$Error] = "testimonial details deleted successfully!";
            $_SESSION['msg_type'] = "success";
            return ($_SESSION[$Error]);
            header('Location: ../index.php');
            exit();
        }
        $stmt->close();
        header('Location: index.php');
    }
}

//Insert Website Details
function updateSetting($title = NULL, $fb_link = NULL, $twitter_link = NULL, $youtube_link = NULL, $instagram_link = NULL,  $logo = NULL,
                        $address = NULL, $phone_number = NULL, $email = NULL)
{
    global $user_id;
    global $Error;
    global $connection;
    $Error = "";

     //image processing
     $target_dir = "../images/logo/$email";
     $logo = $target_dir . basename($_FILES["logo"]["name"]);
     $imageFileType = strtolower(pathinfo($logo, PATHINFO_EXTENSION));
 
 
            

            move_uploaded_file($_FILES["logo"]["tmp_name"], $logo);

            $sql = "UPDATE website_setting SET user_id = '".$user_id."', title = '".$title."', fb_link = '".$fb_link."', twitter_link = '".$twitter_link."', 
                    youtube_link = '".$youtube_link."', instagram_link = '".$instagram_link."', logo = '".$logo."', address = '".$address."', 
                    phone_number = '".$phone_number."', email = '".$email."' WHERE id=1";

            // $sql = "INSERT INTO website_setting(user_id, fb_link, twitter_link, youtube_link, instagram_link, logo, address, 
            //         phone_number, email) 
            //         VALUES('".$user_id."', '".$fb_link."', '".$twitter_link."', '".$youtube_link."', '".$instagram_link."',
            //          '".$logo."', '".$address."', '".$phone_number."', '".$email."')";
    
            if(mysqli_query($connection, $sql))
            {
                $_SESSION[$Error] = "Website settings updated successfully.";
                $_SESSION['msg_type'] = "Success";
                return ($_SESSION[$Error]);
            }else{
                $_SESSION[$Error] = "Unable to update website settings.";
                $_SESSION['msg_type'] = "danger";
                return ($_SESSION[$Error]);
                header('Location: ../index.php');
            }
         
     

        
}

//Select function to display website setting
function selectSetting()
{
    global $connection;
    $data = array();

    $stmt = $connection->prepare('SELECT * FROM website_setting');
    $stmt->execute();
    $result = $stmt->get_result();

    // if ($result->num_rows === 0) echo "No rows found";
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}
