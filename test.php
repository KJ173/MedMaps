<?php
    $fn = $_POST['val1'];
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
    //echo "Connected successfully";
    echo("$fn");
    $sql = "SELECT * FROM hospitals WHERE Oxygen_beds > 0";
    $res = mysqli_query($conn,$sql); 
    /*if(mysqli_num_rows($res) > 0)
    {
      $row = mysqli_fetch_array($res);
      echo($row["Longitude"]);
    }*/
    if (mysqli_num_rows($res) > 0) {
    $i = 1;
    echo("<br><br>");
    echo("<center><table><tr><th> Sr </th><th> Hospital Name </th><th> Hospital Id </th><th> Oxygen Beds </th><th> Address </th>");
    while($row = mysqli_fetch_array($res)) {
    echo("<tr><td>" .$i. "</td><td>" . $row["Hospital_name"]. "</td><td> " . $row["Hospital_id"]. "</td><td>". $row["Oxygen_beds"]."</td><td>".$row["Hospital_address"]."</td></tr>");
     $i++;
    }
    echo("</table></center>");
    } else {
      echo ("No results found");
    } 
  
    mysqli_close($conn);
?>