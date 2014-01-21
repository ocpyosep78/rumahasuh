<?php
include("get.php");
include("update.php");
include("control.php");
include("ajax.php");

// STORED VALUE
echo "<input type=\"hidden\" name=\"url\" id=\"url\" class=\"hidden\" value=\"http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news-category-view\">\n";
echo "<input type=\"hidden\" name=\"page\" id=\"page\" class=\"hidden\" value=\"".$page."\" /> \n";
echo "<input type=\"hidden\" name=\"query_per_page\" id=\"query_per_page\" class=\"hidden\" value=\"".$query_per_page."\" /> \n";
echo "<input type=\"hidden\" name=\"total_page\" id=\"total_page\" class=\"hidden\" value=\"".$total_page."\" /> \n";
echo "<input type=\"hidden\" name=\"sort_by\" id=\"sort_by\" class=\"hidden\" value=\"".$sort_by."\" /> \n";
echo "<input type=\"hidden\" name=\"search\" id=\"search\" class=\"hidden\" value=\"".urlencode($search)."\" /> \n";
echo "<input type=\"hidden\" name=\"user_id\" id=\"user_id\" class=\"hidden\" value=\"".$user_id."\" /> \n";

// HANDLING ARROW SORTING
if($_REQUEST['srt'] == "category_name DESC"){
   $arr_category_name = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "category_name"){
   $arr_category_name = "<span class=\"sort-arrow-down\"></span>";

}else if($_REQUEST['srt'] == "category_active DESC"){
   $arr_category_active = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "category_active"){
   $arr_category_active = "<span class=\"sort-arrow-down\"></span>";
   
}else if($_REQUEST['srt'] == "category_visibility DESC"){
   $arr_category_visibility = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "category_visibility"){
   $arr_category_visibility = "<span class=\"sort-arrow-down\"></span>";
   
}else{
   $arr_order_number = "<span class=\"sort-arrow-down\"></span>";
}

$list_category = get_listing_news_category($search, $sort_by, $first_record, $query_per_page);

//var_dump($_POST);
?>

