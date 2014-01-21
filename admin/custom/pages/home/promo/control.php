<?php
include("get.php");
include("update.php");

/* -- PROMO -- */
if($_POST['btn-pages-home'] == "Save Changes"){
   foreach($promo_id as $promo_id){
      $get_promo   = get_promo($promo_id);
	  $promo_order = $get_promo['order'];
	  $promo_flag  = $_POST['promo_flag_'.$promo_id];
	  
	  if(!empty($_FILES['upload_promo_'.$promo_id]['name'])){ 
	     
		 $uploads_dir_promo = 'files/uploads/promo/';
         $userfile_name_promo = str_replace(array('(',')',' '),'_',$_FILES['upload_promo_'.$promo_id]['name']);
         $userfile_tmp_promo = $_FILES['upload_promo_'.$promo_id]['tmp_name'];
         $prefix_promo = 'promo-'.$promo_id."-";
         $prod_img_promo = $uploads_dir_promo.$prefix_promo.$userfile_name_promo;
		
         move_uploaded_file($userfile_tmp_promo, $prod_img_promo);
         $promo_image = $prefix_promo.$userfile_name_promo;
		    
	     $filename_promo = $uploads_dir_promo.$promo_image;
		 
		 if(!empty($get_promo['flag'])){ 
		    $unlink_promo = $get_promo['flag'];
		 }else{
	        $unlink_promo = $filename_promo;
		 }
		 
		 if(!empty($get_promo['filename']) and $get_promo['filename'] != $get_promo['flag'] and file_exists($get_promo['flag'])){ 
		    unlink($get_promo['flag']);
	     }
		 
	  }else{
	     
		 if(!empty($get_promo['flag'])){ 
		    
			if(empty($get_promo['filename'])){ 
			   $unlink_promo = $get_promo['flag'];
			}else{ 
			   $unlink_promo = $get_promo['flag'];
			}
			   
		 }else{
			$unlink_promo = $get_promo['filename'];
	     }		
		 
		 $filename_promo = $promo_flag;
		 
		 }
		 
		 if(!empty($get_promo['filename']) and $get_promo['filename'] != $get_promo['flag'] and file_exists($get_promo['flag'])){ 
		    unlink($get_promo['flag']);
	     }
		 
	     update_promo($filename_promo, $link, $order, $unlink_promo, $promo_id);
	  }// END FOR
						
   /* -- END PROMO -- */
}


?>