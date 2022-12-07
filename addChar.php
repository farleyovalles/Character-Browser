<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connectDb.php';

//get inputs from form
if (isset($_POST["pkey"])){ $pkey = ($_POST["pkey"]);}
if (isset($_POST["name"])){ $name = ($_POST["name"]);}
if (isset($_POST["gender"])){ $gender = ($_POST["gender"]);}
if (isset($_POST["year"])){ $releaseYear = ($_POST["year"]);}
if (isset($_POST["roleType"])){ $role = ($_POST["roleType"]);}
if (isset($_POST["checkbox"])) { $fireType = $_POST["checkbox"];} 
else{
  $fireType = "0";
}

//used to test form POST was sending right data
/*
echo $pkey;
echo $name;
echo $gender;
echo $releaseYear;
echo $role;
echo $fireType;
*/

$target_dir = 'images/'; // You'd have to make this directory in the folder where you have your PHP files
$target_file = $target_dir . basename($_FILES["fileup"]["name"]);
$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Verify if the image file is an actual image or a fake image
if(isset($_POST["submit"]) && isset($_FILES["fileup"])) {
    $check = getimagesize($_FILES["fileup"]["tmp_name"]);
    if($check !== false) {
        echo "<li>File is an image of type - " . $check["mime"] . ".</li>";
        $uploadOk = 1;
    } else {
        echo "<li>File is not an image.</li>";
        $uploadOk = 0;
    }
}
// Verify if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}
// Verify the file size
if ($_FILES["fileup"]["size"] > 500000) {
    echo "<li>The file is too large.</li>";
    $uploadOk = 0;
}
// Verify certain file formats
if($imageFileType != "jpg" && $imageFileType != "png") {
    echo "<li>Only jpg and png files are allowed for the upload.</li>";
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "<li>The file was not uploaded.</li>";
} else { // upload file
    if (move_uploaded_file($_FILES["fileup"]["tmp_name"], $target_file)) {
        echo "<li>The file ". basename( $_FILES["fileup"]["name"]). " has been uploaded.</li>";
    } else {
        echo "<li>Error uploading your file.</li>";
    }
}

$sql = 
    "INSERT INTO `Characters`( `name`, `gender`, `releaseYear`, `hitscan`, `role`, `image`) VALUES 
    ('$name', '$gender', '$releaseYear', '$fireType', '$role',
    '$target_file'); ";

mysqli_query($conn, $sql);

mysqli_close($conn);
header("location: ./index.html");

?>
