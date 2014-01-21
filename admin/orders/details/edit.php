<?php
include("get.php");
include("update.php");
include("control.php");
include("ajax.php");
?>



     <form method="post" enctype="multipart/form-data">
		

            <div class="sub-header clearfix">
                <div class="content">
                    <h2>Order # <span class="info"><?php echo $order_detail['order_number'];?></span></h2>
                    <div class="btn-placeholder">
                        <!--
                        <input type="button" class="btn grey main" value="Cancel">
                        <input type="button" class="btn green main" value="Save Changes">
                        -->
                        <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/order-detailing/".$order_detail['order_number'];?>">
                           <input type="button" class="btn grey main" value="Cancel" name="btn-order-detail">
                        </a>
                        <input type="submit" class="btn green main" value="Save Changes" name="btn-order-detail">
                    </div>
                </div>
            </div>

            <?php edit_mode();?>

            <div id="main-content">

                <div class="clearfix">

                    <div class="box clearfix fr" style="width: 30%; height: 215px">
                        <div class="content" style="margin-left: 0; width: 232px">
                            <ul class="field-set">
                                <li class="field clearfix" style="border-bottom: 1px solid #eee; margin-bottom: 15px; padding-bottom: 8px">
                                    <h4><a href=""><?php echo $order_detail['order_confirm_name'];?></a></h>
                                    <p style="color: #999; padding-top: 0"><a href="mailto:info@antikode.com"><?php echo $order_detail['user_email'];?></a></p></p>
                                </li>
                                <li class="field">
                                    <label for="page-description" style="width: 50px; color: #999">Ship to</label>
                                    <p class="hidden">Address 1</p>
                                    <select type="text" class="input-select" style="width: 182px">
                                        <option>Address 1</option>
                                    </select>
                                </li>
                                <li><?php echo preg_replace("/\n/","\n<br>",$order_detail['order_shipping_address']);?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="box clearfix fl" style="width:640px; height: 215px">
                    
                        <div class="desc">
                            <h3>Payment</h3>
                            <p>Payment status:</p>
                            
                            <div class="<?php echo $flag_payment_status;?>" style="margin-top: 10px"><?php echo $order_detail['payment_status'];?></div>
                        </div>
                        <div class="content" style="width: 400px">
                            <div class="btn-placeholder" style="position: absolute; top: 20px; right: 15px; z-index:2;">
                               
                               <?php if($order_detail['payment_status'] == "Confirmed"){?>
                               <input type="submit" class="btn green main" value="Mark as Paid" name="btn-order-detail">
                               <?php }?>
                               
                            </div>
                            <ul class="field-set">
                                <li class="field clearfix" style="border-bottom: 1px solid #eee; margin-bottom: 15px; padding-bottom: 20px">
                                    <label for="url-handle" style="width: 120px">Amount Due</label>
                                    <p><b><?php echo price($order_detail['order_total_amount']);?></b></p>
                                </li>
                                <li class="field">
                                    <label for="page-description" style="width: 120px">Payment method</label>
                                    <p class="hidden">Bank Transfer via BCA</p>
                                    <select type="text" class="input-select" style="width: 280px" name="order_confirm_bank">
                                        <option value="0">Order Confirm Bank</option>
                                        <option <?php if($order_detail['order_confirm_bank'] == "BCA"){ echo "selected=\"selected\"";}?> value="BCA">Bank Transfer via BCA</option>
                                        <option <?php if($order_detail['order_confirm_bank'] == "Mandiri"){ echo "selected=\"selected\"";}?> value="Mandiri">Bank Transfer via Mandiri</option>
                                        <option <?php if($order_detail['order_confirm_bank'] == "BRI"){ echo "selected=\"selected\"";}?> value="BRI">Bank Transfer via BRI</option>
                                        <option <?php if($order_detail['order_confirm_bank'] == "BII"){ echo "selected=\"selected\"";}?> value="BII">Bank Transfer via BII</option>
                                        <option <?php if($order_detail['order_confirm_bank'] == "Paypal"){ echo "selected=\"selected\"";}?> value="Paypal">Paypal</option>
                                        <option <?php if($order_detail['order_confirm_bank'] == "Credit Card"){ echo "selected=\"selected\"";}?> value="Credit Card">Credit Card</option>
                                        <option <?php if($order_detail['order_confirm_bank'] == "COD"){ echo "selected=\"selected\"";}?> value="COD">Cash On Delivery</option>
                                    </select>
                                </li>
                                <li class="field clearfix">
                                    <label for="url-handle" style="width: 120px">Account name</label>
                                    <p class="hidden"><?php echo $order_detail['order_confirm_name'];?></p>
                                    <input type="text" class="input-text url " value="<?php if(!empty($order_detail['order_confirm_name'])){ echo $order_detail['order_confirm_name'];}?>" placeholder="<?php echo ucwords(strtolower($order_detail['order_billing_fullname']));?>" style="width: 280px" name="order_confirm_name">
                                </li>
                                <li class="field clearfix">
                                    <label for="url-handle" style="width: 120px">Amount</label>
                                    <p class="hidden" style="color: #cf4f4f"><?php echo $order_detail['order_confirm_amount'];?></p>
                                    <input type="text" class="input-text url " value="<?php if(!empty($order_detail['order_confirm_amount'])){ echo price($order_detail['order_confirm_amount']);}?>" style="width: 280px" name="order_confirm_amount" placeholder="<?php echo "IDR ".price($order_detail['order_total_amount']);?>" id="pricing" onkeyup="number()">
                                </li>
                                
                                <input type="hidden" class="input-text url" id="tester" name="backup_order_confirm_amount">
                                
                                <script>
								$(document).ready(function(e) {
                                   $('#tester').val($('#pricing').val().replace(/\./g, ''));
                                });
								
								function number(){
								   var tester = $('#pricing').val();
								   
								   $('#tester').val(tester.replace(/\./g, ''));
							    }
								</script>
                                
                            </ul>
                        </div>
                    </div>

                </div>
                
                <!--Order Item-->

                <div class="box clearfix">
                    <div class="desc">
                        <h3>Fulfillment</h3>
                        <p>Fulfillment status:</p>
                        
                        <div class="<?php echo $flag_fulfillment_status;?>" style="margin-top: 10px"><?php echo $order_detail['fulfillment_status'];?></div>
                    </div>
                    <div class="content">
                        <div class="btn-placeholder" style="position: absolute; top: 20px; right: 20px; z-index:2;">
                            <!--<input type="button" class="btn green main" value="Deliver 2 Items">-->
                            <!--<input type="submit" class="btn green main" value="Deliver Item(s)" name="btn-order-detail">-->
                        </div>
                        <ul class="field-set">
                            <li class="field clearfix" style="border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 15px">
                                <label for="url-handle">Shipping preference</label>
                                <!--<p><?php echo $order_detail['shipping_method'];?></p>-->
                                <select type="text" class="input-select">
                                    <option>JNE Regular</option>
                                    <option>JNE Express</option>
                                </select>
                            </li>
                        </ul>
                        
                            <table cellpadding="0" cellspacing="0" class="basket">
                                <thead>
                                    <tr>
                                        <th class="extrasmall"></th>
                                        <th class="large">Item(s)</th>
                                        <th class="medium">Price</th>
                                        <th class="small">Qty.</th>
                                        <th class="medium">Total</th>
                                        <th class="small"></th>
                                    </tr>
                                </thead>
                                <tbody class="basket-data">
                                
                                <?php
								$row=0;
								foreach ($order_item as $order_item){
								   $row++;
								   
								   $day   = substr($order_item['fulfillment_date'],8,2);
								   $month = substr($order_item['fulfillment_date'],5,2);
								   $year  = substr($order_item['fulfillment_date'],0,4);
								   
								   $get_fulfillment_date = $day." ".date("M", mktime(0, 0, 0, $month, $day, $year))." ".$year;
							   ?>
                                
                                    <tr class="<?php if($order_item['fulfillment_date'] != "0000-00-00 00:00:00"){ echo "disabled";}?>" id="<?php echo "row_".$row?>" <?php if($order_item['fulfillment_date'] == "0000-00-00 00:00:00"){?>onclick="selectRow('<?php echo $row;?>')"<?php }?>>
                                        <td>
                                           <!--<input type="checkbox" checked disabled>-->
                                           <input type="checkbox" name="item_id[]" disabled="disabled" <?php if($order_item['fulfillment_date'] != "0000-00-00 00:00:00"){ echo "checked=\"checked\"";}?> value="<?php echo $order_item['item_id']?>" id="<?php echo "check_".$row?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')">
                                           <input type="hidden" name="order_id" value="<?php echo $order_item['order_id']?>" class="hidden">
                                        </td>
                                        <td class="large">
                                            <img src="<?php echo $prefix_url."../".$order_item['img_src'];?>" width="80" height="60">
                                            <div class="data">
                                                <div class="name"><a href=""><?php echo $order_item['product_name'];?></a></div>
                                                <div class="attribute"><?php echo $order_item['type_name'];?></div>
                                                <div class="attribute">XS</div>
                                                <div class="courier">
                                                    <b><?php echo $order_item['shipping_method'];?></b> 
                                                    #<?php echo $order_item['shipping_number'];?><br>
                                                    <?php if($order_item['fulfillment_date'] == "0000-00-00 00:00:00" ){ echo "N/A";}else{ echo format_date($product['fulfillment_date']);}?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="medium">
                                            <p class="currency">IDR</p>
                                            
                                            <?php if($order_item['item_discount_price'] == "0"){?>
                                            <p class="amount"><?php echo price($order_item['item_price']);?></p>
                                            <?php }else{?>
                                            <p class="amount"><?php echo "<strike>".price($order_item['item_price'])."</strike>";?></p>
                                            <p class="amount"><?php echo price(($order_item['item_price'] - $order_item['item_discount_price']));?></p>
                                            <?php }?>
                                            
                                        </td>
                                        <td class="small">
                                            <div class="outer-center">
                                                <div class="inner-center">
                                                
                                                    <?php if($order_item['fulfillment_date'] == "0000-00-00 00:00:00"){?>
                                                    <input type="text" class="input-text basket-qty" value="<?php echo $order_item['item_quantity'];?>" name="item_quantity[]">
                                                    <?php 
													}else{
													   echo "<p>".$order_item['item_quantity']."</p>";
													}
													?>
													<input type="hidden" class="input-text basket-qty" value="<?php echo $order_item['item_id'];?>" name="item_id_quantity[]">

                                                </div>
                                            </div>
                                        </td>
                                        <td class="medium">
                                        
                                        <?php
										$order_item_total_per_item = $order_item['item_price'] * $order_item['item_quantity'];
										$order_item_total_per_item_discount = ($order_item['item_price'] - $order_item['item_discount_price']) * $order_item['item_quantity'];
										$order_item_discount_total_per_item = $order_item['item_discount_price'] * $order_item['item_quantity'];
										?>
                                        
                                            <p class="currency">IDR <?php echo $order_detail['order_detail'];?></p>
                                            <p class="amount"><?php echo price($order_item_total_per_item_discount);?></p>
                                        </td>
                                    </tr>
                                    
                                    
                                    
                                <?php 
								if($_POST['btn-order-detail'] == "Deliver Item(s)"){
								   db_update_deliver_1($order_item['order_id']);
								   db_update_deliver_2($set_fulfilment_date, $order_item['order_id']);
                                   $order_item = order_item($order_detail['order_id']);
								}
								
								$sub_total += $order_item_total_per_item;
								$sub_total_discount += $order_item_discount_total_per_item;
								}
								?>
                                
                                </tbody>
                            </table><!--basket-->
                            <div class="basket-totals" style="border-bottom: 1px solid #ddd">
                                <div class="row clearfix">
                                    <div class="title">Subtotal</div>
                                    <div class="content">
                                        <p class="currency">IDR</p>
                                        <p class="amount"><?php echo price($sub_total);?></p>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="title">Discount</div>
                                    <div class="content">
                                        <p class="currency">IDR</p>
                                        <p class="amount"><?php echo "- ".price($sub_total_discount);?></p>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="title">Shipping</div>
                                    <div class="content">
                                        <p class="currency">IDR</p>
                                        <p class="amount"><?php echo price($order_detail['order_shipping_amount']);?></p>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                
                                <?php $total_order_amount = $sub_total + (-$sub_total_discount) + $order_detail['order_shipping_amount'];?>
                                
                                    <div class="title">Total</div>
                                    <div class="content">
                                        <p class="currency">IDR</p>
                                        <p class="amount"><b><?php echo price($total_order_amount);?></b></p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!--box-->

            </div><!--main-content-->
