<?
// Detail Category
$category_id = $_REQUEST['cid'];
$cat_name = preg_replace("/[\/_|+ -]+/", ' ', $clean);

include("database.php");
include("control.php");

$category_detail = detail_category($cat_name);

?>

<!-- ADD-->
        <div class="" id="add-category-popup">
            <div class="overlay over-category">
                <div class="header">
                        <h2>Edit Category</h2> 
                        <div class="btn-placeholder">
                           <a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/category";?>">
                            <input type="button" class="btn grey main" value="Cancel" id="btn-add-category-cancel">
                            </a>
                            <input type="button" class="btn red main" value="Delete">
                            <input type="submit" class="btn green main" value="Save Changes" name="btn-category">
                        </div>
                    </div>
                <div class="content">
                    <ul class="field-set">
                        <li class="field">
                            <label for="xxxx" class="">Change status</label>
                            <input type="radio" class="input-radio" value="active" name="category_active_status"
                               <?php if(strtolower($category_detail['category_active_status']) == "active"){ echo "checked=\"checked\"";}?>
                            />&nbsp; Active
                            <input type="radio" class="input-radio" value="inactive" name="category_active_status"
                               <?php if(strtolower($category_detail['category_active_status']) == "inactive"){ echo "checked=\"checked\"";}?>
                            />&nbsp; Inactive
                        </li>
                        <li class="field">
                            <label for="xxxx">Visibility</label>
                            <input type="radio" class="input-radio" value="1" name="category_visibility_status"
                               <?php if(strtolower($category_detail['category_visibility_status']) == "1"){ echo "checked=\"checked\"";}?>
                            />&nbsp; Yes
                            <input type="radio" class="input-radio" value="0" name="category_visibility_status" 
                               <?php if(strtolower($category_detail['category_visibility_status']) == "0"){ echo "checked=\"checked\"";}?>
                            />&nbsp; No
                        </li>
                        <li class="field">
                            <label for="xxxx">Root category</label>
                            <select class="input-select">
                                <option value="0">-- Select Root Category --</option>
                                <option value="1">Tops</option>
                                <option>-- Tanks</option>
                                <option>-- Knit Tops</option>
                            </select>
                        </li>
                        <li class="field clearfix">
                            <label>Category name</label>
                            <input type="text" class="input-text" name="category_name" placeholder="ex: Tees" value="<?php echo ucwords(strtolower($category_detail['category_name']));?>">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="overlay_bg70"></div>
        </div>
        <!-- END ADD-->        