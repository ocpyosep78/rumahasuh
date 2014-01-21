<form method="post" enctype="multipart/form-data">

    <div class="subnav">
      <div class="container clearfix">
        <h1><span class="glyphicon glyphicon-tint"></span> &nbsp; <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/color"?>">Color Groups</a> <span class="info">/</span> Add Color</h1>
        <div class="btn-placeholder">
          <input type="hidden" name="cat_id" id="category_id"/>
          <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/color";?>"><input type="button" class="btn btn-default btn-sm" value="Cancel"></a>
          <input type="submit" class="btn btn-success btn-sm" value="Save Changes" name="btn-index-color" id="btn-save">
        </div>
      </div>
    </div>

        <?php
        if(!empty($_SESSION['alert'])){?>
        <div class="alert <?php echo $_SESSION['alert'];?>">
          <div class="container"><?php echo $_SESSION['msg'];?></div>
        </div>
        <?php }?>

    <div class="container main">

      <div class="box row">
        <div class="desc col-xs-3">
          <h3>Color Details</h3>
          <p>Your color details.</p>
        </div>
        <div class="content col-xs-9">
          <ul class="form-set">
            <li class="form-group row">
              <label class="control-label col-xs-3">Change Status</label>
              <div class="col-xs-9">
                <label class="radio-inline">
                  <input type="radio" value="active" id="color-active-status" name="active_status" checked="checked">
                  Active
                </label>
                <label class="radio-inline">
                  <input type="radio" value="inactive" id="color-inactive-status" name="active_status">
                  Inactive
                </label>
              </div>
            </li>
            <li class="form-group row">
              <label class="control-label col-xs-3">Visibility</label>
              <div class="col-xs-9">
                <label class="radio-inline">
                  <input type="radio" value="yes" id="color-visible-status" name="visibility_status" checked="checked">
                  Yes
                </label>
                <label class="radio-inline">
                  <input type="radio" value="no" id="color-invisible-status" name="visibility_status">
                  No
                </label>
              </div>
            </li>
            <li class="form-group row">
              <label class="control-label col-xs-3">Color Thumbnail</label>
              <div class="col-xs-9">
                <div class="color-thumb edit" id="picture" onclick="openBrowser()">
                   <img id="upload-image" src="" width="25px">
                </div>
                <p class="help-block">Recommended dimensions of 24 x 24 px.</p>
                <input type="file" name="color_image" id="color" onchange="readURL(this,'1')" class="hidden"/>
              </div>
            </li>
            <li class="form-group row">
              <label class="control-label col-xs-3">Color Name</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" id="color-name" name="color_name">
              </div>
            </li>
          </ul>
        </div>
      </div><!--.box-->

    </div><!--.container.main-->

</form>