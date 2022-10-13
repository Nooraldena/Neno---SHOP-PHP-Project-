


<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password of Admin</title>
</head>
<body>
<style>
    form{
        margin-top: 10%;
    }
    .form-control{
        width:400px ;
    }
   .label{
    text-align: left;
   }
   form input{
    margin: 30px;
   }
   
    
</style>
<center>
<form  method="POST">
<h2>Admin Page</h2>
<br>
  <div class="form-group">
    <input type="email" name="ee" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <input type="password" name="pp" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button style="width:200px ;" type="submit" class="btn btn-primary" name="check">Submit</button>
</form>
</center>

<?php 


include 'config.php';



if(isset($_POST['check'])){
    $email = $_POST['ee'];
    $pass = $_POST['pp'];
    $ee = "nooralden.12.n@gmail.com";
    $pp = "Khalaile0";

    if($email == $ee && $pass == $pp){
        header('location:admin.php');  

    }
 }



?>
    

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>