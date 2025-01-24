<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
        $this->template->current_menu = 'home';
        $this->load->model('Web_settings');

        $this->load->database();
    }




    public function index() {
        
        $date = $this->input->post('daterangepicker-field',TRUE);
        if($date==''){
            $prev_month = date('Y-m-d', strtotime("-1 months", strtotime("NOW"))); 
$current=date('Y-m-d');
 $date= $prev_month."to". $current;

        }
        
        $date = str_replace(' ', '', $date);
        $split=explode("to",$date);
      
        $CI = & get_instance();
    
        if (!$this->auth->is_logged()) {
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
        }

        $this->auth->check_admin_auth();

      
        $CI->load->model('Web_settings');
      
    
        $data = array(
          
        );
   
        $content = $CI->parser->parse('include/admin_home', $data, true);
        // print_r($data); die();
        $this->template->full_admin_html_view($content);
    }









       public function forgot()
        {
                 $CI = & get_instance();
        $this->load->model('Users');
        
                     $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
   
                $email = $this->input->post('email');  
                 $clean = $this->security->xss_clean($email);

            $userInfo = $CI->Users->getUserInfoByEmail($clean);
    //  print_r($userInfo);
                $email = $this->input->post('email');  
                 $clean = $this->security->xss_clean($email);
   $to = $email;
                
                
                if(empty($userInfo)){
                    $this->session->set_flashdata('flash_message', 'We cant find your email address');
                  //  redirect(site_url().'Admin_dashboard/login');
                }   
                
              
  
  $token = $CI->Users->insertToken($userInfo[0]['unique_id']);        
      
                             
                $qstring = $this->base64url_encode($token);                  
                $url = site_url() . 'Admin_dashboard/reset_password/token/' . $qstring;
                $link = '<a href="' . $url . '">' . $url . '</a>'; 
                $subject="Stockeai - Reset Password";
                $message = '';                     
                $message .= '<strong>Greeting from Stockeai</strong><br>
There was a request to change your password!
If you did not make this request then please ignore this email.
Otherwise, please click this link to change your password:</strong><br>';
                $message .= '<strong>' . $link.'</strong> ';             

        

        try {
          $setting_detail = $this->db->select('*')->from('email_config')->get()->row();

    

        $config = Array(

        'protocol'  => $setting_detail->protocol,

        'smtp_host' => $setting_detail->smtp_host,

        'smtp_port' => $setting_detail->smtp_port,

        'smtp_user' => $setting_detail->smtp_user,

        'smtp_pass' => $setting_detail->smtp_pass,

        'mailtype'  => 'html', 

        'charset'   => 'utf-8',

        'wordwrap'  => TRUE

        );
     $this->load->library('email', $config);

        $this->email->set_newline("\r\n");

        $this->email->from($setting_detail->smtp_user);

        $this->email->to($to);

        $this->email->subject($subject);

        $this->email->message($message);

       // $this->email->attach($file_path);

        $check_email = $this->test_input($email);
        $this->email->send();
            // echo 'Message has been sent';
            echo "<script>alert('Email Send Successfully')</script>";
        
         sleep(2);
redirect(base_url()."Admin_dashboard/login");
  $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
                // if($result){
                //    echo "<script>alert('Inserted Success')</script>";
                // }else{
                //     echo "<script>alert('Inserted Failed !!!')</script>";
                // }
            // echo "<script>window.location.href='select_quote.html'</script>";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
       
    
                
            
            
    
    }
   

           public function reset_password()
        {
                $CI = & get_instance();
        $this->load->model('Users');
            $token = $this->base64url_decode($this->uri->segment(4));                  
            $cleanToken = $this->security->xss_clean($token);
            
            $user_info = $CI->Users->isTokenValid($cleanToken); //either false or array();               
          
            if(!$user_info){
                $this->session->set_flashdata('flash_message', 'Token is invalid or expired');
                redirect(site_url().'Admin_dashboard/login');
            }            
            $data = array(
                'firstName'=> $user_info->username, 
                'email'=>$user_info->email_id, 
//                'user_id'=>$user_info->id, 
                'token'=>$this->base64url_encode($token)
            );
           
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
            
            if ($this->form_validation->run() == FALSE) {   
               
                $this->load->view('reset_password', $data);
    
            }else{
                                
                $this->load->library('password');                 
                $post = $this->input->post(NULL, TRUE);                
                $cleanPost = $this->security->xss_clean($post);                
              //  $hashed = $this->password->create_hash($cleanPost['password']);      
                
                  $hashed=md5('gef'.$cleanPost['password']);     
                $cleanPost['password'] = $hashed;
                $cleanPost['unique_id'] = $user_info->unique_id;
                unset($cleanPost['passconf']);                
                if(!$CI->Users->updatePassword($cleanPost)){
                    $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
                }else{
                    ?>
<script type="text/javascript">
window.history.go(-2);
</script>
<?php
                    sleep(5);
                   $this->session->set_flashdata('flash_message', 'Your password has been updated. You may now login');
                      header("Location:".base_url()."/Admin_dashboard/login/");
                }
               // redirect(site_url().'Admin_dashboard/login');                
            }
        }
            public function base64url_encode($data) { 
      return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
    } 

 
    #============User login=========#

    public function login() {


        
        if ($this->auth->is_logged()) {
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard', TRUE, 302);
        }
        $data['title'] = display('admin_login_area');
        $content = $this->parser->parse('user/admin_login_form', $data, true);
        $this->template->full_admin_html_view($content);
    }

 public function userauth() {

 $this->load->library('session');
 $this->session;

  $query='select * from user_login where username="'.$_REQUEST['username'].'"';
  $query=$this->db->query($query);
  $row=$query->result_array();

$u_type=$row[0]['u_type'];
         $this->session->set_userdata('u_type',$u_type); 
         $this->session->set_userdata('u_name',$row[0]['username']);
         $this->session->set_userdata('unique_id',$row[0]['unique_id']); 
         $this->session->set_userdata('userName',$row[0]['username']);

$sql='select * from user_login where username="'.$_POST['username'].'"';


$query=$this->db->query($sql);

$row=$query->result_array();
$user_id=$row[0]['user_id']; 
$unique_id=$row[0]['unique_id']; 
$this->session->set_userdata('unique_id',$unique_id); 
$query1='select * from company_information where company_id="'.$row[0]['cid'].'"';

$query1=$this->db->query($query1);

$row1=$query1->result_array();
$logo=$row1[0]['logo']; 
   $this->session->set_userdata('logo',$row1[0]['logo']); 
   $this->session->set_userdata('company_name',$row1[0]['company_name']);


$sql='select * from sec_userrole  where user_id="'.$user_id.'"';

echo $sql;

$query=$this->db->query($sql);

echo $this->db->last_query(); 

$row=$query->result_array();
 $num=$query->num_rows();
 if($num>0)
 {
 $roleid=$row[0]['roleid'];

 $sql='SELECT GROUP_CONCAT(CONCAT(`menu`, " - ", `create`,`price`,`update`,`delete`) SEPARATOR ", ") AS items FROM role_permission where role_id="'.$roleid.'"';
 echo $sql;

$query=$this->db->query($sql);
$row=$query->result_array();
$sale=array();$product=array();

foreach($row as $val){
foreach($val as $perm_data){
     $perm_data=explode(',',$perm_data);
     $this->session->set_userdata('perm_data',$perm_data); 
}



}

   }



     
       //admin role access
$sql2='select * from company_assignrole  where user_id="'.$user_id.'"';
 $query=$this->db->query($sql2);
 $row=$query->result_array();
 $nums=$query->num_rows();
// print_r($nums); die();
// echo $sql2; die();
 if($nums>0)
 {
 $roleid=$row[0]['roleid'];
//  print_r($roleid);
 $sql2='SELECT GROUP_CONCAT(CONCAT(`menu`, " - ", `create`) SEPARATOR ", ") AS items FROM super_permission where role_id="'.$roleid.'"';
//  echo $sql2; die();
$query=$this->db->query($sql2);
$row2=$query->result_array();
$sale=array();$product=array();
// print_r($row2); die();
     foreach($row2 as $val1){
     foreach($val1 as $admin_data){
     $admin_data=explode(',',$admin_data);
    //  print_r($admin_data); die();
     $this->session->set_userdata('admin_data',$admin_data);
      }
     }
    }
        if (!$this->input->post('username',TRUE)) {
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
        }
        if ($this->auth->is_logged()) {
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard', TRUE, 302);
        }
        $dat['username'] = $this->input->post('username',TRUE);
        $dat['password']= $this->input->post('password',TRUE);
        $dat['otp']=$otp=rand(1000,9999);
        $this->session->set_userdata($dat);
        $data['title'] = display('admin_login_area');
        $from_email = "info@gmail.com";
         $to_email = $this->input->post('username');
         //Load email library
         $this->load->library('email');
         $this->email->from($from_email, 'kptest');
         $this->email->to($to_email);
         $this->email->subject('Email Test');
         $this->email->message('One time OTP Passkey .'.$otp);
         //Send mail
         if($this->email->send())
         $this->session->set_flashdata("email_sent","Email sent successfully.");
         else
         $this->session->set_flashdata("email_sent","Error in sending Email.");
        //$this->load->view('user/admin_auth_form', $data, true);
        //echo $this->session->userdata('otp');
     redirect(base_url() . 'Admin_dashboard/do_login');
       echo $content = $this->parser->parse('user/admin_auth_form', $data, true);
        //$this->template->full_admin_html_view($content);
    }













    #==============Valid user check=======#

     public function do_login() {
        $error = '';
        $setting_detail = $this->Web_settings->retrieve_setting_editdata();

        if ($setting_detail[0]['captcha'] == 0 && $setting_detail[0]['secret_key'] != null && $setting_detail[0]['site_key'] != null) {

            $this->form_validation->set_rules('g-recaptcha-response', 'recaptcha validation', 'required|callback_validate_captcha');
            $this->form_validation->set_message('validate_captcha', 'Please check the the captcha form');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_userdata(array('error_message' => display('please_enter_valid_captcha')));
                $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            } else {
                $username = $this->input->post('username',TRUE);
                $password = $this->input->post('password',TRUE);
                if ($username == '' || $password == '' || $this->auth->login($username, $password) === FALSE) {
                    $error = display('wrong_username_or_password');
                }
                if ($error != '') {
                    $this->session->set_userdata(array('error_message' => $error));
                    $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
                } else {
                    $this->output->set_header("Location: " . base_url(), TRUE, 302);
                }
            }
        } else {
            // $username = $this->input->post('username',TRUE);
            // $password = $this->input->post('password',TRUE);
            //if ($this->session->userdata('otp')==$this->input->post('otp',TRUE)) {
            if ($this->session->userdata('otp')) {
             
            $username =  $this->session->userdata('username');
            $password = $this->session->userdata('password');
            
            if ($username == '' || $password == '' || $this->auth->login($username, $password) === FALSE) {
                $error = display('wrong_username_or_password');
            }
            }else{
            $error = 'invalid otp';
        }
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('password');
            if ($error != '') {
                $this->session->set_userdata(array('error_message' => $error));
                $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
            } else {

                 // Remove Sql Mode Only full group by
                $sqlmode= $this->db->query('select @@sql_mode')->row_array();
                if(stristr(@$sqlmode['@@sql_mode'], 'ONLY_FULL_GROUP_BY')){
                     $this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
                     redirect(base_url());
                }
logEntry($this->session->userdata('user_id'), $this->session->userdata('unique_id'), '', '', $this->session->userdata('userName'), 'Login', 'Login Module', 'Login successfully', 'Success', date('m-d-Y'));
  $this->output->set_header("Location: " . base_url(), TRUE, 302);
            }

        }
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

    //Valid captcha check
    function validate_captcha() {
        $setting_detail = $this->Web_settings->retrieve_setting_editdata();
        $captcha = $this->input->post('g-recaptcha-response',TRUE);
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $setting_detail[0]['secret_key'] . ".&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
        if ($response . 'success' == false) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    #===============Logout=======#

    public function logout() {
    logEntry($this->session->userdata('user_id'), $this->session->userdata('unique_id'), '', '', $this->session->userdata('userName'), 'Logout', 'Users Logout', 'Logout Successfully', 'Logout', date('m-d-Y'));
  if ($this->auth->logout())
    $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/login', TRUE, 302);
    }

    #=============Edit Profile======#

    public function edit_profile() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->library('luser');
        $content = $CI->luser->edit_profile_form();
        $this->template->full_admin_html_view($content);
    }

    #=============Update Profile========#

    public function update_profile() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Users');
        $this->Users->profile_update();
        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Admin_dashboard/edit_profile'));
    }

    #=============Change Password=========# 

    public function change_password_form() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $content = $CI->parser->parse('user/change_password', array('title' => display('change_password')), true);
        $this->template->full_admin_html_view($content);
    }

    #============Change Password===========#

    public function change_password() {
        $CI = & get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Users');

        $error = '';
        $email = $this->input->post('email',TRUE);
        $old_password = $this->input->post('old_password',TRUE);
        $new_password = $this->input->post('password',TRUE);
        $repassword = $this->input->post('repassword',TRUE);

        if ($email == '' || $old_password == '' || $new_password == '') {
            $error = display('blank_field_does_not_accept');
        } else if ($email != $this->session->userdata('u_name')) {
            $error = display('Wrong Username');
        } else if (strlen($new_password) < 6) {
            $error = display('new_password_at_least_six_character');
        } else if ($new_password != $repassword) {
            $error = display('password_and_repassword_does_not_match');
        } else if ($CI->Users->change_password($email, $old_password, $new_password) === FALSE) {
            $error = display('you_are_not_authorised_person');
        }

        if ($error != '') {
            $this->session->set_userdata(array('error_message' => $error));
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/change_password_form', TRUE, 302);
        } else {
            $this->session->set_userdata(array('message' => display('successfully_changed_password')));
            $this->output->set_header("Location: " . base_url() . 'Admin_dashboard/change_password_form', TRUE, 302);
        }
    }
  #==============Closing form==========#

    public function closing() {
        $CI = & get_instance();
        $CI->load->model('Reports');
        $data = array('title' => "Reports | Daily Closing");
        $data = $this->Reports->accounts_closing_data();
        $content = $this->parser->parse('accounts/closing_form', $data, true);
        $this->template->full_admin_html_view($content);
    }

  //Closing report
    public function closing_report()
    {
        $CI = & get_instance();
        $CI->load->library('laccounts');
        $content =$this->laccounts->daily_closing_list();
        $this->template->full_admin_html_view($content);
    }
    // Date wise closing reports 
    public function date_wise_closing_reports()
    {    
        $CI = & get_instance();
        $CI->load->library('laccounts');
         $CI->load->model('Accounts');
        $from_date = $this->input->get('from_date');       
        $to_date = $this->input->get('to_date');
        #
        #pagination starts
        #
        $config["base_url"]     = base_url('Admin_dashboard/date_wise_closing_reports/');
        $config["total_rows"]   = $this->Accounts->get_date_wise_closing_report_count($from_date,$to_date);
        $config["per_page"] = 50;
        $config["uri_segment"] = 3;
        $config["num_links"] = 5; 
        $config['suffix'] = '?'. http_build_query($_GET, '', '&');
        $config['first_url'] = $config["base_url"] . $config['suffix'];
        /* This Application Must Be Used With BootStrap 3 * */
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $links = $this->pagination->create_links();
        #
        #pagination ends
        # 
        
        $content = $this->laccounts->get_date_wise_closing_reports($links,$config["per_page"],$page,$from_date,$to_date );
       
        $this->template->full_admin_html_view($content);
    }
    
    //password recovery 
    public function password_recovery(){
         $CI = & get_instance();
         $CI->load->model('Settings');
    $this->form_validation->set_rules('rec_email', display('email'), 'required|valid_email|max_length[100]|trim');  
    $userData = array(
            'email' => $this->input->post('rec_email',TRUE)
        );
    if ($this->form_validation->run())
        {
    $user = $this->Settings->password_recovery($userData);
     $ptoken = date('ymdhis');
        if($user->num_rows() > 0) {
            $email =$user->row()->username;
            $precdat = array(
            'username'      => $email,
            'security_code' => $ptoken,
                
        );
        
        $this->db->where('username',$email)
            ->update('user_login',$precdat);
             $send_email = '';
             if (!empty($email)) {
                $send_email = $this->setmail($email,$ptoken);
                
             }
           if($send_email){
             $this->session->set_userdata(array('message' => 'Forget link sent to your email. Please Check your email'));
          // $user_data['success']    = 'Check Your email';
          //  $user_data['status']    = 1; 
           }else{
              $this->session->set_userdata(array('message' => 'Sorry Email Not Send'));
           // $user_data['exception'] = 'Sorry Email Not Send';
           // $user_data['status']    = 0; 
           }

        }else{
             $this->session->set_userdata(array('message' => 'Email Not found'));
            // $user_data['exception']='Email Not found';
            // $user_data['status']   = 0; 
        }
    }else{
         $this->session->set_userdata(array('message' => 'Please try again'));
            // $user_data['exception']='please try again';
            // $user_data['status']   = 0; 
        }

         echo json_encode($user_data);
    }
    
     public function setmail($email,$ptoken)
    {
$msg = "Hi,
There was a request to change your password!
If you did not make this request then please ignore this email.
Otherwise, please click this link to change your password: ".base_url().'Admin_dashboard/recovery_form/'.$ptoken;

// send email
mail($email,"passwordrecovery",$msg);
return true;
}

public function recovery_form($token_id = null){
        $CI = & get_instance();
        $CI->load->model('Settings');
        $tokeninfo = $this->Settings->token_matching($token_id);
      if($tokeninfo->num_rows() > 0) {
        $data['token'] = $token_id;
        $data['title'] = display('recovery_form');
        $this->load->view('user/user_recovery_form', $data);
      }else{
        redirect(base_url('Admin_dashboard/login'));  
      }
       
    
}
public function recovery_update(){
    $token = $this->input->post('token',TRUE);
    $newpassword = $this->input->post('newpassword',TRUE);
    $userdata = array(
        'password'      =>  md5("gef" . $newpassword),
        'security_code' => '001'
        );
        $this->db->where('security_code',$token)
            ->update('user_login',$userdata);
            redirect(base_url('Admin_dashboard/login')); 
}


}
