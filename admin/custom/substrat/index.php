<?php
include("get.php");
include("update.php");
include("control.php");
?>


<form method="post">

            <div class="subnav">
              <div class="container clearfix">
                <h1><span class="glyphicon glyphicon-list"></span> &nbsp; Filter (substrat)</h1>
                <select class="form-control hidden" id="category_name_search" onchange="selectCategory()">
                  <option value="top">All Category</option>
                  <?php listCategory(0,'top');?>
                </select>
                <div class="btn-placeholder">
                  <input type="submit" class="btn btn-danger btn-sm" value="Remove All Filter" name="btn_filter_add">
                  <input type="button" class="btn btn-success btn-sm" value="Save Changes" onClick="validateSale()">
                  <input type="submit" class="btn btn-success btn-sm hidden" value="Apply Discount" id="btn_submit_sale" name="btn_filter_add">
                </div>
              </div>
            </div>

            <?php
			if(!empty($_SESSION['alert'])){
			   echo '<div class="alert '.$_SESSION['alert'].'">';
			   echo '<div class="container">'.$_SESSION['msg'].'</div>';
			   echo '</div>';
			}
			
			if(empty($_POST['btn_filter_add'])){
			   unset($_SESSION['alert']);
			   unset($_SESSION['msg']);
			}
			?>  

            <div class="container main">

              <div class="box row">
                <div class="desc col-xs-3">
                  <h3>Filter Details</h3>
                  <p>Manage filter</p>
                </div>
                <div class="content col-xs-9">
                  <ul class="form-set">
                    <li class="form-group row">
                      <label class="col-xs-3" for="category">Filter <span>*</span></label>
                      <div class="col-xs-9">
                        <select class="form-control" id="sale_option" name="filter_id">
                          <!--<option value="0" disabled="disabled">Filter Available</option>-->
                          
						  <?php
						  foreach($filters as $filters){
						     echo '<option value="'.$filters['filter_id'].'">'.$filters['filter_name'].'</option>';
						  }
						  ?>
                          
                        </select>
                      </div>
                    </li>
                    <li class="form-group row hidden">
                      <label class="col-xs-3" for="brand" id="text_by">Discount (IDR) <span>*</span></label>
                      <div class="col-xs-9">  
                        <input type="text" class="form-control" style="width: 300px" id="id_amount_discount" onKeyUp="numbers()" name="promo_value">
                      </div>
                    </li>
                    <li class="form-group row hidden">
                      <label class="col-xs-3" for="category">Date range <span>*</span></label>
                      <div class="col-xs-9 row">
                        <div class="col-xs-3">
                          <input type="text" class="form-control" placeholder="Date from" id="id_date_from" name="date_from">
                        </div>
                        <div class="col-xs-1 text-center" style="line-height: 30px;">to</div>
                        <div class="col-xs-3">
                          <input type="text" class="form-control" placeholder="Date to" id="id_date_to" name="date_to">
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div><!--.box-->

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
                  </div><!--actions-->

                  <table class="table">
                    <thead>
                      <tr class="headings">
                        <th width="20"><span id="eyeopen" class="glyphicon glyphicon-eye-open" onclick="showEye()"></span></th>
                        <th class="sort" width="40%" onclick="sortBy('product_name')">Item <?php echo $arr_product_name;?></th>
                        <th class="sort" width="30%" onclick="sortBy('type_name')">Variants <?php echo $arr_type_name;?></th>
                        <th class="sort" width="30%" onclick="sortBy('promo_value')">Filter <?php echo $arr_promo_value;?></th>
                      </tr>
                      <tr class="filter hidden" id="filter">
                        <th><a href="<?php echo $prefix_url."sale";?>"><button type="button" style="width: 100%;" class="btn btn-danger btn-xs <?php echo $reset;?>" value=""><span class="glyphicon glyphicon-remove"></span></button></a></th>
                        <th><input type="text" class="form-control" id="product_name_search" onkeyup="searchQuery('product_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "product_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                        <th><input type="text" class="form-control" id="type_name_search" onkeyup="searchQuery('type_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "type_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                        <th><input type="text" class="form-control" id="type_price_search" onkeyup="searchQuery('type_price')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "type_price"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?> disabled="disabled"></th>
                        <th>
                          <select class="form-control" id="promo_value_search" onchange="searchQueryOption('promo_value')" <?php if($_REQUEST['src'] == "promo_value"){ echo "value=\"".$_REQUEST['srcval']."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled=\"disabled\"";}?> disabled="disabled">
                            <option></option>
                            <option value="IS NOT">Promo</option>
                            <option value="IS">No Promo</option>
                          </select>
                        </th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php if($total_query < 1){?><tr><td class="no-record" colspan="8">No records found.</td></tr><?php }?>
                      
                      <?php
                      $record = 1;
					  $row = 1;
					  foreach($all_product as $sale){
					     $filter_item = get_filter_item($sale['id']);
					  ?>      
                      <tr class="<?php echo $tr_class;?>" id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                        <td><input type="checkbox" name="type_id[]" value="<?php echo $sale['product_id'];?>" id="<?php echo "check_".$row?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')"></td>
                        <td><a href="<?php echo $prefix_url."/product-details-".$sale['product_alias'];?>"><?php echo $sale['product_name'];?></a></td>
                        <td><?php echo $sale['type_name'];?></td>
                        <td style="position: relative">
                        <?php
                        if(!empty($filter_item['sub_id'])){
						?>
                        
                        <div id="ajax_remove_wrapper_<?php echo $filter_item['sub_id'];?>">
                        
                           <?php
                           $items = get_filter_items($filter_item['product_id']);
						   
						   echo '<b>';
						   foreach($items as $items){
							  echo '<span id="span_'.$items['sub_id'].'">';
						      echo $items['filter_name'];
							  echo '<div class="btn btn-danger btn-xs" style="position: relative; right: 5px; top: 0px; right:0px;" onclick="ajxRemoveSale('.$items['sub_id'].')">Remove</div>';
							  echo '</span>';
							  echo"<br>";
						   }
						   echo '</b>';
						   ?>
                           
                        </div>
                        
                        <?php
                        }
                        ?>
                        </td>
                      </tr>
                        
                      <?php
                       $record++;
                       $row++;
                      }
                      ?>
                    </tbody>
                  </table>

                </div><!--.content-->
              </div><!--.box.row-->

            </div><!--.container.main-->

