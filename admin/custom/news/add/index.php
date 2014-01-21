<?php
include("get.php");
include("update.php");
include("control.php");
include("ajax.php");

//var_dump($_POST);
//echo"<BR>";
//var_dump($_FILES);
//echo $get_date;
//echo "POST CHECK : ".$post_check;
?>

<form method="post" enctype="multipart/form-data">

<input type="hidden" name="news_id" value="">

            <div class="sub-header clearfix">
                <div class="content">
                    
                   <?php if(!empty($_POST['msg'])){?>
                   <div class="alert-message error" id="msg"><center><?php echo $_POST['msg'];?></center></div>
                   <?php }?>
                
                    <h2>Add News</h2>
                    <div class="btn-placeholder">
                        <input type="button" class="btn grey main" value="Cancel" onclick="buttonCancel()">
                        <input type="submit" class="btn green main" value="Save Changes" name="btn-add-news">
                        <input type="submit" class="btn green main" value="Save Changes &amp; Exit" name="btn-add-news">
                    </div>
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
                                <label for="category">Category <span>*</span></label>
                                <select class="input-select" id="category" name="category">
                                    <option selected value=""></option>
                                    <?php foreach($category as $category){?>
                                    <option value="<?php echo $category['category_id'];?>"><?php echo $category['category_name'];?></option>
                                    <?php }?>
                                </select>
                            </li>
                            <li class="field-divider"></li>
                            <li class="field">
                                <label>Title <span>*</span></label>
                                <input type="text" class="input-text" name="news_title" id="news-title" onkeypress="checkTitle()">
                            </li>
                            <li class="field">
                                <label>Date <span>*</span></label>
                                <input type="text" class="input-text" style="width: 300px" name="news_date" id="news-date">
                            </li>
                            <li class="field input-file clearfix">
                                <label>Cover Image</label>
                                <div class="clearfix" style="width: 550px; padding-bottom: 8px">
                                    <div class="fl image" style="width: 174px; height: 116px" onMouseOver="removeButton('1')" id="newer-1">
                                        <div class="" id="remove-news-1">
                                           <div class="image-delete" id="btn-slider-1" onClick="clearImage('1')"></div>
                                           <div class="image-overlay" onClick="openBrowser('1')"></div>
                                        </div>
                                        <img class="hidden" id="upload-news-1">
                                        <input type="file" name="upload_news_1" id="news-1" onchange="readURL(this,'1')" class="hidden"/>                                    
                                    </div>
                                </div>
                                
                                <p class="field-message" style="padding-top: 10px">Recommended dimensions of 228 x 152 px.</p>
                            </li>
                            
<script>   
   function readURL(input,i) {
      
	  if (input.files && input.files[0]) {
	     var reader = new FileReader();
		 reader.onload = function (e) {
		    $("#upload-news-"+i).removeClass("hidden");
		    $("#upload-news-"+i).attr('src', e.target.result);
			//$("#news-flag-"+i).val('notempty');
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
	   $("#news-flag-"+i).val('');
   }
   </script>

                            
                            
                            <li class="field-divider"></li>
                            <li class="field">
                                <label>Content <span>*</span></label>
                                <textarea rows="8" id="news-content" name="news_content"></textarea>
                            </li>
                        </ul>
                    </div>
                </div><!--box-->

            </div><!--main-content-->
            
</form>


            
            
            
<script>
function buttonCancel(){
   location.href = "http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news"?>";
}

function validationAddNews(){
   var category = $('#category').val();
   var title    = $('#news-title').val();
   var date     = $('#news-date').val();
   var content  = $('#news-content').val();
   
   if(category == "" || title == "" || date == "" || content == ""){
      alert("Please choose news category - "+title);
   }
   
}

function checkTitle(){
   var newsTitle = $('#news-title').val();
   $('#testing').val(newsTitle);
}
</script>

            
