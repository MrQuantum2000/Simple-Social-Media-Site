<?php
session_start();

    include("classes/connect.php");
    include("classes/loginclass.php");
    
    $msg="";

    if(isset($_SESSION['nsl_userid']))
    {
       header("Location: index.php");
       die;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $login = new Login();
        $result = $login->evaluate($_POST);

        if($result != ""){
            $msg=$result;
        }
        else{
            header("Location: index.php");
            die;
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>NSL-Login</title>

    <style>
        body{
            background-color:#efefef;
            opacity: 0.8;
        }
        
        .form-body{
            background-color:white;
            border: 1px solid grey;
            margin:150px auto;
            width:40%;
        }
        .cont{
            margin:30px auto;
            width:70%;
        }
        @media(max-width:1000px){
		.form-body {
			width: 60%;
		    }

        }
        @media(max-width: 520px){
            .form-body{
                width: 70%;
            }
        }
        @media(max-width: 590px){
            .form-body {
            width: 80%;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" style="font-family:Georgia;font-weight: bolder;font-size: 20px;" href="#">NSL - Login to Explore our Site</a>
        </div>
      </nav>
      <div style="color:red;text-align:center;margin:30px auto">
          <?php 
          if($msg != ""){
              echo $msg;
          }
          ?>
      </div>
        <div class="form-body">
            <h4 style="text-align: center; margin-top:20px;">NSL - Login</h4>
            <form method="post">
                
                <div class="form-group cont">
                    <input type="email" class="form-control"  name="email" placeholder="Email">
                </div>
                <div class="form-group cont">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="cont">
                <input type="submit" class="btn btn-primary" value="Login">
                <a href="signup.php" style="float: right;">Don't have an Account?<br>SignUp</a>
                </div>
                
            </form>
       </div>
</body>
</html>