<form method="post" enctype="multipart/form-data">

        <div class="" id="pop-category">
            <div class="overlay over-category">
                <div class="header">
                        <h2 id="pop-title"> </h2> 
                        <div class="btn-placeholder">
                            <input type="button" class="btn grey main" value="Cancel" onclick="closePop()">
                            <input type="submit" class="btn red main" value="Delete" id="btn-delete" name="btn_pop_category">
                            <input type="submit" class="btn green main" value="Save Changes" name="btn_pop_category">
                        </div>
                    </div>
                <div class="content">
                    <ul class="field-set">
                        <li class="field">
                            <input type="hidden" name="category_id" id="category-id">
                        
                            <label for="xxxx" class="">Change status</label>
                            <input type="radio" class="input-radio" value="Active" name="news-category-active-status" id="news-category-active-status"/>&nbsp; Active
                            <input type="radio" class="input-radio" value="Inactive" name="news-category-active-status" id="news-category-inactive-status"/>&nbsp; Inactive
                        </li>
                        <li class="field">
                            <label for="xxxx">Visibility</label>
                            <input type="radio" class="input-radio" value="Yes" name="news-category-visible-status" id="news-category-visible-status"/>&nbsp; Yes
                            <input type="radio" class="input-radio" value="No" name="news-category-visible-status" id="news-category-invisible-status"/>&nbsp; No
                        </li>
                        <li class="field">
                            <label for="xxxx">Root category</label>
                            <select class="input-select" >
                                <option disabled>Root</option>
                            </select>
                        </li>
                        <li class="field clearfix">
                            <label>Category name</label>
                            <input type="text" class="input-text" name="category_name" id="cat-pop-name">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="overlay_bg70" id="overlay-bg" onclick="closePop()"></div>
        </div>
        

            <div class="sub-header clearfix">
                <div class="content">
                    <h2>Manage Categories</h2>
                    <div class="btn-placeholder">
                        <input type="button" class="btn green main" value="Add Category" onClick="addPop()">
                    </div>
                </div>
            </div>

            <div id="main-content">

                <div class="table-wrapper">
                    <table cellpadding="0" cellspacing="0" class="actions">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="fl">
                                    
                                       <div class="custom-select-all" onclick="selectAllToggle()">
                                          <input type="checkbox" id="select_all">
                                       </div><!--custom-select-all-->
                                       
                                       
                                        <div class="divider"></div>
                                        <div class="page">
                                            <p>Page</p>
                                            <select class="input-select" id="page-option" onchange="pageOption()">
                                               
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
                                            <select class="input-select" name="query_per_page" id="query_per_page_input" onchange="changeQueryPerPage()">
                                                <option></option>
                                                <option value="25"<?php if($query_per_page =="25"){ echo "selected=\"selected\"";}?>>25</option>
                                                <option value="50" <?php if($query_per_page == "50"){ echo "selected=\"selected\"";}?>>50</option>
                                                <option value="100" <?php if($query_per_page == "100"){ echo "selected=\"selected\"";}?>>100</option>
                                            </select>
                                            <p>of <strong><?php echo $total_query;?></strong> records</p>
                                        </div>
                                    </div>
                                    <div class="fr">
                                        <p>Actions</p>
                                        <select class="input-select" name="category_listing_action">
                                            <option value="delete">Delete</option>
                                            <option value="save">Save Changes</option>
                                        </select>
                                        <p>to</p>
                                        <select class="input-select" name="category_listing_option">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <input type="submit" class="btn green main go" value="GO" name="btn_pop_category">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0">
                        <thead>
                            <tr class="headings">
                                <th width="20"></th>
                                <th class="sort" width="680" onclick="sortBy('category_name')">Category Name<?php echo $arr_category_name;?>
                                </th>
                                <th class="sort" width="70">News</th>
                                <th class="sort" width="130" onclick="sortBy('category_active')">Status <?php echo $arr_category_active;?></th>
                                <th class="sort" width="60" onclick="sortBy('category_visibility')">Visibility<?php echo $arr_category_visibility;?></th>
                            </tr>
                            <tr class="filter">
                                <th><input type="button" class="btn small reset" value="" onclick="resetSort()"></th>
                                <th><input type="text" class="input-text"></th>
                                <th><input type="text" class="input-text"></th>
                                <th>
                                    <select class="input-select">
                                        <option>Active</option>
                                        <option>Inactive</option>
                                    </select>
                                </th>
                                <th>
                                    <select class="input-select">
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody onload="loading()" id="checkbox">
                        <!--<div id="loading" style="position: absolute; z-index: 2; background: #000; width: 940px; height: 200px"></div>-->
                        
                        <?php
						$row = 0;
                        foreach($list_category as $list_category){
						   $row++;
						?>
                        
                            <tr class="" id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                                <td><input type="checkbox" name="cat_id[]" id="<?php echo "check_".$row?>" value="<?php echo $list_category['category_id'];?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')"></td>
                                <td><a href="#" id="category_listing_<?php echo $list_category['category_id'];?>" onclick="editCategory('<?php echo $list_category['category_id'];?>')"><?php echo $list_category['category_name'];?></a></td>
                                <td class="tr"><a href=""><?php echo $list_category['total_news'];?></a></td>
                                <td id="cat_active_stat_<?php echo $list_category['category_id'];?>"><?php echo ucwords(strtolower($list_category['category_active']));?></td>
                                <td id="cat_visible_stat_<?php echo $list_category['category_id'];?>"><?php echo ucwords(strtolower($list_category['category_visibility']));?></td>
                            </tr>
                            
                         <?php }?>
                        </tbody>
                    </table>
                </div><!--table-wrapper-->

            </div><!--main-content-->
            
</form>


        
<script>
$("#pop-category").hide();
$("#btn-delete").hide();

function resetSort(){
   location.href = "http://<?php echo $_SERVER['HTTP_HOST'],get_dirname($_SERVER['PHP_SELF'])."/news-category"?>";
}
		
function addPop(){
   $("#pop-category").fadeIn("fast");
   $("#pop-title").text("Add Category");
   $("#news-category-active-status").attr('checked', 'checked');
   $("#news-category-visible-status").attr('checked','checked');
}

function closePop(){
   $("#pop-category").fadeOut("fast");
   $("#pop-title").val('');
   $("#btn-delete").hide();
   
   $("#category-id").val('');
   $("#news-category-active-status").attr('checked', 'checked');
   $("#news-category-visible-status").attr('checked', 'checked');
   $("#cat-pop-name").val('');
   
   $('#checkbox').find(':checked').each(function() {
      $(this).removeAttr('checked');
   });
   
}

function editCategory(i){
   $("#pop-category").fadeIn("fast");
   $("#pop-title").text("Edit Category");
   $("#btn-delete").fadeIn("fast");
   
   var cat_id  = i;
   var active  = $("#cat_active_stat_"+i).text();
   var visible = $("#cat_visible_stat_"+i).text();
   var name    = $("#category_listing_"+i).text();
   
   $("#category-id").val(cat_id);
   
   if(active == "Active"){
      $("#news-category-active-status").attr('checked', 'checked');
   }else{
      $("#news-category-inactive-status").attr('checked', 'checked');
   }
   
   if(visible == "Yes"){
      $("#news-category-visible-status").attr('checked', 'checked');
   }else{
      $("#news-category-invisible-status").attr('checked', 'checked');
   }
   
   $("#cat-pop-name").val(name);
}
</script>

            