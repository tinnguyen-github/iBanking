<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tung
 * Date: 16/06/2014
 * Time: 23:35
 * To change this template use File | Settings | File Templates.
 */

class OTP {
    private $TKiB;
    private $MaOTP;
    private $ThoiGian;



    function getMaOTP($ID)
    {
        include_once "connectdb.php";
        $q= mysql_fetch_array(mysql_query("select OTP from otp where TKiB ='".$ID."' order by ThoiGian desc limit 0,1"));
        return $q['OTP'];
    }
}
?>