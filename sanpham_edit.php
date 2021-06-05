<?php session_start(); 
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container-fluid">

	<!-- Data Example --->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary text-center">Edit Admin Profile

			</h6>
		</div>
		<div class="card-body">

<?php 

	//btn edit
if (isset($_POST['btn_editsanpham'])) // name của button edit
{
	include 'server/dbconfig.php';
	$id = $_POST['edit_id'];


	$query = "SELECT * FROM sanpham inner join(loaisanpham) on sanpham.idloaisp =loaisanpham.idloaisp  WHERE idsp ='$id'" ;

	$query_run = mysqli_query($connection, $query);

	foreach ($query_run as $row) {
		?>
		<form action="quanlisanpham.php" method="POST"  enctype="multipart/form-data">
			
			<input type="hidden" name="edit_idsp" value="<?php echo $row['idsp']?>">
			<div class="form-group">
				<label> Tên sản phẩm </label>
				<input type="text" name="edit_tensp" class="form-control" value="<?php echo $row['tensp']?>" placeholder="Enter Username">
			</div>
			<div class="form-group">
				<label>Mô tả sản phẩm</label>
				<input type="text" name="edit_motasp" value="<?php echo $row['motasp']?>" class="form-control checking_email" placeholder="Enter Email">
				<small class="error_email" style="color: red;"></small>
			</div>
			<div class="form-group">
				<label>Hình ảnh sản phẩm</label>
				<?= "<img src='upload/".$row['hinhanhsp']."' width='80' height='100' value='sad' >" ?>
			</div>
			
			<div class="form-group">
            <label>Size sản phẩm</label>
            <input type="" readonly="true" class="form-control" value="<?php echo $row['sizesp']?>">
          </div>
          <div class="form-group">
				<label>Số lượng tồn</label>
				<input type="text" name="edit_soluongton" value="<?php echo $row['soluongton']?>" class="form-control" placeholder="Enter Password">
			</div>
			<div class="form-group">
				<label>Giá sản phẩm</label>
				<input type="Giá sản phẩm" name="edit_giasp" value="<?php echo $row['giasp']?>" class="form-control" placeholder="Enter Password">
			</div>
			 <div class="form-group">
            <label>Loại sản phẩm</label>
            <input type="text" readonly="true" class="form-control"  name="edit_loaisanpham" value="<?php echo $row['tenloaisp']?>">
              
          </div>
			<div >
				<a href="sanpham.php" class="btn btn-danger">CANCEL</a>
				<button type="submit" name="updatesanpham" class="btn btn-primary">UPDATE</button>
			</div>
			
		</form>
		<?php
	}
} ?>
</div>
</div>
</div>

<?php
include 'includes/scripts.php';
include'includes/footer.php'
?>
