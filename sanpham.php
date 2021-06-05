 
<?php
include 'server/security.php';
include 'includes/header.php';
include 'includes/navbar.php' ?>


<?php 
    
    include 'server/dbconfig.php';

    if ( isset($_GET['search']) && !empty($_GET['search'])) {

        $key = $_GET['search'];
         $query = "SELECT * FROM sanpham inner join(loaisanpham) on sanpham.idloaisp =loaisanpham.idloaisp WHERE idsp='".$key."' or tensp like '%".$key."%' or tenloaisp like '".$key."'";
    } 
    else
    {
         $query = "SELECT * FROM sanpham inner join(loaisanpham) on sanpham.idloaisp =loaisanpham.idloaisp";
    }

    $query_run = mysqli_query($connection, $query); 
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>


      </div>
      <form action="quanlisanpham.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">

          <div class="form-group">
            <label> Tên sản phẩm </label>
            <input type="text" name="tensanpham" class="form-control" >
          </div>
          <div class="form-group">
            <label>Giá sản phẩm</label>
            <input type="text" name="giasanpham" class="form-control checking_email" >
            <small class="error_email" style="color: red;"></small>
          </div>
          <div class="form-group">
            <label>Số lượng sản phẩm</label>
            <input type="text" name="soluongton" class="form-control checking_email" >
            <small class="error_email" style="color: red;"></small>
          </div>
          <div class="form-group">
            <label>Size</label>
            <select class="form-control" name="sizesanpham">
              <option value="M">M</option>
              <option value="S">S</option>
              <option value="L">L</option>
              <option value="XL">XL</option>
            </select>
          </div>
          <div class="form-group">
            <label>Hình ảnh sản phẩm</label>
            <input type="file" name="hinhanhsanpham" class="form-control">
            <img id="image" />
          </div>
          <div class="form-group">
            <label>Mô tả sản phẩm</label>
            <input type="text" name="motasanpham" class="form-control">
          </div>
          <div class="form-group">
            <label>Loại sản phẩm  </label>
            <select class="form-control"  name="loaisanpham">
              <option value="1">Áo thun phông</option>
              <option value="2">Áo thun Polo</option>
              <option value="3">Áo Sweater</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="themsanpham"  class="btn btn-primary">Save</button>
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
        <h4 class="text-center">Sản phẩm</h4>
        <hr>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
         Thêm sản phẩm
       </button>


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

      <form action="" method="get" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <input type="hidden" name="search" value="">
        <button type="submit"  class="btn btn-outline-success">
         Tất cả sản phẩm
       </button>
      </form>

      <form action="" method="get" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <input type="hidden" name="search" value="Áo THUN PHÔNG">
        <button type="submit"  class="btn btn-outline-info">
         Áo thun phông
       </button>
      </form>
      <form action="" method="get" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <input type="hidden" name="search" value="ÁO THUN POLO">
        <button type="submit"  class="btn btn-outline-warning">
         Áo thun Polo
       </button>
      </form>
      <form action="" method="get" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <input type="hidden" name="search" value="ÁO THUN LEN">
        <button type="submit"  class="btn btn-outline-dark">
         Áo thun len
       </button>
      </form>

     </div>
   </div>


   <div class="card-body">

    <?php if (isset($_SESSION['success'])) { ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success']; ?>
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
  <table class="table table-bordered" id="dataTable" width="100%" cellpadding="0">
  <thead>
    <tr>
      <th>Mã sản phẩm</th>
      <th >Tên sản phẩm</th>
      <th >Giá sản phẩm</th>
      <th >Size</th>
      <th >Hình ảnh</th>
      <th >Mô tả</th>
      <th>Số lượng hàng tồn</th>
      <th>Loại sản phẩm</th>
      <th >Edit</th>
      <th >Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    if (mysqli_num_rows($query_run) > 0) 
    {
      while ($row = mysqli_fetch_assoc($query_run)) { 
        ?>

        <tr>
          <td><?= $row['idsp'];?></td>
          <td><?=$row['tensp'];?></td>
          <td><?= $row['giasp'];?></td>
          <td><?=$row['sizesp'];?></td>
          <td><?= "<img src='".$row['hinhanhsp']."' width='80' height='100'>" ?></td>
          <td><?= $row['motasp'];?></td>
          <td>
            <?= $row['soluongton'];?>   
          </td>
          <td><?=$row['tenloaisp'];?></td>
          <td>
            <form action="sanpham_edit.php" method="POST">
              <input type="hidden" name="edit_id" value="<?php echo $row['idsp'];?>">
              <button type="submit" class="btn btn-success" name="btn_editsanpham">EDIT</button>
            </form>
          </td>
          <td>
            <form method="POST" action="quanlisanpham.php">
             <input type="hidden" name="delete_id" value="<?php echo $row['idsp'];?>">
             <button type="submit" class="btn btn-danger" name="deletesanpham" >DELETE</button>
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
