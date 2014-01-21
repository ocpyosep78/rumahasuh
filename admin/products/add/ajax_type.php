<?php
	include("../../custom/static/general.php");
	include('../../static/general.php');
	include("get.php");
	$data = $_POST["data"];
	
	//var_dump($data);
	$i = $_POST["i"];
	
	// Color
	$all_color_group = get_all_color_group();
	
	$conn = connDB();
	
	
	//!new type
?>

          <ul class="form-set" id="type_group_<?php echo $i;?>">
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="color">Color Group</label>
              <div class="col-xs-9">
                <select class="form-control" id="color_id_<?php echo $i;?>" name="color_id[<?php echo $i;?>]" onchange="changeColor(<?php echo $i;?>)">
                  <option value="No Color">-- Select Color Group --</option>
                    <?php 
                    foreach($all_color_group as $all_color_group){
                      echo "<option value=\"".$all_color_group['color_id']."\">".$all_color_group['color_name']."</option> \n";
                      echo "\n";
                    }
                    ?>
                </select>
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="color-name">Color Name</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" id="type_name_<?php echo $i;?>" name="type_name[<?php echo $i;?>]">
                <p class="help-block">Color name variants that belongs to the color group, e.g. Light Grey, Dark Grey</p>
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="sku">SKU <span class="info">(Stock Keeping Unit)</span></label>
              <div class="col-xs-9">
                <input type="text" class="form-control" id="type_code_<?php echo $i;?>" name="type_code[<?php echo $i;?>]">
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="price">Price</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" id="type_price_<?php echo $i;?>" name="type_price[<?php echo $i;?>]" value="<?php echo $data['price'];?>">
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="product-desc">Product Description</label>
              <div class="col-xs-9">
                <textarea class="form-control" rows="5" id="type_description_<?php echo $i;?>" name="type_description[<?php echo $i;?>]"><?php echo $data['desc'];?></textarea>
              </div>
            </li>
            <li class="form-group row image-placeholder">
              <label class="col-xs-3 control-label">Images</label>
              <div class="col-xs-9">
                <div class="row">
                  <?php for($j=0;$j<5;$j++){?>
                  <div class="col-xs-2 image" onclick="openBrowser('<?php echo $i.'-'.$j;?>')" onmouseover="imageOver('<?php echo $i.'-'.$j;?>')" onMouseOut="imageOut('<?php echo $i.'-'.$j;?>')">
                    <div class="content img-prod-size"> 
                      <div>
                        <div class="image-delete hidden" id="image-<?php echo $i.'-'.$j;?>-delete" onclick="deleteImage('<?php echo $i.'-'.$j;?>','<?php echo $i;?>','<?php echo $j;?>'); event.preventDefault();" onmouseover="deleteOver()" onmouseout="deleteOut()"><span class="glyphicon glyphicon-remove"></span></div>
                        <div class="image-overlay"></div>
                      </div>
                      <img class="hidden" id="upload-image-<?php echo $i.'-'.$j;?>" src="<?php echo $prefix;?>files/common/img_product-1.jpg">
                      <div class="hidden" id="product-<?php echo $i.'-'.$j;?>-image-wrap">
                        <input type="file" name="product_image[<?php echo $i;?>][<?php echo $j;?>]" id="product-<?php echo $i.'-'.$j;?>-image" onchange="readURL(this,'<?php echo $i.'-'.$j;?>')" class="hidden"/>
                      </div>
                      <input type="hidden" name="image_id[<?php echo $i;?>][<?php echo $j;?>]" value="" />
                      <input type="hidden" name="image_delete[<?php echo $i;?>][<?php echo $j;?>]" id="image-delete-<?php echo $i.'-'.$j;?>" value="0" />
                    </div>
                  </div>
                  <?php 
                  }
                  ?>
                </div>
                <p class="help-block">Recommended dimensions of 500 x 750 px.</p>
              </div>
            </li>

            <div id="product_stock_list_<?php echo $i;?>">
            </div>

            <li class="form-group row">
              <label class="col-xs-3 control-label" for="weight">Weight <span class="info">(in kg)</span></label>
              <div class="col-xs-2">
                <input type="text" class="form-control" id="type_weight_<?php echo $i;?>" name="type_weight[<?php echo $i;?>]" placeholder="0" value="<?php echo $data['weight'];?>">
              </div>
            </li>
            <li class="form-group clearfix underlined">
              <button type="button" class="btn btn-danger btn-sm pull-right" onclick="deleteType(<?php echo $i;?>)">Remove Variant</button>
            </li>
            <input type="hidden" name="type_delete[<?php echo $i;?>]" id="type_delete_<?php echo $i;?>" value='0'/>
              <?php for ($j=0;$j<5;$j++){?>
                <input type="hidden" name="order[<?php echo $i;?>][<?php echo $j;?>]" id="order_<?php echo $i;?>_<?php echo $i;?>" value="<?php echo $j;?>" />
              <?php 
              } 
              ?>
          </ul><!--form-set-->

	<!--<ul class="form-set" id="type_group_<?php echo $i;?>">
                            <li class="field-divider"></li>
                            <li class="field field-select">
                                <label for="color">Color Group <span>*</span></label>
                                <select class="input-select" id="color_id_<?php echo $i;?>" name="color_id[<?php echo $i;?>]" onchange="changeColor(<?php echo $i;?>)" >
                                   
                                   <?php 
								   foreach($all_color_group as $all_color_group){
								      echo "<option value=\"".$all_color_group['color_id']."\">".$all_color_group['color_name']."</option> \n";
									  echo "\n";
                                   }
								   ?>
                                   
                                
                                </select>
                                
                                <div class="btn row grey hidden">+</div>
                            </li>
                            <li class="field">
                                <label for="color-name">Color Name</label>
                                <input type="text" class="input-text" id="type_name_<?php echo $i;?>" name="type_name[<?php echo $i;?>]">
                            </li>
                            <li class="field">
                                <label for="sku">SKU</label>
                                <input type="text" class="input-text" id="type_code_<?php echo $i;?>" name="type_code[<?php echo $i;?>]">
                            </li>
                            <li class="field">
                                <label for="price">Price <span>*</span></label>
                                <input type="text" class="input-text" id="type_price_<?php echo $i;?>" name="type_price[<?php echo $i;?>]" value="<?php echo $data['price'];?>">
                                <p class="field-message">Excluding tax</p>
                            </li>
                            <li class="field">
                                <label for="product-desc">Product Description</label>
                                <textarea rows="5" id="type_description_<?php echo $i;?>" name="type_description[<?php echo $i;?>]"><?php echo $data['desc'];?></textarea>
                                <p class="field-message error hidden">Content required</p>
                            </li>
                            
                            
                            

                            <li class="field input-file clearfix">
                                <label for="xxxx">Main Image</label>
                                <div class="clearfix" style="width: 550px; padding-bottom: 8px">
                                
                                <?php for($j=0;$j<5;$j++){?>
                                
                                    <div class="fl image" style="width: 100px; height: 150px" onclick="openBrowser('<?php echo $i.'-'.$j;?>')" onmouseover="imageOver('<?php echo $i.'-'.$j;?>')" onMouseOut="imageOut('<?php echo $i.'-'.$j;?>')">
                                                     <div class=""><div class="image-delete hidden" id="image-<?php echo $i.'-'.$j;?>-delete" onclick="deleteImage('<?php echo $i.'-'.$j;?>','<?php echo $i;?>','<?php echo $j;?>'); event.preventDefault();" onmouseover="deleteOver()" onmouseout="deleteOut()"></div><div class="image-overlay"></div></div>

                                                     <img class="hidden" id="upload-image-<?php echo $i.'-'.$j;?>" src="<?php echo $prefix;?>files/common/sample_product.jpg">
                                        <div class="hidden" id="product-<?php echo $i.'-'.$j;?>-image-wrap">
                                        	<input type="file" name="product_image[<?php echo $i;?>][<?php echo $j;?>]" id="product-<?php echo $i.'-'.$j;?>-image" onchange="readURL(this,'<?php echo $i.'-'.$j;?>')" class="hidden"/>
                                        </div>
                                        <input type="hidden" name="image_id[<?php echo $i;?>][<?php echo $j;?>]" value="" />
                                        <input type="hidden" name="type_delete[<?php echo $i;?>]" id="type_delete_<?php echo $i;?>" value='0'/>
                                    </div>
                                    
                                    
                                    
                                <?php }?>
                                
                                </div>
                                
                               <p class="field-message" style="padding-top: 10px">Recommended dimensions of 500 x 750 px.</p>
                            </li>
                            
                            <div id="product_stock_list_<?php echo $i;?>">
                            	
                            </div>
                            
                            
                            <li class="field">
                                <label for="weight">Weight <span>*</span></label>
                                <input type="text" class="input-text" id="type_weight_<?php echo $i;?>" name="type_weight[<?php echo $i;?>]" placeholder="0" style="width:90px; text-align:right" value="<?php echo $data['weight'];?>" >
                            </li>
                            <li class="clearfix"><div class="btn-placeholder"><input type="button" class="btn red main" value="Remove Variant" onclick="deleteType(<?php echo $i;?>)"></div></li>
                             
                            <input type="hidden" name="type_delete[<?php echo $i;?>]" id="type_delete_<?php echo $i;?>" value='0'/>
                            
                            <?php for ($j=0;$j<5;$j++){?>
	                            <input type="hidden" name="order[<?php echo $i;?>][<?php echo $j;?>]" id="order_<?php echo $i;?>_<?php echo $i;?>" value="<?php echo $j;?>" />
	                            
	                        <?php
                            }
                            ?>
                        </ul>-->
                        
                        
          <!-- !for the next one -->
          <?php $i++;?>
          <div class="form-set hidden" id="field_<?php echo $i;?>"></div>
	
