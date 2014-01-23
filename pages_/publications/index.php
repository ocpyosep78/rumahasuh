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

        <div class="row">

          <?php include("static/navbar-2.php");?>

          <div class="col-xs-10 m_t_10">
            <h2 class="m_b_20">Contact</h2>
            <form role="form">
              <div class="form-group row">
                <label class="col-xs-3">Name</label>
                <div class="col-xs-9">
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-xs-3">Email</label>
                <div class="col-xs-9">
                  <input type="email" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-xs-3">Subject</label>
                <div class="col-xs-9">
                  <input type="text" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-xs-3">Message</label>
                <div class="col-xs-9">
                  <textarea class="form-control" rows="5"></textarea>
                </div>
              </div>
              <input type="submit" class="btn btn-default pull-right " value="Submit">
            </form>
          </div>
        </div><!--.row-->

      </div><!--.content-->
    </div><!--.container.main-->