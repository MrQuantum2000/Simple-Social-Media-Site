<?php

    session_start();
    include("classes/connect.php");
    include("classes/loginclass.php");
    include("classes/signupclass.php");
    include("classes/user.php");
    include("classes/postclass.php");
    include("classes/settings.php");
    
    $login = new Login();
    $user_data = $login->check_login($_SESSION['nsl_userid']);
    $session_data = $user_data;
    if(isset($_GET['id']))
    {
      $user = new User();
      $profile_data = $user->get_user($_GET['id']);
  
      if(is_array($profile_data))
      {
        $user_data = $profile_data;
      }
    }
    $user = new User();
    $val = "Follow";
    $friends = $user->get_following($_SESSION['nsl_userid'],"user");
    if($friends){
      foreach($friends as $friend){
         
         if($friend['userid'] == $user_data['userid'])
         {
           $val = "Unfollow";
         }
      }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <title>NSL-Profile</title>
    <script src="https://kit.fontawesome.com/d59118fa25.js" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js" integrity="sha512-FHa4dxvEkSR0LOFH/iFH0iSqlYHf/iTwLc5Ws/1Su1W90X0qnxFxciJimoue/zyOA/+Qz/XQmmKqjbubAAzpkA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css" integrity="sha512-NCJ1O5tCMq4DK670CblvRiob3bb5PAxJ7MALAz2cV40T9RgNMrJSAwJKy0oz20Wu7TDn9Z2WnveirOeHmpaIlA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <style>
        body{
        color: #1a202c;
        text-align: left;
        background-color:#efefef;
        }
        .main-body {
            padding: 15px;
        }
        .card {
            box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col, .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }
        .mb-3, .my-3 {
            margin-bottom: 1rem!important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }
        .h-100 {
            height: 100%!important;
        }
        .shadow-none {
            box-shadow: none!important;
        }
        .upload-file{
            font-size:14px;
            color: blue;
        }
        input[type="file"] {
            display: none;
        }
        .image1 {
		  	display: block;
		  	max-width: 100%;
		   }

		   .preview {
  			overflow: hidden;
  			width: 160px; 
  			height: 160px;
  			margin: 10px;
  			border: 1px solid red;
		   }
       .rounded-circle{
         border-radius : 50%;
         width:200px;
       }
       .dfkj .lkt40 img {
        width: 30px;
        border-radius: 50%;
        height: 30px;
        margin-right: 10px;
      }
        
    </style>
</head>
<body>
    
    <?php include("header.php")  ?>

    <div class="container">
        <div class="main-body">
        
              <!-- Breadcrumb -->
              <nav aria-label="breadcrumb" class="main-breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page" style="color:black;"><?php echo $user_data['first_name'] ?>'s Profile</li>
                </ol>
              </nav>
              <!-- /Breadcrumb -->
        
              <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">

                        <?php
                          $profile_image = "gallery/user_male.jpg";
                          if($user_data['gender'] == "Female")
                          {
                            $profile_image = "gallery/user_female.jpg";
                          }
                          if(file_exists($user_data['profile_image']))
                          {
                            $profile_image = $user_data['profile_image'];
                          }
                        ?>

                        <img src="<?php echo $profile_image ?>" class="rounded-circle">
                        <div class="mt-3">
                        <?php
                          if($user_data['userid'] == $_SESSION['nsl_userid'])
                          {
                          echo "<form method='POST'>";
                          echo "<label class='upload-file'>Edit Profile Picture";
                          echo "<input type='file' name='image' class='image' id='upload_image' >";
                          echo "</label>";
                          echo "</form>";
                          }
                        ?>
                          <h4><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></h4>
                          <p class="text-muted text-center">
                          <?php echo $user_data['about'] ?> 
                          </p>
                          <a href="like.php?type=user&id=<?php echo $user_data['userid'] ?>">
                          <input class="btn btn-primary" id="fol" type="submit" value="<?php echo $val ?>">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <a href="profile.php?section=default&id=<?php echo $user_data['userid']; ?>"><h6 class="mb-0"><i class="fas fa-user"></i>&nbsp&nbsp About</h6></a>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <a href="profile.php?section=myposts&id=<?php echo $user_data['userid']  ?>"><h6 class="mb-0"><i class="fas fa-photo-video"></i>&nbsp&nbsp Posts</h6></a>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <a href="profile.php?section=followers&id=<?php echo $user_data['userid']  ?>"><h6 class="mb-0"><i class="fas fa-user-friends"></i>&nbsp&nbspFollowers</h6></a>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <a href="profile.php?section=following&id=<?php echo $user_data['userid']  ?>"><h6 class="mb-0"><i class="fas fa-user-friends"></i>&nbsp&nbspFollowing</h6></a>
                      </li>
                      <?php
                      if($user_data['userid'] == $_SESSION['nsl_userid'])
                      {
                      echo '<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">';
                      echo '<a href="profile.php?section=settings&id=<?php echo '.$user_data['userid'].'"><h6 class="mb-0"><i class="fas fa-user-edit"></i>&nbsp&nbspSettings</h6></a>';
                      echo '</li>';
                      }
                      ?>
                    </ul>
                  </div>
                </div>
                 
                 <?php 
                 $section = "default";
                 if(isset($_GET['section']))
                 {
                   $section = $_GET['section'];
                 }
                 //sections
                 if($section == "default")
                 {
                   include("profile_section_default.php"); 
                 }
                 else if($section == "myposts")
                 {
                   include("profile_section_myposts.php"); 
                 }
                 else if($section == "followers")
                 {
                   include("profile_section_followers.php"); 
                 }
                 else if($section == "following")
                 {
                   include("profile_section_following.php"); 
                 }
                 else if($section == "settings")
                 {
                   include("profile_section_settings.php"); 
                 }
                 
                 
                 ?>

                
              </div>
    
            </div>
        </div>
      
      <!-- Modal-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload image after cropping</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="" id="sample_image" class="image1"/>
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="crop" >Update</button>
      </div>
    </div>
  </div>
</div>			
     
      <script>

      $(document).ready(function(){

        var $modal = $('#modal');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#upload_image').change(function(event){
          var files = event.target.files;

          var done = function(url){
            image.src = url;
            $modal.modal('show');
          };

          if(files && files.length > 0)
          {
            reader = new FileReader();
            reader.onload = function(event)
            {
              done(reader.result);
            };
            reader.readAsDataURL(files[0]);
          }
        });

        $modal.on('shown.bs.modal', function() {
          cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview:'.preview'
          });
        }).on('hidden.bs.modal', function(){
          cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function(){
          canvas = cropper.getCroppedCanvas({
            width:200,
            height:200
          });

          canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
              var base64data = reader.result;
              $.ajax({
                url:'upload.php',
                method:'POST',
                data:{image:base64data},
                success:function(data)
                {
                  alert("Profile picture updated successfully!!!Refresh to see your changes.");
                  $modal.modal('hide');
                }
              });
            };
          });
        });
        
      });
</script>
		
</body>
</html>

		