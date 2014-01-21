<?php
include("custom/products/details/files_control.php");
include("custom/products/details/color_control.php");
include("custom/products/details/how_control.php");
include("custom/products/details/filter_control.php");

unset($_SESSION['lang_admin']);

echo "<input type=\"hidden\" id=\"custom_product_alias\" value=\"".$_REQUEST['product_alias']."\">";
?>