<?php
error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cron extends CI_Controller {
    public $menu;

    function __construct() {
        parent::__construct();
        $this->load->model('Cron_model');
        date_default_timezone_set('Asia/Kolkata'); 
    }
    
    // Settings Dropdown Inside Setting Dropdown Notification Menu: Set the source email triggers and configure the reminder for your selected email date.
    public function send_mail_cronjob() {
        $CI = & get_instance();
        $this->load->library('email');

        $get_emails = $CI->Cron_model->get_email_scheduled();

        if (!empty($get_emails)) {
            foreach ($get_emails as $email_data) {
                
                $schedule_date = date('Y-m-d', strtotime($email_data->start));
                $current_date = date('Y-m-d');

                if ($current_date === $schedule_date) {
                    $subject = "Tax Alert: Upcoming Due Date for " . $email_data->title;
                    $message = "
                        <p>This is a reminder for the upcoming tax-related task:</p>
                        <ul>
                            <li><strong>Title:</strong> {$email_data->title}</li>
                            <li><strong>Due Date:</strong> " . date('F j, Y', strtotime($email_data->start)) . "</li>
                        </ul>
                        <p>Please ensure this task is addressed promptly to avoid any compliance issues.</p>
                        <p>Regards,<br>Your Automated Notification System</p>";

                    $to = $email_data->email_id;

                    $mail_set = $CI->Cron_model->getemailConfig();

                    $stm_user = $mail_set[0]->smtp_user;
                    $stm_pass = $mail_set[0]->smtp_pass;
                    $domain_name = $mail_set[0]->smtp_host;
                    $protocol = $mail_set[0]->protocol;
                    $EMAIL_ADDRESS = $mail_set[0]->smtp_user;
                    $DOMAIN = substr(strrchr($EMAIL_ADDRESS, "@"), 1);

                    if (strtolower($DOMAIN) === 'gmail.com') {
                        $config = array(
                            'protocol' => $protocol,
                            'smtp_host' => $domain_name,
                            'smtp_user' => $stm_user,
                            'smtp_pass' => $stm_pass,
                            'smtp_port' => 465,
                            'smtp_timeout' => 30,
                            'charset' => 'utf-8',
                            'newline' => "\r\n", 
                            'mailtype' => 'html',
                        );
                    } else {
                        $config = array(
                            'protocol' => $protocol,
                            'smtp_host' => 'ssl://' . $domain_name,
                            'smtp_user' => $stm_user,
                            'smtp_pass' => $stm_pass,
                            'smtp_port' => 465,
                            'smtp_timeout' => 30,
                            'charset' => 'utf-8',
                            'newline' => "\r\n", 
                            'mailtype' => 'html',
                            'validate' => true,
                        );
                    }

                    $this->email->initialize($config);
                    $this->email->from($to);
                    $this->email->to($to);
                    $this->email->subject($subject);
                    $this->email->message($message);

                    if ($this->email->send()) {
                        echo "Email sent successfully";
                    } else {
                        echo $this->email->print_debugger();
                    }
                }
            }
        } else {
            echo "No scheduled emails found.";
        }
    }
}
?>
