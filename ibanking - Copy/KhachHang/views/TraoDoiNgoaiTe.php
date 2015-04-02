<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../js/jquery.js" ></script>
<script>
    function showTKNG()
    {
        LoaiGD=document.form_TD_NT.Loai_Trao_Doi.value;
        action ="showTKNH";
        if(LoaiGD==0)
        {
            $('#TD_NgoaiTe').hide();
            $('#Nhap_OTP').hide();
        }
        else{

        $.post("../control/TraoDoiNgoaiTeCtrl.php",{act:action},function(data){
            $('#TD_NgoaiTe').html(data).show();
        });}
    }
    function showText()
    {
        $('#Text_num').show();
    }
    function show_vl_change()
    {
        action = "show_vl_change";
       // alert("action "+action);
        LoaiGD=document.form_TD_NT.Loai_Trao_Doi.value;
        //alert("loai gd"+LoaiGD);
        Sotien = document.form_TD_NT.SoTien.value;
        //alert("so tien"+Sotien);
        stkngte= document.form_TD_NT.TKNgTe.value;
        // alert("STK ngoai te"+stkngte);
        stknt= document.form_TD_NT.TKNoiTe.value;
        if(stknt == 0)
        {
            alert("Chọn Tài khoản VND !!");
            document.form_TD_NT.TKNoiTe.focus();
        }
        else
        // alert("stk noi te"+stknt);
        $.post("../control/TraoDoiNgoaiTeCtrl.php",{act:action,LoaiGD:LoaiGD,Sotien:Sotien,stkngte:stkngte,stknt:stknt},function(data){
            $('#value_change').html(data).show();
        });
    }

    function NhapOTP()
    {
        comfirmBox = confirm("Xác nhận trao đổi ngoại tệ ?");
        if(comfirmBox == true){
            document.getElementById("SoTien").disabled = true;
            $('#Nhap_OTP').show();
            $('#XacNhanVaOTP').hide();
            $.post("../control/TraoDoiNgoaiTeCtrl.php",{act:"sendOTP"},function(data){
                $('#send_OTP').html(data).show();
            });
        }
        //
    }
    function NhapLaiOTP(SLNhap)
    {
        SoLanCon = 3-SLNhap;

    }
    function TraoDoiNT()
    {
        action = "tran_ACTION";
        OTP = document.form_TD_NT.Nhap_OTP.value;
       //alert(OTP);
        LoaiGD=document.form_TD_NT.Loai_Trao_Doi.value;
        //alert("loai gd"+LoaiGD);
        Sotien = document.form_TD_NT.SoTien.value;
        //alert("so tien"+Sotien);
        stkngte= document.form_TD_NT.TKNgTe.value;
        //alert("STK ngoai te"+stkngte);
        stknt= document.form_TD_NT.TKNoiTe.value;
       //alert("STK noi te"+stknt);
        if(OTP =="")
        {
            alert("Quý khách vui lòng nhập mã OTP trước khi xác nhận!");
            document.form_TD_NT.Nhap_OTP.focus();
        }
        else
        {
            $.post("../control/TraoDoiNgoaiTeCtrl.php",{act:action,OTP:OTP,LoaiGD:LoaiGD,Sotien:Sotien,stkngte:stkngte,stknt:stknt},function(data){
                $('#TraoDoiNgoaiTe').html(data).show();
            });
           // alert("áda");
        }
       // alert(SLNhap);
    }

    function is_number(evt) {

        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            {
                theEvent.returnValue = false;
                //$('input#txt').text("Ch? đư?c nh?p s?");
            }

            if(theEvent.preventDefault) {
                //$('#alert').text("");
                theEvent.preventDefault();
            }
        }
    }
</script>
<div id="TraoDoiNgoaiTe">
    <form name="form_TD_NT">
        Chọn loại hình trao đổi <select name="Loai_Trao_Doi" onchange="showTKNG()"><option value="0">Chọn loại giao dịch</option>
            <option value="4">Mua ngoại tệ</option>
            <option value="5">Bán ngoại tệ</option>
        </select>
        <div id="TD_NgoaiTe"></div>
        <div id="Nhap_OTP" style="display: none">Để thực hiện tiếp giao dịch, quý khách vui lòng xác nhận Mã OTP mà chúng tôi đã gửi qua! <input type="text" id="Ma_OTP" name="Nhap_OTP" placeholder="Nhập mã OTP vào đây"><br>
         <input type="button" value="Xác nhận" onclick="TraoDoiNT()"></div>
        <div id="value_change"></div>
        <div id="tran_ACTION"></div>
        <div id="send_OTP"></div>
    </form>

</div>
<div id="XN_TDNT"></div>