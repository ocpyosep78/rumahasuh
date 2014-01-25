<?php
/* -- DEFINED VARIABLE -- */

// REQUEST
$category_id   = $_REQUEST['cat_id'];


// CALL FUNCTION
$category = get_city($category_id);
$check    = count_job($category_id);
$city     = get_cities();

//$category_name = 


if(isset($_POST['btn_detail_service_job'])){
   
   // DEFINED VARIABLE
   $active     = '1';
   $visibility = $_POST['visibility_status'];
   $city_name  = stripslashes($_POST['category_name']);
   $cat_id     = $_POST['cat_id'];
   $category   = $_POST['category_department'];
   
   if(!empty($_FILES['upload_image_1']['name'])){
   
      // ADD FOR ANTICIPATED CROWDED IMAGE NAME @ 4 November 2013
      $file_name = substr($_FILES['upload_image_1']['name'],0,-4);
      $file_type = substr($_FILES['upload_image_1']['name'],-4);
   
      $uploads_dir   = '../files/uploads/awards_image/';
      //$userfile_name = str_replace(array('(',')',' '),'_',$_FILES['upload_news_1']['name']);
      $userfile_name = cleanurl($file_name).$file_type;
      $userfile_tmp  = $_FILES['upload_image_1']['tmp_name'];
      $prefix        = 'award-image-';
      $prod_img      = $uploads_dir.$prefix.$userfile_name;
   
      move_uploaded_file($userfile_tmp, $prod_img);
      $slider_image  = $prefix.$userfile_name;
   
      $desc          = "files/uploads/awards_image/".$slider_image;
   }else{
      
	  if(!empty($_POST['check_banner'])){
         $desc = '';
	  }else{
         $desc = $_POST['hidden_description'];
	  }
	  
   }
   
   //$desc       = stripslashes($_POST['career_description']);
   $map        = stripslashes($_POST['category_maps']);
   
   if($_POST['btn_detail_service_job'] == 'Delete'){
   
      delete($cat_id);
	  
	  $_SESSION['alert'] = 'success';
	  $_SESSION['msg']   = 'Item has been successfully deleted.';
   
   }else{
	   
      update($city_name, $category, $desc, $map, $visibility, $cat_id);
	  
	  $_SESSION['alert'] = 'success';
	  $_SESSION['msg']   = 'Item has been successfully saved.';
   }
   
}
?>