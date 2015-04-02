<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "/../model/NgoaiTe.php";
include_once "/../model/NhatKyGiaoDich.php";
include_once "/../model/TKNganHang.php";
include_once "/../model/Account.php";
include_once"../model/KhachHang.php";
$NgoaiTe = new NgoaiTe();
$NhatKy = new NhatKyGiaoDich();
$TKNH = new TKNganHang();

//
$LoaiGD = $_POST["LoaiGD"];
$sotien = $_POST["Sotien"];
$Act = $_POST["act"];
$Stknt = $_POST["stknt"];
$Stkngte = $_POST['stkngte'];
// sendOTP gán $_SESSION["OTP"] = $OTP;
// cái sendOTP chạy k dc nên để cái để thử
//$_SESSION["OTP"] = "1";
//echo '<script>alert('.$Stknt.');</script>';
//echo $Act;
$SLNhap = $_POST['SLNhap'];
$TKiB = strval($_SESSION['TKiBanking']);
$OTP = $_POST["OTP"];
$now = getdate();
$time = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"] . " " . $now["hours"] . ":" . $now["minutes"] . ":" . $now["seconds"];;


if ($Act == "sendOTP")
{
   // echo '<script> alert("send OTP");</
    $KH= new KhachHang();
    $USER = $_SESSION['TKiBanking'];
    $SDT=$KH->getSDT($USER);
    sendOTP($SDT);

}

