<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="./js/Jquery.js" ></script>
<?php
include_once "../../../control/QuanLyKhachHangCtrl.php";
$QLKHCtrl= new QLKHCtrl();
?>
<script>
    function Search(x)
    {

        if(x=='KHCN')
        {
            tenkh= document.form_khachhang.search_khcn.value;
            if(tenkh=="") alert("Nhập tên khách hàng trước khi tìm kiếm");
            else{
            $('#KHCN').hide();
            $('#Search_KHTC').show();
            $.post("../NhanVieniBanking/views/qlkh/Search.php",{kh:x,tenkh:tenkh},function(data){$('#Search_KHCN').html(data).show();});
            }
        }
        if(x=='KHTC')
        {
            tentc= document.form_khachhang.search_khtc.value;
            if(tenkh=="") alert("Nhập tên tổ chức trước khi tìm kiếm");
            else{
            $('#KHTC').hide();
            $('#Search_KHTC').show();
            $.post("../NhanVieniBanking/views/qlkh/Search.php",{kh:x,tenkh:tentc},function(data){$('#Search_KHTC').html(data).show();});

                }
        }

    }
    function showDS(x)
    {
        if(x=='KHCN')
        {
            $('#DS_KHCN').show();
            $('#DS_KHTC').hide();
        }
        if(x=='KHTC')
        {
            $('#DS_KHCN').hide();
            $('#DS_KHTC').show();
        }

    }
    function ShowInfo(x)
    {
        if(x=='KHCN')
        {
            $('#KHCN').show();
            $('#Search_KHCN').hide();
        }
        if(x=='KHTC')
        {
            $('#KHTC').show();
            $('#Search_KHTC').hide();
        }

    }
    function ThemTKDV()
    {
        $.post("../NhanVieniBanking/views/qlkh/MoTKDV.php",function(data){$('#ThongTinKh').html(data).show();});
    }
    function MoKhoa(user)
    {
        ac="Lock";
        comfirmBox = confirm("Xác nhận mở khóa tài khoản "+ user +" ?");
        if(comfirmBox == true){
            $.post("../control/QuanLyKhachHangCtrl.php",{user:user,action:ac},function(data){$('#action_form').html(data).show();});
        }

    }
    function HuyTK(user)
    {
        ac="Del";
        comfirmBox = confirm("Xác nhận hủy tài khoản "+ user +" ?");
        if(comfirmBox == true){
            $.post("../control/QuanLyKhachHangCtrl.php",{user:user,action:ac},function(data){$('#action_form').html(data).show();});
        }
    }
    function SuaTT(id)
    {
        //window.location= "SuaThongTinKhachHangPage.php?id="+id;
      // alert(id);
        $.post("../NhanVieniBanking/views/qlkh/SuaThongTinKhachHangPage.php",{id:id},function(data){$('#ThongTinKh').html(data).show();});
        //alert("load xong sua thông tin page");
    }
    function ds(a,b)
    {
        //alert(b);
       if(a==1)
       $.post("../control/QuanLyKhachHangCtrl.php",{action:a,page:b},function(data){$('#KHCN').html(data).show();});
        if(a==2)
            $.post("../control/QuanLyKhachHangCtrl.php",{action:a,page:b},function(data){$('#KHTC').html(data).show();});
    }
</script>
<div id="ThongTinKh">
<form name = "form_khachhang">
    <input type="radio" name="DSKH" value="KHCN" onclick="showDS(this.value)">Khách hàng <input type="radio" name="DSKH" value="KHTC"onclick="showDS(this.value)">Khách hàng tổ chức

    <div id="DS_KHCN" style="display: none">
<input type="text" placeholder="Nhập tên khách hàng muốn tìm kiếm"name="search_khcn"><input type="button" value="Search"onclick="Search('KHCN')"><input type="button" value="Tất cả"onclick="ShowInfo('KHCN')">
<div id="KHCN" >
    <?php
        $QLKHCtrl->showKH(1);
    ?>
</div>
<div id="Search_KHCN">
</div>
        </div>
<br>
    <div id="DS_KHTC" style="display: none">
<input type="text" placeholder="Nhập tên tổ chức muốn tìm kiếm"name="search_khtc"><input type="button" value="Search"onclick="Search('KHTC')"><input type="button" value="Tất cả"onclick="ShowInfo('KHTC')">
<div id="KHTC">
    <?php
        $QLKHCtrl->showKHTC(1);
    ?>
</div>
<div id="Search_KHTC">
</div>
<div id="action_form">

</div>
</div>
<br>
<input type="button" value="Thêm mới"onclick="ThemTKDV()">
</form></div>
