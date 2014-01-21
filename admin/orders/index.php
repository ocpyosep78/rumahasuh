<?php
include("control.php");
include("custom/orders/control.php");
?>

<form name="index-order" method="post" enctype="multipart/form-data">


    <div class="subnav clearfix">
      <div class="container clearfix">
        <h1><span class="glyphicon glyphicon-inbox"></span> &nbsp;Orders</h1>
        <div class="btn-placeholder">
          <input type="button" class="btn btn-success btn-sm" value="Place Order" name="order-index">
        </div>
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
            <select class="form-control" name="option-action" id="news-action" onchange="changeOption()">
              <option value="delete">Delete</option>
              <option value="change">Set Status</option>
            </select>
            <p id="lbl-news-option" class="hidden">to</p>
            <select class="form-control" name="option-status" id="news-option" disabled="disabled" class="hidden">
              <option></option>
              <option disabled>Payment</option>
              <option value="Unpaid">&nbsp;Unpaid</option>
              <option value="Confirmed" disabled="disabled">&nbsp;Confirmed</option>
              <option value="Paid">&nbsp;Paid</option>
              <option disabled></option>
              <option disabled>Fulfillment</option>
              <!--<option value="Unfulfilled">&nbsp;Unfulfilled</option>-->
              <option value="In Process">&nbsp;In Process</option>
              <option value="Delivered" disabled="disabled">&nbsp;Delivered</option>
              <option disabled></option>
              <option disabled>Order</option>
              <option value="Unfulfilled">&nbsp;Active</option>
              <option value="In Process">&nbsp;Expired</option>
              <option value="Delivered">&nbsp;Cancelled</option>
            </select>
            <input type="submit" class="btn btn-success pull-left" name="index-order" value="GO">
          </div>
        </div><!--actions-->

          <table class="table">
            <thead>
              <tr class="headings">
                  <th width="20"><span id="eyeopen" class="glyphicon glyphicon-eye-open" onclick="showEye()"></span></th>
                  <th class="sort" width="80" onclick="sortBy('order_number')"> Order # <?php echo $arr_order_number;?></th>
                  <th class="sort" width="120" onclick="sortBy('order_date')">Date <?php echo $arr_order_date;?></th>
                  <th class="sort" width="190" onclick="sortBy('order_confirm_name')">Customer <?php echo $arr_confirm_name;?></th>
                  <th class="sort" width="170" onclick="sortBy('order_confirm_bank')">Payment Method <?php echo $arr_confirm_bank;?></th>
                  <th class="sort" width="80"  onclick="sortBy('order_confirm_amount')">Amount <?php echo $arr_confirm_amount;?></th>
                  <th class="sort" width="100" onclick="sortBy('payment_status')">Payment <?php echo $arr_payment_status;?></th>
                  <th class="sort" width="100" onclick="sortBy('fulfillment_status')">Fulfillment <?php echo $arr_fulfillment_status;?></th>
              </tr>
              <tr class="filter hidden" id="filter">
                <th><a href="<?php echo $prefix_url."order"?>"><button type="button" style="width: 100%;" class="btn btn-danger btn-xs reset <?php echo $reset;?>" value=""><span class="glyphicon glyphicon-remove"></span></button></a></th>
                <th><input type="text" class="form-control" id="order_number_search" onkeyup="searchQuery('order_number')" onkeypress="return disableEnterKey(event)" <?php order_disabling_search($_REQUEST['src'], order_number);?>></th>
                <th><input type="text" class="form-control" id="order_date_search" onkeyup="searchQuery('order_date')" onkeypress="return disableEnterKey(event)" <?php order_disabling_search($_REQUEST['src'], order_date);?>></th>
                <th><input type="text" class="form-control" id="order_billing_fullname_search" onkeyup="searchQuery('order_billing_fullname')" onkeypress="return disableEnterKey(event)" <?php order_disabling_search($_REQUEST['src'], order_billing_fullname);?>></th>
                <th>
                  <select class="form-control" id="order_payment_method_search" onchange="searchQueryOption('order_payment_method')" <?php order_disabling_search($_REQUEST['src'], order_payment_method);?>>
                    <option value="All"></option>
                    <option value="BCA" <?php if($search == "order_confirm_bank=bca"){ echo 'selected="selected"';}?>>Bank Transfer via BCA</option>
                    <option value="Mandiri" <?php if($search == "order_confirm_bank=mandiri"){ echo 'selected="selected"';}?>>Bank Transfer via Mandiri</option>
                    <option value="Credit Card" <?php if($search == "order_confirm_bank=credit card"){ echo 'selected="selected"';}?>>Credit Card</option>
                    <option value="Paypal" <?php if($search == "order_confirm_bank=paypal"){ echo 'selected="selected"';}?>>PayPal</option>
                    <option value="COD" <?php if($search == "order_confirm_bank=cod"){ echo 'selected="selected"';}?>>Cash on Delivery</option>
                  </select>
                </th>
                <th><input type="text" class="form-control" id="order_total_amount_search" onkeyup="searchQuery('order_total_amount')" onkeypress="return disableEnterKey(event)" disabled></th>
                <th>
                  <select class="form-control" id="payment_status_search" onchange="searchQueryOption('payment_status')" <?php order_disabling_search($_REQUEST['src'], payment_status);?>>
                    <option value="All"></option>
                    <option value="Unpaid" <?php if($get_last_char_payment_status == "Unpaid"){ echo 'selected="selected"';}?>>Unpaid</option>
                    <option value="Confirmed" <?php if($get_last_char_payment_status == "Confirmed"){ echo 'selected="selected"';}?>>Confirmed</option>
                    <option value="Paid" <?php if($get_last_char_payment_status == "Paid"){ echo 'selected="selected"';}?>>Paid</option>
                  </select>
                </th>
                <th>
                  <select class="form-control" id="fulfillment_status_search" onchange="searchQueryOption('fulfillment_status')" <?php order_disabling_search($_REQUEST['src'], fulfillment_status);?>>
                    <option value="All"></option>
                    <option value="Unfulfilled" <?php if($get_last_char_fulfillment_status == "Unfulfilled"){ echo 'selected="selected"';}?>>Unfulfilled</option>
                    <option value="In Process" <?php if($get_last_char_fulfillment_status == "In Process"){ echo 'selected="selected"';}?>>In Process</option>
                    <option value="Partial" <?php if($get_last_char_fulfillment_status == "Partial"){ echo 'selected="selected"';}?>>Partial</option>
                    <option value="Delivered" <?php if($get_last_char_fulfillment_status == "Fulfilled"){ echo 'selected="selected"';}?>>Delivered</option>
                    <!--<option value="Cancelled" <?php if($get_last_char_fulfillment_status == "Cancelled"){ echo 'selected="selected"';}?>>Cancelled</option>
                    <option value="Expired" <?php if($get_last_char_fulfillment_status == "Expired"){ echo 'selected="selected"';}?>>Expired</option>-->
                  </select>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php if($total_query < 1){?><tr><td class="no-record" colspan="8">No records found.</td></tr><?php }?>
              
              <?php			
			  $row=0;
			  foreach( $listing_order as $all_orders){
			     $row++;
				 
				 // Format date
				 $order_date = format_date($all_orders['order_date']);
				 
				 // Capitalizing Bank Name
				 $order_confirm_bank = capitaling_bank_name($all_orders['order_confirm_bank']);
				 
				 // Styling payment status block
				 $payment_status = payment_status_flag($all_orders['payment_status']);
				 
				 // Styling fulfillment status block
				 $fulfillment_status = fulfillment_status_flag($all_orders['fulfillment_status']);
			  ?>
              
              <tr id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                <td><input type="checkbox" name="checkbox[]" id="<?php echo "check_".$row?>" value="<?php echo $all_orders['order_id'];?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')"></td>
                <td><a href="<?php echo $prefix_url."order-detailing/".$all_orders['order_number'];?>" title="<?php echo "Go to ".$all_orders['order_number']." detail";?>"><?php echo $all_orders['order_number'];?></a></td>
                <td><?php echo format_date($all_orders['order_date']);?></td>
                <td><?php echo $all_orders['order_billing_fullname'];?></td>
                <td><?php echo $all_orders['order_payment_method'];?>
                  <?php if(strtolower($all_orders['payment_status']) == "confirmed"){?>
                  <div class="payment-notes">
                    Bank Transfer via <?php echo $all_orders['order_confirm_bank']?><br/>
                    <?php echo $all_orders['order_confirm_name'];?><br/>
                    IDR <?php echo price($all_orders['order_confirm_amount']);?>
                  </div>
                  <?php }?>
                </td>
                <td class="tr"><?php echo price($all_orders['order_total_amount']);?></td>
                <td><div class="<?php echo $payment_status;?>"><?php echo $all_orders['payment_status'];?></div></td>
                <td><div class="<?php echo $fulfillment_status?>"><?php echo $all_orders['fulfillment_status'];?></div></td>
              </tr>
              
              <?php }?>
                
            </tbody>
          </table>

        </div><!--content-->
      </div><!--box row-->

    </div><!--container main-->
            
</form>
            
<script>
$('#order_payment_method_search option[value=<?php echo $search_value?>]').attr('selected', 'selected');
$('#payment_status_search option[value=<?php echo $search_value?>]').attr('selected', 'selected');
$('#fulfillment_status_search option[value=<?php echo $search_value?>]').attr('selected', 'selected');


$(function() {
   $("#order_date_search").datepicker({
      altField:'#order_date_search',
	  altFormat: "yy/mm/dd",
	  onSelect: function () {
	     document.all ? $(this).get(0).fireEvent("onchange") : $(this).change();
         searchQueryOption('order_date');
      },
   });
});

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

$(document).ready(function() {
   changeOption();
});
</script>

<?php include("custom/orders/index.php"); ?>