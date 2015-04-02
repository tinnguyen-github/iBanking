<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tung
 * Date: 16/06/2014
 * Time: 19:14
 * To change this template use File | Settings | File Templates.
 */
include_once "condb.php";
class NgoaiTe {
    private $NgoaiTe;
    private $GiaMua;
    private $GiaBan;
    private $DonVi;
    function setNgoaiTe($NT)
    {
        $this->NgoaiTe=$NT;
    }
    function getGiaBan($ID)
    {
        $con = new myDBC();
        $q= mysqli_fetch_array($con->runQuery("select GiaBan from ngoaite where ID = '".$ID."'"));
        return $q['GiaBan'];
    }
    function getGiaMua($ID)
    {
        $con = new myDBC();
        $q= mysqli_fetch_array($con->runQuery("select GiaMua from ngoaite where ID = '".$ID."'"));
        return $q['GiaMua'];
    }
    function getDonVi($ID)
    {
        $con = new myDBC();
        $q= "select DonVi from ngoaite where ID = '".$ID."'";
        $result = $con->runQuery($q);
        $data= mysqli_fetch_array($result);
        return $data['DonVi'];
    }
    function getLNT()
    {
        $con = new myDBC();
        $q=$con->runQuery("select * from ngoaite");
        echo '<select name="LNT" onchange="showText()"><option value="0">Chọn loại giao dịch</option>';
        while ($result =  mysqli_fetch_array($q))
        {
            if($result["DonVi"]!=VND) echo' <option value="'.$result["ID"].'">'.$result["DonVi"].'</option>';
        }
        echo '</select>';
    }

    function showInfo($page)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
        $con= new myDBC();
        $row_in_page = 5;
        $row_data = mysqli_num_rows($con->runQuery("SELECT * FROM ngoaite") ) ;
        $col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM ngoaite"));
        $num_page = ceil($row_data/$row_in_page);
        $result =$con->runQuery("SELECT * FROM ngoaite ORDER BY ID ASC LIMIT ".($page-1)*$row_in_page.",".$row_in_page."") or die(mysql_error());
        echo '
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Đơn vị</th>
                    <th>Giá mua</th>
                    <th>Giá bán</th>
                    <th></th>
                </tr>';
        while ( $info = mysqli_fetch_array($result ))
        {
            $count_field =0;
            echo '<tr>';
            while ($count_field < $col_data)
            {
                echo '<td><input disabled  id="'.$info["ID"].$count_field.'" type="text" value = "'.$info["$count_field"].'"</td>';
                $count_field = $count_field + 1;
            }
            echo '<td><div id="CNTG"><input type="button" id="'.$info["ID"].'update" value="Cập nhật tỷ giá" onclick="capnhattygia(\''.$info["ID"].'\');"></div>';
            echo ' </td> </tr>';
        }
        echo '</table>';
        for ( $page = 1; $page <= $num_page; $page ++ )
        {
            echo   '<a href="#" onclick="ds(\''.$page.'\')">'.$page.'</a>';
        }
    }
    function updateTyGia($id,$giamua,$giaban)
    {
        $con= new myDBC();
        $q= $con->runQuery("update ngoaite set GiaMua = '".$giamua."',GiaBan= '".$giaban."' where ID= '".$id."' ");
        return $q;
    }


}