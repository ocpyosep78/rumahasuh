<?php
/* -- FUNCTIONS -- */

function count_news($search_param, $search_op, $search_value){
   $conn   = connDB();
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_news_category AS cat_ INNER JOIN tbl_news AS news_ ON cat_.category_id = news_.news_category
              WHERE $search_param $search_op '$search_value'
			  ORDER BY `news_date`
			 ";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function get_news($search_param, $search_op, $search_value, $start_record, $query_per_page){
   $conn   = connDB();
   $sql    = "SELECT * FROM tbl_news_category AS cat_ INNER JOIN tbl_news AS news_ ON cat_.category_id = news_.news_category
              WHERE $search_param $search_op '$search_value'
			  ORDER BY `news_date`
			  LIMIT $start_record, $query_per_page
			 ";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


function get_category(){
   $conn   = connDB();
   $sql    = "SELECT * FROM tbl_news_category ORDER BY `category_name`";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


/* -- DEFINED VARIABLE -- */

// REQUEST
$category = $_REQUEST['cat_news'];
$page     = $_REQUEST['cat_record'];


// CONTROL 
if(empty($_REQUEST['cat_news']) || $_REQUEST['cat_news'] == 'all' || empty($_REQUEST['cat_record'])){
   
   $category = '';
   $operator = '';
   $src_val  = '1';
   
   $paging_cat = 'all';
   
   $record = count_news($category, $operator, $src_val);
   
   $total_record = $record['rows'];
   
   $qpp  = 3;
   $page = 1;
   
   if($page == 'all'){
      
	  $start_record   = '0';
	  $query_per_page = $record['rows'];
	  
   }else{
	   
      $start_record   = ($page - 1) * $qpp;
	  $query_per_page = $page * $qpp;
   }
   
}else{
   
   $category = 'category_id';
   $operator = ' = ';
   $src_val  = $_REQUEST['cat_news'];
   
   $paging_cat = $_REQUEST['cat_news'];
   
   $qpp      = 3;
   $page     = $_REQUEST['cat_record'];
   
   $start_record   = ($page - 1) * $qpp;
   $query_per_page = $page * ($qpp - 1);
   
   $record = count_news($category, $operator, $src_val);
   
}



/* -- PAGINATION -- */
function view_pagination($post_total_record, $post_qpp, $post_req_cat, $post_req_filter, $post_req_sort, $post_req_page){
	
   // DEFINED VARIABLE
   $paging['total_record'] = $post_total_record;
   $paging['qpp']          = $post_qpp;
   $paging['total_page']   = ceil($post_total_record / $post_qpp);
   
   //$paging['first']        = 
   
   echo '<ul class="pagination pull-right">';
   echo "<li><a href=\"http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/blog\">&laquo;</a></li>";
   
   for($i=1; $i <= $paging['total_page']; $i++){
      echo "<li><a href=\"http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/blog-view/".$post_req_cat."/".$i."\">".$i."</a></li>";
   }
   echo "<li><a href=\"http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/blog-view/".$post_req_cat.'/'.$paging['total_page']."\">&raquo;</a></li>";
   echo '</ul>';
   
}



// CALL FUNCTIONS
$news          = get_news($category, $operator, $src_val, $start_record, $query_per_page);
$news_category = get_category();
?>

    <div class="container main">
      <div class="content">

        <ul class="">
          <a href=""><div class="award-list"><span>2012</span> Award Name</div></a>
          <a href=""><div class="award-list"><span>2012</span> Award Name</div></a>
        </ul>

      </div><!--.content-->
    </div><!--.container.main-->