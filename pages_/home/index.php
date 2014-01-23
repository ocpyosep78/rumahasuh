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
    
    
    <!--SLIDESHOW-->
    <link rel="stylesheet" href="<?php echo $prefix_url;?>script/supersized/slideshow/css/supersized.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?php echo $prefix_url;?>script/supersized/slideshow/theme/supersized.shutter.css" type="text/css" media="screen" />
    
	<script type="text/javascript" src="<?php echo $prefix_url;?>script/supersized/slideshow/js/jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo $prefix_url;?>script/supersized/slideshow/js/supersized.3.2.7.js"></script>
    <script type="text/javascript" src="<?php echo $prefix_url;?>script/supersized/slideshow/theme/supersized.shutter.js"></script>
    
    <!--config-->
	<script type="text/javascript">
	jQuery(function($){
		
	  $.supersized({
      // Functionality
	  slideshow               : 1,			// Slideshow on/off
	  autoplay				  :	1,			// Slideshow starts playing automatically
	  start_slide             : 1,			// Start slide (0 is random)
	  stop_loop				  :	0,			// Pauses slideshow on last slide
	  random				  : 0,			// Randomize slide order (Ignores start slide)
	  slide_interval          : 3000,		// Length between transitions
	  transition              : 1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
	  transition_speed		  :	1000,		// Speed of transition
	  new_window			  :	1,			// Image links open in new window/tab
	  pause_hover             : 0,			// Pause slideshow on hover
	  keyboard_nav            : 1,			// Keyboard navigation on/off
	  performance			  :	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
	  image_protect			  :	1,			// Disables image dragging and right click with Javascript
	  
	  // Size & Position	
	  min_width		          : 0,			// Min width allowed (in pixels)
	  min_height		      : 0,			// Min height allowed (in pixels)
	  vertical_center         : 1,			// Vertically center background
	  horizontal_center       : 1,			// Horizontally center background
	  fit_always			  :	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
	  fit_portrait         	  : 1,			// Portrait images will not exceed browser height
	  fit_landscape			  : 0,			// Landscape images will not exceed browser width
	  
	  // Components	
	  slide_links			  :	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
	  thumb_links			  :	0,			// Individual thumb links for each slide
	  thumbnail_navigation    : 0,			// Thumbnail navigation
	  slides 				  : [			// Slideshow Images
	  
	                            {
									image : '<?php echo $prefix_url;?>files/common/img_banner-1.jpg'},
									
								{
									image : '<?php echo $prefix_url;?>files/common/img_banner-2.jpg'},
									
								{
									image : '<?php echo $prefix_url;?>files/common/img_banner-3.jpg'}
								],
      // Theme Options	
	  progress_bar			 :	1,			// Timer for each slide	
	  mouse_scrub			 :	0
					
	  });
	});
	</script>

    