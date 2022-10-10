<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My Google Map</title>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "",
		"logo": "images/medmaps.png"
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
  <!--<link rel="stylesheet" type="text/css" href="./style.css" />
  <script src="./index.js"></script>-->

  <style>
  #map{
    height:600px;
    width:100%;
  }
  body{
    background-color: #caf0f8;
  }
  #lol{
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
<body data-home-page="Home.html" data-home-page-title="Home" class="u-body">
<!--<header class="u-clearfix u-header u-header" id="sec-94ff"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="https://nicepage.com" class="u-image u-logo u-image-1" data-image-width="1549" data-image-height="1282">
          <img src="images/medmaps.png" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1" data-position="">
          <div class="menu-collapse" style="font-size: 1.25rem; letter-spacing: 0px;">
            <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use></svg>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><symbol id="menu-hamburger" viewBox="0 0 16 16" style="width: 16px; height: 16px;"><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</symbol>
</defs></svg>
            </a>
          </div>
          <div class="u-nav-container">
            <ul class="u-nav u-spacing-10 u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-custom-color-2 u-text-hover-custom-color-4" href="Home.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-custom-color-2 u-text-hover-custom-color-4" href="About.html" style="padding: 10px 20px;">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-custom-color-2 u-text-hover-custom-color-4" href="Contact.html" style="padding: 10px 20px;">Contact Us</a>
</li></ul>
          </div>
          <div class="u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.html">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="About.html">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Contact.html">Contact</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
      </div></header>-->
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
  <header class="u-clearfix u-header u-header" id="sec-94ff"><div class="u-clearfix u-sheet u-sheet-1">
        <a href="https://nicepage.com" class="u-image u-logo u-image-1" data-image-width="1549" data-image-height="1282">
          <img src="images/medmaps.png" class="u-logo-image u-logo-image-1">
        </a>
        <nav class="u-menu u-menu-dropdown u-offcanvas u-menu-1" data-position="">
          <div class="menu-collapse" style="font-size: 1.25rem; letter-spacing: 0px;">
            <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-text-active-color u-custom-text-hover-color u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
              <svg><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#menu-hamburger"></use></svg>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><symbol id="menu-hamburger" viewBox="0 0 16 16" style="width: 16px; height: 16px;"><rect y="1" width="16" height="2"></rect><rect y="7" width="16" height="2"></rect><rect y="13" width="16" height="2"></rect>
</symbol>
</defs></svg>
            </a>
          </div>
          <div class="u-nav-container">
            <ul class="u-nav u-spacing-10 u-unstyled u-nav-1"><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-custom-color-2 u-text-hover-custom-color-4" href="Home.html" style="padding: 10px 20px;">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-custom-color-2 u-text-hover-custom-color-4" href="About.html" style="padding: 10px 20px;">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-custom-color-2 u-text-hover-custom-color-4" href="Contact.html" style="padding: 10px 20px;">Contact Us</a>
</li></ul>
          </div>
          <div class="u-nav-container-collapse">
            <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
              <div class="u-sidenav-overflow">
                <div class="u-menu-close"></div>
                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.html">Home</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="About.html">About</a>
</li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Contact.html">Contact</a>
</li></ul>
              </div>
            </div>
            <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
          </div>
        </nav>
      </div></header>
  <div id="lol">
    <br>
  <h1 style="text-align:center;">Med Maps</h1>
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
      function passval(add)
      {
          var addr = add;
        $.ajax({
            type: 'post',
            //url: 'test.php',
            data: {add:add},
            success: function(response){
                console.log("Success");
                console.log(add);
                console.log(typeof add);
                $('#result').html(response);
                //console.log(add);
            }
        });
      }
      //$.ajax{}
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
            var address = response.results[5].formatted_address;
            console.log(address);
            passval(address);
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
    //$fn = $_POST['val1'];
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
    if( isset($_POST['add']) ){
        echo $_POST['add'];
        //exit;
       }
    //$fn = $_POST['val1'];
    //echo "Connected successfully";
    //echo("$fn");
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
  <br><br><br>
  </div>
</body>
</html>
