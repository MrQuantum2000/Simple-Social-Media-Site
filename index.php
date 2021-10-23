<?php

    session_start();
    include("classes/connect.php");
    include("classes/loginclass.php");
    include("classes/user.php");
    include("classes/postclass.php");
    
    $login = new Login();
    $user_data = $login->check_login($_SESSION['nsl_userid']);
    $session_data = $user_data;
    $proff_image = "gallery/user_male.jpg";
    if($user_data['gender'] == "female")
    {
      $proff_image = "gallery/user_female.jpg";
    }
    if(file_exists($user_data['profile_image']))
    {
      $proff_image = $user_data['profile_image'];
    }

    //collect friends
    $fol_length = 0;
    $user = new User();
    $friends = $user->get_following($user_data['userid'],"user");
    if(is_array($friends))
    {
      $fol_length = count($friends);
    }
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NSL-Home</title>

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

    .preview {
    overflow: hidden;
    width: 160px; 
    height: 160px;
    margin: 10px;
    border: 1px solid red;
    }
  </style>
</head>

<body>
  <?php include("header.php") ?>
  <!--  -->
  <div class="container jsjhr">
    <div class="row skfjh">
      <div class="col-md-2 sfjhe">
        <div class=" sjfsj">
          <img src="./Images/1.jpg" alt="">
          <h5 class="text-center pt-3">
             <?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?>
          </h5>
          <p class="text-muted text-center">
          <?php echo $user_data['about'] ?> 
          </p>
          <hr>
          <div>
            <div style="margin:10px;text-align:center">
              <h6>
                 Followers <br> <?php echo $user_data['likes'] ?>
              </h6>
            </div>
            <div style="margin:10px;text-align:center">
              <h6>
                 Followings <br> <?php echo $fol_length ?>
              </h6>
            </div>
          </div>
          <hr>
          <div class="text-center">
            <a href="profile.php?section=default&id=<?php echo $_SESSION['nsl_userid'] ?>" class="font-weight-bold text-decoration-none text-center">
              View Profile
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <form method="POST">
        <label class="upload-file"><h6><i class="fas fa-edit text-primary pr-1"></i>New Post</h6>
            <input type="file" name="image" class="image" id="upload_image" >
        </label>
        </form>
            
        
        <!-- post -->
        <?php 
                $DB = new Database();
                $user_class = new User();
                $followers = $user_class->get_following($_SESSION['nsl_userid'],"user");
                $follower_ids = false;
                $posts = false;
                if(is_array($followers))
                {
                  $follower_ids = array_column($followers,"userid");
                  $follower_ids = implode("','",$follower_ids);
                }
                if($follower_ids)
                {
                  $myuserid = $_SESSION['nsl_userid'];
                  $sql = "select * from posts where userid = '$myuserid' || userid in ('" .$follower_ids. "') order by id desc limit 30";
                  $posts = $DB->read($sql);
                }
                if($posts){

                  foreach($posts as $ROW){
                    $user = new User();
                    $likepost = new Post();
                    $ROW_USER = $user->get_user($ROW['userid']);

                    $like_details = $likepost->get_like_details($ROW['postid'],'post'); 

                    include("postfeed.php");

                }
            }
            else{
              echo "<div class='box1'>";
              echo "Follow someone or yourself to see posts!!!";
              echo "</div>";
            }
                      
        ?>
        <!-- end post -->
        
      </div>

     
      <div class="col-md-4">
        <div class="left_box">
          <span>
            Your Friends
          </span>
          <hr>
           <!-- friendlist -->
           <?php 
                     if($friends){
                         foreach($friends as $friend){
                            
                            if($friend['userid'] != $_SESSION['nsl_userid'])
                            {
                              $FRIEND_ROW = $user->get_user($friend['userid']);
                              include("friendslist.php");
                            }
                         }
                     }
                      
                     ?>
            <!-- end friendlist -->
        </div>

      </div>

    </div>

  </div>
  </div>




   <!-- Modal-->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="img-container">
                        <div class="row">
                          <div class="m-3">
                            <input class="form-control" type="text" placeholder="Write Caption" id="caption" style=" min-width: 200%; background-color: #efefef;">
                          </div>
                        </div>
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
        <button type="button" class="btn btn-primary" id="crop" >Post</button>
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
      aspectRatio: 1 / 1,
      viewMode: 4,
      preview:'.preview'
    });
  }).on('hidden.bs.modal', function(){
    cropper.destroy();
      cropper = null;
  });

  $('#crop').click(function(){
    canvas = cropper.getCroppedCanvas({
      width:600,
      height:600
    });
    var caption = document.getElementById("caption").value;

    canvas.toBlob(function(blob){
      url = URL.createObjectURL(blob);
      var reader = new FileReader();
      reader.readAsDataURL(blob);
      reader.onloadend = function(){
        var base64data = reader.result;
        $.ajax({
          url:'postupload.php',
          method:'POST',
          data:{postImage:base64data , postCaption:caption},
          success:function(data)
          {
            alert("Post Uploaded successfully!!!Refresh to see your changes.");
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

               