if ($Act == "tran_ACTION")
{
    # Gui OTP
    # LoaiGiaoDic
    # SoTien
    #TKNoiTe
    #TKNgoaiTe

    if ($LoaiGD == 4) {
        if ($OTP != $_SESSION["OTP"])
        {

            if (isset($_SESSION['SoLanNhapOTP'])) {
                $_SESSION['SoLanNhapOTP'] = $_SESSION['SoLanNhapOTP'] + 1;

            } else $_SESSION["SoLanNhapOTP"] = 1;


            if ($_SESSION["SoLanNhapOTP"] < 3) {
                echo '<script>alert("Mã OTP quý khách nhập không đúng, quý khách còn ' . (3 - $_SESSION["SoLanNhapOTP"]) . ' lần nhập lại");</script>';
            }

            if ($_SESSION["SoLanNhapOTP"] >= 3)
               echo '<script> window.location="../KhachHang/index.php"</script>';
                //KhoaTK();


        }
        if ($OTP == $_SESSION["OTP"]) {

            $_SESSION['SoLanNhapOTP'] = 0;
            $SoDuNoiTe = $TKNH->getSoDu($Stknt);
            $SoDuNgoaiTe = $TKNH->getSoDu($Stkngte);
            $loaiNT = $TKNH->getLNT($Stkngte);
            $Giamua = $NgoaiTe->getGiaMua($loaiNT);
            $TenNT = $NgoaiTe->getDonVi($loaiNT);
            $SoDuNgTeSauMua = $SoDuNgoaiTe + $sotien;
            $SoDuNoiTeSauMua = $SoDuNoiTe - ($sotien * $Giamua);
            $Check_update_buy = $TKNH->setSoDuTKNH($SoDuNoiTeSauMua, $SoDuNgTeSauMua, $Stkngte, $Stknt);
            if ($Check_update_buy) {
                //$loaiNT = $TKNH->getLNT($Stkngte);
                //$Giamua = $NgoaiTe->getGiaMua($loaiNT);
                //$TenNT = $NgoaiTe->getDonVi($loaiNT);
               /* $NhatKy->setLoaiGiaoDich(4);
                $NhatKy->setNoiDungGiaoDIch("Mua ngoại tệ");
                $NhatKy->setThoiGian($time);
                $NhatKy->setSoTienGD(($sotien * $Giamua));
                $NhatKy->setTKTrichNo($Stkngte);
                $NhatKy->setTKGhiNo($Stknt);
                $check_NKMua = $NhatKy->insNKGD();
                if ($check_NKMua)
                    echo '<script>alert("Giao dịch thành công!");window.location="../KhachHang/index.php";</script>';
                unset($_SESSION["OTP"]);*/
                $check_NKMua= $NhatKy->addNhatKy($sotien,4,"Mua Ngoại Tệ",$Stkngte,$Stknt);
                //$NhatKy->insNKGD();
                //$date = $now->format("H:i:s d-m-Y");
                if($check_NKMua)
                {
                    echo '<form id ="frm_bill">';
                    echo 'Giao dịch thành công';
                    echo '<br>Tài khoản mua : ' .$Stknt  .
                        '<br>Tài khoản nhận ' .$Stkngte  .
                        "<br>Số tiền:" . $sotien .
                        '<br>Nội dung: Mua ngoại tệ' .
                        '<br>Thời gian chuyển: ' . $time;
                    echo '</form>';
                    unset($_SESSION["OTP"]);
                }
                   // echo '<script>alert("Giao dịch thành công!");window.location="../KhachHang/index.php";</script>';


            } else echo '<script>alert("Có lỗi phát sinh, giao dịch không thành công thành công!");window.location="../index.php";</script>';

        }

    }
    if ($LoaiGD == 5) {
        if ($OTP != $_SESSION["OTP"]) {

            if (isset($_SESSION['SoLanNhapOTP'])) {
                $_SESSION['SoLanNhapOTP'] = $_SESSION['SoLanNhapOTP'] + 1;

            } else $_SESSION["SoLanNhapOTP"] = 1;


            if ($_SESSION["SoLanNhapOTP"] < 3) {
                echo '<script>alert("Mã OTP quý khách nhập không đúng, quý khách còn ' . (3 - $_SESSION["SoLanNhapOTP"]) . ' lần nhập lại");</script>';
            }

            if ($_SESSION["SoLanNhapOTP"] >= 3) KhoaTK();


        }
        if ($OTP == $_SESSION["OTP"])
        {
            //echo '<script>alert("OTP dung roi ");</script>';

            $_SESSION['SoLanNhapOTP'] = 0;
            $SoDuNoiTe = $TKNH->getSoDu($Stknt);
            //echo '<script>alert("'.$SoDuNoiTe.'")</script>';
            $SoDuNgoaiTe = $TKNH->getSoDu($Stkngte);
            //echo '<script>alert("'.$SoDuNgoaiTe.'")</script>';
            $loaiNT = $TKNH->getLNT($Stkngte);
            //echo '<script>alert("'.$loaiNT.'")</script>';
            $Giaban = $NgoaiTe->getGiaBan($loaiNT);
            //echo '<script>alert("'.$Giaban.'")</script>';
            $TenNT = $NgoaiTe->getDonVi($loaiNT);
            //echo '<script>alert("'.$TenNT.'")</script>';
            $SoDuNgTeSauBan = $SoDuNgoaiTe - $sotien;
           // echo '<script>alert("'.$SoDuNgTeSauBan.'")</script>';
            $SoDuNoiTeSauBanNgTe = $SoDuNoiTe + ($sotien * $Giaban);
          //  alert();
           // echo '<script>alert("'.$SoDuNoiTeSauBanNgTe.'")</script>';
            //$date = $now->format("H:i:s d-m-Y");
            $Check_update_buy = $TKNH->setSoDuTKNH($SoDuNoiTeSauBanNgTe, $SoDuNgTeSauBan, $Stkngte, $Stknt);

            if ($Check_update_buy==1)
            {
                //echo '<script>alert("'.$Check_update_buy.'")</script>';
                //$loaiNT = $TKNH->getLNT($Stkngte);
                //$Giamua = $NgoaiTe->getGiaMua($loaiNT);
                //$TenNT = $NgoaiTe->getDonVi($loaiNT);
              //  $NhatKy->setLoaiGiaoDich(4);
               // $NhatKy->setNoiDungGiaoDIch("Mua ngoại tệ");
                //$NhatKy->setThoiGian($time);
               // $NhatKy->setSoTienGD($sotien);
                //$/NhatKy->setTKTrichNo($Stkngte);
                //$NhatKy->setTKGhiNo($Stknt);
               /* $check_NKMua = $NhatKy->addNhatKy($sotien,5,"Bán Ngoại Tệ",$Stknt,$Stkngte);
                if ($check_NKMua)
                    echo '<script>alert("Giao dịch thành công!");window.location="../KhachHang/index.php";</script>';
                unset($_SESSION["OTP"]);*/
                $check_NKMua= $NhatKy->addNhatKy($sotien,5,"Bán Ngoại Tệ",$Stknt,$Stkngte);
                if($check_NKMua)
                {

                         echo '<form id ="frm_bill">';
                        echo 'Giao dịch thành công';
                        echo '<br>Tài khoản bán : ' . $Stknt .
                         '<br>Tài khoản nhận ' . $Stkngte .
                            "<br>Số tiền:" . $sotien .
                            '<br>Nội dung: Bán ngoại tệ' .
                            '<br>Thời gian chuyển: ' . $time;
                            echo '</form>';
                //window.location="../KhachHang/index.php";</script>';
                unset($_SESSION["OTP"]);
                }

            } else echo '<script>alert("Có lỗi phát sinh, giao dịch không thành công thành công!");window.location="../index.php";</script>';

        }
    }

}
if ($Act == "showTKNH") {
    $TKNH->getNoite($TKiB);
    $TKNH->getNgTe($TKiB);
    echo '
           <div id="Text_num" style="display: none">
           Nhập số tiền muốn trao đổi: <input type="text" placeholder="Nhập số tiền muốn trao đổi" id="SoTien" name="SoTien" onkeyup="show_vl_change()" onkeypress="is_number(event)">
               <div id="value_change"></div>
             <div id="XacNhanVaOTP">   <input type="button" id="TDNgTe" name="TDNgTe" value="Lấy OTP" onclick="NhapOTP(0)"></div>
           </div>';
}

