<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tung
 * Date: 16/06/2014
 * Time: 19:13
 * To change this template use File | Settings | File Templates.
 */

class NhatKyGiaoDich {
    private $ID;
    private $ThoiGian;
    private $SoTienGD;
    private $LoaiGiaoDich	;
    private $NoiDungGiaoDIch;
    private $TKTrichNo;
    private $TKGhiNo;


    function setThoiGian($ThoiGian)
    {
        $this->ThoiGian=$ThoiGian;
    }
    function setSoTienGD($SoTienGD)
    {
        $this->SoTienGD=$SoTienGD;
    }
    function setLoaiGiaoDich($LoaiGiaoDich)
    {
        $this->LoaiGiaoDich=$LoaiGiaoDich;
    }
    function setNoiDungGiaoDIch($NoiDungGiaoDIch)
    {
        $this->NoiDungGiaoDIch=$NoiDungGiaoDIch;
    }
    function setTKTrichNo($TKTrichNo)
    {
        $this->TKTrichNo=$TKTrichNo;
    }
    function setTKGhiNo($TKGhiNo)
    {
        $this->TKGhiNo=$TKGhiNo;
    }

    function insNKGD()
    {
        include_once "condb.php";
        $con=new myDBC();
        //$num_row = mysqli_num_rows($con->runQuery("select * from nhatkygiaodich"))+1;
        $q=$con->runQuery("insert into nhatkygiaodich values(null,'".$this->ThoiGian."',".$this->SoTienGD.",".$this->LoaiGiaoDich.",'".$this->NoiDungGiaoDIch."',".$this->TKTrichNo.",".$this->TKGhiNo.")");
        return $q;
    }

}
?>