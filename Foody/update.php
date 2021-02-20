<style>
	body {
		background: #dd5e89;
		background: -webkit-linear-gradient(to left, #dd5e89, #f7bb97);
		background: linear-gradient(to left, #dd5e89, #f7bb97);
		min-height: 100vh;
		font-family: helcativa;
	}

	#border {
		border: 2px solid black;
		padding: 25px;
		background-color:#FFFFFF;
		background-repeat: no-repeat;
		background-size: 200px 100px;

	</style>
	<?php 
	require 'functions.php';

	$id = $_GET["id"];

	$foody = query("SELECT * FROM food WHERE id = $id")[0];

	if (isset($_POST["submit"])) {
		if(update($_POST)>0){
			echo "<script>
			alert('Product has been updated!');
			document.location.href = 'index.php';
			</script>";
		}else{
			echo "<script>
			alert('Failed to edit product!');
			document.location.href = 'index.php';
			</script>";
		}
	}
	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>Update Product</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	</head>
	<body>
		<div class="container py-5">
			<header class="py-5" style="color: #FFFFFF;" >
				<br>
				<h1 class="display-4" style="font-family: geosanslight;">My Food List</h1><br>
				<p style="font-size: 20px; font-family: helcativa;">(I can make all of foods in this website and of course I've cooked it)</p>
				<br><br>
				<p style="font-size: 22px; font-style: italic; font-family: helcativa;">"Cooking is all about people. Food is maybe the only universal thing that really has the power to bring everyone together. No matter what culture, everywhere around the world, people eat together."</p>
				<p style="font-size: 22px; font-style: bold; font-family: helcativa;"> - Guy Fieri</p>
			</header>
			<br>
			<form class="form-inline" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id" value="<?=$foody["id"]; ?>">
				<input type="hidden" name="oldPic" value="<?=$foody["photo"]; ?>">
				<ul id = "border">
					<div>
						<label for="name">Food Name </label><br>
						<input placeholder="Enter text" class="form-control" type="text" name="name" id="name" required value="<?=$foody["name"] ?>">
					</div>
					<br>
					<div>
						<label for="description">Description </label><br>
						<textarea placeholder="Enter text" rows="5" cols="60" class="form-control" type="text" name="description" id="description" required><?=$foody["description"] ?></textarea>
					</div>
					<br>
					<div>
						<label for="photo">Photo </label><br>
						<img src="img/<?=$foody["photo"]; ?>" width = 100 class = "zoom"><br>
						<input placeholder="Enter text" type="file" name="photo" id="photo" >
					</div>
					<br>
					<div>
						<label for="difficulty">Difficulty</label><br>
						<input placeholder="Enter text" class="form-control" type="text" name="difficulty" id="difficulty" required value="<?=$foody["difficulty"] ?>">
					</div>
					<br>
					<div>
						<label for="time">Time </label><br>
						<input placeholder="Enter text" class="form-control" type="text" name="time" id="time" required value="<?=$foody["time"] ?>">
					</div>
					<br>
					<div>
						<button class="btn btn-warning" type="submit" name="submit"> update product</button>
					</div>
					<br>

				</ul>

			</form>
			<section class="pb-5 header text-center"><a href="index.php"  class="btn btn-default btn-lg btn-block">Back to Menu</a>
				<br>
				<div style="color: #FFFFFF;">Made by Indah Mursyida Bahrina &#169;2021</div>
				<br>
			</section>
		</div>


	</body>
	</html>