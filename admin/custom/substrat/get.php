<?php
function get_category_id($category_name){
	$conn = connDB();
   
   $sql   = "SELECT * FROM tbl_category WHERE category_name = '$category_name'";
   $query = mysql_query($sql, $conn);
   
   if (mysql_num_rows($query)!=null){
	   $result = mysql_fetch_array($query);
	   return $result['category_id'];
   }
}

function get_product($search, $cat, $sort_by, $first_record, $query_per_page){
   $conn  = connDB();
   
   $sql   = "SELECT * FROM tbl_product AS prod LEFT JOIN tbl_product_type AS prot ON prod.id = prot.product_id
                                               LEFT JOIN tbl_promo_item AS item ON prot.type_id = item.product_type_id
											   INNER JOIN tbl_category AS pcat ON prod.product_category = pcat.category_id
											   INNER JOIN tbl_category_relation AS prel ON pcat.category_id = prel.category_child
             WHERE ($search) AND type_delete != '1' AND (category_parent = '$cat' OR category_id = '$cat')
			 GROUP BY `id`
            ";
   $query = mysql_query($sql, $conn);
   
   $full_product['total_query'] = mysql_num_rows($query);
   $full_product['total_page']  = ceil($full_product['total_query'] / $query_per_page); // 
   
   return $full_product;
}

function all_product($search, $cat, $sort_by, $first_record, $query_per_page){
   $conn  = connDB();
   
   $sql   = "SELECT * FROM tbl_product AS prod LEFT JOIN tbl_product_type AS prot ON prod.id = prot.product_id
                                               LEFT JOIN tbl_promo_item AS item ON prot.type_id = item.product_type_id
											   INNER JOIN tbl_category AS pcat ON prod.product_category = pcat.category_id
											   INNER JOIN tbl_category_relation AS prel ON pcat.category_id = prel.category_child
             WHERE ($search) AND type_delete != '1' AND (category_parent = '$cat' OR category_id = '$cat')
			 GROUP BY `id`
			 ORDER BY $sort_by
			 LIMIT $first_record , $query_per_page
            ";
   $query = mysql_query($sql, $conn);
   $row   = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;

}

function get_filter_item($post_filter_id){
   $conn  = connDB();
   
   $sql    = "SELECT * FROM tbl_filter_sub AS filter INNER JOIN tbl_filter_sub_item AS item ON filter.filter_id = item.filter_id WHERE `product_id` = '$post_filter_id'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}

function get_filter_items($post_filter_id){
   $conn  = connDB();
   
   $sql    = "SELECT * FROM tbl_filter_sub AS filter INNER JOIN tbl_filter_sub_item AS item ON filter.filter_id = item.filter_id WHERE `product_id` = '$post_filter_id'";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}

function get_sale_time($post_end_time, $post_start_time){
   $conn   = connDB();
   
   $sql    = "SELECT DATEDIFF('$post_end_time', '$post_start_time') AS left_days";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}



// FILTER
function get_filter(){
   $conn  = connDB();
   
   $sql   = "SELECT * FROM tbl_filter_sub WHERE `visibility`  = '1' ORDER BY filter_name";
   $query = mysql_query($sql, $conn);
   $row   = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}

function count_filter($post_product_id, $post_filter_id){
   $conn   = connDB();
   
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_filter_sub_item WHERE `product_id` = '$post_product_id' AND `filter_id` = '$post_filter_id'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}
?>