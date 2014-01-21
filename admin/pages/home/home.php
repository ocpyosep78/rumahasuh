<?php
include("control.php");
include("custom/pages/home/control.php")

//$id = $_POST['slideshow_id'];
?>

<form method="post" enctype="multipart/form-data">

  <div class="modal fade" id="link-pops" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header clearfix">
          <div class="pull-right">
            <input type="hidden" name="link_id" id="link-id">
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
            <input type="submit" class="btn btn-success btn-sm" value="Save Changes" name="btn-link-banner">
          </div>
          <h4 class="modal-title pull-left" style="font-weight: 200">Image Link</h4>
        </div>
        <div class="modal-body">
          <div class="content">
            <ul class="form-set">
              <li class="form-group row">
                <label class="col-xs-3 control-label">Link</label>
                <div class="col-xs-9">
                  <input type="text" class="form-control" id="name-link" name="name_link">
                  <p class="help-block">Paste your link here.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--<div class="" id="link-pops">
    <div class="overlay over-link">
      <div class="header">
        <h2>Image Link</h2> 
        <div class="btn-placeholder">
          <input type="hidden" name="link_id" id="link-id">
          <input type="button" class="btn grey main" value="Cancel" onclick="closeLink()">
          <input type="submit" class="btn red main" value="Delete" name="btn-link-banner">
          <input type="submit" class="btn green main" value="Save Changes" name="btn-link-banner">
        </div>
      </div>
      <div class="content">
        <div class="field-set">
          <div class="form-group row">
              <label class="col-xs-3 control-label">Link</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" id="name-link" name="name_link">
              </div>
              <p class="help-block">Paste your link here.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="overlay_bg70" onclick="closeLink()"></div>
  </div>-->
</form>

<form method="post" enctype="multipart/form-data">

    <div class="subnav">
      <div class="container clearfix">
        <h1><span class="glyphicon glyphicon-home"></span> &nbsp; Home</h1>
        <div class="btn-placeholder">
          <input type="submit" class="btn btn-success btn-sm" value="Save Changes" name="btn-pages-home">
        </div>
      </div>
    </div>

    <?php
    /* -- ALERT -- */
    if(!empty($_SESSION['alert'])){
    echo "<div class=\"alert ".$_SESSION['alert']."\">";
    echo "<div class=\"container\">".$_SESSION['msg']."</div>";
    echo "</div>";
    }
    ?>

    <div class="container main">

      <div class="box row">
        <div class="desc col-xs-3">
          <h3>Banners</h3>
          <p>Edit home page banners.</p>
        </div>
        <div class="content col-xs-9">
          <ul class="field-set">
            <li class="form-group row image-placeholder">
              <label class="control-label col-xs-3">Main Banners</label>
              <div class="col-xs-9">
                <div class="row">
                      
                  <style>
				  #slide-1 { position:relative; z-index:90;}
				  #slide-2 { position:relative; z-index:90;}
				  #slide-3 { position:relative; z-index:90;}
				  #slide-4 { position:relative; z-index:90;}
				  #slide-5 { position:relative; z-index:90;}
				  #slide-6 { position:relative; z-index:90;}
				  
				  #sortable { list-style-type: none;}
				  #sortable li { float: left; width: 198px; height: 105px;}
				  </style>
                  
				  <script>
				  $(function() {
				     $("#sortable").sortable();
					 $("#sortable").disableSelection();
				  });
				  </script>
                  
                  <ul id="sortable">
                  <?php
				  function slideshow_get(){
				     $conn   = connDB();
					 
					 $sql    = "SELECT * FROM tbl_slideshow ORDER BY `order_` ASC";
					 $query  = mysql_query($sql, $conn);
					 $row    = array();
					 
					 while($result = mysql_fetch_array($query)){
					    array_push($row, $result);
					 }
					 
					 return $row;
				  }
				  
				  $slideshow_get = slideshow_get();
				  $row = 1;
				  foreach($slideshow_get as $slider){
				  
				  // FOR DRAGABLE SORTING
				  echo "<li> \n";
				  ?>
                  
                  <!-- NEED STYLING "col-xs-4 image" ga actual drag-nya kalo ga "#sortable li { float: left; width: 198px; height: 105px;}" -->                    
                  
                  <div class="col-xs-4 image" onMouseOver="removeButton('<?php echo $slider['id'];?>')" id="slide-<?php echo $slider['id'];?>">
                    <div class="content img-about-size">
                      <div class="" id="remove-slider-<?php echo $slider['id'];?>">
                         <div class="image-delete" id="btn-slider-<?php echo $slider['id'];?>" onClick="clearImage('<?php echo $slider['id'];?>')"><span class="glyphicon glyphicon-remove"></span></div>
                         <div class="image-link <?php if(!empty($slider['link'])){ echo "linked";}?>" data-toggle="modal" href="#link-pops" onclick="showLink('<?php echo $slider['id'];?>')" id="btn-link-<?php echo $slider['id'];?>"></div>
                         <div class="image-overlay" onClick="openBrowser('<?php echo $slider['id'];?>')"></div>
                         <input type="hidden" name="link_slide_<?php echo $slider['id'];?>" id="link-slide-<?php echo $slider['id'];?>">
                      </div>
                      <img class="" id="upload-slider-<?php echo $slider['id'];?>" src="<?php echo $prefix_url."static/thimthumb.php?src=../".$get_slideshow['filename']."&h=105&w=198&q=100";?>">
                      <input type="file" name="upload_slider_<?php echo $slider['id'];?>" id="slider-<?php echo $slider['id'];?>" onchange="readURL(this,'<?php echo $slider['id'];?>')" class="hidden"/>
                      <input type="checkbox" name="slideshow_id[]" class="hidden"  value="<?php echo $slider['id'];?>" id="id_slideshow_<?php echo $slider['id'];?>">
                      <input type="hidden" name="flag_<?php echo $slider['id'];?>" id="slideshow-flag-<?php echo $slider['id'];?>" value="<?php echo $slider['filename'];?>">
                      <input type="hidden" name="link_<?php echo $slider['id'];?>" id="link-<?php echo $slider['id'];?>" value="<?php echo $slider['link'];?>">
                    </div>
                  </div>
                  
                  <?php
				     // FOR DRAGABLE SORTING
				     echo "</li> \n \n";
				  }
				  ?>
                                      
                  

                </div><!--row-->
                <p class="help-block">Recommended dimensions of 960 x 500 px.</p>
              </div><!--col-xs-9-->
              
              <?php include("script/slideshow-js.php");?>
            
            </li><!--form-group-->
          
            <?php 
            /* -- PROMO BANNER --*/
            //include("sources/md_promo_banner/index.php");
            ?>

          </ul><!--field-set-->
        
        </div><!--content-->
      
      </div><!--box-->
                
      <?php 
			/* -- PROMO BANNER --*/
			//include("sources/md_promo_banner/script.php");
			?>

  </div><!--container main-->
            
</form>

<?php
/* -- RESET ALERT -- */
if($_POST['btn-pages-home'] == ""){
   unset($_SESSION['alert']);
   unset($_SESSION['msg']);
}
?>

<?php include("custom/pages/home/index.php");?>             