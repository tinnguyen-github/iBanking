<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title>Trang khách hàng cá nhân</title>
    <link rel="stylesheet" href="../css/styles.css" type="text/css" />
    <script src="../js/Jquery.js"> </script>
    <style>
        #main_TGHD
        {
            margin-right:20px;
            float:left;

            width: 95%;
        }
    </style>
</head>
<?php
session_start();
if($_SESSION['isLogin'] == false)
    echo '<script>window.location="../index.php";</script>';
if($_SESSION['Quyen']!=5)  echo '<script>window.location="../index.php";</script>';
?>
<script>
    function ds(b)
    {
        $.post("../control/NVKDNTCtrl.php",{page:b},function(data){$('#show').html(data).show();});

    }
    ds(1);
    function capnhattygia(id)
    {
        document.getElementById(id+"2").disabled = false;
        document.getElementById(id+"3").disabled = false;
        document.getElementById(id+"update").value = "Cập nhật";
        document.getElementById(id+"update").setAttribute("onclick","update_TGTD("+id+")") ;
    }
    function update_TGTD(id)
    {
        giamua=  document.getElementById(id+"2").value;
        giaban=  document.getElementById(id+"3").value;
        $.post("../control/NVKDNTCtrl.php",{id:id,giamua:giamua,giaban:giaban},function(data){$('#action').html(data).show();});
    }
    function callpage( P)
    {
        //alert("Goi TRang");
        /*  if(P==0)
         {
         alert(P);
         $.post( "../control/LogIn_Outctrl.php",{Action:"Dangxuat"} function( data ) {
         $( "#main_NV" ).html( data ).show;
         });
         }*/
        if(P==0)
        {
            $.post( "../control/LogIn_Outctrl.php",{Action:"Dangxuat"}, function( data ) {
                $( "#main_TGHD" ).html( data ).show;
            });
        }}
    // alert("goi ham!");
    //$("#main").post("views/ChuyenKhoan.php");
    //$('#main').html("views/ChuyenKhoan.php");
</script>
<body>
<div id="container">
    <header>
        <h1><a href="#">i<span><i>B</i></span>anking</a></h1>
        <h2>10520270 - 10520294</h2>
    </header>
    <nav>
        <ul>
            <li ><a href="#"onclick="callpage(0)">Logout</a></li>

        </ul>
    </nav>
    <div id="body">
        <div id="main_TGHD">


            <div id="show">

            </div>
            <div id="action"></div>


            <!-- </section> -->
        </div>


        <div class="clear"></div>
    </div>
    <footer>
        <div class="footer-content">
            <ul>SINH VIÊN THỰC HIỆN
                <li>Vũ Trọng Tùng</li>
                <li>Nguyễn Thành Tin </li>
            </ul>
            <ul>
                GIẢNG VIÊN HƯỚNG DẪN
                <li>ThS. Nguyễn Đình Loan Phương</li>
            </ul>

            <div class="clear"></div>
        </div>
        <div class="footer-bottom">
            <p>Đồ án Hệ Thống Thông Tin năm học 2013 - 2014 </p>
        </div>
    </footer>
</div>
</body>
</html>