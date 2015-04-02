<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

/*include_once dirname(__FILE__).'\KhachHang.php';
include_once dirname(__FILE__).'\KhachHangToChuc.php';
include_once dirname(__FILE__).'\Account.php';
include_once dirname(__FILE__).'\TKNganHang.php';*/
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
include_once "/../model/KhachHang.php";
include_once "/../model/KhachHangToChuc.php";
include_once "/../model/Account.php";
include_once "/../model/TKNganHang.php";

/// load page

$action= $_POST["action"];
$page= $_POST["page"];
$Them_KH = $_POST["KH"];
//Mo khoa va huy User
$User = $_POST["user"];
//$ac = $_POST["ac"];
//Sua Thông tin
$id=$_POST["id"];
$Sua_KH=$_POST["loaikh"];
$new_diachi=$_POST["diachi"];
$new_email=$_POST["email"];
$new_ngsinh=$_POST["ngsinh"];

if($action==1)
{
    //echo '<script>alert("action ==1");</script>';
    $QLKH= new QLKHCtrl();
    $QLKH->showKH($page);
}
else
    if($action==2)
    {
       // echo '<script>alert("action ==2");</script>';
        $QLKH= new QLKHCtrl();
        $QLKH->showKHTC($page);
    }
//sua tt tc


if($action== "Sua_khtc")
{
   // include_once "KhachHangToChuc.php";
    $khtc = new KhachHangToChuc();
    $khtc->updateInfo($id,$new_diachi);
    echo '<script>alert("Cập nhật thông tin thành công!");callpage(1);</script>';
}


/// sua tt cn
if($action== "Sua_khcn")
{
    //include_once "KhachHang.php";
    $kh = new KhachHang();
   // echo $new_ngsinh;
   // echo "12121";
    $kh->updateInfo($id,$new_ngsinh,$new_diachi,$new_email);
    echo '<script>alert("Cập nhật thông tin thành công!");callpage(1);</script>';
}
// mo khoa
if($action=="Lock")
{
    if($User=="") echo '<script>alert("Khách hàng chưa mở tài khoản iBanking!");</script>';
    else
    {
        $account= new Account();
        $check=$account->isLock($User);
        if($check==1) echo '<script>alert("Mở khóa tài khoản thành công!");callpage(1);</script>';
    }
}

//huy user
if($action=="Del")
{
    if($User=="") echo '<script>alert("Khách hàng chưa mở tài khoản iBanking!");</script>';
    else{

           // $iban= new iBankingInfo();
      //  echo '<script>alert("bat dau del!") ;</script>';
            $account= new Account();
       // echo '<script>alert("1") ;</script>';
            $kh = new KhachHang();
       // echo '<script>alert("2") ;</script>';
            $khtc = new KhachHangToChuc();
       // echo '<script>alert("3") ;</script>';
            $tkng = new TKNganHang();
        //echo '<script>alert("4") ;</script>';
       // echo '<script>alert("Del truoc khi del tai khoan nh!") ;</script>';
            $tkng->deltknh($User);
       // echo '<script>alert("Del trong tai khoan nh!") ;</script>';
            //$iban->deliBanking($User);
            $account->getInfo($User);
            $quyen_user = $account->getQuyen();
       //echo '<script>alert("'.$quyen_user.'");</script>';
            if($quyen_user == 1)
            {
                 $kh->delAcc($User);
            }
            else if($quyen_user==2)
            {
                 $khtc->delAcc($User);
            }
        //echo '<script>alert("Del trong khach hang!") ;</script>';
            $check = $account->delAccount($User);
            if($check==1) echo '<script>alert("Hủy tài khoản thành công!") ;callpage(1);</script>';
    }

}
$now= getdate();
$time = $now["year"]."-".$now["mon"] . "-" . $now["mday"];//." ".$now["hours"] . ":" . $now["minutes"] . ":" . $now["seconds"]; ;


//add khcn
if($action=="Them_KHCN")
{
    $Hoten = $_POST["hoten"];
    //echo '<script>alert("'.$Hoten.'");</script>';
    $CMND= $_POST["CMND"];
    $STK= $_POST["STK"];
    $SDT=$_POST["sdt"];
    $str_ho = substr($Hoten, 0, strpos( $Hoten,' '));
    $str_ten = substr($Hoten, strripos($Hoten,' '));
    $Username=$str_ten.$str_ho.$CMND;
    $Username= vn2latin($Username,true);

    $tkng = new TKNganHang();
    $khachhang= new KhachHang();
    $Account = new Account();
    //$iban= new ibanking();
   // $Maibanking = $tkng->getMaiBanking($STK);
   // $id_KH= $khachhang->getID($Hoten);
   // $ChuTk = $tkng->getChuTk($STK);
  /*  if($Maibanking!="") echo '<script>alert("Tài khoản ngân hàng này đã được đăng ký iBanking");</script>';
    else
        if($id_KH != $ChuTk)
        {
            echo '<script>alert("Tài khoản ngân hàng này không tồn tại");</script>';
        }
        else
      {*/
        $checkHOTEN_CMND= $khachhang->checkInfoKH($Hoten,$CMND);
       if($checkHOTEN_CMND==3)
       {
           echo '<script>alert("Họ tên hoặc CMND khách hàng không đúng sai!!")</script>';
       }
        else
            if($checkHOTEN_CMND==2)
            {
                echo '<script>alert("CMND của khách hàng không đúng!!")</script>';
            }
            else
                if($checkHOTEN_CMND==1)
                {
                    $Maibanking = $tkng->getMaiBanking($STK);
                    if($Maibanking!="") echo '<script>alert("Tài khoản ngân hàng này đã được đăng ký iBanking");</script>';

                    else
                    {
                        $MakH= $khachhang->getMakh($CMND);
                        $ChuTk = $tkng->getChuTk($STK);
                        if( $ChuTk == "") echo '<script>alert("Tài khoản ngân hàng này không tồn tại!");</script>';
                        else
                            if($ChuTk!=$MakH) echo '<script>alert("Tài khoản ngân hàng này không thuộc sở hữu của khách hàng!");</script>';
                        else
                            if($ChuTk==$MakH)
                            {
                                $check= $Account->adAccount($Username,1,mt_rand(100000,999999),$time);
                                if($check==1)
                                {
                                    $khachhang->setUser($Username,$ChuTk,$SDT);
                                    $tkng->setMaiBanking($Username,$STK);
                                    //$iban->addiBanking($Username,$time);
                                    echo '<script>alert("Thêm tài khoản không thành công");callpage(1);</script>';
                                }
                                else echo '<script>alert("Thêm tài khoản thành công");callpage(1);</script>';
                            }
                    }
        }
}

