<?php
error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cweb_setting extends CI_Controller {

    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->library('auth');
        $this->load->library('lweb_setting');
        $this->load->library('session');
        $this->load->model('Web_settings');
        $this->auth->check_admin_auth();
        $this->template->current_menu = 'web_setting';

      
    }

    public function agree_view()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $postData = $this->input->post('new_payment_terms');

        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        $searchall_data = $CI->Web_settings->searchalldata($postData);
        
        $data = array(
            'title' => 'View',
            'setting_detail' => $setting_detail,
            'search_datas' => $searchall_data
        );
        $content = $this->load->view('web_setting/agree_view', $data, true);
        $this->template->full_admin_html_view($content);
    }
   
    public function fetchAttachments()
    {   
        $CI = & get_instance();
        $id = $this->input->post('inbox_id'); 
        $email_attach = $CI->Web_settings->Fetchemailattachment($id);
        echo json_encode($email_attach);
    }
    
     public function sendReplyEmail() 
     {
        $CI = & get_instance();
        $csrfToken = $this->input->post($this->security->get_csrf_token_name());
        $email = $this->input->post('email');
        $replyContent = $this->input->post('replyContent');
        $mail_set = $CI->Web_settings->getemailConfig();
        $stm_user = $mail_set[0]->smtp_user;
        $stm_pass = $mail_set[0]->smtp_pass;
        $domain_name = $mail_set[0]->smtp_host;
        $protocol = $mail_set[0]->protocol;
        $EMAIL_ADDRESS = $mail_set[0]->smtp_user;
        $DOMAIN = substr(strrchr($EMAIL_ADDRESS, "@"), 1);
        if(strtolower($DOMAIN) === 'gmail.com'){
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
        }else{
            $config = array(
              'protocol' => $protocol,
              'smtp_host' => 'ssl://' . $domain_name,
              'smtp_user' => $stm_user,
              'smtp_pass' => $stm_pass,
              'smtp_port' => 465,
              'smtp_timeout' => 30,
              'charset' => 'utf-8',
              'newline' => '\r\n',
              'mailtype' => 'html',
              'validate' => true,
            );
        }
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");
        $this->email->from($stm_user, 'Your Name');
        $this->email->to($email);
        $this->email->subject('Reply Email');
        $this->email->message($replyContent);
        if ($this->email->send()) {
            $response = array('success' => true, 'message' => 'Email sent successfully.');
            echo json_encode($response);
        } else {
            $response = array('success' => false, 'message' => 'Email sending failed.'. $this->email->print_debugger());
            echo json_encode($response);
        }
    }
   

    public function download_email()
    {
        $CI = & get_instance();
        $email_con = $this->db->select('*')->from('email_config')->get()->result();
        $EMAIL_ADDRESS = $email_con[0]->smtp_user;
        $DOMAIN = substr(strrchr($EMAIL_ADDRESS, "@"), 1);
        if(strtolower($DOMAIN) === 'gmail.com'){
            foreach ($email_con as $key => $value) {
              $stm_user = $value->smtp_user;
              $stm_pass = $value->smtp_pass;
            }
            $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
            $username = $stm_user;
            $password = $stm_pass;
        }else{
            foreach ($email_con as $key => $value) {
              $stm_user = $value->smtp_user;
              $stm_pass = $value->smtp_pass;
              $domain_name = $value->smtp_host;
            }
            $hostname = '{'.$domain_name.':993/imap/ssl}INBOX';
            $username = $stm_user;
            $password = $stm_pass;
        }
        $inbox = imap_open($hostname, $username, $password) or die('Cannot connect to Gmail: ' . imap_last_error());
        
        $todayDate = date('d-M-Y', strtotime('today'));
        $searchCriteria = 'SINCE "' . $todayDate . '"';
        $emails = imap_search($inbox, $searchCriteria);
        
        
        if ($emails) {
            foreach ($emails as $email_number) {
                $header = imap_headerinfo($inbox, $email_number);
                $subject = imap_utf8($header->subject);
                $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
                date_default_timezone_set('Asia/Kolkata');
                $date = date('d/m/Y H:i:A', strtotime($header->date));
                $message = imap_fetchbody($inbox, $email_number, 1);
                if (!$message) {
                  throw new Exception('Failed to fetch email message body.');
                }
                if (strpos($message, "Content-Type:") !== false) {
                  $message = preg_replace('/^[^\n]*\n?/', '', $message);
                  $message = preg_replace("/Content-Type:.*?\r?\n/m", "", $message);
                }
                if (strpos($message, "Content-Transfer-Encoding:") !== false) {
                 $message = preg_replace('/^[^\n]*\n?/', '', $message);
                  $message = preg_replace("/Content-Transfer-Encoding:.*?\r?\n/m", "", $message);
                }
                try {
                  $decodedMessage = quoted_printable_decode($message);
                } catch (Exception $e) {
                  throw new Exception("Failed to decode message body: " . $e->getMessage());
                }
                $finalMessageHTML = nl2br($decodedMessage);
                $structure = imap_fetchstructure($inbox, $email_number);
                if ($structure) {
                    $decodedContent = '';
                    foreach ($structure->parts as $partNum => $part) {
                        if ($part->subtype == 'HTML') {
                            $message = imap_fetchbody($inbox, $email_number, $partNum + 1);
                            $decodedContent = quoted_printable_decode($message);
                            break;
                        }
                       
                    }
            
                
                $emailData = array(
                    'subject' => $subject,
                    'to_address' => $from,
                    'email_date' => $date,
                    'identify' => $DOMAIN,
                    'created_by' => $this->session->userdata('user_id'),
                );
                if(strtolower($domain_from) === 'gmail.com'){
                        $emailData['message'] = $decodedContent;
                    }else{
                       $emailData['message'] = $finalMessageHTML;
                    }
                $this->db->insert('email_inbox', $emailData);
            }
                
            }
            imap_expunge($inbox);
        }
        imap_close($inbox);
        header('Content-Type: application/json');
        echo json_encode($emailData);
    }
     // Calendar Views 
    public function calender_view()
    {
        $CI = &get_instance();
        $CI->auth->check_admin_auth();

        $encodedId      = isset($_GET["id"]) ? $_GET["id"] : null;
        $user_id      = decodeBase64UrlParameter($encodedId);

        $insertdata = $CI->Web_settings->insertDateforSchedule($user_id);

        $data = array(
            'title' => 'Calendar',
            'insertdata' => json_encode($insertdata),
        );

        $content = $this->load->view('web_setting/calendar_views', $data, true);
        $this->template->full_admin_html_view($content);
    }


    // Add Reminder

    public function add_reminder()
    {
       $CI = & get_instance();
       $CI->auth->check_admin_auth();

       $response = [];

       $title = $this->input->post('title');
       $description = $this->input->post('description');
       $start = $this->input->post('start');
       $end = $this->input->post('end');
       $user_id  = decodeBase64UrlParameter($this->input->post('user_id'));
       $admin_id  = decodeBase64UrlParameter($this->input->post('admin_id'));

       $data = array(
         'title' => $title,
         'description' => $description,
         'start' => $start,
         'end' => $end,
         'created_by' => $user_id,
         'unique_id' => $admin_id,
         'source' => 'Calander',
         'schedule_status' => 1,
         'bell_notification' => 1
       );

       $insertData = $this->db->insert('schedule_list', $data);

       if($insertData){
          $response = ['status' => 1, 'msg' => 'Schedule List Added Successfully.'];
       }else{
          $response = ['status' => 0, 'msg' => 'Schedule List Added Failed !!!'];
       }
       
       echo json_encode($response);
       exit;
    }

    // Application Bell Notification

    public function showBellNotification()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $get_notif = $CI->Web_settings->show_all_bell_notification();
        echo json_encode($get_notif);
        exit;
    }

    // Update Bell Notification
    public function updateBellNotification()
    {
        $schedule_id = $this->input->post('schedule_id');
        $user_id = $this->input->post('user_id');

        $response = [];

        $result = $this->Web_settings->update_notification_status($schedule_id, $user_id);

        if ($result) {
            $response = ['status' => 1, 'message' => 'Success'];
        } else {
            $response = ['status' => 0, 'message' => 'Failed'];
        }

        echo json_encode($response);
        exit;
    }
   
   

    public function inbox_delete()
    {
        $file = 'assets/Email/inbox.txt';  
        $specificWord = $this->input->post('id');  
        $handle = fopen($file, 'r');
        if ($handle) {
            $lines = [];
           
            while (($line = fgets($handle)) !== false) {
                if (strpos($line, $specificWord) === false) {
                    $lines[] = $line;
                }
            }
            fclose($handle);
            $handle = fopen($file, 'w');
            foreach ($lines as $line) {
                fwrite($handle, $line);
            }
            fclose($handle);
            echo "Lines containing '$specificWord' have been unset from the file.";
        } else {
            echo "Unable to open the file.";
        }
    }

    public function trash_email()
    {   
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');
        $alld_id = $this->input->post('Trashid');
        $data_email = array(
          'is_deleted' => 2,
        );
        $this->db->where('id', $alld_id);
        $this->db->update('email_data', $data_email);
    }
    
    public function Inboxdelete_email()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');
        $in_id = $this->input->post('id');
        $data_inboxemail = array(
          'is_deletedinbox' => 1,
        );
        $this->db->where('id', $in_id);
       $this->db->update('email_inbox', $data_inboxemail);
    }
    
    public function inboxDatadelete_email()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');
        $delin_id = $this->input->post('inTrashid');
        $datainbox_email = array(
          'is_deletedinbox' => 2,
        );
        $this->db->where('id', $delin_id);
        $this->db->update('email_inbox', $datainbox_email);
    }
    
    public function RestoreEmailFirstsentbox()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');
        $res_id = $this->input->post('id');
        $data_email = array(
          'is_deleted' => 0,
        );
        $this->db->where('id', $res_id);
        $this->db->update('email_data', $data_email);
    }
    
    public function RestoreEmailsecondInbox()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');
        $restore_id = $this->input->post('id');
        $data_email = array(
          'is_deletedinbox' => 0,
        );
        $this->db->where('id', $restore_id);
        $this->db->update('email_inbox', $data_email);
    }
    
    public function delete_email()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');
        $d_id = $this->input->post('id');
        $data_email = array(
          'is_deleted' => 1,
        );
        $this->db->where('id', $d_id);
        $this->db->update('email_data', $data_email);
    }

    public function update_email()
	{
		$pad_id = $this->input->post('pad_id');
        $email = $this->input->post('email');
        $message = $this->input->post('message');
	    $data = array(
	      'pad_id' => $pad_id,
	    );
        $this->db->where('to_email',$email);
        $this->db->where('message',$message);
        $this->db->update('email_data', $data);
        $this->template->full_admin_html_view($mail_setting);
	}

    public function sendemail()
    {
        $CI = & get_instance();
        $CI->load->library('phpmailer_lib');
        $mail_set = $this->db->select('*')->from('email_config')->get()->result_array();

        $data = array(
            'title' => display('Compose'),
            'email_setting' => $mail_set,
        );
        $content = $CI->parser->parse('web_setting/email_sendcus.php', $data, true);
        $this->template->full_admin_html_view($content);
    }

    public function emailSending()
    {
         $CI = & get_instance();
        $to = $this->input->post('to_email');
        $cc = $this->input->post('cc_email');
        $cc_emails_array = explode(';', $cc);
        $cc_emails_arrays = array_map('trim', $cc_emails_array);
        $subject = $this->input->post('subject');
        $message = $this->input->post('message');
        $reply = $this->input->post('replyEmail');
        $created = $this->session->userdata('user_id');
        $upload_directory = 'uploads/email/';
        $no_files = count($_FILES["files"]['name']);
        for ($i = 0; $i < $no_files; $i++) {
            if ($_FILES["files"]["error"][$i] > 0) {
                echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
            } else {
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], $upload_directory . $_FILES["files"]["name"][$i]);
                $images[] = $_FILES["files"]["name"][$i];
                $insertImages = implode(', ', $images);
            }
        }
        $mail_set = $CI->Web_settings->getemailConfig();
        $stm_user = $mail_set[0]->smtp_user;
        $stm_pass = $mail_set[0]->smtp_pass;
        $domain_name = $mail_set[0]->smtp_host;
        $protocol = $mail_set[0]->protocol;
        $EMAIL_ADDRESS = $mail_set[0]->smtp_user;
        $DOMAIN = substr(strrchr($EMAIL_ADDRESS, "@"), 1);

        if(strtolower($DOMAIN) === 'gmail.com'){
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
        }else{
            $config = array(
              'protocol' => $protocol,
              'smtp_host' => 'ssl://' . $domain_name,
              'smtp_user' => $stm_user,
              'smtp_pass' => $stm_pass,
              'smtp_port' => 465,
              'smtp_timeout' => 30,
              'charset' => 'utf-8',
              'newline' => '\r\n',
              'mailtype' => 'html',
              'validate' => true,
            );
        }
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");
        $this->email->from($to, 'Your Name');
        $this->email->to($to);
        if (!empty($cc_emails_arrays)) {
            $this->email->cc($cc_emails_arrays);
        }
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->reply_to($reply);
        $upload_directory = 'uploads/email/';
        foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
            $file_name = $_FILES["files"]["name"][$key];
            $file_path = $upload_directory . $file_name;
            move_uploaded_file($_FILES["files"]["tmp_name"][$key], $file_path);
            $this->email->attach($file_path);
        }
        if ($this->email->send()) {
            echo "<script>alert('Email Send successfully');</script>";
            $data = array(
                'to_email' => $to,
                'cc_email' => $cc,
                'subject' => $subject,
                'message' => $message,
                 'files' => $insertImages,
                'created_by' => $created
            );
            $this->db->insert('email_data', $data);
            redirect(base_url('Cweb_setting/email_setting'));
        } else {
            echo "<script>alert('Email Send Failed !!!!!');</script>";
            echo 'Error sending email: ' . $this->email->print_debugger();
        }
    }
 
    function invoice_design()
    {
        $content = $this->lweb_setting->invoice_design();
        $this->template->full_admin_html_view($content);
    }

    function update_templates()
    {
        $this->db->select('*');

        $this->db->from('invoice_design');

        $this->db->where('uid', $this->session->userdata('user_id'));
  
        $query = $this->db->get()->num_rows();

        if (empty($query) ) {
         
        	if($_REQUEST['input']=='header')
        	{
                $data=array(
                    'header' => $_REQUEST['value'],
                    'uid' => $_REQUEST['id']
                );
                $this->db->insert('invoice_design', $data);
        	}

        	if($_REQUEST['input']=='color')
        	{
                $data=array(
                    'color' => $_REQUEST['value'],
                    'uid' => $_REQUEST['id']
                );
        	}
            $this->db->insert('invoice_design', $data);
  
		}else{
    		if($_REQUEST['input']=='header')
    		{
    			
                $data=array(
                    'header' => $_REQUEST['value'],
                    'uid' => $_REQUEST['id']
                );
                $this->db->where('uid', $_REQUEST['id']);
                $this->db->update('invoice_design', $data);
    		}
    		if($_REQUEST['input']=='color')
    		{
                $data=array(
                    'color' => $_REQUEST['value'],
                    'uid' => $_REQUEST['id']
                );
                $this->db->where('uid', $_REQUEST['id']);
                $this->db->update('invoice_design', $data);
            
    		}
		}
    }


    function invoice_content()
    {
       $content = $this->lweb_setting->invoice_content();
        $this->template->full_admin_html_view($content);
    }

    function updateinvoice2()
    {
        $id=$_SESSION['user_id'];
        $this->db->select('*');
         $this->db->from('invoice_content');
        $this->db->where('uid', $id );
         $query = $this->db->get();
        if ( $query->num_rows() > 0 )
        {
            $sql='update invoice_content set
            company_name="'.$_REQUEST['name'].'",
            mobile="'.$_REQUEST['phone'].'",
            email="'.$_REQUEST['email'].'",
            reg_number="'.$_REQUEST['regno'].'",
            website="'.$_REQUEST['website'].'",
            address="'.$_REQUEST['address'].'"
            where uid=
            '.$id;
        }else{
            $sql = "insert into invoice_content(company_name,mobile,email,reg_number,website,address,uid) VALUES(
           '".$_REQUEST['name']."',
           '".$_REQUEST['phone']."',
           '".$_REQUEST['email']."',
           '".$_REQUEST['regno']."',
           '".$_REQUEST['website']."',
           '".$_REQUEST['address']."',
           '".$_SESSION['user_id']."'
            ) ";
        }
        $query=$this->db->query($sql);
        if($query)
        {
            ?>
            <script type="text/javascript">
                location.href='invoice_content';
            </script>
            <?php
        }
    }

    public function index() {
        $content = $this->lweb_setting->setting_add_form();
        $this->template->full_admin_html_view($content);
    }

    public function admin_user_mail_ids()
    {
        $val=$this->input->post('dataString');
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');
        $data = $CI->Web_settings->admin_user_mail_ids($val);
        echo json_encode($data);
    }

    function email_template()
    {
        $content = $this->lweb_setting->email_template();
        $this->template->full_admin_html_view($content);
    }

    public function insert_email() 
    {
        $pdf=0;
        $pdf = $this->input->post('pdf',TRUE);
        $greeting =$this->input->post('select1',TRUE).'_'.$this->input->post('select2',TRUE);
        
        $id=$_SESSION['user_id'];

        $this->db->select('*');

        $this->db->from('invoice_email');

        $this->db->where('uid', $id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->set('pdf_attached', $pdf);
            $this->db->set('subject',$this->input->post('subject',TRUE));
            $this->db->set('greeting',  $greeting);
            $this->db->set('message', $this->input->post('message',TRUE));
            $this->db->where('uid', $id);
            $this->db->update('invoice_email');
        }else{
            $data = array(
            'pdf_attached'=>$this->input->post('pdf'),
            'subject'=>$this->input->post('subject'),
            'greeting'=> $greeting,
             'message'  => $this->session->userdata('message'),
             'uid'   => $id
         );

         $this->db->insert('nvoice_email', $data);
         echo $this->db->last_query();
        }

    }

    public function email_setting() 
    {
        $CI = & get_instance();
        
        $view_email = $this->db->select('*')->from('email_data')->where('is_deleted', 0)->get()->result();
        $email_con = $this->db->select('*')->from('email_config')->get()->result();

        $content = $this->lweb_setting->email_setting($view_email, $email_con);
        $this->template->full_admin_html_view($content);
    }
    
    public function getrelativeInboxData()
    {
        $CI = & get_instance();
        $CI->load->model('Web_settings');

        $msg_id = $this->input->post('messageid');

        $content = $this->Web_settings->getInboxmessagedata($msg_id);
        
        echo json_encode($content);
    }

    public function invoice_template() 
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');

        $content = $this->lweb_setting->invoice_setting();
        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        $CI->Web_settings->update_invoice_set();

        $data=array(
            'setting_detail' => $setting_detail, 
        );
 
        $this->template->full_admin_html_view($content);
    }

    public function expense_invoice_template() 
    {
        $content = $this->lweb_setting->expense_invoice_setting();
        $this->template->full_admin_html_view($content);
    }

    public function web_Invoice()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');


        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        $data=array(
           
            'setting_detail' => $setting_detail, 
        );

        $CI->Web_settings->update_invoice_set();

        $this->session->set_userdata(array('message' => display('successfully_added')));
        
        if (isset($_POST['add-customer'])) {
            redirect(base_url('Cweb_setting/invoice_template'));
            exit;
        }
    
    }

    public function invoice_desgn()
    {
        $CI = & get_instance();
        $CI->auth->check_admin_auth();
        $CI->load->model('Web_settings');

        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        $CI->Web_settings->invoice_desgn();

        $data=array(
            'setting_detail' => $setting_detail, 
        );

        $this->session->set_userdata(array('message' => display('successfully_added')));
        if (isset($_POST['add-customer'])) {
          redirect(base_url('Cweb_setting/invoice_template'));
            exit;
        }
    
    }

    // Update setting
    public function update_setting() 
    {
        $this->load->model('Web_settings');

        $status = $this->input->post('status_logo');

        if ($_FILES['logo']['name']) {

            $config['upload_path']    = './my-assets/image/logo/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG'; 
            $config['encrypt_name']   = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
                $data = $this->upload->data();  
                $logo = $config['upload_path'].$data['file_name']; 
                $config['image_library']  = 'gd2';
                $config['source_image']   = $logo;
                $config['create_thumb']   = false;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 200;
                $config['height']         = 200;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $logo =  $logo;
            }
        }

        if ($_FILES['favicon']['name']) {
            $config['upload_path']   = './my-assets/image/logo/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size']      = "*";
            $config['max_width']     = "*";
            $config['max_height']    = "*";
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('favicon')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
                $image = $this->upload->data();
                $favicon = base_url(). "my-assets/image/logo/" . $image['file_name'];
            }
        }

        if ($_FILES['invoice_logo']['name']) {

            $config['upload_path']    = './my-assets/image/logo/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG'; 
            $config['encrypt_name']   = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('invoice_logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
                $data = $this->upload->data();  
                $invoice_logo = $config['upload_path'].$data['file_name']; 
                $config['image_library']  = 'gd2';
                $config['source_image']   = $invoice_logo;
                $config['create_thumb']   = false;
                $config['maintain_ratio'] = TRUE;
                $config['width']          = 200;
                $config['height']         = 200;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $invoice_logo = $invoice_logo;
            }
        }
        
        if ($_FILES['logo']['name']) {
            $config['upload_path']   = './my-assets/image/logo/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|GIF|JPG|PNG';
            $config['max_size']      = "*";
            $config['max_width']     = "*";
            $config['max_height']    = "*";
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('logo')) {
                $error = array('error' => $this->upload->display_errors());
                $this->session->set_userdata(array('error_message' => $this->upload->display_errors()));
                redirect(base_url('Cweb_setting'));
            } else {
                $image = $this->upload->data();
                $logo = "my-assets/image/logo/" . $image['file_name'];
            }
        }

        $old_logo = $this->input->post('old_logo',true);
        $old_invoice_logo = $this->input->post('old_invoice_logo',true);
        $old_favicon = $this->input->post('old_favicon',true);
        $old_officelogo = $this->input->post('old_officelogo',true);

        $data = array(
        'logo'              => (!empty($logo) ? $logo : $old_logo),
        'invoice_logo'      => (!empty($invoice_logo) ? $invoice_logo : $old_invoice_logo),
        'favicon'           => (!empty($favicon) ? $favicon : $old_favicon),
        'start_week' => $this->input->post('start_week',true),    'end_week' => $this->input->post('end_week',true),
        'currency'          => $this->input->post('currency',true),
        'currency_position' => $this->input->post('currency_position',true),
        'footer_text'       => $this->input->post('footer_text',true),
        'language'          => $this->input->post('language',true),
        'rtr'               => $this->input->post('rtr',true),
        'timezone'          => $this->input->post('timezone',true),
        'captcha'           => $this->input->post('captcha',true),
        'site_key'          => $this->input->post('site_key',true),
        'secret_key'        => $this->input->post('secret_key',true),
        'discount_type'     => $this->input->post('discount_type',true),
        'side_menu_bar'     => $this->input->post('side_menu_bar',true),
        'top_menu_bar'     => $this->input->post('top_menu_bar',true),
        'button_color'     => $this->input->post('button_color',true),
        'create_by'         => $this->session->userdata('user_id')
        );
        $fav_icon = $this->input->post('favicon_logo');
        $inv_logo = $this->input->post('inv_logo');
        $OLD_logo = $this->input->post('o_logo');
        
        if($status === 'OfficeLogo'){
            $data1 = array(
               'logo' => (!empty($logo) ? $logo : $old_officelogo)
            );
            $this->db->where('company_id', $this->session->userdata('user_id'));
            $this->db->update('company_information', $data1);
        }

        $this->Web_settings->update_setting($data);

        $this->session->set_userdata(array('message' => display('successfully_updated')));
        redirect(base_url('Cweb_setting'));
        exit;
    }


    public function update_app_setting()
    {

        $id = $this->input->post('id',TRUE);
        $data  = array(
        'localhserver' => $this->input->post('localurl',true),
        'onlineserver' => $this->input->post('onlineurl',true),
        'hotspot'      => $this->input->post('hotspoturl',true),

        );

        if(!empty($this->input->post('localurl',TRUE)) || !empty($this->input->post('onlineurl',true)) || !empty($this->input->post('hotspoturl',true)))

            if(!empty($id)){
                $this->db->where('id',$id)->update('app_setting',$data);
            }else{
                $this->db->insert('app_setting',$data);
            }

        $this->session->set_flashdata('message', 'Successfully Updated');
        redirect(base_url('Cweb_setting/app_setting'));          
    }

    //=========== its for mail settings ===============

    public function mail_setting() 
    {
        $data['title'] = display('mail_configuration');
        $data['mail_setting'] = $this->db->select('*')->from('email_config')->where('created_by', $this->session->userdata('user_id'))->get()->result();       
        $content = $this->parser->parse('web_setting/mail_setting', $data, true);
        $this->template->full_admin_html_view($content);
    }

