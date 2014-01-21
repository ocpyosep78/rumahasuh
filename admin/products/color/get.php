<?php
function get_all_color($one, $two, $three, $four){
   $conn = connDB();
   
   $sql = "SELECT 
           color.color_id, color_name, color_image, color.color_image, color.color_active_status, color.color_visibility_status,COUNT( type_id ) AS total_product, type_visibility, type_delete
		   FROM tbl_color AS color LEFT JOIN tbl_product_type AS  TYPE ON color.color_id = type.color_id
		   WHERE $one AND color_delete = 0 AND `type_delete` = 0
		   GROUP BY color_id
		   ORDER BY $two
		   LIMIT $three , $four";
   $query = mysql_query($sql, $conn);
   $row = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


function get_all_color_total_product($post_color_id, $post_type_delete){
   $conn = connDB();
   
   $sql = "SELECT COUNT(type_id) AS total_products FROM tbl_product_type WHERE color_id = '$post_color_id' AND type_delete = '$post_type_delete' ";
   $query = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}

function get_all_color_filter($one, $two, $three, $four){
   $conn = connDB();
   
   $sql = "SELECT 
           color.color_id, color_name, color_image, color.color_image, color.color_active_status, color.color_visibility_status,COUNT( type_id ) AS total_product, type_visibility, type_delete
		   FROM tbl_color AS color LEFT JOIN tbl_product_type AS  TYPE ON color.color_id = type.color_id
		   WHERE $one AND color_delete = 0
		   GROUP BY color_id
		   ORDER BY $two
		   LIMIT $three , $four";
   $query = mysql_query($sql, $conn);
   
   $full_order['total_query'] = mysql_num_rows($query);
   $full_order['total_page']  = ceil($full_order['total_query'] / $four); 

   return $full_order;
}

function get_latest_order(){
   $conn = connDB();
   
   $sql    = "SELECT * FROM tbl_color ORDER BY color_order DESC LIMIT 1";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}

function get_color_image($one){
   $conn = connDB();
   
   $sql    = "SELECT * FROM tbl_color WHERE color_id = '$one'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}

function check_color($post_color_id){
   $conn   = connDB();
   
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_color AS color INNER JOIN tbl_product_type AS TYPE ON color.color_id = type.color_id
              WHERE type.color_id =  '$post_color_id' AND type_delete = 0
			 ";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}
?>