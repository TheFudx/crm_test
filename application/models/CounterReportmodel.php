<?php

    ini_set('memory_limit', '-1');

class CounterReportmodel extends CI_Model
{
    public function __construct()
    {
       
    }

    function getCounterReport ($restaurant_id)
    {    

    	$query = $this->db->query("SELECT username , sum(IF(bill_head.is_deleted = 0,'success','cancel') ) as canceleld, sum(bill_head.status = 'BillPaid')as paid , sum(discount_amt) as dis , sum(tax_amt) as tax , sum(grand_total) as total , payment_type from bill_head LEFT JOIN admin_users on bill_head.created_by = admin_users.id left join tax on bill_head.tax_id = tax.tax_id WHERE bill_head.status = 'BillPaid' and bill_head.restaurant_id = $restaurant_id and bill_head.is_deleted = 0  GROUP BY bill_head.payment_type  ORDER BY bill_head.Id  ");

 		  $result = $query->result_array();
        	return $result;
     
	}
}



?>