<?php
/* SESSION */
session_start();

$_SESSION['KCFINDER'] = array();
$_SESSION['KCFINDER']['disabled'] = false;


// RESET SESSION
function reset_session($post_alert, $post_msg, $post_page, $post_curr_page){
   
   if($post_page != $post_curr_page){
      unset($post_alert);
	  unset($post_msg);
   }
   
}

// CALL FUNCTION
if(isset($_SESSION['alert'])){
   reset_session($_SESSION['alert'], $_SESSION['msg'], $_SESSION['page'], $act);
}

// DISPLAY ERROR
ini_set("display_errors", 0); 


// GET CURRENT DATE
function current_date(){
   $date   = date('D, j M Y');  
   
   echo $date;
}

// GET CURRENT DATE PHPMYADMIN FORMAT
function current_date_sql(){
   $date   = date('Y-m-d');  
   
   return $date;
}


// FORMAT DATE
function format_date($time){
   $date   = date('D, j M Y',strtotime($time));  
   
   return $date;
}


// FORMAT DATE FOR DATEPICKER
function format_date_min($time){
   $date   = date('Y/m/j',strtotime($time));  
   
   return $date;
}


// FORMAT DATE FOR SQL
function format_date_sql($time){
   $date   = date('Y-m-j',strtotime($time));  
   
   return $date;
}


/* -- SECURITY -- */
$anti_link = array("delete", "update", "insert", "alter", "drop", "http", "https", "ftp", "www");


// CLEAN ALPHABET
function clean_alphabet($str) {
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
   $clean = preg_replace("/[^a-zA-Z]\s/", '', $str);
   $clean = preg_replace("/[^a-zA-Z]\s/", '', $clean);
   $clean = addslashes($clean);

   return $clean;
}

// CLEAN EMAIL
function clean_email($str) {
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
   $clean = preg_replace("/[^a-zA-Z0-9.@]/", '', $str);
   $clean = preg_replace("/[^a-zA-Z0-9.@]/", '', $clean);
   $clean = addslashes($clean);
   
   return $clean;
}

// CLEAN ALPHANUMERIC
function clean_alphanum($str) {
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
   $clean = preg_replace("/[^a-zA-Z0-9]\s/", '', $str);
   $clean = preg_replace("/[^a-zA-Z0-9]\s/", '', $clean);
   $clean = addslashes($clean);

   return $clean;
}

function clean_number($number){
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $number);
   $clean = preg_replace("/[^0-9]/", '', $number);
   $clean = trim($clean, '*');
   $clean = preg_replace("/[^0-9]/", '', $clean);

   return $clean;
}

function clean_alphanumeric($alphanum){
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $alphanum);
   $clean = preg_replace("/[^a-zA-Z0-9]/", '*', $alphanum);
   $clean = trim($clean, '*');
   $clean = preg_replace("/[^a-zA-Z0-9]/", '*', $clean);

   return $clean;
}



/* FORMATING */

// CLEANURL
function cleanurl($str) {
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
   $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
   $clean = strtolower(trim($clean, '-'));
   $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

   return $clean;
}

function clean_image($str) {
   $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
   $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
   $clean = strtolower(trim($clean, '-'));
   $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

   return $clean;
}

// GET DIR
function get_dirname($path){
   $current_dir = dirname($path);
   
   if($current_dir == "/" || $current_dir == "\\"){
      $current_dir = '';
   }
   
   return $current_dir;
}


// RANDOM CHAR
function randomchr($length = 5, $letters = '123456789abcdefghijklmnopqrstuvwxyz') {
		$s = '';
		$lettersLength = strlen($letters)-1;

		for($i = 0 ; $i < $length ; $i++)
		{
			$s .= $letters[rand(0,$lettersLength)];
		}
		return $s;
	}

// CLEAN POST FROM HTML TAGS
function removeHtmlTags($source) {
   $allowedTags = '<h1><h2><h3><h4><h5><h6><br><b><p><u><i><a><ol><ul><li><pre><hr><blockquote><table><tr><td><th><span><div><strong><tbody><sup><font>';
   $source = strip_tags($source, $allowedTags);
   return preg_replace('/<(.*?)>/ie', "'<'.removeHtmlAttributes('\\1').'>'", $source);
}


// DISPLAY PRICE
function price($number){
   $format = number_format($number,0,',','.');
   return $format;
}

// CLEAN PRICE FORMAT
function clean_price($number) {
   $clean = str_replace(".", "", $number);

   return $clean;
}


// URL
$prefix_url  = "http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/";
$act         = $_REQUEST['act'];
$current_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];



/* DATABASE */
function disconnect() {
   $conn = @mysql_pconnect($host, $user, $pass) or die (mysql_error());
   mysql_close($conn);
}

function db($sql){
	$conn = connDB();
	//echo $sql.'<br><br>';

	$query  = mysql_query($sql, $conn);
	$row    = array();
          while($result = mysql_fetch_array($query)){
		     array_push($row, $result);
		  }
    return $row;

}



/* LOGIN */

// Get valid login
function admin_login($one, $two){
   $conn = connDB();
   
   $sql    = "SELECT count(*) as rows, `id` FROM tbl_admin where username = '$one' and password = MD5('$two')";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;

}

