<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Companies',
          
        )); 

    }
    public function index(){
         $json['response'] = array(
                'status'  => 'ok',
                'message' => "Welcome to our store",
            );
            
            echo json_encode($json,JSON_UNESCAPED_UNICODE);
        
    }
    
    public function companyinfo(){
           $user_id = $this->input->get('userid');
         $company = $this->Companies->retrieve_company($user_id);
         $json['response'] = array(
                'status'       => 'ok',
                'company_info' => $company,
            );
            
            echo json_encode($json,JSON_UNESCAPED_UNICODE);
    }
    
   
    public function login(){  

          $email = $this->input->get('email');
         $password =  $this->input->get('password'); 
        if (empty($email) || empty($password)) {
            $json['response'] = [
                'status'     => 'error',
                'type'       => 'required_field',
                'message'    => 'required_field',
                'permission' => 'read'
            ];

        } else {


            $data['user'] = (object) $userData =  [
                'email'      => $email,
                'password'   => $password
            ];


            $user = $this->checkUser($userData);


            if($user->num_rows() > 0) {
         
         
                $sData = array(
                    'user_id'     => $user->row()->user_id,
                    'user_name'   => $user->row()->first_name.' '.$user->row()->last_name,
                    'user_email'  => $user->row()->username,
                    'user_type'   => $user->row()->user_type,
                    'image'       => $user->row()->logo,
                    'password'    => $user->row()->password,
                );
                
                $json['response'] = [
                    'status'       => 'ok',
                    'user_data'    => $sData,
                    'message'      => 'successfully_login',
                     'permission'  => 'read'
                ];

            } else {

                $json['response'] = [
                    'status'     => 'error',
                    'message'    => display('no_data_found'),
                    'permission' => 'read'
                ];

            } 

        }
        
        

        echo json_encode($json, JSON_UNESCAPED_UNICODE); 

    }

   
    
    }



