<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
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
            width:100%;
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
<body>
<?php
  $user_id = $_GET["uname"];
?>
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
        <li class="active"><a href="#">Oxygen Bed Update</a></li>
        <li><a href="OxygenBedRecords.php?uname=<?=$user_id?>">Oxygen Bed Records</a></li>
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
</div>
<?php
    $user_id = $_GET["uname"];
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
      $sql = "SELECT * FROM hospitals WHERE Hospital_id='$user_id'";
      $res = mysqli_query($conn,$sql);
      if(mysqli_num_rows($res)>0)
      {
        while($row = mysqli_fetch_array($res))
        {
          $hospname = $row["Hospital_name"];
        }
      }
      mysqli_close($conn);
?>
<div class="container">
    <form id="ox" name="ox" method="post" action="adminupdate.php">
      <label>Oxygen Bed Update</label>
      <input type="number" class="form-control" placeholder="Available oxygen beds" id="oxybed" name="oxybed" required="required">
      <button type="submit" class="butn" value="Submit">Update</button>
    </form>
    <script>
      var hospid = "<?=$user_id?>";
      $(function(){
    //alert("Hi 1");
    var hospid = "<?=$user_id?>";
    var hospname = "<?=$hospname?>";
    console.log(hospid);
        var frm = $('#ox');

        frm.submit(function (e) {
    
            e.preventDefault();
            //var uname = document.getElementById('username').value;
            //var pass = document.getElementById('password').value;
            //var url="" ;
            var oxbed = document.getElementById('oxybed').value;
            $.ajax({
                url: 'adminupdate.php',
                method: 'POST',
                dataType: 'JSON',
                data: {'oxbed': oxbed,'hospid': hospid,'hospname': hospname},
                success: function (data) {
                    //document.getElementById("resp").innerHTML = data.reply;
                    if(data.reply == "Success"){
                        console.log("YESSSSSS!");
                        window.location.href = "admin.php?uname="+hospid;
                    }
                    else{
                        console.log("LOL no");
                    }
                },
                error: function (data) {
                    console.log('An error occurred.');
                    console.log(data);
                },
            });
        });
        
      })
    </script>
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
      //echo "Connected successfully";
      $sql = "SELECT * FROM hospitals WHERE Hospital_id='$user_id'";
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
</div>
</body>
</html>