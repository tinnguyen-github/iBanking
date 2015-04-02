<?php
include_once 'condb.php';

class NhatKyGiaoDich {
	
	private $ThoiGianGD;
	private $SoTienGD;
	private $NoiDungGD;
	public function NhatKyGiaoDich(){}
	public function addNhatKy($SoTienGD,$LoaiGD,$NoiDungGD,$TKDen,$TKDi){
       /* $con = new myDBC();
            $ID=1;
		$now=date("Y-m-d H:i:s");

			$sql ="select max(ID) as max from NhatKyGiaoDich";
			$result=$con->runQuery($sql);
			$data=mysql_fetch_array($result);
			if($data!=null) $ID+=$data["max"];
			
			$query="insert into NhatKyGiaoDich(ID,ThoiGian,SoTienGD,LoaiGiaoDich,NoiDungGiaoDich,TKTrichNo,TKGhiNo)"
					."values(".$ID.",'".$now.",".$SoTienGD.",".$LoaiGD.",'".$NoiDungGD."',".$TKDi.",".$TKDen.")";
			$result=$con->runQuery($query);
			if($result) return true;
			else return false;*/
        //$ID=1;
        $con = new myDBC();
        $now=date("Y-m-d H:i:s");

        //	$sql ="select max(ID) as max from NhatKyGiaoDich";
        //	$result=mysql_query($sql);
        //	$data=mysql_fetch_array($result);
        //if($data!=null) $ID+=$data["max"];

        $query="insert into NhatKyGiaoDich values(null,'".$now."',".$SoTienGD.",".$LoaiGD.",'".$NoiDungGD."',".$TKDi.",".$TKDen.")";
        $result=$con->runQuery($query);
        if($result) return true;
        else return false;

	}
	public function getNhatKyGiaoDich($STK)
	{
		//select *from nhatkygiaodich where TKGhiNo=10520270 or TKTrichNo=10520270;
		$conn = new myDBC();
		$query="select * from NhatKyGiaoDich where TKGhiNo=".$STK." or TKTrichNo=".$STK." order by ThoiGian desc;";
		$result=$conn->runQuery($query);
		
			//$data=mysql_fetch_array($result);
			return $result;
		//if($data)
		//return $data;
		//else return 0;
		
	}
	public  function getSoTienGDThang(){}
	public function getSoTienGDNgay(){}
}

?>