<form method="post" enctype="multipart/form-data">
<?php
include("control.php");
include("custom/products/control.php");


// STORED VALUE
echo "<input type=\"hidden\" name=\"url\" id=\"url\" class=\"hidden\" value=\"http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/product-view\">\n";
echo "<input type=\"hidden\" name=\"page\" id=\"page\" class=\"hidden\" value=\"".$page."\" /> \n";
echo "<input type=\"hidden\" name=\"current_category\" id=\"current_category\" class=\"hidden\" value=\"";
	if($cat=='top'){echo 'top';}
	else{echo $cat_name;}
echo "\" /> \n";
echo "<input type=\"hidden\" name=\"query_per_page\" id=\"query_per_page\" class=\"hidden\" value=\"".$query_per_page."\" /> \n";
echo "<input type=\"hidden\" name=\"total_page\" id=\"total_page\" class=\"hidden\" value=\"".$total_page."\" /> \n";
echo "<input type=\"hidden\" name=\"sort_by\" id=\"sort_by\" class=\"hidden\" value=\"".$sort_by."\" /> \n";
echo "<input type=\"hidden\" name=\"search\" id=\"search\" class=\"hidden\" value=\"".$search_parameter."-".$search_value."\" /> \n";

// HANDLING ARROW SORTING
if($_REQUEST['srt'] == "product_name"){
   $arr_product_name = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "product_name DESC"){
   $arr_product_name = "<span class=\"sort-arrow-down\"></span>";
   
}else if($_REQUEST['srt'] == "type_name DESC"){
   $arr_type_name = "<span class=\"sort-arrow-down\"></span>";
}else if($_REQUEST['srt'] == "type_name"){
   $arr_type_name = "<span class=\"sort-arrow-up\"></span>";
									  
}else if($_REQUEST['srt'] == "type_price DESC"){
   $arr_type_price = "<span class=\"sort-arrow-down\"></span>";
}else if($_REQUEST['srt'] == "type_price"){
   $arr_type_price = "<span class=\"sort-arrow-up\"></span>";
									  
}else if($_REQUEST['srt'] == "type_visibility DESC"){
   $arr_type_visibility = "<span class=\"sort-arrow-down\"></span>";
}else if($_REQUEST['srt'] == "type_visibility"){
   $arr_type_visibility = "<span class=\"sort-arrow-up\"></span>";
}

