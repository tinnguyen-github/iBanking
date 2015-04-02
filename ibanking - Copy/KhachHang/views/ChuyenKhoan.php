<link rel="stylesheet" href="../../css/styles.css" type="text/css" />
<meta charset="utf-8">
<script src="../../js/Jquery.js"> </script>

<!-- Lay So Du Sau Khi Select -->
<script>

    $("#TKDi").change(function(){
            var TKDi=$("#TKDi").val();
            //alert(TKDi);

            $.post( "../control/ChuyenKhoanCtrl.php"
                ,{Action:6,STK:TKDi}
                , function( data )
                {
                    //alert (data);
                    $("#SoDu").html(data).show();
                });
        }
    );
</script>

<script>

// an cac thong bao loi!
//kiem soat chi cho nhap so

$(document).ready(function(){
    $(".hide").hide();

    // Kiem tra cac input chi duoc nhap so
    $(".So").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});

// xong ham an loi, kiem tra nhap so



// xac thuc tai khoan nhan tien
$("#TKDen").focusout(function()
    {
        TKDen=$("#TKDen").val();
        $.post( "../control/ChuyenKhoanCtrl.php",{Action:2,TKDen:TKDen}
            , function( data )
            {
                //alert("goi ham");
                if(data==0)
                {
                    $("#TKDenKhongTonTai").show();
                    $("#TKDen").focus();
                }
                else $("#TKDenKhongTonTai").hide();
                //alert (data);
            });
    }
);

//xong xac thuc tai khoan den

// kiem tra so tien vuot han muc, k du so du
$("#SoTien").focusout(function()
{

    $TKDi=$("#TKDi").val();
    $SoTien=$("#SoTien").val();
    if($SoTien=="")
    {
        alert("So tien khong duoc bo trong!");
        $("#SoTien").focus();
    }
    else
    {
        $.post( "../control/ChuyenKhoanCtrl.php"
            ,{Action:3,SoTien:$SoTien}
            , function( data )
            {
                //alert("goi ham");
                if(data==0)
                {
                    $("#QuaHanMuc").show();
                    $("#SoTien").focus();
                }
                else
                {
                    $("#QuaHanMuc").hide();
                    $.post( "../control/ChuyenKhoanCtrl.php"
                        ,{Action:1,TKDi:$TKDi,SoTien:$SoTien}
                        , function( data )
                        {
                          //  alert($SoTien);
                            //alert("SoDu : "+data);
                            //alert("SoDu"+data);
                            //alert("goi ham");
                            if(data<=0)
                            {
                                $("#KhongDuSoDu").show();
                                $("#SoTien").focus();
                               // alert("<0"+data);
                            }
                            else
                            {
                               // alert(">0"+data);
                                $("#KhongDuSoDu").hide();
                                $("#SoDuSauKhiChuyen").html(data).show();
                            }
                            //alert (data);
                        });
                }
                //alert (data);
            });

    }
});
//Kiem tra noi dung k duoc bo trong
$("#NoiDung").focusout(function()
{
    if($("#NoiDung").val()=="")
    {
        $("#TrongNoiDung").show();
        $("#NoiDung").focus();
    }
    else $("#TrongNoiDung").hide();
});

//Xong kiem tra noi dung!


//kiem tra nhap otp chua
$("#OTP").focusout(function()
{
    if($("#OTP").val()=="")
    {
        //$("#").show();
        $("#OTP").focus();
    }
    //else $("#TrongNoiDung").hide();
});
//het
// Thuc hien chuyen khoan!

$( "#btnXacNhan" ).click(function()
{
    //alert("goi ham!");
    // Lay gia tri cac bien
    var $TKDi=$("#TKDi").val();
    var $TKDen=$("#TKDen").val();
    var $SoTien=$("#SoTien").val();
    var $NoiDung=$("#NoiDung").val();
    //alert($NoiDung);
    // Kiem tra noi dung k duoc bo trong!
    if($TKDen=="")
    {
        alert("Nhap so tai khoan nhan tien!");
        $("#TKDen").focus();
    }
    else
    if($SoTien=="")
    {
        alert("Nhap so tien gui!");
        $("#SoTien").focus();
    }
    else
    if($NoiDung=="")
    {
        alert('Khong Duoc Bo Trong Noi Dung');
        $("#NoiDung").focus();
    }
    else
    {
        $('.input').attr("disabled",true);
        $("#OTPdiv").show();
        alert("Dang Gui OTP Toi SDT Cua Quy Khach!");

        $.post( "../control/ChuyenKhoanCtrl.php"
            ,{Action:4}
            ,function(data)
            {
                //if(data==0) $("#KhongDuSoDu").show();
                //else $("#KhongDuSoDu").hide();
                //alert(data);
                $("#KetQua").html(data).show();
            }
        );

    }
});


