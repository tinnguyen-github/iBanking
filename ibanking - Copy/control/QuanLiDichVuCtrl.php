<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
include_once "/../model/DichVu.php";
include_once "/../model/LoaiDichVu.php";
include_once "/../model/NhaCungCap.php";
include_once "/../model/Account.php";
include_once "/../model/TKNganHang.php";
// tao doi tuong class
$DichVu = new DichVu();
$LoaiDichVu = new LoaiDichVu();
$NhaCungCap =new NhaCungCap();
$Account =  new Account();
$tknh= new TKNganHang();

// lấy giá trị từ các page

$action= $_POST["action"];
$page= $_POST["page"];
$stop = $_POST['stop'];
$acti = $_POST['acti'];
$id = $_POST['id'];
$add=$_POST['add'];

// show info
if($action==1)
{

    $DichVu->showInfo($page);
}
if($action==2)
{

   $LoaiDichVu->showInfo($page);
}
if($action==3)
{

    $NhaCungCap->showInfo($page);
}

if($action=="sua_NCC")
{
    $id_ncc=$_POST['id'];
    $diachi=$_POST['diachi'];
    $sdt=$_POST['sdt'];
   $NhaCungCap->updateNCC($id_ncc,$diachi,$sdt);
   echo '<script>alert("Cập nhật thông tin thành công!");ds(3,1);</script>';
}
// stop ...

if($stop=="dv")
{
    $DichVu->setID($id);
    $checkstopdv = $DichVu->stopDichVu();
    if($checkstopdv)
        echo '<script>alert("Dừng dịch vụ thành công");ds(1,1);</script>';
}
if($stop=="ncc")
{
    //$NhaCungCap->setID($id);
    $checkstopncc = $NhaCungCap->stopNCC($id);
    if($checkstopncc)
        echo '<script>alert("Dừng hợp tác với NCC thành công");ds(3,1);</script>';
}
// accti
if($acti=="dv")
{
    $DichVu->setID($id);
    $checkacdv = $DichVu->updateDichVu();
    if($checkacdv)
        echo '<script>alert("Kích hoạt dịch vụ thành công");ds(1,1);</script>';
}
if($acti=="ncc")
{

    $checkacncc = $NhaCungCap->acctiNCC($id);
    if($checkacncc)
        echo '<script>alert("Hợp tác với NCC thành công");ds(3,1);</script>';
}


/// add
if($add=="ThemLDV")
{
    //echo '<script>alert("Thêm loại dịch vụ mới");</script>';
    $Mota= $_POST["MoTaLDV"];
    //echo '<script>alert("'.$Mota.'");</script>';
    //$LoaiDichVu->setTenDV($Mota);//echo '<script>alert("2");</script>';
    $checkaddLDV = $LoaiDichVu->addLDV($Mota);//echo '<script>alert("3");</script>';
    if($checkaddLDV)  echo '<script>alert("Thêm loại dịch vụ thành công");ds(2,1)</script>';
    else echo '<script>alert("Loại dịch vụ này đã có.");ds(2,1)</script>';
}
if($add=="ThemDV")
{
    $DichVu = new DichVu();
    $MaLDV= $_POST["MaLDV"];
    $MaNCC=$_POST["MaNCC"];
    $DichVu->setisSupported(1);
    $DichVu->setLoaiDV($MaLDV);
    $DichVu->setMaNCC($MaNCC);
    $checkaddDV = $DichVu->addDichVu();
    if($checkaddDV)
        echo '<script>alert("Thêm loại dịch vụ thành công");ds(1,1);</script>';
    else echo '<script>alert("Thêm dịch vụ không thành công");ds(1,1);</script>';
}

if($add=="ThemNCC")
{
    //tenncc:tenncc,sdt:sdt,STK:stk,diachi:diachi
    $TenNCC= $_POST["tenncc"];
    $STK=$_POST["stk"];
    $sdt=$_POST["sdt"];
    $Loaidv=$_POST["Loaidv"];
    $DiaChi =$_POST["diachi"];
    $Maibanking = $tknh->getMaiBanking($STK);
    $IDNCC = $NCC->getIDNCC($TenNCC);
    $ChuTk = $tknh->getChuTk($STK);
    if($Maibanking!="") echo '<script>alert("Tài khoản ngân hàng này đã được sử dụng!");</script>';
    else
        if($IDNCC == $ChuTk)
    {
        //$checkaddLDV =
            $LoaiDichVu->addLDV($Loaidv);
            $maldv = $LoaiDichVu->getmaldv($Loaidv);
            //echo '<script>alert("3");</script>';
       // if($checkaddLDV)  echo '<script>alert("Thêm loại dịch vụ thành công");ds(2,1)</script>';
            $NCC= new NhaCungCap();
            $Account->adAccount($ChuTk,3,mt_rand(100000,999999),$time);
            $checkaddNCC = $NCC->addNCC($ChuTk,$ChuTk);
                //->addNCC($ChuTk,$TenNCC,$DiaChi,$sdt,$ChuTk);
       //echo '<script>alert("'.$checkaddNCC.'");</script>';
           // $DichVu = new DichVu();
           // $MaLDV= $_POST["MaLDV"];
           // $MaNCC=$_POST["MaNCC"];

            $DichVu->setisSupported(1);
            $DichVu->setLoaiDV($maldv);
            $DichVu->setMaNCC($ChuTk);
            $checkaddDV = $DichVu->addDichVu();
            if($checkaddNCC)
                echo '<script>alert("Thêm nhà cung cấp dịch vụ thành công");ds(3,1);</script>';
            else echo '<script>alert("Thêm nhà cung cấp dịch vụ không thành công");ds(3,1);</script>';
       // }
    }
}
function ThemDV()
{
    $DichVu = new DichVu();
    $MaLDV= $_POST["MaLDV"];
    $MaNCC=$_POST["MaNCC"];
    $DichVu->setisSupported(1);
    $DichVu->setLoaiDV($MaLDV);
    $DichVu->setMaNCC($MaNCC);
    $checkaddDV = $DichVu->addDichVu();
    if($checkaddDV)
        echo '<script>alert("Thêm loại dịch vụ thành công");ds(1,1);</script>';
    else echo '<script>alert("Thêm dịch vụ không thành công");ds(1,1);</script>';
}
///class
class QuanLiDichVuCtrl
{
    function getNCC()
    {

        $ncc= new NhaCungCap();
        $ncc->showNCC();

    }
    function getLDV()
    {

        $ldv= new LoaiDichVu();
        $ldv->showLDV();
    }
    function getinfoNCC($id)
    {

        $ncc= new NhaCungCap();
        $ncc->getInfo($id);

    }

}
?>