<?php

    session_start();
    include("classes/connect.php");
    include("classes/loginclass.php");
    include("classes/user.php");
    include("classes/postclass.php");
    
    $login = new Login();
    $user_data = $login->check_login($_SESSION['nsl_userid']);
    $session_data = $user_data;

    if(isset($_GET['find']))
    {
        $find = addslashes($_GET['find']);

        $sql = "select * from users where userid != '$_SESSION[nsl_userid]' && (first_name like '%$find%' ||  last_name like '%$find%') limit 30";
        $DB = new Database();
        $results = $DB->read($sql);

    }
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NSL-Search</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  <script src="https://kit.fontawesome.com/d59118fa25.js" crossorigin="anonymous"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js" integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" integrity="sha512-NCJ1O5tCMq4DK670CblvRiob3bb5PAxJ7MALAz2cV40T9RgNMrJSAwJKy0oz20Wu7TDn9Z2WnveirOeHmpaIlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  

  <style>
    * {
      margin: 0;
      padding: 0;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
    }

    body {
      background-color: #efefef !important;
    }

    .jsjhr .skfjh {
      position: relative;
      top: 4rem;
    }

    .jsjhr .skfjh .sfjhe {
      background-color: #fff;
      padding: 12px;
      -webkit-box-shadow: 0px 0px 6px #ccc;
      box-shadow: 0px 0px 6px #ccc;
      height: 100%;
    }

    .jsjhr .skfjh .sfjhe .sjfsj img {
      width: 140px;
      margin-top: 9px;
      border-radius: 50%;
      margin-left: 8px;
    }

    .jsjhr .skfjh .sfjhe h5 {
      font-size: 16px;
    }

    .jsjhr .skfjh .jfheuf {
      background-color: #fff;
      -webkit-box-shadow: 0px 0px 6px #ccc;
      box-shadow: 0px 0px 6px #ccc;
      padding: 34px;
    }

    .jsjhr .skfjh .jfheuf textarea {
      border: navajowhite;
      border-bottom: 1px solid #efefef;
      outline: navajowhite;
    }

    .jsjhr .skfjh .box1 {
      background-color: #fff;
      -webkit-box-shadow: 0px 0px 6px #ccc;
      box-shadow: 0px 0px 6px #ccc;
      padding: 20px;
      margin-top: 20px;
    }

    .jsjhr .skfjh .box1 .skfjkk .lkt40 img {
      
      border-radius: 50%;
      width:50px;
    }

    .jsjhr .skfjh .left_box {
      background-color: #fff;
      -webkit-box-shadow: 0px 0px 6px #ccc;
      box-shadow: 0px 0px 6px #ccc;
      padding: 34px;
    }

    .jsjhr .skfjh .left_box .dfkj .lkt40 img {
      width: 30px;
      border-radius: 50%;
      height: 30px;
      margin-right: 10px;
    }
    .upload-file{
            font-size:12px;
            color: blue;
        }
    input[type="file"] {
            display: none;
    }
    .image1 {
		  	display: block;
		  	max-width: 100%;
    }
  </style>
</head>

<body>

  <?php include("header.php") ?>
  <!--  -->
  
  <div style='background-color:white;height:500px;width:500px;margin:auto;margin-top:50px;'>
        <!-- searchlist -->
        <?php 
                     if($results){
                         foreach($results as $FRIEND_ROW){
                            $images = "gallery/user_male.jpg";
                            if($FRIEND_ROW['gender'] == "Female")
                            {
                                $images = "gallery/user_female.jpg";
                            }
                            if(file_exists($FRIEND_ROW['profile_image']))
                            {
                                $images = $FRIEND_ROW['profile_image'];
                            }
                          
                          echo  "<a href='profile.php?id=$FRIEND_ROW[userid]' style='padding:30px;text-decoration:none;color:grey;'>";
                          echo  "<img style='width:70px;height:70px;border-radius:50%;margin-right:10px;' src='$images'>";
                          echo $FRIEND_ROW['first_name']. " " .$FRIEND_ROW['last_name'];
                          echo "<br>";
                          echo "</a>";
                          
                         }
                     }
                     else
                     {
                        
                         echo "<h4 style='text-align:center;'>No results found</h4>";
                         
                     }
                      
         ?>
         <!--end searchlist -->
  
         </div>
        

</body>
</html>


