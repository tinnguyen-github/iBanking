<?php
include_once "../../../model/LoaiGiaoDich.php";
$lgd= new LoaiGiaoDich();
?>
<script>

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
    function show(x)
    {
        if(x=="TIME")
        {
            $('#thongke_time').show();
            $('#thongke_all').hide();
        }
        if(x=="all")
        {
            $('#thongke_time').hide();
            $('#thongke_all').show();
            $.post("../control/iBanking_thongke.php",{action:"All"},function(data){$('#thongke_all').html(data).show();});
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
            $.post("../control/iBanking_thongke.php",{action:"TIME",time:time},function(data){$('#show_time').html(data).show();});
        }
        if(x==2)
        {
            thang = document.ThongKe_form.thang_1.value;
            if(thang.length==1) thang = '0'+thang;
            nam = document.ThongKe_form.nam_1.value;
            time = nam+'-'+thang;
            $.post("../control/iBanking_thongke.php",{action:"TIME",time:time},function(data){$('#show_time').html(data).show();});
        }
        if(x==3)
        {
            time = nam = document.ThongKe_form.nam_2.value;
            // alert(time);
            $.post("../control/iBanking_thongke.php",{action:"TIME",time:time},function(data){$('#show_time').html(data).show();});
        }

    }
</script>

Chọn thống kê theo &nbsp &nbsp</t><input type="radio" id="thongke" name="thongke" value="TIME" onclick="show(this.value)">Thời gian &nbsp<input type="radio" name="thongke" value="all"onclick="show(this.value)">Tất cả
<br>
<form name="ThongKe_form">
    <div id="thongke_time" style="display: none">
        Chọn thời gian theo &nbsp &nbsp</t><input type="radio" id="chonthoigian" name="chonthoigian" value="ngay" onclick="showthoigian(this.value)">Ngày<input type="radio" id="chonthoigian" name="chonthoigian" value="thang" onclick="showthoigian(this.value)">Tháng<input type="radio" id="chonthoigian" name="chonthoigian" value="nam" onclick="showthoigian(this.value)">Năm
     <div id="theongay"style="display: none">   Theo ngày <input class="So"type="text" name="ngay" style="width: 50px" placeholder="Ngày"><input class="So"style="width: 50px"type="text" name="thang"placeholder="Tháng"><input class="So"style="width: 50px"type="text" name="nam"placeholder="Năm"><input type="button"onclick="thongke(1)" value="Thống kê"></div>
       <div id="theothang"style="display: none"> Theo tháng <input class="So"type="text" style="width: 50px"name="thang_1" placeholder="Tháng"><input class="So"style="width: 50px"type="text" name="nam_1"placeholder="Năm"><input type="button"onclick="thongke(2)" value="Thống kê"></div>
        <div id="theonam"style="display: none">Theo năm <input class="So"type="text" style="width: 50px"name="nam_2"placeholder="Năm"><input type="button"onclick="thongke(3)" value="Thống kê"></div>
        <div id="show_time"></div>
    </div>
    <div id="thongke_all" style="display: none">

    </div>

</form>