<?php 
  include 'server/dbconfig.php';

  $query = "SELECT * FROM sanpham inner join(loaisanpham) on sanpham.idloaisp =loaisanpham.idloaisp";
  $query_run = mysqli_query($connection, $query); 
  ?>
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