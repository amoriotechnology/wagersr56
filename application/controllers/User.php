<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public $user_id;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('lusers');
        $this->load->library('session');
        $this->load->model('Userm');
        $this->auth->check_admin_auth();
    }
    

  
#=============User Manage Company===============#
// public function managecompany()
// {
//   $content = $this->lusers->manage_company();
//         $this->template->full_admin_html_view($content);
// }   

   public function managecompany()
   {   
        $CI = & get_instance();
        $CI->load->model('Companies');
        $cl=$CI->Companies->company_list();

        foreach ($cl as $key => $value) {
            $id = $value['company_id'];
        }
        // $notifyFlag = $this->notificationEmail(false);
        // $notifyFlag = $this->notificationEmail($id);

        $data['company_info'] = $cl;
        $content = $this->load->view('users/mange_company', $data, true);
        $this->template->full_admin_html_view($content);
    }
    
    
    #==============User page load============#
        public function notificationEmail($id = null)
   {    
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Companies');
        $cl=$CI->Companies->companyList($id);
        // $bill_history = $CI->Companies->billHistoryList($id);
        // print_r($cl[0]['files']); die();
        // $mail_set = $CI->Companies->getemailConfig();
        // $stm_user = $mail_set[0]->smtp_user;
        // $stm_pass = $mail_set[0]->smtp_pass;
        // $domain_name = $mail_set[0]->smtp_host;
        // $protocol = $mail_set[0]->protocol;

        $paymentReminder = $cl[0]['payment_reminder_date'];
        $dueDate = $cl[0]['due_date'];
        $s_fees = $cl[0]['subscription_fees'];
        $currency = $cl[0]['currency'];
        $reminderEmail = $cl[0]['mail'];
        $company_id = $cl[0]['company_id'];
        // $company_name = $cl[0]['company_name'];
            
        $cal = $dueDate - $paymentReminder;
        $final_date = date('Y-m-' . $cal);
        $current_date = date('Y-m-d');
        // echo $final_date .' '.$current_date; die();
        $currentFinalDate = new DateTime($final_date);
        $nextBillingDate = clone $currentFinalDate;
        $currentYear = date('Y', strtotime($current_date));
        $currentMonth = date('m', strtotime($current_date));
        $nextBillingDate->setDate($currentYear, $currentMonth + 1, $cal);
        $nextBillingPeriod = $nextBillingDate->format('Y-m-d');


        // if ($final_date > $current_date) {
        //     echo "Final Date is greater than Current Date: $final_date"; 
        // } else if ($final_date == $current_date) {
        //     echo "Final Date is equal to Current Date: $final_date"; 
        // } else {
        //     echo "Final Date is less than Current Date: $final_date"; 
        // }
        
        if($final_date == $current_date){
           // echo "if"; die();
            $config = array(
              'protocol' => 'smtp',
              'smtp_host' => 'ssl://smtp.googlemail.com',
              'smtp_user' => 'madhu.amoriotech@gmail.com',
              'smtp_pass' => 'qpyu nlvg xnsy ovro',
              'smtp_port' => 465,
              'smtp_timeout' => 30,
              'charset' => 'utf-8',
              'newline' => '\r\n',
              'mailtype' => 'html',
            );
        
            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->set_crlf("\r\n");
            $this->email->from('madhu.amoriotech@gmail.com', 'Stockeai');
            $this->email->to($reminderEmail);
            $this->email->subject('Stockeai billing reminder.');
            $this->email->message('Stockeai billing reminder');
            $file_location = FCPATH . 'uploads/Pdf/'.$cl[0]['files']; 
            // $this->email->attach($file_location);
            if(!empty($cl[0]['files'])){
               $file_location = FCPATH . 'uploads/Pdf/'.$cl[0]['files']; 
               $this->email->attach($file_location);
            }
            // $send = $this->email->send();
            if ($this->email->send()) {
                echo "<script>alert('Email Send successfully');</script>"; 
                $data = array(
                    'status' => 'Success',
                    'notification_sent_date' => $final_date,
                    'company_id' => $company_id,
                    'created_date' => $final_date,
                    'invoice_number' => $this->Invoicegenerator(10),
                    'bill_period' => $nextBillingPeriod
                );
            $this->db->insert('bill_history', $data);
             // return true;
            // echo "success";
            // echo $this->db->last_query(); die();
            // redirect(base_url('user/managecompany'));
            }else{
                echo "<script>alert('Email Send Failed !!!!!');</script>";
                echo 'Error sending email: ' . $this->email->print_debugger();
            }   
              
        } else if ($final_date > $current_date) {
             // echo "else"; die();
            
            $config = array(
              'protocol' => $protocol,
              'smtp_host' => $domain_name,
              'smtp_user' => $stm_user,
              'smtp_pass' => $stm_pass,
              'smtp_port' => 465,
              'smtp_timeout' => 30,
              'charset' => 'utf-8',
              'newline' => '\r\n',
              'mailtype' => 'html',
            );
        
            $this->load->library('email');
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->set_crlf("\r\n");
            $this->email->from($stm_user, 'Stockeai');
            $this->email->to($reminderEmail);
            $this->email->subject('Your subscription payment is past due');
            $this->email->message('Your subscription payment is past due. Please proceed to subscribe to continue your service.');
            // $send = $this->email->send();
            if ($this->email->send()) {
                echo "<script>alert('Email Send successfully');</script>"; 
            }else{
                echo "<script>alert('Email Send Failed !!!!!');</script>";
                echo 'Error sending email: ' . $this->email->print_debugger();
            }   
        }
   }

    

    public function adadmin()
    {
    $content = $this->lusers->useraddforms();
        $this->template->full_admin_html_view($content);
    }
    

    public function index($cid = "") {
        $content = $this->lusers->index($cid);
        $this->template->full_admin_html_view($content);
    }

 public function insert_admin_user()
    {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $num_str = sprintf("%03d", mt_rand(1, 999));
        // $password=md5($_REQUEST['password']);
        $password = md5("gef" . $this->input->post('password',true));
        $uid = $_SESSION['user_id'];
        $cmpy_id = $this->input->post('companyid');
        $uname = $this->input->post('username');
        $email = $this->input->post('email',true);
        $exist_user = $CI->Userm->getDatas('user_login', '*', ['user_id' => $cmpy_id, 'username' => $uname]);
        $cmpy_detail = $CI->Userm->getDatas('company_information', '*', ['company_id' => $cmpy_id]);
        if(empty($exist_user)) {
            $data = array(
                'user_id' => $cmpy_id,
                'first_name' => $uname,
                'company_name' => $cmpy_detail[0]['company_name'],
                'address' => $cmpy_detail[0]['address'],
                'phone' => $cmpy_detail[0]['mobile'],
                'unique_id' => "AD".$_POST['companyid'].$num_str,
                'create_by' => $uid,
             );
            $this->db->insert('users', $data);
            $user_login = ['user_id' => $cmpy_id, 'username' => $uname, 'logo' => $cmpy_detail[0]['logo'], 'security_code' => $cmpy_detail[0]['mobile'], 'unique_id' => "AD".$_POST['companyid'].$num_str, 'password' => $password, 'user_type' => 2, 'email_id' => $email, 'cid' => $cmpy_id, 'u_type' => 2, 'create_by' => $uid];
            $CI->Userm->insertData('user_login', $user_login);
            $this->session->set_userdata(array('message' => display('successfully_added')));
            redirect('User/adadmin');
        } else {
            $this->session->set_userdata(array('message' => display('account_already_exists')));
            redirect('User/adadmin');
        }
    }