// Get valid forgot password
function admin_forgot_password($one){
   $conn = connDB();
   
   $sql    = "SELECT count(*) as rows, `id` FROM tbl_admin where username = '$one'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;

}


// TBL_INFO
function get_info(){
   $conn   = connDB();
   
   $sql    = "SELECT * FROM tbl_infos";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}

// TBL_GENERAL
function get_general(){
   $conn   = connDB();
   
   $sql    = "SELECT * FROM tbl_general";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}

// TBL_USER
function get_customer_global($get_user_id){
   $conn   = connDB();
   
   $sql    = "SELECT * FROM tbl_user WHERE `user_id` = '$get_user_id'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


// CALL FUNCTION
$info        = get_info();
$general     = get_general();
$global_user = get_customer_global($_SESSION['user_id']);


/* --- CONTROL HEADER --- */
// Get page, query_per_page, first_record, sort_by, search_parameter, search_value
function page_init($equal_search,$default_sort_by){
	$pgdata = array();
	// PAGE
	if ($_REQUEST["pg"] == ""){
	   $pgdata['page'] = 1;
	}else{
	   $pgdata['page'] = $_REQUEST["pg"];
	}
	
	// QUERY PER PAGE
	if ($_REQUEST["qpp"]==""){
	   $pgdata['query_per_page'] = 25;
	}else{
	   $pgdata['query_per_page'] = $_REQUEST['qpp'];
	}
	
	// FIRST VALUE IN LIMIT
	$pgdata['first_record'] = ($pgdata['page'] - 1) * $pgdata['query_per_page'];
	
	// SORT BY
	$pgdata['sort_by']    = $_REQUEST["srt"];
	
	if ($pgdata['sort_by'] ==""){
	   $pgdata['sort_by'] = $default_sort_by;
	}
	
	$pgdata['search_parameter'] = stripslashes($_REQUEST['src']);
	$pgdata['search_value']     = stripslashes($_REQUEST['srcval']);
	
	$search_parameter = stripslashes($_REQUEST['src']);
	$search_value     = stripslashes($_REQUEST['srcval']);
	   
	if ($search_parameter==''){
	   $pgdata['search_query']='1';
	}else{
	   $pgdata['search'][$search_parameter] = $search_value;
	   
	   if (in_array($search_parameter, $equal_search)){
	      $pgdata['search_query'] = $search_parameter." = '".$search_value."'";
	   }else{
		  $pgdata['search_query'] = $search_parameter." LIKE '%".$search_value."%'";
	   }
	   
	}	
	
	return $pgdata;
}

function alias_count_type(){
   $conn = connDB();
   
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_product_type WHERE `type_alias` = ''";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}

function alias_get_type(){
   $conn = connDB();
   
   $sql    = "SELECT * FROM tbl_product_type WHERE `type_alias` = ''";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
	   array_push($row, $result);
   }
   
   return $row;
}

function alias_update_type($post_type_id, $post_type_name){
   $conn  = connDB();
   
   $sql   = "UPDATE tbl_product_type SET `type_alias` = '$post_type_name' WHERE `type_id` = '$post_type_id'";
   $query = mysql_query($sql, $conn);
}

$alias_check = alias_count_type();
$alias_get   = alias_get_type();

if($alias_check['rows'] > 0){
   
   foreach($alias_get as $alias_get){
      alias_update_type($alias_get['type_id'], cleanurl($alias_get['type_name']));
   }
   
}


/* -- DISCOUNT -- */

// PRICE
function discount_price($post_disc_id, $post_disc_value, $post_normal_price, $post_start, $post_end){
   
   if($post_start <= date('Y-m-d') and $post_end >= date('Y-m-d')){
      
          if( $post_disc_id == "1" || $post_disc_id == 1){
          
             // PERCENTAGE
             $return['now_price'] = $post_normal_price - (($post_disc_value / 100) * $post_normal_price);
             $return['was_price'] = $post_normal_price;
          
          }else if($post_disc_id == "2" || $post_disc_id == 2){
      
             // AMOUNT
             $return['now_price'] = $post_normal_price - $post_disc_value;
             $return['was_price'] = $post_normal_price;
          }
          
   }else{
      $return['now_price'] = $post_normal_price;
   }
   
   return $return;
   
}


/* -- LABEL -- */

// DISCOUNT
function discount_label($post_disc_id, $post_start, $post_end, $prefix_url){
   
   if(!empty($post_disc_id) || $post_disc_id == ""){
   
      if($post_start <= date('Y-m-d') and $post_end >= date('Y-m-d')){
         echo '<div class="thumb-label sale"><img src="'.$prefix_url.'files/common/icon_sale.png"></div>'; 
      }
	  
   }
   
}


// NEW ARRIVAL
function new_label($post_disc_id, $post_start, $post_end, $prefix_url){
   
   if(!empty($post_disc_id) || $post_disc_id == ""){
   
      if($post_start <= date('Y-m-d') and $post_end >= date('Y-m-d')){
         echo '<div class="thumb-label new"><img src="'.$prefix_url.'files/common/icon_new.png" style="width:50px; height:50px"></div>'; 
      }
	  
   }
   
}




// SESSION DUAL LANGUAGE
if(!isset($_SESSION['lang'])){
   $_SESSION['lang'] = "en";
}
?>