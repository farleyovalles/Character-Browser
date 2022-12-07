<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connectDb.php';

$target_dir = 'images/'; // You'd have to make this directory in the folder where you have your PHP files
$target_file = $target_dir . basename($_FILES["fileup"]["name"]);

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
$sql="";
$image = basename($_FILES["fileup"]["name"]);

//used to test form POST was sending right data
/*
echo $pkey;
echo $name;
echo $gender;
echo $releaseYear;
echo $role;
echo $fireType;
*/


//if no file chosen && no changes to image in database
if($target_file == NULL)
{
  $sql = "UPDATE `Characters` SET `name` = '$name', `gender` = '$gender', `releaseYear` = '$releaseYear', 
`hitscan` = '$fireType', `role` = '$role WHERE `Characters`.`pkey` = '$pkey';";
}
else { // upload file
  if (move_uploaded_file($_FILES["fileup"]["tmp_name"], $target_file)) {
      echo "<li>The file ". basename( $_FILES["fileup"]["name"]). " has been uploaded.</li>";
      $sql = "UPDATE `Characters` SET `name`='$name',`gender`='$gender',`releaseYear`='$releaseYear',`hitscan`='$fireType',`role`='$role',`image`='$target_file' WHERE pkey = '$pkey';";
  } else {
      echo "<li>Error uploading your file.</li>";
  }
}

if(mysqli_query($conn, $sql))
{
    echo "Record edited";
}
else
{
   echo "Error: " . $sql . " <br>" . $con->error;
}

mysqli_close($conn);
header("Location: ./index.html");
?>
