<?php
include('get.php');
include('update.php');
include('control.php');
?>

<form method="post" enctype="multipart/form-data">

    <div class="subnav">
      <div class="container clearfix">
        <h1>
          <span class="glyphicon glyphicon-list"></span> &nbsp; 
          <a href="<?php echo $prefix_url."publications"?>">Publications</a> 
          <span class="info">/</span> 
		  <?php echo $category['career_name'];?>
        </h1>
        <div class="btn-placeholder">
          <a href="<?php echo $prefix_url."publications";?>">
            <input type="button" class="btn btn-default btn-sm" value="Cancel" id="btn-add-category-cancel">
          </a>
          <input type="submit" class="btn btn-danger btn-sm" value="Delete" name="btn_detail_publication">
          <input type="button" class="btn btn-success btn-sm" value="Save Changes" id="btn_alias">
          <input type="submit" class="hidden" value="Save Changes" name="btn_detail_publication" id="btn_save">
        </div>
      </div>
    </div>
    
	<?php
	if(!empty($_SESSION['alert'])){
	   echo '<div class="alert '.$_SESSION['alert'].'">';
	   echo '<div class="container">'.$_SESSION['msg'].'</div>';
	   echo '</div>';
	}
	
	if($_POST['btn_detail_service_job'] == ''){
	   unset($_SESSION['alert']);
	   unset($_SESSION['msg']);
	}
	?>

    <div class="container main">

      <div class="box row">
        <div class="desc col-xs-3">
          <h3>Publications Details</h3>
          <p>Your publications details.</p>
        </div>
        <div class="content col-xs-9">
          <ul class="form-set" id="custom_product_category">
            <li class="form-group row hidden">
              <label class="control-label col-xs-3">Change Status</label>
              <div class="col-xs-9">
                <label class="radio-inline">
                  <input type="radio" value="Active" name="active_status" id="category_active_status_active" checked>Active
                </label>
                <label class="radio-inline">
                  <input type="radio" value="Inactive" name="active_status" id="category_active_status_inactive">Inactive
                </label>
              </div>
            </li>
            
            <li class="form-group row">
              <label class="control-label col-xs-3">Visibility</label>
              <div class="col-xs-9">
                <label class="radio-inline">
                  <input type="radio" value="1" name="visibility_status" id="category_visibility_status_visible">Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" value="0" name="visibility_status" id="category_visibility_status_invisible">No
                </label>
              </div>
            </li>
            
            <li class="form-group row hidden" id="lbl_category_department">
              <label class="control-label col-xs-3">Department</label>
              <div class="col-xs-9">
                <select class="form-control" name="category_department" id="category_department">
                  <?php
                  foreach($city as $city){
				     echo '<option value="'.$city['category_id'].'">'.$city['category_name'].'</option>';
				  }
				  ?>
                </select>
              </div>
            </li>
            
            <li class="form-group row" id="lbl_category_year">
              <label class="control-label col-xs-3">Year</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" name="category_maps" id="id_category_maps" value="<?php echo $category['category_maps'];?>">
              </div>
            </li>
            
            <li class="form-group row" id="lbl_category_name">
              <label class="control-label col-xs-3">Publications Name</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" name="category_name" placeholder="ex: Jakarta" id="category_name" value="<?php echo $category['career_name'];?>">
              </div>
            </li>
            
            <li class="form-group row image-placeholder input-file" style="position:relative; z-index:1;">
              <label class="control-label col-xs-3">Image</label>
              <div class="col-xs-9">
                <div class="row">
                
                  <div class="col-xs-4 image">
                    <div class="" id="fl_banner_1" onmouseover="showDelete(1)" onmouseout="hideDelete(1)">
                      <div class="content img-about-size">
                        <div class="" id="wrapper_btn_1">
                          <div class="image-delete hidden" id="delete_btn_1" onclick="removeButton(1)">
                            <span class="glyphicon glyphicon-remove"></span>
                          </div>
                          
                          <div class="image-overlay" onclick="openBrowser(1)"></div>
                        </div>
                        
                        <span id="wrap_remove_1">
                          <img class="" src="<?php echo $prefix_url."static/thimthumb.php?src=../".$category['description']."&h=105&w=208&q=100";?>" id="img_banner_1">
                          <input type="file" name="upload_image_1" id="file_1" onchange="readURL(this,'1')" class="hidden"/>
                          <input type="checkbox" name="check_banner[]" id="id_check_1" value="1" class="hidden"/>
                          <input type="hidden" name="order_banner[]" value="1"/>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <p class="help-block" style="padding-top: 10px">Recommended dimensions of 228 x 152 px.</p>
              </div>
            </li>
            
            <li class="form-group row hidden">
              <label class="control-label col-xs-3">Root Category</label>
              <div class="col-xs-9">
                <select class="form-control" name="category_parent" id="category_parent">
                  <option value="top">-- Root Category --</option>
                  <?php //listCategory(0,'top');?>
                </select>
              </div>
            </li>
          </ul>
        </div>
      </div><!--.box-->

    </div><!--.container.main-->
    
    <?php
    echo "<input type=\"hidden\" name=\"jobs\" value=\"".$check['rows']."\">";
    echo "<input type=\"hidden\" name=\"cat_id\" value=\"".$category_id."\">";
    echo "<input type=\"hidden\" name=\"hidden_name\" value=\"".cleanurl($category['career_name'])."\">";
    echo "<input type=\"hidden\" name=\"hidden_description\" value=\"".$category['description']."\">";
	?>
    
