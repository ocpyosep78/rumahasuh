<?php
function get_listing_news(){
   $conn = connDB();
   
   $sql    = "SELECT * FROM tbl_news AS news INNER JOIN tbl_news_category AS cat ON news.news_category = cat.category_id ORDER BY news.news_title";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}
?>