<?php
	# kết nối db
	include 'server/security.php';

	$connection = mysqli_connect("localhost", "root","","aothun");


	$mangsanpham = array(); #khai báo mảng

	//câu truy vấn
	$query = "SELECT donhang.iddh, tenkh, hinhthucthanhtoan, diachigiaohang, sum(soluongctdh*giactdh) as 'tong', xacnhandh FROM (((donhang inner join(chitietdonhang) on donhang.iddh =chitietdonhang.iddh) inner join(sanpham) on sanpham.idsp =chitietdonhang.idsp) inner join(khachhang) on khachhang.idkh =donhang.iddh) group BY soluongctdh, giactdh";
	$data = mysqli_query($connection,$query);

	#duyệt từng dòng
	while ($row = mysqli_fetch_assoc($data)) {
			#Truyền dữ liệu vào mảng
			array_push($mangsanpham, new Sanpham(
				$row['iddh'],
				$row['tenkh'],
				$row['hinhthucthanhtoan'],
				$row['diachigiaohang'],
				$row['tong'],
				$row['xacnhandh'],
				));
		}	

	#Đưa dữ liệu về dạng json
	echo json_encode($mangsanpham);


	class Sanpham{
		function Sanpham($iddh, $tenkh, $hinhthucthanhtoan, $diachigiaohang, $sum, $xacnhan){
			$this->iddh=$iddh;
			$this->tenkh= $tenkh;
			$this->hinhthucthanhtoan= $hinhthucthanhtoan;
			$this->diachigiaohang= $diachigiaohang;
			$this->tongtien= $sum;
			$this->xacnhan= $xacnhan;
		}
	}
?>