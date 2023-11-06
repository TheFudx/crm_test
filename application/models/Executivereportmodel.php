<?php

class Executivereportmodel extends CI_Model
{
	public function __construct() {

	
}


  function getCompleteexecReport($restaurant_id)
    {        
        $query = $this->db->query("SELECT * from bill_head where restaurant_id = $restaurant_id and bill_head.is_deleted = 0 GROUP BY bill_head.Id");
        
        $result = $query->result_array();
        return $result;
    }
}




?>