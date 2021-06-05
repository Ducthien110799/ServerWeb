<?php
	#kết nối db
	include "connect.php";

	$idtk= $_POST['idtk'];

	#Khai báo mảng
	$mangspmoinhat= array();

	#Câu truy vấn 6 sp mới nhất,lấy 6 sp từ dưới lên trên
	$query ="SELECT donhang.iddh, sanpham.tensp, chitietdonhang.soluongctdh, chitietdonhang.giactdh, donhang.ngaydathang, donhang.xacnhandh  FROM donhang INNER JOIN khachhang on donhang.idkh= khachhang.idkh INNER JOIN chitietdonhang on chitietdonhang.iddh=donhang.iddh JOIN sanpham ON sanpham.idsp=chitietdonhang.idsp
		WHERE khachhang.idkh = ".$idtk." and xacnhandh='false'";
	#móc dữ liệu
	$data = mysqli_query($conn, $query);

	#duyệt từng dòng
	while ($row =  mysqli_fetch_assoc($data)){
			#Truyền dữ liệu vào mảng
			array_push($mangspmoinhat, new Sanphammoinhat(
				$row['iddh'],
				$row['tensp'],
				$row['soluongctdh'],
				$row['giactdh'],
				$row['ngaydathang'],
				$row['xacnhandh'],));
		}	

	#Đưa dữ liệu về dạng json
	echo json_encode($mangspmoinhat);

	class Sanphammoinhat{
		function Sanphammoinhat($iddh, $tensp, $soluong, $giatien, $ngaydathang, $xacnhandh){
			$this->iddh=$iddh;
			$this->tensp= $tensp;
			$this->soluong= $soluong;
			$this->giatien= $giatien;
			$this->ngaydathang= $ngaydathang;
			$this->xacnhandh= $xacnhandh;
		}
	}
?>