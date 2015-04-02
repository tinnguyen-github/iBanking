<html>
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
<script>
    $( "#STK" ).change(function()
    {
        // alert( "Handler for .change() called." );

        var STK=$("#STK").val();
        // alert(STK);

        $.post("../control/KhachHangCtrl.php"
            ,{Action:1,STK:STK}
            ,function(data){
                // alert('Load Nhat Ky Giao Dich');
                $("#NKGD").html(data).show();}
        );
        //alert('Goi xong');
        $("#NKGD").show();
    });
</script>
<script>
    function InSaoKe()
    {
        var STK=$("#STK").val();
        //  alert(STK);
        $.post("../PHPEX/run.php"
            ,{STK:STK}
            ,function(data){
                // alert('Load Nhat Ky Giao Dich');
                $("#NKGD").html(data).show();}
        );
        //alert('Goi xong');
        //$("#NKGD").show();
    }
</script>
<form action="../PHPEX/run.php" method="GET">

    <?php
    include "../../model/TKNganHang.php";
    include "../../model/NhatKyGiaoDich.php";

    echo '<select id ="STK" class="input" name="STK">';
    echo "<option values=''>Chon tai khoan muon xem</option>";
    $TKNH=new TKNganHang();
    $Username= $_SESSION['TKiBanking'];
    $TKNH->getTKNganHang($Username);
    echo "</select>";

    ?>

    <input type="submit" value="In sao kê" >

</form>
<div id="NKGD" class="hide">

</div>

</html>
