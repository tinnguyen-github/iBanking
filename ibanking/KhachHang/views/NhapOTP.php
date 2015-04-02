<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
$LoaiGD = $_POST["LoaiGD"];
$SLNhap =  $_POST["SLNhap"];
if($LoaiGD==4)
    {

        echo '  Để thực hiện giao dịch quý khách vui lòng nhập mã OTP( One Time Password) mà khách hàng nhận được:
                <br><input type="text" name="OTP" placeholder="Nhập mã OTP vào đây"><br>
                <input type="button" value="Xác nhận 1" onclick="Xacnhan(4,\''.$SLNhap.'\')">
               ';
    }
if($LoaiGD==5)
{
    echo '
                Để thực hiện giao dịch quý khách vui lòng nhập mã OTP( One Time Password) mà ngân hàng gửi qua SDT quý khách đã đăng kýk:
                <br><input type="text" name="Nhap_OTP" placeholder="Nhập mã OTP vào đây"><br>
                <input type="button" value="Xác nhận 2" onclick="Xacnhan(5,\''.$SLNhap.'\')">
                ';
}
?>


