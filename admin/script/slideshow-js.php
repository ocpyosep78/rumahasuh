<script>
<?php
for($i=1;$i<7;$i++){
?>
      $('#btn-slider-<?php echo $i;?>').hide();
	  $('#btn-link-<?php echo $i;?>').hide();
   <?php
	  $get_slideshow = get_slideshow($i);
	  
	  if(empty($get_slideshow['filename'])){
   ?>
         $("#upload-slider-<?php echo $i;?>").hide();
	     $('#btn-slider-<?php echo $i;?>').hide();
	     $('#btn-link-<?php echo $i;?>').hide();
   <?php
	  } 
   }//foreach
   ?>
   
   function readURL(input,i) {
      
	  if (input.files && input.files[0]) {
	     var reader = new FileReader();
		 reader.onload = function (e) {
		    $("#upload-slider-"+i).fadeIn("slow");
		    $("#upload-slider-"+i).attr('src', e.target.result);
			$("#slideshow-flag-"+i).val('notempty');
			$('#id_slideshow_'+i).attr('checked','checked');
	     }
		 
		 reader.readAsDataURL(input.files[0]);
	  }
	  
   }
   
   function openBrowser(i){
      document.getElementById("slider-"+i).click();
   }
   
   function removeButton(i){
	  
	  var test = $('#upload-slider-'+i).attr('src');
	  
	  if(test != ""){
      $("#remove-slider-"+i).removeClass("hidden");
	  $("#remove-slider-"+i).fadeIn("fast");
	  $("#btn-slider-"+i).attr('style','z-index:12; position:absolute');
	  $("#btn-link-"+i).attr('style','z-index:13; position:absolute');
	  
	  $("#slide-"+i).mouseleave(function(){
	     $("#remove-slider-"+i).fadeOut("fast");
	  });
	  }
   }
   
   function ajaxDeleteBanner(i){
      var bid = i;
	  
	  var ajx   = $.ajax({
	              type: "POST",
				  url: "../admin/pages/home/ajax/delete_banner.php",
				  data: {bid:bid},
				  error: function(jqXHR, textStatus, errorThrown) {
					   
					     }
						 
			      }).done(function(data) {	
				  
				  });
   }
   
   function clearImage(i){
	   $('#tester-'+i).html('<input type="file" name="upload_slider_'+i+'" id="slider-'+i+'" onchange="readURL(this,'+i+')" class="hidden"/>');
	   $("#upload-slider-"+i).attr('src', '');
	   $("#upload-slider-"+i).fadeOut("slow");
	   $("#slideshow-flag-"+i).val('');
	   
	   ajaxDeleteBanner(i);
   }
   
   $('#link-pop').hide();
   
   function showLink(i){
      $('#link-pop').attr('style', 'position:relative; z-index:1000;').fadeIn("fast");
      $('#link-id').val(i);   
	  $('#name-link').val($('#link-'+i).val());
   }
   
   function closeLink(){
      $('#link-pop').attr('style', '').fadeOut("fast"); 
      $('#name-link').removeAttr('name');   
   }
   
   $('#link-pop-banner').hide();

function showLinkBanner(i){
   $('#link-pop-banner').attr('style', 'position:relative; z-index:1000;').fadeIn("fast");
   $('#link-id-banner').val(i);   
   $('#name-link-banner').val($('#promo-url-'+i).val());
}

function closeLinkBanner(){
   $('#link-pop-banner').attr('style', '').fadeOut("fast"); 
   $('#name-link-banner').removeAttr('name');   
}
</script>