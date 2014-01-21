<?php
/*
--------------------
|     CUSTOMS      |
--------------------
*/

function connDB($host="localhost:3306", $user="root", $pass=""){
   $conn = @mysql_pconnect($host, $user, $pass) or die (mysql_error());
   
   if($conn){
	  return $conn;
   }
   
}

$conn = connDB();
mysql_select_db("anti_demo_nag",$conn);

date_default_timezone_set('Asia/Jakarta');
?>