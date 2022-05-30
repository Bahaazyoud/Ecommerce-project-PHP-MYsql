<?php

try{
    $db = new PDO("mysql:host=localhost; dbname=library", "root" , '');
    }catch(PDOException $e){
        echo $db->errorCode();
    }


    $sql_user = 'SELECT * FROM user';
    $statement_user = $db->prepare($sql_user);
    if(!$statement_user->execute()){
        print_r($statement_user->errorInfo()); 
    }

    $user_data = $statement_user->fetchAll(pdo::FETCH_ASSOC);

    $sql_order = 'SELECT * FROM `orders`';
    $statement_order = $db->prepare($sql_order);
    if(!$statement_order->execute()){
        print_r($statement_order->errorInfo()); 
    }
    $order_data = $statement_order->fetchAll(pdo::FETCH_ASSOC);

    $sql_cart = 'SELECT * FROM `cart`';
    $statement_cart = $db->prepare($sql_cart);
    if(!$statement_cart->execute()){
        print_r($statement_cart->errorInfo()); 
    }
    $cart_data = $statement_cart->fetchAll(pdo::FETCH_ASSOC);

    $sql_category = 'SELECT * FROM `category`';
    $statement_category = $db->prepare($sql_category);
    if(!$statement_category->execute()){
        print_r($statement_category->errorInfo()); 
    }
    $category_data = $statement_category->fetchAll(pdo::FETCH_ASSOC);

    $sql_comment = 'SELECT * FROM `comment`';
    $statement_comment = $db->prepare($sql_comment);
    if(!$statement_comment->execute()){
        print_r($statement_comment->errorInfo()); 
    }
    $comment_data = $statement_comment->fetchAll(pdo::FETCH_ASSOC);

    $sql_product = 'SELECT * FROM `product`';
    $statement_product = $db->prepare($sql_product);
    if(!$statement_product->execute()){
        print_r($statement_product->errorInfo()); 
    }
    $product_data = $statement_product->fetchAll(pdo::FETCH_ASSOC);



?>