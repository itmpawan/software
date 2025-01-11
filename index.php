<?php include "init.php"; //echo 'sparsh@2016'; ?>
<?php if(isset($_SESSION['id'])): ?>
<?php header("location:dashboard.php"); ?>
<?php endif; ?>
<?php 
if(isset($_POST['login'])){

 $data = [
     'mobile'           => $_POST['mobile'],
     'password'       => $_POST['password'],
     'email_error'    => '',
     'password_error' => ''

 ];

 if(empty($data['mobile'])){
  $data['mobile_error'] = "Mobile number field is required";
 }

 if(empty($data['password'])){
  $data['password_error'] = "Password field is required";
 }

 /*
     * Submit the login form
 */ 

 if(empty($data['mobile_error']) && empty($data['password_error'])){
  if($dbObject->queryExecute("SELECT * FROM admin WHERE mobile = ?", [$data['mobile']])){
    if($dbObject->countRows() > 0){
     $row = $dbObject->singleRecord();
     $id = $row->id;
     $organization = $row->organization;
     $email = $row->email;
     $mobile = $row->mobile;
     $db_password = $row->password;

     if(password_verify($data['password'], $db_password)){

      $_SESSION['login_success'] = "Hi ".$organization . " You are successfully login";
      $_SESSION['id'] = $id;
      $_SESSION['org'] = $organization;
      $_SESSION['email'] = $email;
      $_SESSION['mobile'] = $mobile;

      header("location:dashboard.php");

     } else {
      $data['password_error'] = "Please enter correct password";
     }
    } else {
      $data['mobile_error'] = "Please enter correct mobile number";
    }

  }
 }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>Admin Login - SR Enterprises</title>
 <link rel="stylesheet" href="assets/css/style.css">
 <link href="https://fonts.googleapis.com/css?family=Raleway:200,300,400" rel="stylesheet"> 
 <link rel="icon" href="assets/img/SR-logo.png" type="image/png" sizes="16x16">
</head>
<body>
 
 <div class="container">
  <div class="form">
   <div class="form-section">
    <form action="" method="POST">
     <div class="group">
      <h3 class="heading">Admin Login</h3>
     </div>
     <div class="group">
      <input type="number" name="mobile" class="control" placeholder="Enter Mobile Number..." value="<?php if(!empty($data['mobile'])): echo $data['mobile']; endif;?>">
      <div class="error">
        <?php if(!empty($data['mobile_error'])): ?>
          <?php echo $data['mobile_error']; ?>
        <?php endif; ?>
      </div>
     </div>
     <div class="group">
      <input type="password" name="password" class="control" placeholder="Enter Your Password..." value="<?php if(!empty($data['password'])): echo $data['password']; endif;?>">
      <div class="error">
        <?php if(!empty($data['password_error'])): ?>
          <?php echo $data['password_error']; ?>
        <?php endif; ?>
      </div>
     </div>
 
     <div class="group m20">
      <input type="submit" name="login" class="btn" value="Login &rarr;">
     </div>
     
    </form>
   </div>
  </div>
 </div>
</body>
</html>