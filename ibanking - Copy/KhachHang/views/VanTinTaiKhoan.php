<!-- Lấy vấn tin -->
<script>
    $( "#STK" ).change(function()
    {
        // alert( "Handler for .change() called." );

        var STK=$("#STK").val();
        // alert(STK);

        $.post("../control/VanTinCtrl.php"
            ,{STK:STK}
            ,function(data){
                // alert('Load Nhat Ky Giao Dich');
                $("#VanTinInfo").html(data).show();}
        );
        //alert('Goi xong');
        $("#VanTinInfo").show();
    });
</script>

<?php
include "../../model/TKNganHang.php";
include "../../model/NhatKyGiaoDich.php";

echo '<select id ="STK" class="input">';
echo "<option values=''>Chọn tài khoản muốn vấn tin</option>";
$TKNH=new TKNganHang();
$Username= $_SESSION['TKiBanking'];
$TKNH->getTKNganHang($Username);
echo "</select>";

?>
<div id="VanTinInfo"></div>