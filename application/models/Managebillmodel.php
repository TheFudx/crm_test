<?php

class Managebillmodel extends CI_Model
{
	public function __construct() {
        $this->table = 'bill_head';
        $this->kot = 'kot_head';
        $this->billmanage = 'bill_manage';

}


function getManagebillmodel($restaurent_id,$payment_type)
{  
    // $query = $this->db->query("SELECT * FROM `bill_head` left JOIN admin_users on bill_head.created_by = admin_users.id WHERE bill_head.restaurant_id = $restaurent_id  and  bill_head.is_deleted = 0" );
    
    if($payment_type!=''){
        $query = $this->db->query("SELECT bill_head.Id as Id,bill_head.invoice_no as invoice_no, admin_users.username as username,bill_head.grand_total as grand_total, bill_head.created_date as created_date  FROM `bill_head` left JOIN admin_users on bill_head.created_by = admin_users.id WHERE bill_head.restaurant_id = $restaurent_id  and  bill_head.is_deleted = 0 and bill_head.payment_type = '$payment_type'" );

        $result = $query->result_array();
        return $result;
     }else{
          $query = $this->db->query("SELECT bill_head.Id as Id,bill_head.invoice_no as invoice_no, admin_users.username as username,bill_head.grand_total as grand_total, bill_head.created_date as created_date  FROM `bill_head` left JOIN admin_users on bill_head.created_by = admin_users.id WHERE bill_head.restaurant_id = $restaurent_id  and  bill_head.is_deleted = 0 " );
          $result = $query->result_array();
          return $result;
     }

     
    
}

function getPaymentType($restaurant_id)
{    
    $query = $this->db->query("SELECT DISTINCT payment_type FROM bill_head where restaurant_id = $restaurant_id");
    $result = $query->result_array();
    return $result;
}



function delete($id,$dataBill){ 
    if ($this->db->trans_status() === false) {
        $this->db->trans_rollback();
        $result = array('msg' => 'Error While Deleting item','status' => false);
    } else {
        $this->db->trans_begin();
        $data = array('is_deleted ' => 1);
        $this->db->where('Id', $id);
        $this->db->update($this->table, $data);
        $this->db->where('bill_id', $id);
        $this->db->update($this->kot, $data);

        $ManageBill = array(
            'restaurant_id' =>$dataBill['restaurant_id'],
            'username' =>$dataBill['username'],
            'invoice_no' =>$id,
            'created_date' =>$dataBill['created_date']
        );
        $this->db->insert($this->billmanage,$ManageBill);
        $this->db->trans_commit();
        $result = array('msg' => 'Bill Deleted Successfully','status' => true);
    }
    return $result;
}




















}

?>