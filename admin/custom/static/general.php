<?php
/*
--------------------
|     CUSTOMS      |
--------------------
*/

/*
--------------------------------------------------------------------------------
function connDB($host="localhost:3306", $user="['username']", $pass="['password']"){
   $conn = @mysql_pconnect($host, $user, $pass) or die (mysql_error());
   
   if($conn){
	  return $conn;
   }
   
}      
--------------------------------------------------------------------------------
*/
function connDB($host="localhost:3306", $user="root", $pass=""){
   $conn = @mysql_pconnect($host, $user, $pass) or die (mysql_error());
   
   if($conn){
	  return $conn;
   }
   
}

$conn = connDB();

/*
--------------------------------------------------------------------------------
mysql_select_db("[database_name]",$conn);     
--------------------------------------------------------------------------------
*/
mysql_select_db("anti_asuh",$conn);

date_default_timezone_set('Asia/Jakarta');
?>