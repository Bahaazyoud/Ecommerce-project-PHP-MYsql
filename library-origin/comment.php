<?php
session_start();
include 'connection.php';
if(isset($_GET['text'])){
    $text = $_GET['text'];
    $inscomment = "INSERT INTO comment(text)VALUES(:text) ";
    $inscommentpre = $connection->prepare($inscomment);
    $inscommentpre->execute(array(
        ':text' => $text
    ));
    header('location:comment.php');
}
    $selectcomment = "SELECT text FROM comment";
    $selectcommentpre = $connection->prepare($selectcomment);
    $selectcommentpre->execute();
    $selectcommentfetch = $selectcommentpre->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <form action="" method="GET">
                <div><textarea class="form-control ml-1 shadow-none textarea" name="text"></textarea></div>
                <?php foreach($selectcommentfetch as $selectcommentfetc): ?>
                <p><?php echo $selectcommentfetc['text']?></p>
                <?php endforeach ?>
                <button class="btn btn-primary btn-sm shadow-none" type="submit">Post comment</button>
            </form>
        </div>
    </div>
</body>

</html>