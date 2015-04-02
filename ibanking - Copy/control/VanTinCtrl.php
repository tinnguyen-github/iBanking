<?php
include_once "/../model/condb.php";
include_once"/../model/TKNganHang.php";

getTKInfo($_POST["STK"]);

function getTKInfo($STK)
{
    $tem=new TKNganHang();
    $res=$tem->getInfo($STK);
    echo '<table>';
    echo "<th>Số tài khoản</th>";
    echo "<th>Số dư</th>";
    echo "<th>Ngày cấp</th>";
    while($data=mysqli_fetch_array($res))
    {

        // while ($data = mysqli_fetch_array($NKGD)) {
            echo "<tr>";
            echo "<td>" . $data["STK"] . "</td>";
            echo "<td>" . $data["SoDU"] . "</td>";
            echo "<td>" . $data["NgayCap"] . "</td>";
            echo "</tr>";
    }
    echo "</table>";

}
?>