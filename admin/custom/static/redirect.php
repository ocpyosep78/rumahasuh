<?php
/*
--------------------
|     CUSTOMS      |
--------------------
*/


/* NEWS */

// NEWS EDIT
if(isset($_POST['btn-edited-news'])){
   if($_POST['btn-edited-news'] == "Save Changes"){
	  $nid = $_POST['news_id'];
	  $nit = $_POST['news_title'];
      header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news-edit/".$nid."/".cleanurl($nit));
   }else{
      header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news");
   }
   
// NEWS LISTING
}else if(isset($_POST['btn-index-news-listing'])){
   header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news");
   


/* RECIPE */


// ADD RECIPE 
}else if(isset($_POST['btn-add-recipe'])){
   
   if($_POST['btn-add-recipe'] == "Save Changes"){
	  
	  if(empty($_POST['category_id'])){
         header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/recipe-category-added");
	  }else{
         header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/recipe-category-edited");
	  }
   
   // DELETE RECIPE	  
   }else if($_POST['btn-add-recipe'] == "Delete"){
      header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/recipe-category-deleted");
   
   // LISTING RECIPE	  
   }else if($_POST['btn-add-recipe'] == "GO"){
      if(!empty($_POST['array_category_id'])){
	     header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/recipe-category-deleted");
	  }
   }

}

// RECIPE
else if(isset($_POST['btn-index-recipes'])){
   
   if($_POST['btn-edit-recipes'] == "Save Changes & Exit"){
	   header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/recipe");
   }
   
}


// DESIGNER
else if(isset($_POST['btn_add_designer'])){
   header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/designers");
}


// VOUCHER
else if(isset($_POST['btn_voucher_submit'])){
   header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/voucher-manager");


// SHIPPING
}else if(isset($_POST['btn-add-shipping'])){
   
   if($_POST['btn-add-shipping'] == "Save Changes & Exit"){
      header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/shipping");
   }else if($_POST['btn-add-shipping'] == "Save Changes"){
      header("location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/shipping/".$_REQUEST['sid']);
   }

}
?>