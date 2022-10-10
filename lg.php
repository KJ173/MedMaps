<?php
    session_start();
    $pass = $_POST["pass"];
    $uname = $_POST["uname"];
    $k=1;
    if(empty($uname) || empty($pass)){
        $k=0;
        $data['reply'] = 'One or more required Fields are empty';
    }
    if($k==1)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "iot";

        $conn = new mysqli($servername,$username,$password,$db);

        if($conn->connect_error){
            die("Connection failed: ".$conn->connect_error);
        }

        $sql = "SELECT * FROM hospitals WHERE Hospital_id = '$uname' AND Hospital_pass = '$pass'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        if($count==1){
            $se='';
            $te='';
            $rc=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9','0','(',')','*','%','$','#','@','!','^');
            while(True){
                for($i=0;$i<10;$i++){
                    $ind=rand(0,70);
		            $se .="$rc[$ind]";
                }
                $te = $se;
                $sql = "SELECT * FROM hospitals WHERE SessionData = '$te'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);
                if($count != 1){
                    $sql = "UPDATE hospitals SET SessionData='$te' WHERE Username = '$uname'";
                    if ($conn->query($sql) === TRUE) {
                        //login success
                    }
                    break;
			    }
            }
            $_SESSION["currents"] = "$se";
            $data['reply'] = "Login success";
        }
        else{
            $data['reply'] = "Username or Password is incorrect";
        }
        $conn->close();
    }
    echo json_encode($data);
?>