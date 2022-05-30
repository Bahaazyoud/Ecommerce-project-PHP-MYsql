<?php

@include 'connection.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};


if(isset($_POST['update_profile'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $update_profile = $connection->prepare("UPDATE `user` SET name = ?, email = ? WHERE user_id = ?");
   $update_profile->execute([$name, $email, $user_id]);


   $old_pass = $_POST['old_pass'];
   $update_pass = md5($_POST['update_pass']);
   $update_pass = filter_var($update_pass, FILTER_SANITIZE_STRING);
   $new_pass = md5($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = md5($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if(!empty($update_pass) AND !empty($new_pass) AND !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         $update_pass_query = $connection->prepare("UPDATE `user` SET password = ? WHERE user_id = ?");
         $update_pass_query->execute([$confirm_pass, $user_id]);
         $message[] = 'password updated successfully!';
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
   <title>update user profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
     <link rel="stylesheet" href="css/profile.css">

</head>
<body>
   
<?php
            $select_profile = $connection->prepare("SELECT * FROM `user` WHERE user_id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
      
       




<div class ="row">
	<div class="col-md-5 mx-auto p-0">
		<div class="card">
<div class="login-box">
	<div class="login-snip"><p style='text-align:center ;font-size:25px ;color:white' >Welcome <?= $fetch_profile['name']; ?></p><h5 style='text-align:center;font-size:19px'>update profile</h5>
		<div class="login-space">
           
			<div class="login"> <form action="" method="POST">
            	<div class="group">
					<label for="user" class="label">Name</label>
					<input id="user"  class="input" type="text" name="name" class="box"  value="<?= $fetch_profile['name']; ?>" placeholder="update username" required>
				</div>
				<div class="group">

					<label for="user" class="label">Email</label>
					<input id="user"  class="input" type="email" name="email" class="box" value="<?= $fetch_profile['email']; ?>" placeholder="update email" required>
				</div>
               <input type="hidden" name="old_pass" value="<?= $fetch_profile['password']; ?>">
				<div class="group">
					<label for="pass" class="label">Old Password</label>
					<input type="password" name="update_pass" class="input" placeholder="enter previous password" required>
				</div>
            <div class="group">
					<label for="pass" class="label">New Password</label>
					<input type="password" name="new_pass" class="input" placeholder="enter new password"  required>
				</div>
            <div class="group">
					<label for="pass" class="label">Confirm Password</label>
					<input type="password" name="confirm_pass" class="input"  placeholder="confirm new password" required>
				</div>
				<div class="group">
					<input type="submit" class="button" value="update profile" name="update_profile">
				</div>
            	<div class="hr"></div>
				<div class="foot">
            <label for="tab-2"><a href='index.php'>go back</a></label> 
           </div>
				</form>

		      

		
			</div> 
		</div>
	</div>
</div>   
</div>
</div>
</div>


<?php// include 'footer.php'; ?>


<script src="js/script.js"></script>

</body>
</html>