</form>

<style>
.has-error {
border-color: #b94a48;
}
</style>

<script>
function initial(x){
   
   $('#category_active_status_active').attr('checked', true);
   if(x == '1'){
	  $('#category_visibility_status_visible').attr('checked', true);
   }else{
	  $('#category_visibility_status_invisible').attr('checked', true);
   }
   //$('#category_name').focus();
}

function validation(){
	
  var category_name = $('#category_name').val();
  var year          = $('#id_category_maps').val(); 
  var nonum         = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
  
  $('#category_name').val();
  $('#lbl_category_name').removeClass('has-error');
  
  if(category_name == ''){
     $('#lbl_category_name').addClass('has-error');
  }else if(year == '' || !nonum.test(year) || year.length>4){
     $('#lbl_category_year').addClass('has-error');
  }else{
     $('#btn_save').click();
  }
  
}


function selectCity(x){
   $('#category_department option[value="'+x+'"]').attr('selected', true);
}


$(document).ready(function(e) {
   initial(<?php echo $category['visibility']?>);
   
   $('#btn_alias').click(function (){
      validation()
   });
   
   selectCity('<?php echo $category['category'];?>');
});


/*
function ajaxDeleteBanner(i){
   var bid = i;
   
   var ajx   = $.ajax({
	           type: "POST",
			   url: "../custom/inspiration/detail/ajax/delete.php",
			   data: {bid:bid},
			   error: function(jqXHR, textStatus, errorThrown) {
					   
					  }
						 
			   }).done(function(data) {	
			      
			   });
}
*/


function readURL(input,i) {
   
   if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
		 
	     $("#img_banner_"+i).attr('src', e.target.result).fadeOut("fast").removeClass("hidden").fadeIn("fast");
	     $('#id_check_'+i).attr('checked',true);
		 $('#wrapper_btn_'+i).removeClass("hidden");
		 $('#wrapper_btn_'+i).html('<div class="image-delete hidden" id="delete_btn_'+i+'" onclick="removeButton('+i+')"></div>'+$('#wrapper_btn_'+i).html());
	  }
		 
      reader.readAsDataURL(input.files[0]);
   }
	  
}

function showDelete(i){
   $('#delete_btn_'+i).removeClass("hidden");
   $('#delete_btn_'+i).fadeIn("fast");
}

function hideDelete(i){
   $('#delete_btn_'+i).fadeOut("fast");
   $('#delete_btn_'+i).addClass("hidden");
}


function openBrowser(i){
   document.getElementById("file_"+i).click();
}


function removeButton(i){
   $('#wrap_remove_'+i).html('<img class="hidden" src="" id="img_banner_'+i+'"><input type="file" name="upload_slider_'+i+'" id="file_'+i+'" onchange="readURL(this,'+i+')" class="hidden"/><input type="checkbox" name="check_banner[]" id="id_check_'+i+'" value="'+i+'" class="hidden" checked="checked"/>');
   
   $('#wrapper_btn_'+i).html('<div class="image-overlay" onclick="openBrowser('+i+')"></div>');
   //ajaxDeleteBanner(i);
}
</script>