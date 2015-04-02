<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
include_once "../model/KhachHang.php";
include_once "../model/KhachHangToChuc.php";
include_once "../model/LoaiGiaoDich.php";
include_once "../model/QuyDinh.php";
include_once "../model/condb.php";
include_once "../model/TKNganHang.php";
$tknh= new TKNganHang();
$quydinh = new QuyDinh();
$con= new myDBC();
$khcn= new KhachHang();
$khtc= new KhachHangToChuc();
$lgd= new LoaiGiaoDich();
$page = $_POST["page"];
$id = $_POST["id"];
$toida= $_POST['toida'];
$mucphi= $_POST['mucphi'];
$ac=$_POST["action"];
$time = $_POST["time"];
$kh= $_POST['tenkh'];
$malgd= $_POST['lgd'];
if($page)
{
   $quydinh->showInfo($page);
}
if($id)
{
    $check_updateQD = $quydinh->update($id,$toida,$mucphi);
    if($check_updateQD)
    {
        echo '<script>alert("Cập nhật thành công");callpage(1)</script>';
    }
    else  echo '<script>alert("Cập nhật thất bại, phát sinh lỗi hệ thống");callpage(1)</script>';
}
if($ac=="TIME")
{
    echo '
           <table border="1">
                <tr>

                    <th>Tên khách hàng</th>
                    <th>Số tài khoản</th>
                    <th>Thời gian</th>
                    <th>Loại giao dịch</th>
                    <th>Giá trị</th>
                </tr>';
    $q = $con->runQuery("select * from nhatkygiaodich where ThoiGian like '%".$time."%'");

    while ($result =  mysqli_fetch_array($q))
    {
            $makh= $tknh->getChuTk($result['TKGhiNo']);
            $tenkh = $khcn->getTenKH($makh);
            if($tenkh == "") $tenkh = $khtc->getTenTC($makh);
            $tenLGD= $lgd->getMota($result['LoaiGiaoDich']);
        $count_field =0;
        echo '<tr>';
        while ($count_field < 5)
        {
            if($count_field == 1  )
            {

                 echo "<td>".$tenkh."</td>";
            }
            if($count_field == 2  )
            {

                echo "<td>".$result['TKGhiNo']."</td>";
            }
            if($count_field == 2  )
            {

                echo "<td>".$result['ThoiGian']."</td>";
            }
            if($count_field == 3  )
            {

                echo "<td>".$tenLGD."</td>";
            }
            if($count_field == 4  )
            {

                echo "<td>".$result['SoTienGD']."</td>";
            }

            $count_field = $count_field + 1;
        }echo '</tr>';

    }
    echo '</table>';
}

if($ac=="KH")
{
   // echo '<script>alert("'.$kh.'12121")</script>';
    echo '
           <table border="1">
                <tr>


                    <th>Số tài khoản</th>
                    <th>Thời gian</th>
                    <th>Loại giao dịch</th>
                    <th>Giá trị</th>
                </tr>';
    $q1=null;
    $q10 = $con->runQuery("select ID,HoTen from khachhang where HoTen like '%".$kh."%'");
    $q11 = $con->runQuery("select ID,TenDoanhNghiep from khachhangtochuc where TenDoanhNghiep like '%".$kh."%'");
    $num_row_kh= mysqli_num_rows($q10);
    if($num_row_kh!=0) $q1= $q10;
    else $q1 = $q11;
    while ($result1 =  mysqli_fetch_array($q1))
    {
               $q2 =  $con->runQuery("select STK from taikhoannganhang where ChuTK= '".$result1["ID"]."'");

                while($result2 =  mysqli_fetch_array($q2))
                {
                    $q3 = $con->runQuery("select * from nhatkygiaodich where TKGhiNo = '".$result2['STK']."'");

                    while($result3 = mysqli_fetch_array($q3))
                    {
                        $count_field =0;
                        $tenLGD= $lgd->getMota($result3['LoaiGiaoDich']);
                        echo '<tr>';
                        while ($count_field < 5)
                        {
                          /*  if($count_field == 0  )
                            {

                                echo "<td>".$result1['1']."</td>";
                            }*/
                            if($count_field == 1  )
                            {

                                echo "<td>".$result2['STK']."</td>";
                            }
                            if($count_field == 2  )
                            {

                                echo "<td>".$result3['ThoiGian']."</td>";
                            }
                            if($count_field == 3  )
                            {

                                echo "<td>".$tenLGD."</td>";
                            }
                            if($count_field == 4  )
                            {

                                echo "<td>".$result3['SoTienGD']."</td>";
                            }

                            $count_field = $count_field + 1;
                        }
                        echo '</tr>';
                    }

                }


        }
    echo '</table>';
}

if($ac=="LGD")
{
    echo '
           <table border="1">
                <tr>
                    <th>Số tài khoản</th>
                    <th>Nội dung</th>
                    <th>Thời gian</th>
                    <th>Số tiền</th>
                </tr>';

    $q4 = $con->runQuery("select * from nhatkygiaodich where LoaiGiaoDich = '".$malgd."'");

    while ($result4 =  mysqli_fetch_array($q4))
    {
        echo '<tr>';
        echo '<td>'.$result4["TKTrichNo"].'</td>';
        echo '<td>'.$result4["NoiDungGiaoDIch"].'</td>';
        echo '<td>'.$result4["ThoiGian"].'</td>';
        echo '<td>'.$result4["SoTienGD"].'</td>';
        echo '</tr>';

    }
    echo '</table>';
}
?>