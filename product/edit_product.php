<?php require_once "../connect.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php require_once "../assets/PHP_File/css.php"; ?>

</head>


<body>
<?php 
if($_GET["mode"] == "add"){
    
    $sql_category = 'SELECT * FROM category';
    $statement_category = $db->prepare($sql_category);
    if(!$statement_category->execute()){
        print_r($statement_category->errorInfo()); 
    }


    $sql_order = 'SELECT * FROM `orders`';
    $statement_order = $db->prepare($sql_order);
    if(!$statement_order->execute()){
        print_r($statement_order->errorInfo()); 
    }
   

    $sql_cart = 'SELECT * FROM `cart`';
    $statement_cart = $db->prepare($sql_cart);
    if(!$statement_cart->execute()){
        print_r($statement_cart->errorInfo()); 
    }

?>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
    <?php include_once "../assets/PHP_File/Bars.php"?>
    <li class="menu-header">Admin user</li>
                    <li id="Dashboard" ><a href="../index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                        <li id="Users"><a href="../user/user.php" class="nav-link"><i class="far fa-user"></i><span>Users</span></a></li>
                        <li id="Orders" class=""><a href="../order/order.php" class="nav-link"><i class="far fa-file-alt" ></i><span>Orders</span></a></li>
                        <li><a href="../category/category.php" class="nav-link"><i class="fas fa-bicycle" id="Categories"></i><span>Categories</span></a></li>
                        <li class="active"><a href="../product/product.php" class="nav-link"><i class="fas fa-fire" id="Products"></i><span>Products</span></a></li>
                        <li><a href="../comment/comment.php" class="nav-link"><i class="fas fa-pencil-ruler" id="Comments"></i><span>Comments</span></a></li>
                </aside>
            </div>
        <div class="main-content" style="min-height: 524px;">
            <section class="section">
            <div class="section-header" style="margin-left:-32px;">
        <h1>Add Product</h1>
    </div>
    <div class="container " style="width: 70%; margin-top:5%;" >
    <form action="../insert.php?mode=add" method="post" style="margin: 20px 0;" enctype="multipart/form-data">
    <label for="product-name">product</label>
    <input type="text" class="form-control" id="product-name" placeholder="Name" name="product-name" required>
    <br>
    <input type="text" class="form-control" id="product-price" placeholder="Price" name="product-price" required>
    <br>
    <div class="input-group">
        <select class="custom-select" id="inputGroupSelect04" name="product-category_data" required>
            <?php 
            echo "<option disabled selected value='' >Category</option>";
            for($i = 0; $category_data = $statement_category->fetch();$i++){
                echo '<option value="' .$category_data["category_id"] .'">' .$category_data["name"] .'</option>';}
            ?>
        </select>
    </div>
    <br>
    <input type="file" class="form-control" id="product-url_img" placeholder="" name="product-url_img" required>
    <br>
    <div class="input-group">
        <select class="custom-select" id="inputGroupSelect04" name="product-order_id">
    <?php 
        echo "<option disabled selected value='' >Order ID</option>";
    for($i = 0; $order_data = $statement_order->fetch();$i++){
        echo '<option value="' .$order_data["order_id"] .'">' .$order_data["order_id"] .'</option>';}
    ?>
        </select>
    </div>
    <br>
    <div class="input-group">
        <select class="custom-select" id="inputGroupSelect04" name="product-cart_id">
    <?php 
        echo "<option disabled selected value='' >Cart ID</option>";
    for($i = 0; $cart_data = $statement_cart->fetch();$i++){
        echo '<option value="' .$cart_data["cart_id"] .'">' .$cart_data["cart_id"] .'</option>';}
    ?>
        </select>
    </div>
    <br>
    <input type="text" class="form-control" id="product_description" placeholder="Description" name="product_description" required>
    <br>

    <br>
    <div style="display:flex; justify-content:space-between">
    <div>
    <a href="../index.php" class="btn btn-primary">Back to Main Page</a>
    <a href="./product.php" class="btn btn-primary">Back</a>
    </div>
    <div>
    <button type="submit" class="btn btn-dark">Add</button>
    </div>
    </div>
</form>
</div>
<?php }else if($_GET["mode"] == "edit"){
    $sql = "SELECT * FROM product WHERE product_id = :id";
    $statement = $db->prepare($sql);
    $statement->execute(array(
        ":id" => $_GET["product_id"] ,
    ));
    
    $data = $statement->fetch(pdo::FETCH_ASSOC);

    $sql_category = 'SELECT * FROM category';
    $statement_category = $db->prepare($sql_category);
    if(!$statement_category->execute()){
        print_r($statement_category->errorInfo()); 
    }


    $sql_order = 'SELECT * FROM `orders`';
    $statement_order = $db->prepare($sql_order);
    if(!$statement_order->execute()){
        print_r($statement_order->errorInfo()); 
    }
   

    $sql_cart = 'SELECT * FROM `cart`';
    $statement_cart = $db->prepare($sql_cart);
    if(!$statement_cart->execute()){
        print_r($statement_cart->errorInfo()); 
    }


    $db = null;

    ?>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
    <?php include_once "../assets/PHP_File/Bars.php"?>
    <li class="menu-header">Admin user</li>
                    <li id="Dashboard" ><a href="../index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                        <li id="Users"><a href="../user/user.php" class="nav-link"><i class="far fa-user"></i><span>Users</span></a></li>
                        <li id="Orders" class=""><a href="../order/order.php" class="nav-link"><i class="far fa-file-alt" ></i><span>Orders</span></a></li>
                        <li><a href="../category/category.php" class="nav-link"><i class="fas fa-bicycle" id="Categories"></i><span>Categories</span></a></li>
                        <li class="active"><a href="../product/product.php" class="nav-link"><i class="fas fa-fire" id="Products"></i><span>Products</span></a></li>
                        <li><a href="../comment/comment.php" class="nav-link"><i class="fas fa-pencil-ruler" id="Comments"></i><span>Comments</span></a></li>
                </aside>
            </div>
        <div class="main-content" style="min-height: 524px;">
            <section class="section">
            <div class="section-header" style="margin-left:-32px;">
        <h1>Edit Product</h1>
    </div>
    <div class="container " style="width: 70%; margin-top:5%;" >
        <form action="../insert.php?mode=edit" method="post" style="margin: 20px 0;" enctype="multipart/form-data">
            <img src="../<?php echo $data["url_image"] ?>" style="width: 300px; margin-bottom; 5px;" id="img-show">
            <br><br>
            <label for="product-name">Name</label>
            <input type="text" class="form-control" id="product-name" placeholder="Name" name="product-name" value="<?php echo $data["product_name"]?>">
            <br>
            <label for="product-price">Price</label>
            <br>
            <input type="text" class="form-control" id="product-price" placeholder="Price" name="product-price" value="<?php echo $data["price"]?>">
            <br>
            <label for="product-order_id">Category</label>
            <div class="input-group">

                <select class="custom-select" id="inputGroupSelect04" name="product-category_data">
            <?php 

                echo "<option disabled value='' >Category</option>";
            for($i = 0; $category_data = $statement_category->fetch();$i++){
                echo '<option value="' .$category_data["category_id"] .'">' .$category_data["name"] .'</option>';}
            ?>
                </select>
            </div>
            <br>
            <input type="file" class="form-control" id="product-url_img" placeholder="" name="product-url_img">
            <br>
            <input hidden type="input" name="product_id" value="<?php echo $data["product_id"]?>">
            <br>
            <label for="product-order_id">Order ID</label>
            <div class="input-group">
                <select class="custom-select" id="inputGroupSelect04" name="product-order_id">
                    
            <?php 
               echo "<option disabled value='' >Order ID</option>";
            for($i = 0; $order_data = $statement_order->fetch();$i++){
                echo '<option value="' .$order_data["order_id"] .'">' .$order_data["order_id"] .'</option>';}
            ?>
                </select>
            </div>
            <br>
            <label for="product-order_id">Cart ID</label>
            <div class="input-group">
                <select class="custom-select" id="inputGroupSelect04" name="product-cart_id">
            <?php 
               echo "<option disabled value='' >Cart ID</option>";
            for($i = 0; $cart_data = $statement_cart->fetch();$i++){
                echo '<option value="' .$cart_data["cart_id"] .'">' .$cart_data["cart_id"] .'</option>';}
            ?>
                </select>
            </div>
            <br>
            <label for="product_description">Description</label>
            <input type="text" class="form-control" id="product_description" placeholder="description" name="product_description" value="<?php echo $data["descreption"]?>">
            <br>

            <br>
            <div style="display:flex; justify-content:space-between">
            <div>
            <a href="../index.php" class="btn btn-primary">Back to Main Page</a>
            <a href="./product.php" class="btn btn-primary">Back</a>
            </div>
            <div>
            <button type="submit" class="btn btn-dark">Add</button>
            </div>
            </div>
</form>
</div>

<?php }else if($_GET["mode"] == "delete"){
        $sql = "DELETE FROM product WHERE product_id = :id";
        $statement = $db->prepare($sql);
        $statement->execute(array(
            ":id" => $_GET["product_id"] ,
        ));
        
        header("location: product.php");

        $db = null;
    ?>

<?php }
    
    ?>
        </section>
        </div>
    </div>
</div>
    <?php include_once "../assets/PHP_File/footer.php"?>
</body>

<script>
    file = document.getElementById("product-url_img");
    img = document.getElementById("img-show");
    file.addEventListener("change" , function(){
    
        if(file.files.length == 0){
            img.src = "../<?php echo $data["url_image"]  ?>";
        }else{
  
            img.src = (window.URL || window.webkitURL).createObjectURL(file.files[0]);
        }
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<?php require_once "../assets/PHP_File/js.php"; ?>

