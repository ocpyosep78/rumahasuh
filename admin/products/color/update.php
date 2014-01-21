<?php
function insert_image($one, $two, $three, $four, $five){
   $conn = connDB();
   
   $sql    = "INSERT INTO tbl_color (color_name, color_image, color_order, color_active_status, color_visibility_status) VALUES ('$one', '$two', '$three', '$four', '$five')";
   $query  = mysql_query($sql, $conn);
}

function edit_color($one, $two, $three, $four, $five, $six){
   $conn = connDB();
   
   $sql    = "UPDATE tbl_color SET color_name = '$one', color_image = '$two', color_order = '$three', color_active_status = '$four', color_visibility_status = '$five' WHERE color_id = '$six'";
   $query  = mysql_query($sql, $conn);
}

function delete_color($post_color_delete, $post_color_id){
   $conn = connDB();
   
   $sql    = "UPDATE tbl_color SET color_delete = '$post_color_delete' WHERE color_id = '$post_color_id'";
   $query  = mysql_query($sql, $conn);
}
?>