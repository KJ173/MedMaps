<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>-->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <style>
      body{
        background-color:#caf0f8;
      }
      .butn{
            margin-top: 30px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            position:center;
            }
    table{
            border: ;
            border-collapse: collapse;
            padding: 8px;
            width:90%;
            //background-color: #98FB98;
            font-family:Arial, Helvetica, sans-serif;
        }
        th, td {
          text-align: left;
          padding: 8px;
        }
        tr{
          background-color: #ddd;
        }
        th {
          background-color: #000075;
          color: white;
        }
        tr:nth-child(even){background-color: #f2f2f2}
        //td:hover{background-color: #ddd;}
        //tr:hover{background-color: white;}
        th{
          border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            //background-color: White;
        }
    </style>
</head>
<?php
    $user_id = $_GET["uname"];
    $date = $_POST["date"];
    //$hospid = $_GET["uname"];
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "iot";

    // Create and check database connection
    $conn = mysqli_connect($hostname, $username, $password, $db);
    if (!$conn) {
      echo("Connection failed: <br><br> " . mysqli_connect_error());
    }
    mysqli_close($conn);
?>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">MedMaps</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="admin.php?uname=<?=$user_id?>">Oxygen Bed Update</a></li>
        <li class="active"><a href="OxygenBedRecords.php?uname=<?=$user_id?>">Oxygen Bed Records</a></li>
        <li><a href="#">Chat Server</a></li>
        <li><a href="#">Medical Database</a></li>
      </ul>
      <!--<ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>-->
    </div>
  </div>
</nav>
<div class="container">
<form id="search" name="search" method="post" action="SearchByDate.php?uname=<?=$user_id?>">
      <label>Search By Date</label>
      <input type="text" class="form-control" placeholder="Enter MM/DD/YYYY" id="date" name="date" required="required">
      <button type="submit" class="butn" value="Submit">Search</button>
    </form>
</div>
<?php
    $date = $_POST["date"];
    $hospid = $_GET["uname"];
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "iot";

    // Create and check database connection
    $conn = mysqli_connect($hostname, $username, $password, $db);
    if (!$conn) {
      echo("Connection failed: <br><br> " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM hospital_oxgenbeds where substring(Date_time,1,10) = '$date' and Hospital_id = '$hospid'";
    $res = mysqli_query($conn,$sql);
    if (mysqli_num_rows($res) > 0){
        $i = 1;
        echo("<br><br>");
        echo("<center><table><tr><th> Sr </th><th> Hospital Name </th><th> Hospital Id </th><th> Oxygen Beds </th><th> Date and Time </th>");
        while($row = mysqli_fetch_array($res)) {
            echo("<tr><td>" .$i. "</td><td>" . $row["Hospital_name"]. "</td><td> " . $row["Hospital_id"]. "</td><td>". $row["Oxygen_bed"]."</td><td>".$row["Date_time"]."</td></tr>");
             $i++;
            }
            echo("</table></center>");
    }
    /*if (mysqli_query($conn, $sql)) {
        //echo("Data updated successfully");
        //$sql2 = "INSERT into hospital_oxygenbeds(first_name, last_name, email_id)";
        //$sql2 = "INSERT into hospital_oxgenbeds (Hospital_id,Hospital_name,Oxygen_bed,Date_time) values('$hospid','$hospname',$oxybed,'$date')";
        $data['reply'] = "Success";
    }
    else {
          echo("Error updating data: " . mysqli_error($conn));
    }
        //$data['reply'] = "Success";
    echo json_encode($data);*/
    mysqli_close($conn);
?>
</body>
</html>