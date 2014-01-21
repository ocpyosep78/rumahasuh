<?php
function get_all_category(){
   $conn = connDB();
   
   $sql   = "SELECT * FROM tbl_category ORDER BY category_order ASC";
   $query = mysql_query($sql, $conn);
   $row   = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


function get_all_size_group(){
   $conn = connDB();
   
   $sql   = "SELECT * FROM tbl_size_type ORDER BY size_type_order ASC";
   $query = mysql_query($sql, $conn);
   $row   = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


function get_all_color_group(){
   $conn = connDB();
   
   $sql   = "SELECT * FROM tbl_color ORDER BY color_order ASC";
   $query = mysql_query($sql, $conn);
   $row   = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}

?>