<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/thank.css">
</head>
<body>
</body>
</html>
<div class=content>
  <div class="wrapper-1">
    <div class="wrapper-2">
      <h1>Thank you !</h1>
      <p> Your order has been placed. </p>
      
      <button class="go-home"><a href='./index.php'>
      go home
    </a></button>
    </div>
    
</div>
</div>

<?php
        include 'connection.php';
        if (isset($_POST['text'])) {
            $text = $_POST['text'];
            var_dump($text);
            $inscomment = "INSERT INTO`feedback`(text)VALUES(:text) ";
            $inscommentpre = $connection->prepare($inscomment);
            $inscommentpre->execute(array(
                ':text' => $text
            ));
            header('location:index.php');
        }
        ?>
        <br>
        <hr style="width:50%;">
        <br>
       <form method='post'style="text-align:center;">
         <h3>Add Your Feedback About Your Shopping Experience:</h3>
        <textarea type="text" name='text' style="border-radius:40px;border:none;width:50%;padding:20px"></textarea><br>
        <button type='submit' class="go-home">
      ADD YOUR FEEDBACK</button>
      </form>

<link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">