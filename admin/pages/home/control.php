<?php
include("get.php");
include("update.php");

/*--------------------*/
/*        HOME        */
/*--------------------*/

$get_slideshows      = get_slideshows();
$count_slideshow     = count_slideshow();
$get_order_slideshow = get_order_slideshow();

// Banner
$id      = $_POST['slideshow_id'];
$link    = addslashes($_POST['name_link']);
$link_id = $_POST['link_id'];


if(isset($_POST['btn-link-banner'])){
   
   if($_POST['btn-link-banner'] == "Save Changes"){
      insertLinkBanner($link, $link_id);
	  
	  // ALERT
	  $_SESSION['alert'] = "success";
	  $_SESSION['msg']   = "Changes have been successfully saved.";
	  $_SESSION['page']  = $act;
	  
   }else if($_POST['btn-link-banner'] == "Delete"){
      insertLinkBanner('', $link_id);  
	  
	  // ALERT
	  $_SESSION['alert'] = "success";
	  $_SESSION['msg']   = "Changes have been successfully saved.";
	  $_SESSION['page']  = $act;
   }
   
}


if(isset($_POST['btn-pages-home'])){
   
   if($_POST['btn-pages-home'] == "Save Changes" || $_POST['btn-pages-home'] == "Save Changes & Exit"){
	  
	  /* -- BANNER -- */
	  foreach($id as $id){
		 
		 
		 $get_slideshow = get_slideshow($id);
		 $validate = validate_slideshow($id);
		 
		 $uploads_dir = '../../files/uploads/slideshow/';
		 $userfile_name = str_replace(array('(',')',' '),'_',$_FILES['upload_slider_'.$id]['name']);
		 $userfile_tmp = $_FILES['upload_slider_'.$id]['tmp_name'];
		 $prefix = 'slider-'.$id."-";
		 $prod_img = $uploads_dir.$prefix.$userfile_name;
		 
		 move_uploaded_file($userfile_tmp, $prod_img);
		 $slider_image = $prefix.$userfile_name;
		 
		 $filename = 'files/uploads/slideshow/'.$slider_image;
		 
		 if($validate['rows'] > 0){
			unlink("../".$get_slideshow['filename']);
		    update_slideshow($filename, $id);
			
			// ALERT
			$_SESSION['alert'] = "success";
			$_SESSION['msg']   = "Changes have been successfully saved.";
		    $_SESSION['page']  = $act;
		 }else{
		    insert_slideshow($id, $filename, $id);
			
			// ALERT
			$_SESSION['alert'] = "success";
			$_SESSION['msg']   = "Changes have been successfully saved.";
		    $_SESSION['page']  = $act;
		 }
		 
	  }// END FOR
	  
	  /* -- END BANNER -- */
   
   

   
   }
   
   
} // END ISSET









?>