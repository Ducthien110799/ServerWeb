<?php

	include "connect.php";
	
	$email = $_GET['email'];
	$password = $_GET['password'];
	$mangsanpham = array(); #khai báo mảng

	$sql = "select * from khachhang where emailkh='".$email."' and matkhaukh= '".$password."'";
	$result = $conn -> query($sql);

	if($result -> num_rows > 0){

		#duyệt từng dòng
		while ($row = mysqli_fetch_assoc($result)) {
				#Truyền dữ liệu vào mảng
				array_push($mangsanpham, new Taikhoan(
					$row['idkh'],
					$row['tenkh'],
					$row['matkhaukh'],
					$row['emailkh'],
					$row['diachikh'],
					$row['sodienthoaikh']));
			}	

		#Đưa dữ liệu về dạng json
		echo json_encode($mangsanpham);
	}
	else{
		echo json_encode($mangsanpham);;
	}

	class Taikhoan{
			function Taikhoan($idkh, $tenkh, $matkhaukh, $emailkh, $diachikh, $sodienthoai){
				$this->idkh=$idkh;
				$this->tenkh= $tenkh;
				$this->matkhaukh= $matkhaukh;
				$this->emailkh= $emailkh;
				$this->diachikh= $diachikh;
				$this->sodienthoai= $sodienthoai;
			}
		}

?>