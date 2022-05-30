<?php 
ob_start();
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_cache_limiter('public'); // works too
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

    <!-- title -->
    <title>Single Product</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- animate css -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="css/responsive.css">

</head>

<body>

    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
    <?php include 'topheader.php'; ?>


    <?php

require 'connection.php';



$sql_user = 'SELECT * FROM user';
$statement_user = $connection->prepare($sql_user);
if(!$statement_user->execute()){
    print_r($statement_user->errorInfo()); 
}

$user_data = $statement_user->fetchAll(pdo::FETCH_ASSOC);

function user_name($arr , $id){
foreach($arr as $value){
    if($value["user_id"] == $id){
        return $value["name"];
        
    }
}}

// session_start();
if (isset($_POST['product_id'])) {
    $_SESSION['product_id'] = $_POST['product_id'];
}
$id = $_SESSION['product_id'];
$Single_product = "SELECT name,product.url_image,price,product_name,descreption FROM product INNER JOIN category WHERE  product_id = :id AND  category.category_id = product.category_id";
$categoryid = "SELECT category_id FROM product WHERE product_id = '$id'";
$stat = $connection->prepare($Single_product);
$stat->execute(array(
    ':id' => $id,
));
$stat1 = $connection->prepare($categoryid);
$stat1->execute();
$Single_product_fetch1 = $stat1->fetchAll();
$categoryid = $Single_product_fetch1[0]['category_id'] ?? null;
$categoryid1 = "SELECT category.name,product.url_image,price,product_name,product.descreption FROM product LEFT JOIN category ON category.category_id = product.category_id WHERE category.category_id = '$categoryid' LIMIT 3";
$stat2 = $connection->prepare($categoryid1);
$stat2->execute();
$Single_product_fetch2 = $stat2->fetchAll();
$Single_product_fetch = $stat->fetchAll();
?>


    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>See more Details</p>
                        <h1>Single Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- single product -->
    <div class="single-product mt-150 mb-150">
        <div class="container">
            <div class="row">
                <?php 
                    foreach ($Single_product_fetch as $item) : ?>
                        <div class="col-md-5">
                            <div class="single-product-img">
                                <img src="images/<?php echo $item['url_image'] ?>" alt="" width="100%" height="400px">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="single-product-content">
                                <h3><?php echo $item['product_name'] ?></h3>
                                <p class="single-product-pricing"><?php echo $item['price'] ?></p>
                                <p><?php echo $item['descreption'] ?></p>
                                <p><?php echo $item['name'] ?></p>
                                <div class="single-product-form">
                                    <a href="cart.php?actioni=true&pro_id=<?php echo $id ?>" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                                </div>
                                <h4>Share:</h4>
                                <ul class="product-share">
                                    <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href=""><i class="fab fa-twitter"></i></a></li>
                                    <li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
                                    <li><a href=""><i class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                <?php endforeach;
                 ?>
            </div>
        </div>
    </div>

    <!-- end single product -->
    <div class="col-lg-8 offset-lg-2 text-center">
        <div class="section-title">
            <h3><span class="orange-text">Customer</span> Comments</h3>
        </div>
    </div>
    <div class="container mt-5">
        <?php
        include 'connection.php';
        if (isset($_POST['text'])) {
            $text = $_POST['text'];

            $inscomment = "INSERT INTO comment(text, user_id , product_id )VALUES(:text , :user_id , :product_id) ";
            $inscommentpre = $connection->prepare($inscomment);
            $inscommentpre->execute(array(
                ':text' => $text ,
                ':user_id' => $_SESSION["user_id"] ,
                ':product_id' => $id
            ));
            header("location:item.php");
            ob_flush();

        }
        $selectcomment = "SELECT * FROM comment";
        $selectcommentpre = $connection->prepare($selectcomment);
        $selectcommentpre->execute();
        $selectcommentfetch = $selectcommentpre->fetchAll();

        ?>
            <?php if(isset($_SESSION["user_id"])){ ?>
        <form action="" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $id ?>">
            <div class="d-flex flex-row align-items-start"><textarea class="form-control ml-1 shadow-none textarea" name="text"></textarea></div>
            <div class="mt-2 text-right"><button class="button cart-btn" type="submit">Post comment</button></div>
            <div class="d-flex justify-content-center row">
            <?php } ?>
                <div class="col-md-8">
                    <div class="d-flex flex-column comment-section">
                        <?php foreach ($selectcommentfetch as $selectcommentfetc) : ?>
                            <div class="bg-white p-2">
                            <hr>
                                <div class="d-flex flex-row user-info"><img class="rounded-circle" src="images/user.png" width="40" height="40px">
                                    <div class="d-flex flex-column justify-content-start ml-2"><span class="d-block font-weight-bold name"><?php echo user_name($user_data , $selectcommentfetc['user_id'] ) ?></span><span class="date text-black-50"><?php echo $selectcommentfetc['text'] ?></span></div>
                                </div>
                                <div class="mt-2">
                                    <p class="comment-text" name="name"></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>

    <br>
    <hr>
    <br>
    <br>
    <!-- more products -->
    <div class="more-products mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="section-title">
                        <h3><span class="orange-text">Related</span> Products</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
                    foreach ($Single_product_fetch2 as $item1) : ?>
                        <div class="col-lg-4 col-md-6 text-center">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="single-product.html"><img src="images/<?php echo $item1['url_image']  ?>" alt=""></a>
                                </div>
                                <h3><?php echo $item1['product_name'] ?></h3>
                                <h6><?php echo $item1['name']  ?></h4>
                                <p class="product-price"><?php echo $item1['price']  ?></p>
                                <a href="cart.php" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                            </div>
                        </div>
                <?php endforeach;
                 ?>
            </div>
        </div>
    </div>
    <!-- end more products -->

    <!-- logo carousel -->
    <div class="logo-carousel-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo-carousel-inner">
                        <div class="single-logo-item">
                            <img src="img/company-logos/1.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="img/company-logos/2.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="img/company-logos/3.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="img/company-logos/4.png" alt="">
                        </div>
                        <div class="single-logo-item">
                            <img src="img/company-logos/5.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end logo carousel -->

    <!-- footer -->
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box about-widget">
                        <h2 class="widget-title">About us</h2>
                        <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box get-in-touch">
                        <h2 class="widget-title">Get in Touch</h2>
                        <ul>
						<li>support@Besnm.com</li>
						<li>+00962787893868</li>
					</ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box pages">
                        <h2 class="widget-title">Pages</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="services.html">Shop</a></li>
                            <li><a href="news.html">News</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-box subscribe">
                        <h2 class="widget-title">Subscribe</h2>
                        <p>Subscribe to our mailing list to get the latest updates.</p>
                        <form action="index.html">
                            <input type="email" placeholder="Email">
                            <button type="submit"><i class="fas fa-paper-plane"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end footer -->

    <!-- copyright -->
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <p>Copyrights &copy; 2022 - <a href="https://imransdesign.com/">besnm</a>, All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 text-right col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end copyright -->

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

</body>

</html>