<?php

include 'server/security.php';

$connection = mysqli_connect("localhost", "root","","aothun");

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    if($password === $cpassword)
    {
        $query = "INSERT INTO taikhoan (idtk,tentaikhoan,matkhautk, emailtk, loaitaikhoan) 
        VALUES ('','$username','$password','$email','$usertype')";
        $query_run = mysqli_query($connection, $query);
        
        if($query_run)
        {
                // echo "Saved";
            $_SESSION['success'] = "Admin Profile Added";
            header('Location: dsadmin.php');
        }
        else 
        {
            $_SESSION['status'] = "Admin Profile Not Added";
                // $_SESSION['status_code'] = "error";
            header('Location: index.php');  
        }
    }
    else 
    {
        $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            // $_SESSION['status_code'] = "warning";
        header('Location: admin.php');  
    }
    // }

}



if (isset($_POST['updatebtn'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $usertype = $_POST['update_usertype'];

    $query = "UPDATE taikhoan SET tentaikhoan = '$username', emailtaikhoan='$email', matkhautaikhoan='$password', loaitaikhoan='$usertype' WHERE idtaikhoan = '$id'";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Update Success";
        header("Location: dsadmin.php");
    }else{
        $_SESSION['status'] = "You data is Not update";
        header("Location: dsadmin.php");
    }
}

if (isset($_POST['deletebtn'])) {
    $id = $_POST['delete_id'];

    $query ="DELETE FROM taikhoan WHERE idtaikhoan = '$id'";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Delete Success";
        header('Location: dsadmin.php');
    }
    else{
        $_SESSION['status'] = "your data is NOT delete";
        header("Location: dsadmin.php");
    }
}


if (isset($_POST['login_btn'])) {

    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query = "SELECT * FROM taikhoan WHERE emailtk = '$email_login' and matkhautk = '$password_login'";

    $query_run = mysqli_query($connection, $query);
    $usertypes = mysqli_fetch_array($query_run);
    if ($usertypes['loaitaikhoan'] == 'admin')
    {       
        $_SESSION['username'] = $email_login;
        header('Location: admin.php');
    }
    else if ($usertypes['loaitaikhoan'] == 'user') {
        $_SESSION['username'] = $email_login;
        header('Location: user.php');
    }else
    {
        $_SESSION['status'] = "Email/Password Invalid";
        header("Location: login.php");
    }
}

if(isset($_POST['themsanpham']))
{
    $tensanpham = $_POST['tensanpham'];
    $giasanpham = $_POST['giasanpham'];
    $size = $_POST['sizesanpham'];
    $hinhanhsanpham = $_POST['hinhanhsanpham'];
    $motasanpham = $_POST['motasanpham'];
    $loaisanpham = $_POST['loaisanpham'];

    $query = "INSERT INTO sanpham (tensanpham,giasanpham,size, hinhanhsanpham,motasanpham,soluonghangton ,idloaisanpham) VALUES ('$tensanpham','$giasanpham','$size','$hinhanhsanpham','$motasanpham','20','$loaisanpham')";
    $query_run = mysqli_query($connection, $query);
   
    if($query_run)
    {
                // echo "Saved";
        $_SESSION['success'] = "Admin Profile Added";
        header('Location: sanpham.php');
    }
    else 
    {
        $_SESSION['status'] = "Admin Profile Not Added";
                // $_SESSION['status_code'] = "error";
        header('Location: sanpham.php');  
    }
}

?>