<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" style="font-family:Georgia;font-weight: bolder;font-size: 20px;" href="index.php">NSL</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">

        <?php
            $profile_image = "gallery/user_male.jpg";
            if($session_data['gender'] == "Female")
            {
              $profile_image = "gallery/user_female.jpg";
            }
            if(file_exists($session_data['profile_image']))
            {
              $profile_image = $session_data['profile_image'];
            }
        ?>

        <ul class="navbar-nav ml-auto mb-4 mb-lg-0 my-3 my-lg-0 mr-2 mr-lg-0" style="">
          <li class="nav-item ml-3">
           <form method="get" class="" action="search.php">
            <input class="form-control mr-2" type="search" placeholder="Search Here" name="find" style="background-color: #efefef;">
          </form>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto mb-4 mb-lg-0" style="">
          <li class="nav-item ml-3">
            <img src="<?php echo $profile_image?>" alt="" style="width: 60px;
               border-radius: 50px;">
            <a href="logout.php" style="position:relative;text-decoration:none;">&nbsp &nbsp Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>