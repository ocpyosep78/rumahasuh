<?php
// CONTACT
if(isset($_POST['btn_contact'])){
   header("Location:http://".$_SERVER['HTTP_HOST'].get_dirname($_SERVER['PHP_SELF'])."/contact");
}
?>