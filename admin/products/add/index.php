<?php
include("control.php");
include("custom/products/add/control.php");
?>

<form name="index-order" method="post" action="" enctype="multipart/form-data" >

    <div class="subnav">
      <div class="container clearfix">
        <h1><span class="glyphicon glyphicon-tag"></span> &nbsp; <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/product"?>">Products</a> <span class="info">/</span> Add Product</h1>
        <div class="btn-placeholder">
          <a class="btn btn-default btn-sm" href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/product"?>">Cancel</a>
          <input type="submit" class="btn btn-success btn-sm" value="Save Changes" name="add-product" >
          <input type="submit" class="btn btn-success btn-sm" value="Save Changes &amp; Exit" name="add-product">
        </div>
      </div>
    </div>

    <div class="alert alert-success">
      <div class="container">
        <strong>Error!</strong> Best check yo self, you're not looking too good.
      </div>
    </div>

    <div class="container main" class="products">

      <div class="box row">
        <div class="desc col-xs-3">
          <h3>Basic Details</h3>
          <p>Basic details of your product</p>
        </div>
        <div class="content col-xs-9">
          <ul class="form-set">
            <li class="form-group row underlined">
              <label class="col-xs-3 control-label" for="product_name">Product Name</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" id="product_name" name="product_name" onchange="getAlias()">
                <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id;?>">
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="category">Category</label>
              <div class="col-xs-9">
                <select class="form-control" id="product_category" name="product_category">
                  <option value="">-- Select Category --</option>
                    <?php 
                    foreach($all_category as $all_category_){
                    echo "<option value=\"".$all_category_['category_id']."\">".$all_category_['category_name']."</option>";
                    }
                    ?>
                </select>
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="sizegroup">Size Group</label>
              <div class="col-xs-9">
                <select class="form-control" id="size_type_id" name="size_type_id" onchange="changeSizeType()">
                  <option value="">-- Select Size Group --</option>
                    <?php 
                    foreach($all_size_group as $all_size_group){
                    echo "<option value=\"".$all_size_group['size_type_id']."\">".$all_size_group['size_type_name']."</option>";
                    }
                    ?>
                </select>
              </div>
            </li>
          </ul>
        </div>
      </div><!--box-->

      <div class="box row">
        <div class="desc col-xs-3">
          <h3>Variants &amp; Inventory</h3>
          <p>Manage your product variants and inventory.</p>
        </div>
        <div class="content col-xs-9">
          <?php for($i=1;$i<=1;$i++){?>
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
                <input type="text" class="form-control" id="type_price_<?php echo $i;?>" name="type_price[<?php echo $i;?>]">
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="product-desc">Product Description</label>
              <div class="col-xs-9">
                <textarea class="form-control" rows="5" id="type_description_<?php echo $i;?>" name="type_description[<?php echo $i;?>]"></textarea>
              </div>
            </li>
            <li class="form-group row image-placeholder input-file">
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
                <input type="text" class="form-control" id="type_weight_<?php echo $i;?>" name="type_weight[<?php echo $i;?>]" placeholder="0">
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
          <?php 
          } 
          ?>

          <ul class="form-set hidden" id="field_<?php echo $i;?>"></ul>
          <div class="hidden" id="next_type"><?php echo $i;?></div>

          <ul class="form-set">
            <li class="form-group clearfix">
              <button type="button" class="btn btn-success btn-sm pull-right" value="Add Variant" onclick="addVariant()">Add Variant</button>
            </li>
          </ul>

        </div><!--content-->
      </div><!--box-->

      <div class="box row">
        <div class="desc col-xs-3">
          <h3>SEO</h3>
          <p>Search engine optimization for the product.</p>
        </div>
        <div class="content col-xs-9">
          <ul class="form-set">
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="page-title">Page Title</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" id="page_title" name="page_title">
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="page-description">Page Description</label>
              <div class="col-xs-9">
                <input type="text" class="form-control" id="page_description" name="page_description">
              </div>
            </li>
            <li class="form-group row">
              <label class="col-xs-3 control-label" for="url-handle">URL &amp; Handle</label>
              <div class="col-xs-9">
                <table>
                  <tbody>
                    <tr>
                      <td><div class="form-url">http://sitename.com/products/</div></td>
                      <td width="100%"><div style="margin: -1px"><input type="text" class="form-control url" id="product_alias" name="product_alias" placeholder="your-product-name" onchange="forceAlias()"></div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </li>
          </ul>
        </div>
      </div><!--box-->

      <!--<div class="box row">
        <div class="desc col-xs-3">
          <h3>Visibility</h3>
          <p>Visibility on front end.</p>
        </div>
        <div class="content col-xs-9">
          <div class="form-group row">
            <label class="col-xs-3 control-label">Visibility</label>
            <div class="col-xs-9">
              <label class="radio-inline">
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                Yes
              </label>
              <label class="radio-inline">
                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                No
              </label>
            </div>
          </div>
        </div>
      </div>-->

    </div><!--container main-->
            
            <!--<div class="sub-header clearfix">
                    <div class="content">
                        <h2>Add Product <?php echo $_POST['product_name'];?></h2>
                        <div class="btn-placeholder top-button">
                           <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/product"?>">
                            <input type="button" class="btn grey main" value="Cancel">
                           </a>
                            <input type="submit" class="btn green main" value="Save Changes" name="add-product" >
                            <input type="submit" class="btn green main" value="Save Changes &amp; Exit" name="add-product">
                        </div>
                    </div>
                </div>-->

            <!--<div id="main-content" class="products">

                <div class="box clearfix">
                    <div class="desc">
                        <h3>Basic Details</h3>
                        <p>Basic details of your product.</p>
                    </div>
                    <div class="content">
                        <ul class="form-set">
                        
                            <li class="field field-select">
                                <label for="brand">Brand <span>*</span></label>
                                <select class="input-select" id="brand" name="brand">
                                    <option selected value="xxxx"></option>
                                    <option value="xxxx">Monstore</option>
                                </select>
                                <p class="field-message error hidden">Content required</p>
                            </li>
                            
                            <li class="field-divider"></li>
                            <li class="field field-select">
                                <label for="category">Product Category <span>*</span></label>
                                <select class="input-select" id="product_category" name="product_category">
                                   <option value=""> Select Category </option>
                                   <?php 
								   foreach($all_category as $all_category_){
								      echo "<option value=\"".$all_category_['category_id']."\">".$all_category_['category_name']."</option>";
                                    
                                   }
								   ?>
                                   
                                </select>
                            </li>
                            <li class="field field-select">
                                <label for="sizegroup">Size Group <span>*</span></label>
                                <select class="input-select" id="size_type_id" name="size_type_id" onchange="changeSizeType()">
                                   <option value=""> Select Size Group </option>
                                   <?php 
								   foreach($all_size_group as $all_size_group){
								      echo "<option value=\"".$all_size_group['size_type_id']."\">".$all_size_group['size_type_name']."</option>";
                                    
                                   }
								   ?>
                                   
                                </select>
                            </li>
                           
                            <li class="field-divider"></li>
                            
                            
                        </ul>
                    </div>
                </div>

                <div class="box clearfix">
                    <div class="desc">
                        <h3>Variants</h3>
                        <p>Variations of your products such as in color. You can add as may variants as you want.</p>
                    </div>
                    <div class="content">
                        <ul class="form-set">
                            <li class="field">
                                <label for="product_name">Product Name <span>*</span></label>
                                <input type="text" class="input-text" id="product_name" name="product_name" onchange="getAlias()">
                                <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id;?>">

                            </li>
                        </ul>
                        
                        <?php for($i=1;$i<=1;$i++){?>
                        <ul class="form-set" id="type_group_<?php echo $i;?>">
                            <li class="field-divider"></li>
                            <li class="field field-select">
                                <label for="color">Color Group <span>*</span></label>
                                <select class="input-select" id="color_id_<?php echo $i;?>" name="color_id[<?php echo $i;?>]" onchange="changeColor(<?php echo $i;?>)" >
                                   <option value="No Color"> Select Color Group </option>
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
                                <label for="color-name">Variant Name</label>
                                <input type="text" class="input-text" id="type_name_<?php echo $i;?>" name="type_name[<?php echo $i;?>]">
                            </li>
                            <li class="field">
                                <label for="sku">SKU</label>
                                <input type="text" class="input-text" id="type_code_<?php echo $i;?>" name="type_code[<?php echo $i;?>]">
                            </li>
                            <li class="field">
                                <label for="price">Price <span>*</span></label>
                                <input type="text" class="input-text" id="type_price_<?php echo $i;?>" name="type_price[<?php echo $i;?>]">
                                <p class="field-message">Excluding tax</p>
                            </li>
                            <li class="field">
                                <label for="product-desc">Product Description</label>
                                <textarea rows="5" id="type_description_<?php echo $i;?>" name="type_description[<?php echo $i;?>]"></textarea>
                                <p class="field-message error hidden">Content required</p>
                            </li>
                            
                            
                            

                            <li class="field input-file clearfix">
                                <label for="xxxx">Main Image</label>
                                <div class="clearfix" style="width: 550px; padding-bottom: 8px">
                                
                                <?php for($j=0;$j<5;$j++){?>
                                
                                    <div class="fl image" style="width: 100px; height: 133px" onclick="openBrowser('<?php echo $i.'-'.$j;?>')" onmouseover="imageOver('<?php echo $i.'-'.$j;?>')" onMouseOut="imageOut('<?php echo $i.'-'.$j;?>')">
                                                     <div class=""><div class="image-delete hidden" id="image-<?php echo $i.'-'.$j;?>-delete" onclick="deleteImage('<?php echo $i.'-'.$j;?>','<?php echo $i;?>','<?php echo $j;?>'); event.preventDefault();" onmouseover="deleteOver()" onmouseout="deleteOut()"></div><div class="image-overlay"></div></div>

                                                     <img class="hidden" id="upload-image-<?php echo $i.'-'.$j;?>" src="<?php echo $prefix;?>files/common/sample_product.jpg">
                                        <div class="hidden" id="product-<?php echo $i.'-'.$j;?>-image-wrap">
                                        	<input type="file" name="product_image[<?php echo $i;?>][<?php echo $j;?>]" id="product-<?php echo $i.'-'.$j;?>-image" onchange="readURL(this,'<?php echo $i.'-'.$j;?>')" class="hidden"/>
                                        </div>
                                        <input type="hidden" name="image_id[<?php echo $i;?>][<?php echo $j;?>]" value="" />
                                        <input type="hidden" name="image_delete[<?php echo $i;?>][<?php echo $j;?>]" id="image-delete-<?php echo $i.'-'.$j;?>" value="0" />
                                    </div>
                                    
                                    
                                    
                                <?php }?>
                                
                                </div>
                                
                               <p class="field-message" style="padding-top: 10px">Recommended dimensions of 400 x 533 px.</p>
                            </li>
                            
                            <div id="product_stock_list_<?php echo $i;?>">
                            	
                            </div>
                            
                            
                            <li class="field">
                                <label for="weight">Weight (in kg)<span>*</span></label>
                                <input type="text" class="input-text" id="type_weight_<?php echo $i;?>" name="type_weight[<?php echo $i;?>]" placeholder="0" style="width:90px; text-align:right">
                            </li>
                            <li class="clearfix"><div class="btn-placeholder"><input type="button" class="btn red main" value="Remove Variant" onclick="deleteType(<?php echo $i;?>)"></div></li>
                            <input type="hidden" name="type_delete[<?php echo $i;?>]" id="type_delete_<?php echo $i;?>" value='0'/>
                            
                            
                            <?php for ($j=0;$j<5;$j++){?>
	                            <input type="hidden" name="order[<?php echo $i;?>][<?php echo $j;?>]" id="order_<?php echo $i;?>_<?php echo $i;?>" value="<?php echo $j;?>" />
	                            
	                        <?php
                            }
                            ?>
                        </ul>
                        
                        
                        
                        <?php } ?>
                        
                        <div class="form-set hidden" id="field_<?php echo $i;?>"></div>
                        <div class="hidden" id="next_type"><?php echo $i;?></div>
                        
                        <ul class="form-set">
                            <li class="field-divider"></li>
                            <li class="clearfix"><div class="btn-placeholder"><input type="button" class="btn green main" value="Add Variant" onclick="addVariant()"></div></li>
                        </ul>
                    </div>
                </div>

                <div class="box clearfix">
                    <div class="desc">
                        <h3>SEO</h3>
                        <p>Data for Search Engine Optimization.</p>
                    </div>
                    <div class="content">
                        <ul class="form-set">
                            <li class="field">
                                <label for="page-title">Page Title</label>
                                <input type="text" class="input-text" id="page_title" name="page_title">
                            </li>
                            <li class="field">
                                <label for="page-description">Page Description</label>
                                <input type="text" class="input-text" id="page_description" name="page_description">
                            </li>
                            <li class="field clearfix">
                                <label for="url-handle">URL &amp; Handle</label>
                                <div class="url">http://sitename.com/products/</div>
                                <input type="text" class="input-text url" id="product_alias" name="product_alias" placeholder="your-product-name" onchange="forceAlias()">
                            </li>
                        </ul>
                    </div>
                </div>

            </div>-->
</form>

<script src="<?php echo $prefix_url;?>script/add_product.js"></script>

<?php
include('custom/products/add/index.php');
?>

