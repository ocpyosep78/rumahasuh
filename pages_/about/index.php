<?php
/* -- FUNCTIONS -- */

function count_about(){
   $conn   = connDB();
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_about WHERE `type` = 'about'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function get_about(){
   $conn   = connDB();
   $sql    = "SELECT * FROM tbl_about WHERE `type` = 'about'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function count_banner(){
   $conn   = connDB();
   $sql    = "SELECT COUNT(*) AS rows FROM tbl_about WHERE `type` = 'facilities'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}


function get_banner(){
   $conn   = connDB();
   $sql    = "SELECT * FROM tbl_about WHERE `type` = 'facilities'";
   $query  = mysql_query($sql, $conn);
   $result = mysql_fetch_array($query);
   
   return $result;
}



// CALL FUNCTIONS
$count = count_about();
$about = get_about();

$count_banner = count_banner();
$banner       = get_banner();
?>

<style>
.ct-main-img-page img{ width:945px; margin-bottom:20px;}
.ct-content-page img{ max-width:945px;}
</style>

    <div class="container main">
      <div class="content">

        <div class="row">

          <?php include("static/navbar-2.php");?>

          <div class="col-xs-10 m_t_10">

            <!--<h2 class="m_b_20 text-right">About Rumah Asuh</h2>
            <img src="<?php echo $prefix_url;?>script/holder.js/100%x300" style="margin-bottom: 20px">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>-->
            <h2 class="m_b_20">About Rumah Asuh</h2>
            
            <?php
            preg_match_all('/<img[^>]+>/i',$banner['fill'], $result); 
			
      			foreach ($result as $result_img) {
      						     
      			   if(!empty($result_img[0])) {
      			      $img = explode("style",$result_img[0]);
      				  echo '<div class="ct-main-img-page">';
      				  echo $img['0'];
      				  echo '</div>';
      			   }
						  
      			}
      			?>
            
            <!--<img src="<?php echo $prefix_url;?>script/holder.js/100%x300" style="margin-bottom: 20px">-->
            <div class="ct-content-page"><?php echo $about['fill'];?></div>

          </div>
        </div><!--.row-->

      </div><!--.content-->
    </div><!--.container.main-->