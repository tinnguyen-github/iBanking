<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TinNguyen
 * Date: 02/07/2014
 * Time: 01:19
 * To change this template use File | Settings | File Templates.
 */
include_once"../model/condb.php";

$STK=$_POST["STK"];
checkBelong($STK);

function checkBelong($STK)
{
    $con=new myDBC();
    $query="select STK from taikhoannganhang where MaiBanking='".$_SESSION["TKiBanking"]."'";
    $res=$con->runQuery($query);
    $SoTK="";
    $isBelong = "false";
    while($data=mysqli_fetch_array($res))
    {
        $SoTK=$data["STK"];
        if($SoTK==$STK)
        {

            $isBelong= "true";
            break;
        }
        //else return false;
    }
 //   return $isBelong;
    echo $isBelong;
}

?>