<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . './libraries/REST_Controller.php';
date_default_timezone_set('Asia/Kolkata');

class Creditpayment extends REST_Controller {
    private $last_query= null;
    function __construct() {
        parent::__construct();

        $this->load->model('Creditpaymentmodel');   
        $this->last_query = false;
    }

    public function getdetail_post() {
        $invoice_no = $this->post('invoice_no');
        $restaurant_id = $this->post('restaurant_id');
        $customer_id = $this->post('customer_id');
        $result = $this->Creditpaymentmodel->getCreditpayment($invoice_no,$restaurant_id);

        if(!empty($result)){
            $data['status'] = TRUE;
            $data['grand_total']  = $result->grand_total;
            $data['invoice_no']  = $result->invoice_no;
            $data['restaurant_id']  = $result->restaurant_id;
            $data['customer_id']  = $result->customer_id;
            $this->response($data, REST_Controller::HTTP_OK);
        }else{
            //set the response and exit
            $this->response([
                'status' => FALSE,
                'grand_total' => 0,
                'invoice_no' => 0,
                'message' => 'No Record Found.'
            ], REST_Controller::HTTP_OK);
        }
    }

    public function creditpayamount_post(){
        // print_r($_POST);exit;
        $Return = array('status' => false,'validate' => false, 'message' => array());

        $this->form_validation->set_rules('restaurant_id', 'Restaurant Id Missing', 'required|numeric|trim');
        $this->form_validation->set_rules('customer_id', 'Customer Id Missing', 'required|numeric|trim');
        $this->form_validation->set_rules('invoice_no', 'Invoice No Missing', 'required|numeric|trim');
        $this->form_validation->set_rules('grand_total', 'BillAmount Amount', 'required|trim');
        $this->form_validation->set_rules('room', 'Room', 'required|trim');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_message('required', 'Enter %s');
        if ($this->form_validation->run()) {
            $main_id = $this->post('main_id');
            $data['customer_id']    = $this->post('customer_id');
            $data['restaurant_id']  = $this->post('restaurant_id');
            $data['invoice_no']     = $this->post('invoice_no');
            $data['amount']         = $this->post('grand_total');
             $data['room']         = $this->post('room');
            $result                 = $this->Creditpaymentmodel->save($data,$main_id);
            $this->response([
                'validate' => TRUE,
                'status' => $result['status'],
                'message' => $result['msg']
            ], REST_Controller::HTTP_OK);
            
        } else {
            foreach ($this->input->post() as $key => $value) {
                $verror[$key] = form_error($key);
            }
            $verror['y'] = validation_errors();
            $this->response([
                'validate'   => FALSE,
                'status' => FALSE,
                'message' => $verror
            ], REST_Controller::HTTP_OK);
        }
    }
}