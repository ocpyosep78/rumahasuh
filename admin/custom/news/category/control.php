<?php

/*if($_POST['category-action'] == "delete"){

   if($_POST['category-option'] == "yes"){
      //echo "Deleted";
   }else if($_POST['category-option'] == "no"){
      //echo "Save";
   } 

}else if($_POST['category-action'] == "save"){

   if($_POST['category-option'] == "yes"){
      //echo "save yes";
   }else if($_POST['category-option'] == "no"){
      //echo "Save no";
   } 

}

if($_POST['btn-index-category'] == "Save Changes"){
  
   $conn = connDB();
  
   $category_name        = $_POST['category_name'];
   $category_description = $_POST['category_description'];
   $active_status        = $_POST['category_active_status'];
   $visibility_status    = $_POST['category_visibility_status'];
   $category_parent      = $_POST['category_parent'];
   $category_id          = $_POST['cat_id'];
  
   if(empty($category_id)){
      $get_order = mysql_query("SELECT * from tbl_category ORDER BY category_order DESC",$conn);
	  
	  if (mysql_num_rows($get_order)!=null){
         $get_order_array = mysql_fetch_array($get_order);
	     $category_order = $get_order_array["category_order"]*1+1;
      }
	  
	  mysql_query(" INSERT INTO tbl_category 
                          (category_name,category_order,category_active_status,category_visibility_status) 
				    VALUES('$category_name','$category_order','$active_status','$visibility_status')",$conn);
   
   
      $get_id = mysql_query("SELECT * from tbl_category WHERE category_name = '$category_name' ORDER BY category_id DESC",$conn);
   
      if (mysql_num_rows($get_id)!=null){
         $get_id_array = mysql_fetch_array($get_id);
	     $category_id = $get_id_array["category_id"];
      }
	  
	  $parent_array=array();
	  $get_parent = mysql_query("SELECT * from tbl_category_relation WHERE category_child='$category_parent'",$conn);
	  
	  if (mysql_num_rows($get_parent)!=null){
	     
		 for($counter=1;$counter<=mysql_num_rows($get_parent);$counter++){
	        $get_parent_array = mysql_fetch_array($get_parent);
		    $tmp_level = $get_parent_array["relation_level"];
		    $tmp_parent = $get_parent_array["category_parent"];
		    $parent_array[$tmp_level]=$tmp_parent;
         }	
		 
      }
	  
	  mysql_query("INSERT INTO tbl_category_relation(category_child,category_parent,relation_level) VALUES('$category_id','$category_parent','1')",$conn);
	  
	  foreach($parent_array as $level => $parent){
	     $new_level = $level*1+1;
	     mysql_query("INSERT INTO tbl_category_relation(category_child,category_parent,relation_level)VALUES('$category_id','$parent','$new_level')",$conn);
		 
		 if ($parent=='top'){
            $category_level = $level;
         }
		 
      }
	  
   }else if(!empty($category_id)){
      mysql_query("UPDATE tbl_category SET category_name = '$category_name', category_level = '$category_level' WHERE category_id = '$category_id'",$conn);
   }
   
   ?>
   <script>
      alert("Success insert <?php echo $category_name;?> into database");
   </script>
   <?php
   
   
}else if($_POST['btn-index-category'] == "Delete"){
   
   $conn = connDB();
   $category_id   = $_POST['cat_id'];
   
   $get_order = mysql_query("SELECT * from tbl_category WHERE category_id = '$category_id'",$conn);
   
   if (mysql_num_rows($get_order)!=null){
      $get_order_array = mysql_fetch_array($get_order);
	  $category_order  = $get_order_array["category_order"];
   }
   
   mysql_query("UPDATE tbl_category SET category_order = category_order-1 WHERE category_order > '$category_order'",$conn);
   
   //$category_parent_redirect = $_GET["parent_category"];
   mysql_query("DELETE FROM tbl_category WHERE category_id = '$category_id'",$conn);
   
   $category_relation = mysql_query("SELECT * from tbl_category_relation WHERE category_parent = '$category_id'",$conn);
   
   if (mysql_num_rows($category_relation)!=null){
      
	  for ($counter=1;$counter<=mysql_num_rows($category_relation);$counter++){
	     $category_relation_array = mysql_fetch_array($category_relation);
		 $category_child = $category_relation_array["category_child"];
		 
		 mysql_query("DELETE FROM tbl_category_relation WHERE category_parent = '$category_child'",$conn);
		 mysql_query("DELETE FROM tbl_category WHERE category_id = '$category_child'",$conn);
      }
   }
   
   mysql_query("DELETE FROM tbl_category_relation WHERE category_child = '$category_id' OR category_parent = '$category_id'",$conn);
}






// Show category
function listCategory($level,$parent,$current_category){
   $conn = connDB();
   
   $get_data = mysql_query("SELECT * from tbl_category AS cat INNER JOIN tbl_category_relation AS cat_rel ON cat.category_id = cat_rel.category_child
	                        WHERE cat.category_level = '$level' AND cat_rel.category_parent = '$parent' ORDER BY category_order",$conn);

   if (mysql_num_rows($get_data)!=null && mysql_num_rows($get_data)!=0){
      
	  for ($counter=1;$counter<=mysql_num_rows($get_data);$counter++){
	     $get_data_array = mysql_fetch_array($get_data);
		 $new_level = $level*1+1;
		 $new_parent = $get_data_array["category_id"];
		 echo '<option class="option_level_'.$level.'" data-level="'.$level.'" id="option_level_'.$level.'"';
		 if ($current_category==$new_parent."'"){
			echo "selected=selected";
		 }
		 
		 echo ' value="'.$new_parent.'">';
		 
		 for ($i=0;$i<$level;$i++){
			echo '-- ';
		 }
		 
		 echo $get_data_array["category_name"].'</option>';
		 listCategory($new_level,$new_parent,$current_category);
      }
   }
}


// Show category
function showCategory($level,$parent){
   $conn = connDB();
   
   $get_data = mysql_query("SELECT * from tbl_category AS cat INNER JOIN tbl_category_relation AS cat_rel ON cat.category_id = cat_rel.category_child
	                        WHERE cat.category_level = '$level' AND cat_rel.category_parent = '$parent' ORDER BY category_order",$conn);

   if (mysql_num_rows($get_data)!=null && mysql_num_rows($get_data)!=0){
      
	  for ($counter=1;$counter<=mysql_num_rows($get_data);$counter++){
	     $get_data_array = mysql_fetch_array($get_data);
		 $new_level = $level*1+1;
		 $new_parent = $get_data_array["category_id"];
		 
		 $cat_name       = $get_data_array['category_name'];
		 $cat_active     = $get_data_array['category_active_status'];
		 $cat_visibility = $get_data_array['category_visibility_status'];
		 
		 echo "<tr class=\"odd\" id=\"row_".$row."\" onclick=\"selectRow('".$row."')\">";
		 echo "<td><input type=\"checkbox\" name=\"category_id[]\" value=\"".$new_parent."\" id=\"check_".$row."\" onmouseover=\"downCheck()\" onmouseout=\"upCheck()\" onclick=\"selectRowCheck('".$row."')\"></td>";
		 echo "<td><a href=\"#\"";
		 echo "category_name=\"ucwords(strtolower(".$cat_name."))\""; 
		 echo "active=\"".$cat_active."\"";
		 echo "cat_id=\"".$new_parent."\"";
		 echo "visible=\"".$cat_visibility."\"";
		 echo "id=\"link-category-".$new_parent."\">".ucwords(strtolower($cat_name))."</a></td>";
		 echo "<td class=\"tr\"><a href=\"\">".$all_category['total_product']."</a></td>";
		 echo "<td>".$cat_active."</td>";
		 echo "<td>".$cat_visibility."</td>";
		 echo "</tr>";
	
		 listCategory($new_level,$new_parent,$current_category);
      }
   }
}*/

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
   $sort_by="category_name ASC";
}

