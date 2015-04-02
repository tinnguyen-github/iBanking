<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tung
 * Date: 14/06/2014
 * Time: 17:36
 * To change this template use File | Settings | File Templates.
 */
include_once "condb.php";
class KhachHangToChuc {
    function showInfo($page)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
        $conn=new myDBC();

        $row_in_page = 5;
        $row_data = mysqli_num_rows($conn->runQuery("SELECT * FROM khachhangtochuc") ) or die(mysql_error());
        $col_data =  mysqli_num_fields($conn->runQuery("SELECT * FROM khachhangtochuc") ) or die(mysql_error());
        $num_page = ceil($row_data/$row_in_page);
        $result =$conn->runQuery("SELECT * FROM khachhangtochuc ORDER BY ID ASC LIMIT ".($page-1)*$row_in_page.",".$row_in_page."") or die(mysql_error());
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
            echo '<td><input type="button" value="Sửa thông tin"onclick="SuaTT(\''.$info["ID"].'\');">
            <input type="button" value="Hủy tài khoản" onclick="HuyTK(\''.$info["username"].'\');">
            <input type="button" value="Mở khóa" onclick="MoKhoa(\''.$info["username"].'\');"></td> </tr>';


        }
        echo '</table>';
        for ( $page = 1; $page <= $num_page; $page ++ )
        {
            echo   '<a href="#" onclick="ds(2,\''.$page.'\')">'.$page.'</a>';
            //echo "<a href='?page_khcn=".($page+1)."'style='text-decoration: none'>".($page+1)."</a>";
        }
    }
    function getInfo($id)
    {

        $conn=new myDBC();
        $col_data =  mysqli_num_fields($conn->runQuery("SELECT * FROM khachhangtochuc") ) or die(mysql_error());
        $count_row = mysqli_num_rows($conn->runQuery("SELECT * FROM khachhangtochuc where id='".$id."'"));
        $result =mysqli_fetch_array($conn->runQuery("SELECT * FROM khachhangtochuc where id='".$id."'"));
        if($count_row!=0)
        {
        echo '
          <form name="TTTC">  <table border="1">
                <tr>
                    <th>Mã khách hàng</th>
                    <th>Tên tổ chức</th>
                    <th>Địa chỉ</th>
                    <th>Số điẹn thoại</th>
                    <th>Tên tài khoản</th>
                    <th>Số đăng ký kinh doanh</th>

                </tr>';
        $count_field =0;
        while ($count_field < $col_data)
        {
            if($count_field==2) echo '<td><input type="text" name = "Diachi" placeholder="'.$result["$count_field"].'"></td>';
            else
            echo "<td>".$result["$count_field"]."</td>";

            $count_field = $count_field + 1;
        }
        echo ' </tr></table><input type="button" value="Cập nhật" onclick="capnhatTT(\''.$result["ID"].'\',\'Sua_khtc\')"></div></form>';
        }
    }
    public function getTenTC($ID)
    {
        $conn=new myDBC();
        $sql="select * from khachhangtochuc where ID = '".$ID."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data['TenDoanhNghiep'];
    }
    public function getID($Hoten)
    {
        $conn=new myDBC();
        $sql="select ID from khachhangtochuc where TenDoanhNghiep = '".$Hoten."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data["ID"];
    }
    function checkInfo($ChuTK,$TenDv,$SDK)
    {
        $conn=new myDBC();
        $result=mysqli_fetch_array($conn->runQuery("select * from khachhangtochuc where ID = '".$ChuTK."'"));
        if($TenDv==$result['TenDoanhNghiep'] && $SDK ==$result["SoDangKyKinhDoanh"]) return true;
        else  return false;
    }
    function setUser($user,$id)
    {
        $conn=new myDBC();
        $conn->runQuery("update khachhangtochuc set username = '".$user."' where id = '".$id."'");
    }
    function delAcc($user)
    {
        $conn=new myDBC();
        $conn->runQuery("SET foreign_key_checks = 0");
        $check = $conn->runQuery("update khachhangtochuc set username = '' where username = '".$user."'") or die(mysql_errno());
        $conn->runQuery('SET foreign_key_checks = 1');
        return $check;
    }
    function updateInfo($id,$diachi)
    {
        $conn=new myDBC();
        $check = $conn->runQuery("update khachhangtochuc set DiaCHi = '".$diachi."' where id = '".$id."'") or die(mysql_errno());

    }

    public function getTenTCFUser($user)
    {
        $conn=new myDBC();
        $sql="select * from khachhangtochuc where username = '".$user."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data['TenDoanhNghiep'];
    }
    public function getSoDKKDFUser($user)
    {
        $conn=new myDBC();
        $sql="select * from khachhangtochuc where username = '".$user."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data['SoDangKyKinhDoanh'];
    }
}
?>