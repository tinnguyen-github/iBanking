<?php
include_once "condb.php";
class KhachHang {
	
	private $ID;
	private $HoTen;
	private  $GioiTinh;
	private $SDT;
	private  $email;
	private $CMND;
	private $conn;

	public function getInfo($username)
	{
		$conn=new myDBC();
		$sql="select *from KhachHang where username = '".$username."'";
		$res=$conn->runQuery($sql);
		$data=mysqli_fetch_array($res);
		return $data;
	} 
	public function getSDT($username)
	{
		$conn=new myDBC();
		$sql="select SDT from KhachHang where username = '".$username."'";
		$res=$conn->runQuery($sql);
		$data=mysqli_fetch_array($res);
		return $data["SDT"];
	}
  /*  public function getInfo($username)
    {
        $conn=new myDBC();
        $sql="select *from KhachHang where username = '".$username."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data;
    }*/
    public function getTenKH($ID)
    {
        $conn=new myDBC();
        $sql="select * from KhachHang where ID = '".$ID."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data['HoTen'];
    }
    public function getCMNDFUser($username)
    {
        $conn=new myDBC();
        $sql="select * from KhachHang where username = '".$username."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data['CMND'];
    }
    public function getTenKhFuser($username)
    {
        $conn=new myDBC();
        $sql="select * from KhachHang where username = '".$username."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data['HoTen'];
    }
   /* public function getSDT($username)
    {
        $conn=new myDBC();
        $sql="select SDT from KhachHang where username = '".$username."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data["SDT"];
    }*/
    public function getID($Hoten)
    {
        $conn=new myDBC();
        $sql="select ID from KhachHang where HoTen = '".$Hoten."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data["ID"];
    }
    public function getMakh($cmnd)
    {
        $conn=new myDBC();
        $sql="select ID from KhachHang where CMND = '".$cmnd."'";
        $res=$conn->runQuery($sql);
        $data=mysqli_fetch_array($res);
        return $data["ID"];
    }
    function showInfo($page)
    {
        // error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
        $conn=new myDBC();

        $row_in_page = 4;
        $row_data = mysqli_num_rows($conn->runQuery("SELECT * FROM khachhang") );
        $col_data =  mysqli_num_fields($conn->runQuery("SELECT * FROM khachhang") );
        $num_page = ceil($row_data/$row_in_page);
        $result =$conn->runQuery("SELECT * FROM khachhang ORDER BY ID ASC LIMIT ".($page-1)*$row_in_page.",".$row_in_page."");
        echo '
            <table border="1">
                <tr>
                   '.// <th>Mã khách hàng</th>
            '
            <th>Tên khách hàng</th>
            <th>Địa chỉ</th>
            <th>Giới tính</th>
            <th>Số ĐT</th>
            <th>Tên tài khoản ibanking</th>
            <th>Ngày sinh</th>
            <th>CMND</th>
            <th></th>
        </tr>';
        while ( $info = mysqli_fetch_array($result ))
        {
            $count_field =0;
            echo '<tr>';
            while ($count_field < $col_data)
            {
                if($count_field == 5){} else
                if($count_field == 3  )
                {
                    if($info["$count_field"]== 1) echo "<td>Nam</td>";
                    else echo "<td>Nữ</td>";
                }
                else
                    if($count_field != 0)echo "<td>".$info["$count_field"]."</td>";

                $count_field = $count_field + 1;
            }
            echo '<td><input type="button" value="Sửa thông tin"onclick="SuaTT(\''.$info["ID"].'\');">
            <input type="button" value="Hủy tài khoản" onclick="HuyTK(\''.$info["Username"].'\');">
            <input type="button" value="Mở khóa" onclick="MoKhoa(\''.$info["Username"].'\');"></td> </tr>';
        }
        echo '</table>';
        for ( $page = 1; $page <= $num_page; $page ++ )
        {
            echo   '<input type="button" value="'.$page.'" onclick = "ds(1,\''.$page.'\')">';
            //'<a href="#" onclick="ds(1,\''.$page.'\')">'.$page.'</a>';
            //echo "<a href='?page_khcn=".($page+1)."'style='text-decoration: none'>".($page+1)."</a>";
        }
    }
    function showgetInfo($id)
    {
        $conn=new myDBC();
        $col_data =  mysqli_num_fields($conn->runQuery("SELECT * FROM khachhang") ) or die(mysql_error());
        $count_row = mysqli_num_rows($conn->runQuery("SELECT * FROM khachhang where id='".$id."'"));
        $result =mysqli_fetch_array($conn->runQuery("SELECT * FROM khachhang where id='".$id."'"));
        if($count_row!=0)
        {
            echo '
           <form name="TTCN"> <table border="1">
                <tr>

                    <th>Tên khách hàng</th>
                    <th>Địa chỉ</th>
                    <th>Giới tính</th>
                    <th>Số điẹn thoại</th>
                    <th>Email</th>

                    <th>Ngày sinh</th>
                    <th>CMND</th>

                </tr>';
            $count_field =0;
            while ($count_field < $col_data)
            {
                if($count_field == 3  )
                {
                    if($result["$count_field"]== 1) echo "<td>Nam</td>";
                    else echo "<td>Nữ</td>";
                }
                else
                    if($count_field==2) echo '<td><input type="text" name = "Diachi" placeholder="'.$result["$count_field"].'"></td>';
                    else
                        if($count_field==5) echo '<td><input type="text" name = "Email" placeholder="'.$result["$count_field"].'"></td>';
                        else
                            if($count_field==7) echo '<td><input type="date" name = "NgSinh" placeholder="'.$result["$count_field"].'"></td>';
                            else
                                if($count_field != 0 && $count_field != 6) echo "<td>".$result["$count_field"]."</td>";

                $count_field = $count_field + 1;
            }
            echo '</tr>';

            echo '</table>';
            echo '<div align="center"><input type="button" value="Cập nhật" onclick="capnhatTT(\''.$result["ID"].'\',\'Sua_khcn\')"></div></form>';
        }
    }//     \''.$result["ID"].'\',\'khcn\'
    function checkInfo($ChuTK,$Hoten,$cmnd)
    {
        $conn=new myDBC();
        $result=mysqli_fetch_array($conn->runQuery("select * from khachhang where ID = '".$ChuTK."'"));
        //echo '<script>alert("'.$result['HoTen'].'");</script>';
        if($Hoten == $result['HoTen'])
        {
            if ($cmnd ==$result["CMND"]) return 1;
            else return 2;
        }
        else
            return 3;
    }
    function checkInfoKH($Hoten,$cmnd)
    {
        $conn=new myDBC();
        $result=mysqli_fetch_array($conn->runQuery("select HoTen, CMND from khachhang where CMND = '".$cmnd."'"));
        //echo '<script>alert("'.$result['HoTen'].'");</script>';
        if($Hoten == $result['HoTen'])
        {
            if ($cmnd ==$result["CMND"]) return 1;
            else return 2;
        }
        else
            return 3;
    }
    function setUser($user,$id,$sdt)
    {
        $conn=new myDBC();
        $conn->runQuery("update khachhang set username = '".$user."',SDT=".$sdt." where id = '".$id."'");
    }
    function delAcc($user)
    {
        $conn=new myDBC();
        $conn->runQuery("SET foreign_key_checks = 0");
        $check = $conn->runQuery("update khachhang set Username = '' where Username = '".$user."'");
        $conn->runQuery('SET foreign_key_checks = 1');
        return $check;
    }
    function updateInfo($id,$ngaysinh,$diachi,$email)
    {
        $conn=new myDBC();
        if($ngaysinh != "") $conn->runQuery("update khachhang set NgaySinh = '".$ngaysinh."' where id = '".$id."'") ;
        if($diachi != "")  $conn->runQuery("update khachhang set DiaChi = '".$diachi."' where id = '".$id."'");
        if($email != "") $conn->runQuery("update khachhang set email = '".$email."' where id = '".$id."'");

    }
}

?>