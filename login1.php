<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>-->
  <script src="lg.js"></script>
    <title>Medmaps-Login</title>
    <style>
        *,
        *:before,
        *:after{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            position: center;
        }
        body{
            background-color: #caf0f8;
            /*background-image:url("medical1.jpg");
            background-size:100%;
            background-attachment:fixed;
            background-repeat:no-repeat;
            margin:2px;
            background-position:center;*/
        }
        .background{
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%,-50%);
            left: 50%;
            top: 50%;
        }
        .background .shape{
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }
        .shape:first-child{
            background: linear-gradient(
                #1845ad,
                #23a2f6
            );
            left: -80px;
            top: -80px;
        }
        .shape:last-child{
            background: linear-gradient(
                to right,
                #ff512f,
                #f09819
            );
            right: -30px;
            bottom: -80px;
        }
        form{
            height: 520px;
            width: 350px;
            background-color: rgba(255,255,255,0.14);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(18px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
        }

        form *{
            font-family: 'Poppins',sans-serif;
            color: black;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }
        form h3{
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }
        label{
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
            color:black;
        }
        input{
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255,255,255,0.9);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }
        ::placeholder{
            color: #e5e5e5;
        }
        button{
            margin-top: 30px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
        .social{
            margin-top: 30px;
            display: flex;
            }
            .social div{
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255,255,255,0.27);
            color: #eaf0fb;
            text-align: center;
            }
            .social div:hover{
            background-color: rgba(255,255,255,0.47);
            }
            .social .fb{
            margin-left: 25px;
            }
            .social i{
            margin-right: 4px;
            }
            .container{
                padding:16px;
            }
    </style>
</head>
<body>
        
    <div class="background">
        <centre>
        <div class="shape"></div>
        <!--<div class="shape"></div>-->
        <form id="lg" name="lg" method="post" action="lg.php">
            <h3>Login Here</h3>
            <label>Hospital Id</label>
            <input type="text" class="form-control" placeholder="Email or Phone" id="username" name="username" required="required">

            <label>Password</label>
            <input type="password"class="form-control" placeholder="Password" id="password" name="password" required="required">
            <div id="resp" style="color:red;"></div>
            <button type="submit" value="Submit">Log In</button>
            <button type="reset">Reset</button>
        </form>
        </cenre>
    </div>
    <!--<script src="lg.js"></script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>-->
</body>
</html>