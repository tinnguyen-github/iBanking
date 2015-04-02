
<head>
    <title>Thêm loại dịch vụ</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="jquery.js" ></script>
    <script>
        function checkinfo()
        {

            MoTaLDV = document.Them_LDV.MoTaLDV.value;

            comfirmBox = confirm("Xác nhận thêm loại dịch vụ mới?");
            if(comfirmBox == true){
                $.post("../control/QuanLiDichVuCtrl.php",{add:'ThemLDV',MoTaLDV:MoTaLDV},function(data){$('#action').html(data).show();});
                //alert(id);
            }
        }

    </script>
</head>
<body>
<form name ="Them_LDV" >

      Loại dịch vụ
                <input type="text" name="MoTaLDV" value="">
<input type="hidden" name="Add_New"value="Them_LDV">
        <input type="button" value ="Thêm mới" onclick="checkinfo()">

</form>
</body>
