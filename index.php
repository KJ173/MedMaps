<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Google Map</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <!--<link rel="stylesheet" type="text/css" href="./style.css" />
  <script src="./index.js"></script>-->

  <style>
  #map{
    height:400px;
    width:100%;
  }
  body{
    background-color: #caf0f8;
  }
  /*#customers table{
    font-family:Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }
  #customers td,#customers th{
    border: 1px solid #ddd;
    padding: 8px;
  }

  #customers tr:nth-child(even)
  {background-color: #f2f2f2;}

  #customers tr:hover {background-color: #ddd;}

  #customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}*/
table,td{
    border: 2px solid black;
    border-collapse: collapse;
    padding: 8px;
    //width:100%;
    background-color: #98FB98;
    font-family:Arial, Helvetica, sans-serif;
}
td:hover{background-color: #ddd;}
//tr:hover{background-color: white;}
th{
  border: 1px solid black;
    border-collapse: collapse;
    padding: 8px;
    background-color: White;
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
  //echo "Connected successfully";
  $sql = "SELECT * FROM hospitals WHERE Oxygen_beds > 0";
  $res = mysqli_query($conn,$sql); 
  $Lat[] = null;
  $Long[] = null;
  $Hospitalname[] = null;
  $i = 0;
  $j=0;
  $count = mysqli_num_rows($res);
  if($count > -1)
  {
    while($row = mysqli_fetch_array($res)){
      $Lat[$i] = $row["Latitude"];
      $Long[$i] = $row["Longitude"];
      $Hospitalname[$i] = $row["Hospital_name"];
      //echo("\r\n$i");
      //echo("\r\n$Lat[$i]");
      //echo("\r\n$Hospitalname[$i]");
      //echo(gettype($i));
      $i++;
      $j++;
    }
    //$count = mysqli_num_rows($res);
    $Lat = json_encode($Lat);
    $Long = json_encode($Long);
    $Hospitalname = json_encode($Hospitalname);
    //$row = mysqli_fetch_array($res);
    //$Lat = $row["Latitude"];
    ////$Long = $row["Longitude"];
    //echo($row["Latitude"]);
  }
  /*else
  {
    echo("No results found!");
  }*/
  $j=0;
  function retcount()
  {
    return $j;
  }
  //$j=0;
  //echo nl2br("\r\n$Lat[1]");
  /*if (mysqli_num_rows($res) > 0) {
  echo("<table><tr><th> Sr </th><th> Hospital Name </th><th> Hospital Id </th><th> Oxygen Beds </th><th> Latitude </th><th> Longitude </th>");
  while($row = mysqli_fetch_array($res)) {
  echo("<tr><td>" . $row["Sr"]. "</td><td>" . $row["Hospital_name"]. "</td><td> " . $row["Hospital_id"]. "</td><td>". $row["Oxygen_beds"]."</td><td>".$row["Latitude"]."</td><td>".$row["Longitude"]."</td></tr>");
    }
  echo("</table>");
  } else {
    echo ("No results found");
  }*/ 

  mysqli_close($conn);
?>
  <h1>Med Maps</h1>
  <div id="map"></div>

  <script>
    function initMap()
    {
      //let map;
      getLocation();
      function getLocation()
      {
        if(!navigator.geolocation)
        {
          console.log('Geolocation API not supported by the browser.');
        }
        else {
          console.log('Checking location...');
          navigator.geolocation.getCurrentPosition(success,error);
        }
      }
      function success(position){
        console.log(position);
        var lati = position.coords.latitude;
        var lngi = position.coords.longitude;
        console.log(typeof(lati));
        console.log('Latitude:',position.coords.latitude);
        console.log('Longitude:',position.coords.longitude);
        //addMarker({coords:{lat:lati,lng:lngi},content:'You'});
        //console.log(locationAddress);
        var wow = Number("<?=$count?>");
        if(wow>0)
        {
          console.log(num);
          var Lat = '<?=$Lat?>';
          Lat = JSON.parse(Lat);
          var Long = '<?=$Long?>';
          Long = JSON.parse(Long);
          var Hospitalname = '<?=$Hospitalname?>';
          Hospitalname = JSON.parse(Hospitalname);
          var num = Number("<?=$i?>");
          var count = 0;
          //$n=0;

          for(var j=0;j<num;j++){
            console.log(Lat[j]);
            console.log(Long[j]);
            //count++;
          }

          //console.log(Lat[0]);
          //console.log(Long[0]);
          //var markers = [{coords,iconImage,content}];
          console.log(Hospitalname.length);
          var markers=[];
          addMarker({coords:{lat:lati,lng:lngi},content:'You'});
          for(var i=0;i<Hospitalname.length;i++)
          {
              markers[i] = {
              coords:{lat:Number(Lat[i]),lng:Number(Long[i])},
              iconImage:'https://img.icons8.com/color/48/000000/hospital-bed.png',
              content:Hospitalname[i]
              //console.log(Hospitalname[i]);
            };
            console.log(Hospitalname[i]);
          }
          console.log(markers.length);
          for(var i=0;i<markers.length;i++){
            addMarker(markers[i]);
          }
        }
        else
        {
          addMarker({coords:{lat:lati,lng:lngi},content:'You'});
        }
        geocode({coords:{lat:lati,lng:lngi}});
      
      }
      function error()
      {
        console.log('Geolocation error');
      }

      var options = {
        zoom:8,
        center: {lat:19.1646,lng:72.8493}
      }

      var map = new google.maps.Map(document.getElementById('map'),options);
      
     function addMarker(props)
     {
       var marker = new google.maps.Marker({
        position:props.coords,
        map:map
      });

      if(props.iconImage){
        marker.setIcon(props.iconImage);
      }

      if(props.content){
        var infoWindow = new google.maps.InfoWindow({
          content:props.content
        });

        marker.addListener('click',function(){
          infoWindow.open(map,marker);
        });
      }
     }

     function geocode(props)
     {
      const geocoder = new google.maps.Geocoder();
      input = props.coord;
      geocoder
        .geocode({ location: props.coords })
        .then((response) => {
          if (response.results[0]) {
            map.setZoom(13);
            var address = response.results[0].formatted_address;
            console.log(address);
            //infowindow.open(map);
            //return address;
          } else {
            console.log("No results found");
          }
        })
        .catch((e) => window.alert("Geocoder failed due to: " + e));
     }
    }
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

  <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAdUg5RYhac4wW-xnx-p0PrmKogycWz9pI&callback=initMap&libraries=&v=weekly"
      src=
      async
  ></script>
</body>
</html>
