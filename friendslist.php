<?php 
        $images = "gallery/user_male.jpg";
        if($FRIEND_ROW['gender'] == "Female")
        {
            $images = "gallery/user_female.jpg";
        }
        if(file_exists($FRIEND_ROW['profile_image']))
        {
            $images = $FRIEND_ROW['profile_image'];
        }
?>
<div style="margin:10px 0 20px 0;">
    <div class="d-flex dfkj">
        <a href="profile.php?section=default&id=<?php echo $FRIEND_ROW['userid']; ?>" style="text-decoration:none;color:grey;">
            <div style="display:flex;">
                <div class="lkt40">
                <img style="" src="<?php echo $images ?>">
                </div>
                <div>
                <?php echo $FRIEND_ROW['first_name']. " " .$FRIEND_ROW['last_name'] ?>
                </div>
            </div>
        </a>
    </div>
</div>