<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
ini_set("memory_limit","512M");
require APPPATH . './libraries/REST_Controller.php';
date_default_timezone_set('Asia/Kolkata');

class User extends REST_Controller {
    private $last_query = null;

    function __construct() {
        parent::__construct();
        $this->load->model('Usermodel');
        $this->last_query = false;
        
         $this->load->library('upload');
        $this->path         = FCPATH.'assets/images/users/';
    }
    
    // public function save_post(){ 
    //     // print_r($_POST);
    //     $restaurant_id    = 0 ;
    //     $id = $this->post("main_id");
    //     $groups = $this->post("groups");
    //     $data   = array('status' => false,'validate' => false, 'message' => array());
    //     $this->form_validation->set_rules('main_id', 'User ID', 'required|numeric|trim');
    //     $this->form_validation->set_rules('user_name', 'Username', 'required|callback_whitespace|trim');
    //     $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
    //     $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
    //     if($id == 0){
    //         $this->form_validation->set_rules('pass_word', 'Password', 'required|trim');
    //         // $this->form_validation->set_rules('repassword', 'Invalid Confirm Password', 'trim|required|matches[password]');
    //     }
    //     $this->form_validation->set_rules('status', 'Status', 'required|trim');
    //     $this->form_validation->set_rules('groups', 'Groups', 'required|trim');
    //     if($groups != 1){
    //         $this->form_validation->set_rules('restaurant_id', 'Rrestaurant', 'required|trim');
    //         $restaurant_id    = $this->post("restaurant_id") ;
    //     }
    //     $this->form_validation->set_error_delimiters('', '');
    //     $this->form_validation->set_message('required', 'Enter %s');
    //     if ($this->form_validation->run()) {
    //         $updatedata['restaurant_id']    = $restaurant_id ;
    //         $updatedata['username']         = $this->post("user_name") ;
    //         $updatedata['firstname']        = $this->post("firstname") ;
    //         $updatedata['lastname']         = $this->post("lastname") ;
    //         $updatedata['email']            = $this->post("email") ;
    //         $updatedata['status']           = $this->post("status") ;
    //         $updatedata['groups']           = $this->post("groups") ;
    //         if($this->post("pass_word") != ""){
    //             $updatedata['password']     = md5($this->post("pass_word")) ;
    //             $updatedata['r_password']   = $this->post("pass_word") ;
    //         }
    //         // print_r($updatedata);
    //         $datareq = $this->Usermodel->save($updatedata,$id);
    //         $this->response([
    //             'status'    => $datareq['status'],
    //             'validate'  => TRUE,
    //             'message'   => $datareq['msg']
    //         ], REST_Controller::HTTP_OK);
    //     }else{
    //         foreach ($this->input->post() as $key => $value) {
    //             $verror[$key] = form_error($key);
    //         }
    //         $verror['errorr']  =validation_errors();
    //         $this->response([
    //             'status'    => FALSE,
    //             'validate'  => FALSE,
    //             'message'   => $verror,
    //         ], REST_Controller::HTTP_OK);
    //     }
    // }
    
    
    
    
    
    
    
