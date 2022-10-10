<?php
    $oxybed = $_POST["oxbed"];
    $hospid = $_POST["hospid"];
    $hospname = $_POST["hospname"];
    //echo($user_id);
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db = "iot";

    // Create and check database connection
    $conn = mysqli_connect($hostname, $username, $password, $db);
    if (!$conn) {
      echo("Connection failed: <br><br> " . mysqli_connect_error());
    }
    date_default_timezone_set('Asia/Calcutta');
    $date = date('m/d/Y h:i:s a', time());
    
    $sql1 = "UPDATE hospitals SET Oxygen_beds=$oxybed where Hospital_id = '$hospid' ";
    if (mysqli_query($conn, $sql1)) {
        //echo("Data updated successfully");
        //$sql2 = "INSERT into hospital_oxygenbeds(first_name, last_name, email_id)";
        $sql2 = "INSERT into hospital_oxgenbeds (Hospital_id,Hospital_name,Oxygen_bed,Date_time) values('$hospid','$hospname',$oxybed,'$date')";
        if(mysqli_query($conn,$sql2))
        {
          $data['reply'] = "Success";
        }
        else {
          echo("Error updating data: " . mysqli_error($conn));
        }
        //$data['reply'] = "Success";
      }
    /*$sql = "SELECT * from hospitals where Hospital_id = '$hospid"
    $res = (mysqli_query($conn,$sql))
    $count = mysqli_num_rows($res);
    if($count > -1)
    {
    while($row = mysqli_fetch_array($res)){
      $Hospname = $row["Hospital_name"];
    }*/
    echo json_encode($data);
    mysqli_close($conn)
?>
<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $db = "iot";

  // Create and check database connection
  $conn = mysqli_connect($hostname, $username, $password, $db);
  if (!$conn) {
    echo("Connection failed: <br><br> " . mysqli_connect_error());
  }

  /*$sql = "INSERT into hospital_oxgenbeds (Hospital_id,Hospital_name,Oxygen_bed,Date_time) values('$hospid','$hospname',$oxybed,$date)";
  if(mysqli_query($conn,$sql))
  {
    $data['reply'] = "Success";
  }
  else {
    echo("Error updating data: " . mysqli_error($conn));
  }*/
  /*$res = (mysqli_query($conn,$sql))
  $count = mysqli_num_rows($res);
  if($count > -1)
  {
    while($row = mysqli_fetch_array($res)){
      $Hospname = $row["Hospital_name"];
    }
  }*/
  //echo json_encode($data);
  mysqli_close($conn);
?>