<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

require 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Receipt extends CI_Controller {
	public function __construct(){
        parent::__construct();

		$session_data = $this->session->userdata('user_session');
        if (!isset($session_data) || empty($session_data)) {
            redirect('login');
        }else{
            $this->data['session_data'] = @$this->session->userdata('user_session');
			$this->data['user_permission'] = @$this->session->userdata('user_permission');

        }
        $this->restaurant_id = $session_data['restaurant_id'];
        $this->load->model('Ordermodel');
        // $this->load->model('admin/commonmodel');
        $this->load->model('Restaurantmodel');
    }

	public function index() {
        
        $this->data['title'] = 'Receipt'; 
        $post_data = $this->input->get();
       // print_r($post_data);
        $result = $this->Ordermodel->GetBill($post_data);
        $this->data["bill"] = $result['data'];
        $this->data["restaurant"] = getData('restaurant', 0, "restaurant_id",$this->restaurant_id);
        // print_r($this->data);
		$this->load->view('common/top',$this->data);
        // $this->load->view('common/sidebar',$this->data);
		// $this->load->view('receipt');

        // $dompdf = new Dompdf(array('enable_remote' => true));
        $dompdf = new Dompdf();
        ob_start();
        $html =ob_get_contents();
        ob_get_clean();
        $html = $this->load->view('receipt_dompdf','',true);
        $dompdf->loadHtml($html);
        $customPaper = array(0,0,230,550);
        $dompdf->setPaper($customPaper);
        $dompdf->render();
        $dompdf->stream($html,['Attachment'=>false ]);

	}
    
    public function kotprint() {
        $this->data['title'] = 'kotprint'; 
        $post_data = $this->input->get();
        // print_r($post_data);
        $this->data["restaurant"]   = getData('restaurant', 0, "restaurant_id",$this->restaurant_id);
        $this->data["kot"]          = $this->Ordermodel->getkottable($post_data);
        $this->load->view('common/top',$this->data);
        // $this->load->view('kot');
        // echo '<pre>';print_r($this->data);die;
        // $dompdf = new Dompdf(array('enable_remote' => true));
        $dompdf = new Dompdf();
        ob_start();
        $html =ob_get_contents();
        ob_get_clean();
        $html = $this->load->view('kot_dompdf','',true);
        $dompdf->loadHtml($html);
        $customPaper = array(0,0,230,550);
        $dompdf->setPaper($customPaper);
        $dompdf->render();
        $dompdf->stream($html,['Attachment'=>false ]);
	}
    
}
