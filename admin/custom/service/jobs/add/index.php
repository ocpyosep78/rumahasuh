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
          <a href="<?php echo $prefix_url."awards"?>">Awards</a> 
          <span class="info">/</span> 
          Add Awards
        </h1>
        <div class="btn-placeholder">
          <input type="hidden" name="cat_id" id="category_id"/>
          <a href="<?php echo $prefix_url."awards";?>">
            <input type="button" class="btn btn-default btn-sm" value="Cancel" id="btn-add-category-cancel">
          </a>
          <input type="button" class="btn btn-success btn-sm" value="Save Changes" id="btn_alias">
          <input type="submit" class="hidden" value="Save Changes" name="btn_add_service_job" id="btn_save">
        </div>
      </div>
    </div>
    
	<?php
	if(!empty($_SESSION['alert'])){
	   echo '<div class="alert '.$_SESSION['alert'].'">';
	   echo '<div class="container">'.$_SESSION['msg'].'</div>';
	   echo '</div>';
	}
	
	if($_POST['btn_add_service_job'] == ''){
	   unset($_SESSION['alert']);
	   unset($_SESSION['msg']);
	}
	?>

    <div class="container main">

      <div class="box row">
        <div class="desc col-xs-3">
          <h3>Award Details</h3>
          <p>Your award details.</p>
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
                  foreach($department as $department){
				     echo '<option value="'.$department['category_id'].'">'.$department['category_name'].'</option>';
				  }
				  ?>
                </select>
              </div>
            </li>
            
            <li class="form-group row" id="lbl_category_year">
              <label class="control-label col-xs-3">Year</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" name="category_maps" id="id_category_maps">
              </div>
            </li>
            
            <li class="form-group row" id="lbl_category_name">
              <label class="control-label col-xs-3">Awards Name</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" name="category_name" id="id_category_name">
              </div>
            </li>
            
            <li class="form-group row image-placeholder input-file" style="position:relative; z-index:1;">
              <label class="control-label col-xs-3">Image</label>
              <div class="col-xs-9">
                <div class="row">
                
                  <div class="col-xs-4 image">
                    <div class="content image-prod-size" id="newer-1" style="height:105px;">
                      <div id="remove-news-1">
                        <div class="image-delete hidden" id="btn-slider-1" onClick="clearImage('1')">
                          <span class="glyphicon glyphicon-remove"></span>
                        </div>
                      
                        <div class="image-overlay" onClick="openBrowser('1')"></div>
                      </div>
                    
                      <img class="" id="upload-news-1">
                    
                      <div id="img_replacer_1">
                        <input type="file" name="upload_news_1" id="news-1" onchange="readURL(this,'1')" class="hidden"/>
                      </div><!--img_replacer--> 
                      
                      <input type="checkbox" class="hidden" name="check_banner[]" value="1" id="id_hidden_project_1">   
                    </div>
                  </div>
                </div>
                <p class="help-block" style="padding-top: 10px">Recommended dimensions of 228 x 152 px.</p>
              </div>
            </li>
            
            <li class="form-group row hidden" id="lbl_career_description">
              <label class="control-label col-xs-3">Description</label>
              <div class="col-xs-9">
                <!--<input type="text" class="form-control" name="category_name" placeholder="ex: Jakarta" id="category_name">-->
                <textarea class="form-control" name="career_description" id="id_career_description" rows="5"></textarea>
              </div>
            </li>
          </ul>
        </div>
      </div><!--.box-->

    </div><!--.container.main-->

</form>

<style>
.has-error {
border-color: #b94a48;
}
</style>

<script>
function initial(){
   $('#category_active_status_active').attr('checked', true);
   $('#category_visibility_status_visible').attr('checked', true);
   //$('#id_category_name').focus();
}

function validation(){
  
  var dept  = $('#category_department option:selected').val();
  var job   = $('#id_category_name').val();
  var desc  = $('#id_career_description').val();
  var year  = $('#id_category_maps').val(); 
  var nonum = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/
  
  $('#lbl_category_department').removeClass('has-error');
  $('#lbl_category_name').removeClass('has-error');
  $('#lbl_career_description').removeClass('has-error');
  
  if(dept == 'empty'){
     $('#lbl_category_department').addClass('has-error');
  }else if(year == '' || !nonum.test(year) || year.length>4){
     $('#lbl_category_year').addClass('has-error');
  }else if(job == ''){
     $('#lbl_category_name').addClass('has-error');
  }else{
     $('#btn_save').click();
  }
  
}


$(document).ready(function(e) {
   initial();
   
   $('#btn_alias').click(function (){
      validation()
   });
});



function readURL(input,i) {
   
   if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
		 
	     $("#upload-news-"+i).attr('src', e.target.result).fadeOut("fast").removeClass("hidden").fadeIn("fast");
	     $('#id_hidden_project_'+i).attr('checked',true);
		 $('#btn-slider-'+i).removeClass("hidden");
		 $('#newer-'+i).attr('onmouseout','removeButton('+i+')');
		 $('#newer-'+i).attr('onmouseover','showDelete('+i+')');
	  }
		 
      reader.readAsDataURL(input.files[0]);
   }
	  
}

function showDelete(i){
   $('#btn-slider-'+i).removeClass('hidden');
}

function removeButton(i){
   $('#btn-slider-'+i).addClass('hidden');
}

function openBrowser(i){
   document.getElementById("news-"+i).click();
}

function clearImage(i){
   $('#img_replacer_'+i).html('<input type="file" name="upload_news_'+i+'" id="news-'+i+'" onchange="readURL(this,'+i+')" class="hidden"/>');
   $('#upload-news-'+i).attr('src', '');
   $('#btn-slider-'+i).addClass('hidden');
   $('#id_hidden_project_'+i).attr('checked',false);
   $('#newer-'+i).removeAttr('onmouseout','removeButton('+i+')');
   $('#newer-'+i).removeAttr('onmouseover','showDelete('+i+')');
}


function validate(i){
   
   var name     = $('#id_inspiration_name').val();
   
   if(name == ""){
      $('#lbl_inspiration_name').addClass("has-error");
   }else{
      $('#lbl_inspiration_name').removeClass("has-error");
	  
	  if(i == "save"){
	     $('#id_btn_save').click();
	  }else if(i == "exit"){
		 $('#id_btn_exit').click();
	  }
	  
   }
   
}
</script>