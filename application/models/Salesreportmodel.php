<?php

class Salesreportmodel extends CI_Model
{
	public function __construct() {

	
}


function getCompleteSalesReport($restaurent_id)
{        
    // $query = $this->db->query("SELECT * from bill_head LEFT JOIN admin_users on bill_head.created_by = admin_users.id left join tax on bill_head.tax_id = tax.tax_id where bill_head.restaurant_id = $restaurent_id  GROUP BY bill_head.Id");
    
    $query = $this->db->query("SELECT invoice_no, username,payment_type,bill_type,total,discount_amt,tax_name,vat_amt,cgst_amt,sgst_amt,grand_total, bill_head.created_date as created_date, bill_head.is_deleted as is_deleted from bill_head LEFT JOIN admin_users on bill_head.created_by = admin_users.id left join tax on bill_head.tax_id = tax.tax_id where bill_head.restaurant_id = $restaurent_id GROUP BY bill_head.Id");
    $result = $query->result_array();
    return $result;
}
}














?>