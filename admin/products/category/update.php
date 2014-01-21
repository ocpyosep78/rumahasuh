<?php
// Add Category
function add_category($one, $two, $three, $four, $five, $six, $seven){
   $conn = connDB();
   
   $sql    = "INSERT INTO tbl_category 
              (category_name, category_description, category_level, category_order, category_active_status, category_visibility_status)
			  VALUES ('$one', '$two', '$three', '$four', '$five', '$six')";
   $query  = mysql_query($sql, $conn);
}


function add_category_relation($one, $two, $three, $four){
   $conn = connDB();
   
   $sql    = "INSERT INTO tbl_category_relation 
              (relation_id, category_child, category_parent, relation_level)
			  VALUES ('$one', '$two', '$three', '$four')";
   $query  = mysql_query($sql, $conn);
}
?>