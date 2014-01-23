<?php
/* -- FUNCTIONS -- */

function count_news($post_news_id){
   $conn   = connDB();
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_news WHERE `news_id` = '$post_news_id'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function get_news($post_news_id){
   $conn   = connDB();
   $sql    = "SELECT * FROM tbl_news WHERE `news_id` = '$post_news_id'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


/* -- DEFINED VARIABLE -- */

// REQUEST
$req_news_id = $_REQUEST['news_id'];



// CALL FUNCTIONS
$check_news    = count_news($req_news_id);
$news          = get_news($req_news_id);
?>


<div class="container main">
  <div class="content">

    <div class="row">

      <?php include("static/navbar-2.php"); ?>

      <div class="col-xs-10 m_t_20 project-detail">

        <h2><?php echo $news['news_title'];?></h2>
        <p class="sub"><?php echo date('d F Y',strtotime($news['news_date']))?></p>

        <div>
            <p><?php echo $news['news_content'];?></p>
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