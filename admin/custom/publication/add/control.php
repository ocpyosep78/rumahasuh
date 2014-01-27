<?php
$department = get_category();

if(isset($_POST['btn_add_publication'])){
   
   // DEFINED VARIABLE
   $active       = '1';
   $visibility   = $_POST['visibility_status'];
   $department   = $_POST['category_department'];
   $career_name  = stripslashes($_POST['category_name']);
   //$description  = stripslashes($_POST['career_description']);
   
   // ADD FOR ANTICIPATED CROWDED IMAGE NAME @ 4 November 2013
   $file_name = substr($_FILES['upload_news_1']['name'],0,-4);
   $file_type = substr($_FILES['upload_news_1']['name'],-4);
   
   $uploads_dir   = '../files/uploads/publications_image/';
   //$userfile_name = str_replace(array('(',')',' '),'_',$_FILES['upload_news_1']['name']);
   $userfile_name = cleanurl($file_name).$file_type;
   $userfile_tmp  = $_FILES['upload_news_1']['tmp_name'];
   $prefix        = 'award-image-';
   $prod_img      = $uploads_dir.$prefix.$userfile_name;
   
   move_uploaded_file($userfile_tmp, $prod_img);
   $slider_image  = $prefix.$userfile_name;
   
   $description      = "files/uploads/publications_image/".$slider_image;
   
   $map          = stripslashes($_POST['category_maps']);
   
   insert($career_name, $department, $active, $visibility, $description, $map);
   
   $_SESSION['alert'] = 'success';
   $_SESSION['msg']   = 'Item has been successfully saved.';
   
}
?>