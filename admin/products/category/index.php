<?php
//include("sources/language/products/category/control.php");
?>

<?php
include("get.php");
include("update.php");
include("control.php");
?>

<form method="post" enctype="multipart/form-data">
        
        
        <!-- 
        <div class="" id="add-category-popup">
            <div class="overlay over-category">
                <div class="header">
                
                        <h2>Add Category</h2> 
                        <div class="btn-placeholder">
                            <input type="hidden" name="cat_id" id="category_id"/>
                            <input type="button" class="btn grey main" value="Cancel" id="btn-add-category-cancel" onclick="closePop()" id="btn_cancel">
                            <input type="submit" class="btn red main" value="Delete" id="btn-delete" name="btn-index-category" onclick="deleteCategory()" id="btn_delete">
                            <input type="button" class="btn green main" value="Save Changes" onclick="validateAdd()">
                            <input type="submit" class="btn green main hidden" value="Save Changes" name="btn-index-category" id="btn-save">
                        </div>
                    </div>
                <div class="content">
                    <ul class="form-set" id="custom_product_category">
                        <li class="form-group hidden">
                            <label>Change status</label>
                            <input type="radio" class="input-radio" value="Active" name="active_status" id="category_active_status_active"/>&nbsp; Active
                            <input type="radio" class="input-radio" value="Inactive" name="active_status" id="category_active_status_inactive"/>&nbsp; Inactive
                        </li>
                        <li class="form-group hidden">
                            <label>Visibility</label>
                            <input type="radio" class="input-radio" value="1" name="visibility_status" id="category_visibility_status_visible" />&nbsp; Yes
                            <input type="radio" class="input-radio" value="0" name="visibility_status" id="category_visibility_status_invisible" />&nbsp; No
                        </li>
                        <li class="form-group">
                            <label>Root category</label>
                            <select class="form-control" name="category_parent" id="category_parent">
                                <option value="top"> Root Category</option>
                                <?php listCategory(0,'top');?>
                            </select>
                            
                        </li>
                        <li class="form-group clearfix">
                            <label>Category name</label>
                            <input type="text" class="form-control" name="category_name" placeholder="ex: Tees" id="category_name">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="overlay_bg70" id="overlay" onclick="closePop()"></div>
        </div>
        -->       


            <div class="subnav clearfix">
              <div class="container clearfix">
                <h1><span class="glyphicon glyphicon-list"></span> &nbsp; Categories</h1>
                <div class="btn-placeholder">
                  <a href="<?php echo $prefix_url."add-category"?>"><input type="button" class="btn btn-success btn-sm" value="Add Category" name="btn-index-category" id="btn-add-category"></a>
                </div>
              </div>
            </div>

             <?php if(!empty($_SESSION['alert'])){?>
                <div class="alert <?php echo $_SESSION['alert'];?>">
                  <div class="container"><?php echo $_SESSION['msg'];?></div>
                </div>
             <?php 
            }
            if($_POST['btn-index-category'] == ""){
             $_SESSION['alert'] = "";
             $_SESSION['msg']   = "";
              }
            ?>

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
                     <select class="form-control" name="category-action" id="news-action" onchange="changeOption()"> 
                       <option value="delete">Delete</option>
                     </select>
                     <p id="lbl-news-option" class="hidden">to</p>
                     <select class="form-control hidden" name="category-option" id="news-option" disabled="disabled">
                       <option value="yes">Yes</option>
                       <option value="no">No</option>
                     </select>
                     <input type="submit" class="btn btn-success pull-left" value="GO" name="btn-index-category">
                   </div>
                 </div><!--actions-->

                    <table class="table">
                        <thead>
                            <tr class="headings">
                                <th width="20"><span id="eyeopen" class="glyphicon glyphicon-eye-open" onclick="showEye()"></span></th>
                                <th class="sort" width="85%" onclick="sortBy('category_name')">Category Name<?php echo $arr_order_number;?></th>
                                <th class="sort" width="10%" onclick="sortBy('total_product')">Products</th>
                                <!--<th class="sort" width="130" onclick="sortBy('category_active_status')">Status</th>-->
                                <th class="sort" width="5%" onclick="sortBy('category_visibility_status')">Visibility</th>
                            </tr>
                            <tr class="filter hidden" id="filter">
                                <th><a href="<?php echo $prefix_url."category"?>"><button type="button" style="width: 100%;" class="btn btn-danger btn-xs <?php echo $reset;?>"><span class="glyphicon glyphicon-remove"></span></button></a></th>
                                <th><input type="text" class="form-control" id="category_name_search" onkeyup="searchQuery('category_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "category_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                                <th><input type="text" class="form-control" id="total_product_search" onkeyup="searchQuery('total_product')" onkeypress="return disableEnterKey(event)" disabled="disabled"></th>
                                <!--<th>
                                    <select class="form-control" name="category_active_status" id="category_active_status_search" onchange="searchQueryOption('category_active_status')" <?php if($_REQUEST['src'] != "category_active_status" and !empty($_REQUEST['src'])){ echo "disabled";}?>>
                                        <option></option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </th>-->
                                <th>
                                  <select class="form-control" name="category_visibility_status" id="category_visibility_status_search" onchange="searchQueryOption('category_visibility_status')" <?php if($_REQUEST['src'] != "category_visibility_status" and !empty($_REQUEST['src'])){ echo "disabled";}?>>
                                    <option></option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                  </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($total_query < 1){?><tr><td class="no-record" colspan="8">No records found.</td></tr><?php }?>
                            <?php //showCategory(0,'top',$current_category, $search_query, $sort_by, $first_record ,$query_per_page, $total_query, 1);?>
                            <?php
							// Loop 1
							$row = 0;
							foreach($listing_order as $all_category){
							   $row++;
							   $getTotal = getTotal($all_category['category_id']);
							?>
                            
                            <tr id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                                <td><input type="checkbox" name="category_id[]" value="<?php echo $all_category['category_id'];?>" id="<?php echo "check_".$row?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')"></td>
                                <td><a href="#" onclick="editPop(<?php echo $all_category['category_id'];?>)"><?php for($i=0;$i<$all_category['category_level'];$i++){ echo "-- ";} echo ucwords(strtolower($all_category['category_name']));?></a></td>
                                <td><a href="<?php echo $prefix_url."product-view/1/top/25/product_name/product_category-".$all_category['category_id'];?>"><?php echo $getTotal['total_product'];?></a></td>
                                <!--<td><?php echo $all_category['category_active_status'];?></td>-->
                                <td><?php if($all_category['category_visibility_status'] == 1){ echo "Yes";}else{ echo "No";}?></td>
                            </tr>
                            
                            <input type="hidden" id="listing_category_name_<?php echo $all_category['category_id'];?>" value="<?php echo $all_category['category_name'];?>">
                            <input type="hidden" id="listing_active_<?php echo $all_category['category_id'];?>" value="<?php echo $all_category['category_active_status'];?>">
                            
                            <?php $root = getParent($all_category['category_id']);?>
                            <input type="hidden" id="listing_option_<?php echo $all_category['category_id'];?>" value="<?php echo $root['category_parent'];?>">
                            <input type="hidden" id="listing_cat_id_<?php echo $all_category['category_id'];?>" value="<?php echo $all_category['category_id'];?>">
                            <input type="hidden" id="listing_visible_<?php echo $all_category['category_id'];?>" value="<?php echo $all_category['category_visibility_status'];?>">
                            <input type="hidden" id="link-category-<?php echo $all_category['category_id'];?>" value="<?php echo $all_category['category_id'];?>">
                            
                            <?php 
							}
							?>
                        </tbody>
                    </table>
                </div><!--.table-->

              </div><!--.content-->
            </div><!--.box.row-->

            </div><!--.container.main-->



