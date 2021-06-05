<?php

include 'server/security.php';

include 'server/dbconfig.php';

if(isset($_POST['themtaikhoan']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    $email_query = "SELECT * FROM taikhoan WHERE emailtk = '".$email."'";
    $email_query_run = mysqli_query($connection, $email_query);

    if (mysqli_num_rows($email_query_run)>0) {
        $_SESSION['status'] = "Email ".$email." đã tồn tại, vui lòng sử dụng email khác !";
            header('Location: dsadmin.php');
    }else{
        if($password === $cpassword)
        {
            $query = "INSERT INTO taikhoan (idtk,tentk,matkhautk, emailtk, loaitaikhoan) 
            VALUES ('','".$username."','".$password."','".$email."','".$usertype."')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                    // echo "Saved";
                $_SESSION['success'] = "Thêm tài khoản ".$username." thành công";
                header('Location: dsadmin.php');
            }
            else 
            {
                $_SESSION['status'] = "Thêm tài khoản thất bại";
                    // $_SESSION['status_code'] = "error";
                header('Location: dsadmin.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Xác nhận mật khẩu không trùng khớp";
                // $_SESSION['status_code'] = "warning";
            header('Location: dsadmin.php');  
        }
      }

}



if (isset($_POST['updatetaikhoan'])) {
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $usertype = $_POST['update_usertype'];
    

    $query = "UPDATE taikhoan SET tentk = '$username', emailtk='$email', matkhautk='$password', loaitaikhoan='$usertype' WHERE idtk = '$id'";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['success'] = "Cập nhật tài khoản thành công !";
        header("Location: dsadmin.php");
    }else{
        $_SESSION['status'] = "You data is Not update";
        header("Location: dsadmin.php");
    }
}

if (isset($_POST['deletetaikhoan'])) {

    $id = $_POST['delete_id'];

    $query_delete ="SELECT * FROM taikhoan WHERE idtk = ".$id." AND loaitaikhoan='user'";
    $query_run_delete = mysqli_query($connection, $query_delete);


    if (mysqli_num_rows($query_run_delete)>0) {

        $query ="DELETE FROM taikhoan WHERE idtk = '".$id."'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "Tài khoản đã được xóa";
            header('Location: dsadmin.php');
        }else{
            $_SESSION['status'] = "Tài khoản đang có đơn hàng";
            header('Location: dsadmin.php');
        }
    }
    else{
        $_SESSION['status'] = "Tài khoản chỉ xóa khi là user";
        header('Location: dsadmin.php');
    }

}

if (isset($_POST['login_btn'])) {

    $email_login = $_POST['email'];
    $password_login = $_POST['password'];

    $query = "SELECT * FROM taikhoan WHERE emailtk = '$email_login' and matkhautk = '$password_login'";

    $query_run = mysqli_query($connection, $query);

    $usertypes = mysqli_fetch_array($query_run);  

    $result = $connection -> query($query);

    if($result -> num_rows > 0){

        #duyệt từng dòng
        while ($row = mysqli_fetch_assoc($result)) {

            if ($usertypes['loaitaikhoan'] == 'admin')
            {       
                $_SESSION['emailtk'] = $email_login;
                $_SESSION['idtk'] = $row['idtk'];
                header('Location: dasboad.php');
            }
            else if ($usertypes['loaitaikhoan'] == 'user') {
                $_SESSION['idtk'] = $row['idtk'];
                $_SESSION['emailtk'] = $email_login;
                header('Location: dashboard_user.php');
            }
        }
    } else
            {
                $_SESSION['status'] = "Email/Password Invalid";
                header("Location: index.php");
            }
}
?>