// Insert Company Branch
public function company_insert_branch()
{
    $uid = $this->input->post('uid', TRUE);
    $c_id = $this->input->post('company_id', TRUE);

    $response = [];

    $tables = ['company_information', 'url', 'url_st', 'url_lctx', 'url_sstx'];

    foreach ($tables as $table) {
        $this->db->where('company_id', $c_id)->delete($table);
    }

    $company_data = [
        'company_name'            => $this->input->post('company_name', TRUE),
        'email'                   => $this->input->post('email', TRUE),
        'address'                 => $this->input->post('address', TRUE),
        'mobile'                  => $this->input->post('mobile', TRUE),
        'website'                 => $this->input->post('website', TRUE),
        'c_city'                  => $this->input->post('c_city', TRUE),
        'c_state'                 => $this->input->post('c_state', TRUE),
        'Bank_Name'               => $this->input->post('Bank_Name', TRUE),
        'Account_Number'          => $this->input->post('Account_Number', TRUE),
        'Bank_Routing_Number'     => $this->input->post('Bank_Routing_Number', TRUE),
        'Bank_Address'            => $this->input->post('Bank_Address', TRUE),
        'Federal_Pin_Number'      => $this->input->post('Federal_Pin_Number', TRUE),
        'st_tax_id'               => $this->input->post('statetx', TRUE),
        'lc_tax_id'               => $this->input->post('localtx', TRUE),
        'State_Sales_Tax_Number'  => $this->input->post('State_Sales_Tax_Number', TRUE),
        'create_by'               => $uid,
        'status'                  => 0
    ];

    $this->db->insert('company_information', $company_data);
    $insert_id = $this->db->insert_id();

    if ($insert_id) {
        $this->insert_url_data('url', $insert_id, $uid, 'user_name', 'password', 'pin_number');
        $this->insert_url_data('url_st', $insert_id, $uid, 'user_name_st', 'password_st', 'pin_number_st');
        $this->insert_url_data('url_lctx', $insert_id, $uid, 'user_name_lctx', 'password_lctx', 'pin_number_lctx');
        $this->insert_url_data('url_sstx', $insert_id, $uid, 'user_name_sstx', 'password_sstx', 'pin_number_sstx');
        
        logEntry($this->session->userdata('user_id'), $this->session->userdata('unique_id'), $this->session->userdata('userName'), 'Add Company', '', '', 'Manage Company', 'Company Added Successfully', 'Add', date('m-d-Y'));

        $response = [
            'status'  => 1,
            'message' => 'Successfully created company branch.',
            'company_id' => $insert_id
        ];
    } else {
        $response = [
            'status'  => 0,
            'message' => 'Failed to create company branch.'
        ];
    }

    echo json_encode($response);
    exit;
}

