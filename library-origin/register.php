<?php
session_start();
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

   $name = @$_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = @md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   
   $select = $connection->prepare("SELECT * FROM `user` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message1[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message1[] = 'confirm password not matched!';
      }else{
         $state = check($name, $email, $pass, $cpass);
         if ($state == true){

         $insert = $connection->prepare("INSERT INTO `user`(name, email, password) VALUES(?,?,?)");
         $insert->execute([$name, $email, $pass]); 
      
        
               $message1[] = 'registered successfully!';
               header('location:login.php');
         
   
      }

         else {
            $errors[1] = "The account is used";
            header('register.php');
         }

      }
   }

}

?>
    <?php




if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `user` WHERE email = ? AND password = ?";
   $stmt = $connection->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['role'] == 'admin'){

         $_SESSION['admin_id'] = $row['user_id'];
         header('location:admin_page.php');

      }elseif($row['role'] == 'user'){

         $_SESSION['user_id'] = $row['user_id'];
         header('location:login.php');

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/login.css">

</head>
<body>



    
<div class ="row">
	<div class="col-md-6 mx-auto p-0">
		<div class="card">
<div class="login-box">
	<div class="login-snip">
	
		<input id="tab-1" type="radio" name="tab" class="sign-in" ><label for="tab-1" class="tab">Login</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Sign Up</label>

		<div class="login-space">
			<div class="login"> <form action="" method="POST">
				<div class="group">
                     <?php

if(isset($message)){
   foreach($message as $message){
  
     

//my other php code here
        
        
     echo  '
      <div class="message">
         <span>'.$message.'</span>
        <input type="text" hidden required> <i class="fas fa-times" onclick="this.parentElement.remove();"></i>  
           
      </div>
      ';
   }
     
}
   



  
?>
					<label for="user" class="label">Email</label>
					<input id="user"  class="input" type="email" name="email" class="box" placeholder="enter your email" required>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input type="password" name="pass" class="input" placeholder="enter your password" required>
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check" checked>
					<label for="check"><span class="icon"></span> Keep me Signed in</label>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In" name="submit">
				</div>
				<div class="hr"></div>
				<div class="foot">
					<label for="tab-2">Don't have an account?</label> 
				</form>
           
</div>
</div>
		                        <form action=""  method="POST">
			
			<div class="sign-up-form">

				<div class="group">
                     <?php

if(isset($message1)){
   foreach($message1 as $message1){
  
     

//my other php code here
        
        
     echo  '
      <div class="message">
         <span>'.$message1.'</span>
         <input type="text" hidden required/> <i required  class="fas fa-times" onclick="this.parentElement.remove(); "></i> 
           
      </div>
      ';
      unset($message1);
   }
     
}
   



  
?>
				<label for="user" class="label">Username</label>
					<input type="text" id="name" name="name" class="input"  placeholder="enter your fullname" required>
                    <?php echo $errors[1] ?? "" ?>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" type="password" class="input" data-type="password"  name="pass" placeholder="enter your password" required>
               <span class="error"><?php echo $errors[2] ?? "" ?></span>
				</div>
				<div class="group">
					<label for="pass" class="label">Repeat Password</label>
					<input id="pass" type="password" class="input" data-type="password" placeholder="Repeat your password"  required name="cpass" >
            
				</div>
				<div class="group">
					<label for="email" class="label">Email Address</label>
					<input id="email" type="email" class="input" name="email" placeholder="enter your email" required>
				</div>
      
				<div class="group">
					<input type="submit" class="button" value="Sign Up"  name="submit">
				</div>
				<div class="hr"></div>
				<div class="foot">
					<label for="tab-1">Already Member?</label>
               </form>

				</div>
			</div> 
		</div>
	</div>
</div>   
</div>
</div>
</div>

<!-- jquery -->
    <script src="js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="js/sticker.js"></script>
    <!-- main js -->
    <script src="js/main.js"></script>



    <script src="js/script.js"></script>
</body>
  </html> 