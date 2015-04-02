<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
$page = $_POST["page"];
$id = $_POST["id"];
$GiaMua= $_POST['giamua'];
$GiaBan= $_POST['giaban'];
if($page)
{
    include_once "../model/NgoaiTe.php";
    $NgoaiTe = new NgoaiTe();
    $NgoaiTe->showInfo($page);
}
if($id)
{
    include_once "../model/NgoaiTe.php";
    $NgoaiTe = new NgoaiTe();
    //$NgoaiTe->setID($id);
    //$NgoaiTe->setGiaBan($GiaBan);
    //$NgoaiTe->setGiaMua($GiaMua);
    $check_update= $NgoaiTe->updateTyGia($id,$GiaMua,$GiaBan);
    if($check_update)
    {
        echo '<script>alert("Cập nhật thành công");ds(1);</script>';
    }
    else  echo '<script>alert("Cập nhật thất bại, phát sinh lỗi hệ thống");ds(1);</script>';

}
?>