<?php
	
	#kết nối db
	include "connect.php";

	#Khai báo mảng
	$mangspmoinhat= array();

	#Câu truy vấn 6 sp mới nhất,lấy 6 sp từ dưới lên trên
	$query ="SELECT * FROM sanpham";
	#móc dữ liệu
	$data = mysqli_query($conn, $query);

	#duyệt từng dòng
	while ($row =  mysqli_fetch_assoc($data)){
			#Truyền dữ liệu vào mảng
			array_push($mangspmoinhat, new Sanphammoinhat(
				$row['idsp'],
				$row['tensp'],
				$row['motasp'],
				$row['hinhanhsp'],
				$row['giasp'],
				$row['idloaisp']));
		}	

	#Đưa dữ liệu về dạng json
	echo json_encode($mangspmoinhat);

	class Sanphammoinhat{
		function Sanphammoinhat($idsp, $tensp, $motasp, $hinhanhsp, $giasp, $idloaisanpham){
			$this->idsp=$idsp;
			$this->tensp= $tensp;
			$this->motasp= $motasp;
			$this->hinhanhsp= $hinhanhsp;
			$this->giasp= $giasp;
			$this->idloaisp= $idloaisanpham;
		}
	}
?>