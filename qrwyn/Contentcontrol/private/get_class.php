<?php
require "private/autoloads.php";
if(!empty($_POST["schoolId"])) 
{
 $cid=intval($_POST['schoolId']);
 if(!is_numeric($cid)){
 
 	echo htmlentities("invalid School");exit;
 }
 else{
  $stmt = $connection->prepare("SELECT class_name, classesId FROM classes");
  $stmt->execute();
  ?>
  <option value="">Select Category </option>
  <?php
  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
   ?>
   <option value="<?php echo htmlentities($row['classesId']); ?>"><?php echo htmlentities($row['class_name']); ?></option>
   <?php
  }
}

}
?>


