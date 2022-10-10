<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "iot";

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);

}
echo "Connected successfully";
$sql = "SELECT * FROM hospitals WHERE Oxygen_beds > 0";
$res = mysqli_query($conn,$sql); 

if (mysqli_num_rows($res) > 0) {
echo("<table><tr><th> Sr </th><th> Hospital Name </th><th> Hospital Id </th><th> Oxygen Beds </th><th> Latitude </th><th> Longitude </th>");
 while($row = mysqli_fetch_array($res)) {
echo("<tr><td>" . $row["Sr"]. "</td><td>" . $row["Hospital_name"]. "</td><td> " . $row["Hospital_id"]. "</td><td>". $row["Oxygen_beds"]."</td><td>".$row["Latitude"]."</td><td>".$row["Longitude"]."</td></tr>");
  }
echo("</table>");
} else {
  echo ("No results found");
} 

mysqli_close($conn);
?>
</body>
</html>
