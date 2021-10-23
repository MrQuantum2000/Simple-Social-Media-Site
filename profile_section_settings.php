<?php 
                  
  $settings_class = new Settings();
  $settings = $settings_class->get_settings($_SESSION['nsl_userid']);
  $msg="";$msg1="";
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $result = $settings_class->evaluate_settings($_POST);
    if($result == "")
    {
        $settings_class->save_settings($_POST,$_SESSION['nsl_userid']);
        $msg1 = "Updated Successfully!!!";
    }
    else
    {
      $msg=$result;
    }
  }
?>
 


<div class="col-md-8">
    <h4>Settings</h4>
    <div style="color:red;text-align:center;margin:30px auto">
          <?php 
          if($msg != ""){
              echo $msg;
          }
          else
          {
            echo $msg1;
          }
          ?>
    </div>
    <div class="card mb-3">
        <div class="card-body">
        <form method="post">
        <?php 
           if(is_array($settings))
           {
                $gender="";$gender1="";
                if($settings['gender'] == "Male")
                {
                    $gender = "Male";
                    $gender1 = "Female";
                }
                else if($settings['gender'] == "Female")
                {
                    $gender = "Female";
                    $gender1 = "Male";
                }
                echo "<div class='form-group'>";
                echo  "<input type='text' class='form-control' name='first_name' value='$settings[first_name]' placeholder='Enter First name'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo  "<input type='text' class='form-control' name='last_name' value='$settings[last_name]' placeholder='Enter Last name'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<input type='email' class='form-control' name='email' value='$settings[email]' placeholder='Enter email'>";
                echo "</div>";
                echo "<div class='input-group mb-3'>";
                echo  "<div class='input-group-prepend'>";
                echo "<label class='input-group-text' for='inputGroupSelect01'>Gender</label>";
                echo  "</div>";
                echo  "<select class='custom-select' id='inputGroupSelect01' name='gender'>";
                echo    "<option value='$gender'>$gender</option>";
                echo    "<option value='$gender1'>$gender1</option>";
                echo "</select>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<input type='password' name='password' class='form-control' value='$settings[password]' placeholder='Password'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<input type='password' name='cpassword' class='form-control' value='$settings[password]' placeholder='Password'>";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<br><h6>About Me:</h6><br><textarea name='about' cols='70' rows='5'>$settings[about]</textarea>";
                echo "</div>";
                echo "<input type='submit' class='btn btn-primary' value='Update'>";
           }
        ?>
        </form>
            <hr>
        </div>
    </div>
</div>

 