private function insert_url_data($table, $company_id, $uid, $username_key, $password_key, $pin_key)
{
    $urls = $this->input->post($table, TRUE);
    $usernames = $this->input->post($username_key, TRUE);
    $passwords = $this->input->post($password_key, TRUE);
    $pins = $this->input->post($pin_key, TRUE);

    if ($urls && is_array($urls)) {
        for ($i = 0, $n = count($urls); $i < $n; $i++) {
            $data = [
                'company_id'   => $company_id,
                $table          => $urls[$i],
                $username_key   => $usernames[$i],
                $password_key   => $passwords[$i],
                $pin_key        => $pins[$i],
                'create_by'     => $uid,
            ];
            $this->db->insert($table, $data);
        }
    } 
}




// Update Company Branch
public function company_update_branch()
{
    $company_id = $this->input->post('company_id', TRUE);
    $uid = $this->input->post('uid', TRUE);
    $response = [];
    
    $this->Userm->delete_existing_records($company_id);

    $company_data = array(
        'company_id'             => $company_id,
        'company_name'           => $this->input->post('company_name', TRUE),
        'email'                  => $this->input->post('email', TRUE),
        'c_city'                 => $this->input->post('c_city', TRUE),
        'c_state'                => $this->input->post('c_state', TRUE),
        'address'                => $this->input->post('address', TRUE),
        'mobile'                 => $this->input->post('mobile', TRUE),
        'website'                => $this->input->post('website', TRUE),
        'Bank_Name'              => $this->input->post('Bank_Name', TRUE),
        'Account_Number'         => $this->input->post('Account_Number', TRUE),
        'Bank_Routing_Number'    => $this->input->post('Bank_Routing_Number', TRUE),
        'Bank_Address'           => $this->input->post('Bank_Address', TRUE),
        'Federal_Pin_Number'     => $this->input->post('Federal_Pin_Number', TRUE),
        'st_tax_id'              => $this->input->post('statetx', TRUE),
        'lc_tax_id'              => $this->input->post('localtx', TRUE),
        'State_Sales_Tax_Number' => $this->input->post('State_Sales_Tax_Number', TRUE),
        'create_by'              => $uid,
        'status'                 => 0,
    );

    $insert = $this->db->insert('company_information', $company_data);

    if ($insert) {
        $insert_id = $this->db->insert_id();

        $this->update_url_data('url', $insert_id, $uid, 'user_name', 'password', 'pin_number');
        $this->update_url_data('url_st', $insert_id, $uid, 'user_name_st', 'password_st', 'pin_number_st');
        $this->update_url_data('url_lctx', $insert_id, $uid, 'user_name_lctx', 'password_lctx', 'pin_number_lctx');
        $this->update_url_data('url_sstx', $insert_id, $uid, 'user_name_sstx', 'password_sstx', 'pin_number_sstx');
        
        logEntry($this->session->userdata('user_id'), $this->session->userdata('unique_id'), $this->session->userdata('userName'), 'Update Company', '', '', 'Manage Company', 'Company Update Successfully', 'Update', date('m-d-Y'));
        
        $response = array(
            'status' => 1,
            'message' => 'Company Branch updated successfully.',
            'company_id' => $insert_id,
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Failed to update Company Branch.',
        );
    }

    echo json_encode($response);
    exit;
}

