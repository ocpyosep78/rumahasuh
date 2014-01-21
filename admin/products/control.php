<?php
include("get.php");
include("update.php");

$equal_search = array('type_price','type_visibility');
$default_sort_by = "product_order";

// CATEGORY
if ($_REQUEST["cat"] == "" || $_REQUEST["cat"] == "top"){
   $cat = 'top';
}else{
   $cat      = get_category_id($_REQUEST["cat"]);
   $cat_name = ($_REQUEST["cat"]);
}

	
$pgdata = page_init($equal_search,$default_sort_by); // static/general.php

$page             = $pgdata['page'];
$query_per_page   = $pgdata['query_per_page'];
$sort_by          = $pgdata['sort_by'];
$first_record     = $pgdata['first_record'];
$search_parameter = $pgdata['search_parameter'];
$search_value     = $pgdata['search_value'];
$search_query     = $pgdata['search_query'];
$search           = $pgdata['search'];

$full_product = get_full_product($search_query, $sort_by, $first_record, $query_per_page, $cat);

$total_query  = $full_product['total_query'];
$total_page   = $full_product['total_page']; // RESULT
						

$all_product  = get_all_product($search_query, $sort_by, $first_record, $query_per_page, $cat);

//variable
// Category
$all_category    = get_all_category();

// Size Group
$all_size_group  = get_all_size_group();

// Color
$all_color_group = get_all_color_group();



//UPDATE
if ($_POST["btn-product-index"]=='GO'){
   
   if($_POST['product-index-action'] != 'order'){
      update_product_table();
   }else if($_POST['product-index-action'] == 'order'){
      
	  // DEFINED VARIABLE
	  $hidden_id = $_POST['hidden_product_id'];
	  $order     = $_POST['product_order'];
	  
	  foreach($hidden_id as $key=>$hidden_id){
	     update_order($key, $hidden_id);
	  }
	  
   }
   
}
?>