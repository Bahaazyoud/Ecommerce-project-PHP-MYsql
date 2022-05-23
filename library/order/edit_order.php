<?php require_once "../connect.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>order</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php require_once "../assets/PHP_File/css.php"; ?>

</head>


<body>
<?php 
if($_GET["mode"] == "add"){
    
    $sql_user = 'SELECT * FROM user';
    $statement_user = $db->prepare($sql_user);
    if(!$statement_user->execute()){
        print_r($statement_user->errorInfo()); 
    }


?>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
    <?php include_once "../assets/PHP_File/Bars.php"?>
    <li class="menu-header">Admin user</li>
                    <li id="Dashboard" ><a href="../index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                        <li id="Users" class=""><a href="../user/user.php" class="nav-link"><i class="far fa-user"></i><span>Users</span></a></li>
                        <li id="Orders" class="active"><a href="../order/order.php" class="nav-link"><i class="far fa-file-alt" ></i><span>Orders</span></a></li>
                        <li><a href="../category/category.php" class="nav-link"><i class="fas fa-bicycle" id="Categories"></i><span>Categories</span></a></li>
                        <li><a href="../product/product.php" class="nav-link"><i class="fas fa-fire" id="Products"></i><span>Products</span></a></li>
                        <li><a href="../comment/comment.php" class="nav-link"><i class="fas fa-pencil-ruler" id="Comments"></i><span>Comments</span></a></li>
                </aside>
            </div>
        <div class="main-content" style="min-height: 524px;">
            <section class="section">
            <div class="section-header" style="margin-left:-32px;">
        <h1>Add Order</h1>
    </div>
<div class="container" style="width: 50%; margin-top:5%;" >
<form action="../insert.php?mode=add" method="post" style="margin: 20px 0;" enctype="multipart/form-data">
<label for="order-city">Order</label>
    <br> <br>
    <input type="text" class="form-control" id="order-city" placeholder="City" name="order-city" required value="">
    <br>
    <input type="text" class="form-control" id="order-price" placeholder="Price" name="order-price" required>
    <br>
    <input type="text" class="form-control" id="order_address" placeholder="Address" name="order_address" required>
    <br>
    <input type="date" class="form-control" id="order_date" name="order_date" required>
    <br>
    <div class="input-group">
        <select class="custom-select" id="inputGroupSelect04" name="order-user_id" required>
    <?php 
        echo "<option disabled selected value='' >User ID</option>";
    for($i = 0; $sql_user = $statement_user->fetch();$i++){
        echo '<option value="' .$sql_user["user_id"] .'">' .$sql_user["user_id"] .'</option>';}
    ?>
        </select>
    </div>



    <br>
    <div style="display:flex; justify-content:space-between">
    <div>
    <a href="../index.php" class="btn btn-primary">Back to Main Page</a>
    <a href="./order.php" class="btn btn-primary">Back</a>
    </div>
    <div>
    <button type="submit" class="btn btn-dark">Add</button>
    </div>
    </div>
</form>
</div>
<?php }else if($_GET["mode"] == "edit"){
    $sql_user = 'SELECT * FROM user';
    $statement_user = $db->prepare($sql_user);
    if(!$statement_user->execute()){
        print_r($statement_user->errorInfo()); 
    }


    $sql_order = 'SELECT * FROM `order`';
    $statement_order = $db->prepare($sql_order);
    if(!$statement_order->execute()){
        print_r($statement_order->errorInfo()); 
    }

    $data = $statement_order->fetchAll(pdo::FETCH_ASSOC);


?>
 <div id="app">
    <div class="main-wrapper main-wrapper-1">
    <?php include_once "../assets/PHP_File/Bars.php"?>
    <li class="menu-header">Admin user</li>
                    <li id="Dashboard" ><a href="../index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                        <li id="Users" class=""><a href="../user/user.php" class="nav-link"><i class="far fa-user"></i><span>Users</span></a></li>
                        <li id="Orders" class="active"><a href="../order/order.php" class="nav-link"><i class="far fa-file-alt" ></i><span>Orders</span></a></li>
                        <li><a href="../category/category.php" class="nav-link"><i class="fas fa-bicycle" id="Categories"></i><span>Categories</span></a></li>
                        <li><a href="../product/product.php" class="nav-link"><i class="fas fa-fire" id="Products"></i><span>Products</span></a></li>
                        <li><a href="../comment/comment.php" class="nav-link"><i class="fas fa-pencil-ruler" id="Comments"></i><span>Comments</span></a></li>
                </aside>
            </div>
        <div class="main-content" style="min-height: 524px;">
            <section class="section">
            <div class="section-header" style="margin-left:-32px;">
        <h1>Edit Order</h1>
    </div>
<div class="container" style="width: 50%; margin-top:5%;" >
<form action="../insert.php?mode=edit" method="post" style="margin: 20px 0;" enctype="multipart/form-data">
    <label for="order-city">City</label>
    <br>
    <input type="text" class="form-control" id="order-city" placeholder="City" name="order-city"  value="<?php echo $data[0]["city"] ?>">
    <br>
    <label for="order-city">Address</label>
    <br>
    <input type="text" class="form-control" id="order_address" placeholder="address" name="order-address" value="<?php echo $data[0]["address"] ?>">
    <br>
    <label for="order-city">Total Price</label>
    <br>
    <input type="text" class="form-control" id="order-price" placeholder="Price" name="order-price" value="<?php echo $data[0]["total_price"] ?>" >
    <br>
    <label for="order-city">Date of Order</label>
    <br>
    <input type="date" class="form-control" id="order_date" name="order-date" value="<?php echo $data[0]["date"] ?>">
    <br>
    <label for="order-city">User ID</label>
    <br>
    <input type="text" class="form-control" id="oreder-id" name="order-id" value="<?php echo $_GET["order_id"]?>" hidden>
    <div class="input-group">
        <select class="custom-select" id="inputGroupSelect04" name="order-user_id" hid>
    <?php 
        echo "<option disabled value='' >User_ID</option>";
    for($i = 0; $sql_user = $statement_user->fetch();$i++){
        echo '<option value="' .$sql_user["user_id"] .'">' .$sql_user["user_id"] .'</option>';}
    ?>
        </select>
    </div>



    <br>
    <div style="display:flex; justify-content:space-between">
    <div>
    <a href="../index.php" class="btn btn-primary">Back to Main Page</a>
    <a href="./order.php" class="btn btn-primary">Back</a>
    </div>
    <div>
    <button type="submit" class="btn btn-dark">Add</button>
    </div>
    </div>
</form>
</div>

<?php }else if($_GET["mode"] == "delete"){
        $sql = "DELETE FROM `order` WHERE `order`.`order_id` = :id";
        $statement = $db->prepare($sql);
        $statement->execute(array(
            ":id" => $_GET["order_id"],
        ));
        print_r($statement);
        // print_r($_GET);
        header("location: order.php");

        $db = null;
    ?>

<?php }else if($_GET["mode"] == "details"){
    ?>
 <div id="app">
    <div class="main-wrapper main-wrapper-1">
    <?php include_once "../assets/PHP_File/Bars.php"?>
    <li class="menu-header">Admin user</li>
                    <li id="Dashboard" ><a href="../index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                        <li id="Users" class=""><a href="../user/user.php" class="nav-link"><i class="far fa-user"></i><span>Users</span></a></li>
                        <li id="Orders" class="active"><a href="../order/order.php" class="nav-link"><i class="far fa-file-alt" ></i><span>Orders</span></a></li>
                        <li><a href="../category/category.php" class="nav-link"><i class="fas fa-bicycle" id="Categories"></i><span>Categories</span></a></li>
                        <li><a href="../product/product.php" class="nav-link"><i class="fas fa-fire" id="Products"></i><span>Products</span></a></li>
                        <li><a href="../comment/comment.php" class="nav-link"><i class="fas fa-pencil-ruler" id="Comments"></i><span>Comments</span></a></li>
                </aside>
            </div>
        <div class="main-content" style="min-height: 524px;">
            <section class="section">
            <div class="section-header" style="margin-left:-32px;">
        <h1>Order Details</h1>
    </div>


<?php 
    $sql_product = 'SELECT * FROM `product` WHERE order_id = :id';
    $statement_product = $db->prepare($sql_product);
    if(!$statement_product->execute(array(
        ":id" => $_GET["order_id"],
    ))){
        print_r($statement_product->errorInfo()); 
    }

    $data_product = $statement_product->fetchAll(pdo::FETCH_ASSOC);

    echo '<table class="table">
    <tr>
    <th scope="col">Product ID</th>
    <th scope="col">Name</th>
    <th scope="col">Category ID</th>
    <th scope="col">Price</th>
    <th scope="col">Image</th>
    <th scope="col">Order ID</th>
    <th scope="col">Cart ID</th>
    <th scope="col">Description</th>
    </tr>

    ';
    $sum = 0;
    if($data_product){
        foreach($data_product as $data){ ?>
          <tbody>
      <tr>
      <td><?php echo $data["product_id"]; ?></td>
      <td><?php echo $data["name"]; ?></td>
      <td><?php echo $data["category_id"]; ?></td>
      <td><?php echo $data["price"]; ?></td>
      <td><img src='../<?php echo $data["url_image"]; ?>'style="width: 100px;"></td>
      <td><?php echo $data["order_id"]; ?></td>
      <td><?php echo $data["cart_id"]; ?></td>
      <td><?php echo $data["description"]; ?></td>
      </tr>
      </tbody>
      <?php $sum += $data["price"]; ?>
   


        <?php }

    }else{
       ?>

       <td colspan="8">
                              <div class="col-12 col-md-12 col-sm-12">
                                <div class="card">
                                  <div class="card-body">
                                    <div class="empty-state" data-height="200" style="height: 200px;">
                                      <div class="empty-state-icon">
                                        <i class="fas fa-question"></i>
                                      </div>
                                      <h2>We couldn't find any data</h2>
                                    </div>
                                  </div>
                                </div>
                              </div>
        </td>
        </table>
       <?php
    }

}
    
    ?>
</section>
        </div>
    </div>
</div>
<?php include_once "../assets/PHP_File/footer.php"?>
</body>

<script>
    file = document.getElementById("order-url_img");
    img = document.getElementById("img-show");
    file.addEventListener("change" , function(){
    
        if(file.files.length == 0){
            img.src = "../<?php echo $data["url_image"]  ?>";
        }else{
  
            img.src = (window.URL || window.webkitURL).createObjectURL(file.files[0]);
        }
    })
</script>

<?php require_once "../assets/PHP_File/js.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


