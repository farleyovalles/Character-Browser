<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connectDb.php';

if (isset($_POST["pkey"]))
{
    $key = json_decode($_POST["pkey"]);
}

$sql = "DELETE FROM `Characters` WHERE `pkey` = $key;";


//getting data from Character table
if($conn->query($sql) == TRUE)
{
    echo "Record Deleted";
}
else
{
   echo "Error: " . $sql . " <br>" . $con->error;
}

mysqli_close($conn);
header("Location: ./index.html");
?>
