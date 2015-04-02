<?php
//session_start();
include_once "../model/TKNganHang.php";
include_once "../model/QuyDinh.php";
include_once "../model/KhachHang.php";
include_once '../model/condb.php';

//$conn=new myDBC();
# Action -> lay gui cau tu trang Chuyen Khoan gui len
#1- kiem tra so du tai khoan
#2- xac thuc tai khoan nhan tien
#3 - kiem tra han muc quy dinh!
#4 - gui ma OTP
#5 - Thuc Hien Chuyen Khoan!

$Action = $_POST["Action"];

/*
echo $TKDEN;
echo $TKDI;
echo $SoTien;
echo $NoiDung;
*/

switch ($Action) {
    case 1:
        checkSoDu();
        break;
    case 2:
        exist();
        break;
    case 3:
        checkHanMuc();
        break;
    case 4:
        $KH = new KhachHang();
        $Username = $_SESSION['TKiBanking'];

        $SDT = $KH->getSDT($Username);
        sendOTP($SDT); // echo "<script>alert('He Thong Da Gui OTP Toi SDT Cua Quy Khach');</script>";
        //else echo "<script>alert('Da Co Loi Xay Ra.');</script>";
        break;
    case 5:
        //echo '<script>Bat Dau Chuyen Khoan</script>';
        ChuyenKhoan();
        break;
    case 6:
        // echo "<script>alert('Vo day')</script>";
        getSoDu();
        break;
}

#Lay So Du
function getSoDu()
{
    $SoTK=$_POST["STK"];
    $temp = new TKNganHang();
    $SoDu=$temp->getSoDu($SoTK);
    echo $SoDu;
}

#Thuc hien chuyen khoan

function ChuyenKhoan()
{
    //Action:5,TKDen:$TKDen,TKDi:$TKDi,SoTien:$SoTien,NoiDung:$NoiDung
    /*
     -- Ket Qua
    -- 1 : So DU Khong du
    -- 2: Tai Khoan Den Khong Ton Tai
    -- 3: Qua Han Muc
    -- 4 : Khong update TK DI Duoc
    -- 5 K Update TK Nhan Dc
    -- 0 Thanh cong!
    */
    if (isset($_SESSION["OTP"])) {
        $TKDi = $_POST["TKDi"];
        $TKDen = $_POST["TKDen"];
        $SoTien = $_POST["SoTien"];
        $NoiDung = $_POST["NoiDung"];
        $OTP = $_POST["OTP"];

        if ($OTP == $_SESSION["OTP"]) {
            unset($_SESSION["OTP"]);
            unset($_SESSION["SoLanNhapOTP"]);
            $temp = new TKNganHang();
            $KetQua = $temp->ChuyenKhoan($TKDi, $TKDen, $SoTien, $NoiDung);
            if ($KetQua == null) $KetQua = "Null Mat tieu Roi";
            //echo $KetQua;
            else
                switch ($KetQua) {
                    case 0:

                        $now = new DateTime();
                        $date = $now->format("H:i:s d-m-Y");
                        $now->format("H:M:S D-M-Y");
                        $temp= new TKNganHang();
                        $SoDu=$temp->getSoDu($TKDi);
                        echo '<form id ="frm_bill">';
                        echo 'Chuyển Khoản Thành Công.';
                        echo '<br>Tài khoản gửi: ' . $TKDi .
                            '<br>Tài khoản nhận ' . $TKDen .
                            "<br>Số tiền đã chuyển:" . $SoTien .
                            '<br>Nội dung: ' . $NoiDung .
                            '<br>Thời gian chuyển: ' . $date.
                            '<br>Số dư tài khoản : ' . $SoDu;;
                        echo '</form>';
                        break;
                    case 1:
                        echo 'Khong du so du!';
                        break;
                    case 2:
                        echo 'Tai Khoan Den Khong Ton Tai.';
                        break;
                    case 3:
                        echo 'Qua Han Muc Quy Dinh';
                        break;
                    case 4:
                        echo 'Loi Update So Du TK Gui.';
                        break;
                    case 5:
                        echo 'Loi Update So Du TK Nhan.';
                        break;
                }
        } else {
            if (isset($_SESSION["SoLanNhapOTP"])) {
                if ($_SESSION["SoLanNhapOTP"] >= 3) {
                    echo -1;
                    unset($_SESSION["SoLanNhapOTP"]);
                    //header('Location: ../KhachHang/views/ChuyenKhoan.php');

                } else $_SESSION["SoLanNhapOTP"] += 1;
            } else {
                $_SESSION["SoLanNhapOTP"] = 1;
                echo 0;
            }
            //unset($_SESSION["OTP"]);

        }
    } else echo 1;
}

#Xong chuyen khoan!
#Xac thuc tai khoan

function exist()
{
    $STK = $_POST["TKDen"];
    $temp = new TKNganHang();
    if ($temp->exists($STK))
        echo 1;
    else echo 0;

}

# xong xac thuc tai khoan
#Kiem tra han muc
function checkHanMuc()
{
    $SoTien = $_POST["SoTien"];
    $temp = new QuyDinh();
    $temp->getInfo(1);
    if ($SoTien >= $temp->HanMuc)
        echo 0;
    else echo 1;
}

#Xong kiem tra han muc

#Kiem tra so du tai khoan
function checkSoDu()
{
    // lay tham so post
    $STK = $_POST["TKDi"];
    $SoTien = $_POST["SoTien"];
    // lay muc phi giao dich
    $QD = new QuyDinh();
    $QD->getInfo(1);
    // kiem tra so du
    $TK = new TKNganHang();
    $SoDu = $TK->getSoDu($STK);
    //
    $SoTien += $QD->MucPhi;

    $TK = new TKNganHang();
    $SoDu = $TK->getSoDu($STK);
    ////echo "<script>alert(".$SoDu.");</script>";
    $SoDuSauKhiChuyen=$SoDu-$SoTien;
   // if ($SoDuSauKhiChuyen<=0)
     //   echo 0;
   // else
    echo $SoDuSauKhiChuyen;
    //echo $SoDu;
    //echo $SoDu;
}

#Xong kiem tra so du
#Tao OTP
function CreateOTP($length = 7, $strength = 8)
{
    /*  $vowels = 'aeuy';
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

# Xong tạo OTP
# Gui OTP
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
    $ThongBao;
    if ($KQ == 100) // return true;
        //else return false;*/
    {
        $_SESSION["OTP"] = $OTP;
        $ThongBao = " Da gui OTP toi SDT. ";//.$_SESSION["OTP"];
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

#Xong gửi OTP

?>