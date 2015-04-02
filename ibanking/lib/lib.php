
// lay gia tri tra ve tu trang php;

<script>

$.get("phpscript.php", { 'var': 'one' }, function(resp) {
	alert(resp); // '1'

});


</script>
<?php
echo '1';?>

// kiem tra gia tri nhap

var validator = $("#olForm").validate({
    rules: {
        "email": {
             required: true,
             email: true
        },
        "phone": {
             required: true,
             digits: true,
             minlength: 9,
             maxlength: 11
        }
    }
});

// focus functon j jquery

$("#SoTien").focusout(function()
			{	
				$.post( "../control/ChuyenKhoanCtrl.php",{Action:1,TKDi:$TKDi,SoTien:$SoTien}
					, function( data ) {
	 				if(data==0) 
		 				{
		 					$("#KhongDuSoDu").show();
		 					
		 				}
	 						else $("#KhongDuSoDu").hide();
					})
			})
			
	
	// kiem tra chi cho phep nhap so
	
$(document).ready(function(){
	  $(".hide").hide();

	  // Kiem tra cac input chi duoc nhap so
	  $(".So").keydown(function (e) {
	        // Allow: backspace, delete, tab, escape, enter and .
	        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
	             // Allow: Ctrl+A
	            (e.keyCode == 65 && e.ctrlKey === true) || 
	             // Allow: home, end, left, right
	            (e.keyCode >= 35 && e.keyCode <= 39)) {
	                 // let it happen, don't do anything
	                 return;
	        }
	        // Ensure that it is a number and stop the keypress
	        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	            e.preventDefault();
	        }
	    });