?>

    <div class="subnav">
      <div class="container clearfix">
        <h1><span class="glyphicon glyphicon-tags"></span> &nbsp; Products</h1>
        <select class="form-control hidden" id="category_name_search" onchange="selectCategory()">
          <option value="top">All Category</option>
          <?php
          //$all_category = get_all_category();
          foreach($all_category as $all_category){
          ?>
          <option value="<?php echo $all_category['category_name']?>" <?php if($cat_name==$all_category['category_name']){echo 'selected="selected"';}?>><?php echo $all_category['category_name'];?></option>
          <?php }?>
        </select>
        <div class="btn-placeholder">
          <a class="btn btn-success btn-sm" href="<?php echo $prefix_url."add-product"?>"><span class="glyphicon glyphicon-plus"></span> &nbsp;Add Product</a>
          <button class="btn btn-success btn-sm"><span class="glyphicon glyphicon-save"></span> &nbsp;Import Products</button>
        </div>
      </div>
    </div>

    <div class="alert success hidden">
      <div class="container">
        <strong>Error!</strong> Best check yo self, you're not looking too good.
      </div>
    </div>

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
                echo "<option value=\"".$i."\"";
                if ($page==$i){
                  echo 'selected="selected"';
                }
                echo ">".$i."</option> \n";
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
              <p>of <strong><?php echo $full_product['total_query'];?></strong> records</p>
            </div>
            <div class="pull-right">
              <p>Actions</p>
              <select class="form-control" name="product-index-action" id="product-index-action" onchange="changeAction()"> 
                <option value='delete'>Delete</option>
                <option value='visibility'>Set Visibility</option>
                <option value='new' disabled="disabled">New Arrival</option>
              </select>
              <p id="product-index-conj">to</p>
              <select class="form-control" name="product-index-option" id="product-index-option">
                <option value='1'>Yes</option>
                <option value='0'>No</option>
              </select>
              <input type="submit" class="btn btn-success pull-left" name="btn-product-index" value="GO">
            </div>
          </div><!--actions-->

          <table class="table">
            <thead>
              <tr class="headings">
                <th width="20"><span id="eyeopen" class="glyphicon glyphicon-eye-open" onclick="showEye()"></span></th>
                <th width="30"></th>
                <th class="sort" width="55%" onclick="sortBy('product_name')">Item<?php echo $arr_product_name;?></th>
                <th class="sort" width="20%" onclick="sortBy('type_name')">Variants<?php echo $arr_type_name;?></th>
                <th class="sort" width="20%" onclick="sortBy('type_price')">Price<?php echo $arr_type_price;?></th>
                <th width="5%" onclick="sortBy('type_visibility')">Visibility<?php echo $arr_type_visibility;?></th>
              </tr>
              <tr class="filter hidden" id="filter">
                <th><a href="<?php echo $prefix_url."product";?>"><button type="button" style="width: 100%;" class="btn btn-danger btn-xs <?php if(!empty($_REQUEST['src'])){ echo "";}else{ echo " hidden";}?>"><span class="glyphicon glyphicon-remove"></span></button></a></th>
                <th><input type="text" class="form-control" disabled></th>
                <th><input type="text" class="form-control" id="product_name_search" onkeyup="searchQuery('product_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "product_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                <th><input type="text" class="form-control" id="type_name_search" onkeyup="searchQuery('type_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "type_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                <th><input type="text" class="form-control" id="type_price_search" onkeyup="searchQuery('type_price')" onkeypress="return disableEnterKey(event)" value="<?php echo $search['type_price'];?>" disabled></th>
                <th>
                  <select class="form-control" id="type_visibility_search" onchange="searchQueryOption('type_visibility')" <?php if($_REQUEST['src'] == "type_visibility"){ echo "value=\"".$_REQUEST['srcval']."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled=\"disabled\"";}?>>
                    <option value="x"></option>
                    <option value="1" <?php if($search['type_visibility']=='1'){ echo 'selected="selected"';} ?>>Yes</option>
                    <option value="0" <?php if($search['type_visibility']!=null &&$search['type_visibility']=='0'){ echo 'selected="selected"';} ?>>No</option>
                  </select>
                </th>
              </tr>
              <!--<script>
                function showEye() {
                  $("#filter").slideDown("slow");
                  $("#eyeclose").show();
                  $("#eyeopen").hide();
                }
                  $("#filter").hide();
                  $("#eyeclose").hide();

                function closeEye() {
                  $("#filter").slideUp("fast")
                  $("#eyeopen").show();
                  $("#eyeclose").hide();
                }
              </script>-->
            </thead>
            <tbody>
              <?php 
              $row=0;
              foreach($all_product as $all_product){
                   $row++;
                   
                   
                 if(empty($all_product['product_name']))    { $empty_prod_name       = $all_product['category_name']." - N/A";}
                 if(empty($all_product['type_name']))       { $empty_type_name       = "- N/A -";}
                 if(empty($all_product['type_price']))      { $empty_type_price      = " - N/A -";}
                 if(empty($all_product['type_visibility'])) { $empty_type_visibility =  "- N/A -";;}
              ?>
              <tr id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                <td>
                  <input type="checkbox" name="type_id[]" id="<?php echo "check_".$row?>" value="<?php echo $all_product['type_id'];?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')">
                  <input type="checkbox" name="product_id[]" id="<?php echo "product_check_".$row?>" class="hidden" value="<?php echo $all_product['id'];?>">
                </td>
                <td><img class="table-image" src="<?php echo $prefix_url;?>files/common/img_product-1.jpg"></td>
                <td>
                  <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/product-details-".$all_product['product_alias'];?>">
                    <?php echo ucwords(strtolower($all_product['product_name'].$empty_prod_name));?>
                  </a>
                </td>
                <td><?php echo ucwords(strtolower($all_product['type_name']));?></td>
                <td><?php echo number_format($all_product['type_price'],0,',','.');?></td>
                <?php
                if($all_product['type_visibility'] == "1"){
                   $visibility = "Yes";
                }else if($all_product['type_visibility'] == "0"){
                   $visibility = "No";
                }
                ?>
                <td><?php echo $visibility;?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>

        </div><!--content-->
      </div><!--box-->

    </div><!--container main-->
            <!--<div class="sub-header clearfix">
                <div class="content">
                    <h2>Manage Products</h2>
                    <select class="input-select" id="category_name_search" onchange="selectCategory()">
                       <option value="top">All Category</option>
                       <?php
                       //$all_category = get_all_category();
					   foreach($all_category as $all_category){
					   ?>
                          <option value="<?php echo $all_category['category_name']?>" <?php if($cat_name==$all_category['category_name']){echo 'selected="selected"';}?>><?php echo $all_category['category_name'];?></option>
                       <?php }?>
					   
                    </select>
                    <div class="btn-placeholder">
                       <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/add-product"?>">
                        <input type="button" class="btn green main" value="Add Product">
                       </a>
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
                                       </div>
                                       
                                        <div class="divider"></div>
                                        <div class="page">
                                            <p>Page</p>
                                            <select class="input-select" id="page-option" onchange="pageOption()">
                                               
                                               <?php
                                               for($i=1;$i<=$total_page;$i++){
											      echo "<option value=\"".$i."\"";
											      if ($page==$i){
												      echo 'selected="selected"';
											      }
											      echo ">".$i."</option> \n";
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
                                            <p>of <strong><?php echo $full_product['total_query'];?></strong> records</p>
                                        </div>
                                    </div>
                                    <div class="fr">
                                        <p>Actions</p>
                                        <select class="input-select" name="product-index-action" id="product-index-action" onchange="changeAction()">
                                            <option value='delete'>Delete</option>
                                            <option value='visibility'>Visibility</option>
                                            <option value='new'>New Arrival</option>
                                        </select>
                                        <p id="product-index-conj">to</p>
                                        <select class="input-select" name="product-index-option" id="product-index-option">
                                            <option value='1'>Yes</option>
                                            <option value='0'>No</option>
                                        </select>
                                        <input type="submit" class="btn green main go" value="GO" name="btn-product-index">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0">
                        <thead>
                            <tr class="headings">
                                <th width="20"></th>
                                <th class="sort" width="620" onclick="sortBy('product_name')">Item<?php echo $arr_product_name;?></th>
                                <th class="sort" width="130" onclick="sortBy('type_name')">Variants<?php echo $arr_type_name;?></th>
                                <th class="sort" width="130" onclick="sortBy('type_price')">Price<?php echo $arr_type_price;?></th>
                                <th class="sort" width="60" onclick="sortBy('type_visibility')">Visibility<?php echo $arr_type_visibility;?></th>
                            </tr>
                            <tr class="filter">
                                <th>
                                   <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/product";?>">
                                      <input type="button" class="btn small reset" value="">
                                   </a>
                                </th>
                                <th><input type="text" class="input-text" id="product_name_search" onkeyup="searchQuery('product_name')" onkeypress="return disableEnterKey(event)" value="<?php echo $search['product_name'];?>"></th>
                                <th><input type="text" class="input-text" id="type_name_search" onkeyup="searchQuery('type_name')" onkeypress="return disableEnterKey(event)" value="<?php echo $search['type_name'];?>"></th>
                                <th><input type="text" class="input-text" id="type_price_search" onkeyup="searchQuery('type_price')" onkeypress="return disableEnterKey(event)" value="<?php echo $search['type_price'];?>"></th>
                                <th>
                                    <select class="input-select" id="type_visibility_search" onchange="searchQueryOption('type_visibility')">
                                       <option value="x"></option>
                                       
                                       <option value="1" <?php if($search['type_visibility']=='1'){ echo 'selected="selected"';} ?>>Yes</option>
                                       <option value="0" <?php if($search['type_visibility']!=null &&$search['type_visibility']=='0'){ echo 'selected="selected"';} ?>>No</option>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody onload="loading()">
                            <div id="loading" style="position: absolute; z-index: 2; background: #000; width: 940px; height: 200px"></div>
                            
                            <?php 
              							$row=0;
              							foreach($all_product as $all_product){
              						       $row++;
              						       
              						       
              							   if(empty($all_product['product_name']))    { $empty_prod_name       = $all_product['category_name']." - N/A";}
              							   if(empty($all_product['type_name']))       { $empty_type_name       = "- N/A -";}
              							   if(empty($all_product['type_price']))      { $empty_type_price      = " - N/A -";}
              							   if(empty($all_product['type_visibility'])) { $empty_type_visibility =  "- N/A -";;}
              							?>
                            
                            <tr id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                                <td>
                                <input type="checkbox" name="type_id[]" id="<?php echo "check_".$row?>" value="<?php echo $all_product['type_id'];?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')">
                                <input type="checkbox" name="product_id[]" id="<?php echo "product_check_".$row?>" class="hidden" value="<?php echo $all_product['id'];?>">
                                </td>
                                
                                <td>
                                   <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/product-details-".$all_product['product_alias'];?>">
								      <?php echo ucwords(strtolower($all_product['product_name'].$empty_prod_name));?>
                                   </a>
                                </td>
                                <td><?php echo ucwords(strtolower($all_product['type_name']));?></td>
                                <td class="tr"><?php echo number_format($all_product['type_price'],0,',','.');?></td>
                                
                                <?php
                                if($all_product['type_visibility'] == "1"){
                								   $visibility = "Yes";
                								}else if($all_product['type_visibility'] == "0"){
                								   $visibility = "No";
                								}
                								?>
                                <td><?php echo $visibility;?></td>
                            </tr>
                            
                            <?php }?>
                        </tbody>
                    </table>
                </div>

            </div>
            
</form>-->

<script src="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF']);?>/script/product.js"></script>    

<?php include("custom/products/index.php");?>