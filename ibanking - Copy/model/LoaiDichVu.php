<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TinNguyen
 * Date: 01/07/2014
 * Time: 09:49
 * To change this template use File | Settings | File Templates.
 */
include_once "condb.php";
class LoaiDichVu {

    function getLDV()
    {
        $conn = new myDBC();
        $query="select *from LoaiDichVu";
        $result=$conn->runQuery($query);
        return $result;
    }
    private $LoaiDichVu;
    private $TenDichVu;

    //set ..
    function setLoaiDV($LDV)
    {
        $this->LoaiDichVu=$LDV;
    }
    function setTenDV($TDV)
    {
        $this->TenDichVu=$TDV;
    }

    //get...

    function getmaldv($mota)
    {
        $con= new myDBC();
        $q=mysqli_fetch_array($con->runQuery("select ID from loaidichvu where MoTa = '".$mota."'"));
        return $q['ID'];
    }
    //function ...
    function showInfo($page)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
        $con= new myDBC();
        $row_in_page = 5;
        $row_data = mysqli_num_rows($con->runQuery("SELECT * FROM loaidichvu") ) or die(mysql_error());
        $col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM loaidichvu") ) or die(mysql_error());
        $num_page = ceil($row_data/$row_in_page);
        $result =$con->runQuery("SELECT mota FROM loaidichvu ORDER BY ID ASC LIMIT ".($page-1)*$row_in_page.",".$row_in_page."") or die(mysql_error());
        echo '
            <table border="1">
                <tr>

                    <th>Loại dịch vụ</th>

                </tr>';
        while ( $info = mysqli_fetch_array($result ))
        {
            // $count_field =0;
            echo '<tr>';
            // while ($count_field < $col_data)
            //{
            echo "<td>".$info["mota"]."</td>";

            // $count_field = $count_field + 1;
//            }
            echo'</tr>';
        }
        echo '</table>';
        for ( $page = 1; $page <= $num_page; $page ++ )
        {
            echo   '<a href="#" onclick="ds(2,\''.$page.'\')">'.$page.'</a>';
        }
        echo '</br><input type="button" value="Thêm mới" onclick="addLDV();">';
    }

    function addLDV($mota)
    {
        $con= new myDBC();
        $row_count= mysqli_num_rows($con->runQuery("select * from loaidichvu"));
        $q= mysqli_fetch_array($con->runQuery("select MoTa from loaidichvu where Mota = '".$mota."'"));
        if($mota == $q['MoTa']) return false;
        else{
            $con->runQuery("insert into loaidichvu values ('".($row_count+1)."','".$mota."')");
            return true;
        }
    }
    function showLDV()
    {
        $con= new myDBC();
        $q=$con->runQuery("select * from loaidichvu");
        echo
        '
            <select name="MaLDV">';
        while($info= mysqli_fetch_array($q))
        {
            echo ' <option value="'.$info["ID"].'">'.$info["MoTa"].'';
        }
        echo '  </select>  ';
    }
}