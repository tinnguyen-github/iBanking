<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title>Trang Nhân viên phòng dịch vụ iBanking </title>
    <link rel="stylesheet" href="../css/styles.css" type="text/css" />
    <link rel="stylesheet" href="../css/styles.css" type="text/css" />
    <script src="../js/Jquery.js"> </script>
    <style>


    </style>
</head>
<?php
session_start();
if($_SESSION['isLogin'] == false)
    echo '<script>window.location="../index.php";</script>';
if($_SESSION['Quyen']!=4)  echo '<script>window.location="../index.php";</script>';
?>
<script>
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
                $( "#main_NV" ).html( data ).show;
            });
        }
        if(P==1)
        {
            $.post( "views/qlkh/QuanLyKhachHangPage.php", function( data ) {
                $( "#main_NV" ).html( data ).show;
            });
        }
        if(P==2)
        {
            $.post( "views/qldv/QuanLyDichVuPage.php", function( data ) {
                $( "#main_NV" ).html( data ).show;
            });
        }
        if(P==3)
        {
            $.post( "views/thongke/Thongke.php", function( data ) {
                $( "#main_NV" ).html( data ).show;
            });
        }

    }
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
            <li ><a href="#"onclick="callpage(1)">Quản lý khách hàng</a></li>
            <li ><a href="#"onclick="callpage(2)">Quản lý dịch vụ</a></li>
            <li class="end"><a href="#"onclick="callpage(3)">Thống kê danh sách khách hàng</a></li>
        </ul>
    </nav>
    <div id="body">
        <div id="main_NV">


            <!-- <section id="main">  -->

            <article>
                Noi dung chính

                <h2>TÊN TRANG HIỆN TẠI</h2>
                <div class="article-info">Cho thời gian vào đây!</div>
                Nội dung
                Het noi dung chinh

            </article>


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