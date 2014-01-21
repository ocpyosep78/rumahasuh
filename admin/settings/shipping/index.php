<?php
include("get.php");
include("update.php");
include("control.php");
?>

<form method="post">
   
   
  <div class="subnav">
    <div class="container clearfix">
      <h1><span class="glyphicon glyphicon-road"></span> &nbsp; Shipping Methods</h1>
      <div class="btn-placeholder">
        <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/add-shipping"?>">
          <input type="button" class="btn btn-success btn-sm" value="Add Shipping Method">
        </a>
      </div>         
    </div>
  </div>

  <div class="container main">

    <?php
    if(!empty($_SESSION['alert'])){
    ?>
      <div class="alert <?php echo $_SESSION['alert'];?>">
        <div class="container">
          <?php echo $_SESSION['msg'];?>
        </div>
      </div>
    <?php
    }
    ?>

    <div class="box row">
      <div class="content">

        <div class="actions clearfix">
          <div class="pull-left">
            <div class="pull-left custom-select-all" onclick="selectAllToggle()">
              <input type="checkbox" id="select_all">
            </div>
            <div class="divider"></div>
            <p>Page</p>
            <select class="form-control" id="page-option" onchange="pageOption()">
              <?php
                for($i=1;$i<=$total_page;$i++){
                echo "<option value=\"".$i."\">".$i."</option> \n";
              }
              ?>
            </select>
            <p>of <strong><?php echo $total_page;?></strong> pages</p>
            <div class="divider"></div>
            <p>Show</p>
            <select class="form-control" name="query_per_page" id="query_per_page_input" onchange="changeQueryPerPage()">
              <option value="25"<?php if($query_per_page =="25"){ echo "selected=\"selected\"";}?>>25</option>
              <option value="50" <?php if($query_per_page == "50"){ echo "selected=\"selected\"";}?>>50</option>
              <option value="100" <?php if($query_per_page == "100"){ echo "selected=\"selected\"";}?>>100</option>
            </select>
            <p>of <strong><?php echo $total_query;?></strong> records</p>
          </div>
          <div class="pull-right">
            <p>Actions</p>
            <select class="form-control" name="ship-action"> 
              <option value="delete">Delete</option>
            </select>
            <div class="hidden">
              <p>to</p>
              <select class="form-control" name="ship-option">
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
            <input type="submit" class="btn btn-success pull-left" name="btn-product-index" value="GO">
          </div>
        </div><!--actions-->

        <table class="table">
          <thead>
            <tr class="headings">
              <th width="20"><span id="eyeopen" class="glyphicon glyphicon-eye-open" onclick="showEye()"></span></th>
              <th class="sort" width="170" onclick="sortBy('courier_name')">Courier Name<?php echo $arr_courier_name;?></th>
              <th class="sort" width="330" onclick="sortBy('courier_description')">Description<?php echo $arr_courier_description;?></th>
              <th class="sort" width="250" onclick="sortBy('services')">Services<?php echo $arr_service;?></th>
              <th class="sort" width="190" onclick="sortBy('active_status')">Price<?php echo $arr_active_status;?></th>
            </tr>
            <tr class="filter">
              <th>
               <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/shipping"?>" title="Reset">
                 <button class="btn btn-danger btn-xs <?php echo $reset;?>"><span class="glyphicon glyphicon-remove"></span></button>
               </a></th>
              <th><input type="text" class="form-control" id="courier_name_search" onkeyup="searchQuery('courier_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "courier_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
              <th><input type="text" class="form-control" id="courier_description_search" onkeyup="searchQuery('courier_description')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "courier_description"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
              <th>
                <select class="form-control" id="services_search" onchange="searchQueryOption('services')" <?php if($_REQUEST['src'] == "services"){ echo "value=\"".$_REQUEST['srcval']."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled=\"disabled\"";}?>>
                  <option value="0"></option>
                  <option value="Local Only">Local only</option>
                  <option value="International Only">International only</option>
                  <option value="Local-International">Local &amp; International</option>
                </select>
              </th>
              <th>
                <select class="form-control" id="active_status_search" onchange="searchQueryOption('active_status')" <?php if($_REQUEST['src'] == "active_status"){ echo "value=\"".$_REQUEST['srcval']."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled=\"disabled\"";}?>>
                  <option value="0"></option>
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </th>
            </tr>
          </thead>

          <tbody>
            <?php if($total_query < 1){?><tr><td class="no-record" colspan="8">No records found.</td></tr><?php }?>
            
            <?php 
            $row = 0;
            foreach($listing_order as $shipping){
               $row++;
            ?>

            <tr id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
              <td><input type="checkbox" name="courier_id[]" id="<?php echo "check_".$row?>" value="<?php echo $shipping['courier_id'];?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')"></td>
              <td><a href="<?php echo $prefix."shipping/".$shipping['courier_id'];?>"><?php echo $shipping['courier_name'];?></a></td>
              <td><?php echo $shipping['courier_description'];?></td>
              <td><?php echo $shipping['services'];?></td>
              <td><?php echo $shipping['active_status'];?></td>
            </tr>
            <?php }?>
            <!--
            <tr class="selected">
                <td><input type="checkbox"></td>
                <td><a href="<?php echo $prefix;?>products/details">JNE (Express)</a></td>
                <td>Express Shipping (up to 2 days)</td>
                <td>Local &amp; International</td>
                <td>Active</td>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td><a href="<?php echo $prefix;?>products/details">RPX</a></td>
                <td>Regular Shipping (up to 5 days)</td>
                <td>International only</td>
                <td>Active</td>
            </tr>
            -->
          </tbody>
        </table>

      </div><!--.content-->
    </div><!--.box.row-->

  </div><!--.container.main-->
            