</form>

<script>
$(function() {
   $("#id_date_from").datepicker({
      altField:'#id_date_from',
    altFormat: "yy/mm/dd",
    onSelect: function () {
       //document.all ? $(this).get(0).fireEvent("onchange") : $(this).change();
         //searchQueryOption('order_date');
     //$('#id_hidden_date_from').val('filled');
      },
   });
   
   
   $("#id_date_to").datepicker({
      altField:'#id_date_to',
    altFormat: "yy/mm/dd",
   });
});

function numbers(){
   var nonum  = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/
   var number = $('#id_amount_discount').val();
   
   if(!nonum.test(number)){
      $('#id_amount_discount').addClass("empty");
   }else{
      $('#id_amount_discount').removeClass("empty");
   }
   
}

$(document).ready(function(e) {
   var category = "<?php echo $_REQUEST['cat'];?>";
   var page     = "<?php echo $_REQUEST['pg'];?>";
   var view     = "<?php echo $_REQUEST['qpp'];?>";
   var srcval   = "<?php echo $_REQUEST['srcval'];?>";
   
   if(category == ""){
      var cat = "top";
   }else{
      var cat = category;
   }
   
   $('#category_name_search option[value="'+cat+'"]').attr('selected',true);
   $('#page-option option[value="'+page+'"]').attr('selected',true);
   $('#query_per_page_input option[value="'+view+'"]').attr('selected',true);
   $('#promo_value_search option[value="'+srcval+'"]').attr('selected', true);
});


function validateSale(){
   /*
   var amount = $('#id_amount_discount').val();
   var from   = $('#id_date_from').val();
   var to     = $('#id_date_to').val();
   var nonum  = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/
   var type   = $('#sale_option :selected').val();
   
   if(amount == "" || !nonum.test(amount)){
      $('#id_amount_discount').addClass("empty");
   }else if(from == ""){
      $('#id_date_from').addClass("empty");
   }else if(to == ""){
    $('#id_date_to').addClass("empty");
   }else{
   */
      $('#btn_submit_sale').click();
   //}
}

function textIDR(){
   var param = $('#sale_option :selected').val();
   
   if (param == 1){
      $('#text_by').html("Discount (IDR) <span>*</span>");
   }else{
      $('#text_by').html("Discount (%) <span>*</span>");
   }
   
}

function ajxRemoveSale(i){
   var itemID = i;
   
   var ajx = $.ajax({
              type: "POST",
        url: "custom/substrat/ajax_remove_sale.php",
        data: {itemID:itemID},
        error: function(jqXHR, textStatus, errorThrown) {
             
             }
       }).done(function(data) {
            $('#span_'+i).addClass("hidden");
       });
}

</script>

            