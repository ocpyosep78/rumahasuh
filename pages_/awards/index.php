<?php
/* -- FUNCTIONS -- */

function count_awards(){
   $conn   = connDB();
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_service WHERE `visibility` = '1'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function get_awards(){
   $conn   = connDB();
   $sql    = "SELECT * FROM tbl_service  WHERE `visibility` = '1' ORDER BY `category_maps`";
   $query  = mysql_query($sql, $conn);
   $row    = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}



// CALL FUNCTIONS
$count  = count_awards();
$awards = get_awards();
?>

<!-- JQUERY BEGIN-->
<link rel="stylesheet" href="<?php echo $prefix_url;?>script/prettyphoto/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<script src="<?php echo $prefix_url;?>script/prettyphoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>


    <div class="container main">
      <div class="content">

        <div class="row">

          <?php include("static/navbar-2.php");?>

          <ul class="col-xs-10" style="margin-top: 10px">
            <h2 class="m_b_20 text-right">Awards</h2>
            
            
            <?php
            // PRETTYPHOTO
			echo '<ul class="gallery">';
			?>
            
            <?php
            foreach($awards as $awards){
			   
			   // PRETYPHOTO
			   echo '<li>';
			   
			   echo '<a href="'.$prefix_url.$awards['description'].'"  rel="prettyPhoto[gallery1]">
			   <div class="award-list"><span>'.$awards['category_maps'].'</span> '.$awards['career_name'].'</div></a>';
			   
			   echo '</li>';
			}
			?>
            
            <?php
            // PRETTYPHOTO
			echo '</ul>';
			?>
            
          </ul>

        </div><!--.row-->

      </div><!--.content-->
    </div><!--.container.main-->
    
    
    
<!-- JQUERY CALL -->                            
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
   $("area[rel^='prettyPhoto']").prettyPhoto();
   
   $(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'light_square',slideshow:3000, autoplay_slideshow: false});
   $(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
   
   $("#custom_content a[rel^='prettyPhoto']:first").prettyPhoto({
      custom_markup: '<div id="map_canvas" style="width:260px; height:265px"></div>',
	  changepicturecallback: function(){ initialize(); }
   });
   
   $("#custom_content a[rel^='prettyPhoto']:last").prettyPhoto({
      custom_markup: '<div id="bsap_1259344" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div><div id="bsap_1237859" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6" style="height:260px"></div><div id="bsap_1251710" class="bsarocks bsap_d49a0984d0f377271ccbf01a33f2b6d6"></div>',
      changepicturecallback: function(){ _bsap.exec(); }
   });
   
});
</script>                            
<!-- JQUERY END-->