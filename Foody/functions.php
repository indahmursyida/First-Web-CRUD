<?php 
$conn = mysqli_connect("localhost", "root", "", "foodList");

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}

	return $rows;
}
function upload(){
	$namaFile = $_FILES["photo"]["name"];
	$ukuranFile = $_FILES["photo"]["size"];
	$error = $_FILES["photo"]["error"];
	$locationFile = $_FILES["photo"]["tmp_name"];

	if($error === 4){
		echo "<script>
		alert('Choose image!');
		</script>";
		return false;
	}

	$validExtensionFile = ['jpg', 'jpeg', 'png'];
	$extensionFile = explode('.', $namaFile);
	$extensionFile = strtolower(end($extensionFile));
	if(!in_array($extensionFile, $validExtensionFile)){
		echo "<script>
		alert('It's not an image!');
		</script>";
		return false;
	}

	// if ($ukuranFile > 1000000) {
	// 	echo "<script>
	// 			alert('Image is too large!');
	// 			</script>";
	// 			return false;
	// }
	$namaFileBaru = uniqid().'.'.$extensionFile;
	move_uploaded_file($locationFile, 'img/'.$namaFileBaru);
	return $namaFileBaru;

}
function insert($data){
	global $conn;

	$name = htmlspecialchars($data["name"]);
	$description = htmlspecialchars($data["description"]);
	$difficulty = htmlspecialchars($data["difficulty"]);
	$time = htmlspecialchars($data["time"]);
	$photo = upload();
	if(!$photo){
		return false;
	}


	$query = "INSERT INTO food VALUES('','$name', '$description', '$photo', '$difficulty','$time')";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function delete($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM food WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function update($data){
	global $conn;
	$id = $data["id"];
	$name = htmlspecialchars($data["name"]);
	$description = htmlspecialchars($data["description"]);
	$difficulty = htmlspecialchars($data["difficulty"]);
	$time = htmlspecialchars($data["time"]);
	$oldPic = htmlspecialchars($data["oldPic"]);

	if($_FILES["photo"]["error"] == 4){
		$photo = $oldPic;
	}else{
		$photo = upload();
	}

	$query = "UPDATE food
	SET name = '$name',
	description = '$description',
	photo = '$photo',
	difficulty = '$difficulty',
	time = '$time'
	WHERE id = $id";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function search($keyword){
	$query = "SELECT * FROM food WHERE name like '%$keyword%'
	OR description like '%$keyword%'
	OR time like '%$keyword%'
	OR difficulty like '%$keyword%' ";

	return query($query);
}

function sorting($query){
	return query($query);
}
?>