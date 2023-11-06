<?php

class Customermodel extends CI_Model
{
    public function __construct()
    {
        $this->table = 'customer';
    }

    public function save($data,$id)
    {   
        $this->db->trans_begin();
        $where = array('mobile'=> $data['mobile'], 'restaurant_id'=> $data['restaurant_id'], 'is_deleted'=> 0);
        if(is_exists($where, $this->table, $id,'customer_id') > 0 ){
            $result = array('msg' => 'Customer already Exist', 'status' => false,'id'=> $id);
            return $result;
        }
        
        if($id == 0) {
            $data["created_by"]   = $this->session->userdata('user_session')['user_id'];
            $data["created_date"] = date('Y-m-d H:i:s');
            $this->db->insert($this->table,$data);
            $id = $this->db->insert_id();
        }else{
           
            $data["modified_by"]   = $this->session->userdata('user_session')['user_id'];
            $data["modified_date"] = date('Y-m-d H:i:s');
            $this->db->where('customer_id', $id);
            $this->db->update($this->table, $data);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $result = array('msg' => 'Error While Updating Customer Details','id'=> $id,'status' => false);
        } else {
            $this->db->trans_commit();
            $result = array('msg' => 'Customer Details Updated Successfully','id'=> $id,'status' => true);
        }
        return $result;
    }

    function delete($id)
    { 
        $this->db->trans_begin();
        $data = array('is_deleted ' => 1);
        $this->db->where('customer_id', $id);
        $this->db->update($this->table, $data);
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $result = array('msg' => 'Error While Deleting item','status' => false);
        } else {
            $this->db->trans_commit();
            $result = array('msg' => 'item Deleted Successfully','status' => true);
        }
        return $result;
    }
    
     function getCustomerDetailes($customer_id,$restaurant_id)
    {
    	$query = $this->db->query("SELECT customer.c_name as Name, customer.mobile as Mobile,customer.address as Address,customer.dob as DOB, customer.doa as DOA,bill_head.invoice_no as InvoiceNo, bill_head.modified_date as visite  , bill_head.Id as BillID from customer JOIN bill_head ON customer.customer_id = bill_head.customer_id  where customer.is_deleted = 0 AND bill_head.is_deleted = 0 AND bill_head.status = 'BillPaid' AND bill_head.restaurant_id = $restaurant_id And bill_head.customer_id= $customer_id ORDER BY bill_head.created_date DESC limit 10");

         $result = $query->result_array();
        return $result;
    
	}
	
	
	  function getCustomerfavDetailes($customer_id,$restaurant_id)
    {
    	$query = $this->db->query("SELECT customer.c_name as Name, customer.mobile as Mobile,customer.address as Address,customer.dob as DOB, customer.doa as DOA,bill_head.invoice_no as InvoiceNo, bill_head.modified_date as visite  , bill_head.Id as BillID from customer JOIN bill_head ON customer.customer_id = bill_head.customer_id  where customer.is_deleted = 0 AND bill_head.is_deleted = 0 AND bill_head.status = 'BillPaid' AND bill_head.restaurant_id = $restaurant_id And bill_head.customer_id= $customer_id ORDER BY bill_head.created_date DESC limit 3");

        $result = $query->result_array();
        return $result;
    
	}
}