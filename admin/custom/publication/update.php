<?php
function delete($post_career_id){
   $conn  = connDB();
   
   $sql   = "DELETE FROM tbl_publication WHERE `career_id` = '$post_career_id'";
   $query = mysql_query($sql, $conn) or die(mysql_error());
}

function update_visibility($post_visibility, $post_category_id){
   $conn  = connDB();
   
   $sql   = "UPDATE tbl_publication SET `visibility` = '$post_visibility' WHERE `career_id` = '$post_category_id'";
   $query = mysql_query($sql, $conn) or die(mysql_error());
}
?>