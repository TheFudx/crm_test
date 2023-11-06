<?php

class Creditpaymentmodel extends CI_Model
{
	public function __construct() {
        
        $this->customer = 'customer';
        $this->bill_head = 'bill_head';

        $this->table = 'creditpayment_received';
        $this->created_by   = $this->session->userdata('user_session')['user_id'];
        $this->created_date = date('Y-m-d H:i:s');
}


function getCreditpaymentmodel($restaurent_id)
{  

    $query = $this->db->query("SELECT customer.c_name as customerName,customer.customer_id as customer_id,customer.mobile as contactNo, bill_head.invoice_no as invoice_no,bill_head.created_date as invoiceDate, bill_head.grand_total as billAmount, admin_users.username as createdName, bill_head.restaurant_id as restaurant_id FROM `bill_head` LEFT JOIN customer on bill_head.customer_id = customer.customer_id Right JOIN admin_users on bill_head.created_by = admin_users.id WHERE bill_head.restaurant_id = $restaurent_id and bill_head.payment_type = 'CreditPending' " );


    $result = $query->result_array();
    return $result;
}



function getCreditpaymentPaidmodel($restaurent_id)
{  
    $query = $this->db->query("SELECT customer.c_name as customerName,creditpayment_received.room as room, customer.mobile as contactNo,creditpayment_received.amount as AmountRecived,creditpayment_received.modified_date as createdDate, creditpayment_received.invoice_no as invoice_no , admin_users.username as createdName from creditpayment_received LEFT JOIN customer on creditpayment_received.customer_id = customer.customer_id Right JOIN admin_users on creditpayment_received.created_by = admin_users.id WHERE creditpayment_received.restaurant_id = $restaurent_id ORDER BY `creditpayment_received`.`modified_date` DESC" );
    $result = $query->result_array();
    return $result;
}

public function getCreditpayment($invoice_no,$restaurant_id){
    $this->db->select('*');
    $this->db->from('bill_head');
    $this->db->where('invoice_no', $invoice_no);
    $this->db->where('restaurant_id', $restaurant_id);
    $query = $this->db->get();
    // print $this->db->last_query();
    return $query->row();
}


public function save($data,$id)
{   
    $this->db->trans_begin();
    if($id == 0) {
        
        $data["created_by"]    = $this->created_by;
        // $data["created_date"]  = $this->created_date;
        $this->db->insert($this->table,$data);
        $id = $this->db->insert_id();

        $Billdata['payment_type'] = 'CreditPaid';
        $this->db->where('invoice_no', $data['invoice_no']);
        $this->db->where('restaurant_id', $data['restaurant_id']);
        $this->db->update($this->bill_head, $Billdata);
    }
    // else{
    //     $data["modify_by"]      = $this->created_by;
    //     $data["modified_date"]  = $this->created_date;
    //     $this->db->where('expense_id', $id);
    //     $this->db->update($this->table, $data);
    // }

    if ($this->db->trans_status() === false) {
        $this->db->trans_rollback();
        $result = array('msg' => 'Error While Updating Credit Payment Details','status' => false);
    } else {
        $this->db->trans_commit();
        $result = array('msg' => 'Credit Payment Details Paid successfully','status' => true);
    }
    return $result;
}


function getCreditpaymentTotalmodel($restaurent_id)
{  
    $query = $this->db->query("SELECT  sum(bill_head.grand_total) as TotalbillAmountPending  FROM `bill_head` LEFT JOIN customer on bill_head.customer_id = customer.customer_id Right JOIN admin_users on bill_head.created_by = admin_users.id WHERE bill_head.restaurant_id = $restaurent_id and bill_head.payment_type = 'CreditPending' " );

    $result = $query->row_array();
    return $result;
}


}

?>