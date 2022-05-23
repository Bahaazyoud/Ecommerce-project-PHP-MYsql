<?php
include_once 'connect.php';
session_start();

//***********Create New Category***********//


if(isset($_POST["category-name"])){

    if(!isset($_POST["category_id"])){
    try{
        $image = $_FILES["category-url_img"] ?? null;
        if($image){
            $url = 'images/'.$image['name'];
            $location = 'library-origin/images/' .$image['name'];
            $_POST["category-url_img"] = $url;
            move_uploaded_file($image['tmp_name'] , $location);
        }

        $sql = 'INSERT INTO `category` (`category_id` , `name` , `url_image` ,  `description`) VALUES (null, :name , :url , :description)';
        $statement = $db->prepare($sql);
        if(!$statement->execute(array(
            ":name" => $_POST["category-name"],
            ":url" => $_POST["category-url_img"],
            ":description" => $_POST["category-description"],
        ))){
            print_r($statement->errorInfo()); 
        }
        $db = null;
        header("location: category/category.php");


    }catch(EXCEPTION $e){
        throw $e;
    }
    }else{
        try{
          //***********Edit Category***********//

            $image = $_FILES["category-url_img"] ?? null;
            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";
            if($image["tmp_name"]){
                $location = './img/' .$image['name'];
                move_uploaded_file($image['tmp_name'] , $location);
                $url = $location;
            }else{
                $sql = "SELECT url_image FROM `category` WHERE category_id = :id";
                $statement_category = $db->prepare($sql);
                $statement_category->execute(array(
                    ":id" => $_POST["category_id"],
                ));
                $img = $statement_category->fetchAll();
                $url = $img[0]["url_image"];
            }
         

            

            $sql = "UPDATE `category` SET `name` = :name, `url_image` = :url, `description` = :description WHERE `category`.`category_id` = :id";
            $statement = $db->prepare($sql);
            if(!$statement->execute(array(
                ":id" => $_POST["category_id"],
                ":name" => $_POST["category-name"],
                ":url" => $url,
                ":description" => $_POST["category-description"],
            ))){
                print_r($statement->errorInfo()); 
            }
            header("location: category/category.php");
            $db = null;
        }catch(EXCEPTION $e){
            throw $e;
        }
    }
}else if(isset($_POST["user-name"])){
    //***********Create new User***********//
    if(!isset($_POST["user_id"])){
        try{
            $image = $_FILES["user-url_img"] ?? null;
            if($image){
                $location = './img/' .$image['name'];
                $_POST["user-url_img"] = $location;
                move_uploaded_file($image['tmp_name'] , $location);
            }

            $sql = "INSERT INTO `user` (`user_id`, `name`, `password`, `url_image`, `role`, `email`) VALUES (UUID_SHORT(), :name, :password, :url, :role, :email)";
            $statement = $db->prepare($sql);
            if(!$statement->execute(array(
                ":name" => $_POST["user-name"],
                ":password" => $_POST["user-password"],
                ":url" => $_POST["user-url_img"],
                ":role" => $_POST["user-role"],
                ":email" => $_POST["user-email"],
            ))){
                print_r($statement->errorInfo()); 
            }
            $db = null;
            header("location: user/user.php");
    
    
        }catch(EXCEPTION $e){
            throw $e;
        }
        }else{
            try{
              //***********Edit New User***********//
    
              $image = $_FILES["user-url_img"] ?? null;
              echo "<pre>";
              print_r($_FILES);
              echo "</pre>";
              if($image["tmp_name"]){
                  $location = './img/' .$image['name'];
                  move_uploaded_file($image['tmp_name'] , $location);
                  $url = $location;
              }else{
                  $sql = "SELECT url_image FROM `user` WHERE user_id = :id";
                  $statement_user = $db->prepare($sql);
                  $statement_user->execute(array(
                      ":id" => $_POST["user_id"],
                  ));
                  $img = $statement_user->fetchAll();
                  $url = $img[0]["url_image"];
              }

              
    
    
                $sql = "UPDATE `user` SET `name` = :name, `gender` = :gender, `url_image` = :url, `role` = :role, `email` = :email
                WHERE `user`.`user_id` = :id";
                $statement = $db->prepare($sql);
                if(!$statement->execute(array(
                    ":name" => $_POST["user-name"],
                    ":gender" => $_POST["user-gender"],
                    ":url" => $url,
                    ":role" => $_POST["user-role"],
                    ":email" => $_POST["user-email"],
                    ":id" => $_POST["user_id"],
                ))){
                    print_r($statement->errorInfo()); 
                }
                header("location: user/user.php");
                $db = null;
            }catch(EXCEPTION $e){
                throw $e;
            }
        } 
}else if(isset($_POST["comment-user-id"])){
  //***********Create New Comment***********//
  if($_SESSION["mode"] == "add"){
    try{

        $sql = "INSERT INTO `comment` (`comment_id`, `user_id`, `product_id`, `text`, `date`) VALUES (null, :userID, :productID, :text, :date)";
        $statement = $db->prepare($sql);
        if(!$statement->execute(array(
            
            ":userID" => $_POST["comment-user-id"],
            ":productID" => $_POST["comment-product-id"],
            ":text" => $_POST["comment-text"],
            ":date" => date_default_timezone_set('America/Los_Angeles'),
        ))){
            print_r($statement->errorInfo()); 
        }
        $db = null;
        header("location: comment/comment.php");


    }catch(EXCEPTION $e){
        throw $e;
    }
    }else{
        try{
          //***********Edit New Comment***********//

            $sql = "UPDATE `comment` SET `user_id` = :user_id, `product_id` = :product_id, `text` = :text
            WHERE `comment`.`comment_id` = :id";
            $statement = $db->prepare($sql);
            if(!$statement->execute(array(
                ":user_id" => $_POST["comment-user-id"],
                ":product_id" => $_POST["comment-product-id"],
                ":text" => $_POST["comment-text"],
                ":id" => $_POST["comment-id"],
            ))){
                print_r($statement->errorInfo()); 
            }
            header("location: comment/comment.php");
            $db = null;
        }catch(EXCEPTION $e){
            throw $e;
        }
    } 
}else if(isset($_POST["product-name"])){
              //***********Create New Product***********//
    if($_GET["mode"] == "add"){
        try{
            $image = $_FILES["product-url_img"] ?? null;
            if($image){
                $location = './img/' .$image['name'];
                $_POST["product-url_img"] = $location;
                move_uploaded_file($image['tmp_name'] , $location);
            }
    
            $sql = "INSERT INTO `product` (`product_id`, `name`, `category_id`, `price`, `url_image`, `order_id`, `cart_id`, `description`) 
            VALUES (NULL, :name, :category, :price, :url_image, :order, :cart, :description_product)";
            $statement = $db->prepare($sql);

            if(!$statement->execute(array(
                ":name" => $_POST["product-name"],
                ":category" =>$_POST["product-category_data"],
                ":price" => $_POST["product-price"],
                ":url_image" => $_POST["product-url_img"],
                ":order" => $_POST["product-order_id"],
                ":cart" => $_POST["product-cart_id"],
                ":description_product" => $_POST["product_description"]
            ))){
                print_r($statement->errorInfo()); 
            }
            $db = null;
            header("location: product/product.php");
    
    
        }catch(EXCEPTION $e){
            throw $e;
        }
}else{
    try{
         //***********Edit Product***********//
         $image = $_FILES["product-url_img"] ?? null;
         echo "<pre>";
         print_r($_FILES);
         echo "</pre>";
         if($image["tmp_name"]){
             $location = './img/' .$image['name'];
             move_uploaded_file($image['tmp_name'] , $location);
             $url = $location;
         }else{
             $sql = "SELECT url_image FROM `product` WHERE product_id = :id";
             $statement_product = $db->prepare($sql);
             $statement_product->execute(array(
                 ":id" => $_POST["product_id"],
             ));
             $img = $statement_product->fetchAll();
             $url = $img[0]["url_image"];
         }


        $sql = "UPDATE `product` SET `name` = :name, `category_id` = :category, `price` = :price, `url_image` = :url_image, `order_id` = :order , `cart_id` = :cart , `description` = :description_product
        WHERE `product`.`product_id` = :productID";

        $statement = $db->prepare($sql);

        if(!$statement->execute(array(
            ":name" => $_POST["product-name"],
            ":category" =>$_POST["product-category_data"],
            ":price" => $_POST["product-price"],
            ":url_image" => $url,
            ":order" => $_POST["product-order_id"],
            ":cart" => $_POST["product-cart_id"],
            ":description_product" => $_POST["product_description"],
            ":productID" => $_POST["product_id"]

        ))){
            print_r($statement->errorInfo()); 
        }
        $db = null;
        header("location: product/product.php");


    }catch(EXCEPTION $e){
        throw $e;
    }
}
}else if(isset($_POST["order-city"])){
    if($_GET["mode"] == "add"){
        try{
              //***********Create New order***********//

    
            $sql = "INSERT INTO `order` (`order_id`, `user_id`, `total_price`, `city`, `address`, `date`) 
            VALUES (NULL, :user_id, :total_price, :city, :address, :date)";
            $statement = $db->prepare($sql);

            if(!$statement->execute(array(
                ":user_id" => $_POST["order-user_id"],
                ":total_price" =>$_POST["order-price"],
                ":city" => $_POST["order-city"],
                ":address" => $_POST["order_address"],
                ":date" => $_POST["order_date"],
            ))){
                print_r($statement->errorInfo()); 
            }
            $db = null;
            header("location: order/order.php");
    
    
        }catch(EXCEPTION $e){
            throw $e;
        }
    }else if($_GET["mode"] == "edit"){
          try{
            //***********Edit Order***********//
   
           $sql = "UPDATE `order` SET `user_id` = :user_id, `total_price` = :total_price, `city` = :city, `address` = :address_order , `date` = :date_order
           WHERE `order`.`order_id` = :orderID";
                       print_r($_POST);

           $statement = $db->prepare($sql);

           if(!$statement->execute(array(
               ":user_id" => $_POST["order-user_id"],
               ":total_price" =>$_POST["order-price"],
               ":city" => $_POST["order-city"],
               ":address_order" => $_POST["order-address"],
               ":date_order" => $_POST["order-date"],
               ":orderID" => $_POST["order-id"],
   
           ))){
               print_r($statement->errorInfo()); 
           }
           $db = null;
           header("location: order/order.php");
   
   
       }catch(EXCEPTION $e){
           throw $e;
       }
    }
}
?>