<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tung
 * Date: 15/06/2014
 * Time: 01:43
 * To change this template use File | Settings | File Templates.
 */
include_once "../../../model/condb.php";
$loaikh= $_POST["kh"];
$tenkh=  $_POST["tenkh"];

$con = new myDBC();
//echo "wdadsa".$loaikh.$tenkh;
if($loaikh=="KHCN")
{
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;

    $page = $_GET['page'];
    if ( !$_GET['page'] )
    {
        $page = 1 ;
    }
    $row_in_page = 5;
    $row_data = mysqli_num_rows($con->runQuery("SELECT * FROM khachhang where HoTen like '%".$tenkh."%'") );
    if($row_data < 1) echo 'Không tìm được khách hàng phù hợp';
    else
    {
    $col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM khachhang") ) or die(mysql_error());
    $num_page = ceil($row_data/$row_in_page);
    $result =$con->runQuery("SELECT * FROM khachhang where HoTen like '%".$tenkh."%' ORDER BY ID ASC") or die(mysql_error());
    echo '
            <table border="1">
                <tr>
                    <th>Mã khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Giới tính</th>
                    <th>Số điẹn thoại</th>
                    <th>Email</th>
                    <th>Tên tài khoản</th>
                    <th>Ngày sinh</th>
                    <th>CMND</th>
                    <th></th>
                </tr>';
    while ( $info = mysqli_fetch_array($result ))
    {
        $count_field =0;
        echo '<tr>';
        while ($count_field < $col_data)
        {
            if($count_field == 3  )
            {
                if($info["$count_field"]== 1) echo "<td>Nam</td>";
                else echo "<td>Nữ</td>";
            }
            else echo "<td>".$info["$count_field"]."</td>";

            $count_field = $count_field + 1;
        }
        echo '<td><input type="button" value="Sửa TT">
            <input type="button" value="Hủy TK">
            <input type="button" value="Mở khóa"></td> </tr>';


    }
    echo '</table>';

    }
}
if($loaikh=="KHTC")
{
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
   // include_once "../model/condb.php";

    $row_data = mysqli_num_rows($con->runQuery("SELECT * FROM khachhangtochuc where TenDoanhNghiep LIKE '%".$tenkh."%'") );
    if($row_data < 1) echo 'Không tìm được tỏ chức phù hợp';
    else
    {
    $col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM khachhangtochuc") );
    $num_page = ceil($row_data/$row_in_page);
    $result =$con->runQuery("SELECT * FROM khachhangtochuc where TenDoanhNghiep LIKE '%".$tenkh."%' ORDER BY ID ASC ");
    echo '
        <table border="1">
            <tr>
                <th>Mã khách hàng</th>
                <th>Tên tổ chức</th>
                <th>Địa chỉ</th>
                <th>Số điẹn thoại</th>
                <th>Tên tài khoản</th>
                <th>Số đăng ký kinh doanh</th>
                <th></th>
            </tr>';
    while ( $info = mysqli_fetch_array($result ))
    {
        $count_field =0;
        echo '<tr>';
        while ($count_field < $col_data)
        {
            echo "<td>".$info["$count_field"]."</td>";

            $count_field = $count_field + 1;
        }
        echo '<td><input type="button" value="Sửa thông tin">
            <input type="button" value="Hủy tài khoản">
            <input type="button" value="Mở khóa"></td> </tr>';


    }
    echo '</table>';

    }
}
?>