<?php
include_once 'connection.php';
session_start();
include('topheader.php');
$select = "SELECT * FROM category";
$stat = $connection->prepare($select);
$stat->execute();
$categorys = $stat->fetchAll(PDO::FETCH_ASSOC);
$query = "SELECT * FROM product LIMIT 6";
$filter = $connection->prepare($query);
$filter->execute();

$products = $filter->fetchAll();
?>

<?php



// $user_id = $_SESSION['user_id'];

// if(!isset($user_id)){
//    header('location:login.php');
// };

?>

<!-- home page slider -->
<div class="homepage-slider">
	<!-- single home slider -->
	<div class="single-homepage-slider homepage-bg-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<h1>Besnm Library</h1>
							<div class="hero-btns">
								<a href="about.php" class="boxed-btn">About us</a>
								<a href="contact.html" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- single home slider -->
	<div class="single-homepage-slider homepage-bg-2">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 offset-lg-1 offset-xl-0">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<h1>library for everyone</h1>
							<div class="hero-btns">
								<a href="about.php" class="boxed-btn">About us</a>
								<a href="contact.html" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- single home slider -->
	<div class="single-homepage-slider homepage-bg-3">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 offset-xl-0">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<h1>Get school Discount</h1>
							<div class="hero-btns">
								<a href="about.php" class="boxed-btn">About us</a>
								<a href="contact.html" class="bordered-btn">Contact Us</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end home page slider -->

<!-- features list section -->
<div class="list-section pt-80 pb-80">
	<div class="container">

		<div class="row">
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-shipping-fast"></i>
					</div>
					<div class="content">
						<h3>Free Shipping</h3>
						<p>When order over $75</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-phone-volume"></i>
					</div>
					<div class="content">
						<h3>24/7 Support</h3>
						<p>Get support all day</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="list-box d-flex justify-content-start align-items-center">
					<div class="list-icon">
						<i class="fas fa-sync"></i>
					</div>
					<div class="content">
						<h3>Refund</h3>
						<p>Get refund within 3 days!</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- end features list section -->

<!-- latest news -->

<div class="latest-news pt-150 pb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Our</span> category</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<?php foreach ($categorys as $category) : ?>

				<div class="col-lg-3 col-md-6">
					<div class="single-latest-news" style="height:400px">
						<a href="single-news.html">
							<div class="latest-news-bg"><a href="single-product.html"><img src="images/<?php echo $category['url_image'] ?>" class="c" alt="" height="200px" width="100px"></a></div>
						</a>
						<div class="news-text-box">
							<h3><?php echo $category['name'] ?></h3>
							<p class="excerpt" style="word-wrap: break-word;"><?php echo $category['description'] ?></p>
							<form action="product.php" method="POST" style="display: inline-block;">
								<input type="hidden" name="id" value="<?php echo $category['category_id'] ?>">
								<button type="submit" class="button cart-btn">Show product</button>
							</form>
						</div>
					</div>
				</div>
			<?php endforeach; ?>


		</div>
	</div>

	<!-- end latest news -->
	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">New</span> Product</h3>
						<p></p>
					</div>
				</div>
			</div>

			<div class="row">
				<?php foreach ($products as $product) : ?>
					<div class="col-lg-4 col-md-6 text-center">
						<div class="single-product-item">
							<div class="product-image">
								<a href="single-product.html"><img src="images/<?php echo $product['url_image'] ?>" alt=""></a>
							</div>
							<h3><?php echo $product['product_name'] ?></h3>
							<form action="item.php" method="POST" style="display: inline-block;">
								<input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
								<button type="submit" class="button cart-btn"><i class="fas fa-shopping-cart"></i>Show item</button>
							</form>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<!-- end product section -->
