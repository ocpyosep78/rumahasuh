<?php
include("../static/general.php");
include("../../static/general.php");

$promo_item_id = $_POST['itemID'];

function remove_filter($post_sub_id){
   $conn  = connDB();
   
   $sql   = "DELETE FROM tbl_filter_sub_item WHERE `sub_id` = '$post_sub_id'";
   $query = mysql_query($sql, $conn) or die(mysql_error());
}

if(!empty($promo_item_id)){
   remove_filter($promo_item_id);
}
?>