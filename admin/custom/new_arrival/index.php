<?php
include("get.php");
include("update.php");
include("control.php");
?>


<form method="post">


            <div class="sub-header clearfix">
                <div class="content">

                    <h2>New Arrival</h2>
                    <select class="input-select" id="category_name_search" onchange="selectCategory()">
                       <option value="top">All Category</option>
                       <?php listCategory(0,'top');?>
                    </select>
                    <div class="btn-placeholder">
                        <input type="submit" class="btn red main" value="Remove All Discount" name="btn_submit_new_arrival">
                        <input type="button" class="btn green main" value="Apply Discount" onClick="validateNew()">
                        <input type="submit" class="hidden" value="Apply Discount" id="id_btn_submit_new_arrival" name="btn_submit_new_arrival">
                    </div>
                </div>
            </div>

            <div id="main-content">

                <?php
                   if(!empty($_SESSION['alert'])){
                    ?>
                   <div class="alert-message <?php echo $_SESSION['alert'];?>"><?php echo $_SESSION['msg']?></div>
                   <?php }?>  

                <div class="box clearfix">
                    <div class="desc">
                        <h3>New Arrival</h3>
                        <p>Manage date range.</p>
                    </div>
                    <div class="content">
                        <ul class="field-set">
                            <li class="field field-select hidden">
                                <label for="category">Sale type <span>*</span></label>
                                <select class="input-select" id="sale_option" name="category" onchange="textIDR()">
                                    <option selected value="2">Discount by Amount</option>
                                    <option value="1">Discount by Percentage</option>
                                </select>
                            </li>
                            <li class="field hidden">
                                <label for="brand" id="text_by">Discount (IDR) <span>*</span></label>
                                <input type="text" class="input-text" style="width: 300px" id="id_amount_discount" onKeyUp="numbers()" name="promo_value">
                            </li>
                            <li class="field-divider hidden"></li>
                            <li class="field clearfix" style="margin-bottom: 0">
                                <label for="category">Date range <span>*</span></label>
                                <div class="report-filter clearfix fl">
                                    <input type="text" class="input-text fl" placeholder="Date from" style="width: 135px" id="id_date_from" name="date_from">
                                    
                                    <p class="fl" style="margin-right: 2px; margin-left: 3px">to</p>
                                    <input type="text" class="input-text fl" placeholder="Date to" style="width: 135px" id="id_date_to" name="date_to">
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                </div><!--box-->

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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0">
                        <thead>
                            <tr class="headings">
                                <th width="20"></th>
                                <th class="sort" width="420" onclick="sortBy('product_name')">Item <?php echo $arr_product_name;?></th>
                                <th class="sort" width="130" onclick="sortBy('type_name')">Variants <?php echo $arr_type_name;?></th>
                                <th class="sort" width="100" onclick="sortBy('type_price')">Price <?php echo $arr_type_price;?></th>
                                <th class="sort" width="290" onclick="sortBy('type_new_arrival')">New Arrival <?php echo $arr_promo_value;?></th>
                            </tr>
                            <tr class="filter">
                                <th><a href="<?php echo $prefix_url."new-arrival";?>"><input type="button" class="btn small reset <?php echo $reset;?>" value=""></a></th>
                                <th><input type="text" class="input-text" id="product_name_search" onkeyup="searchQuery('product_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "product_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                                <th><input type="text" class="input-text" id="type_name_search" onkeyup="searchQuery('type_name')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "type_name"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                                <th><input type="text" class="input-text" id="type_price_search" onkeyup="searchQuery('type_price')" onkeypress="return disableEnterKey(event)" <?php if($_REQUEST['src'] == "type_price"){ echo "value=\"".str_replace('\\', '/', $_REQUEST['srcval'])."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled";}?>></th>
                                <th>
                                    <select class="input-select" id="type_new_arrival_search" onchange="searchQueryOption('type_new_arrival')" <?php if($_REQUEST['src'] == "type_new_arrival"){ echo "value=\"".$_REQUEST['srcval']."\"";}else if(!empty($_REQUEST['src'])){ echo "disabled=\"disabled\"";}?>>
                                        <option></option>
                                        <option value="1">New Arrival</option>
                                        <option value="0">Regular</option>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody onload="loading()">
                            <!--<div id="loading" style="position: absolute; z-index: 2; background: #000; width: 940px; height: 200px"></div>-->
                            <?php if($total_query < 1){?><tr><td class="no-record" colspan="8">No records found.</td></tr><?php }?>
                            <?php
							$record = 1;
                            $row = 1;
                            foreach($all_product as $sale){
							   
							   if($record % 2 == 0){
							      $tr_class = "even";
							   }else{
							      $tr_class = "odd";
							   }
							   
							   $promotions = get_promotions($sale['type_id']);
							   
							?>
                            
                            <tr class="<?php echo $tr_class;?>" id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                                <td><input type="checkbox" name="type_id[]" value="<?php echo $sale['id'];?>" id="<?php echo "check_".$row?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')"></td>
                                <td><a href="<?php echo $prefix_url."/product-details-".$sale['product_alias'];?>"><?php echo $sale['product_name'];?></a></td>
                                <td><?php echo $sale['type_name'];?></td>
                                <td class="tr"><?php echo price($sale['type_price']);?></td>
                                <td style="position: relative">
                                <?php
								if($sale['type_new_arrival'] != 0){
									
								   $today      = current_date_sql();
								
								   $duration   = get_sale_time($promotions['new_end'], $promotions['new_start']);
								   $left       = get_sale_time($promotions['new_end'], $today);
								
								   $first      = get_sale_time($today, $promotions['new_start']);
								   $last       = get_sale_time($today, $promotions['new_end']);
								
								   if($first['left_days'] > 0){
								       
								      if($left['left_days'] > 0){
										  
								         // LEFT DAYS
								         $days_left = $left['left_days']. " day(s) more";
										 
									  }else{
										  
								         // DURATION
								         $days_left = $duration['left_days']. " day(s)";
										 
									  }
								   
								   }else{
								       
									   if($last['left_days'] > 0){
									      
										  // LEFT DAYS
									      $days_left = $left['left_days']. " day(s) more";
									   
									   }else{
									      // DURATION
									      $days_left = $duration['left_days']. " day(s)";
									   }
									   
								   }
								?>
                                
                                <div id="ajax_remove_wrapper_<?php echo $sale['type_id']?>">
                                
                                   <b class="hidden"><?php echo $suffix;?> OFF</b>
                                   <p style="color: #999"><?php echo format_date_min($promotions['new_start'])." - ".format_date_min($promotions['new_end']);?></p>
                                   <p style="color: #cc0000"><?php echo $days_left;?></p>
                                   <div class="btn red row" style="position: absolute; right: 5px; top: 20px" onclick="ajxRemoveSale(<?php echo $sale['type_id'];?>)">Remove</div>
                                   
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
                </div><!--table-wrapper-->

            </div><!--main-content-->

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


function validateNew(){
   var amount = $('#id_amount_discount').val();
   var from   = $('#id_date_from').val();
   var to     = $('#id_date_to').val();
   var nonum  = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/
   var type   = $('#sale_option :selected').val();
   
   if(from == ""){
      $('#id_date_from').addClass("empty");
   }else if(to == ""){
	  $('#id_date_to').addClass("empty");
   }else{
      $('#id_btn_submit_new_arrival').click();
   }
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
				url: "custom/new_arrival/ajax_remove.php",
				data: {itemID:itemID},
				error: function(jqXHR, textStatus, errorThrown) {
					   
					   }
			 }).done(function(data) {
		        $('#ajax_remove_wrapper_'+i).addClass("hidden");
				$('.table-wrapper').find(':checkbox').each(function() {
                   $(this).attr('checked', false);
                });
				
			 });
}

</script>

<?php
if($_POST['btn_submit_new_arrival'] == ""){
   unset($_SESSION['alert']);
   unset($_SESSION['msg']);
}
?>

            