// addkh tc
if($action == "Them_KHTC")
{
   // echo '<script>alert("Them To chuc")</script>';

    $Hoten = $_POST["HoTen"];
    $STK= $_POST["STK"];
    $SDK= $_POST["sdk"];
    $TenDonVi = $_POST['tendv'];
    $CMND = $_POST['cmnd'];

    $str_ho = substr($Hoten, 0, strpos( $Hoten,' '));
    $str_ten = substr($Hoten, strripos($Hoten,' '));
    $Username=$str_ten.$str_ho.$CMND;
    $Username = vn2latin($Username,true);

    $tkng = new TKNganHang();
    $khtc= new KhachHangToChuc();
    $Account = new Account();
    //$iban= new ibanking();

    $Maibanking = $tkng->getMaiBanking($STK);
    $ChuTk = $tkng->getChuTk($STK);
    if($Maibanking!="") echo '<script>alert("'.$ChuTk.'Tài khoản ngân hàng này đã được đăng ký iBanking");</script>';
    else
    {


       //echo $ChuTk;
        if($khtc->checkInfo($ChuTk,$TenDonVi,$SDK)==false)
        {
           // echo '<script>alert('.$ChuTk.'-'.$STK.')</script>';
            echo '<script>alert("Thông tin không hợp lệ")</script>';
        }
        else
        {
            $check= $Account->adAccount($Username,2,mt_rand(100000,999999),$time);

            if(!$check)
            {
                $khtc->setUser($Username,$ChuTk);
                $tkng->setMaiBanking($Username,$STK);
               // $iban->addiBanking($Username,$time);
                echo '<script>alert("Thêm tài khoản không thành công");callpage(1);</script>';
            }
            else echo '<script>alert("Thêm tài khoản thành công");callpage(1);</script>';
        }
    }
}
function vn2latin($cs, $tolower = false)
{
    /*Mảng chứa tất cả ký tự có dấu trong Tiếng Việt*/
    $marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
        "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
        "ế","ệ","ể","ễ",
        "ì","í","ị","ỉ","ĩ",
        "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
        "ờ","ớ","ợ","ở","ỡ",
        "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
        "ỳ","ý","ỵ","ỷ","ỹ",
        "đ",
        "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
        "Ằ","Ắ","Ặ","Ẳ","Ẵ",
        "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
        "Ì","Í","Ị","Ỉ","Ĩ",
        "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
        "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
        "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
        "Đ"," ");

    /*Mảng chứa tất cả ký tự không dấu tương ứng với mảng $marTViet bên trên*/
    $marKoDau=array("a","a","a","a","a","a","a","a","a","a","a",
        "a","a","a","a","a","a",
        "e","e","e","e","e","e","e","e","e","e","e",
        "i","i","i","i","i",
        "o","o","o","o","o","o","o","o","o","o","o","o",
        "o","o","o","o","o",
        "u","u","u","u","u","u","u","u","u","u","u",
        "y","y","y","y","y",
        "d",
        "A","A","A","A","A","A","A","A","A","A","A","A",
        "A","A","A","A","A",
        "E","E","E","E","E","E","E","E","E","E","E",
        "I","I","I","I","I",
        "O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
        "U","U","U","U","U","U","U","U","U","U","U",
        "Y","Y","Y","Y","Y",
        "D","");

    if ($tolower) {
        return strtolower(str_replace($marTViet,$marKoDau,$cs));
    }

    return str_replace($marTViet,$marKoDau,$cs);

}






class QLKHCtrl
{
    function showKH($page)
    {

        $khcn = new KhachHang();
        $khcn->showInfo($page);
    }
    function showKHTC($page)
    {

        $khtc= new KhachHangToChuc();
        $khtc->showInfo($page);
    }
    function getinfoKH($id)
    {

        $khcn = new KhachHang();
       // $khcn->showInfo($page);
        $khcn->showgetInfo($id);//getInfo($id);
       // $khtc->getInfo($id);
    }
    function getinfoKHTC($id)
    {

        $khtc= new KhachHangToChuc();
        //$khtc->showInfo($page);
        $khtc->getInfo($id);
    }
}
?>