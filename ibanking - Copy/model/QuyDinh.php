<?php

include_once 'condb.php';
class QuyDinh {
	
	public $HanMuc;
	public  $MucPhi;
	public function getInfo($LoaiGD)
	{
		$conn=new myDBC();
			$query="select HanMuc,MucPhi from QuyDinh where LoaiGiaoDich= ".$LoaiGD;
			$result=$conn->runQuery($query);
			if(!$result) return false;
			else
				{
					$data=mysqli_fetch_array($result);
					if($data==null) return false;
					else {
					$this->HanMuc=$data["HanMuc"];
					$this->MucPhi=$data["MucPhi"];
					return $this;}
				}
			
		
	}


    function showInfo($page)
    {
        error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING ) ;
        $con= new myDBC();
        $row_in_page = 5;
        $row_data = mysqli_num_rows($con->runQuery("SELECT * FROM quydinh") ) or die(mysql_error());
        $col_data =  mysqli_num_fields($con->runQuery("SELECT * FROM quydinh") ) or die(mysql_error());
        $num_page = ceil($row_data/$row_in_page);
        $result =$con->runQuery("SELECT * FROM quydinh ORDER BY LoaiGiaoDich ASC LIMIT ".($page-1)*$row_in_page.",".$row_in_page."") or die(mysql_error());
        echo '
            <table border="1">
                <tr>
                    <th>Loại dịch vụ</th>
                    <th>Hạn mức tối đa</th>
                    <th>Mức phí</th>

                </tr>';
        while ( $info = mysqli_fetch_array($result ))
        {


            $count_field =0;
            echo '<tr>';
            while ($count_field < $col_data)
            {
                if($count_field==0)
                {
                    $q = mysqli_fetch_array($con->runQuery("select * from loaigiaodich where ID = '".$info["LoaiGiaoDich"]."'"));
                    echo "<td>".$q["MoTa"]."</td>";
                }
                else echo '<td><input onkeypress="is_number(event)" disabled  id="'.$info["LoaiGiaoDich"].$count_field.'" type="text" value = "'.$info["$count_field"].'"</td>';

                $count_field = $count_field + 1;
            }
            echo '<td><div id="CNTG"><input type="button" id="'.$info["LoaiGiaoDich"].'update" value="Cập nhật quy định" onclick="capnhatquydinh(\''.$info["LoaiGiaoDich"].'\');"></div>';
            echo ' </td> </tr>';
            echo'</tr>';
        }
        echo '</table>';
        for ( $page = 1; $page <= $num_page; $page ++ )
        {
            echo   '<a href="#" onclick="ds(2,\''.$page.'\')">'.$page.'</a>';
        }
        // echo '</br><input type="button" value="Thêm LDV" onclick="addLDV();">';
    }
    function update($id,$toida,$mucphu)
    {
        $con= new myDBC();
        $q= $con->runQuery("update quydinh set HanMuc = '".$toida."',MucPhi= '".$mucphu."' where LoaiGiaoDich= '".$id."' ");
        return $q;
    }
}


?>