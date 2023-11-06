<?php

class Tippaymentmodel extends CI_Model
{
	public function __construct() {
    $this->bill_head = 'bill_head';
}


    function getTippaymentmodel($restaurent_id)
    {  

        $query = $this->db->query("SELECT bill_head.Id as Id, bill_head.grand_total as grand_total, bill_head.tip_amt as tipAmount,bill_head.created_date as created_date, admin_users.username as username, tables.tablename as tablename  FROM `bill_head` LEFT JOIN admin_users on bill_head.created_by = admin_users.id LEFT JOIN tables on bill_head.table_id = tables.table_id WHERE bill_head.restaurant_id = $restaurent_id and bill_head.status = 'BillPaid' and bill_head.tip_amt > 0.00 and bill_head.is_deleted = 0 " );

        $result = $query->result_array();
        return $result;
    }





    public function save($data)
    {   
        $this->db->trans_begin();

        if( !empty($data['Id'])){
            $Billdata['tip_amt'] = $data['tip_amt'] ;
            $this->db->where('Id', $data['Id']);
            $this->db->update($this->bill_head, $Billdata);
        }
    
        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit();
            $result = array('msg' => 'Tip Add Successfully','status' => true);
        } else {
            $this->db->trans_rollback();
            $result = array('msg' => 'Error While Adding Tip Details','status' => false);
        }
        return $result;
    }

}

?>