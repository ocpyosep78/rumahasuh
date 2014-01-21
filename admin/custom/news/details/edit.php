<?php
include("get.php");
include("update.php");
include("control.php");
include("ajax.php");

//var_dump($_POST);
?>

<form method="post" enctype="multipart/form-data">


            <div class="sub-header clearfix">
                <div class="content">
                   <?php if(!empty($_POST['msg'])){?>
                   <div class="alert-message success" id="msg"><center><?php echo $_POST['msg'];?></center></div>
                   <?php }?>
                
                    <h2>Edit News</h2>
                    <div class="btn-placeholder">
                        <input type="button" class="btn grey main" value="Cancel" onclick="cancelEdit()" >
                        <input type="submit" class="btn green main" value="Save Changes" name="btn-edited-news">
                        <input type="submit" class="btn green main" value="Save Changes &amp; Exit" name="btn-edited-news">
                    </div>
                </div>
            </div>

            <div class="info-header">
                <div class="content">
                    Edit Mode
                </div>
            </div>

            <div id="main-content">

                <div class="box clearfix">
                    <div class="desc">
                        <h3>News Details</h3>
                        <p>Manage your news details from title, category, date, and content.</p>
                    </div>
                    <div class="content">
                        <ul class="field-set">
                            <li class="field field-select">
                                <input type="hidden" name="news_id" value="<?php echo $news_detail['news_id'];?>">
                                <label for="category">Category <span>*</span></label>
                                <select class="input-select" id="category" name="category">
                                    <option selected value="xxxx"></option>
                                    <?php 
									foreach($all_news_category as $category){
									   echo "<option value=\"".$category['category_id']."\">".ucwords(strtolower($category['category_name']))."</option>";
									}
									?>
                                </select>
                            </li>
                            <li class="field-divider"></li>
                            <li class="field">
                                <label>Title <span>*</span></label>
                                <input type="text" class="input-text" value="<?php echo ucwords(strtolower($news_detail['news_title']));?>" name="news_title">
                            </li>
                            <li class="field">
                                <label>Date <span>*</span></label>
                                <input type="text" class="input-text" style="width: 300px" value="<?php echo $news_detail['news_date'];?>" name="news_date">
                            </li>
                            <li class="field input-file clearfix">
                                <label>Cover Image</label>
                                <div class="clearfix" style="width: 550px; padding-bottom: 8px">
                                    <div class="fl image" style="width: 174px; height: 116px" onMouseOver="removeButton('1')" id="newer-1">
                                        <div class="" id="remove-news-1">
                                           <div class="image-delete" id="btn-slider-1" onClick="clearImage('1')"></div>
                                           <div class="image-overlay" onClick="openBrowser('1')"></div>
                                        </div>
                                        <img class="" id="upload-news-1" src="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])?>/../<?php echo $news_detail['news_image']?>">
                                        <input type="file" name="upload_news_1" id="news-1" onchange="readURL(this,'1')" class="hidden"/>  
                                        <input type="hidden" name="check_image" value="<?php echo $news_detail['news_image'];?>" id="check-image"> 
                                        <input type="hidden" name="unlink_image" value="<?php echo $news_detail['news_image'];?>">                                  
                                    </div>
                                </div>
                                <!--<div style="fl">
                                    <div class="btn grey row" onclick="getFile()" style="margin-right: 5px">Change Image</div>
                                    <div class="btn red row">Remove</div>
                                    <div style='height: 0px; width: 0px; overflow:hidden;'>
                                        <input type="file" id="upfile" name="xxxx" onchange="sub(this)">
                                    </div>
                                </div>-->
                                <p class="field-message" style="padding-top: 10px">Recommended dimensions of 228 x 152 px.</p>
                            </li>
                            <li class="field-divider"></li>
                            <li class="field">
                                <label>Content <span>*</span></label>
                                <textarea rows="8" name="news_content"><?php echo $news_detail['news_content'];?></textarea>
                            </li>
                        </ul>
                    </div>
                </div><!--box-->

            </div><!--main-content-->
            
</form>
            
<script>
$('#category option[value=<?php echo $news_detail['category_id']?>]').attr('selected','selected');

   function readURL(input,i) {
      
	  if (input.files && input.files[0]) {
	     var reader = new FileReader();
		 reader.onload = function (e) {
		    $("#upload-news-"+i).removeClass("hidden");
		    $("#upload-news-"+i).attr('src', e.target.result);
		    $("#upload-news-"+i).fadeIn("fast");
			$("#check-image").val('');
	     }
		 
		 reader.readAsDataURL(input.files[0]);
	  }
	  
   }
   
   function openBrowser(i){
      document.getElementById("news-"+i).click();
   }
   
   function removeButton(i){
      $("#remove-news-"+i).removeClass("hidden");
	  $("#remove-news-"+i).fadeIn("slow");
	  $("#btn-news-"+i).attr('style','z-index:1000; position:absolute');
	  
	  $("#new-"+i).mouseleave(function(){
	     $("#remove-news-"+i).fadeOut("slow");
	  });
   }
   
   function clearImage(i){
	   $("#upload-news-"+i).attr('src', '');
	   $("#upload-news-"+i).fadeOut("slow");
	   $('#check-image').val('');
   }
   
   function cancelEdit(){
      location.href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news-detail/".$news_id."/".cleanurl($news_title)?>";
   }
</script>

            