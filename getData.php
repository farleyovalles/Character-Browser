<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connectDb.php';

$sql = "SELECT * FROM Characters;";


//getting data from Character table
$result = mysqli_query($conn,$sql);  

//storing data into array
$data = [];
$i = 0;
while ($row = mysqli_fetch_assoc($result))
{
    $data[$i] = $row;
    $i++;
}

//return response in JSON format
echo json_encode($data);


/*
//used to view sql statement results in table format
echo "<table border='1'>
<tr>
    <th>Pkey</th>
    <th>Name</th>
    <th>Gender</th>
    <th>Release Year</th>
    <th>Hitscan</th>
    <th>Role</th>
    <th>Image</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['pkey'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['releaseYear'] . "</td>";
    echo "<td>" . $row['hitscan'] . "</td>";
    echo "<td>" . $row['role'] . "</td>";
    echo "<td>" . $row['image'] . "</td>";
    echo "</tr>";
}
echo "</table>";

*/


mysqli_close($conn);
?>
