<?php

/*
|--------------------|
|      SORTING       |
|--------------------|
*/

$equal_search    = array('color_active_status', 'color_visibility_status');
$default_sort_by = "color_name";

$pgdata = page_init($equal_search,$default_sort_by); // static/general.php

$page             = $pgdata['page'];
$query_per_page   = $pgdata['query_per_page'];
$sort_by          = $pgdata['sort_by'];
$first_record     = $pgdata['first_record'];
$search_parameter = $pgdata['search_parameter'];
$search_value     = $pgdata['search_value'];
$search_query     = $pgdata['search_query'];
$search           = $pgdata['search'];


$full_order  = get_all_color_filter($search_query, $sort_by, $first_record ,$query_per_page);
$total_query = $full_order['total_query'];
$total_page  = ceil($full_order['total_query'] / $query_per_page);

// CALL FUNCTION
$listing_order = get_all_color($search_query, $sort_by, $first_record ,$query_per_page);


// HANDLING ARROW SORTING
if($_REQUEST['srt'] == "color_name DESC"){
   $arr_color_name = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "color_name"){
   $arr_color_name = "<span class=\"sort-arrow-down\"></span>";

}else if($_REQUEST['srt'] == "total_product DESC"){
   $arr_total_product = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "total_product"){
   $arr_total_product = "<span class=\"sort-arrow-down\"></span>";
}

else if($_REQUEST['srt'] == "color_active_status DESC"){
   $arr_color_active = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "color_active_status"){
   $arr_color_active = "<span class=\"sort-arrow-down\"></span>";
}

else if($_REQUEST['srt'] == "color_visibility_status DESC"){
   $arr_color_visibility = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "color_visibility_status"){
   $arr_color_visibility = "<span class=\"sort-arrow-down\"></span>";
}


// STORED VALUE
echo "<input type=\"hidden\" name=\"url\" id=\"url\" class=\"hidden\" value=\"http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/color-view\">\n";
echo "<input type=\"hidden\" name=\"page\" id=\"page\" class=\"hidden\" value=\"".$page."\" /> \n";
echo "<input type=\"hidden\" name=\"query_per_page\" id=\"query_per_page\" class=\"hidden\" value=\"".$query_per_page."\" /> \n";
echo "<input type=\"hidden\" name=\"total_page\" id=\"total_page\" class=\"hidden\" value=\"".ceil($full_order['total_query'] / $query_per_page)."\" /> \n";
echo "<input type=\"hidden\" name=\"sort_by\" id=\"sort_by\" class=\"hidden\" value=\"".$sort_by."\" /> \n";
echo "<input type=\"hidden\" name=\"search\" id=\"search\" class=\"hidden\" value=\"".$search_parameter."-".$search_value."\" /> \n";


/* -- BUTTON RESET -- */
if(empty($search_parameter)){
   $reset = "hidden";
}else{
   $reset = "";
}


function sort_by(){
	$sort_by=$_REQUEST["srt"];

   if ($sort_by==""){
      $sort_by="color_order ASC";
   }
}



if($_POST['btn-index-color'] == "Save Changes"){
	
   if(empty($_POST['col_id'])){
	   
      $uploads_dir = '../files/uploads/color_image/';
      $userfile_name = str_replace(array('(',')',' '),'_',$_FILES['color_image']['name']);
      $userfile_tmp = $_FILES['color_image']['tmp_name'];
      $prefix = 'color-'.randomchr()."-";
      $prod_img = $uploads_dir.$prefix.$userfile_name;
		
      move_uploaded_file($userfile_tmp, $prod_img);
      $color_image = $prefix.$userfile_name;
   
      // Get latest color order
      $latest_color_order = get_latest_order();
      $color_order        = $latest_color_order['color_order']+1; 
   
      // Define variable
      $color_name              = $_POST['color_name'];
      $color_active_status     = $_POST['active_status'];
      $color_visibility_status = $_POST['visibility_status'];
	  
	  if(!empty($userfile_name)){
	     $col_image = $color_image;
	  }else{
	     $col_image = "no-color.png"; 
	  }
		
      insert_image($color_name, $uploads_dir.$col_image, $color_order, $color_active_status, $color_visibility_status);
      
	  $_SESSION['alert'] = "success";
	  $_SESSION['msg']   = "Color(s) has been successfully added.";
   
   }else{
	  
	  $col_id = $_POST['col_id'];
	  $image = get_color_image($col_id);
	  
	  if(!empty($_FILES['color_image']['name'])){
		  
	     if(is_file($image['color_image'])) {
	        unlink($image['color_image']);
	     }
		 
		 $uploads_dir = '../files/uploads/color_image/';
         $userfile_name = str_replace(array('(',')',' '),'_',$_FILES['color_image']['name']);
         $userfile_tmp = $_FILES['color_image']['tmp_name'];
         $prefix = 'color-'.randomchr()."-";
         $prod_img = $uploads_dir.$prefix.$userfile_name;
		
         move_uploaded_file($userfile_tmp, $prod_img);
         $color_image = $prefix.$userfile_name;
		 $images = $uploads_dir.$color_image;
	  }else{
	     $images = $image['color_image'];
	  }
   
      // Define variable
      $color_name              = $_POST['color_name'];
      $color_active_status     = $_POST['active_status'];
      $color_visibility_status = $_POST['visibility_status'];
	  $color_order             = $image['color_order']; 
	  $color_id                = $_POST['col_id'];
	  
	  edit_color($color_name, $images, $color_order, $color_active_status, $color_visibility_status, $color_id);
      
	  $_SESSION['alert'] = "success";
	  $_SESSION['msg']   = "Changes have been successfully saved.";
      
   }

}else if($_POST['btn-index-color'] == "Delete"){
   
   // CALL FUNCTION
   $col_id = $_POST['col_id'];
   $check_color = check_color($col_id);
   
   
   if($check_color['rows'] > 0){
      $_SESSION['alert'] = "error";
	  $_SESSION['msg']   = "Can't delete because it contains one or more items.";
   }else{
      $color_id = $_POST['col_id'];
      $image    = get_color_image($color_id);
      delete_color(1, $color_id);
   
      if(is_file($image['color_image'])) {
         //unlink($image['color_image']);
      }
	  
      $_SESSION['alert'] = "success";
	  $_SESSION['msg']   = "Item(s) has been successfully deleted.";
	  
   }
}else if($_POST['btn-index-color'] == "GO"){
   
   if($_POST['color-action'] == "delete" || $_POST['color-option'] == "yes"){
      
	  foreach($_POST['color_id'] as $colid){   
	     
		 // CALL FUNCTION
		 $check_color = check_color($colid);
		 
		 if($check_color['rows'] > 0){
			$_SESSION['alert'] = "error";
			$_SESSION['msg']   = "Can't delete because it contains one or more items.";
		 }else{
			$image = get_color_image($colid);
			
			if(is_file($image['color_image'])) {
               //unlink($image['color_image']);
            }
			
	        delete_color(1,$colid);
			
			$_SESSION['alert'] = "success";
			$_SESSION['msg']   = "Item(s) has been successfully deleted.";
			
	     }
	     
	  }
	  
   }
   
}
?>