<?php
// Get value
$news_id    = $_REQUEST['nid'];
//$news_title = $_REQUEST['nn'];

$clean      = $_REQUEST['nn'];
$news_title = preg_replace("/[\/_|+ -]+/", ' ', $clean);

// DEFINED VARIABLE
$post_news_id  = $_POST['news_id'];
$post_category = $_POST['category'];
$post_title    = strtolower($_POST['news_title']);
$post_date     = $_POST['news_date'];
$post_content  = $_POST['news_content'];
$get_date      = date('Y-m-d H:i:s');

$news_detail       = get_news_detail($news_id, $news_title);
$all_news_category = getAllCategory();
$check_title       = check_news_title($post_title);

if(isset($_POST['btn-edit-news'])){
   if($_POST['btn-edit-news'] == "Save Changes" || $_POST['btn-edit-news'] == "Save Changes & Exit"){
      
	  // Validate News Title
	  if($check_title['rows'] > 0){
	      $post_check = $post_title."-1";
	  }else{
	      $post_check = $post_title;
	  }
	   
	   // CHECK UPLOAD
	   if(empty($_POST['check_image'])){
	      $uploads_dir   = '../files/uploads/news_image/';
          $userfile_name = str_replace(array('(',')',' '),'_',$_FILES['upload_news_1']['name']);
          $userfile_tmp  = $_FILES['upload_news_1']['tmp_name'];
          $prefix        = 'news_image-';
          $prod_img      = $uploads_dir.$prefix.$userfile_name;
			
	      move_uploaded_file($userfile_tmp, $prod_img);
		  $slider_image  = $prefix.$userfile_name;
			
	      $post_news_image = "files/uploads/news_image/".$slider_image;
		  
		  if($_POST['check_image'] != $_POST['unlink_image']){
		     unlink("../".$_POST['unlink_image']);
		  }
		  
	   }else{
	      $post_news_image = $_POST['check_image'];
	   }
	   
	   updateNews($post_category, $post_title, $post_date, $post_news_image, $post_content, $get_date, $post_news_id);
	   
	   if($_POST['btn-edit-news'] == "Save Changes"){
	   ?>
          <script>
		  location.href = "http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news-edit/".$post_category."/".cleanurl($post_title)?>";
		  </script>
	   <?php
	   }else if($_POST['btn-edit-news'] == "Save Changes & Exit"){
	   ?>
          <script>
	      location.href = "http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news"?>";
	      </script>
       <?php
	   }
	
	}else if($_POST['btn-edit-news'] == "Delete"){
       unlink("../".$_POST['unlink_image']);
	   deleteNews($news_id);
	   $_POST['msg'] = "Successfully delete news";
	?>
       <script>
	   location.href = "http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news"?>";
	   </script>
    <?php	  
    }
   
}// END ISSET



if(isset($_POST['btn-edited-news'])){
   if($_POST['btn-edited-news'] == "Save Changes"){
      
	  //Delete Image
	  if($_POST['check_image'] != $_POST['unlink_image']){
	     unlink("../".$_POST['unlink_image']);
	  }
	   
	  // Validate News Title
	  if($check_title['rows'] > 0){
		 
		 if($news_detail['news_title'] == $post_title){
	        $post_check = $post_title;
		 }else{
	        $post_check = $post_title."-1";
		 }
	  }else{
	     $post_check = $post_title;
	  }
	  
	  // Uploading New Image
	  if(empty($_POST['check_image'])){
         $uploads_dir   = '../files/uploads/news_image/';
         $userfile_name = str_replace(array('(',')',' '),'_',$_FILES['upload_news_1']['name']);
         $userfile_tmp  = $_FILES['upload_news_1']['tmp_name'];
         $prefix        = 'news_image-';
         $prod_img      = $uploads_dir.$prefix.$userfile_name;
			
	     move_uploaded_file($userfile_tmp, $prod_img);
		 $slider_image  = $prefix.$userfile_name;
		 
		 $post_news_image = "files/uploads/news_image/".$slider_image;
      }else{
	     $post_news_image = $_POST['check_image'];
	  }
	  
	  updateNews($post_category, $post_check, $post_date, $post_news_image, $post_content, $get_date, $post_news_id);
	  
	  $_POST['msg'] = "Success edited news";
   
   }else if($_POST['btn-edited-news'] == "Save Changes & Exit"){
      
   }
}
?>