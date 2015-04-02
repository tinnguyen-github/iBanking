<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <title>Trang khách hàng cá nhân</title>
    <link rel="stylesheet" href="../css/styles.css" type="text/css" />
    <script src="../js/Jquery.js"> </script>
</head>
<?php
session_start();
if($_SESSION['isLogin'] == false)
    echo '<script>window.location="../index.php";</script>';
?>
<script>
    function callpage( P)
    {
        //alert("Goi TRang");
        switch(P)
        {
            case 1:
                $.post( "views/ChuyenKhoan.php", function( data ) {
                    $( "#main" ).html( data ).show;
                });
                break;
            case 2:
                $.post("views/TraoDoiNgoaiTe.php",function(data)
                {
                    $('#main').html(data).show();
                });
                break;
            case 3:
                $.post("views/ThanhToanHoaDon.php",function(data)
                {
                    $('#main').html(data).show();
                });
                break;
            case 4:
                $.post("views/VanTinTaiKhoan.php",function(data)
                {
                    $('#main').html(data).show();
                });
                break;
            case 5:
                $.post( "views/NhatKyGiaoDich.php", function( data ) {
                    $( "#main" ).html( data ).show;
                });
                break;
            case 6:
                $.post( "views/DangKyiBanking.php", function( data ) {
                    $( "#main" ).html( data ).show;
                });
                break;
            case 0:
                $.post( "../control/LogIn_Outctrl.php",{Action:"Dangxuat"}, function( data ) {
                    $( "#main" ).html( data ).show;
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
            <li ><a href="#"onclick="callpage(1)">Chuyển khoản</a></li>
            <li ><a href="#"onclick="callpage(2)">Trao đổi ngoại tệ</a></li>
            <li ><a href="#"onclick="callpage(3)">thanh toán hóa đơn</a></li>
            <li ><a href="#"onclick="callpage(4)">vấn tin tài khoản</a></li>
            <li class="end"><a href="#"onclick="callpage(5)">nhật ký giao dịch</a></li>
        </ul>
    </nav>
    <div id="body">
        <div id="main">


            <!-- <section id="main">  -->

            <article>

                <h2>	Chào mừng đến với dịch vụ iBanking.</h2><br>
                <h3> THÔNG TIN KHÁCH HÀNG</h3> <br>

                <?php
                include_once"../model/Account.php";
                $temp= new Account();
                $res=$temp->getInfoUser();
                //$HoTen="";
                while($data=mysqli_fetch_array($res))
                {
                    //$HoTen=$data["HoTen"];
                    echo 'Họ tên: '.$data["HoTen"]."<br>";
                    echo 'Số điện thoại : '.$data["SDT"]."<br>";
                    echo 'Địa chỉ : '.$data["DiaChi"]."<br>";
                    echo 'email: '.$data["email"]."<br>";
                    echo 'Ngày sinh:'.$data["NgaySinh"]."<br>";
                    echo 'Chứng minh nhân dân:'.$data["CMND"]."<br>";
                }
                // return $HoTen;
                ?>

                <!--<h2>TÊN TRANG HIỆN TẠI</h2>
                <div class="article-info">Cho thời gian vào đây!</div>
    Nội dung
    Het noi dung chinh -->

            </article>


            <!-- </section> -->
        </div>

        <aside class="sidebar">

            <ul>
                <li>
                    <h4>thông tin đăng nhập</h4>
                    <ul>
                        <li class="text">
                            <!--<p style="margin: 0;">Cho 1 button logout ở đây.</p>-->
                            <p style="margin: 0;">
                                Chào mừng
                                <?php
                                include_once"../model/Account.php";
                                $temp= new Account();
                                $res=$temp->getInfoUser();
                                //$HoTen="";
                                while($data=mysqli_fetch_array($res))
                                {
                                    //$HoTen=$data["HoTen"];
                                    echo $data["HoTen"];
                                }
                                // return $HoTen;
                                ?>
                            </p>
                        </li>

                    </ul>
                <li>
                    <h4>Quản lý thông tin cá nhân</h4>
                    <ul>
                        <!--    <li ><a href="#"onclick="callpage(0)">Logout</a></li> -->
                        <li><a href="index.PHP">Đổi số điện thoại nhận OTP</a></li>
                        <li><a href="#"onclick="callpage(6)">Đăng ký iBanking cho tài khoản</a></li>
                        <li><a href="index.PHP">Thông tin tài khoản iBanking</a></li>
                        <li><a href="#"onclick="callpage(5)">Nhật ký giao dịch</li>
                        <li><a href="#"onclick="callpage(4)">Danh sách các tài khoản sử dụng iBanking</a></li>
                    </ul>
                </li>

                <li>
                    <h4>tìm kiếm tài khoản</h4>
                    <ul>
                        <li class="text">
                            <form method="get" class="searchform" action="#" >
                                <p>
                                    <input type="text" size="25" value="" name="s" class="s" />

                                </p>
                            </form>
                        </li>
                    </ul>
                </li>


            </ul>

        </aside>
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