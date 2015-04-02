<?php
include_once "../../../model/LoaiGiaoDich.php";
$lgd= new LoaiGiaoDich();
?>
<script>
    function show(x)
    {
        if(x=="TIME")
        {
            $('#thongke_time').show();
            $('#thongke_kh').hide();
            $('#thongke_lgd').hide();
        }
        if(x=="KH")
        {
            $('#thongke_time').hide();
            $('#thongke_kh').show();
            $('#thongke_lgd').hide();
        }
        if(x=="LGD")
        {
            $('#thongke_time').hide();
            $('#thongke_kh').hide();
            $('#thongke_lgd').show();
        }

    }
    function showthoigian(x)
    {
        if(x=="ngay")
        {
            $('#theongay').show();
            $('#theothang').hide();
            $('#theonam').hide();
        }
        if(x=="thang")
        {
            $('#theongay').hide();
            $('#theothang').show();
            $('#theonam').hide();
        }
        if(x=="nam")
        {
            $('#theongay').hide();
            $('#theothang').hide();
            $('#theonam').show();
        }
    }
    function thongke(x)
    {
        if(x==1)
        {
            ngay = document.ThongKe_form.ngay.value;
            if(ngay.length==1) ngay = '0'+ngay;
            thang = document.ThongKe_form.thang.value;
            if(thang.length==1) thang = '0'+thang;
            nam = document.ThongKe_form.nam.value;
            time = nam+'-'+thang+'-'+ngay;
            $.post("../control/NVTTKDCtrl.php",{action:"TIME",time:time},function(data){$('#show_time').html(data).show();});
        }
        if(x==2)
        {
            thang = document.ThongKe_form.thang_1.value;
            if(thang.length==1) thang = '0'+thang;
            nam = document.ThongKe_form.nam_1.value;
            time = nam+'-'+thang;
            $.post("../control/NVTTKDCtrl.php",{action:"TIME",time:time},function(data){$('#show_time').html(data).show();});
        }
        if(x==3)
        {
            time = nam = document.ThongKe_form.nam_2.value;
            // alert(time);
            $.post("../control/NVTTKDCtrl.php",{action:"TIME",time:time},function(data){$('#show_time').html(data).show();});
        }
        if(x==4)
        {
            tenkh= document.ThongKe_form.tenkhachhang.value;
           // alert(tenkh);
            $.post("../control/NVTTKDCtrl.php",{action:"KH",tenkh:tenkh},function(data){$('#show_kh').html(data).show();});
        }
        if(x==5)
        {
            lgd= document.ThongKe_form.MaLDV.value;
           // alert(lgd);
            $.post("../control/NVTTKDCtrl.php",{action:"LGD",lgd:lgd},function(data){$('#show_lgd').html(data).show();});
        }
    }
    </script>

Chọn thống kê theo &nbsp &nbsp</t><input type="radio" id="thongke" name="thongke" value="TIME" onclick="show(this.value)">Thời gian &nbsp<input type="radio" name="thongke" value="KH"onclick="show(this.value)">Khách hàng &nbsp<input onclick="show(this.value)"type="radio" name="thongke" value="LGD">Loại giao dịch
<br>
<form name="ThongKe_form">
    <div id="thongke_time" style="display: none">
        Chọn thời gian theo &nbsp &nbsp</t><input type="radio" id="chonthoigian" name="chonthoigian" value="ngay" onclick="showthoigian(this.value)">Ngày<input type="radio" id="chonthoigian" name="chonthoigian" value="thang" onclick="showthoigian(this.value)">Tháng<input type="radio" id="chonthoigian" name="chonthoigian" value="nam" onclick="showthoigian(this.value)">Năm
        <div id="theongay"style="display: none">   Theo ngày <input class="So"type="text" name="ngay" style="width: 50px" placeholder="Ngày"><input class="So"style="width: 50px"type="text" name="thang"placeholder="Tháng"><input class="So"style="width: 50px"type="text" name="nam"placeholder="Năm"><input type="button"onclick="thongke(1)" value="Thống kê"></div>
        <div id="theothang"style="display: none"> Theo tháng <input class="So"type="text" style="width: 50px"name="thang_1" placeholder="Tháng"><input class="So"style="width: 50px"type="text" name="nam_1"placeholder="Năm"><input type="button"onclick="thongke(2)" value="Thống kê"></div>
        <div id="theonam"style="display: none">Theo năm <input class="So"type="text" style="width: 50px"name="nam_2"placeholder="Năm"><input type="button"onclick="thongke(3)" value="Thống kê"></div>
        <div id="show_time"></div>
    </div>
<div id="thongke_kh" style="display: none">
    Nhập tên khách hàng <input type="text" name="tenkhachhang"><input type="button"onclick="thongke(4)" value="Thống kê">

    <div id="show_kh"></div>
</div>
<div id="thongke_lgd" style="display: none">
    Chọn loại giao dịch <?php
    //$lgd->getLGD();
    $lgd->showLGD();
    ?><input type="button"onclick="thongke(5)" value="Thống kê">
    <div id="show_lgd"></div>
</div>
    </form>