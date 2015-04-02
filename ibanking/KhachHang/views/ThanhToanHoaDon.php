<?php
include_once("../../model/NhaCungCap.php");
include_once("../../model/LoaiDichVu.php");
//include_once("../con")
?>
<!-- Lấy nha cung cap -->
<script>
//Load Nha Cung Cap
    $("#LoaiDichVu").change(function() {
       // alert(this.value);
        if(!this.value)
        window.confirm("Hãy chọn 1 loại dịch vụ muốn thanh toán");
       else
        $.post( "../control/ThanhToanHoaDonCtrl.php",{Action:1,LoaiDichVu:this.value}, function( data )
        {
            $( "#div_NCC" ).html( data ).show;
        });
    });
    $("#div_NCC").change(function()
    {
       $("#MKH").show();
    });
</script>

<!-- Lấy hóa đơn -->
<script>

    $("#MaKH").focusout(function(){
        if(!this.value)
        window.confirm("Hãy nhập mã khách hàng trên hóa đơn!");
        this.focus();
    });

    function ShowHoaDon()
    {
        var LoaiDichVu=$("#LoaiDichVu").val();
        var MaNCC= $("#NhaCungCap").val();
       // alert(MaNCC);
        var MaKH=$("#MaKH").val();
               $.post( "../control/ThanhToanHoaDonCtrl.php",{Action:2,LoaiDichVu:LoaiDichVu,MaNCC:MaNCC,MaKH:MaKH}, function( data )
        {
            $( "#DSHoaDon" ).html( data ).show;
        });
        $("#DSHoaDon").show();

    }

</script>

<!-- Thanh toan hoa don -->
<!-- lay OTP -->
<Script>

    function ThanhToanHoaDon( MaHD)
    {
        $("#MaKH").attr("disabled",true);
      //  $("#txtName").attr("disabled", true);
       // alert(MaHD);
        $("#div_OTP").show();
        $("#div_TKThanhToan").show();
        alert("Dang Gui OTP");
        $.post( "../control/ThanhToanHoaDonCtrl.php"
            ,{Action:3,MaHD:MaHD}
            ,function(data)
            {
                //if(data==0) $("#KhongDuSoDu").show();
                //else $("#KhongDuSoDu").hide();
                //alert(data);
                $("#KetQua").html(data).show();
            }
        );
    }
</Script>

<!-- Thuc Hien Thanh Toan -->
<script>
    // thuc hien thanh toan
    $( "#btnThanhToan" ).click(function()
    {
        //alert("goi ham!");
        // Lay gia tri cac bien
        var TKThanhToan=$("#TKThanhToan").val();
        var MaNCC=$("#NhaCungCap").val();
        var $OTP=$("#OTP").val();
        //alert($NoiDung);
        // Kiem tra noi dung k duoc bo trong!

        if($OTP=="")
        {
            alert('Hay Nhap OTP');
            $("#OTP").focus();
        }
        else
        {

            $.post( "../control/ThanhToanHoaDonCtrl.php"
                ,{Action:4,TKThanhToan:TKThanhToan,MaNCC:MaNCC,OTP:$OTP}
                ,function(data)
                {
                    //if(data==0) $("#KhongDuSoDu").show();
                    //else $("#KhongDuSoDu").hide();
                    //alert(data);
                  //  $("#KetQua").showPopup(data);
                    if(data==0)
                    {
                        //$("#SaiOTP").show();
                        alert("Sai OTP");
                        $("#OTP").focus();
                    }
                    else
                    if(data==-1) $("#main").load("ChuyenKhoan.php");
                    else
                    if(data==1)
                        alert("Chua Nhap OTP");
                    else
                    if(data==6)
                    {
                      //$("#KetQua").html("Đã thanh toán").show();
                        $("#main").html("Đã thanh toán");
                        $( "#KetQua" ).dialog( "open" );


                        // $(".DaThanhToan").html("DaThanhToan");
                    }
                    else
                    {
                       // $("#SaiOTP").hide();
                        $("#KetQua").html(data).show();
                    }
                }
            );
        }
    });

</script>
<script>
    /*
    $("#div_NCC").change(function(){
        var MANCC= $("#NhaCungCap").val();
        alert(MANCC);
    });*/
</script>
<!-- Chon Loai Dich Vu -->

Chọn loại dịch vụ: <select id="LoaiDichVu" style="margin-top: 10px; left : 60px">
    <option values="">Chọn loại dịch vụ </option>
    <?php
        $temp = new LoaiDichVu();
        $res=$temp->getLDV();
    if($res==false) echo '<option value="">Không lấy được dịch vụ</option>';
    else
    while($row=mysqli_fetch_array($res))
    {
        echo '<option value="'.$row["ID"].'">'.$row["MoTa"].'</option>';
    }
    ?>

</select>
<br>

<!-- Chon Nha Cung Cap -->

<div id="div_NCC">
   <!--  Chọn nhà cung cấp:
    <select id="NhaCungCap" style="margin-top: 10px   ; left: 60px">
        <option values="">Chọn nhà cung cấp </option>

        <?php
        $temp= new NhaCungCap();
        $res=$temp->getNCC();
        if($res==false) echo '<option value="">Không lấy được nhà cung cấp</option>';
        else
            while($row=mysqli_fetch_array($res))
            {
                echo '<option value="'.$row["ID"].'">'.$row["TenNCC"].'</option>';
            }
        ?>
    </select> -->
</div>

<div id="MKH" style="display: none; margin-top: 10px" >
Nhập mã khách hàng: <input type="text" id="MaKH" name="MaKh" style="margin-left: 5px"><br>
    <input style="margin-top: 10px" type="button" value="Hiển thị hóa đơn" onclick="ShowHoaDon();">
</div>
<div id="DSHoaDon" style="display: none; margin-top: 10px" >

</div>
<div id="div_TKThanhToan" style="display: none;margin-top: 10px;">
Chọn tài khoản thanh toán
    <select id ='TKThanhToan' class="input">
        <?php
        include "../../model/TKNganHang.php";
        $TKNH=new TKNganHang();
        $Username= $_SESSION['TKiBanking'];
        $TKNH->getTKNganHang( $Username);
        ?>
    </select>
</div>
<div id="div_OTP" style="margin-top: 10px; display: none">
    Nhập mã OTP <input style="margin-left: 5px;" type="text" id="OTP">
    <input type="button" id="btnThanhToan" value="Thanh Toán"  ><br>
</div>
<div id="KetQua" style="margin-top: 10px;"></div>
