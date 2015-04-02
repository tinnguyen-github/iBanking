<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TinNguyen
 * Date: 01/07/2014
 * Time: 09:19
 * To change this template use File | Settings | File Templates.
 */
include_once"condb.php";
include_once"DichVu.php";
class NhaCungCap {
    private $TenNCC;
    private $DiaChi;
    private $isUsed;
    private $SDT;
    private $Username;
    private $TenNhaCungCap;
   // private $DiaChi;
   // private $isUsed;
    private $STD;
    private $TenDangNhap;
    private $ID;

    function getNCC_LDV($LoaiDichVu)
    {
        $conn = new myDBC();
        //    $MaNCC="";
        $query=" select ID,TenNCC from NhaCungCap where ID in (select MaNCC from DichVu where LoaiDichVu =". $LoaiDichVu.")";
        $res=$conn->runQuery($query);
        return $res;
    }

    function  getNCC()
    {
        $conn = new myDBC();
        $query="select ID,TenNCC from NhaCungCap"; //where DangHopTac=1";
        $result= $conn->runQuery($query);
        return $result;
    }



    // get ...
    // set ...
    function addNCC($id,$u)
    {
        $con= new myDBC();
        $con->runQuery("

        update nhacungcap set Username= '".$u."'
         where id='".$id."'

        ");
    }
    function getIDNCC($tennhacc)
    {
        $conn=new myDBC();
        $result=mysqli_fetch_array($conn->runQuery("select ID from nhacungcap where TenNCC = '".$tennhacc."'"));

        return $result['ID'];
    }
    // function
    function showInfo($page)
    {

        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
        $con= new myDBC();

        //echo "333";
        $row_in_page = 5;
        $row_data = mysqli_num_rows($con->runQuery("SELECT * FROM nhacungcap") );
        // echo "4545654";
        $col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM nhacungcap") );
        //echo "4444";
        $num_page = ceil($row_data/$row_in_page);
        $result =$con->runQuery("SELECT * FROM nhacungcap ORDER BY ID ASC LIMIT ".($page-1)*$row_in_page.",".$row_in_page."");
        // echo "121212";
        echo'
            <table border="1">
                <tr>

                    <th>Tên NCC</th>
                    <th>Địa chỉ</th>
                    <th>SDT</th>
                    <th>Đang hợp tác </th>
                    <th>Username </th>
                      <th> </th>
                </tr>';
        while ( $info = mysqli_fetch_array($result ))
        {
            $count_field =1;
            echo '<tr>';
            while ($count_field < $col_data)
            {

                if($count_field==4)
                {
                    if($info['DangHopTac'] ==1) echo '<td>Có</td>';
                    else echo '<td>Không</td>';
                }else

                        echo "<td>".$info["$count_field"]."</td>";

                $count_field = $count_field + 1;
            }
            echo '<td><input type="button" value="Sửa thông tin"onclick="updateInfo(\''.$info["ID"].'\');">';
            if($info['DangHopTac'] ==1)
                echo '<input type="button" value="Dừng " onclick="stopNCC(\''.$info["ID"].'\');">';
            else echo '<input type="button" value="Kích hoạt" onclick="actiNCC(\''.$info["ID"].'\');">';
            echo ' </td> </tr>';
        }
        echo '</table>';
        for ( $page = 1; $page <= $num_page; $page ++ )
        {
            echo   '<a href="#" onclick="ds(3,\''.$page.'\')">'.$page.'</a>';
        }
        echo '</br><input type="button" value="Thêm mới" onclick="addNCC();">';
    }
    function getInfo($id)
    {
        $con= new myDBC();
        //$col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM nhacungcap") ) or die(mysql_error());
        $count_row = mysqli_num_rows($con->runQuery("SELECT * FROM nhacungcap where id='".$id."'"));
        $result =mysqli_fetch_array($con->runQuery("SELECT * FROM nhacungcap where id='".$id."'"));
        if($count_row!=0)
        {
            echo '
           <form name="TTNCC"> <table border="1">
                <tr>

                    <th>Tên NCC</th>
                    <th>Địa chỉ</th>
                    <th>SDT</th>

                </tr>';
            $count_field =1;
            while ($count_field < 4)
            {
                if($count_field==2)

                            echo '<td><input type="text" name = "DiaChi" placeholder="'.$result["$count_field"].'"></td>';
                else
                if($count_field==3)

                    echo '<td><input type="text" name = "SDT" placeholder="'.$result["$count_field"].'"></td>';
                else
                    echo '<td>'.$result["$count_field"].'</td>';
                      //echo '<td><input type="radio" name="isSuport" placeholder="'.$result["$count_field"].'"</td>';
                $count_field = $count_field + 1;
            }
            echo '</tr>';

            echo '</table>';
            echo '<div align="center"><input type="button" value="Cập nhật" onclick="capnhatTT(\''.$result["ID"].'\')"></div></form>';
        }
    }
    function stopNCC($id)
    {
        $con= new myDBC();
        $check = $con->runQuery("update nhacungcap set DangHopTac	= 0 where id='".$id."'");
        return $check;
    }
    function acctiNCC($id)
    {
        $con= new myDBC();
        $check = $con->runQuery("update nhacungcap set DangHopTac	= 1 where id='".$id."'");
        return $check;
    }
    function showNCC()
    {
        $con= new myDBC();
        $q=$con->runQuery("select * from nhacungcap");
        echo
        '
            <select name="MaNCC">';
        while($info= mysqli_fetch_array($q))
        {
            echo ' <option value="'.$info["ID"].'">'.$info["TenNCC"].'';
        }
        echo '  </select>  ';
    }
    function updateNCC($id,$diachi,$sdt)
    {
        $con= new myDBC();
        if($diachi!="")
        $con->runQuery("

        update nhacungcap set DiaChi= '".$diachi."'

         where id='".$id."'

        ");
        if($sdt!="")
            $con->runQuery("
        update nhacungcap set SDT= '".$sdt."'
         where id='".$id."'

        ");

    }

    function checkInfo($ID,$Ten)
    {
        $conn=new myDBC();
        $result=mysqli_fetch_array($conn->runQuery("select TenNCC from nhacungcap where ID = '".$ID."'"));
        if($Ten == $result['TenNCC'])
            return true;
        else return false;

    }


}