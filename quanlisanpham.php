<?php

include 'server/security.php';


include 'server/dbconfig.php';

if (isset($_POST['updatesanpham'])) {
    $id = $_POST['edit_idsp'];
    $tensp = $_POST['edit_tensp'];
    $motasp = $_POST['edit_motasp'];
    $soluongton = $_POST['edit_soluongton'];
    $giasp = $_POST['edit_giasp'];


    $query = "UPDATE sanpham SET tensp = '$tensp', motasp='$motasp', soluongton='$soluongton',giasp='$giasp' WHERE idsp = '$id'";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Cập nhật sản phẩm thành công";
        header("Location: sanpham.php");
    }else{
        $_SESSION['status'] = "Cập nhật sản phẩm thất bại";
        header("Location: sanpham.php");
    }
}

if (isset($_POST['deletesanpham'])) {
    $id = $_POST['delete_id'];

    $query ="DELETE FROM sanpham WHERE idsp = '$id'";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Sản phẩm đã được xóa";
        header('Location: sanpham.php');
    }
    else{
        $_SESSION['status'] = "Lỗi";
        header("Location: sanpham.php");
    }
}



if(isset($_POST['themsanpham']))
{
    $tensanpham = $_POST['tensanpham'];
    $giasanpham = $_POST['giasanpham'];
    $size = $_POST['sizesanpham'];
    $soluongton = $_POST['soluongton'];
    $hinhanhsanpham = $_FILES["hinhanhsanpham"]['name'];
    $motasanpham = $_POST['motasanpham'];
    $loaisanpham = $_POST['loaisanpham'];        


    $query = "INSERT INTO sanpham (idsp,tensp, motasp, hinhanhsp, sizesp, soluongton, giasp, idloaisp) VALUES ('','$tensanpham','$motasanpham','http://shoptwestside.000webhostapp.com/server/admin/upload/$hinhanhsanpham','$size','$soluongton','$giasanpham','$loaisanpham')";
    $query_run = mysqli_query($connection, $query);
   
    if($query_run)
    {
         $file = $_FILES['hinhanhsanpham']['tmp_name'];
            $path = "upload/".$_FILES['hinhanhsanpham']['name'];
            if(move_uploaded_file($file, $path)){
                echo "Tải tập tin thành công";
            }else{
                echo "Tải tập tin thất bại";
            }
        $_SESSION['success'] = "Thêm sản phẩm thàn công";
        header('Location: sanpham.php');
    }
    else 
    {
        $_SESSION['status'] = "Thêm sản phẩm thất bại";
                // $_SESSION['status_code'] = "error";
        header('Location: sanpham.php');  
    }
    }


?>