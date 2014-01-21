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

      <?php include("static/navbar-2.php"); ?>

      <div class="col-xs-10 m_t_20 project-detail">

        <h2>Project Title</h2>
        <p class="sub">Wairebo, 2012</p>

      	<img src="<?php echo $prefix_url?>script/holder.js/100%x300" style="margin-bottom: 20px">

        <ul class="nav-project nav-tabs nav-justified" id="myTab">
          <li class="active"><a href="#progress" data-toggle="tab">PROGRESS</a></li>
          <li><a href="#history" data-toggle="tab">HISTORY</a></li>
          <li><a href="#donors" data-toggle="tab">DONORS</a></li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="progress">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              <br><br>
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
              <br>
            </p>
          </div>
          <div class="tab-pane" id="history">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              <br><br>
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
              <br>
            </p>
          </div>
          <div class="tab-pane" id="donors">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              <br><br>
              Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?
              <br>
            </p>
          </div>
        </div>

        <!--BLOG INDEX 1
        <div class="post row" style="margin-left: -10px; margin-right: -10px">
        <?php 
        //for($i=0;$i<1;$i++){
	       foreach($news as $news){
        ?>
          <a href="">
          <div class="col-xs-4" style="padding-left: 10px; padding-right: 10px">
            <img class="m_b_10" src="<?php echo $prefix_url.'admin/static/thimthumb.php?src=../'.$news['news_image'].'&h=300&w=100%&q=100';?>">
            <img src="<?php echo $prefix_url?>script/holder.js/100%x200" class="m_b_20">
            <h2><?php echo $news['news_title'];?></h2>
            <p class="timestamp">Wairebo, <?php echo date('j F Y',strtotime($news['news_date']));?></p>
            <p class="m_b_10"><?php echo substr(preg_replace("/\n/","\n<br>",$news['news_content']),0,300);?></p>
            <a class="read-more" href="<?php echo $prefix_url.cleanurl($news['category_name']).'/'.$news['news_alias'];?>">Read More</a>
          </div>
          </a>

        <?php
        }
        ?>
        </div>-->
      
     </div><!--.col-->

  </div><!--.content-->
</div><!--.container.main-->