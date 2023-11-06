<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Cashflow extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->data['session_data'] = @$this->session->userdata('user_session');
        $this->data['user_permission'] = @$this->session->userdata('user_permission');
        $this->restaurant_id = $this->data['session_data']['restaurant_id'];  
    }

	// public function index() {
    //     $this->data['title'] = 'Cash Flow'; 
	// 	$this->load->view('common/header',$this->data);
    //     $this->load->view('common/sidebar',$this->data);
	// 	$this->load->view('cash_flow');
	// 	$this->load->view('common/footer');
	// }

    public function index()
	{
        $this->data['data'] = getExpenseData('cash_flow', $this->restaurant_id, '', 0);
        
        $this->data['cashIN'] = getINAmount($this->restaurant_id);
		$this->data['cashOUT'] = getOUTAmount($this->restaurant_id);
		$this->data['BILLAmount'] = getINAmountBYBILL($this->restaurant_id);
		
		$this->data['cashBANKIN'] = getBANKINAmount($this->restaurant_id);
		$this->data['cashBANKOUT'] = getBANKOUTAmount($this->restaurant_id);
		
        $this->data['js']   = array(
			"assets/plugins/datatables/jquery.dataTables.min.js",
            "assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
            "assets/plugins/datatables-responsive/js/dataTables.responsive.min.js",
            "assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
            "assets/plugins/datatables-buttons/js/dataTables.buttons.min.js",
            "assets/plugins/datatables-buttons/js/buttons.html5.min.js",
		);
		$this->data['css']     = array(
			"assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
			"assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css",
			"assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css",
		);
		$this->data["pagename"]  = "expense-list";
		$this->data['page_title'] = "Manage Cash Flow";
		$this->data['breadcrumb'][0] = "CashFlow";
		// $this->data['breadcrumb'][1] = "";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('cash/index');
		$this->load->view('common/footer');
		//$this->render_template('groups/index', $this->data);
	}	

}