//    ============ its for mail_config_update ============

    public function mail_config_update() 
    {
        $protocol  = $this->input->post('protocol',true);
        $smtp_host = $this->input->post('smtp_host',true);
        $smtp_port = $this->input->post('smtp_port',true);
        $smtp_user = $this->input->post('smtp_user',true);
        $smtp_pass = $this->input->post('smtp_pass',true);
        $mailtype  = $this->input->post('mailtype',true);
        $invoice   = $this->input->post('isinvoice',true);
        $service   = $this->input->post('isservice',true);
        $quotation  = $this->input->post('isquotation',true);
        $isattachment  = $this->input->post('isattachment',true);
        $userId = $this->session->userdata('user_id');
        $this->db->where('created_by', $userId);
        $count = $this->db->count_all_results('email_inbox');
        if ($count > 1) {
            $this->db->where('created_by', $userId);
            $this->db->delete('email_inbox');
        }
        $mail_data = array(
            'protocol' => $protocol,
            'smtp_host' => $smtp_host,
            'smtp_port' => $smtp_port,
            'smtp_user' => $smtp_user,
            'smtp_pass' => $smtp_pass,
            'mailtype'  => $mailtype,
            'isinvoice' => $invoice,
            'isservice' => $service,
            'isquotation'=>$quotation,
            'isattachment'=>$isattachment,
            'created_by'=>$this->session->userdata('user_id')
        );
         $mail_set = $this->db->select('*')->from('email_config ')->where('created_by',$this->session->userdata('user_id'))->get()->result_array();
         if(empty($mail_set)){
               $this->db->insert('email_config',$mail_data);
         }else{
              $this->db->where('created_by',$this->session->userdata('user_id'))->update('email_config', $mail_data);
         }
       
        $this->session->set_userdata(array('message' => display('update_successfully')));
        redirect(base_url('Cweb_setting/mail_setting'));
    }

    // Logs Views 
    public function viewLogs()
    {
        $CI = &get_instance();
        $CI->auth->check_admin_auth();

        $data = array(
            'title' => 'Logs',
        );

        $content = $this->load->view('web_setting/logs', $data, true);
        $this->template->full_admin_html_view($content);
    }

    // Notification View Page 
    public function notifications()
    {   
        $id      = isset($_GET['id']) ? $_GET['id'] : null;

        $userId    = decodeBase64UrlParameter($id);

        $company_information = $this->db->select('company_name, email') ->where('company_id', $userId) ->get('company_information')->result_array();

        $data = array(
           'title' => 'Reminder Notification',
           'email' => $company_information
        );

        $content = $this->load->view('web_setting/notifications', $data, true);
        $this->template->full_admin_html_view($content);
    }

    // Reminder List data
    
    public function reminderLists()
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
        $totalItems     = $this->Web_settings->getTotalNotificationListdata($limit, $start, $search, $decodedId, $orderDirection);
        $items          = $this->Web_settings->getPaginatedNotification($limit, $start, $orderField, $orderDirection, $search, $decodedId);
        $data           = [];
        $i              = $start + 1;
        foreach ($items as $item) {
            $status = ($item['schedule_status'] == '1') ? "<span class='badge badge-success'>Scheduled</span>" : "<span class='badge badge-secondary'>Not Scheduled</span>";
            $row     = [
                "id"            => $i,
                "source"        => $item['source'],
                "due_date"      => !empty($item['due_date']) ? $item['due_date'] : '',
                "end"           => date('m-d-Y', strtotime($item['end'])),
                "schedule_status" => $status,
                "create_date" => date('m-d-Y', strtotime($item['create_date'])),
                "action" => "<a href='" . base_url('Cweb_setting/calender_view?id=' . $encodedId . '&admin_id=' . $encodedAdmin) . "' class='btnclr btn btn-success btn-sm' target = '_blank' title='Redirect Calendar'> <i class='fa fa-external-link'></i> </a>",
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

    
    // Insert Reminders
    public function insertreminder()
    {
        $user_id = decodeBase64UrlParameter($this->input->post('user_id'));
        $admin_id = decodeBase64UrlParameter($this->input->post('admin_id'));
        
        $response = [];

        $datesForQuarters = [
            'Quater 1' => date('Y') . '-05-01', // May 1st (Quarter 1)
            'Quater 2' => date('Y') . '-07-31', // July 31st (Quarter 2)
            'Quater 3' => date('Y') . '-08-31', // August 31st (Quarter 3)
            'Quater 4' => date('Y') . '-01-31', // January 31st (Quarter 4)
            'Year'     => date('Y') . '-12-31'  // December 31st (Year)
        ];

        $title = $this->input->post('title');
        $description = $this->input->post('select_date');

        $targetDate = $datesForQuarters[$title];
        $reminderDate = '';

        if ($description == 'On Date') {
            $reminderDate = $targetDate;
        } else if ($description == '1 Day Before') {
            $reminderDate = date('Y-m-d', strtotime($targetDate . ' -1 day'));
        } else if ($description == '3 Days Before') {
            $reminderDate = date('Y-m-d', strtotime($targetDate . ' -3 days'));
        } else if ($description == '1 Week Before') {
            $reminderDate = date('Y-m-d', strtotime($targetDate . ' -1 week'));
        } else {
            $response = ['status' => 0, 'msg' => 'Invalid description type provided.'];
            echo json_encode($response);
            exit();
        }

        $data = array(
            'title'             => $title,
            'description'       => $description,
            'unique_id'         => $admin_id,
            'start'             => $reminderDate,
            'end'               => $reminderDate,
            'schedule_status'   => 1,
            'due_date'          => $this->input->post('due_dates'),
            'source'            => $this->input->post('select_source'),
            'email_id'          => $this->input->post('select_email'),
            'bell_notification' => 1,
            'created_by'        => $user_id,
        );

        $insertData = $this->db->insert('schedule_list', $data);

        if ($insertData) {
            $response = ['status' => 1, 'msg' => 'Reminder Setup Successfully.'];
        } else {
            $response = ['status' => 0, 'msg' => 'Reminder Setup Failed !!!'];
        }

        echo json_encode($response);
        exit();
    }


}
