<?php
	# kết nối db
	include "connect.php";

	$page = $_GET['page'];
	$idloaisp = $_POST['idloaisanpham'];
	$space = 6; #mỗi lần load trả về 5 sản phẩm
	$limit = ($page - 1 )* $space;  #xác định vị trí đọc

	$mangsanpham = array(); #khai báo mảng

	//câu truy vấn
	$query = "SELECT * FROM sanpham WHERE idloaisp = $idloaisp limit $limit,$space";
	$data = mysqli_query($conn,$query);

	#duyệt từng dòng
	while ($row = mysqli_fetch_assoc($data)) {
			#Truyền dữ liệu vào mảng
			array_push($mangsanpham, new Sanpham(
				$row['idsp'],
				$row['tensp'],
				$row['motasp'],
				$row['hinhanhsp'],
				$row['giasp'],
				$row['idloaisp']));
		}	

	#Đưa dữ liệu về dạng json
	echo json_encode($mangsanpham);


	class Sanpham{
		function Sanpham($idsp, $tensp, $motasp, $hinhanhsp, $giasp, $idloaisanpham){
			$this->idsp=$idsp;
			$this->tensp= $tensp;
			$this->motasp= $motasp;
			$this->hinhanhsp= $hinhanhsp;
			$this->giasp= $giasp;
			$this->idloaisp= $idloaisanpham;
		}
	}
?>