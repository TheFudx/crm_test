<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Creditpayment extends CI_Controller {
	public function __construct(){
        parent::__construct();

        $this->data['session_data'] = @$this->session->userdata('user_session');
        $this->data['user_permission'] = @$this->session->userdata('user_permission');
        $this->restaurant_id = $this->data['session_data']['restaurant_id'];  

		$this->load->model('Creditpaymentmodel');
        
    }

	
	// Show Inventory Main Page baseurl/inventory

	public function index() {
        $this->data['title'] = 'Credit Payment'; 
		$this->data['page_title']   = "Credit Payment";
		$this->data['breadcrumb'][] = 'Credit Payment';
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);		
		$this->load->view('creditpayment/index');
		$this->load->view('common/footer');
	}



	public function creditpaymentPending() {

		$this->data['data'] = $this->Creditpaymentmodel->getCreditpaymentmodel($this->restaurant_id);

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

        $this->data["pagename"]  = "credit-payment-list";
		$this->data['page_title'] = "Credit Payment Pending List";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'creditpayment">Credit Payment</a>';
		$this->data['breadcrumb'][] = "Credit Payment Pending List";
		// echo '<pre>';print_r($this->data);die;
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('creditpayment/creditpayment-pending');
		$this->load->view('common/footer');
	}





	public function creditpaymentPaid() {

		$this->data['data'] = $this->Creditpaymentmodel->getCreditpaymentPaidmodel($this->restaurant_id);

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

        $this->data["pagename"]  = "credit-payment-paid-list";
		$this->data['page_title'] = "Credit Payment Paid List";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'creditpayment">Credit Payment</a>';
		$this->data['breadcrumb'][] = "Credit Payment Paid List";
		// echo '<pre>';print_r($this->data);die;
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('creditpayment/creditpayment-paid');
		$this->load->view('common/footer');
	}

}
