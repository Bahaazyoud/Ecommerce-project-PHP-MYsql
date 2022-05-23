<?php

include 'connection.php';
$errors = [];
// Validation Function
function check($name, $email, $pass, $confirmPassword)
{
	global $errors;
	$regexName      = "/^[A-z ]{3,}$/";
	$regexEmail     = "/^[A-z0-9._-]+@(hotmail|gmail|yahoo).com$/";
	//$regexPassword  = "/^(?=.*[A-Z])(?=.*[@$!%*#?&])(?=.*[a-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/";
	$state = true;
	// Validation 
	if (empty($name) || trim($name) == "") {
		$errors[0] = "This field is required";
		$state     = false;
	} else if (!preg_match($regexName, $name)) {
		$errors[0] = "This field is not correct, only letters are allowed";
		$state     = false;
	}
	if (empty($email) || trim($email) == "") {
		$errors[1] = "This field is required";
		$state     = false;
	} else if (!preg_match($regexEmail, $email)) {
		$errors[1] = "This field is not correct";
		$state     = false;
	}
	if (empty($pass) || trim($pass) == "") {
		$errors[2] = "This field is required";
		$state     = false;
	}
   //  else if (!preg_match($regexPassword, $pass)) {
	// 	$errors[2] = "The password is not correct, it must be at least 8 characters and must contains (upper case, lower case, numbers, special character, no spaces ";
	// 	$state     = false;
	// }
	// if (empty($cpass) || trim($cpass) == "") {
	// 	$errors[3] = "This field is required";
	// 	$state     = false;
	// } else if (!preg_match($regexPassword, $pass)) {
	// 	$errors[3] = "The password are not match";
	// 	$state     = false;
	// }
	return $state;
}




if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $connection->prepare("SELECT * FROM `user` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $state = check($name, $email, $pass, $cpass);
         if ($state == true){

         $insert = $connection->prepare("INSERT INTO `user`(name, email, password, url_image) VALUES(?,?,?,?)");
         $insert->execute([$name, $email, $pass, $image]); 
         if($insert){
            if($image_size > 2000000){
               $message[] = 'image size is too large!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'registered successfully!';
               header('location:login.php');
            }
         }
   
      }

         else {
            $errors[1] = "The account is used";
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/components.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
   
<section class="form-container">

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>register now</h3>
      <input type="text" name="name" class="box" placeholder="enter your fullname" required>
      <span class="error"><?php echo $errors[0] ?? "" ?></span>

      <input type="email" name="email" class="box" placeholder="enter your email" required>

      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <span class="error"><?php echo $errors[2] ?? "" ?></span>
      
      <input type="password" name="cpass" class="box" placeholder="confirm your password" required>

      
      <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="register now" class="btn" name="submit">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>

</body>
</html>