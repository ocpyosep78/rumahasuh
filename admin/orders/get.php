<?php
/*
==============================
|							 |
|        INDEX ORDER 	     |
|							 |
==============================
*/

function orderIndex($search_query, $sort_by, $first_record, $query_per_page){
   $conn  = connDB();
   
   $sql   = "SELECT ord.order_id, ord.order_number, ord.order_billing_first_name, ord.order_billing_last_name, ord.order_confirm_bank, ord.payment_status, ord.fulfillment_status,
                    ord.order_confirm_amount, ord.order_date, ord.order_confirm_name, order_total_amount, ord.order_payment_method, ord.order_billing_fullname,
					item.item_id, SUM(item.item_price) AS total_sell, SUM(item.item_discount_price) AS total_disc
			 FROM tbl_order AS ord INNER JOIN tbl_order_item AS item ON ord.order_id = item.order_id
			 WHERE $search_query
			 GROUP BY ord.order_id
			 ORDER BY $sort_by
			 LIMIT $first_record, $query_per_page";
   $query = mysql_query($sql, $conn);
   $row   = array();
   
   while($result = mysql_fetch_array($query)){
      array_push($row, $result);
   }
   
   return $row;
}


function fullOrderIndex($search_query, $sort_by, $first_record ,$query_per_page){
   $conn  = connDB();
   
   $sql   = "SELECT ord.order_id, ord.order_number, ord.order_billing_first_name, ord.order_billing_last_name, ord.order_confirm_bank, ord.payment_status, ord.fulfillment_status,
                    ord.order_confirm_amount, ord.order_date, ord.order_confirm_name,
					item.item_id, SUM(item.item_price) AS total_sell, SUM(item.item_discount_price) AS total_disc
			 FROM tbl_order AS ord INNER JOIN tbl_order_item AS item ON ord.order_id = item.order_id
			 WHERE $search_query
			 GROUP BY ord.order_id
			 ORDER BY $sort_by";
   $query  = mysql_query($sql, $conn);

   $full_order['total_query'] = mysql_num_rows($query);
   $full_order['total_page']  = ceil($full_order['total_query'] / $query_per_page); // 

   return $full_order;
}
?>