</form>

<script>
<?php if($search_parameter == "category_visibility_status"){?>
$('#category_visibility_status_search option[value=<?php echo $search_value;?>]').attr('selected', 'selected');
<?php }?>


<?php if($search_parameter == "category_active_status"){?>
$('#category_active_status_search option[value=<?php echo $search_value;?>]').attr('selected', 'selected');
<?php }?>

$('#add-category-popup').hide();

function showPop(){
   $('#add-category-popup').fadeIn("fast");
   $('#btn-delete').hide();
   
   $('#category_id').val('');
   $('#category_active_status_active').attr('checked', 'checked');
   $('#category_visibility_status_visible').attr('checked', 'checked');
   $('#category_parent option[value=top]').attr('selected', 'selected');
   $('#category_name').val('');
}

function editPop(i){
   var cat_name   = $('#listing_category_name_'+i).val();
   var active     = $('#listing_active_'+i).val();
   var visibility = $('#listing_visible_'+i).val();
   var cat_id     = $('#listing_cat_id_'+i).val();
   var option     = $('#listing_option_'+i).val();
   
   $('#add-category-popup').fadeIn("fast");
   $('#btn-delete').show();
   
   $('#category_name').val(cat_name);
   
   if(active == "Active"){
      $('#category_active_status_active').attr('checked', 'checked');
   }else if(active == "Inactive"){
	  $('#category_active_status_inactive').attr('checked', 'checked');
   }
   
   if(visibility == "1"){
      $('#category_visibility_status_visible').attr('checked', 'checked');
   }else if(visibility == "0"){
	  $('#category_visibility_status_invisible').attr('checked', 'checked');
   }
   
   $('#category_parent option[value='+option+']').attr('selected', 'selected');
   
   $('#category_id').val(cat_id);
   
   //alert(cat_name);
}

function closePop(){
   $('#add-category-popup').fadeOut("fast");
   $('#btn-delete').hide();
   
   $('#category_id').val('');
   $('#category_active_status_active').attr('checked', 'checked');
   $('#category_visibility_status_visible').attr('checked', 'checked');
   $('#category_parent option[value=top]').attr('selected', 'selected');
   $('#category_name').val('');
   
   $('#checkbox').find(':checked').each(function() {
      $(this).removeAttr('checked');
   });
}

function validateAdd(){
   var name = $('#category_name').val();
   
   if(name == ""){
	  alert("Category name can't be empty");
   }else{
      $('#btn-save').click();
   }
   
   //alert(name);
   


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

}
</script>

<!--custom-->
<?php
//include("sources/language/products/category/index.php");
?>