if ($Act == "show_vl_change") {

    if ($LoaiGD == 4) {
        $SoDuNoiTe = $TKNH->getSoDu($Stknt);
        $SoDuNgoaiTe = $TKNH->getSoDu($Stkngte);
        $loaiNT = $TKNH->getLNT($Stkngte);
        $Giamua = $NgoaiTe->getGiaMua($loaiNT);
        $TenNT = $NgoaiTe->getDonVi($loaiNT);
        echo 'Số tiền cần chi ra là : ' . ($sotien * $Giamua) . '.VND<br>Số dư tài khoản ngoại tệ sau khi thực hiện trao đổi: ' . ($SoDuNgoaiTe + $sotien) . '.' . $TenNT . '<br>số dư tài khoản VND sau khi trao đổi: ' . ($SoDuNoiTe - ($sotien * $Giamua)) . ' VND';
        if (($SoDuNoiTe - ($sotien * $Giamua)) < 0) echo '<script>document.getElementById("TDNgTe").disabled = true;</script>';
        else echo '<script>document.getElementById("TDNgTe").disabled = false;</script>';
    }
    if ($LoaiGD == 5) {
        // echo "ban ngoai te";
        $SoDuNoiTe = $TKNH->getSoDu($Stknt);
        $SoDuNgoaiTe = $TKNH->getSoDu($Stkngte);
        $loaiNT = $TKNH->getLNT($Stkngte);
        $Giaban = $NgoaiTe->getGiaBan($loaiNT);
        $TenNT = $NgoaiTe->getDonVi($loaiNT);
        echo 'Số tiền cần chi ra là : ' . $sotien . '.' . $TenNT . '<br>Số dư tài khoản ngoại tệ sau khi thực hiện trao đổi: ' . ($SoDuNgoaiTe - $sotien) . '.' . $TenNT . '<br>Số dư tài khoản VND có sau khi
      trao đổi: ' . ($SoDuNoiTe + ($sotien * $Giaban)) . ' VND';
        if (($SoDuNgoaiTe - $sotien) < 0) echo '<script>document.getElementById("TDNgTe").disabled = true;</script>';
        else echo '<script>document.getElementById("TDNgTe").disabled = false;</script>';


    }
}
function KhoaTK()
{
    $Account = new Account();
    $lock_iB = $Account->lockAc($_SESSION['TKiBanking']);
    if ($lock_iB) {
        $_SESSION['isLogin'] = false;
        echo '<script>alert("Tài Khoản của quý khách đã bị khóa, vui lòng đến chi nhánh Ngân Hàng để mở khóa!");window.location="../index.php";</script>';
    }
}

function CreateOTP($length = 7, $strength = 8)
{ /*
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength >= 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength >= 2) {
        $vowels .= "AEUY";
    }
    if ($strength >= 4) {
        $consonants .= '23456789';
    }
    if ($strength >= 8) {
        $consonants .= '@#$%';
    }

    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }*/
    $OTP=mt_rand(1111111,9999999);
    return $OTP;
}
function sendOTP($SDT)
{
    $OTP = CreateOTP();
    //echo $OTP."\n";
    //echo $SDT."\n";

    $APIKey = "A383186B2D5902C0AF5559C3461F7B";
    $SecretKey = "8B4C14B5334002CFE1C6D35866C178";
    $YourPhone = $SDT;
    $ch = curl_init();


    $SampleXml = "<RQST>"
        . "<APIKEY>" . $APIKey . "</APIKEY>"
        . "<SECRETKEY>" . $SecretKey . "</SECRETKEY>"
        . "<ISFLASH>0</ISFLASH>"
        . "<CONTENT> OTP Giao Dich " . $OTP . "</CONTENT>"
        . "<CONTACTS>"
        . "<CUSTOMER>"
        . "<PHONE>" . $YourPhone . "</PHONE>"
        . "</CUSTOMER>"
        . "</CONTACTS>"
        . "</RQST>";


    curl_setopt($ch, CURLOPT_URL, "http://api.esms.vn/MainService.svc/xml/SendMultipleMessage_V2/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $SampleXml);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));

    $result = curl_exec($ch);
    $xml = simplexml_load_string($result);

    if ($xml === false) {
        die('Error parsing XML');
    }

    $KQ = $xml->CodeResult;
    $ThongBao="";
    if ($KQ == 100) // return true;
        //else return false;
    {
    $_SESSION["OTP"] = $OTP;
    $ThongBao = " Da gui OTP toi SDT. ".$_SESSION["OTP"];
   }
    else $ThongBao = "Tai Khoan Cua Ban Khong Du Tien De Gui Tien Nhan!";

    //print "Ket qua goi API: " . $xml->CodeResult . "\n";
    //echo $ThongBao;*/
    echo "<script>alert('" . $ThongBao . "');</script>";
    //$ThongBao=" Da gui OTP toi SDT. ";
    //else $ThongBao="Co Loi Xay Ra!";

    //		print "Ket qua goi API: " . $xml->CodeResult . "\n";
    //echo $ThongBao;
    //echo'<script>'.$ThongBao.'</script>';
}

?>