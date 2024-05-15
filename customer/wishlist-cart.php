<?php
    $bid = $_GET['bid']; 

if(isset($_POST['add_to_wishlist'])){

   if($uid == ''){
      header('location:login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $pname = $_POST['pname'];
      $pname = filter_var($pname, FILTER_SANITIZE_STRING);
      $sellPrice = $_POST['sellPrice'];
      $sellPrice = filter_var($sellPrice, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);

      $check_wishlist_numbers = $db->prepare("SELECT * FROM `wish_list` WHERE pname = ? AND uid = ?");
      $check_wishlist_numbers->execute([$name, $uid]);

      $check_cart_numbers = $db->prepare("SELECT * FROM `cart` WHERE pname = ? AND uid = ?");
      $check_cart_numbers->execute([$pname, $uid]);

      if($check_wishlist_numbers->rowCount() > 0){
         $message[] = 'already added to wishlist!';
      }elseif($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{
         $insert_wishlist = $db->prepare("INSERT INTO `wish_list`(uid, pid, pname, sellPrice, image) VALUES(?,?,?,?,?)");
         $insert_wishlist->execute([$uid, $pid, $pname, $sellPrice, $image]);
         $message[] = 'added to wishlist!';
      }

   }

}

if(isset($_POST['add_to_cart'])){

   if($user_id == ''){
      header('location:login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $pname = $_POST['pname'];
      $pname = filter_var($pname, FILTER_SANITIZE_STRING);
      $sellPrice = $_POST['sellPrice'];
      $sellPrice = filter_var($sellPrice, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $quantity = $_POST['quantity'];
      $quantity = filter_var($quantity, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $db->prepare("SELECT * FROM `cart` WHERE pname = ? AND uid = ?");
      $check_cart_numbers->execute([$pname, $uid]);

      if($check_cart_numbers->rowCount() > 0){
         $message[] = 'already added to cart!';
      }else{

         $check_wishlist_numbers = $db->prepare("SELECT * FROM `wish_list` WHERE pname = ? AND uid = ?");
         $check_wishlist_numbers->execute([$pname, $uid]);

         if($check_wishlist_numbers->rowCount() > 0){
            $delete_wishlist = $db->prepare("DELETE FROM `wish_list` WHERE pname = ? AND uid = ?");
            $delete_wishlist->execute([$pname, $uid]);
         }

         $insert_cart = $db->prepare("INSERT INTO `cart`(uid, pid, pname, sellPrice, quantity, image) VALUES(?,?,?,?,?,?)");
         $insert_cart->execute([$uid, $pid, $pname, $sellPrice, $quantity, $image]);
         $message[] = 'added to cart!';
         
      }

   }

}

?>