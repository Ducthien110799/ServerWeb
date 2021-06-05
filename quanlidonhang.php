<?php

include 'server/security.php';

include 'server/dbconfig.php';

//Include required PHPMailer files
    require 'phpmailer/includes/PHPMailer.php';
    require 'phpmailer/includes/SMTP.php';
    require 'phpmailer/includes/Exception.php';
//Define name spaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

if (isset($_POST['updatedonhang'])) {

    $id = $_POST['id_xacnhan'];
    $email_xacnhan = $_POST['email_xacnhan'];
    $tensanpham = $_POST['tensanpham'];
    $idtk = $_POST['idtk'];
    $soluongctdh = $_POST['soluongctdh'];
    $tongtien = $_POST['tongtien'];
    $phiship = $_POST['phiship'];


    $query = "UPDATE donhang JOIN chitietdonhang on donhang.iddh= chitietdonhang.iddh JOIN sanpham sanpham on sanpham.idsp=chitietdonhang.idsp set donhang.xacnhandh='true', sanpham.soluongton=(sanpham.soluongton- chitietdonhang.soluongctdh), idtk = '".$idtk."' WHERE donhang.iddh = '".$id."'";

    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        //Create instance of PHPMailer
        $mail = new PHPMailer();
    //Set mailer to use smtp
        $mail->isSMTP();
    //Define smtp host
        $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
        $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
        $mail->SMTPSecure = "ssl";
    //Port to connect smtp
        $mail->Port = "465";
    //Set gmail username
        $mail->Username = "shop.twestside@gmail.com";
    //Set gmail password
        $mail->Password = "twestside13att";
    //Email subject
        $mail->Subject = "Twestside xac nhan don hang #DH".$id."";
    //Set sender email
        $mail->setFrom('shop.twestside@gmail.com');
    //Enable HTML
        $mail->isHTML(true);
    //Attachment
        $mail->addAttachment('phpmailer/img/LOGO.png');
    //Email body
        $mail->Body = "<h3>Bạn vừa đặt sản phẩm từ chúng tôi: ".$tensanpham." </h3></br>
        <h3>Tổng tiền của quý khách là ".$tongtien." VNĐ + ".$phiship."!</h3>
        <h3>Đặt hàng thành công!</h3></br>
        <h5>Thanks for your order!</h5>";
    //Add recipient
        $mail->addAddress($email_xacnhan);
    //Finally send email
        if ( $mail->send() ) {
            $_SESSION['success'] = "Xác nhận đơn hàng thành công !";
            header("Location: dsdonhang.php");
        }else{
            $_SESSION['status'] = "Đơn hàng được xác nhận nhưng mail không chính xác, vui lòng xác nhận bằng số điện thoại!";
            header("Location: dsdonhang.php");
        }
    //Closing smtp connection
        $mail->smtpClose();


    }else{
        $_SESSION['status'] = "Xác nhận đơn hàng lỗi";
        header("Location: dsdonhang.php");
    }
}

?>