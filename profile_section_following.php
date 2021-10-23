<?php 
                  
  $post_class = new Post();
  $user_class = new User();
  $following = $user_class->get_following($user_data['userid'],"user");
?>



<div class="col-md-8">
    <h4>Followings</h4>
    <div class="card mb-3">
        <div class="card-body">
        <?php 
            if(is_array($following))
            {
                foreach($following as $follower)
                {
                    $FRIEND_ROW = $user_class->get_user($follower['userid']);
                    include("friendslist.php");
                }
            }
            else{
                echo "This User isn't following anyone!!!";
            }
            
        ?>
            <hr>
        </div>
    </div>
</div>