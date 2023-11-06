<?php

class Dayendhistorymodel extends CI_Model
{
	public function __construct() {
        

}


function getDayendhistory($restaurent_id)
{  
    $query = $this->db->query("SELECT * FROM day_end Left JOIN bill_head ON day_end.restaurant_id = bill_head.restaurant_id WHERE day_end.restaurant_id = $restaurent_id GROUP BY day_end.Id" );
    $result = $query->result_array();
    return $result;
}

}

?>