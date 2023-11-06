<?php

class Orderreportmodel extends CI_Model
{
	public function __construct() {

	
}


  function getOrderReport($restaurent_id)
    {        
        $query = $this->db->query("select bill_type , sum(bill_head.total) as total , sum(bill_head.grand_total) as grand_total , count(bill_head.total) as total_order  from bill_head where restaurant_id = $restaurent_id  and bill_head.is_deleted = 0 group by bill_type 

        ");
        
        $result = $query->result_array();
        return $result;
    }
}














?>