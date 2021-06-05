<?php

	include "connect.php";
	$iddh = $_POST['iddh'];
	$idkh = $_POST['idkh'];
	$hinhthucthanhtoan= $_POST['hinhthucthanhtoan'];
	$diachigiaohang = $_POST['diachigiaohang'];
	$phivanchuyen = $_POST['phivanchuyen'];
	$ngaydathang = $_POST['ngaydathang'];
	

	$query = "INSERT INTO donhang(iddh, idkh,hinhthucthanhtoan, diachigiaohang, phivanchuyen,xacnhandh,idtk, ngaydathang) VaLUES (".$iddh.", ".$idkh.",'".$hinhthucthanhtoan."','".$diachigiaohang."','".$phivanchuyen."','false',1,'".$ngaydathang."')";
	if (mysqli_query($conn, $query)) {
		$iddonghang = $conn->insert_id;
		echo "$iddonghang";
	}else{
		echo "Thất bại";
	}
	
?>