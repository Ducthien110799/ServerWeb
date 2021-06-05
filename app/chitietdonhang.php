<?php
	include "connect.php";
	$json = $_POST['json'];

	$data = json_decode($json, true);

	//đọc dữ liệu json
	foreach ($data as  $value) {
		$iddh = $value['iddh'];
		$idsp = $value['idsp'];
		$soluongctdh = $value['soluongctdh'];
		$giactdh = $value['giactdh'];	

		$query = "INSERT INTO chitietdonhang(iddh, idsp,soluongctdh, giactdh) values (".$iddh.", ".$idsp.",".$soluongctdh.",".$giactdh.")";

		$Dta = mysqli_query($conn, $query);
	}

	if ($Dta == true) {
		echo "1";
	}else{
		echo "0";
	}



?>