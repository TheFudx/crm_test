<?php

class Kitchenreportmodel extends CI_Model
{
	public function __construct() {

	
}


  function getKitchenReport($restaurant_id)
    {        
        $query = $this->db->query("select bill_type , count(bill_head.total) as total , sum(if(is_deleted = '1' , 1 , 0)) as 'deleted' ,  sum(if(status= 'BillPaid' , 1 ,0 )) as paid  from bill_head where restaurant_id = $restaurant_id and bill_head.is_deleted = 0 group by bill_type");
        // $query = $this->db->query("select bill_type , count(bill_head.total) as total , sum(if(is_deleted = '1' , 1 , 0)) as 'deleted' ,  sum(if(status= 'BillPaid' , 1 ,0 )) as paid , sum(if(status= 'KitchenReject' , 1 ,0 )) as 'KitchenReject'  from bill_head where restaurant_id = $restaurant_id group by bill_type");
        //  $query = $this->db->query("SELECT bill_head.bill_type as bill_type, COUNT(kot_head.kot) as total, sum(if(kot_head.status= 'BillPaid' , 1 ,0 )) as paid , sum(if(kot_head.status= 'KitchenReject' , 1 ,0 )) as 'KitchenReject' from kot_head left join bill_head on kot_head.bill_id = bill_head.Id WHERE kot_head.restaurant_id = $restaurant_id and bill_head.is_deleted = 0 group by bill_head.bill_type  ");
        $result = $query->result_array();
        return $result;
    }
}














?>