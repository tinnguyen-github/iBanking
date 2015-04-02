
<head>
    <title>Thêm khách hàng</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="jquery.js" ></script>
    <script>
        function showform()
        {
            x= document.ThemKH.KH.value;
            if(x == "KHCN" )
            {
                $('#KHCN').show();
                $('#KHTC').hide();
            }
            if(x == "KHTC" )
            {
                $("#KHTC").show();
                $("#KHCN").hide();
            }
        }
        function is_number(evt) {

            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode( key );
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                {
                    theEvent.returnValue = false;
                    //$('input#txt').text("Chỉ được nhập số");
                }

                if(theEvent.preventDefault) {
                    //$('#alert').text("");
                    theEvent.preventDefault();
                }
            }
        }
        function checkinfo()
        {
            x= document.ThemKH.KH.value;
            if( x=="KHCN")
            {
                hoten = document.ThemKH.HoTen.value;
                //diachi = document.ThemKH.DiaChi.value;
                cmnd=document.ThemKH.CMND.value;
                //email=document.ThemKH.Email.value;
                sdt=document.ThemKH.SDT.value;
                stk=document.ThemKH.STK.value;
                if(hoten=="")
                {
                    alert("Nhập đầy đủ họ tên");
                    document.ThemKH.HoTen.focus();
                    //return false;
                }else
                if(cmnd=="")
                {
                    alert("Nhập CMND");
                    document.ThemKH.CMND.focus();
                    //return false;
                }else
                /*if(diachi=="")
                {
                    alert("Nhập địa chỉ");
                    document.ThemKH.DiaChi.focus();
                    //return false;
                }else
                */if(stk=="")
                {
                    alert("Nhập số tài khoản ngân hàng");
                    document.ThemKH.STK.focus();
                    //return false;
                }else
                /*if(email=="")
                {
                    alert("Nhập email");
                    document.ThemKH.Email.focus();
                    //return false;
                }else
                */if(sdt=="")
                {
                    alert("Nhập số điện thoại");
                    document.ThemKH.SDT.focus();
                    //return false;
                }
                else
                {
                    action = "Them_KHCN";
                    alert(hoten);
                    $.post("../control/QuanLyKhachHangCtrl.php",{action:action,hoten:hoten,STK:stk,CMND:cmnd,sdt:sdt},function(data){$('#ThemTKiB').html(data).show();});

                }

            }
            if(x=="KHTC")
            {
                tendv=document.ThemKH.TenDV.value;
               // diachidv=document.ThemKH.DiaChiDV.value;
                sdk=document.ThemKH.SKD.value;
                //ngsinh= document.ThemKH.NgSinhDV.value;
                hoten = document.ThemKH.HoTenDV.value;
                //diachi= document.ThemKH.DiaChiKHDV.value;
                cmnd=document.ThemKH.CMNDDV.value;
                //email=document.ThemKH.EmailDV.value;
                sdt=document.ThemKH.SDTDV.value;
                stk=document.ThemKH.STKDV.value;
                if(tendv=="")
                {
                    alert("Nhập tên tổ chức");
                    document.ThemKH.TenDV.focus();

                   // return false;
                }else
                /*if(diachidv=="")
                {
                    alert("Nhập địa chỉ tổ chức");
                    document.ThemKH.DiaChiDV.focus();
                   // return false;
                }else
                */if(sdk=="")
                {
                    alert("Nhập số đăng ký kinh doanh tổ chức");
                    document.ThemKH.SKD.focus();
                    //return false;
                }else
                if(hoten=="")
                {
                    alert("Nhập đầy đủ họ tên khách hàng");
                    document.ThemKH.HoTenDV.focus();
                   // return false;
                }else
                if(cmnd=="")
                {
                    alert("Nhập CMND khách hàng");
                    document.ThemKH.CMNDDV.focus();
                   // return false;
                }else
                /*if(ngsinh=="")
                {
                    alert("Nhập ngày sinh");
                    document.ThemKH.NgSinhDV.focus();
                   // return false;
                }else
                if(diachi=="")
                {
                    alert("Nhập địa chỉ khách hàng");
                    document.ThemKH.DiaChiKHDV.focus();
                   // return false;
                } else
                if(email=="")
                {
                    alert("Nhập email");
                    document.ThemKH.EmailDV.focus();
                    //return false;
                }else
                */if(sdt=="")
                {
                    alert("Nhập số điện thoại");
                    document.ThemKH.SDTDV.focus();
                   /// return false;
                }else
                if(stk=="")
                {
                    alert("Nhập số tài khoản ngân hàng");
                    document.ThemKH.STKDV.focus();
                    //return false;
                }
                else
                {
                    action = "Them_KHTC";
                    $.post("../control/QuanLyKhachHangCtrl.php",{action:action,HoTen:hoten,cmnd:cmnd,STK:stk,tendv:tendv,sdk:sdk,sdt:sdt},function(data){$('#ThemTKiB').html(data).show();});

                }
            }
        }

    </script>
</head>

<body>
<form name ="ThemKH">
Thêm khách hàng <select name="KH" onchange="showform()">
    <option value ="KH">Chọn loại KH</option>
    <option value ="KHCN">Cá nhân</option>
    <option value ="KHTC">Tổ chức</option>
</select>
<div id="KHCN" style="display:none">
    <table border="1">
        <tr>
            <td> Họ tên khách hàng </td>
            <td> <input type="text" name="HoTen"></td>
        </tr>
        <tr>
            <td> CMND </td>
            <td> <input type="text" name="CMND" onkeypress='is_number(event)'></td>
        </tr>

        <tr>
            <td> Số điện thoại</td>
            <td> <input type="text" name="SDT"onkeypress='is_number(event)'></td>
        </tr>

        <tr>
            <td>Số tài khoản</td>
            <td><input type="text" name="STK"onkeypress='is_number(event)'></td>
        </tr>
     </table>
    <input type="button" value ="Thêm mới" onclick="return checkinfo()">
</div>
<div id="KHTC" style="display:none">
    <table border="1">
        <tr>
            <td> Tên đơn vị </td>
            <td> <input type="text" name="TenDV"></td>
        </tr>
        <tr>
            <td> Địa chỉ liên hệ </td>
            <td> <input type="text" name="DiaChiDV"></td>
        </tr>
        <tr>
            <td>Số đk kinh doanh</td>
            <td><input type="text" name="SKD"onkeypress='is_number(event)'></td>
        </tr>
        <tr>
            <td> Họ tên khách hàng </td>
            <td> <input type="text" name="HoTenDV"></td>
        </tr>

        <tr>
            <td> Số điện thoại</td>
            <td> <input type="text" name="SDTDV"onkeypress='is_number(event)'></td>
        </tr>

        <tr>
            <td>Số tài khoản</td>
            <td><input type="text" name="STKDV"onkeypress='is_number(event)'></td>
        </tr>
    </table>
    <input type="button" value ="Thêm mới" onclick="return checkinfo()">
</div>
    <div id="ThemTKiB"></div>
</form>
</body>
