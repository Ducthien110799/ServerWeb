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
if (isset($_POST['btn_edit'])) // name của button edit
{
	include 'server/dbconfig.php';
	$id = $_POST['edit_id'];


	$query = "SELECT * FROM taikhoan WHERE idtk ='$id'" ;

	$query_run = mysqli_query($connection, $query);

	foreach ($query_run as $row) {
		?>
		<form action="quanlitaikhoan.php" method="POST">
			<input type="hidden" name="edit_id" value="<?php echo $row['idtk']?>">
			<div class="form-group">
				<label> Username </label>
				<input type="text" name="edit_username" class="form-control" value="<?php echo $row['tentk']?>" placeholder="Enter Username">
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" name="edit_email" value="<?php echo $row['emailtk']?>" class="form-control checking_email" placeholder="Enter Email">
				<small class="error_email" style="color: red;"></small>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="edit_password" value="<?php echo $row['matkhautk']?>" class="form-control" placeholder="Enter Password">
			</div>
			<div class="form-group">
				<label>User Type   </label>
				<select name="update_usertype"  class="form-control">
					<option value="admin">Admin</option>
					<option value="user">User</option>
				</select> 
			</div>
			<div >
				<a href="sanpham.php" class="btn btn-danger">CANCEL</a>
				<button type="submit" name="updatetaikhoan" class="btn btn-primary">UPDATE</button>
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
