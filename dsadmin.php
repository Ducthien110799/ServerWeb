 
<?php
include 'server/security.php';
include 'includes/header.php';
include 'includes/navbar.php' ?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Thông tin tài khoản</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>


      </div>
      <form action="quanlitaikhoan.php" method="POST">

        <div class="modal-body">

          <div class="form-group">
            <label> Username </label>
            <input type="text" name="username" class="form-control" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
            <small class="error_email" style="color: red;"></small>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter Password">
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password">
          </div>

          <input type="hidden" name="usertype" value="admin">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="themtaikhoan" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

  <!-- Data Example --->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="m-0 font-weight-bold text-primary">
        <h4 class="text-center">Danh sách tài khoản</h4>
        <hr>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
         Thêm tài khoản
       </button>

       <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            
     </div>
   </div>
   <div class="card-body">
   
       <?php if (isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                      <?php echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                        ?>
                    </div>
                  <?php } ?>
    <?php if (isset($_SESSION['status'])) { ?>
                    <div class="alert alert-danger" role="alert">
                      <?php echo $_SESSION['status']; 
                        unset($_SESSION['status']);
                        ?>
                    </div>
                  <?php } ?>
          

    <div class="table-responsive">
      <?php 
      include 'server/dbconfig.php';

      $query = "SELECT * FROM taikhoan";
      $query_run = mysqli_query($connection, $query); 
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellpadding="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>User Type</th>
            <th>EDIT</th>
            <th>DELETE</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if (mysqli_num_rows($query_run) > 0) 
          {
            while ($row = mysqli_fetch_assoc($query_run)) { 
              ?>
              <tr>
                <td><?php echo $row['idtk'];?></td>
                <td><?php echo $row['tentk'];?></td>
                <td><?php echo $row['emailtk'];?></td>
                <td><?php echo $row['matkhautk'];?></td>
                <td><?php echo $row['loaitaikhoan'];?></td>
                <td>
                  <form action="admin_edit.php" method="POST">
                    <input type="hidden" name="edit_id" value="<?php echo $row['idtk'];?>">
                    <button type="submit" class="btn btn-success" name="btn_edit"> EDIT </button>
                  </form>
                </td>
                <td>
                  <form action="quanlitaikhoan.php" method="POST">
                    <input type="hidden" name="delete_id" value="<?php echo $row['idtk'];?>">
                    <button type="submit" class="btn btn-danger" name="deletetaikhoan"> DELETE </button>
                  </form>
                </td>
              </tr>

             <?php
           }  
        }else{
          echo "No record found";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


</div>




<?php
include 'includes/scripts.php';
include'includes/footer.php'
?>
