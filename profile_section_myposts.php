<?php 
                  
  $DB = new Database();
  $sql = "select image,postid,likes,post from posts where userid = '$user_data[userid]' order by id desc";
  $result = $DB->read($sql);
  $msg = "";
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
        $user = new User();
        $user->delete($_POST);
        $msg = "Post Deleted Successfully";
  }
            
?>

<div class="col-md-8">
    <h4>My Posts</h4>
    <div style="color:red;text-align:center;margin:30px auto">
          <?php 
          if($msg != ""){
              echo $msg;
          }
          ?>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <?php if($result) { ?>
                <div class='row'>

                <?php foreach($result as $rows){ ?>

                <a href='' data-toggle='modal' data-target='#<?php echo $rows["postid"]?>'>
                <div class='col-sm'>
                <img src='<?php echo $rows["image"] ?>' style='width:200px;height:200px;margin:2px;'>
                </div>
                </a>
                <!-- Modal -->
                <div class="modal fade" id="<?php echo $rows["postid"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <?php
                        $likee = "Likes(".$rows['likes'].")";
                        echo "<p style='font-size:18px;'>Caption : <em>$rows[post]</em></p>";
                        echo "<img src='$rows[image]' style='width:400px;height:400px;margin:2px;'>";
                        echo "<br><p style='font-size:18px;margin:2px;'><i class='fa fa-heart' style='color:blue'></i>$likee</p>"
                    ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $rows["postid"]?>" name="pid">            
                            <?php 
                                if($user_data['userid'] == $_SESSION['nsl_userid'])
                                {
                                    echo "<input type='submit' class='btn btn-danger' value='Delete Post'>";
                                }
                            ?>
                        </form>
                    </div>
                    
                    </div>
                </div>
                </div>

                <?php } ?>

                </div>
            <?php 
            } 
            else
            {
                echo "No posts!!!";
            }  
            ?>
            <hr>
        </div>
    </div>
</div>




