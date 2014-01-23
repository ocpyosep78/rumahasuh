<?php
/* -- FUNCTIONS -- */

function count_project($post_inspiration_id){
   $conn   = connDB();
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_inspiration WHERE `inspiration_id` = '$post_inspiration_id' AND `inspiration_visibility` = '1'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function get_project($post_inspiration_id){
   $conn   = connDB();
   $sql    = "SELECT * FROM tbl_inspiration AS main_ LEFT JOIN tbl_inspiration_image AS img_ ON main_.inspiration_id = img_.param_inspiration_id 
              WHERE `inspiration_id` = '$post_inspiration_id' AND `inspiration_visibility` = '1'
			 ";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


/* -- DEFINED VARIABLE -- */

// REQUEST
$pro_id = $_REQUEST['pro_id'];

/*
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
$count   = count_project($pro_id);
$project = get_project($pro_id);
?>


<div class="container main">
  <div class="content">

    <div class="row">

      <?php include("static/navbar-2.php"); ?>

      <div class="col-xs-10 m_t_20 project-detail">

        <h2><?php echo $project['name'];?></h2>
        <p class="sub"><?php echo $project['place'];?>, <?php echo date('Y',strtotime($project['date_created']));?></p>

      	<img src="<?php echo $prefix_img.$project['image'].'&h=300&w=945&q=100';?>" style="margin-bottom: 20px">
        
        <!--945 x 300-->

        <ul class="nav-project nav-tabs nav-justified" id="myTab">
          <li class="active"><a href="#progress" data-toggle="tab">PROGRESS</a></li>
          <li><a href="#history" data-toggle="tab">HISTORY</a></li>
          <li><a href="#donors" data-toggle="tab">DONORS</a></li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="progress">
            <p><?php echo $project['description'];?></p>
          </div>
          <div class="tab-pane" id="history">
            <p><?php echo $project['history'];?></p>
          </div>
          <div class="tab-pane" id="donors">
            <p><?php echo $project['donor'];?></p>
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