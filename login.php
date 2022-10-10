<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medmaps-Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    body {//font-family: Arial, Helvetica, sans-serif;
        background-color:#caf0f8;
        background-image: url("medical1.jpg");
        background-size:100%;
        background-repeat: no-repeat;
        background attachment:fixed;
    }
    form {border: 3px solid #f1f1f1;
        background-color:white; 
        background-size:50px;   
    }

    input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }

    button {
    background-color: blue;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    }

    button:hover {
    opacity: 0.8;
    }

    .cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
    }

    .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    }

    img.avatar {
    width: 10%;
    border-radius: 50%;
    }
    table{
        width:50%;
    }
    /*.container {
    padding: 16px;
    }*/

    span.psw {
    float: right;
    padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
    .cancelbtn {
        width: 100%;
    }
    .sec{
        width: 320px;
        padding: 10px;
        border: 10px solid gray;
        margin: 0;
    }
    }
</style>
</head>
<body>
<br><br><br><br><br>
<h2 style="text-align:center"><b>Login Form</b></h2>
<div style="background-color:pink;">
    <form action="action.php" method="post">
    <div class="imgcontainer">
        <img src="login.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Hospital Id</b></label>
        <input type="text" placeholder="Enter Id" name="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required>
            
        <button type="submit">Login</button>
        <button type="reset">Reset</button>
    </div>
    </form>
</div>
</body>
</html>