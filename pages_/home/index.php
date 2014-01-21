<?php
/* -- SLIDESHOW -- */

// COUNT SLIDESHOWS
function count_slideshow(){
   $conn   = connDB();
   
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_slideshow ORDER BY `order_`";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


// GET SLIDESHOWS
function get_slideshows(){
   $conn   = connDB();
   
   $sql    = "SELECT * FROM tbl_slideshow ORDER BY `order_`";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}




/* -- FEATURED -- */

// COUNT FEATURED
function count_featured(){
   $conn   = connDB();
   
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_featured AS feat_ INNER JOIN tbl_product_type AS type_ ON feat_.featured_type_id = type_.type_id
                                                                 INNER JOIN tbl_product AS prod_ ON type_.product_id = prod_.id
																 INNER JOIN tbl_category AS category_ ON prod_.product_category = category_.category_id
																 LEFT JOIN tbl_product_image AS img_ ON type_.type_id = img_.type_id
																 LEFT JOIN tbl_product_stock AS stock_ ON type_.type_id = stock_.type_id
																 LEFT JOIN tbl_promo_item AS promo_ ON type_.type_id = promo_.product_type_id
			 WHERE type_.type_visibility = '1' AND type_.type_delete != '1'
		     ";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


// GET FEATURED
function get_featured(){
   $conn   = connDB();
   
   $sql    = "SELECT * FROM tbl_featured AS feat_ INNER JOIN tbl_product_type AS type_ ON feat_.featured_type_id = type_.type_id
                                                  INNER JOIN tbl_product AS prod_ ON type_.product_id = prod_.id
												  INNER JOIN tbl_category AS category_ ON prod_.product_category = category_.category_id
												  LEFT JOIN tbl_product_image AS img_ ON type_.type_id = img_.type_id
												  LEFT JOIN tbl_product_stock AS stock_ ON type_.type_id = stock_.type_id
												  LEFT JOIN tbl_promo_item AS promo_ ON type_.type_id = promo_.product_type_id
			 WHERE type_.type_visibility = '1' AND type_.type_delete != '1'
			 ";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


// COUNT STOCK
function count_stock_featured($post_type_id){
   $conn   = connDB();
   
   $sql    = "SELECT SUM(stock_quantity) AS total_stock FROM tbl_product_stock WHERE `type_id` = '$post_type_id'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}



/* -- CONTROL -- */

// CALL FUNCTION
$count_slideshow = count_slideshow();
$get_slideshow   = get_slideshows();

$count_featured  = count_featured();
$get_featured    = get_featured();
?>

    <div class="container main">
      <div class="content">
        
     	<?php include("static/navbar.php"); ?>


      </div><!--.content-->
    </div><!--.container.main-->

    