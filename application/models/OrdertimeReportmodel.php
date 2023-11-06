<?php

    ini_set('memory_limit', '-1');

class OrdertimeReportmodel extends CI_Model
{
    public function __construct()
    {
       
    }
    function getOrderTimeReport ()
    {   
        $this->restaurant_id = $this->data['session_data']['restaurant_id'];

    	$query1 = $this->db->query("SELECT Id FROM  bill_head ");    
 		$result1 = $query1->result_array();
        foreach($result1 as $row){
           $res = $row['Id'];
            $query2 = $this->db->query("SELECT * FROM order_status_log where order_id=$res and order_status_log.status = 'OrderTaken' limit 0,1");    
            $result2 = $query2->result_array(); 
        }
    }
    //     return array_merge($result1,$result2);
      

     
	// }

    // function getOrderTakenReport ()
    // {   
    //     $query = $this->db->query("SELECT * FROM order_status_log where order_id=  and order_status_log.status = 'OrderTaken' limit 0,1");    
    //     $result = $query->result_array(); 
    //     return $result;
	// }

    function getOrderTimeWatch($id)
    {
        $query = $this->db->query("SELECT status , create_date FROM order_status_log WHERE order_id = $id ");
        $result = $query->result_array();
        return $result;
    }

    
}



?>

