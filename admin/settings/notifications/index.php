<?php
//include("get.php");
//include("update.php");
//include("control.php");
?>

<form method="post" autocomplete="off">
  
  <div class="subnav">
    <div class="container clearfix">
      <h1><span class="glyphicon glyphicon-comment"></span> &nbsp; Notifications</h1>
      <div class="btn-placeholder">
        <input type="button" class="btn btn-success btn-sm" value="Save Changes" name="btn-index-account" onclick="validationAdminAccount()">
        <input type="submit" class="btn btn-success btn-sm hidden" value="Save Changes" name="btn-index-account" id="id_btn_account">
        <input type="hidden" name="admin_id" value="<?php echo $accounts['id']?>">
      </div>
    </div>
  </div>

  <div class="container main">
            
		<?php
    if(!empty($_SESSION['alert'])){?>
      <div class="alert <?php echo $_SESSION['alert'];?>">
        <div class="container">
          <?php echo $_SESSION['msg'];?>
        </div>
      </div>
    <?php }?>

    <div class="box row">
      <div class="desc col-xs-3">
        <h3>Notification Details</h3>
        <p>Details on your admin panel notifications.</p>
      </div>
      <div class="content col-xs-9">
        <ul class="form-set">
          <li class="form-group row">
            <label class="control-label col-xs-3" for="">Order Email <span>*</span></label>
            <div class="col-xs-9">
              <input type="text" class="form-control" id="" name="" value="">
              <p class="help-block">Email to receive order notifications from customers.</p>
            </div>
          </li>
          <li class="form-group row">
            <label class="control-label col-xs-3" for="">Warehouse Email <span>*</span></label>
            <div class="col-xs-9">
              <input type="text" class="form-control" id="" name="" value="">
              <p class="help-block">Email to receive delivery order from admin.</p>
            </div>
          </li>
        </ul>
      </div>
    </div><!--.box-->

  </div><!--.container.main-->
            
</form>

<?php
if($_POST['btn-index-account'] == ""){
   unset($_SESSION['alert']);
   unset($_SESSION['msg']);
}
?>

<script src="<?php echo $prefix_url;?>script/admin_account.js"></script>
            