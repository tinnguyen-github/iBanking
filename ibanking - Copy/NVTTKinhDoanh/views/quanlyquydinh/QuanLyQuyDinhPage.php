<script>
    function ds(b)
    {
        $.post("../control/NVTTKDCtrl.php",{page:b},function(data){$('#main_KD').html(data).show();});
    }
    ds(1);
    function capnhatquydinh(id)
    {
        //alert(id);
        document.getElementById(id+"1").disabled = false;
        document.getElementById(id+"2").disabled = false;
        document.getElementById(id+"update").value = "Cập nhật";
        document.getElementById(id+"update").setAttribute("onclick","update_QD("+id+")") ;
    }
    function update_QD(id)
    {
        //alert(id);
        toida=  document.getElementById(id+"1").value;
        mucphi=  document.getElementById(id+"2").value;
        $.post("../control/NVTTKDCtrl.php",{id:id,toida:toida,mucphi:mucphi},function(data){$('#action').html(data).show();});
    }
    function is_number(evt) {

        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode( key );
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            {
                theEvent.returnValue = false;
                //$('input#txt').text("Chỉ được nhập số");
            }

            if(theEvent.preventDefault) {
                //$('#alert').text("");
                theEvent.preventDefault();
            }
        }
    }
    // alert("goi ham!");
    //$("#main").post("views/ChuyenKhoan.php");
    //$('#main').html("views/ChuyenKhoan.php");
</script>