<?php
    
    include("classes/connect.php");
    include("classes/signupclass.php");
    $first_name="";
    $last_name="";
    $email="";
    $msg="";
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $signup = new SignUp();
        $result = $signup->evaluate($_POST);

        if($result == ""){
            header("Location: login.php");
            die;
        }
        else{
            $msg=$result;
        }
        $first_name=$_POST['first_name'];
        $last_name=$_POST['last_name'];
        $email=$_POST['email'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>NSL-SignUp</title>

    <style>
        body{
            background-color:#efefef;
            opacity: 0.8;
        }
        
        .form-body{
            background-color:white;
            border: 1px solid grey;
            margin:100px auto;
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
          <a class="navbar-brand" style="font-family:Georgia;font-weight: bolder;font-size: 20px;" href="#">NSL - Sign up to find your friends!!!</a>
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
            <h4 style="text-align: center; margin-top:20px;">NSL - SignUp</h4>
            <form method="post">
                <div class="form-group cont">
                    <input type="text" class="form-control"  value="<?php echo $first_name ?>" name="first_name" placeholder="First Name" required>
                </div>
                <div class="form-group cont">
                    <input type="text" class="form-control"  value="<?php echo $last_name ?>" name="last_name" placeholder="Last Name" required>
                </div>

                <div class="input-group form-group cont">
                    <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Gender</label>
                    </div>
                <select class="custom-select" id="inputGroupSelect01" name="gender" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                </select>
                </div>

                <div class="form-group cont">
                    <input type="email" class="form-control"  name="email" placeholder="Email" value="<?php echo $email ?>" required>
                </div>
                <div class="form-group cont">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group cont">
                    <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
                </div>
                <div class="cont">
                <input type="submit" class="btn btn-primary" value="Signup">
                <a href="login.php" style="float: right;">Have an Account? Login</a>
                </div>
                
            </form>
       </div>
</body>
</html>