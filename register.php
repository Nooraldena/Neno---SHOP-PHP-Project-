<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


      if(mysqli_num_rows($select) > 0){
         $message[] = '<center>user already exist!';
      }else{
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Online - Store</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/register.css">
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

<div class="form-container">
<h1><img src="img_553409.png">NENO-SHOP</h1>

   <form action="" method="post">
      <h3>Create a new account</h3>
      <input class="form-control" type="text" name="name" required placeholder="user name" class="box"><br>
      <input class="form-control" type="email" name="email" required placeholder="Email" class="box"><br>
      <input  class="form-control" type="password" name="password" required placeholder="password" class="box"><br>
      <input class="form-control" type="password" name="cpassword" required placeholder="password confirmation" class="box"><br>
      <input  type="submit" name="submit" class="btn" value="Sign UP">
      
      <p>do you have an account? <a href="login.php">Login</a></p>
   </form>
   </center>
</div>

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