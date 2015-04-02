
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="js/jquery.js" ></script>
    <link rel="stylesheet" href="css/login.css" type="text/css" />

<?php
if(session_start()) session_destroy();
session_start();
?>
<script>
    function Dangnhap()
    {
        //alert("aaa");
        user = document.DangNhap.user.value;
        pass= document.DangNhap.pass.value;
        if(user=="")
        {
            alert("Nhập tài khoản iBnaking!");
            document.DangNhap.user.focus();
        }else
        if(pass=="")
        {
            alert("Nhập mật khẩu iBnaking!");
            document.DangNhap.pass.focus();
        }else
        {
           // alert(pass);
            $.post("control/LogIn_OutCtrl.php",{Action:"DangNhap",user:user,pass:pass},function(data){$('#DangNhap').html(data).show();});
            //alert(user);
        }
    }s

</script>

<div>
    <div id="login">

        <h2><span class="fontawesome-lock"></span>Đăng nhập</h2>

        <form name="DangNhap">

            <fieldset>

                <p><label for="email">Tên đăng nhập</label></p>
                <p><input type="text" name="user" id="email" value="" onBlur="if(this.value=='')this.value=''" onFocus="if(this.value=='mail@address.com')this.value=''"></p>

                <p><label for="password">Password</label></p>
                <p><input type="password" name ="pass"id="password" value="" onBlur="if(this.value=='')this.value=''" onFocus="if(this.value=='password')this.value=''"></p>

                <p><input type="button" value="Đăng nhập" onclick="Dangnhap();"></p>

            </fieldset>

        </form>

    </div> <!-- end login -->
  <!--
<form name="DangNhap" align="center" id="frm_Login">
    <h3> Đăng nhập</h3>
Tên đăng nhập :<input type="text" name="user"><br>
Mật khẩu      :  <input type="password" name="pass"><br>
<input type="button" value="Đăng nhập" onclick="Dangnhap()">
</form> -->
<div id="DangNhap"></div></div>

