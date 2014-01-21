<?php
include("get.php");
include("update.php");
include("control.php");
include("ajax.php");

$max_size_type_id = get_latest_id();
$size_type_id     = $max_size_type_id['size_type_id'];
?>

<form method="post" enctype="multipart/form-data">

        <!--<div class="" id="pop-size">
            <div class="overlay over-size">
                <div class="header">
                    <h2 id="pop-title"></h2> 
                    <div class="btn-placeholder">
                        <input type="hidden" name="edit_size_type_id" id="edit-size-type-id">
                    
                        <input type="button" class="btn grey main" value="Cancel" id="btn-pop-cancel" onclick="closePop()">
                        <input type="submit" class="btn red main" value="Delete" id="btn-pop-delete" name="btn-size-index">
                        <input type="submit" class="btn green main" value="Save Changes" name="btn-size-index">
                    </div>
                </div>
                <div class="content">
                    <ul class="field-set">
                        <li class="hidden field">
+                           <label>Change status</label>
                            <input type="radio" class="input-radio" value="Active" id="size-active" name="size_active" />&nbsp; Active
                            <input type="radio" class="input-radio" value="Inactive" id="size-inactive" name="size_active"/>&nbsp; Inactive
                        </li>
                        <li class="hidden field">
                            <label>Visibility</label>
                            <input type="radio" class="input-radio" value="Yes" id="size-visible" name="size_visibility" />&nbsp; Yes
                            <input type="radio" class="input-radio" value="No" id="size-invisible" name="size_visibility" />&nbsp; No
                        </li>
                        <li class="field clearfix">
                            <label>Size group name</label>
                            <input type="text" class="form-control" value="" placeholder="" id="edit-size-type-name" name="size_type_name">
                            <p class="field-message">Separate by comma.</p>
                        </li>
                        <li class="field clearfix">
                            <label>Size name</label>
                            <input type="text" class="form-control" value="" placeholder="XS, S, M, etc." id="edit-size-group-name" name="size_group_name">
                            <p class="help-block">Separate by comma.</p>
                        </li>
                        <li class="field clearfix">
                            <label>Size SKU</label>
                            <input type="text" class="form-control" value="" placeholder="01, 02, 03, etc." id="edit-size-sku" name="size_sku">
                            <p class="help-block">Size SKU adds another code behind your original product SKU. For example, if you put 01 as the size SKU for XS, product with SKU ANT01BLK will be saved as ANT01BLK01.</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="overlay_bg70" id="overlay-bg-70" onclick="closePop()"></div>
        </div>-->
        

            <div class="subnav">
              <div class="container main">
                <h1><span class="glyphicon glyphicon-pushpin"></span> &nbsp; Size Groups</h1>
                <div class="btn-placeholder">
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/add-size"?>"><input type="button" class="btn btn-success btn-sm" value="Add Size Group"></a>
                </div>
              </div>
            </div>

            <?php if(!empty($_SESSION['alert'])){?>
              <div class="alert <?php echo $_SESSION['alert'];?>">
                  <div class="container"><?php echo $_SESSION['msg'];?></div>
              </div>
              <?php }?>

            <div class="container main">

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
                           for($i=0;$i<=$total_page;$i++){
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
                      <select class="form-control" name="size-action"> 
                        <option value="delete">Delete</option>
                      </select>
                      <p>to</p>
                      <select class="form-control" name="size-option">
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                      </select>
                      <input type="submit" class="btn btn-success pull-left" value="GO" name="btn-size-index">
                    </div>
                  </div><!--actions-->

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
                        												   for($i=0;$i<=$total_page;$i++){
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
                                        <select class="form-control" name="size-action">
                                            <option value="delete">Delete</option>
                                        </select>
                                        
                                        <div class="hidden">
                                        <p>to</p>
                                        <select class="form-control" name="size-option">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        </div>
                                        
                                        <input type="submit" class="btn green main go" value="GO" name="btn-size-index">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>-->
                    <table class="table">
                        <thead>
                            <tr class="headings">
                                <th width="20"><span id="eyeopen" class="glyphicon glyphicon-eye-open" onclick="showEye()"></span></th>
                                <th class="sort" width="35%" onclick="sortBy('size_type_name')">Size Group Name <?php echo $arr_size_group_name;?></th>
                                <th class="sort" width="50%" onclick="sortBy('size_name')">Content <?php echo $arr_size_name;?></th>
                                <th class="sort" width="10%"  onclick="sortBy('total_product')">Products <?php echo $arr_total_product;?></th>
                                <!--<th class="sort" width="130" onclick="sortBy('active_status')">Status <?php echo $arr_active_status;?></th>-->
                                <th class="sort" width="5%"  onclick="sortBy('visibility_status')">Visibility <?php echo $arr_visibility_status;?></th>
                            </tr>
                            <tr class="filter hidden" id="filter">
                                <th><a href="<?php echo $prefix_url."size";?>"><button type="button" style="width: 100%;" class="btn btn-danger btn-xs <?php echo $reset;?>"><span class="glyphicon glyphicon-remove"></span></button></a></th>
                                <th><input type="text" class="form-control" id="size_type_name_search" onkeyup="searchQuery('size_type_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "size_type_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                                <th><input type="text" class="form-control" id="size_name_search" onkeyup="searchQueryExact('size_name')" onkeypress="return disableEnterKey(event)" disabled="disabled"></th>
                                <th><input type="text" class="form-control" id="total_product_search" onkeyup="searchQueryExact('total_product')" onkeypress="return disableEnterKey(event)" disabled="disabled"></th>
                                <!--<th>
                                    <select class="form-control" id="size_type_active_search" onchange="searchQueryOption('size_type_active')" <?php if($_REQUEST['src'] != "size_type_active" and !empty($_REQUEST['src'])){ echo "disabled";}?>>
                                        <option></option>
                                        <option value="Active" <?php if($search == "size_type_active= 'Active'" ){ echo 'selected="selected"';}?>>Active</option>
                                        <option value="Inactive" <?php if($search == "size_type_active= 'Inactive'" ){ echo 'selected="selected"';}?>>Inactive</option>
                                    </select>
                                </th>-->
                                <th>
                                    <select class="form-control" id="size_type_visibility_search" onchange="searchQueryOption('size_type_visibility')" <?php if($_REQUEST['src'] != "size_type_visibility" and !empty($_REQUEST['src'])){ echo "disabled";}?>>
                                        <option></option>
                                        <option value="Yes" <?php if($search == "size_type_visibility= 'Yes'" ){ echo 'selected="selected"';}?>>Yes</option>
                                        <option value="No" <?php if($search == "size_type_visibility= 'No'" ){ echo 'selected="selected"';}?>>No</option>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="checkbox">
                            <?php if($total_query < 1){?><tr><td class="no-record" colspan="8">No records found.</td></tr><?php }?>
                            
                            <?php
							$row = 0;
                            foreach($listing_order as $list_size){
							   $row++;
							   $size_array = array();
							   $size_array = $list_size['size_name'];
							   $total_product = checkDelete($list_size['size_type_id']);
							   $related_product = totalSize($list_size['size_type_id']);
							   
							?>
                            
                            <tr id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                            
                                <input type="hidden" name="size_sku_list" value="<?php echo $list_size['size_sku'];?>" id="get_size_sku_<?php echo $row;?>">
                            
                                <td id="get_size_type_id"><input type="checkbox" name="size_type_id[]" id="<?php echo "check_".$row?>" value="<?php echo $list_size['size_type_id'];?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')"></td>
                                <td id="get_size_type_name_<?php echo $row;?>"><a href="#" onclick="popEdit('<?php echo $row?>')"><?php echo $list_size['size_group_name'];?></a></td>
                                <td id="get_size_name_<?php echo $row;?>"><?php echo $list_size['size_name'];?></td>
                                <td class="text-right"><a href="<?php echo $prefix_url."product-view/1/top/25/product_name/product_size_type_id-".$list_size['size_type_id'];?>"><?php echo $related_product['total_product'];?></a></td>
                                <!--<td id="get_active_status_<?php echo $row;?>"><?php echo $list_size['active_status'];?></td>-->
                                <td id="get_visibility_status_<?php echo $row;?>"><?php echo $list_size['visibility_status'];?></td>
                            </tr>
                            
                            <?php }?>
                        </tbody>
                    </table>

                  </div><!--.content-->
                </div><!--.box.row-->

            </div><!--.container.main-->
            
            
            
<script>
$("#page-option option[value=<?php echo $page;?>]").attr('selected','selected');
$('#size_type_active_search option[value=<?php echo $search_value?>]').attr('selected', 'selected');
$('#size_type_visibility_search option[value=<?php echo $search_value?>]').attr('selected', 'selected');

function resetSort(){
   location.href = "http://<?php echo $_SERVER['HTTP_HOST'],get_dirname($_SERVER['PHP_SELF'])."/size"?>";
}

$("#pop-size").hide();

function closePop(){
   $("#pop-size").fadeOut("fast");
   
   $('#checkbox').find(':checked').each(function() {
      $(this).removeAttr('checked');
   });
   
   $('#edit-size-type-id').val('');
   $('#edit-size-sku').val('');
   $('#edit-size-type-name').val('');
   
   $("#size-active").attr('checked', 'checked');
   $("#size-visible").attr('checked', 'checked');
   
   $('#edit-size-group-name').val('');
}

function popAdd(){
   $("#pop-size").fadeIn("fast");
   $("#btn-pop-delete").hide();
   $("#pop-title").text("Add Size");
   
   $("#size-active").attr('checked', 'checked');
   $("#size-visible").attr('checked', 'checked');
}

function popEdit(i){
   $("#pop-size").fadeIn("fast");
   $("#btn-pop-delete").fadeIn("fast");
   $("#pop-title").text("Edit Size");
   
   var size_type_id   = $('#check_'+i).val();
   var size_type_name = $('#get_size_type_name_'+i).text();
   var size_name      = $('#get_size_name_'+i).text();
   var active         = $('#get_active_status_'+i).text();
   var visibility     = $('#get_visibility_status_'+i).text(); 
   var sku            = $('#get_size_sku_'+i).val(); 
   
   $('#edit-size-type-id').val(size_type_id);
   $('#edit-size-sku').val(sku);
   $('#edit-size-type-name').val(size_type_name);
   
   if(active == "Active"){
      $("#size-active").attr('checked', 'checked');
   }else{
      $('#size-inactive').attr('checked', 'checked');
   }
   
   if(visibility == "Yes"){
      $("#size-visible").attr('checked', 'checked');
   }else{
      $('#size-invisible').attr('checked', 'checked');
   }
   
   $('#edit-size-group-name').val(size_name);
   
}

function changeOption(){
   var action = $('#news-action option:selected').val();
   
   if(action == "delete" || action == ""){
      $('#news-option').addClass("hidden");
	  $('#lbl-news-option').addClass("hidden");
	  $('#news-option').attr('disabled', true);
   }else if(action == "change"){
	  $('#news-option').removeClass("hidden");
	  $('#lbl-news-option').removeClass("hidden");
	  $('#news-option').removeAttr('disabled');
   }
   
}

$(document).ready(function(e) {
   changeOption();
});
</script>

<?php
if($_POST['btn-size-index'] == ""){
   $_SESSION['alert'] = "";
   $_SESSION['msg']   = "";
}
?>

           