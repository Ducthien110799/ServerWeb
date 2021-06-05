<?php
    header('Content-Type: application/json');
    include 'server/dbconfig.php';
    
    if(!$conn){
        die("Connect database failed");
    }
    $data = array();
    $query = "SELECT loaisanpham.tenloaisp as status, sum(chitietdonhang.soluongctdh) AS size_status FROM sanpham JOIN loaisanpham on sanpham.idloaisp = loaisanpham.idloaisp INNER join chitietdonhang on chitietdonhang.idsp=sanpham.idsp JOIN donhang ON donhang.iddh=chitietdonhang.iddh
WHERE donhang.xacnhandh like 'true'
GROUP BY sanpham.idloaisp";
    $stmt = $conn->prepare($query);
    if($stmt->execute()){
        if($stmt->rowCount()>0){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    foreach($result as $row){
        $data[] = $row;
    }
    echo json_encode($data);
?>