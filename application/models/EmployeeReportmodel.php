<?php

    ini_set('memory_limit', '-1');

class EmployeeReportmodel extends CI_Model
{
    public function __construct()
    {
       $this->created_date = date('Y-m-d');
    }

    function getEmployeeReport ($restaurant_id)
    {

    $query = $this->db->query("SELECT username , count(bill_head.Id) as total_order , sum(bill_head.status = 'BillPaid') as success,
          
        sum(bill_head.is_deleted = '1') as cancelled , count(bill_head.discount_amt) as cdiscount , sum(bill_head.discount_amt) as discount , sum(bill_head.total) as total  , (Select sum(bill_head.grand_total)  WHERE bill_head.status = 'BillPaid' ) as sec, (Select sum(bill_head.grand_total)  WHERE bill_head.is_deleted = 1 ) as cancelamt , sum(bill_head.sub_total) as sub , bill_type FROM bill_head left join admin_users on bill_head.created_by = admin_users.id WHERE bill_head.restaurant_id = $restaurant_id and bill_head.is_deleted = 0 group by bill_head.created_by  ");

 		  $result = $query->result_array();
        	return $result;
     
	}
	
	
	
	function getEmployeeTipReport ($restaurant_id)
    {

        $query = $this->db->query("SELECT username , sum(bill_head.tip_amt) as tipAmount, (Select sum(bill_head.grand_total) WHERE bill_head.status = 'BillPaid' ) as TotalBillAmount,(SELECT COUNT(bill_head.Id) where bill_head.status = 'BillPaid') as total_order FROM bill_head left join admin_users on bill_head.created_by = admin_users.id WHERE bill_head.restaurant_id = $restaurant_id and bill_head.is_deleted = 0 and bill_head.created_date >= '$this->created_date' group by bill_head.created_by" );

 	    $result = $query->result_array();
        return $result;
     
	}
	
	
	
	
}



?>