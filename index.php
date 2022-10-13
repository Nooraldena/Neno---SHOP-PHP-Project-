<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

/// هذه مسئوله على اضافه الى داتا 
/// طبع رساله للمستخدم
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'The product has already been added to the cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'The product is added to the shopping cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'Your cart quantity has been successfully updated!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neno Shop | customer</title>
</head>
<body>

<div class="scroll-up-btn" href='home'>
   <i class="fas fa-angle-up"></i>
 </div>

 <div class="scroll-home">
   <img src="images/RHome.png" alt="">
 </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
        <a class="navbar-brand" href="#">Neno <content>Shop</content></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="text"><span class="typing-2"></span></div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" id="home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
            <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to log out?');" class="nav-link">Sign out</a>
            </li>
            <div class="profileAndplusIcon">
                <li class="nav-item">
                    <button id="icon"><a class='nav-link' href='#tabllle'><img class='img-iconshop' src='images/icono_carrito.png' alt='' srcset=''></a></button></li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php
      $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
      
    ?>
    
             <?php  echo 'hello,'. ' '. $fetch_user['name'];?> <img class="img-iconshop" id="icon" src="images/R.png" alt="" srcset="">
             <?php  echo 'hello,'. ' '. $fetch_user['id'];?> <img class="img-iconshop" id="icon" src="images/R.png" alt="" srcset="">

            </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Setting</a>
                    <a class="dropdown-item" href="#"></a>
                    <div class="dropdown-divider"></div>
                    <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to log out?');" class="dropdown-item">Sign out</a>
                  </div>
                </li>
            </div>
          
          </ul>
          <form method="POST" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
            <button id="addbutton" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
<main>


      <?php


if(isset($_POST['homesProuduct'])){
   include('config.php');
   $Homebtndata = "Home";
   $resultdataHomebtn = mysqli_query($conn,"SELECT * FROM products  WHERE name LIKE '%$Homebtndata%'");
   while($datahome = mysqli_fetch_array($resultDataHome)){
      ?>
      <div class="card" style="width:18rem;" id="cart">
<form style="color:black;" method="post" class="box" action="">
   <img src="admin/<?php echo $datahome['image']; ?>">
   <div class="name" style="color:black;" style="color:white;"><?php echo $datahome['name']; ?></div>
   <div class="price"><?php echo $datahome['price']; ?></div>
   <input type="number"  min="1" name="product_quantity" value="1">
   <input type="hidden" name="product_image" value="<?php echo $datahome['image']; ?>">
   <input type="hidden" name="product_name" value="<?php echo $datahome['name']; ?>">
   <input type="hidden" name="product_price" value="<?php echo $datahome['price']; ?>">
   <input type="submit" id="addbtn" value="add to cart" name="add_to_cart" class="btn">
</form>
</div>


<?php

};
   }


error_reporting(0);
include('config.php');

$word = $_POST['search'];

$result = mysqli_query($conn,"SELECT * FROM products  WHERE name LIKE '%$word%'");    
while($row = mysqli_fetch_array($result)){
   
?>

   <div class="prouducts-all">
   <div class="card" id="cart" style="width: 15rem;">
<form style="color:black;" method="post" class="box" action="">
   <img src="admin/<?php echo $row['image']; ?>">
   <div class="name"><?php echo $row['name']; ?></div>
   <div class="price"><?php echo $row['price']; ?></div>
   <input type="number"  min="1" name="product_quantity" value="1">
   <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
   <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
   <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
   <br><input type="submit" value="add to cart" name="add_to_cart" class="btn">
</form>
</div>
   </div>


<?php

};

?>

</div>

</div>



<table id="tabllle">
<thead>
   <th>Image</th>
   <th>Name</th>
   <th>Price</th>
   <th>Count</th>
   <th>amount</th>
   <th>the work</th>
</thead>
<tbody>
<?php
   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   $grand_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($fetch_cart = mysqli_fetch_assoc($cart_query)){
         
?>
   <tr>
      <td><img src="admin/<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
      <td><?php echo $fetch_cart['name']; ?></td>
      <td><?php echo $fetch_cart['price']; ?>$ </td>
      <td>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
            <input type="submit" name="update_cart" value="Update" class="option-btn">
         </form>
      </td>
      <td><?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?>$</td>
      <td><a href="index.php?remove=<?php echo $fetch_cart['id'] ?>" class="delete-btn" onclick="return confirm('remove the prouduct?');">Delete</a></td>
   </tr>
<?php
   $grand_total += $sub_total;
      }
   }else{
      echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">Empty</td></tr>';
   }
?>
<tr class="table-bottom">
   <td colspan="4">Total amount:</td>
   <td><?php echo $grand_total; ?>$</td>
   <td><a  id="delete-all" href="index.php?delete_all" onclick="return confirm('Delete all products from the cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Delete All</a></td>
</tr>
</tbody>
</table>



</div>

</div>

</body>
</html>


</head>
<script src="index.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>