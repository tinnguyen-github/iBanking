<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TinNguyen
 * Date: 01/07/2014
 * Time: 10:18
 * To change this template use File | Settings | File Templates.
 */
include_once "condb.php";
class DichVu {

    function getMaNCC($LoaiDichVu)

    {
        $conn= new myDBC();
        $query="select MaNCC from DichVu where DichVu=".$LoaiDichVu;
        $res=$conn->runQuery($query);
        return $res;
    }
    private $isSupported;
    private $MaNCC;
    private $LoaiDV;
    private $ID;

    // get ......
    function getLDV()
    {
        return $this->LoaiDV;
    }
    function getID()
    {
        return $this->ID;
    }
   /* function getMaNCC()
    {
        return $this->MaNCC;
    }*/
    function getisSupported()
    {
        return $this->isSupported;
    }

    // set ....
    function setLoaiDV($LoaiDV)
    {
        $this->LoaiDV=$LoaiDV;
    }
    function setMaNCC($MaNCC)
    {
        $this->MaNCC=$MaNCC;
    }
    function setisSupported($isSupported)
    {
        $this->isSupported=$isSupported;
    }
    function setID($id)
    {
        $this->ID=$id;
    }

    // function...

    function addDichVu()
    {
        $con = new myDBC();
        $id=1;
        $row_data = mysqli_num_rows($con->runQuery("SELECT * FROM dichvu") );
        $id = $id + $row_data;
        $check = $con->runQuery("insert into dichvu values('".$this->MaNCC."','".$this->LoaiDV."','".$this->isSupported."','".$id."')");
        return $check;
    }

    function showInfo($page)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
        $con= new myDBC();

        $row_in_page = 4;
        $row_data = mysqli_num_rows($con->runQuery("SELECT * FROM dichvu") ) ;
        $col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM dichvu"));
        $num_page = ceil($row_data/$row_in_page);
        $result =$con->runQuery("SELECT * FROM dichvu ORDER BY ID ASC LIMIT ".($page-1)*$row_in_page.",".$row_in_page."") or die(mysql_error());
        echo '
            <table border="1">
                <tr>

                    <th>Tên NCC</th>
                    <th>Tên loại dịch vụ</th>
                    <th>isSupported</th>
                    <th></th>
                </tr>';
        while ( $info = mysqli_fetch_array($result ))
        {
            $count_field =0;
            echo '<tr>';
            while ($count_field < $col_data)
            {
                if($count_field==0){
                    $res =mysqli_fetch_array($con->runQuery("SELECT * FROM nhacungcap where id='".$info['MaNCC']."'"));
                    echo '<td>'.$res['TenNCC'].'</td>';
                }else
                    if($count_field==1){
                        $res =mysqli_fetch_array($con->runQuery("SELECT * FROM loaidichvu where id='".$info['LoaiDichVu']."'"));
                        echo '<td>'.$res['MoTa'].'</td>';
                    }else
                        if($count_field==2)
                        {
                            if($info['isSupported'] ==1) echo '<td><input type="button" value="Dừng" onclick="stopDV(\''.$info["ID"].'\');">';
                            else echo '<td><input type="button" value="Kích hoạt" onclick="actiDV(\''.$info["ID"].'\');">';
                        }
                $count_field = $count_field + 1;
            }
         /*   if($info['isSupported'] ==1)
                echo '<td><input type="button" value="Dừng" onclick="stopDV(\''.$info["ID"].'\');">';
            else echo '<td><input type="button" value="Kích hoạt" onclick="actiDV(\''.$info["ID"].'\');">';*/
            echo ' </td> </tr>';
        }
        echo '</table>';
        for ( $page = 1; $page <= $num_page; $page ++ )
        {
            echo   '<a href="#" onclick="ds(1,\''.$page.'\')">'.$page.'</a>';
        }
        echo '</br><input type="button" value="Thêm mới" onclick="addDV();">';
    }
    function getInfo($id)
    {
        $con= new myDBC();
        $col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM dichvu") ) or die(mysql_error());
        $count_row = mysqli_num_rows($con->runQuery("SELECT * FROM dichvu where id='".$id."'"));
        $result =mysqli_fetch_array($con->runQuery("SELECT * FROM dichvu where id='".$id."'"));
        if($count_row!=0)
        {
            echo '
           <form name="TTCN"> <table border="1">
                <tr>
                    <th>Mã NCC</th>
                    <th>Tên NCC</th>
                    <th>Tên LDV</th>
                    <th>isSupported</th>

                </tr>';
            $count_field =0;
            while ($count_field < $col_data-1)
            {
                if($count_field==1){
                    $res =$con->runQuery("SELECT * FROM nhacungcap where id='".$result['MaNCC']."'");
                    echo '<td>'.$res['TenNCC'].'</td>';
                }else
                    if($count_field==2){
                        $res =$con->runQuery("SELECT * FROM loaidichvu where id='".$result['LoaiDichVu']."'");
                        echo '<td>'.$res['MoTa'].'</td>';
                    }else
                        if($count_field==3){
                            echo '<td><input type="radio" name="isSuport" placeholder="'.$result['isSupported'].'"</td>';

                        }else
                            echo "<td>".$result["$count_field"]."</td>";

                $count_field = $count_field + 1;
            }
            echo '</tr>';

            echo '</table>';
            echo '<div align="center"><input type="button" value="Cập nhật" onclick="capnhatTT(\''.$result["ID"].'\')"></div></form>';
        }
    }
    function stopDichVu()
    {
        $con= new myDBC();
        $check = $con->runQuery("update dichvu set isSupported	= 0 where id='".$this->ID."'");
        return $check;
    }
    function updateDichVu()
    {
        $con= new myDBC();
        $check = $con->runQuery("update dichvu set isSupported	= 1 where id='".$this->ID."'");
        return $check;
    }
}