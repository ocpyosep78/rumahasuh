<?php
include("get.php");
include("update.php");
include("control.php");
include("ajax.php");

/* --- CONTROL HEADER --- */

// PAGE
if ($_REQUEST["pg"]==""){
   $page = 1;
}else{
   $page = $_REQUEST["pg"];
}

// QUERY PER PAGE
if ($_REQUEST["qpp"]==""){
   $query_per_page = 25;
}else{
   $query_per_page = $_REQUEST['qpp'];
}

// FIRST VALUE IN LIMIT
$first_record = ($page-1)*$query_per_page;

// SORT BY
$sort_by=$_REQUEST["srt"];

if ($sort_by==""){
   $sort_by="news_title ASC";
}

// SEARCH
$search = stripslashes($_REQUEST['src']);

if ($search==""){ $search = 1;}	
			
$get_list_full =mysql_query("SELECT * FROM tbl_news AS news INNER JOIN tbl_news_category AS cat ON news.news_category = cat.category_id ORDER BY news.news_title",$conn);

$total_query = mysql_num_rows($get_list_full);
$total_page = ceil($total_query / $query_per_page); // RESULT


// STORED VALUE
echo "<input type=\"hidden\" name=\"url\" id=\"url\" class=\"hidden\" value=\"http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news-view\">\n";
echo "<input type=\"hidden\" name=\"page\" id=\"page\" class=\"hidden\" value=\"".$page."\" /> \n";
echo "<input type=\"hidden\" name=\"query_per_page\" id=\"query_per_page\" class=\"hidden\" value=\"".$query_per_page."\" /> \n";
echo "<input type=\"hidden\" name=\"total_page\" id=\"total_page\" class=\"hidden\" value=\"".$total_page."\" /> \n";
echo "<input type=\"hidden\" name=\"sort_by\" id=\"sort_by\" class=\"hidden\" value=\"".$sort_by."\" /> \n";
echo "<input type=\"hidden\" name=\"search\" id=\"search\" class=\"hidden\" value=\"".urlencode($search)."\" /> \n";
echo "<input type=\"hidden\" name=\"user_id\" id=\"user_id\" class=\"hidden\" value=\"".$user_id."\" /> \n";


// HANDLING ARROW SORTING
if($_REQUEST['srt'] == "category_name DESC"){
   $arr_order_number = "<span class=\"sort-arrow-up\"></span>";
}else if($_REQUEST['srt'] == "category_name"){
   $arr_order_number = "<span class=\"sort-arrow-down\"></span>";
}else{
   $arr_order_number = "<span class=\"sort-arrow-down\"></span>";
}
?>

            <div class="sub-header clearfix">
                <div class="content">
                
                <?php if(!empty($_POST['msg'])){?>
                <div class="alert-message success"><?php echo $_POST['msg'];?></div>
                <?php }?>
                
                    <h2>Manage News</h2>
                    <select class="input-select">
                        <option>All Categories</option>
                        <option>Events</option>
                        <option>Promotions</option>
                        <option>Other News</option>
                    </select>
                    <div class="btn-placeholder">
                        <input type="button" class="btn green main" value="Add News" onclick="addNews()">
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
                                        <select class="input-select" name="option-action">
                                            <option></option>
                                            <option value="change">Change Status</option>
                                            <option value="delete">Delete</option>
                                        </select>
                                        <p>to</p>
                                        <select class="input-select" name="option-option">
                                            <option></option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        
                                        <input type="submit" class="btn green main go" value="GO">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table cellpadding="0" cellspacing="0">
                        <thead>
                            <tr class="headings">
                                <th width="20"></th>
                                <th class="sort" width="680">News Title<span class="sort-arrow-up"></span></th>
                                <th class="sort" width="200">Date</th>
                                <th class="sort" width="60">Visibility</th>
                            </tr>
                            <tr class="filter">
                                <th><input type="button" class="btn small reset" value="" onclick="reset()"></th>
                                <th><input type="text" class="input-text"></th>
                                <th><input type="text" class="input-text"></th>
                                <th>
                                    <select class="input-select">
                                        <option></option>
                                        <option>Yes</option>
                                        <option>No</option>
                                    </select>
                                </th>
                            </tr>
                        </thead>
                        <tbody onload="loading()">
                            <!--<div id="loading" style="position: absolute; z-index: 2; background: #000; width: 940px; height: 200px"></div>-->
                            <?php 
							$row = 0;
							foreach($all_news as $all_news){
						       $row++;
							?>
                            <tr id="<?php echo "row_".$row?>" onclick="selectRow('<?php echo $row;?>')">
                                <td><input type="checkbox" name="news_id[]" id="<?php echo "check_".$row?>" value="<?php echo $all_news['news_id'];?>" onmouseover="downCheck()" onmouseout="upCheck()" onclick="selectRowCheck('<?php echo $row;?>')">
                                </td>
                                <td><a href="http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])?>/news-detail/<?php echo $all_news['news_id']."/".cleanurl($all_news['news_title']);?>"><?php echo ucwords(strtolower($all_news['news_title']));?></a></td>
                                <td><?php echo $all_news['news_created_date'];?></td>
                                <td class="tr"><?php echo $all_news['category_visibility'];?></td>
                            </tr>
                            <?php }?>
                            
                        </tbody>
                    </table>
                </div><!--table-wrapper-->

            </div><!--main-content-->

<script>
function addNews(){
   location.href = "http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])?>/add-news";
}

function Reset(){
   location.href = "http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])?>/news";
}
</script>           