private function update_url_data($table, $company_id, $uid, $username_key, $password_key, $pin_key)
{
    $urls = $this->input->post($table, TRUE);
    $usernames = $this->input->post($username_key, TRUE);
    $passwords = $this->input->post($password_key, TRUE);
    $pins = $this->input->post($pin_key, TRUE);

    if ($urls) {
        for ($i = 0; $i < count($urls); $i++) {
            $data = array(
                'company_id' => $company_id,
                $table       => $urls[$i],
                $username_key => $usernames[$i],
                $password_key => $passwords[$i],
                $pin_key => $pins[$i],
                'create_by'  => $uid,
            );
            $this->db->insert($table, $data);
        }
    }
}



public function company_insert(){
    $CI = & get_instance();
    $CI->load->model('Userm');

    $cmpy_id = $this->input->post('cmpy_id');
    $logo = "";
    if ($_FILES['image']['name']) {
        $config['upload_path']    = 'my-assets/image/logo/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
        $config['encrypt_name']   = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
            redirect(base_url('Admin_dashboard/edit_profile'));
        } else {
            $data = $this->upload->data();
            $logoname = $config['upload_path'].$data['file_name'];
            $config['image_library']  = 'gd2';
            $config['source_image']   = $logoname;
            $config['create_thumb']   = false;
            $config['maintain_ratio'] = TRUE;
            $config['width']          = 200;
            $config['height']         = 200;
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $logo =  $logoname;
        }
    } else {
        $logo = $this->input->post('logo_image');
    }
    // insert Company information///////////////
    $uid=$_SESSION['user_id'];
    $cmpy_name = $this->input->post('company_name',true);
    $mobile = $this->input->post('mobile',true);
    $uname = $this->input->post('username',true);

   $data = array(
        'company_name'  => $cmpy_name,
        'email' => $this->input->post('email',true),
        'c_city'      => $this->input->post('c_city',true),
        'c_state'      => $this->input->post('c_state',true),
        'c_zipcode'      => $this->input->post('zipcode',true),
        'address'      => $this->input->post('address',true),
        'mobile'   => $mobile,
        'website'  => $this->input->post('website',true),
        'user_name'      => $this->input->post('user_name',true),
        'password'      => $this->input->post('password',true),
        'currency'      => $this->input->post('currency',true),
        'subscription_fees'      => $this->input->post('subscription_fees',true),
        'mail'      => $this->input->post('mail',true),
        'due_date'      => $this->input->post('due_date',true),
        'payment_reminder_date'      => $this->input->post('payment_reminder_date',true),
        'logo'       => $logo,
        'create_by'     => $uid,
        'status'     => 1,
  
    );
        
    if(!empty($cmpy_id)) {
        $cid= $cmpy_id;
        $where = ['company_id' => $cid];
        
        $CI->Userm->updateData('company_information', $data, $where);
       
        $CI->Userm->updateData('users', ['create_by' => $uid, 'company_name' => $cmpy_name, 'first_name' => $uname, 'phone' => $mobile, 'userlogo' => $logo], ['user_id' => $cid]);

        $user_data = [
            'username'  => $uname,
            'password' => md5("gef" . $this->input->post('password',true)),
            'logo' => $logo,
            'user_type'      => 1+1,
            'u_type'      => 1+1,
            'email_id'  => $this->input->post('user_email',true),
            'create_by' => $uid,
        ];

        $CI->Userm->updateData('user_login', $user_data, ['user_id' => $cid]);

        $CI->Userm->updateData('payslip_invoice_design', ['user_id' => $cid, 'create_by' => $uid], ['cid' => $cid]);

    } else {
        $this->db->insert('company_information', $data);
        $cid= $this->db->insert_id();

        $CI->Userm->insertData('web_setting', ['create_by' => $cid]);

        $inv_data = ['create_by' => $cid, 'uid' => $cid];
        $CI->Userm->insertData('invoice_design', $inv_data);

        $num_str = sprintf("%03d", mt_rand(1, 999));
        $users_data = ['unique_id' => "AD".$cid.$num_str, 'company_name' => $cmpy_name, 'first_name' => $uname, 'mobile' => $mobile, 'userlogo' => $logo, 'create_by' => $uid, 'user_id' => $cid];
        $CI->Userm->insertData('users', $users_data);

        $user_data = [
            'username'  => $this->input->post('username',true),
            'password' => md5("gef" . $this->input->post('password',true)),
            'logo' => $logo,
            'unique_id'  =>   "AD".$cid.$num_str,
            'user_type'      => 1+1,
            'u_type'      => 1+1,
            'security_code'   => $this->input->post('mobile',true),
            'email_id'  => $this->input->post('user_email',true),
            'status'       =>1,
            'cid'     => $cid,
            'user_id' =>$cid,
            'create_by' => $uid,
        ];
        $CI->Userm->insertData('user_login', $user_data);

        $payslip_info = ['cid' => $cid, 'user_id' => $cid, 'create_by' => $uid];
        $CI->Userm->insertData('payslip_invoice_design', $payslip_info);
    }

    redirect('user/managecompany');
        
}