</form>

                <!--<div class="table-wrapper">
                    <table cellpadding="0" cellspacing="0" class="actions">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="fl">
                                    
                                       <div class="custom-select-all" onclick="selectAllToggle()">
                                          <input type="checkbox" id="select_all">
                                       </div>
                                       
                                        <div class="divider"></div>
                                        <div class="page">
                                            <p>Page</p>
                                            <select class="form-control" id="page-option" onchange="pageOption()">
                                               
                                               <?php
                                               for($i=1;$i<=$total_page;$i++){
											      echo "<option value=\"".$i."\">".$i."</option> \n";
											   }
											   ?>
                                               
                                            </select>
                                            <p>of <strong><?php echo $total_page;?></strong> pages</p>
                                        </div>
                                        <div class="divider" style="margin-left: 10px"></div>
                                        <div class="page">
                                            <p>Show</p>
                                            <select class="form-control" name="query_per_page" id="query_per_page_input" onchange="changeQueryPerPage()">
                                                <option value="25"<?php if($query_per_page =="25"){ echo "selected=\"selected\"";}?>>25</option>
                                                <option value="50" <?php if($query_per_page == "50"){ echo "selected=\"selected\"";}?>>50</option>
                                                <option value="100" <?php if($query_per_page == "100"){ echo "selected=\"selected\"";}?>>100</option>
                                            </select>
                                            <p>of <strong><?php echo $total_query;?></strong> records</p>
                                        </div>
                                    </div>
                                    <div class="fr">
                                        <p>Actions</p>
                                        <select class="form-control" name="ship-action">
                                            <option value="delete">Delete</option>
                                        </select>
                                        
                                        <div class="hidden">
                                        <p>to</p>
                                        <select class="form-control" name="ship-option">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        </div>
                                        
                                        <input type="submit" class="btn green main go" value="GO" name="btn-index-shipping">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0">
                        <thead>
                            <tr class="headings">
                                <th width="20"></th>
                                <th class="sort" width="170" onclick="sortBy('courier_name')">Courier Name<?php echo $arr_courier_name;?></th>
                                <th class="sort" width="330" onclick="sortBy('courier_description')">Description<?php echo $arr_courier_description;?></th>
                                <th class="sort" width="250" onclick="sortBy('services')">Services<?php echo $arr_service;?></th>
                                <th class="sort" width="190" onclick="sortBy('active_status')">Price<?php echo $arr_active_status;?></th>
                            </tr>
                            <tr class="filter">
                                <th>
                                   <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/shipping"?>" title="Reset">
                                     <input type="button" class="btn small reset <?php echo $reset;?>" value="">
                                   </a></th>
                                <th><input type="text" class="form-control" id="courier_name_search" onkeyup="searchQuery('courier_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "courier_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                                <th><input type="text" class="form-control" id="courier_description_search" onkeyup="searchQuery('courier_description')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "courier_description"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                                <th>
                                    <select class="form-control" id="services_search" onchange="searchQueryOption('services')" <?php if($_REQUEST['src'] == "services"){ echo "value=\"".$_REQUEST['srcval']."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled=\"disabled\"";}?>>
                                        <option value="0"></option>
                                        <option value="Local Only">Local only</option>
                                        <option value="International Only">International only</option>
                                        <option value="Local-International">Local &amp; International</option>
                                    </select>
                                </th>
                                <th>
                                    <select class="form-control" id="active_status_search" onchange="searchQueryOption('active_status')" <?php if($_REQUEST['src'] == "active_status"){ echo "value=\"".$_REQUEST['srcval']."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled=\"disabled\"";}?>>
                                        <option value="0"></option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody onload="loading()">
                            
                            <?php if($total_query < 1){?><tr><td class="no-record" colspan="8">No records found.</td></tr><?php }?>
                            
                            <?php 
							$row = 0;
							foreach($listing_order as $shipping){
							   $row++;
							?>
                            <tr id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                                <td><input type="checkbox" name="courier_id[]" id="<?php echo "check_".$row?>" value="<?php echo $shipping['courier_id'];?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')"></td>
                                <td><a href="<?php echo $prefix."shipping/".$shipping['courier_id'];?>"><?php echo $shipping['courier_name'];?></a></td>
                                <td><?php echo $shipping['courier_description'];?></td>
                                <td><?php echo $shipping['services'];?></td>
                                <td><?php echo $shipping['active_status'];?></td>
                            </tr>
                            <?php }?>
                            <tr class="selected">
                                <td><input type="checkbox"></td>
                                <td><a href="<?php echo $prefix;?>products/details">JNE (Express)</a></td>
                                <td>Express Shipping (up to 2 days)</td>
                                <td>Local &amp; International</td>
                                <td>Active</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><a href="<?php echo $prefix;?>products/details">RPX</a></td>
                                <td>Regular Shipping (up to 5 days)</td>
                                <td>International only</td>
                                <td>Active</td>
                            </tr>
                        </tbody>
                    </table>
                </div>-->

<?php echo $search_parameter;?>
<script>
<?php if($search_parameter == "services"){?>
$('#services_search option[value="<?php echo $search_value?>"]').attr('selected', 'selected');
<?php }?>


<?php if($search_parameter == "active_status"){?>
$('#active_status_search option[value=="<?php echo $search_value?>"]').attr('selected', 'selected');
<?php }?>
</script>

<?php 
if($_POST['btn-index-shipping'] == ""){
   $_SESSION['alert'] = "";
   $_SESSION['msg']   = "";
}
?>

            