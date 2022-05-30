<?php require_once "../connect.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <?php require_once "../assets/PHP_File/css.php"; ?>

</head>


<body>





<?php 
if($_GET["mode"] == "add"){?>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
    <?php include_once "../assets/PHP_File/Bars.php"?>
    <li class="menu-header">Admin user</li>
                    <li id="Dashboard" ><a href="../index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                        <li id="Users" class="active"><a href="../user/user.php" class="nav-link"><i class="far fa-user"></i><span>Users</span></a></li>
                        <li id="Orders"><a href="../order/order.php" class="nav-link"><i class="far fa-file-alt" ></i><span>Orders</span></a></li>
                        <li><a href="../category/category.php" class="nav-link"><i class="fas fa-bicycle" id="Categories"></i><span>Categories</span></a></li>
                        <li><a href="../product/product.php" class="nav-link"><i class="fas fa-fire" id="Products"></i><span>Products</span></a></li>
                        <li><a href="../comment/comment.php" class="nav-link"><i class="fas fa-pencil-ruler" id="Comments"></i><span>Comments</span></a></li>
                </aside>
            </div>
        <div class="main-content" style="min-height: 524px;">
            <section class="section">
            <div class="section-header" style="margin-left:-32px;">
        <h1>Add User</h1>
    </div>

<div class="container " style="width: 70%; margin-top:5%;" >
<form action="../insert.php" method="post" style="margin: 20px 0;" enctype="multipart/form-data">
<label for="user-name">User</label>
    <input type="text" class="form-control" id="user-name" placeholder="Name" name="user-name" required>
    <br>
    <input type="file" class="form-control" id="user-url_img" placeholder="" name="user-url_img" required>
    <br>
    <input type="password" class="form-control" id="user-password"  placeholder="password" name="user-password" required>
    <br>
    <br>
    <input type="date" class="form-control" id="user-birthday"  placeholder="Birthday" name="user-birthday" required>
    <br>
    <div class="input-group">
            <select class="form-control" id="inputGroupSelect04" name="user-role">
            <option value="user" selected>User</option>
            <option value="admin">Admin</option>
            </select>
            </div>
    <br>
    <input type="email" class="form-control" id="user-email"  placeholder="Email" name="user-email" required>
    <br>
    <br>
    <div style="display:flex; justify-content:space-between">
    <div>
    <a href="../index.php" class="btn btn-primary">Back to Main Page</a>
    <a href="./user.php" class="btn btn-primary">Back</a>
    </div>
    <div>
    <button type="submit" class="btn btn-dark">Add</button>
    </div>
    </div>
</form>
</div>

<?php }else if($_GET["mode"] == "edit"){
    $sql = "SELECT * FROM user WHERE user_id = :id";
    $statement = $db->prepare($sql);
    $statement->execute(array(
        ":id" => $_GET["user_id"] ,
    ));
    
    $data = $statement->fetch(pdo::FETCH_ASSOC);

    $db = null;

    ?>
    <div id="app">
    <div class="main-wrapper main-wrapper-1">
    <?php include_once "../assets/PHP_File/Bars.php"?>
    <li class="menu-header">Admin user</li>
                    <li id="Dashboard" ><a href="../index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
                        <li id="Users" class="active"><a href="../user/user.php" class="nav-link"><i class="far fa-user"></i><span>Users</span></a></li>
                        <li id="Orders"><a href="../order/order.php" class="nav-link"><i class="far fa-file-alt" ></i><span>Orders</span></a></li>
                        <li><a href="../category/category.php" class="nav-link"><i class="fas fa-bicycle" id="Categories"></i><span>Categories</span></a></li>
                        <li><a href="../product/product.php" class="nav-link"><i class="fas fa-fire" id="Products"></i><span>Products</span></a></li>
                        <li><a href="../comment/comment.php" class="nav-link"><i class="fas fa-pencil-ruler" id="Comments"></i><span>Comments</span></a></li>
                </aside>
            </div>
        <div class="main-content" style="min-height: 524px;">
            <section class="section">
            <div class="section-header" style="margin-left:-32px;">
        <h1>Edit User</h1>
    </div>
    <div class="container " style="width: 70%; margin-top:5%;" >
        <form action="../insert.php" method="post" style="margin: 20px 0;" enctype="multipart/form-data">
            <label for="user-name">User</label>
            <input type="text" class="form-control" id="user-name" name="user-name" required value="<?php echo $data["name"] ?>">
            <br>
            <img src="library-origin/images/<?php echo $data["url_image"] ?>" style="width: 300px; margin-bottom; 5px;" id="img-show">
            <br> <br>
            <input type="file" class="form-control" id="user-url_img" placeholder="" name="user-url_img">
            <br><br>
            <br>
            
            <div class="input-group">
            <select class="custom-select" id="inputGroupSelect04" name="user-role">
            <option value="user" selected>User</option>
            <option value="admin">Admin</option>
            </select>
            </div>
            <br>
            <input type="text" class="form-control" id="user-email"  name="user-email" required value="<?php echo $data["email"]?>">
            <br>
            <input type="text" hidden value="<?php echo $_GET["user_id"] ?>" name="user_id" >
            <div style="display:flex; justify-content:space-between">
            <div>
    <a href="./index.php" class="btn btn-primary">Back to Main Page</a>
    <a href="./user.php" class="btn btn-primary">Back</a>
    </div>
    <div>
    <button type="submit" class="btn btn-dark">submit</button>
    </div>
    </div>
</form>
</div>

<?php }else if($_GET["mode"] == "delete"){
        $sql = "DELETE FROM user WHERE user_id = :id";
        $statement = $db->prepare($sql);
        $statement->execute(array(
            ":id" => $_GET["user_id"] ,
        ));

        print_r($statement->execute(array(
            ":id" => $_GET["user_id"] ,
        ))); 
        
        header("location: user.php");

        $db = null;
    ?>

<?php }
    
    ?>      </section>
        </div>
    </div>
</div>

<?php include_once "../assets/PHP_File/footer.php"?>
</body>

<script>
    file = document.getElementById("user-url_img");
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





