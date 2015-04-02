<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
include_once "../model/KhachHang.php";
include_once "../model/KhachHangToChuc.php";
include_once "../model/condb.php";
include_once "../model/TKNganHang.php";
$tknh= new TKNganHang();
$con= new myDBC();
$khcn= new KhachHang();
$khtc= new KhachHangToChuc();
$action=$_POST["action"];
$time = $_POST["time"];

if($action=="TIME")
{
    echo '
           <table border="1">
                <tr>

                    <th>Tên khách hàng</th>
                    <th>Số CMND</th>
                    <th>Mã tài khoản iBanking</th>
                    <th>Số tài khoản</th>
                    <th>Số dư</th>
                </tr>';
    $qt = $con->runQuery("select * from account where NgayMo like '%".$time."%' and ( Quyen =1 or Quyen =2) " );
    while ($resultt =  mysqli_fetch_array($qt))
    {
        $tenkh = $khcn->getTenKhFuser($resultt['Username']);
        $cmnd = $khcn->getCMNDFUser($resultt['Username']);

        if($tenkh!="")
        {
            $count_field =0;
            echo '<tr>';
            while ($count_field < 5)
            {
                if($count_field == 0 )
                {

                    echo "<td>".$tenkh."</td>";
                }
                if($count_field == 1  )
                {

                    echo "<td>".$cmnd."</td>";
                }
                if($count_field == 2  )
                {

                    echo "<td>".$resultt['Username']."</td>";
                }
                if($count_field == 3 )
                {
                    echo "<td>";
                    $qt1 = $con->runQuery("select * from taikhoannganhang where MaiBanking = '".$resultt['Username']."'");
                    while ($resultt1 = mysqli_fetch_array($qt1))
                    {
                        echo $resultt1['STK']."<br>";
                    }
                    echo "</td>";
                }
                if($count_field == 4 )
                {
                    echo "<td>";
                    $qt2 = $con->runQuery("select * from taikhoannganhang where MaiBanking = '".$resultt['Username']."'");
                    while ($resultt2 = mysqli_fetch_array($qt2))
                    {
                        echo $resultt2['SoDU']."<br>";
                    }
                    echo "</td>";
                }
                $count_field = $count_field + 1;
            }echo '</tr>';

        }
    }
    echo '</table><br>';/*
    echo '
           <table border="1">
                <tr>

                    <th>Tên Tổ Chức</th>
                    <th>Số DKKD</th>
                    <th>Mã tài khoản iBanking</th>
                    <th>Số tài khoản</th>
                    <th>Số dư</th>
                </tr>';
    $qt3 = $con->runQuery("select * from account where NgayMo like '%".$time."%'and ( Quyen =1 or Quyen =2) ");
    while ($resultt3 =  mysqli_fetch_array($q3))
    {
        $tentc = $khtc->getTenTCFUser($resultt3['Username']);
        if($tentc!=="")
        {
            $SoDKKD = $khtc->getSoDKKDFUser($resultt3['Username']);
            $count_field =0;
            echo '<tr>';
            while ($count_field < 5)
            {
                if($count_field == 0 )
                {

                    echo "<td>".$tentc."</td>";
                }
                if($count_field == 1  )
                {

                    echo "<td>".$SoDKKD."</td>";
                }
                if($count_field == 2  )
                {

                    echo "<td>".$resultt3['Username']."</td>";
                }
                if($count_field == 3 )
                {
                    echo "<td>";
                    $qt4 = $con->runQuery("select * from taikhoannganhang where MaiBanking = '".$resultt3['Username']."'");
                    while ($resultt4 = mysqli_fetch_array($qt4))
                    {
                        echo $resultt4['STK']."<br>";
                    }
                    echo "</td>";
                }
                if($count_field == 4 )
                {
                    echo "<td>";
                    $qt5 = $con->runQuery("select * from taikhoannganhang where MaiBanking = '".$resultt3['Username']."'");
                    while ($resultt5 = mysqli_fetch_array($qt5))
                    {
                        echo $resultt5['SoDU']."<br>";
                    }
                    echo "</td>";
                }
                $count_field = $count_field + 1;
            }
            echo '</tr>';

        }
        echo '</table>';
    }*/
}

