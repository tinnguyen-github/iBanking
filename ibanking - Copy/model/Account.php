<?php

include_once "../model/condb.php";
class Account {
    private $Username;
    private $Password;
    private $Quyen;
    private $isLocked;
    private $isTheFirst;

    function getInfo($User)
    {

        $con= new myDBC();
        $q = "select * from account where Username ='".$User."'" ;
        $result = $con->runQuery($q);
        $row=mysqli_fetch_array($result);
        $this->Username = $row["Username"];
        $this->Password= $row["Password"];
        $this->Quyen= $row['Quyen'];
        $this->isLocked=$row['isLocked'];
        $this->isTheFirst=$row['isTheFirst'];
    }
    function CheckUserPass($User,$Pass)
    {
        $check_UP = new Account();
        $check_UP->getInfo($User);
        if($User == $check_UP->Username && $Pass == $check_UP->Password)
            return 1;
            else
                if($User == $check_UP->Username && $Pass != $check_UP->Password) return 2;
                else
                    return 3;
    }
    public function lockAc($User)
    {
        $q="update account set isLocked = 1 where Username= '".$User."'";
        $con= new myDBC();
        $result=$con->runQuery($q);
        if($result) return true;
        else return false;
    }
    function getisLocked()
    {
        return $this->isLocked;
    }
    function getisTheFirst()
    {
        return $this->isTheFirst;
    }
    function getQuyen()
    {
        return $this->Quyen;
    }

    function delAccount($user)
    {
        $con= new myDBC();
        $check=$con->runQuery("delete from account where Username='".$user."'") or die(mysql_errno());
        return $check;
    }
    function isLock($user)
    {
        $con= new myDBC();
        $check = $con->runQuery("update account set isLocked = false where Username ='".$user."'")or die(mysql_errno());
        return $check;
    }

    function adAccount($u,$q,$p,$time)
    {
        $con= new myDBC();
        $result=$con->runQuery("insert into account values('".$u."','".$p."',".$q.",0,0,'".$time."')
            ")or die(mysql_error());
        return $result;
    }

    function getInfoUser()
    {
        $User=$_SESSION['TKiBanking'];
        $con= new myDBC();
        $query="select *from khachhang where Username='".$User."'";
        $res=$con->runQuery($query);
        return $res;

    }
}
?>