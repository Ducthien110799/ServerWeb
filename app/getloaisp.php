<?php
	#gọi lại file kết mối
	include "connect.php";

	#câu truy vấn
	$query = "SELECT * FROM loaisanpham"; 
	$data = mysqli_query($conn, $query);

	$mangloaisp = array();

	#đọc từng dòng data
	while ($row =  mysqli_fetch_assoc($data)){
		array_push($mangloaisp, new Loaisp(
			$row['idloaisp'], 
			$row['tenloaisp'], 
			$row['hinhanhloaisp']));
	}

	# đổ dữ liệu về json
	echo json_encode($mangloaisp);

	class Loaisp{
		function Loaisp($idloaisp, $tenloaisp, $hinhanhloaisp){
			$this->idloaisp = $idloaisp;
			$this->tenloaisp = $tenloaisp;
			$this->hinhanhloaisp= $hinhanhloaisp; 
		}
	}

?>