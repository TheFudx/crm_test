<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
    require APPPATH . './libraries/REST_Controller.php';
    date_default_timezone_set('Asia/Kolkata');

class Tableorder extends REST_Controller {
    private $last_query= null;
    function __construct() {
        parent::__construct();

        $this->load->model('Kotmodel'); 
        $this->load->model('OrdertimeReportmodel'); 
        $this->load->model('Tippaymentmodel');   
        $this->load->model('Rawmaterialmodel');   
        $this->last_query = false;


    }


    public function save_post(){
        $Return = array('status' => false,'validate' => false, 'message' => array());
        $id = $_POST['Id'];
        $str     = implode(",",$id); 
        $result  = $this->Kotmodel->save($str);
        $this->response([
        'validate' => TRUE,'status' => $result['status'],'message' => $result['msg']], REST_Controller::HTTP_OK);
    }


    // public function sendMail_post(){
    //     $to_email = $_POST["email"];
    //     $msg = 'your bill id is '.$this->post("bill_id") ;
    //     $msg1 = urlencode($msg);     
    //     require 'PHPMailer/src/Exception.php'; 
    //     require 'PHPMailer/src/PHPMailer.php'; 
    //     require 'PHPMailer/src/SMTP.php';  
    //     $mail = new PHPMailer\PHPMailer\PHPMailer(); 
    //     try { 
    //         $mail->SMTPDebug = 2;                                                                                                    
    //         $mail->isSMTP();                                                                                                                         
    //         $mail->Host        = 'smtp.gmail.com;';                                                        
    //         $mail->SMTPAuth = true;     
    //         $mail->Username = 'gmailid@gmail.com';                                     
    //         // $mail->Password = 'ynlzkklixmzrsmbq';                                                                                                                        
    //         // $mail->Password = 'apna password dalde';                                                                                                                        
    //         $mail->SMTPSecure = 'tls';                                                                         
    //         $mail->Port         = 587; 
    //         $mail->setFrom($to_email, 'Sumesh Test');             
    //         $mail->addAddress($to_email); // where you want to send mail 
    //         $mail->isHTML(true);                                                                                            
    //         $mail->Subject = 'Subject'; 
    //         $mail->Body = "HTML message body in <b>'$msg'</b> "; 
    //         $mail->send(); 
    //         // echo "Mail has been sent successfully!"; 
    //         $this->response([
    //             'validate' => TRUE,
    //             'status' => $mail->status,
    //             'message' => $mail->send(),
    //         ], REST_Controller::HTTP_OK);
    //         } catch (Exception $e) { 
    //                 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; 
    //                 $this->response([
    //                     'validate' => TRUE,
    //                     'status' => $mail->status,
    //                     'message' => $mail->ErrorInfo
    //               ], REST_Controller::HTTP_OK);
    //         } 
    // }


    public function watch_get(){
        $bill_id     = $this->get('bill_id');
        $OrderHistory = $this->OrdertimeReportmodel->getOrderTimeWatch($bill_id);
        $this->response([
            'message' => 'Get Data',
            'data'    => $OrderHistory,
        ], REST_Controller::HTTP_OK);
    }
    
    
    
    
    
     public function tippayamount_post(){

        $Return = array('status' => false,'validate' => false, 'message' => array());
        $this->form_validation->set_rules('Id', 'Order Id Missing', 'required|numeric|trim');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_message('required', 'Enter %s');
        if ($this->form_validation->run()) {
            $data['Id']       = $this->post('Id');
            $data['tip_amt']  = $this->post('tip_amt');
            $result           = $this->Tippaymentmodel->save($data);
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






        public function rawmaterial_post(){
        $Return = array('status' => false,'validate' => false, 'message' => array());
        $id              = $this->post('Id');
        $restaurant_id   = $this->post('restaurant_id');
        if(!isset($id) || !isset($restaurant_id)){
            echo 'Restaurant Id is not set';
        }else{
            $result          = $this->Rawmaterialmodel->useRawmaterial($id,$restaurant_id);
            foreach($result as $key => $row){ 
                $QTY = 1*$row['qty'];
                if($row['qty']>1){
                    print_r($QTY);
                }           
                $resultlist = $this->Rawmaterialmodel->useRawmateriallist($row['item_id']);
                foreach($resultlist as $keys => $data){
                    $raw_qty = '';
                    if($data['units'] =='GRM'){
                        $raw_qty = $QTY*($data['quantity']*0.001);
                    }elseif ($data['units'] =='GM') {
                        $raw_qty = $QTY*($data['quantity']*0.001);
                    }elseif ($data['units'] =='ML') {
                        $raw_qty = $QTY*($data['quantity']*0.001);
                    }else{
                        $raw_qty = $QTY*$data['quantity'];
                    }
                    $rawmateriallist = $this->Rawmaterialmodel->subtractmaterial($data['rawmaterial_id'],$raw_qty,$restaurant_id);
                    $current_stock = $rawmateriallist['current_stock'];
                    $newStock = $current_stock - $raw_qty;
                    $where = array(
                        'restaurant_id'  => $restaurant_id, 
                        'rawmaterial_id' =>$data['rawmaterial_id'], 
                    );
                    if($newStock >= 0){
                        $this->db->set('current_stock', $newStock, false);        
                    }else{
                        $this->db->set('current_stock', $newStock, false);        
                    }
                    $this->db->where($where);
                    $this->db->update('current_stock');
                    print_r($newStock);
                }
            }
        }
    }



    
}