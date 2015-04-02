<?php

include_once "condb.php";
include_once "NgoaiTe.php";
//$conn = new connect();
//$conn=$conn->conn;
//$conn=connect();
//$conn1= new connect();
//$conn= $conn1->connectdb();
//$conn=new connect();
//$conn = new myDBC();
class TKNganHang {
	//public $conn = new connect();
	
	private $STK;
	private $SoDu;
	private $NgayMo;
	private $DVTT;
    private $MaiBanking;


 function ChuyenKhoan($TKDi,$TKDen,$SoTien,$NoiDung)
	{
		/*
		 -- Ket Qua
			-- 1 : So DU Khong du 
			-- 2: Tai Khoan Den Khong Ton Tai
			-- 3: Qua Han Muc
			-- 4 : Khong update TK DI Duoc 
			-- 5 K Update TK Nhan Dc
			-- 0 Thanh cong!
		 */
		try 
		{	
			$conn= new myDBC();
			$query="call ChuyenTien(".$TKDi.",".$TKDen.",".$SoTien.",'".$NoiDung."',@KetQua); ";
			
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
			else return null;
			//$mysqli= new mysqli();
			/*$conn= new myDBC();
			$query="CALL ChuyenTien(?,?,?,?,@KetQua)";
			$call =
			$call->bind_param('iiii',$TKDi,$TKDen,$SoTien,$NoiDung);
			$call->execute();
			
			$select = $mysqli->query('SELECT @KetQua');
			$result = $select->fetch_assoc();
			$KetQua     = $result['@KetQua'];
			return $KetQua;*/
	//	$mysqli=new mysqli("localhost","root", "","iBanking");
	//	$sts=$mysqli->prepare("CALL ChuyenTien(?,?,?,?,@KetQua)") or die($mysqli->error);
			//$sts->bind_param($stmt, $types, $var1)
		} 
		catch (Exception $e) {
			echo 'Has eror: '.$e->getMessage();
		}
		
	}

	
	public function exists($STK)
	{
		$conn = new myDBC();
		$query="select STK from taikhoannganhang where STK=".$STK."";
		$result=$conn->runQuery($query);
		
		if(!$result) return false;
		else
		{
			$data=mysqli_fetch_array($result);
			if($data["STK"]!=null) return true;
			else return false;
		}
	
	}
	public function TKNganHang(){}
	public function updateSoDu($STK,$SoTien,$Gui)
	{
		$conn= new myDBC();
		if ($Gui==true)
		
		$sql="update TaiKhoanNganHang set SoDu=SoDu+".$SoTien."where SoTK='".$STK."'";
		else 
			$sql= "update TaiKhoanNganHang set SoDu=SoDu-".$SoTien."where SoTK='".$STK."'";
		$res=$conn->runQuery($sql);
		if($res==false) return false;
		else return true;
	}
	
	public function getSoDu($STK)
	{
		$conn = new myDBC();
		$sql="select SoDu from taikhoannganhang where STK='".$STK."'";
		$res=$conn->runQuery($sql);
		$data=mysqli_fetch_array($res);
		return $data["SoDu"];
	}
	
	public function getTKNganHang($username)
	{
		$conn= new myDBC();
		//echo $conn->mysqli->host_info;
		//echo $username;
		$username = $conn->clearText($username);
		$query="select * from taikhoannganhang where MaiBanking='".$username."'";
		$result=$conn->runQuery($query);
	
		if($result== false) return false;
		else
		{
			
			while($row = mysqli_fetch_array($result))
			echo "<option value='".$row['STK']."'>".$row['STK']."</option>";
				
		}

	}
    function getNgTe($MaiBanking)
    {
        $con= new myDBC();

        $q="select * from taikhoannganhang where MaiBanking = '".$MaiBanking."'";
        $result = $con->runQuery($q);
        echo '<select name="TKNgTe" onchange="showText()">
                <option value="0">Chọn tài khoản ngoại tệ</option>';

        while ($data = mysqli_fetch_array($result) )
        {
            $Ngoaite= new NgoaiTe();
            //$Ngoaite->setNgoaiTe($result['DonViTienTe']);
            $DonVi = $Ngoaite->getDonVi($data['DonViTienTe']);
           if($data["DonViTienTe"]!=1)
                echo' <option value="'.$data["STK"].'">'.$data["STK"].'-'.$DonVi.'</option>';
        }
        echo '</select>';
        //echo $MaiBanking;
    }
    function getNoite($MaiBanking)
    {
        $con= new myDBC();

        $q="select * from taikhoannganhang where MaiBanking = '".$MaiBanking."'";
        $result = $con->runQuery($q);
        echo '<select name="TKNoiTe">
                <option value="0">Chọn tài khoản VND</option>';

        while ($data = mysqli_fetch_array($result) )
        {
            $Ngoaite= new NgoaiTe();
            //$Ngoaite->setNgoaiTe($result['DonViTienTe']);
            $DonVi = $Ngoaite->getDonVi($data['DonViTienTe']);
            if($data["DonViTienTe"]==1)
                echo' <option value="'.$data["STK"].'">'.$data["STK"].'-'.$DonVi.'</option>';
        }
        echo '</select>';
        //echo $MaiBanking;
    }
    function getLNT($STK)
    {
        $conn = new myDBC();
        $sql="select DonViTienTe from taikhoannganhang where STK='".$STK."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data["DonViTienTe"];
    }
    function setSoDuTKNH($SDNoiTe,$SDNgoaiTe,$STKNgte,$STKNoiTe)
    {
        $con= new myDBC();
        $check=false;
       // mysqli_query("START TRANSACTION");
        $con->runQuery("Start Transaction;");
        $q1= $con->runQuery("update taikhoannganhang  set SoDU = '".$SDNgoaiTe."'  where 	STK = '".$STKNgte."'");
        if($q1){
            $q2= $con->runQuery("update taikhoannganhang  set SoDU = '".$SDNoiTe."'  where 	STK ='".$STKNoiTe."'");
            if($q2)
            {
               // mysql_query("COMMIT");
                $con->runQuery("commit;");
                $check= true;
            }
            else// mysql_query("ROLLBACK");
            $con->runQuery("rollback;");
        }
        return $check;
    }

    function deltknh($user)
    {
        $con= new myDBC();
        $con->runQuery("SET foreign_key_checks = 0");
        $check = $con->runQuery("update taikhoannganhang set MaiBanking = '' where MaiBanking = '".$user."'") or die(mysql_errno());
        $con->runQuery('SET foreign_key_checks = 1');
        //return $check;
    }
    function getMaiBanking($stk)
    {
        $conn = new myDBC();
        $sql="select MaiBanking from taikhoannganhang where STK='".$stk."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data["MaiBanking"];
    }

    function getChuTk($stk)
    {
        $conn = new myDBC();
        $sql="select ChuTK from taikhoannganhang where STK='".$stk."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data["ChuTK"];
    }
    function getSTk($Chutk)
    {
        $conn = new myDBC();
        $sql="select STK from taikhoannganhang where ChuTK='".$Chutk."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data['STK'];
    }
    function setMaiBanking($u,$stk)
    {
        $con= new myDBC();
        $con->runQuery("SET foreign_key_checks = 0");
        $check = $con->runQuery("update taikhoannganhang set MaiBanking = '".$u."' where STK = '".$stk."'") or die(mysql_errno());
        $con->runQuery('SET foreign_key_checks = 1');
    }
    function getInfo($STK)
    {
        $con = new myDBC();
        $query="select *from taikhoannganhang where STK=".$STK;
        $res=$con->runQuery($query);
        return $res;
    }

}

?>