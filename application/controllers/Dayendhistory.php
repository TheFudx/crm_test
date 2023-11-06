<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Dayendhistory extends CI_Controller {
	public function __construct(){
        parent::__construct();

		$session_data = $this->session->userdata('user_session');
        if (!isset($session_data) || empty($session_data)) {
            redirect('login');
            
        }else{
			$this->data['session_data'] = @$this->session->userdata('user_session');
			$this->data['user_permission'] = @$this->session->userdata('user_permission');
			$this->restaurant_id = $this->data['session_data']['restaurant_id'];

            // $group_data = array();
			// $user_id = $session_data['user_id'];
			// $this->load->model('model_groups');
			// $group_data = $this->model_groups->getUserGroupByUserId($user_id);
			// $this->data['user_permission'] = unserialize($group_data['permission']);
			// $this->permission = unserialize($group_data['permission']);
        }

        // $this->load->model('admin/commonmodel');
        $this->load->model('Dayendhistorymodel');
        
    }

		public function index() {

		$this->data['data'] = $this->Dayendhistorymodel->getDayendhistory($this->restaurant_id);
		
		
			foreach($this->data['data'] as $key=>$value ){
			$this->db->select('IFNULL(sum(amount), 0) as total ');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where('cash_type','I');
			$this->db->where('created_date <=',date('Y-m-d H:i:s',strtotime($value['dayendtime'])));
			$this->db->where('is_deleted',0);
			$this->data['data'][$key]['cashIn'] = $this->db->get('cash_flow')->row()->total;
		
			$this->db->select('IFNULL(sum(amount), 0) as total ');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where('cash_type','O');
			$this->db->where('created_date <=',date('Y-m-d H:i:s',strtotime($value['dayendtime'])));
			$this->db->where('is_deleted',0);
			$this->data['data'][$key]['cashOut'] = $this->db->get('cash_flow')->row()->total;
		
		}
		
		foreach($this->data['data'] as $key=>$value ){
			$this->db->select('sum(order_final_amount) as total');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where('dayendtime <=',date('Y-m-d',strtotime($value['dayendtime'])).' 23:59:59');
			$this->data['data'][$key]['final_amount'] = $this->db->get('day_end')->row()->total;

			$this->db->select('IFNULL(sum(order_final_amount), 0) as total');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where('dayendtime <=',date('Y-m-d',strtotime($value['dayendtime'])).' 00:00:00');
			$this->data['data'][$key]['start_amount'] = $this->db->get('day_end')->row()->total;
			
			$this->db->select(' IFNULL(SUM(grand_total), 0) as total');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where("invoice_no BETWEEN '".$value['order_start_range']."' AND '".$value['order_end_range']."'");
			$this->db->where('status','BillPaid');
			$this->db->where('is_deleted',0);
			$this->data['data'][$key]['dayAmount'] = $this->db->get('bill_head')->row()->total;
			
			$this->db->select('created_date as total');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where("invoice_no",$value['order_start_range']);
			$this->db->where('status','BillPaid');
			$this->data['data'][$key]['startingbillDate'] = $this->db->get('bill_head')->row()->total;
			
			$this->db->select('created_date as total');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where("invoice_no",$value['order_end_range']);
			$this->db->where('status','BillPaid');
			$this->data['data'][$key]['endingbillDate'] = $this->db->get('bill_head')->row()->total;
			
			
		}
		
		
		
		foreach($this->data['data'] as $key=>$value ){
			$this->db->select('IFNULL(sum(grand_total), 0) as total ');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where('created_date <=',date('Y-m-d',strtotime($value['startingbillDate'])).' 00:00:00');
			$this->db->where('status','BillPaid');
			$this->db->where('is_deleted',0);
			$this->data['data'][$key]['Starting_amount'] = $this->db->get('bill_head')->row()->total ;

			$this->db->select('sum(grand_total) as total ');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where('created_date <=',date('Y-m-d H:i:s',strtotime($value['endingbillDate'])));
			$this->db->where('status','BillPaid');
			$this->db->where('is_deleted',0);
			$this->data['data'][$key]['Ending_amount'] = $this->db->get('bill_head')->row()->total;

			$this->db->select(' IFNULL(SUM(grand_total), 0) as total');
			$this->db->where('restaurant_id',$value['restaurant_id']);
			$this->db->where("invoice_no BETWEEN '".$value['order_start_range']."' AND '".$value['order_end_range']."'");
			$this->db->where('status','BillPaid');
			$this->db->where('is_deleted',0);
			$this->data['data'][$key]['dayAmount'] = $this->db->get('bill_head')->row()->total;

			
		}
		
		
		
		// echo '<pre>';print_r($this->data);die;
		$this->data['js']   = array(
			"assets/plugins/datatables/jquery.dataTables.min.js",
			"assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
			"assets/plugins/datatables-responsive/js/dataTables.responsive.min.js",
			"assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
			"assets/plugins/datatables-buttons/js/dataTables.buttons.min.js",
			"assets/plugins/datatables-buttons/js/buttons.html5.min.js",
			// "assets/plugins/datatables-buttons/js/buttons.print.min.js",
		);
		$this->data['css']     = array(
			"assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
			"assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css",
			"assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css",
		);
		$this->data["pagename"]  = "dayendhistory-list";
		$this->data['page_title'] = "Day End History";
		$this->data['breadcrumb'][0] = "Day End History";
        $this->data['title'] = 'DayEndHistory'; 
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
		$this->load->view('common/breadcrumb',$this->data);
		$this->load->view('day_end_history');
		$this->load->view('common/footer');
	}
    
}
