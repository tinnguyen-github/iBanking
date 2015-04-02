<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery.js" ></script>


<script>
    function checkinfo()
    {
       // alert("1");
        tenncc = document.ThemNCC.TenNCC.value;
        diachi = document.ThemNCC.DiaChi.value;
        Loaidv=document.ThemNCC.LoaiDichVu.value;
        stk=document.ThemNCC.STK.value;
        sdt=document.ThemNCC.SDT.value;
        //alert("1");
        if(tenncc=="")
        {
            alert("Nhập tên NCC");
            document.ThemNCC.TenNCC.focus();
            //return false;
        }else
        if(diachi=="")
        {
            alert("Nhập địa chỉ");
            document.ThemNCC.DiaChi.focus();
            //return false;
        }else
        if(stk=="")
        {
            alert("Nhập số tài khoản ngân hàng");
            document.ThemNCC.STK.focus();
            //return false;
        }else
        if(sdt=="")
        {
            alert("Nhập số điện thoại");
            document.ThemNCC.SDT.focus();
            //return false;
        }else if(Loaidv=="")
    {
        alert("Nhập loại hình dịch vụ");
        document.ThemNCC.LoaiDichVu.focus();
        //return false;
    }
        else
        {
            action = "Them_KHCN";
            $.post("../control/QuanLiDichVuCtrl.php",{add:"ThemNCC",sdt:sdt,tenncc:tenncc,Loaidv:Loaidv,stk:stk,diachi:diachi},function(data){$('#ThemNCC').html(data).show();});

        }
    }
</script>
<form name ="ThemNCC">
    <div id="NCC" >
        <table border="1">
            <tr>
                <td> Tên nhà cung cấp dịch vụ </td>
                <td> <input type="text" name="TenNCC"></td>
            </tr>
            <tr>
                <td> Địa chỉ </td>
                <td> <input type="text" name="DiaChi"></td>
            </tr>
            <tr>
                <td>SDT</td>
                <td><input type="text" name="SDT"onkeypress='is_number(event)'></td>
            </tr>
            <tr>
                <td> Loại dịch vụ</td>
                <td> <input type="text" name="LoaiDichVu"></td>
            </tr>
            <tr>
                <td>Số tài khoản</td>
                <td><input type="text" name="STK"onkeypress='is_number(event)'></td>
            </tr>
        </table>
        <input type="button" value ="Thêm mới" onclick="checkinfo()">
    </div>
    <div id="ThemNCC"></div>
</form>