// SEARCH
$search = stripslashes($_REQUEST['src']);

if ($search==""){ $search = 1;}	
			
$get_list_full =mysql_query("SELECT 
             cat.category_id, cat.category_name, cat.category_active, cat.category_visibility,
			 COUNT(news.news_id) AS total_news
			 FROM tbl_news_category AS cat LEFT JOIN tbl_news AS news ON cat.category_id = news.news_id 
			 WHERE $search 
			 GROUP BY cat.category_id
			 ORDER BY $sort_by
			 LIMIT $first_record , $query_per_page",$conn);

$total_query = mysql_num_rows($get_list_full);
$total_page = ceil($total_query / $query_per_page); // RESULT


if(isset($_POST['btn_pop_category'])){
	
   // DEFINE VARIABLE
   $category_news_id         = $_POST['category_id'];
   $category_news_name       = $_POST['category_name'];
   $category_news_active     = $_POST['news-category-active-status'];
   $category_news_visibility = $_POST['news-category-visible-status'];
   
   $post_cat_id              = $_POST['cat_id'];
   $post_action              = $_POST['category_listing_action'];
   $post_action_2            = $_POST['category_listing_option'];
   
   if($_POST['btn_pop_category'] == "Save Changes"){
      
	  if(!empty($_POST['category_id'])){
	     update_category($category_news_name, $category_news_active, $category_news_visibility, $category_news_id );
	  ?>
      <script>
	  //location.href = "http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news-category";?>";
	  </script>
      <?php
	  }else{
	     insert_category($category_news_name, $category_news_active, $category_news_visibility);
	  ?>
      
      <script>
	  //location.href = "http://<?php echo $_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/news-category";?>";
	  </script>
      
      <?php
		 
	  }
	  
   }else if($_POST['btn_pop_category'] == "Delete"){
      delete_category($category_news_id);
   }else if($_POST['btn_pop_category'] == "GO"){
      
	  if($post_action = "Delete" || $post_action_2 == "Yes"){
	      
		  if(!empty($post_cat_id)){
		  
		     foreach($post_cat_id as $post_cat_id){
	            delete_category($post_cat_id);
		     }
		  
		  }
	  }
	  
	  
   }
   
}
















?>