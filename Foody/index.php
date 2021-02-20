<style type="text/css">
  body {
    background: #dd5e89;
    background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
    background: linear-gradient(to left, #dd5e89, #f7bb97);
    min-height: 100vh;
    font-family: helcativa;
  }
</style>
<style>
  .zoom {

    transition: transform .1s; 
    margin: 0 auto;
  }

  .zoom:hover {
    transform: scale(4.0); 
  }
</style>
<?php 
require 'functions.php';
$foody = query("SELECT * FROM food order by name");

if(isset($_POST["cari"])){
  $foody = search($_POST["keyword"]);
}

if(isset($_POST["byName"])){
  $foody = query("SELECT * FROM food order by name");
}elseif (isset($_POST["byDes"])) {
  $foody = query("SELECT * FROM food order by description");
}elseif (isset($_POST["byDif"])) {
  $foody = query("SELECT * FROM food order by difficulty");
}elseif (isset($_POST["byTime"])) {
  $foody = query("SELECT * FROM food order by time");
}
?>

<!doctype html>
<html lang="en">
<head>
  <title>My Food List</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
</head>
<body>

 <section class="pb-5 header text-center">
  <div class="container py-5">
    <header class="py-5" style="color: #FFFFFF;" >
      <br>
      <h1 class="display-4" style="font-family: geosanslight;">My Food List</h1><br>
      <p style="font-size: 20px; font-family: helcativa;">(I can make all of foods in this website and of course I've cooked it)</p>
      <br><br>
      <p style="font-size: 22px; font-style: italic; font-family: helcativa;">"Cooking is all about people. Food is maybe the only universal thing that really has the power to bring everyone together. No matter what culture, everywhere around the world, people eat together."</p>
      <p style="font-size: 22px; font-style: bold; "> - Guy Fieri</p>
    </header>
    <br>
    <form class="form-inline" action="" method="post">
      <div class="form-group">
        <input type="text" name="keyword" placeholder="Enter text" autocomplete="off" class="form-control">
      </div>
      <button type="submit" class="btn btn-default" name="cari">Search</button>
    </form>

    <div class="pb-5 header text-right">
     <a href="insert.php" class="btn btn-default">add new food</a>
   </div>
   <br>
   <table style="background-color:#FFFFFF;" class="table table-hover">

    <tr>
      <th>#</th>
      <th>Food Name</th>
      <th>Description</th>
      <th>Photo</th>
      <th>Difficulty</th>
      <th>Time</th>
      <th>Action</th>
    </tr>
    <?php $i = 1; ?>
    <?php foreach ($foody as $row) :?>
     <tr>
      <td><?=$i;?></td>
      <td class="active"><?=$row["name"]; ?></td>
      <td width="350" style="text-align: justify;"><?=$row["description"]; ?></td>
      <td class="zoom" style="text-align:center"><img src="img/<?=$row["photo"]; ?>" width="100" class="img-thumbnail" ></td>
      <td style="text-align:left"><?=$row["difficulty"].'/5'; ?></td>
      <td ><?=$row["time"].' minutes'; ?></td>
      <td>
        <a href="update.php?id=<?=$row["id"]; ?>" class="btn btn-warning">edit</a>
        <a href="delete.php?id=<?=$row["id"]; ?>" class="btn btn-danger" onclick = "return confirm('are you sure?');">delete</a>
      </td>
    </tr>
    <?php $i++; ?>
  <?php endforeach; ?>
</table>
<br>
<form action="" method="post">
  <div style="color: #FFFFFF;">Sort by: 
    <button class="btn btn-default" type="submit" name="byName">Name</button>
    <button class="btn btn-default" type="submit" name="byDes">Description</button>
    <button class="btn btn-default" type="submit" name="byDif">Difficulty</button>
    <button class="btn btn-default" type="submit" name="byTime">Time</button></div>
  </form>
  <br>
  <?php if(isset($_POST["cari"])){?>
    <a href="index.php" class="btn btn-default btn-lg btn-block">Back to Menu</a>
  <?php } ?>
  <div style="color: #FFFFFF;">Made by Indah Mursyida Bahrina &#169;2021</div>
  <br>
</section>

</body>
</html>