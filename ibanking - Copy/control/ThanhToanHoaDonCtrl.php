<?php
include_once "../model/TKNganHang.php";
include_once '../model/condb.php';
include_once"../model/NhaCungCap.php";
include_once"../model/HoaDon.php";
include_once "../model/KhachHang.php";
$Action=$_POST["Action"];

switch($Action)
{
    case 1:
        $LoaiDichVu=$_POST["LoaiDichVu"];
        ShowNhaCungCap($LoaiDichVu);
        break;
    case 2:
        $MaNCC=$_POST["MaNCC"];
        $LoaiDichVu=$_POST["LoaiDichVu"];
        $MaKH=$_POST["MaKH"];
        showDSHoaDon($LoaiDichVu,$MaNCC,$MaKH);
        break;
    case 3:
        $MaHD=$_POST["MaHD"];
        $_SESSION["MaHoaDon"]=$MaHD;
        $KH= new KhachHang();
        $USER = $_SESSION['TKiBanking'];
        $SDT=$KH->getSDT($USER);
        sendOTP($SDT);
        break;
    case 4:
        $TKThanhToan=$_POST["TKThanhToan"];
        $MaNCC=$_POST["MaNCC"];
        $MaHD= $_SESSION["MaHoaDon"];
        $OTP=$_POST["OTP"];
        ThanhToanHoaDon($TKThanhToan,$MaNCC,$MaHD,$OTP);
}

function ThanhToanHoaDon($TKThanhToan,$MaNCC,$MaHD,$OTP)
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

        if ($OTP == $_SESSION["OTP"]) {

            $temp = new HoaDon();
            $KetQua = $temp->ThanhToanHoaDon($TKThanhToan,$MaNCC,$MaHD);
           // if ($KetQua == null) $KetQua = "Null Mat tieu Roi";
          //  if($KetQua==false) $KetQua="flase";
            //echo $KetQua;
           // else
                switch ($KetQua) {
                    case 0:
                        echo 6;
                        break;
                    case 1:
                        echo 'Không đủ số dư!';
                        break;
                    case 2:
                        echo 'Tai Khoan Den Khong Ton Tai.';
                        break;
                    case -3:
                        echo 'Có lỗi xảy ra.';
                        break;
                    case -1:
                        echo 'Có lỗi xảy ra.';
                        break;

                }
            unset($_SESSION["OTP"]);
            unset($_SESSION["SoLanNhapOTP"]);
        }

        else {
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
function showNhaCungCap($LoaiDichVu)
{
    echo'Chọn nhà cung cấp:';
    echo"<select id='NhaCungCap' style='margin-top: 10px ; left: 60px'>
        <option values=''>Chọn nhà cung cấp </option>";

        $temp= new NhaCungCap();
        $res=$temp->getNCC_LDV($LoaiDichVu);
        if($res==false) echo "<option value=''>Không lấy được nhà cung cấp</option>";
        else
            while($row=mysqli_fetch_array($res))
            {
                echo '<option value="'.$row["ID"].'">'.$row["TenNCC"].'</option>';
            }

      echo '</select>';
}
function showDSHoaDon($LoaiDichVu,$NhaCungCap,$MaKH)
{
    $conn= new myDBC();
    $temp= new HoaDon();
    $res=$temp->getDSHoaDon($LoaiDichVu,$NhaCungCap,$MaKH);
        if($res==false) echo 'Loi truy van SQL';
    else
    {
        echo '<table style="margin-left: 10px"> ';
        echo '<th>Số Hóa Đơn</th>';
        echo '<th>Số Tiền</th>';
        echo '<th>Nội Dung</th>';
        echo '<th>Thanh Toán</th>';
        while($row=mysqli_fetch_array($res))
        {
            echo '<tr>';
            echo'<td>'.$row["ID"].'</td>';
            echo'<td>'.$row["SoTien"].'</td>';
            echo'<td>'.$row["NoiDungHoaDon"].'</td>';
            if($row["ThoiGianThanhToan"]=="")
                echo '<td>'.'<input class="DaThanhToan" type="button" value="Thanh Toán" onclick="ThanhToanHoaDon('.$row["ID"].');"'.'</td>';
            else
            echo'<td>'.$row["ThoiGianThanhToan"].'</td>';
            echo'</tr>';
        }
        echo '</table>';
    }

}

?>