<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tung
 * Date: 16/06/2014
 * Time: 19:13
 * To change this template use File | Settings | File Templates.
 */
include_once "condb.php";
class LoaiGiaoDich {
    function getLGD()
    {

        $q=mysql_query("select * from loaigiaodich");
        echo '<select name="LGD"><option value="0">Chọn loại giao dịch</option>';
        while ($result =  mysql_fetch_array($q))
        {
           echo' <option value="'.$result["ID"].'">'.$result["MoTa"].'</option>';
        }
        echo '</select>';
    }
    function showLGD()
    {
        $con= new myDBC();
        $q=$con->runQuery("select * from loaigiaodich");
        echo
        '
            <select name="MaLDV">';
        while($info= mysqli_fetch_array($q))
        {
            echo ' <option value="'.$info["ID"].'">'.$info["MoTa"].'';
        }
        echo '  </select>  ';
    }
    function getMota($id)
    {
        $conn=new myDBC();
        $sql="select * from loaigiaodich where ID = '".$id."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data['MoTa'];
    }
}