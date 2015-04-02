<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="jquery.js" ></script>
<head>
    <?php
    //include_once "../../../control/QuanLiDichVuCtrl.php";
   // $QLDVCtrl= new QLKHCtrl();
    ?>
<style>
    #main_DV
    {
        margin-right:20px;
        float:right;

        width: 71%;
    }
</style>
<script type="text/javascript">

    function ds(a,b)
    {

        $.post("../control/QuanLiDichVuCtrl.php",{action:a,page:b},function(data){$('#main_DV').html(data).show();});

    }
    function addLDV()
    {
        $.post("../NhanVieniBanking/views/qldv/FormThemLoaiDichVu.php",function(data){$('#main_DV').html(data).show();});
    }
    function addNCC()
    {
        $.post("../NhanVieniBanking/views/qldv/FormThemNCC.php",function(data){$('#main_DV').html(data).show();});
    }
    function addDV()
    {
        $.post("../NhanVieniBanking/views/qldv/ThemDichVuForm.php",function(data){$('#main_DV').html(data).show();});
    }
    function stopDV(id)
    {
        comfirmBox = confirm("Xác nhận dừng dịch vụ?");
        if(comfirmBox == true){
            $.post("../control/QuanLiDichVuCtrl.php",{id:id,stop:"dv"},function(data){$('#action').html(data).show();});

        }

    }
    function actiDV(id)
    {
        comfirmBox = confirm("Xác nhận kích hoạt lại dịch vụ?");
        if(comfirmBox == true){
            $.post("../control/QuanLiDichVuCtrl.php",{id:id,acti:"dv"},function(data){$('#action').html(data).show();});
            //alert(id);
        }
    }
    function stopNCC(id)
    {
        comfirmBox = confirm("Xác nhận dừng hợp tác với NCC?");
        if(comfirmBox == true){
            $.post("../control/QuanLiDichVuCtrl.php",{id:id,stop:"ncc"},function(data){$('#action').html(data).show();});
        }

    }
    function actiNCC(id)
    {
        comfirmBox = confirm("Xác nhận kích hoạt lại hợp tác với NCC?");
        if(comfirmBox == true){
            $.post("../control/QuanLiDichVuCtrl.php",{id:id,acti:"ncc"},function(data){$('#action').html(data).show();});
        }
    }
    function updateInfo(id)
    {
       // alert(id);
     $.post("../NhanVieniBanking/views/qldv/SuaThongTinNhaCungCapForm.php",{id:id},function(data){$('#main_DV').html(data).show();});
    }
</script>
</head>
<body>

    <div id="main_DV">


        <!-- <section id="main">  -->




        <!-- </section> -->
    </div>

    <aside class="sidebar">

        <ul>
            <li>
                <h4>Thông tin quản lý</h4>
                <ul>
                    <li class="text">
                        <p style="margin: 0;"><a  href="#"onClick="ds(1,1)">Danh sách dịch vụ</a></p>
                        <p style="margin: 0;"><a  href="#"onClick="ds(2,1)">Danh sách loại dịch vụ</a></p>
                        <p style="margin: 0;"><a  href="#"onClick="ds(3,1)">Danh sách nha cung cấp</a></p>
                    </li>

                </ul>





        </ul>

    </aside>
    <div class="clear"></div>


<div id="action"></div>
</body>
</html>