<?php 
                  
  $post_class = new Post();
  $user_class = new User();
  $followers = $post_class->get_like_details($user_data['userid'],"user");
?>



<div class="col-md-8">
    <h4>Followers</h4>
    <div class="card mb-3">
        <div class="card-body">
        <?php 
            if(is_array($followers))
            {
                foreach($followers as $follower)
                {
                    $FRIEND_ROW = $user_class->get_user($follower['userid']);
                    include("friendslist.php");
                }
            }
            else{
                echo "No followers were found!";
            }
            
        ?>
            <hr>
        </div>
    </div>
</div>