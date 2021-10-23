<div class="col-md-8">
    <div class="card mb-3">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">First Name</h6>
          </div>
          <div class="col-sm-9 text-secondary">
            <?php  echo $user_data['first_name']  ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Last Name</h6>
          </div>
          <div class="col-sm-9 text-secondary">
          <?php  echo $user_data['last_name']  ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Email</h6>
          </div>
          <div class="col-sm-9 text-secondary">
          <?php echo $user_data['email']  ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">Gender</h6>
          </div>
          <div class="col-sm-9 text-secondary">
          <?php  echo $user_data['gender']  ?>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-sm-3">
            <h6 class="mb-0">About</h6>
          </div>
          <div class="col-sm-9 text-secondary">
          <?php  echo $user_data['about']  ?>
          </div>
        </div>
        <hr>
      </div>
    </div>
    </div>