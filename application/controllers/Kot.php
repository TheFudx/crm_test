<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Kot extends CI_Controller {
	public function __construct(){
        parent::__construct();

		$this->data['session_data'] = @$this->session->userdata('user_session');
        $this->data['user_permission'] = @$this->session->userdata('user_permission');
        $this->restaurant_id = $this->data['session_data']['restaurant_id'];
        $this->load->model('Ordermodel');
        $this->load->model('Kotmodel');
         $this->load->model('Stockmodel');
        // $this->load->model('admin/commonmodel');
        
    }

	public function kot() {
        $this->data['title'] = 'KOT List'; 
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->data['order'] = $this->Kotmodel->getkotdata($this->restaurant_id);
        $this->data['order_new'] = $this->Kotmodel->getkotdataTaken($this->restaurant_id);
		$this->load->view('kot',$this->data);
		$this->load->view('common/footer');
	}

    public function index(){
        $this->data['title'] = 'KOT List'; 
        $this->data['restaurant_id'] = $this->restaurant_id; 
        $this->data['kot'] = GetKOTItems($this->restaurant_id); 
        $this->data['session']  = $this->session->userdata('user_session');
        
        $this->data['currentstock'] = $this->Stockmodel->getCurrentStockdata($this->restaurant_id);
             // if(isset($this->data['kot']) ){
        //     if($this->data['kot'][0]['status'] == 'InCooking'){
        //         $this->data['currentstock'] = $this->Stockmodel->getCurrentStockdata($this->restaurant_id);
        //         // echo json_encode($this->data['kot']);
        //         // for array size 
        //         // echo json_encode(sizeof($this->data['kot'])); 
        //         // for array length
        //         // echo $a = json_encode(sizeof($this->data['kot'][0]['items']));
        //         foreach ($this->data['kot'][0]['items'] as $key => $value) {
        //             echo json_encode($value['item_name']);
        //             // for QTY
        //             // echo json_encode($value['qty']);
        //         }
        //         // echo json_encode($this->data['kot'][0]['items']);
        //     }
        // }
        
        
        
        
        $this->data["pagename"]  = "kot-list";
        $this->data['page_title'] = "KOT List";
        $this->data['breadcrumb'][0] = "KOT List";
        // $this->data['breadcrumb'][1] = "";
        $this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
        $this->load->view('tables/kot');
        $this->load->view('common/footer');

    }
}
