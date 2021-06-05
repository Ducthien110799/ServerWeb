<?php
	include "connect.php";
	$tenkh = $_POST['tenkh'];
	$matkhaukh = $_POST['matkhaukh'];
	$emailkh = $_POST['emailkh'];
	$diachikh = $_POST['diachi'];
	$sodienthoaikh = $_POST['sodienthoai'];

	$query = "INSERT INTO khachhang(idkh, tenkh, matkhaukh, emailkh, diachikh, sodienthoaikh) VALUES (null,'".$tenkh."','".$matkhaukh."','".$emailkh."','".$diachikh."','".$sodienthoaikh."')" ;
	if (mysqli_query($conn, $query)) {
		echo "1";
	}else{
		echo "0";
	}

?>