<?php
include_once "../../../control/QuanLiDichVuCtrl.php";
$qldv= new QuanLiDichVuCtrl();
?>
<head>
    <title>Thêm loại dịch vụ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="jquery.js" ></script>
    <script>
        function checkinfo()
        {
            MaNCC= document.ThemKH.MaNCC.value;
            MaLDV=document.ThemKH.MaLDV.value;
            comfirmBox = confirm("Xác nhận thêm dịch vụ?");
            if(comfirmBox == true){
                $.post("../control/QuanLiDichVuCtrl.php",{add:'ThemDV',MaNCC:MaNCC,MaLDV:MaLDV},function(data){$('#action').html(data).show();});
            }
        }

    </script>
</head>
<body>
<form name ="ThemKH" >
    <table border="1">
       <tr><td> Nhà cung cấp:</td>
           <td>
                    <?php
                        $qldv->getNCC();
                    ?>
              </td>  </tr>
        <tr><td>
    Mô tả loại dịch vụ:</td><td> <?php
        $qldv->getLDV();
    ?></td></tr>
</table>
    <input type="button"onclick="return checkinfo()" value="Thêm dịch vụ mới">
</form>

</body>