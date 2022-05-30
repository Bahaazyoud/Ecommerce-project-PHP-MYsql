<?php 
include_once "connect.php";
session_start();
$_SESSION["id"] = "2147483647";
function user_name($id , $arr){
    foreach($arr as $value){
        if($value ["user_id"] == $id){
            return $value["name"];
        }
    }

    return -1;
}

$_SESSION["name"] = user_name($_SESSION["id"] , $user_data);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="assets/modules/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">

</head>
<body>
    <div id="app">
    <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>

                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $_SESSION["name"] ?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="features-profile.html" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <!-- <a href="features-activities.html" class="dropdown-item has-icon">
                                    <i class="fas fa-bolt"></i> Activities
                                </a> -->
                                <a href="features-settings.html" class="dropdown-item has-icon">
                                    <i class="fas fa-cog"></i> Settings
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="library-origin/logout" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2" tabindex="1" style="overflow: hidden; outline: none;">
            <aside id="sidebar-wrapper" style="height: 100vh;">
                    <div class="sidebar-brand">
                        <a href="index.php">Library</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.php">LB</a>
                    </div>
                    <ul class="sidebar-menu" style="height: 90vh;display: flex;flex-direction: column;justify-content: space-evenly;">
                    <li class="menu-header">Admin Dashboard</li>
                        <li class="active"><a href="index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                        <li><a href="user/user.php" class="nav-link"><i class="far fa-user"></i><span>Users</span></a></li>
                        <li><a href="order/order.php" class="nav-link"><i class="far fa-file-alt"></i><span>Orders</span></a></li>
                        <li><a href="category/category.php" class="nav-link"><i class="fas fa-bicycle"></i><span>Categories</span></a></li>
                        <li><a href="product/product.php" class="nav-link"><i class="fas fa-fire"></i><span>Products</span></a></li>
                        <li><a href="comment/comment.php" class="nav-link"><i class="fas fa-pencil-ruler"></i><span>Comments</span></a></li>

  
                        
                </aside>
            </div>
        <div class="main-wrapper main-wrapper-1">
            <div class="main-content" style="min-height: 668px;">
                <section class="section">
                <div class="section-header" style="margin-left:-32px;">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                <?php echo count($user_data); ?>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Comment</h4>
                            </div>
                            <div class="card-body">
                            <?php echo count($comment_data); ?>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Orders</h4>
                            </div>
                            <div class="card-body">
                            <?php echo count($order_data); ?>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                            </div>
                            <div class="card-wrap">
                            <div class="card-header">
                                <h4>Product</h4>
                            </div>
                            <div class="card-body">
                            <?php echo count($product_data); ?>
                                         </div>
                                     </div>
                                 </div>
                            </div>                  
                        </div>
                        <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h4>Orders</h4>
                  <div class="card-header-action">
                    <a href="product/product.php" class="btn btn-danger">View Products <i class="fas fa-chevron-right"></i></a>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tbody><tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>

                      <?php 
                      $count = 0;
                      foreach($order_data as $data){ 
                          
                          ?>
                      <tr>
                        <td><?php echo $data["order_id"];?></td>
                        <td class="font-weight-600"><?php 
                        echo user_name($data["user_id"] , $user_data); ?></td>
                        <td><?php echo $data["address"]; ?></td>
                        <td>
                          
                          <a href="order/edit_order.php?order_id=<?php echo $data['order_id'] ."&mode=details";?>" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                      <?php 
                    $count++;
                    if($count == 5){
                      break;
                    }
                    }?>
                    </tbody></table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-hero">
                <div class="card-header">
                  <div class="card-icon">
                    <i class="far fa-question-circle"></i>
                  </div>
                  <h4><?php echo count($comment_data); ?></h4>

                  <div class="card-description">Comments</div>
                </div>
                <div class="card-body p-0">
                  <div class="tickets-list">
                  <?php 
                      if(count($comment_data) != 0){
                        $reverse = array_reverse($comment_data, false);
                        $length = count($reverse);

                        for($i = 0; $i < $length && ($i < 3); $i++ ){ ?>
                            <a href="#" class="ticket-item">
                            <div class="ticket-title">
                                <h4><?php echo $reverse[$i]["text"];?></h4>
                            </div>
                      <div class="ticket-info">
                        <div><?php echo user_name($reverse[$i]["user_id"] , $user_data)?></div>
                        <div class="bullet"></div>
                      </div>
                    </a>
                    <?php }}else{}?>
                    <a href="comment/comment.php" class="ticket-item ticket-more">
                      View All <i class="fas fa-chevron-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
                    </div>
                </section>
     
            </div>
            <footer class="main-footer">
        <div class="footer-left">
          Copyright © 2022 <div class="bullet"></div> Design By <a href="https://www.linkedin.com/in/mohammed-amin-ababneh">Mohammed-Ameen Ababneh</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
        </div>
    </div>
    


</body>
</html>


<!--- General JS Scripts --->
<script src="assets/modules/jquery.min.js"></script>
<script src="assets/modules/popper.js"></script>
<script src="assets/modules/tooltip.js"></script>
<script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="assets/modules/moment.min.js"></script>
<script src="assets/js/stisla.js"></script>
<!--- JS Libraies --->
<script src="assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
<script src="assets/modules/chart.min.js"></script>
<script src="assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
<script src="assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="assets/modules/summernote/summernote-bs4.js"></script>
<script src="assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
<!-- Page Specific JS File -->
<script src="assets/js/page/index-0.js"></script>
<!-- Template JS File -->
<script src="assets/js/scripts.js"></script>




