<script src="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF']);?>/custom/products/add/multiple_insert_product/multiple.js"></script>


<script>
// HIDDEN ADD VARIANT BUTTON
$('button[value="Add Variant"]').addClass('hidden');

// ADD FILES BOX
$(document).ready(function(){
	$.ajax({
		type: "POST",
		url: "custom/products/add/custom.php",
		error: function(jqXHR, textStatus, errorThrown) {
			
			   }
		}).done(function(msg) {
			$("#custom").html(msg);
		});	


   // TRIGGER SIZE GROUP INTO GENERAL
   $('#size_type_id').val('43').trigger('change'); // SIZE GROUP
   $('#color_id_1').val('16').trigger('change');   // TYPE


   // CLASS HIDDEN
   $('#lbl_color_id_1').addClass('hidden');    // TYPE GROUP
   $('#lbl_type_weight_1').addClass('hidden'); // WEIGHT
   $('#lbl_size_type_id').addClass('hidden');  // SIZE GROUP
   $('#lbl_color_name').addClass('hidden');    // TYPE
   $('#lbl_color_price').addClass('hidden');   // PRICE


   // DEFAULT VALUE
   $('#type_weight_1').val('1');

});	

$(document).ajaxStop(function () {
   $('#lbl_size_qty').addClass('hidden');      // STOCK
   $('#stock_qty_0').val('1');
});

</script>