<!-- cart banner section -->
<section class="cart-banner pt-100 pb-100">
	<div class="container">
		<div class="row clearfix">
			<!--Image Column-->
			<div class="image-column col-lg-6">
				<div class="image">
					<div class="price-box">
						<div class="inner-price">
							<span class="price">
								<strong>30%</strong> <br> for all order
							</span>
						</div>
					</div>
					<img src="images/18.png" alt="">
				</div>
			</div>
			<!--Content Column-->
			<?php
			$date = date('2022-6-2');
			$time = date('12:25:00');
			$date_today = $date . ' ' . $time;
			?>
			<script>
				var count_id = "<?php echo $date_today; ?>";
				var countDownDate = new Date(count_id).getTime();
				var x = setInterval(function() {
					var now = new Date().getTime();
					//find distance between now and countdown
					var distance = countDownDate - now;
					var days = Math.floor(distance / (1000 * 60 * 60 * 24));
					var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((distance % (1000 * 60)) / (1000));
					document.getElementById('demo').innerHTML = days;
					document.getElementById('demo1').innerHTML = hours;
					document.getElementById('demo2').innerHTML = minutes;
					document.getElementById('demo3').innerHTML = seconds;
					if (distance < 0) {
						clearInterval(x);
						document.getElementById('demo0').innerHTML = "EXPIRED";
					}
				}, 1000);
			</script>
			<!--Content Column-->
			<div class="content-column col-lg-6">
				<h3><span class="orange-text">Discount</span> </h3>
				<h4>Welcome back to school</h4>
				<h5 class="text">Discount through this cupoun <span style="color:#F28123">(Besnm96)</span> for :</h5>
				<!--Countdown Timer-->
				<div class="time-counter" id="demo0">
					<div class="time-countdown clearfix">
						<div class="counter-column">
							<div class="inner"><span class="count" id="demo"></span>Days</div>
						</div>
						<div class="counter-column">
							<div class="inner"><span class="count" id="demo1"></span>Hours</div>
						</div>
						<div class="counter-column">
							<div class="inner"><span class="count" id="demo2"></span>Mins</div>
						</div>
						<div class="counter-column">
							<div class="inner"><span class="count" id="demo3"></span>Secs</div>
						</div>
					</div>
				</div>
				<a href="cart.html" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> View product</a>
			</div>
		</div>
</section>
<!-- end cart banner section -->



<?php
$selectcomment = "SELECT text FROM feedback";
$selectcommentpre = $connection->prepare($selectcomment);
$selectcommentpre->execute();
$selectcommentfetch = $selectcommentpre->fetchAll();

?>
<!-- swiper -->
<div class="swiper mySwiper">
	<div class="row">
		<div class="col-lg-8 offset-lg-2 text-center">
			<div class="section-title">
				<h3><span class="orange-text">Users</span> feedback</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
			</div>
		</div>
	</div>
	<div class="swiper-wrapper" style="font-size:18px;">
		<?php foreach ($selectcommentfetch as $feedback) : ?>
			<div class="swiper-slide button cart-btn" style="border-radius:0px;display:flex;justify-content:center;align-items:center;overflow:hidden">
				<div><?php echo $feedback['text'] ?></div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="swiper-pagination"></div>
</div>
<!-- end swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
	var swiper = new Swiper(".mySwiper", {
		effect: "coverflow",
		grabCursor: true,
		centeredSlides: true,
		slidesPerView: "auto",
		coverflowEffect: {
			rotate: 100,
			stretch: 0,
			depth: 100,
			modifier: 1,
			slideShadows: true,
		},
		autoplay: {
			delay: 1000,
			disableOnInteraction: false,
		},
	});
</script>
<!-- logo carousel -->
<div class="logo-carousel-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="logo-carousel-inner">
					<div class="single-logo-item">
						<img src="assets/img/company-logos/1.png" alt="">
					</div>
					<div class="single-logo-item">
						<img src="assets/img/company-logos/2.png" alt="">
					</div>
					<div class="single-logo-item">
						<img src="assets/img/company-logos/3.png" alt="">
					</div>
					<div class="single-logo-item">
						<img src="assets/img/company-logos/4.png" alt="">
					</div>
					<div class="single-logo-item">
						<img src="assets/img/company-logos/5.png" alt="">
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
						<li><a href="index.php">Home</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="product.php">Shop</a></li>
						<li><a href="contact.php">Contact</a></li>
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