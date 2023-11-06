<?php

class Rawmaterialmodel extends CI_Model
{
    public function __construct()
    {
        $this->table = 'rawmaterial';
    }

     public function getData($id, $restaurant_id){
            $this->db->select("r.rawmaterial_id, r.rawmaterial, mu.units, r.daily_required, r.product_Type, cs.current_stock");
        $this->db->from($this->table.' r');
        $this->db->join('master_unit mu', 'r.unit = mu.id', 'left');
        $this->db->join('current_stock cs','cs.rawmaterial_id = r.rawmaterial_id AND r.is_deleted = 0', 'left');

        $this->db->join('product_types pt', 'r.product_Type = pt.types','left');
        if($id){
            $this->db->where('r.rawmaterial_id', $id);
        }
        $this->db->where('r.restaurant_id', $restaurant_id);
        $this->db->where('r.product_Type !=', 'nonconsumable');
        $this->db->where('r.is_deleted', 0);
        $this->db->group_by('r.rawmaterial_id');
        $query = $this->db->get();
        $rows  = $query->num_rows();
        if($rows > 0){
            if($id){
                $data= $query->row_array();
                return $data;
            }else{
                return $query->result_array();
            }
        }else{
            return array();
        }
    }

    public function save($data,$id)
    {   
        $this->db->trans_begin();
        $where = array('rawmaterial'=> $data['rawmaterial'], 'restaurant_id'=> $data['restaurant_id'], 'is_deleted'=> 0);
        if(is_exists($where, $this->table, $id,'rawmaterial_id') > 0 ){
            $result = array('msg' => 'Item Name already Exist', 'status' => false);
            return $result;
        }
       
        if($id == 0) {
            $data["created_by"]   = $this->session->userdata('user_session')['user_id'];
            $data["created_date"] = date('Y-m-d H:i:s');
            $this->db->insert($this->table,$data);
            $id = $this->db->insert_id();
        }else{
            $data["modify_by"]   = $this->session->userdata('user_session')['user_id'];
            $data["modified_date"] = date('Y-m-d H:i:s');
            $this->db->where('rawmaterial_id', $id);
            $this->db->update($this->table, $data);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $result = array('msg' => 'Error While Updating Raw Material Details','status' => false);
        } else {
            $this->db->trans_commit();
            $result = array('msg' => 'Raw Material Details Updated successfully','status' => true);
        }
        return $result;
    }

    public function saveused($data,$id)
    {   
        $this->db->trans_begin();
        
        if($id == 0) {
            unset($data['oldquantity']);
            $data["created_by"]   = $this->session->userdata('user_session')['user_id'];
            $data["created_date"] = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $data);
            $id = $this->db->insert_id();
        }else{
            $data["modify_by"]      = $this->session->userdata('user_session')['user_id'];
            $data["modified_date"]  = date('Y-m-d H:i:s');
            $oldquantity            = $data['oldquantity'];
            $data['oldquantity']    = $data['quantity'] - $data['quantity'];
            unset($data['oldquantity']);
            $this->db->where('rawmaterial_id', $id);
            $this->db->update($this->table, $data);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $result = array('msg' => 'Error While Updating Raw Material Details','status' => false);
        } else {
            $this->db->trans_commit();
            $result = array('msg' => 'Raw Material Details Updated successfully','status' => true);
        }
        return $result;
    }

    function delete($id)
    { 
        $this->db->trans_begin();
        $data = array('is_deleted ' => 1);
        $this->db->where('rawmaterial_id', $id);
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function useRawmaterial($id,$restaurant_id){
        $query = $this->db->query("SELECT item_id,qty FROM kot_item where kot_id = $id" );
        $result = $query->result_array();
        return $result;
    }

    public function useRawmateriallist($id){
        $query = $this->db->query("SELECT item_rawmaterial.item_id,item_rawmaterial.rawmaterial_id,item_rawmaterial.quantity, master_unit.units FROM `item_rawmaterial` left join master_unit on item_rawmaterial.units =master_unit.id   WHERE `item_id` =$id" );
        $resultlist = $query->result_array();
        return $resultlist;
    }


    public function subtractmaterial($rawmaterial_id,$raw_qty,$restaurant_id){
        $query = $this->db->query("SELECT current_stock FROM current_stock WHERE rawmaterial_id =$rawmaterial_id" );
        $result = $query->row_array();
        return $result;
    }

    
    
    
    
    
    
}