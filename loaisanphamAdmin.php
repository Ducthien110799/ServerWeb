 
<?php
include 'server/security.php';
include 'includes/header.php';
include 'includes/navbar.php' ?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

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
          <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
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
        <h4 class="text-center">Loại Sản phẩm</h4>
        <hr>
      

     </div>
   </div>
   <div class="card-body">

    <?php if (isset($_SESSION['success'])) { ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success']; ?>
      </div>
    <?php } ?>


    <div class="table-responsive">
      <?php 
      include 'server/dbconfig.php';

      $query = "SELECT * FROM loaisanpham";
      $query_run = mysqli_query($connection, $query); 
      ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellpadding="0">
        <thead>
          <tr>
            <th>Mã loại</th>
            <th >Tên loại sản phẩm</th>
            <th >Hình ảnh</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if (mysqli_num_rows($query_run) > 0) 
          {
            while ($row = mysqli_fetch_assoc($query_run)) { 
              ?>

              <tr>
                <td><?= $row['idloaisp'];?></td>
                <td><?=$row['tenloaisp'];?></td>
                <td><?= "<img src='".$row['hinhanhloaisp']."' width='60' height='70'>" ?></td>
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
