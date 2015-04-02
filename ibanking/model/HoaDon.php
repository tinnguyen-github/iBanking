<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TinNguyen
 * Date: 01/07/2014
 * Time: 10:56
 * To change this template use File | Settings | File Templates.
 */
include_once("condb.php");
include_once("DichVu.php");
class HoaDon {

    function getDSHoaDon($LoaiDV,$NCC,$MaKH)
    {
        $conn= new myDBC();
        $query=
            "select *from hoadon where madichvu in
                                            (select madichvu
                                             from dichvu
                                             where MaNCC='".$NCC."'
                                             and LoaiDichVu=".$LoaiDV.")
                                             and MaKhachHang='".$MaKH."'";
        $res=$conn->runQuery($query);
        return $res;
    }
    function ThanhToanHoaDon($TKThanhToan,$MaNCC,$MaHoaDon)
    {

        try
        {
            $conn= new myDBC();
            $query="call ThanhToanHoaDon('".$TKThanhToan."','".$MaNCC."',".$MaHoaDon.",@KQ); ";

            $result=$conn->runQuery($query);
            //$rs2 = mysql_query("select @KetQua as KetQua;");
            $query="select @KetQua as KetQua;";
            $result=$conn->runQuery($query);
            if($result)
            {
                $KetQua = mysqli_fetch_array($result);
                //print_r($total);
                return $KetQua["KetQua"];
            }
            else return false;

        }
        catch (Exception $e) {
            echo 'Has eror: '.$e->getMessage();
        }

    }

}