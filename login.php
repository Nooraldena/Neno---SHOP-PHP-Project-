<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:index.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Online-Store</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/login.css">
   <style>
   
   
      input{
         text-align: center;
      }
   </style>
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
<center>
<div class="form-container"  id="form-container">
   <form action="" method="post">
      <h1><img src="img_553409.png">NENO-SHOP</h1>
      <h3>sign in</h3>
      <input class="form-control" type="email" name="email" required placeholder="Email" class="box"><br>
      <input class="form-control" type="password" name="password" required placeholder="Password" class="box"><br><br><br>
      <input type="submit" name="submit" class="btn" value="sign in">
      <p>Do you already have an account? <a href="register.php">new account</a></p>
   </form>
</div>

</center>

</body>
</html>



<style>
   form input{
      cursor: pointer;
   }
   .btn{
      transition: 0.4s all;
      padding: 10px;
      border: 1px solid;
   }
</style>