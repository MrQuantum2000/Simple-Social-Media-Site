<div class="box1"> 
<div class="d-flex skfjkk">
    <div class="lkt40">
        <?php 
            $prof_img = "gallery/user_male.jpg";
            if($ROW_USER['gender'] == "Female")
            {
                $prof_img = "gallery/user_female.jpg";
            }
            if(file_exists($ROW_USER['profile_image']))
            {
                $prof_img = $ROW_USER['profile_image'];
            }
        ?>
        <img src="<?php echo $prof_img ?>" >
    </div>
    <div class="pl-2 pt-3">
        <a href="profile.php?section=default&id=<?php echo $ROW_USER['userid']?>" style="text-decoration:none;color:black;"><h6><?php echo htmlspecialchars($ROW_USER['first_name']). " " .htmlspecialchars($ROW_USER['last_name']) ?></h6></a>
    </div>
</div>
<hr>
<div class="d-flex">
    <div class="pl-2 pt-2"><p class="text-muted" style="font-weight:bold;">Caption : </p></div>
    <div class="pl-2 pt-2"><p><em><?php echo htmlspecialchars($ROW['post']) ?></em></p></div>
</div>
<br>
<img src="<?php echo $ROW['image'] ?>" class="img-fluid" alt="">
<br>
<hr>
<div class="d-flex justify-content-around">
    <?php    
    
        $likes = "";
        $likes = ($ROW['likes'] > 0) ? "(" . $ROW['likes'] . ")" : "";
    ?>
    <div>
        <a href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">
        <i class="fa fa-heart" style=""></i>
        Like<?php echo $likes ?></a>
        <?php 
            $i_liked = false;
            if(isset($_SESSION['nsl_userid']))
            {
                $DB = new Database();
                // like details
                $sql = "select likes from likes where type='post' && contentid='$ROW[postid]' ";
                $result = $DB->read($sql);
                if(is_array($result))
                {
                    $likes = json_decode($result[0]['likes'],true);
                    $user_ids = array_column($likes,"userid");
                    if(in_array($_SESSION['nsl_userid'], $user_ids))
                    {
                        $i_liked = true;
                    }
                }
            }

            if($ROW['likes']>0)
            {
                echo "<br/>";
                echo "<a href='' data-toggle='modal' data-target='#exampleModal'>";
            
                if($ROW['likes'] == 1)
                {
                    if($i_liked)
                    {
                        echo "<span class='text-muted;' style='text-align:left;font-size:12px;'> You liked this post. </span>";
                    }
                    else
                    {
                        echo "<span class='text-muted;' style='text-align:left;font-size:12px;'> 1 person liked this post. </span>";
                    }
                    
                }
                else
                {
                    if($i_liked)
                    {
                        $text = "others";
                        if($ROW['likes'] - 1 == 1)
                        {
                            $text = "other";
                        }
                        echo "<span class='text-muted;' style='text-align:left;font-size:12px;'> You and ". $ROW['likes'] - 1 ." $text liked this post. </span>";
                    }
                    else
                    {
                        echo "<span class='text-muted;' style='text-align:left;font-size:12px;'>" .$ROW['likes']. " other liked this post. </span>";
                    }
                    
                }
                echo "</a>";
            }
        ?>

    </div>
    
</div>

</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">People who Liked these posts are</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php
            if(is_array($like_details))
            {
                $user = new User();
                foreach($like_details as $row)
                {
                    $l = $user->get_user($row['userid']);

                    $like_user_img = "gallery/user_male.jpg";
                    if($l['gender'] == "Female")
                    {
                        $like_user_img = "gallery/user_female.jpg";
                    }
                    if(file_exists($l['profile_image']))
                    {
                        $like_user_img = $l['profile_image'];
                    }
                   
                   echo "<img style='width:30px;height:30px;border-radius:50%;margin:5px;' src='$like_user_img'>";
                   echo $l['first_name'] ." ". $l['last_name'] ;
                   echo "<br>";
                   
                }

            }
      ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>