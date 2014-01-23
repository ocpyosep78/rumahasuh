<?php
/* -- FUNCTIONS -- */

function count_project(){
   $conn   = connDB();
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_inspiration WHERE `inspiration_visibility` = '1'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function get_project(){
   $conn   = connDB();
   $sql    = "SELECT * FROM tbl_inspiration AS main_ LEFT JOIN tbl_inspiration_image AS img_ ON main_.inspiration_id = img_.param_inspiration_id WHERE `inspiration_visibility` = '1'";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


/*
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
*/


/* -- DEFINED VARIABLE -- */

// REQUEST
/*
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
*/



/* -- PAGINATION -- */
/*
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
*/



// CALL FUNCTIONS
//$news          = get_news($category, $operator, $src_val, $start_record, $query_per_page);
//$news_category = get_category();

$check_projects = count_project();
$projects       = get_project();
?>

    <div class="container main">
      <div class="content">


        
        <div class="row blog">

          <?php include("static/navbar-2.php");?>
  
          <div class="col-xs-10 m_t_20">

            <!--<img src="<?php echo $prefix_url?>script/holder.js/100%x300" style="margin-bottom: 20px">-->
            <!--<ul class="upper-line">Sort by
              <li><a href="">Latest</a></li>
              <li><a href="">Location</a></li>
              <li><a href="">Type</a></li>
            </ul>-->

            <!--BLOG INDEX 1-->
            <div class="post row" style="margin-left: -10px; margin-right: -10px">
            <?php 
			foreach($projects as $projects){
            ?>
            
              <a href="<?php echo $prefix_url.'project-detail/'.cleanurl($projects['name']).'/'.$projects['inspiration_id'];?>">
              <div class="col-xs-4" style="padding-left: 10px; padding-right: 10px">
                <img class="m_b_10" src="<?php echo $prefix_url.'admin/static/thimthumb.php?src=../'.$projects['image'].'&h=100&w=300%&q=100';?>">
                <!--<img src="<?php echo $prefix_url?>script/holder.js/100%x200" class="m_b_20">-->
                <h2><?php echo $news['news_title'];?></h2>
                <p class="timestamp"><?php echo $projects['place'];?>, <?php echo date('j F Y',strtotime($projects['date_created']));?></p>
                <!--<p class="m_b_10"><?php echo substr(preg_replace("/\n/","\n<br>",$news['news_content']),0,300);?></p>
                <a class="read-more" href="<?php echo $prefix_url.cleanurl($news['category_name']).'/'.$news['news_alias'];?>">Read More</a>-->
              </div>
              </a>

            <?php
            }
            ?>
            </div>

            <div class="under-line"></div>
          
            <?php
            // PAGINATION
			
			/*
			echo "Total Record: ".$total_record."<br>";
			echo "Query Per Page: ".$query_per_page.'<br>';
			echo "Category: ".$src_val.'<br>';
			echo "Page: ".$page.'<br>';
			*/
			
			view_pagination($total_record, $query_per_page, $paging_cat, $page);
			?>

          </div><!--.col-->

          <!--BLOG CATEGORY-->
          <!--<div class="col-xs-2">
            <div class="category p_l_15">
              <p>Categories</p>
              <ul>
                <?php
				foreach($news_category as $news_category){
				   echo '<li><a href="'.$prefix_url.'blog-view/'.$news_category['category_id'].'/all">'.$news_category['category_name'].'</a></li>';
				}
				?>
              </ul>
            </div>
          </div>

        </div>-->


      </div><!--.content-->
    </div><!--.container.main-->