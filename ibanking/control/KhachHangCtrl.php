<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>
<?php

include_once '../model/NhatKyGiaoDich.php';

$Action = $_POST["Action"];
if ($Action == 1) showNKGD();

function showNKGD()

{

    //if(isset($_POST["STK"]))
    {
        //echo "<script>alert('Load Nhat Ky Giao Dich');</script>";

        $STK = $_POST["STK"];
        //echo $STK;
        //echo 'Day la nkgd';
        $NK = new NhatKyGiaoDich();
        $NKGD = $NK->getNhatKyGiaoDich($STK);
        //if(NKGD)
        //echo "Khong co giao dich nao";
        if (!$NKGD) echo 'Loi Cau truy Van';
        else
            if ($NKGD == null) echo 'Khong co giao dich';
            else {
                echo '<table>';
                echo "<th>Thời gian</th>";
                //echo "<th></th>";
                echo "<th>Số tiền giao dịch</th>";
                echo "<th>Nội dung</th>";
                echo "<th>Tài khoản gửi</th>";
                echo "<th>Tài khoản nhận</th>";
                while ($data = mysqli_fetch_array($NKGD)) {
                    echo "<tr>";
                    echo "<td>" . $data["ThoiGian"] . "</td>";
                  //  echo "<td>" . $data["LoaiGiaoDich"] . "</td>";
                    echo "<td>" . $data["SoTienGD"] . "</td>";
                    echo "<td>" . $data["NoiDungGiaoDIch"] . "</td>";
                    echo "<td>" . $data["TKTrichNo"] . "</td>";
                    echo "<td>" . $data["TKGhiNo"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
    }
}

?>