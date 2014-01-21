<?php
/* -- PROMO -- */
function insert_promo($promo_id, $filename, $link, $order, $flag){
   $conn = connDB();
	
   $sql    = "INSERT INTO `tbl_promo_banner` (`id`, `filename`, `link`, `order`, `flag`) VALUES ('$promo_id','$filename', '$link', '$order', '$flag')";
   $query  = mysql_query($sql, $conn);
}

function update_promo($filename, $link, $order, $flag, $promo_id){
   $conn = connDB();
	
   $sql    = "UPDATE `tbl_promo_banner` SET `filename` = '$filename', `link` = '$link', `order` = '$order', `flag` = '$flag' WHERE `id` = '$promo_id'";
   $query  = mysql_query($sql, $conn);
}
?>