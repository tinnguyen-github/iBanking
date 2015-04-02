<?php

include "../model/Account.php";

$User=$_GET["username"];
$Pass=$_GET["password"];
//echo $User;
//echo $Pass;
checkUP($User, $Pass);

function checkUP($User,$Pass)
{
	$temp=new Account();
	$temp->getInfo($User);
	//echo $temp->username;
	//echo $temp->pass;
	//echo $temp->quyen;
	//echo $temp->isLoscked;
	//echo $temp->istheFirst;
	if($User==$temp->username)
		if($Pass==$temp->pass)
		{
			$_SESSION["Username"]=$temp->username;
			if($temp->isLoscked==1)
			{
				echo"<script>alert('Tai Khoan Dang Bi Khoa')</script>";
				header("location:../index.php");
			}
			else
				if($temp->istheFirst==1)
				{
					echo"<script>alert('Doi Mat Khau De Kich Hoat Tai Khoan')</script>";
				}
				else {
					switch($temp->quyen)
					{
						case 1:
							//echo"dang nhap thanh con";
							echo"<script>alert('Dang Nhap thanh cong.');
									
				//	location.replace('new_url'');
					//</script>";
							header("Location:../KhachHang/index.php");
							break;
					}
				}
		}
		else
		 {
		 	if(isset($_SESSION["SoLanDangNhap"])) 
		 	{
			 		if($_SESSION["SoLanDangNhap"]>=3)
			 		{
			 			$temp->lockAc($User);
			 		}
			 		else
			 	{
			 		$_SESSION["SoLanDangNhap"]+=1;
			 		echo"<script>alert('Sai Mat Khau')</script>";
			 		//header("location:../index.php");
			 	}
		 	
		 	}
		 	else
		 	{
		 		$_SESSION["SoLanDangNhap"]=1;
		 		echo"<script>alert('Tai Khoan Dang Bi Khoa')</script>";
		 		//header("location:../index.php");
		 	}
		}
}
?>