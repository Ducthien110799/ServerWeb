<?php
    header('Content-Type: application/json');
    include 'server/dbconfig.php';
    
    if(!$conn){
        die("Connect database failed");
    }
    $data = array();
    $query = "SELECT loaisanpham.tenloaisp as status, COUNT(sanpham.idloaisp) AS size_status FROM sanpham JOIN loaisanpham on sanpham.idloaisp = loaisanpham.idloaisp GROUP BY sanpham.idloaisp";
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