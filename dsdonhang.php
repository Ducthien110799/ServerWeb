 
<?php
include 'server/security.php';
include 'includes/header.php';
include 'includes/navbar.php' ?>

<?php 
      include 'server/dbconfig.php';

      if ( isset($_GET['search']) && !empty($_GET['search'])) {

        $key = $_GET['search'];
        $query = "SELECT donhang.iddh, khachhang.tenkh,khachhang.sodienthoaikh, sanpham.tensp, chitietdonhang.soluongctdh, donhang.ngaydathang, donhang.diachigiaohang ,SUM(chitietdonhang.soluongctdh*chitietdonhang.giactdh) AS tong, donhang.xacnhandh, khachhang.emailkh,donhang.phivanchuyen FROM donhang INNER JOIN chitietdonhang on donhang.iddh= chitietdonhang.iddh INNER JOIN khachhang on khachhang.idkh=donhang.idkh INNER JOIN sanpham on sanpham.idsp=chitietdonhang.idsp WHERE donhang.iddh='".$key."' or tenkh like '%".$key."%' or emailkh like '%".$key."%' or donhang.ngaydathang like '%".$key."%' or donhang.xacnhandh='".$key."' or month(donhang.ngaydathang) = '".$key."' GROUP BY chitietdonhang.soluongctdh, chitietdonhang.giactdh, donhang.iddh ";
      }else {

        $query = "SELECT donhang.iddh, khachhang.tenkh,khachhang.sodienthoaikh, sanpham.tensp, chitietdonhang.soluongctdh,donhang.ngaydathang, donhang.diachigiaohang ,SUM(chitietdonhang.soluongctdh*chitietdonhang.giactdh) AS tong, donhang.xacnhandh, khachhang.emailkh, donhang.phivanchuyen FROM donhang INNER JOIN chitietdonhang on donhang.iddh= chitietdonhang.iddh INNER JOIN khachhang on khachhang.idkh=donhang.idkh INNER JOIN sanpham on sanpham.idsp=chitietdonhang.idsp GROUP BY chitietdonhang.soluongctdh, chitietdonhang.giactdh, donhang.iddh";
    }
    $query_run = mysqli_query($connection, $query); 

?>

<div class="container-fluid">

  <!-- Data Example --->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <div class="m-0 font-weight-bold text-primary">
        <h3 class="text-center">Danh sách đơn hàng</h3>
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
      <form action="" method="get" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
           <input type="date" name="search" >
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="submit">Thống kê</button>
            </div>         
        </div>
      </form>

       <form action="" method="get" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
           <input type="month" name="search" >
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="submit">Thống kê</button>
            </div>         
        </div>
      </form>

      <form action="" method="get" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
           <input type="hidden" name="search" value="false" >
            <div class="input-group-append">
                <button class="btn btn-outline-danger" type="submit">Đơn hàng chưa xác nhận</button>
            </div>         
        </div>
      </form>

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
      <table class="table table-bordered" id="dataTable" width="100%" cellpadding="0">
        <thead>
          <tr>
            <th>IDDH</th>
            <th>Tên khách hàng</th>
            <th>SĐT khách hàng</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Ngày đặt hàng</th>
            <th>Địa chỉ giao hàng</th>
            <th>Tổng tiền</th>
            <th>XÁC NHẬN</th>
            
          </tr>
        </thead>
        <tbody>
          <?php 
          if (mysqli_num_rows($query_run) > 0) 
          {
            while ($row = mysqli_fetch_assoc($query_run)) { 
              ?>
              <tr>
                <td><?php echo $row['iddh'];?></td>
                <td><?php echo $row['tenkh'];?></td>
                <td><?php echo $row['sodienthoaikh'];?></td>
                <td><?php echo $row['tensp'];?></td>
                <td><?php echo $row['soluongctdh'];?></td>
                <td><?php echo $row['ngaydathang'];?></td>
                <td><?php echo $row['diachigiaohang'];?></td>
                <td><?php echo number_format($row['tong']);?></td>
                <td>
                  <form action="quanlidonhang.php" method="POST">
                   <input type="hidden" name="idtk" value="<?php if (isset($_SESSION['idtk'])) { ?>
                                                                                        <?php echo  $_SESSION['idtk'] ?>  
                                                                                    <?php } ?>" >
                    <input type="hidden" name="id_xacnhan" value="<?php echo $row['iddh'];?>">
                    <input type="hidden" name="email_xacnhan" value="<?php echo $row['emailkh'];?>">
                    <input type="hidden" name="tensanpham" value="<?php echo $row['tensp'];?>">
                    <input type="hidden" name="soluongctdh" value="<?php echo $row['soluongctdh'];?>">
                    <input type="hidden" name="tongtien" value="<?php echo number_format($row['tong']);?>">
                    <input type="hidden" name="phiship" value="<?php echo $row['phivanchuyen'];?>">

                    <?php if ( $row['xacnhandh'] == 'true') { ?>
                     <img src="https://img.icons8.com/bubbles/50/000000/double-tick.png"/>
                    <?php }
                    else{ ?>
                        <button  class="btn btn-success" name="updatedonhang">XÁC NHẬN</button>
                    <?php } ?>
                    
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
