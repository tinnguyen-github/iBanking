<?php
include_once"../model/condb.php";
include_once "../model/NhatKyGiaoDich.php";
require "php-export-data.class.php";

$excel = new ExportDataExcel('browser');
$excel->filename = "test.xls";
$STK=$_GET["STK"];

$temp=new NhatKyGiaoDich();
$res=$temp->getNhatKyGiaoDich($STK);
/*
$clsNews = new News();
$lstItem = $clsNews->getAll(""); // Lấy toàn bộ dữ liệu*/

if(!empty($res)){
    $myArr=array("Thời gian","Số tiền","Nội dung","Tài khoản đến","Tài khoản đi");
    $excel->initialize();
    $excel->addRow($myArr);
    #
    //foreach($res as $item)
    while($item=mysqli_fetch_array($res))
    {

        $myArr=array($item["ThoiGian"],$item["SoTienGD"],$item["NoiDungGiaoDIch"],$item["TKGhiNo"],$item["TKTrichNo"]);
        $excel->addRow($myArr);

    }
    $excel->finalize();
   // echo '<script>alert("In Thành công!")</script>';
}
else
    echo '<script>alert("Có lỗi")</script>';
?>