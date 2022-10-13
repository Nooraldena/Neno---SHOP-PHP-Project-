<?php 

include './config.php';
$word = $_POST['search'];
$query = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%$word%'") or die('query failed');

while($rows = mysqli_fetch_assoc($query)){
    echo '<br /> id : '.$rows['id'];
    echo '<br /> name : '.$rows['name'];
    echo '<br /> price : '.$rows['price'];
    echo '<br /> image : '.$rows['image'];


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <form method="POST" class="form-inline">
    <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
  </form>
</nav>
</body>
</html>