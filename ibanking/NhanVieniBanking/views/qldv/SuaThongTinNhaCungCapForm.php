<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery.js" ></script>
<script>
    function capnhatTT(id)
    {
        //alert(id+"--"+loaikh);


            diachi = document.TTNCC.DiaChi.value;
            sdt = document.TTNCC.SDT.value;

            //alert(diachi);
            //$.post("QuanLyKhachHangCtrl.php",{id:id,loaikh:loaikh,diachi:diachi},function(data){$('#SuaTT').html(data).show();});
            $.post("../control/QuanLiDichVuCtrl.php",{action:"sua_NCC",id:id,diachi:diachi,sdt:sdt},function(data){$('#SuaTTNCC').html(data).show();});

    }
</script>
<?php

include_once "../../../control/QuanLiDichVuCtrl.php";
$QLDVCtrl= new QuanLiDichVuCtrl();
$id=$_POST["id"];
//echo '<script>alert("load sua tt'.$id.'");</script>';
$QLDVCtrl->getinfoNCC($id);
?>

<div id="SuaTTNCC"></div>