if($action=="All")
{
    echo '
           <table border="1">
                <tr>

                    <th>Tên khách hàng</th>
                    <th>Số CMND</th>
                    <th>Mã tài khoản iBanking</th>
                    <th>Số tài khoản</th>
                    <th>Số dư</th>
                </tr>';
    $qa = $con->runQuery("select * from account where  Quyen =1 or Quyen =2 ");
    while ($resulta =  mysqli_fetch_array($qa))
    {
        $tenkh = $khcn->getTenKhFuser($resulta['Username']);
        if($tenkh!="")
        {
            $cmnd = $khcn->getCMNDFUser($resulta['Username']);
            $count_field =0;
            echo '<tr>';
            while ($count_field < 5)
            {
                if($count_field == 0 )
                {

                    echo "<td>".$tenkh."</td>";
                }
                if($count_field == 1  )
                {

                    echo "<td>".$cmnd."</td>";
                }
                if($count_field == 2  )
                {

                    echo "<td>".$resulta['Username']."</td>";
                }
                if($count_field == 3 )
                {
                    echo "<td>";
                    $qa1 = $con->runQuery("select * from taikhoannganhang where MaiBanking = '".$resulta['Username']."'");
                    while ($resulta1 = mysqli_fetch_array($qa1))
                    {
                        echo $resulta1['STK']."<br>";
                    }
                    echo "</td>";
                }
                if($count_field == 4 )
                {
                    echo "<td>";
                    $qa2 = $con->runQuery("select * from taikhoannganhang where MaiBanking = '".$resulta['Username']."'");
                    while ($resulta2 = mysqli_fetch_array($qa2))
                    {
                        echo $resulta2['SoDU']."<br>";
                    }
                    echo "</td>";
                }
                $count_field = $count_field + 1;
            }
        }echo '</tr>';

    }

/*
    echo '</table><br>';
    echo '
           <table border="1">
                <tr>

                    <th>Tên Tổ Chức</th>
                    <th>Số DKKD</th>
                    <th>Mã tài khoản iBanking</th>
                    <th>Số tài khoản</th>
                    <th>Số dư</th>
                </tr>';
    $qa3 = $con->runQuery("select * from account where Quyen =1 or Quyen =2");
    while ($resulta3 =  mysqli_fetch_array($qa3))
    {
        $tentc = $khtc->getTenTCFUser($resulta3['Username']);
        //echo '<script>alert("'.$tentc.'");</script>';
        IF($tentc!="")
        {
            $SoDKKD = $khtc->getSoDKKDFUser($resulta3['Username']);
            $count_field =0;
            echo '<tr>';
            while ($count_field < 5)
            {
                if($count_field == 0 )
                {

                    echo "<td>".$tentc."</td>";
                }
                if($count_field == 1  )
                {

                    echo "<td>".$SoDKKD."</td>";
                }
                if($count_field == 2  )
                {

                    echo "<td>".$resulta3['Username']."</td>";
                }
                if($count_field == 3 )
                {
                    echo "<td>";
                    $qa4 = $con->runQuery("select * from taikhoannganhang where MaiBanking = '".$resulta3['Username']."'");
                    while ($resulta4 = mysqli_fetch_array($qa4))
                    {
                        echo $resulta4['STK']."<br>";
                    }
                    echo "</td>";
                }
                if($count_field == 4 )
                {
                    echo "<td>";
                    $qa5 = $con->runQuery("select * from taikhoannganhang where MaiBanking = '".$resulta3['Username']."'");
                    while ($resulta5 = mysqli_fetch_array($qa5))
                    {
                        echo $resulta5['SoDU']."<br>";
                    }
                    echo "</td>";
                }
                $count_field = $count_field + 1;
            }echo '</tr>';
        }

    }
    echo '</table>';*/
}

?>