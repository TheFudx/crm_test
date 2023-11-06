<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Reports extends CI_Controller {
	public function __construct(){
        parent::__construct();

        $this->data['session_data'] = @$this->session->userdata('user_session');
        $this->data['user_permission'] = @$this->session->userdata('user_permission');
        $this->restaurant_id = $this->data['session_data']['restaurant_id'];  

		$this->load->model('Stockmodel');
		$this->load->model('Rawmaterialmodel');
		$this->load->model('Wastagemodel');
		$this->load->model('Categoryreportmodel');
		$this->load->model('Itemreportmodel');
		$this->load->model('Salesreportmodel');
		$this->load->model('Orderreportmodel');
		$this->load->model('Executivereportmodel');
		$this->load->model('EmployeeReportmodel');
		$this->load->model('CounterReportmodel');
		$this->load->model('Kitchenreportmodel');
		
		
		$this->load->model('Managebillmodel');
		$this->load->model('Tippaymentmodel');
		$this->load->model('Creditpaymentmodel');
        
    }

	
	// Show Inventory Main Page baseurl/inventory
	public function index() {
        $this->data['title'] = 'Reports'; 
		$this->data['page_title']   = "Reports";
		$this->data['breadcrumb'][] = 'Reports';
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);		
		$this->load->view('reports/index');
		$this->load->view('common/footer');
	}

	// Show Current Stock List baseurl/currentstock
	public function category(){
        $this->data['data'] = $this->Categoryreportmodel->getCategoryReport($this->restaurant_id);
        $this->data['js']     = array(
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
		$this->data["pagename"]  = "category-report";
		$this->data['page_title'] = "Category Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Category Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/category');
		$this->load->view('common/footer');
	}

    public function item(){
       $this->data['data'] = $this->Itemreportmodel->getItemReport($this->restaurant_id);
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
		$this->data["pagename"]  = "report-item";
		$this->data['page_title'] = "Items Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Item Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/item');
		$this->load->view('common/footer');
	}


    public function sales(){
        $this->data['data'] = $this->Salesreportmodel->getCompleteSalesReport($this->restaurant_id);
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
		$this->data["pagename"]  = "report-sales";
		$this->data['page_title'] = "Sales Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Sales Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/sales');
		$this->load->view('common/footer');
	}


    public function order(){
        $this->data['data'] = $this->Orderreportmodel->getOrderReport($this->restaurant_id);
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
		$this->data["pagename"]  = "report-order";
		$this->data['page_title'] = "Order Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Order Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/order');
		$this->load->view('common/footer');
	}


    public function executive(){
        $this->data['data'] = $this->Executivereportmodel->getCompleteexecReport($this->restaurant_id);
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
		$this->data["pagename"]  = "report-executive";
// 		$this->data['page_title'] = "Executive Report";
		$this->data['page_title'] = "Tax Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Executive Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/executive');
		$this->load->view('common/footer');
	}

    public function employee(){
        $this->data['data'] = $this->EmployeeReportmodel->getEmployeeReport($this->restaurant_id);
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
		$this->data["pagename"]  = "report-employee";
		$this->data['page_title'] = "Employee Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Employee Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/employee');
		$this->load->view('common/footer');
	}
	
	
	public function employeeTip(){
        $this->data['data'] = $this->EmployeeReportmodel->getEmployeeTipReport($this->restaurant_id);
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
		// echo '<pre>'; print_r($this->data); die;
		$this->data["pagename"]  = "report-tip-employee";
		$this->data['page_title'] = "Employee Tip Summary";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Employee Tip Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/employeetip');
		$this->load->view('common/footer');
	}

    public function group(){
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
		$this->data["pagename"]  = "report-group";
		$this->data['page_title'] = "Item wise detailed summary";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Item wise detailed summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/group');
		$this->load->view('common/footer');
	}

        public function tip(){
        $this->data['data'] = $this->Tippaymentmodel->getTippaymentmodel($this->restaurant_id);
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

		$this->data['tipAmount'] = getTipAmountBYBILL($this->restaurant_id);
		$this->data['totaltipAmount'] = getTotalTipAmountBYBILL($this->restaurant_id);

		$this->data["pagename"]  = "report-tip";
		$this->data['page_title'] = "Tip Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Tip Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/tip');
		$this->load->view('common/footer');
	}

    public function counter(){
        $this->data['data'] = $this->CounterReportmodel->getCounterReport($this->restaurant_id);
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
		$this->data["pagename"]  = "report-counter";
		$this->data['page_title'] = "Payment type summary";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Payment type summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/counter',$this->data);
		$this->load->view('common/footer');
	}

    public function kitchen(){
        $this->data['data'] = $this->Kitchenreportmodel->getKitchenReport($this->restaurant_id);
        $this->data['js']   = array(
			"assets/plugins/datatables/jquery.dataTables.min.js",
			"assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js",
			"assets/plugins/datatables-responsive/js/dataTables.responsive.min.js",
			"assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js",
		);
		$this->data['css']     = array(
			"assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css",
			"assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css",
			"assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css",
		);
		$this->data["pagename"]  = "report-kitchen";
		$this->data['page_title'] = "Kitchen Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Kitchen Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/kitchen');
		$this->load->view('common/footer');
	}

    public function ordertime(){
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
		$this->data["pagename"]  = "report-ordertime";
		$this->data['page_title'] = "Order Time Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Order time Summary";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/ordertime');
		$this->load->view('common/footer');
	}
	
	
	
		public function managebill() {
		$payment_type = $this->input->post('payment_type');
		$this->data["payment_type"]        = getPaymentTypeRestaurant($this->restaurant_id);
		
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
    
		$this->data["pagename"]  = "managebill-list";
		$this->data['page_title'] = "Manage Bills";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Manage Bills";
        $this->data['title'] = 'Manage Bills'; 
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
		$this->load->view('common/breadcrumb',$this->data);
		$this->load->view('managebill/index',$this->data);
		$this->load->view('common/footer');
	}



	public function fetch_Bill(){  
		$payment_type = $this->input->post('payment_type');

        $fetch_data = $this->Managebillmodel->getManagebillmodel($this->restaurant_id,$payment_type);  
        $data = array();  
        $i=1;
		$id=1;
        foreach($fetch_data as $row)  
        {  
            $sub_array = array();  
            $sub_array[] = $i++;
            //  $sub_array[] = $row['invoice_no'];  
			//  $sub_array[] = $id++; 
            $sub_array[] = $row['username'];  
            $sub_array[] = $row['grand_total'];  
            $sub_array[] = $row['created_date'];  
            $sub_array[] = "<div class='text-center'><button data-id='".$row['Id']."' onClick='Print(".$row['Id'].")' class='btn'><i class='fas fa-print print_btn'></i></button><button data-id='".$row['Id']."' class='btn PrintManageBill'><i class='far fa-eye view_btn'></i></button> <button onClick='Delete(".$row['Id'].")' class='btn'><i class='fa fa-trash delete__btn' ></i></button> </div>";
            $data[] = $sub_array;  
        }  
        $output = array(  
    	"data"=> $data  
        );  
        echo json_encode($output);  
    }
    
    
    
    
    	public function profitloosssheet(){
        $this->data['data'] = $this->Kitchenreportmodel->getKitchenReport($this->restaurant_id);
		$this->data['cashInvestment'] = getBalancesheetData('cash_flow', $this->restaurant_id, 'I', 0);
		$this->data['cashOut'] = getBalancesheetData('cash_flow', $this->restaurant_id, 'O', 0);
		$this->data['RestaurantData'] = getRestaurantData($this->restaurant_id);
		$this->data['CurrentLiabilities'] = getCurrentLiabilitiesData($this->restaurant_id);
// 		$this->data['fixedassets'] = getFixedassetsData($this->restaurant_id);
        $this->data['fixedassets'] = getFixedassetsplData($this->restaurant_id);

		$this->data['OpeningStock'] = getOpeningStockData($this->restaurant_id);
		$this->data['ClosingStock'] = getClosingStockData($this->restaurant_id);

	

		$this->data['SalePending'] = $this->Creditpaymentmodel->getCreditpaymentTotalmodel($this->restaurant_id);
		$this->data['SaleDoneBILLAmount'] = getINAmountBYBILL($this->restaurant_id);
		$this->data['cashOUT'] = getOUTAmount($this->restaurant_id);

		$this->data['DirectExpense'] = getDirectExpenseData($this->restaurant_id);


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
		
		// echo '<pre>'; print_r($this->data); die;
		$this->data["pagename"]  = "report-profit-loss";
		$this->data['page_title'] = "Profit Loss Sheet Report";
		$this->data['breadcrumb'][] = '<a href="'.base_url().'reports">Reports</a>';
		$this->data['breadcrumb'][] = "Profit Loss Sheet Report";
		$this->load->view('common/header',$this->data);
        $this->load->view('common/sidebar',$this->data);
        $this->load->view('common/breadcrumb',$this->data);
		$this->load->view('reports/profitlosssheet');
		$this->load->view('common/footer');
	}
    
    
    
}
