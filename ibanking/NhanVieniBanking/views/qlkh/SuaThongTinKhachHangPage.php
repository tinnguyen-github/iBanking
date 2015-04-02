<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery.js" ></script>
<script>
    function capnhatTT(id,loaikh)
    {
        //alert(id+"--"+loaikh);

       if(loaikh=="Sua_khcn")
        {
            diachi = document.TTCN.Diachi.value;
           email = document.TTCN.Email.value;
           ngsinh = document.TTCN.NgSinh.value;

           //alert(diachi);
            //$.post("QuanLyKhachHangCtrl.php",{id:id,loaikh:loaikh,diachi:diachi},function(data){$('#SuaTT').html(data).show();});
           $.post("../control/QuanLyKhachHangCtrl.php",{id:id,action:loaikh,diachi:diachi,email:email,ngsinh:ngsinh},function(data){$('#SuaTT').html(data).show();});
        }
        if(loaikh=="Sua_khtc")
        {
            //alert("ádasd");
            diachi = document.TTTC.Diachi.value;
           // alert(diachi);
           $.post("../control/QuanLyKhachHangCtrl.php",{id:id,action:loaikh,diachi:diachi},function(data){$('#SuaTT').html(data).show();});
        }

    }
    </script>
<?php

include_once "../../../control/QuanLyKhachHangCtrl.php";
$QLKHCtrl= new QLKHCtrl();
$id=$_POST["id"];
//echo '<script>alert("load sua tt'.$id.'");</script>';

$QLKHCtrl->getinfoKH($id);
$QLKHCtrl->getinfoKHTC($id);

?>

<div id="SuaTT"></div>