    // for new update changes start
        public function save_post(){ 
        // print_r($_POST);
        $restaurant_id    = 0 ;
        $id = $this->post("main_id");
        $groups = $this->post("groups");
        $data   = array('status' => false,'validate' => false, 'message' => array());
        $this->form_validation->set_rules('main_id', 'User ID', 'required|numeric|trim');
        $this->form_validation->set_rules('user_name', 'Username', 'required|callback_whitespace|trim');
        $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        if($id == 0){
            $this->form_validation->set_rules('pass_word', 'Password', 'required|trim');
            // $this->form_validation->set_rules('repassword', 'Invalid Confirm Password', 'trim|required|matches[password]');
        }
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('groups', 'Groups', 'required|trim');
    
        if($groups != 1){
            $this->form_validation->set_rules('restaurant_id', 'Rrestaurant', 'required|trim');
            $restaurant_id    = $this->post("restaurant_id") ;
        }
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_message('required', 'Enter %s');
        if ($this->form_validation->run()) {
            $updatedata['restaurant_id']    = $restaurant_id ;
            $updatedata['username']         = $this->post("user_name") ;
            $updatedata['firstname']        = $this->post("firstname") ;
            $updatedata['lastname']         = $this->post("lastname") ;
            $updatedata['email']            = $this->post("email") ;
            $updatedata['status']           = $this->post("status") ;
            $updatedata['groups']           = $this->post("groups") ;
            
            
            $managedata['adminID'] = $id;
            
            $managedata['mobile']  =  $this->post("mobile") ;
            $managedata['msalary']  =  $this->post("msalary") ;
            $managedata['increment']  =  $this->post("increment") ;

            // $managedata['photo'] = $this->post("user_photo");
            $path = $this->path.$id.'/'.date("his").'user_photo'.$id.$_FILES['user_photo']['name'];
            $idpath = $this->path.$id.'/'.date("his").'idproof_photo'.$id.$_FILES['idproof_photo']['name'];
            $addpath = $this->path.$id.'/'.date("his").'address_photo'.$id.$_FILES['address_photo']['name'];

            if(is_file($path) || is_file($idpath)  || is_file($addpath)){
                // print_r('there'.$path);
                $updatedata['restaurant_id']    = $restaurant_id ;
                $updatedata['username']         = $this->post("user_name") ;
                $updatedata['firstname']        = $this->post("firstname") ;
                $updatedata['lastname']         = $this->post("lastname") ;
                $updatedata['email']            = $this->post("email") ;
                $updatedata['status']           = $this->post("status") ;
                $updatedata['groups']           = $this->post("groups") ;
                $managedata['adminID']          = $id;
                $managedata['mobile']           = $this->post("mobile") ;
                $managedata['msalary']          = $this->post("msalary") ;
                $managedata['increment']        = $this->post("increment") ;

                if($this->post("pass_word") != ""){
                    $updatedata['password']     = md5($this->post("pass_word")) ;
                    $updatedata['r_password']   = $this->post("pass_word") ;
                }
                // print_r($updatedata);
                $datareq = $this->Usermodel->save($updatedata,$managedata,$id);
                $this->response([
                    'status'    => $datareq['status'],
                    'validate'  => TRUE,
                    'message'   => $datareq['msg']
                ], REST_Controller::HTTP_OK);
               
                
            }else{
                $folder = $this->path.$id.'/';
                if(!is_dir($folder)){
                    mkdir($this->path.$id, 0777, true);   
                }
                if(file_exists($_FILES['user_photo']['tmp_name'])){
                    $new_name = $_FILES["user_photo"]['name'];
                    $user_image= array(
                        'file_name' => date("his").'user_photo'.$id.'_'.$new_name,
                        'upload_path' => $this->path.$id.'/',
                        'allowed_types' => 'gif|jpg|png|jpeg',
                        'max_size' => 500,
                        'max_width' => 300,
                        'max_height' => 300,
                    );
                    $this->load->library('upload',$user_image);
                    $this->upload->initialize($user_image);

                    // FCPATH.'assets/images/users/'

                    if ( ! $this->upload->do_upload('user_photo')) {
                        $error = array('error' => $this->upload->display_errors()); 
                        echo $this->upload->display_errors(); 
  
                    }else{

                        $fdata = $this->upload->data();
                        $fname = $id.'/'.date("his").'user_photo'.$id.'_'.$_FILES["user_photo"]['name'];
                        $managedata['photo'] = $fname;
                    }
                }
                if(file_exists($_FILES['idproof_photo']['tmp_name'])){
                    $idnew_name = $_FILES["idproof_photo"]['name'];
                    $idproof_image= array(
                        'file_name' => date("his").'idproof_photo'.$id.'_'.$idnew_name,
                        'upload_path' => $this->path.$id.'/',
                        'allowed_types' => 'gif|jpg|png|jpeg',
                        'max_size' => 1024,
                        'max_width' => 1024,
                        'max_height' => 800,
                    );
                    $this->load->library('upload',$idproof_image);
                    $this->upload->initialize($idproof_image);
                    if ( ! $this->upload->do_upload('idproof_photo')) {
                        $error = array('error' => $this->upload->display_errors()); 
                        echo $this->upload->display_errors(); 
                    }else{
                        $idfdata = $this->upload->data();
                        $idfname = $id.'/'.date("his").'idproof_photo'.$id.'_'.$_FILES["idproof_photo"]['name'];
                        $managedata['idproof_photo'] = $idfname;
                    }
                }

                if(file_exists($_FILES['address_photo']['tmp_name'])){
                    $addnew_name = $_FILES["address_photo"]['name'];
                    $adduser_image= array(
                        'file_name' => date("his").'address_photo'.$id.'_'.$addnew_name,
                        'upload_path' => $this->path.$id.'/',
                        'allowed_types' => 'gif|jpg|png|jpeg',
                        'max_size' => 1000,
                        'max_width' => 1024,
                        'max_height' => 800,
                    );
                    $this->load->library('upload',$adduser_image);
                    $this->upload->initialize($adduser_image);
                    if ( ! $this->upload->do_upload('address_photo')) {
                        $error = array('error' => $this->upload->display_errors()); 
                        echo $this->upload->display_errors(); 
                    }else{
                        $Addfdata = $this->upload->data();
                        $Addfname = $id.'/'.date("his").'address_photo'.$id.'_'.$_FILES["address_photo"]['name'];
                        $managedata['address_photo'] = $Addfname;
                    }
                }
                
            }

            
            if($this->post("pass_word") != ""){
                $updatedata['password']     = md5($this->post("pass_word")) ;
                $updatedata['r_password']   = $this->post("pass_word") ;
            }
            // print_r($updatedata);
            $datareq = $this->Usermodel->save($updatedata,$managedata,$id);
            $this->response([
                'status'    => $datareq['status'],
                'validate'  => TRUE,
                'message'   => $datareq['msg']
            ], REST_Controller::HTTP_OK);
        }else{
            foreach ($this->input->post() as $key => $value) {
                $verror[$key] = form_error($key);
            }
            $verror['errorr']  =validation_errors();
            $this->response([
                'status'    => FALSE,
                'validate'  => FALSE,
                'message'   => $verror,
            ], REST_Controller::HTTP_OK);
        }
    }
    
    // for new update changes end
    
    
    
    
    

    public function whitespace($username){
        if ( preg_match('/\s/',$username) ){
            $this->form_validation->set_message('whitespace', 'Username Not contain space');
            return FALSE;
        }else{
            return TRUE;
        }
    }

     public function delete_post(){ 
        $this->form_validation->set_rules('main_id', 'userId', 'required|numeric|trim');
        $this->form_validation->set_error_delimiters('', '');
        $this->form_validation->set_message('required', 'Enter %s');
        if ($this->form_validation->run()) {
            $id     = $this->post('main_id');
            $delete = $this->Usermodel->delete($id);
            $this->response([
                'status'    => $delete['status'],
                'validate'  => TRUE,
                'message'   => $delete['msg']
            ], REST_Controller::HTTP_OK);
        }else{
            foreach ($this->post() as $key => $value) {
                $verror[$key] = form_error($key);
            }
            $this->response([
                'status'    => FALSE,
                'validate'  => FALSE,
                'message'   => $verror,
            ], REST_Controller::HTTP_OK);
        }
    }
}