// thuc hien chuyen khoan
$( "#btnChuyenKhoan" ).click(function()
{
    //alert("goi ham!");
    // Lay gia tri cac bien
    var $TKDi=$("#TKDi").val();
    var $TKDen=$("#TKDen").val();
    var $SoTien=$("#SoTien").val();
    var $NoiDung=$("#NoiDung").val();
    var $OTP=$("#OTP").val();
    //alert($NoiDung);
    // Kiem tra noi dung k duoc bo trong!
    if($TKDen=="")
    {
        alert("Nhap so tai khoan nhan tien!");
        $("#TKDen").focus();
    }
    else
    if($SoTien=="")
    {
        alert("Nhap so tien gui!");
        $("#SoTien").focus();
    }
    else
    if($NoiDung=="")
    {
        alert('Khong Duoc Bo Trong Noi Dung');
        $("#NoiDung").focus();
    }
    else
    if($OTP=="")
    {
        alert('Hay Nhap OTP');
        $("#OTP").focus();
    }
    else
    {

        $.post( "../control/ChuyenKhoanCtrl.php"
            ,{Action:5,TKDen:$TKDen,TKDi:$TKDi,SoTien:$SoTien,NoiDung:$NoiDung,OTP:$OTP}
            ,function(data)
            {
                //if(data==0) $("#KhongDuSoDu").show();
                //else $("#KhongDuSoDu").hide();
                //alert(data);
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
                {
                    $("#SaiOTP").hide();
                    $("#main").html(data).show();
                }
            }
        );
    }
});

</script>

<!--
<input type="radio" id="NoiBo" name="HinhThuc"> Chuyen Khoan Noi Bo<br>
<input type="radio" id="LienNganHang" name="HinhThuc" > Chuyen Khoan lien Ngan Hang<br>-->
Chọn tài khoản chuyển

<select id ='TKDi' class="input">
    <option value="">Chọn tài khoản gửi</option>
    <?php
    include "../../model/TKNganHang.php";
    $TKNH=new TKNganHang();
    $Username= $_SESSION['TKiBanking'];
    $TKNH->getTKNganHang( $Username);
    ?>
</select>
<br>
Số dư tài khoản: <div id="SoDu" style="display: inline; margin-top:10px;"> </div><br>
Nhập tài khoản nhận <input type="text" id ='TKDen' class="So" class="input">
<div id="TKDenBoTrong" class="hide" style="display:none">Nhap Tai Khoan Nhan Tien!</div>
<div id="TKDenKhongTonTai" class="hide"  style="display:inline;">Số tài khoản không tồn tại</div><br>
<?php
include "../../model/QuyDinh.php";
$temp=new QuyDinh();
$temp->getInfo(1);
echo 'Mức phí : '.$temp->MucPhi.' VND <br>';
echo 'Số tiền tối đa cho 1 lần chuyển : '.$temp->HanMuc.' VND <br>';
?>
Nhập số tiền chuyển <input type="text" id ="SoTien" class="So" class="input">
<div id="QuaHanMuc" class="hide" style="display:inline;">Quá hạn mức quy định</div>
<div id="KhongDuSoDu" class="hide"  style="display : inline;"> Không đủ số dư</div>
<div id="SoTienLoi" class="hide"  style="display: inline;">Số tiền phải chia hết cho 50000</div><br>

Số dư sau khi chuyển <div id="SoDuSauKhiChuyen" style="display: inline" ></div><br>
Nội Dung<br> <textarea rows="4" cols="50"  id ='NoiDung' class="input">
</textarea>
<!--Nội dung <input type="text" id ='NoiDung' class="input"> -->
<div id="TrongNoiDung" class="hide"  style="display: inline;">Nội dung không được bỏ trống
</div><br>

<div name ="NgoaiHeThong" class="hide" class="input" >
    Ngân hàng thừa hưởng <input type="text" name ='NganHangThuaHuong'>
</div>

<input type="button" id="btnXacNhan" value="Lấy OTP"  ><br>

<div id="OTPdiv" class="hide" >Nhập mã OTP <input type ="text" id="OTP">
    <div id="SaiOTP" class="hide" display:inline;"> Sai OTP</div><br>
<input type="button" id="btnChuyenKhoan" value="Chuyển Khoản"  ><br>
</div>


<div id="KetQua"> </div>

