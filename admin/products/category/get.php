<?php
function get_all_category($one, $two, $three, $four){
   $conn = connDB();
   
   $sql   = "SELECT 
             cat.category_id, cat.category_name, cat.category_level, cat.category_order, cat.category_active_status, cat.category_visibility_status, cat.category_level,
			 rel.category_child,
			 COUNT( prod.id ) AS total_product, prod.product_name
			 
			 FROM tbl_category AS cat LEFT JOIN tbl_product AS prod ON cat.category_id = prod.product_category
			                          INNER JOIN tbl_category_relation AS rel ON cat.category_id = rel.category_child
			 WHERE $one
			 GROUP BY category_id
			 ORDER BY $two 
			 LIMIT  $three, $four
			";
   $query = mysql_query($sql, $conn);
   $row   = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


function get_full_all_category($one, $two, $three, $four){
   $conn = connDB();
   
   $sql   = "SELECT 
             cat.category_id, cat.category_name, cat.category_level, cat.category_order, cat.category_active_status, cat.category_visibility_status, cat.category_level,
			 
			 COUNT( prod.id ) AS total_product, prod.product_name
			 
			 FROM tbl_category AS cat LEFT JOIN tbl_product AS prod ON cat.category_id = prod.product_category
			 WHERE $one
			 GROUP BY category_id
			 ORDER BY $two 
			 LIMIT  $three, $four
			";
   $query = mysql_query($sql, $conn);
   
   $full_order['total_query'] = mysql_num_rows($query);
   $full_order['total_page']  = ceil($full_order['total_query'] / $four); 

   return $full_order;
}


function get_all_category_by_id($one){
   $conn = connDB();
   
   $sql   = "SELECT 
             cat.category_id, cat.category_name, cat.category_level, cat.category_order,
			 COUNT(prod.id) AS total_product, prod.product_name
			 
			 FROM tbl_category AS cat INNER JOIN tbl_product AS prod ON cat.category_id = prod.product_category
			 
			 WHERE prod.product_category = '$one'";
   $query = mysql_query($sql, $conn);
   $row   = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}

function count_category(){
   $conn = connDB();
   
   $sql    = "SELECT count(*) rows FROM `tbl_category`";
   $query  = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());
   $result = mysql_fetch_array($query);
   
   return $result;
}



// Detail Category
function detail_category($one){
   $conn = connDB();
   
   $sql    = "SELECT
              cat.category_id, cat.category_name, cat.category_active_status, cat.category_visibility_status,
			  child.relation_id, child.category_child, child.category_parent, child.relation_level
			  FROM `tbl_category` AS cat LEFT JOIN `tbl_category_relation` AS child ON cat.category_id = child.category_child
			  WHERE cat.category_name = '$one'
			  ";
   
   $query  = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());
   $result = mysql_fetch_array($query);
   
   return $result;
}

function check_delete($post_category_id){
   $conn   = connDB();
   
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_category AS cat INNER JOIN tbl_product AS prod ON cat.category_id = prod.product_category
              WHERE product_category = '$post_category_id'
			 ";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}

function check_delete_get_category_name($post_category_id){
   $conn   = connDB();
   
   $sql    = "SELECT * AS rows FROM tbl_category WHERE category_id = '$post_category_id'
			 ";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function getChildID(){
   $conn   = connDB();
   
   $sql    = "SELECT DISTINCT(category_child) FROM `tbl_category_relation` WHERE category_parent != 'top'";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}

function getParent($post_category_child){
   $conn   = connDB();
   
   $sql     = "SELECT * FROM tbl_category_relation WHERE category_child =  '$post_category_child' AND  `relation_level` ='1'";
   $query   = mysql_query($sql, $conn);
   $result  = mysql_fetch_array($query);
   
   return $result;
}

function getTotal($post_category_id){
   $conn   = connDB();
   
   $sql    = "SELECT COUNT( type_id ) AS total_product FROM tbl_category AS cat INNER JOIN tbl_product AS prod ON cat.category_id = prod.product_category
                                                               LEFT JOIN tbl_product_type AS TYPE ON prod.id = type.product_id
			  WHERE product_category =  '$post_category_id' AND type_delete =  '0'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}
?>