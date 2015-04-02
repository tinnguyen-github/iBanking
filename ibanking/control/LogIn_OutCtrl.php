<?php
//session_destroy();
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
$_SESSION['isLogin']  = false;
//$_SESSION['Username'] = "123" ;
$User = $_POST["user"];
$Pass= $_POST["pass"];
$Action = $_POST['Action'];
$_SESSION["SoLanDangNhap"];

if($Action=="Dangxuat")
{
    session_unset();
    session_destroy();
    session_write_close();
    echo '<script>window.location="../index.php";</script>';
}
if($Action=="DangNhap")
{
    include "../model/Account.php";
    $iBanking = new Account();
    $Check_U_P = $iBanking->CheckUserPass($User,$Pass);
    if($Check_U_P == 1)
    {
        $_SESSION["SoLanDangNhap"]=0;
        //echo '<script>alert("Tài k");</script>';
        $iBanking->getInfo($User);
        $isTheFirst = $iBanking->getisTheFirst();
        $isLocked=$iBanking->getisLocked();
        $Quyen= $iBanking->getQuyen();
        if($isTheFirst == 1)
        {

            echo '<script>window.location = "DoiMkLanDau.php?user='.$User.'";</script>';
        }
        else
        {
            if($isLocked==1)
            {
                echo '<script>alert("Tài khoản iBnaking của quý khách đang bị khóa, vui lòng đến chi nhánh ngân hàng để mở khóa!");window.location="index.php";</script>';
            }
            else
            {
                $_SESSION['isLogin']= true;
                $_SESSION['Quyen']= $Quyen;
                $_SESSION['TKiBanking'] = $User ;
                if($Quyen==1)
                {
                    echo  //"<meta http-equiv='refresh' content='0;url=KhachHang/index.phps' />";
                    '<script>window.location="KhachHang/index.php"</script>';
                }
                if($Quyen==2)
                {
                    echo '<script>window.location="abcxyz.php"</script>';
                }
                if($Quyen==4)
                {
                    echo '<script>window.location="NhanVieniBanking/index.php"</script>';
                }
                if($Quyen==3)
                {
                    //echo '<script>window.location=""</script>';
                }
                if($Quyen==5)
                {
                    echo '<script>window.location="NVKDNgoaiTe/index.php"</script>';
                }
                if($Quyen==6)
                {
                    echo '<script>window.location="NVTTKinhDoanh/index.php"</script>';
                }
            }
        }
    }
    else
    {
        $_SESSION["SoLanDangNhap"] = $_SESSION["SoLanDangNhap"]+1;
        if( $_SESSION["SoLanDangNhap"] > 3 )
        {
            $check_lock= $iBanking->lockAc($User);
            if($check_lock)
                echo '<script>alert("Quý khách nhập sai quá 3 lần, Tài khoản của quý khách đã bị khóa, vui lòng đến chi nhánh ngân hàng để mở khóa tài khoản");
                    window.location = "index.php";</script>';
        }
        else{
            if($Check_U_P == 2)
                echo '<script>alert("Nhập sai mật khẩu!");document.DangNhap.pass.focus();</script>';

            if($Check_U_P == 3)
                echo '<script>alert("Tài khoản không đúng");document.DangNhap.user.focus();</script>';

        }

    }



}
?>