<script>

    // kiem tra stk co thuoc so huu hay khong -->
    /*$( "#STKDangKy" ).focusout(function() {
        var STK=$("#STKDangKy").val();
       // alert(STK);

        $.post( "../control/QuanLyThongTinCtrl.php",{STK:STK} ,function( data )
        {
            //alert(data);
           if(data=="false") alert("Số tài khoản không hợp lệ");
            else $("#DangKyiBanking").show();
           // $( "#KetQua" ).html( data ).show();
          //  else
           // alert("Bleh");
        });
    });
*/
        // tien hanh dang ky
    function DangKyiBanking()
    {
        var STK=$("#STKDangKy").val();
        $.post( "../control/QuanLyThongTinCtrl.php",{STK:STK} ,function( data )
        {
            //alert(data);
            if(data=="false") alert("Số tài khoản không hợp lệ");
            else
            {
                    alert("Đăng ký thành công.");
               // window.location.href ="/index.php";
                window.location="index.php";
            }
            $("#DangKyiBanking").show();
            // $( "#KetQua" ).html( data ).show();
            //  else
            // alert("Bleh");
        });
       // var STK=$("#STKDangKy").val();
      //  alert(STK);
    }
</script>


Nhập số tài khoản muốn đăng ký iBanking<input style="margin-left: 10px;" type="text" id="STKDangKy">
<div id="KetQua"></div>
<input type="button" value="Đăng ký iBanking cho tài khoản" onclick="DangKyiBanking();">