public function add_user()
{
    $content = $this->lusers->ad_user();
    $this->template->full_admin_html_view($content);
}



#==============Chnage Status=============#

    public function chnage_company_status($value,$id)
    {
       
     echo $sql='update company_information set status ="'.$value.'" where company_id='.$id;
     $query=$this->db->query($sql);
       echo $sql='update user_login set status ="'.$value.'" where cid='.$id;
     $query=$this->db->query($sql);
     if($query)
    {
          redirect('user/managecompany');
    }


    }
    #===============User Search Item===========#

 public function company_edit($id){


  $sql='select * from company_information where company_id='.$id;
 $query=$this->db->query($sql);
$row=$query->result_array();  
  $sql='select * from user_login where cid='.$id;
 $query=$this->db->query($sql);
$row1=$query->result_array(); 
   
    $data=array(
        'company_info'=>$row,
        'user_info'=>$row1,
);
 
   $content = $this->lusers->company_edit_form($data);
        
 $this->template->full_admin_html_view($content);


 }

    // Insert Users
    public function insert_users()
    {
        $id = $this->input->post('user_id');
        $admin_id = $this->input->post('admin_id');
        $user_id = decodeBase64UrlParameter($id);
        $password = md5($this->input->post('password'));

        $cidQuery = $this->db->select('cid')->where('user_id', $user_id)->get('user_login');
        $cidRow = $cidQuery->row_array();
        $cid = isset($cidRow['cid']) ? $cidRow['cid'] : null;

        $num_str = sprintf("%03d", mt_rand(1, 999));
        $unique_id = "UD" . $user_id . $num_str;

        $combinedValue = $this->input->post('employee_name');
        $splitValues = explode(' ', $combinedValue);
        if (count($splitValues) >= 3) {
            $id = $splitValues[0];
            $first_name = $splitValues[1];
            $last_name = $splitValues[2];
        } else {
            $first_name = '';
            $last_name = '';
        }

        $response = array();

        $userData = [
            'last_name' => $last_name,
            'first_name' => $first_name,
            'employee_id' => $id,
            'phone' => $this->input->post('phone'),
            'user_id' => $user_id,
            'gender' => $this->input->post('gender'),
            'unique_id' => $unique_id,
            'date_of_birth' => $this->input->post('dob'),
            'create_by' => $user_id
        ];
        
        logEntry($this->session->userdata('user_id'), $this->session->userdata('unique_id'), $this->session->userdata('userName'), 'Add User', '', '', 'Manage Users', 'User Added Successfully', 'Add', date('m-d-Y'));

        $userInsertSuccess = $this->db->insert('users', $userData);

        $loginData = [
            'username' => $this->input->post('username'),
            'password' => $password,
            'unique_id' => $unique_id,
            'user_id' => $user_id,
            'u_type' => 3,
            'status' => 1,
            'email_id' => $this->input->post('email'),
            'cid' => $cid
        ];

        $loginInsertSuccess = $this->db->insert('user_login', $loginData);



        if ($userInsertSuccess && $loginInsertSuccess) {
            $response = array('status' => 1, 'msg' => 'User Created Successfully.');
        } else {
            $response = array('status' => 1, 'msg' => 'Failed to Created User !!!');
        }

        echo json_encode($response);
        exit;
    }

 
    public function user_search_item() {
        $user_id = $this->input->post('user_id');
        $content = $this->lusers->user_search_item($user_id);
        $this->template->full_admin_html_view($content);
    }

    #================Manage User===============#

    public function manage_user() {
        $content = $this->lusers->user_list();
        $this->template->full_admin_html_view($content);
    }

    // Manage User Data Listing

    public function userdataLists() 
    {
        $encodedId      = isset($_GET['id']) ? $_GET['id'] : null;
        $encodedAdmin   = isset($_GET['admin_id']) ? $_GET['admin_id'] : null;
        $decodeAdmin    = decodeBase64UrlParameter($encodedAdmin);
        $decodedId      = decodeBase64UrlParameter($encodedId);
        $limit          = $this->input->post('length');
        $start          = $this->input->post('start');
        $search         = $this->input->post('search')['value'];
        $orderField     = $this->input->post("columns")[$this->input->post("order")[0]["column"]]["data"];
        $orderDirection = $this->input->post("order")[0]["dir"];
        $totalItems     = $this->Userm->getTotalUserListdata($limit, $start, $search, $decodedId, $orderDirection);
        $items          = $this->Userm->getPaginatedUsers($limit, $start, $orderField, $orderDirection, $search, $decodedId);
        $data           = [];
        $i              = $start + 1;
        foreach ($items as $item) {

            $edit  = '<a href="' . base_url('User/user_update_form?id=' . $encodedId . '&admin_id=' . $encodedAdmin . '&user_id=' . $item['unique_id']) . '" class="btnclr btn" style="margin-bottom: 5px;" data-toggle="tooltip" data-placement="right" title="' . display('edit') . '"><i class="fa fa fa-pencil" aria-hidden="true"></i></a>';

            $delete  = '<a href="' . base_url('User/user_delete?id=' . $encodedId . '&admin_id=' . $encodedAdmin . '&user_id=' . $item['unique_id']) . '" class="btnclr btn" style="margin-bottom: 5px;"  onclick="return confirm(\'' . display('are_you_sure') . '\')" data-toggle="tooltip" data-placement="right" title="' . display('delete') . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';

            $row     = [
                "id"                     => $i,
                "username"               => $item['username'],
                "email_id"               => $item['email_id'],
                "user_type"              => ($item['user_type'] == 2) ? 'Admin' : 'User',
                "status"                 => ($item['status'] == 1) ? 'Active' : 'Inactive',
                'action'                 => $edit .' '. $delete,
            ];
            $data[] = $row;
            $i++;
        }
        $response = [
            "draw"            => $this->input->post('draw'),
            "recordsTotal"    => $totalItems,
            "recordsFiltered" => $totalItems,
            "data"            => $data,
        ];
        echo json_encode($response);
    }


    #==============Add  Company and admin user==============#


    #==============Insert User==============#

    public function insert_user() {
        $this->load->library('upload');
        if (($_FILES['logo']['name'])) {
            $files = $_FILES;
            $config = array();
            $config['upload_path'] = 'assets/dist/img/profile_picture/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size'] = '1000000';
            $config['max_width'] = '1024000';
            $config['max_height'] = '768000';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);
              if (!$this->upload->do_upload('logo')) {
                $data['error_message'] = $this->upload->display_errors();
                $this->session->set_userdata($sdata);
                redirect('user');
            } else {
                $view = $this->upload->data();
                $logo = base_url($config['upload_path'] . $view['file_name']);
            }
            
        }
        $data = array(
            'user_id'    => $this->generator(15),
            'first_name' => $this->input->post('first_name',true),
            'last_name'  => $this->input->post('last_name',true),
            'email'      => $this->input->post('email',true),
            'password'   => md5("gef" . $this->input->post('password',true)),
            'user_type'  => $this->input->post('user_type',true),
            'logo'       => (!empty($logo)?$logo:base_url().'assets/dist/img/profile_picture/profile.jpg'),
            'status'     => 1
        );

        $this->lusers->insert_user($data);
        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-user'])) {
            redirect('User/manage_user');
        } elseif (isset($_POST['add-user-another'])) {
            redirect(base_url('User/manage_user'));
        }
    }

    #===============User update form================#

    public function user_update_form() 
    {   
        $id = $this->input->get('user_id');
        $content = $this->lusers->user_edit_data($id);
        $this->template->full_admin_html_view($content);
    }

    // Edit users

    public function updateUsers()
    {
        $editId = $this->input->post('edit_id'); 

        $id = $this->input->post('user_id');
        $admin_id = $this->input->post('admin_id');
        $user_id = decodeBase64UrlParameter($id);
        $response = array();

        $userData = [
            'last_name' => $this->input->post('last_name'),
            'first_name' => $this->input->post('first_name'),
            'employee_id' => $this->input->post('employee_name'),
            'phone' => $this->input->post('phone'),
            'gender' => $this->input->post('gender'),
            'date_of_birth' => $this->input->post('dob'),
            'create_by' => $user_id, 
        ];

        $this->db->where('unique_id', $editId);
        $userUpdateSuccess = $this->db->update('users', $userData);

        $loginData = [
            'email_id' => $this->input->post('email'),
            'status' => 1,
        ];

        $this->db->where('unique_id', $editId);
        $loginUpdateSuccess = $this->db->update('user_login', $loginData);
        
        logEntry($this->session->userdata('user_id'), $this->session->userdata('unique_id'), $this->session->userdata('userName'), 'Update User', '', '', 'Manage Users', 'User Update Successfully', 'Update', date('m-d-Y'));

        if ($userUpdateSuccess && $loginUpdateSuccess) {
            $response = array('status' => 1, 'msg' => 'User updated successfully.');
        } else {
            $response = array('status' => 0, 'msg' => 'Failed to update user.');
        }

        echo json_encode($response);
        exit;
    }


    #===============User update===================#

    public function user_update() {
      $this->load->library('upload');
        if (($_FILES['logo']['name'])) {
            $files = $_FILES;
            $config = array();
            $config['upload_path'] = 'assets/dist/img/profile_picture/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size'] = '1000000';
            $config['max_width'] = '1024000';
            $config['max_height'] = '768000';
            $config['overwrite'] = FALSE;
            $config['encrypt_name'] = true;

            $this->upload->initialize($config);
              if (!$this->upload->do_upload('logo')) {
                $sdata['error_message'] = $this->upload->display_errors();
                $this->session->set_userdata($sdata);
                redirect('user');
            } else {
                $view = $this->upload->data();
                $logo = base_url($config['upload_path'] . $view['file_name']);
            }
        }
        $user_id = $this->input->post('user_id');
        $data['user_id'] = $user_id;
        $data['logo']   = $logo;
        $this->Userm->update_user($data);
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('User/manage_user'));
    }


   
    #============User delete===========#

    public function user_delete() 
    {   
        $user_id = $this->input->get('user_id');
        $this->Userm->deleteUser($user_id);
        $this->session->set_userdata(array('message' => display('successfully_delete')));
        redirect(base_url("User/manage_user?id=" . $_GET['id'] . "&admin_id=" . $_GET['admin_id']));
    }


    // Random Id generator
    public function generator($lenth) {
        $number = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "N", "M", "O", "P", "Q", "R", "S", "U", "V", "T", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 61);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

    #============User delete===========#

    public function addusers() { 

         $content = $this->lusers->addusers();
        $this->template->full_admin_html_view($content);
    }

     public function edit_user($id)
     {
        $content = $this->lusers->edit_user($id);
            $this->template->full_admin_html_view($content);
     }
     
     public function Invoicegenerator($length) {
        $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9");
        $con = "INV-"; 

        for ($i = 0; $i < $length; $i++) {
            $rand_value = rand(0, 8);
            $rand_number = $number[$rand_value];

            $con .= $rand_number;
        }

        return $con;
    }

}
