 
<?php
include 'server/security.php';
include 'includes/header.php';
include 'includes/navbar.php' ?>

<?php 
    
    include 'server/dbconfig.php';

    if ( isset($_GET['search']) && !empty($_GET['search'])) {

        $key = $_GET['search'];
        $query = "SELECT * FROM khachhang WHERE tenkh like '%".$key."%' or emailkh like '%".$key."%' or sodienthoaikh like '%".$key."%'";
    } 
    else
    {
         $query = "SELECT * FROM khachhang";
    }

    $query_run = mysqli_query($connection, $query); 
?>

<div class="container-fluid">

  <!-- Data Example --->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="m-0 font-weight-bold text-primary">
        <h4 class="text-center">Danh sách khách hàng</h4>
        <hr>
        
      <!-- Topbar Search -->
            <form action="" method="get" 
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-white border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2" name="search">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
          </form>

     </div>
   </div>
   <div class="card-body">

    <?php if (isset($_SESSION['success'])) { ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success']; ?>
      </div>
    <?php } ?>


    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellpadding="0">
        <thead>
          <tr>
            <th>IDKH</th>
            <th >Tên khách hàng</th>
            <th >Email </th>
            <th >Địa chỉ</th>
            <th >Số điện thoại</th>
            
          </tr>
        </thead>
        <tbody>
          <?php 
          if (mysqli_num_rows($query_run) > 0) 
          {
            while ($row = mysqli_fetch_assoc($query_run)) { 
              ?>

              <tr>
                <td><?= $row['idkh'];?></td>
                <td><?=$row['tenkh'];?></td>
                <td><?= $row['emailkh'];?></td>
                <td><?=$row['diachikh'];?></td>
                <td><?=$row['sodienthoaikh'];?></td>
                
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
