<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Caccounts extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
        $this->db->query('SET SESSION sql_mode = ""');
   
        $this->load->library('auth');
        $this->load->library('session');
        $this->load->dbforge();
        $this->load->model('Web_settings');
        $this->load->model('Hrm_model');
        $this->auth->check_admin_auth();
        $this->template->current_menu = 'Caccounts';

      
    }
    
  
    // ============== Tax settings ================
    public function tax_settings(){
        $taxsinfo = $this->db->count_all('tax_settings');
        if($taxsinfo > 0){
           redirect("Caccounts/tax_settings_updateform"); 
        }
        $data=array('title'=> display('tax_settings'));
        $content = $this->parser->parse('accounts/tax_settings',$data,true);
        $this->template->full_admin_html_view($content);    
    }
// tax setting update form
      public function tax_settings_updateform(){
        $data['title'] = display('tax_settings');
        $data['setinfo'] = $this->Settings->tax_setting_info();
        $content = $this->parser->parse('accounts/tax_settings_update',$data,true);
        $this->template->full_admin_html_view($content);    
    }

     // Entry Tax Settings
      public function create_tax_settins(){
        $taxfield = $this->input->post('taxfield',TRUE);
        $dfvalue  = $this->input->post('default_value',TRUE);
        $nt       = $this->input->post('nt',TRUE);
        $reg_no   = $this->input->post('reg_no',TRUE);
        $ishow    = $this->input->post('is_show',TRUE);
         for ($i=0; $i < sizeof($taxfield); $i++) {
                     $tax    = $taxfield[$i];
                    $default = $dfvalue[$i];
                    $rg_no   = $reg_no[$i];
                    $is_show = (!empty($ishow[$i])?$ishow[$i]:0);
          $data = array(
                'create_by' => $this->session->userdata('user_id'),
                'default_value' => $default,
                'tax_name'      => $tax,
                'nt'            => $nt,
                'reg_no'        => $rg_no,
                 ); 
         $this->db->insert('tax_settings',$data);                                   
            }
           

             for ($i=0; $i < sizeof($taxfield); $i++) {
        $fld = 'tax'.$i;

        if (!empty($fld)) {
            if (!$this->db->field_exists($fld, 'product_service')) {
                $this->dbforge->add_column('product_service', [
                    $fld => [
                        'type' => 'TEXT'
                    ]
                ]);

            }
             $this->dbforge->add_column('tax_collection', [
                    $fld => [
                        'type' => 'TEXT'
                    ]
                ]);
               if (!$this->db->field_exists($fld, 'product_information')) {
                $this->dbforge->add_column('product_information', [
                    $fld => [
                        'type' => 'TEXT'
                    ]
                ]);
            }

            if (!$this->db->field_exists($fld, 'quotation_taxinfo')) {
                $this->dbforge->add_column('quotation_taxinfo', [
                    $fld => [
                        'type' => 'TEXT'
                    ]
                ]);
            }
            
        } 
            }
            
            $this->session->set_flashdata('message', display('save_successfully'));
            redirect("Caccounts/tax_settings"); 
    }

          public function update_tax_settins(){

               $tablecolumn = $this->db->list_fields('product_service');
               $num_column = count($tablecolumn)-4;
for ($t=0; $t < $num_column; $t++) {
$txd = 'tax'.$t;
 if ($this->db->field_exists($txd, 'product_service')) {
    $this->dbforge->drop_column('product_service', $txd);
}
if ($this->db->field_exists($txd, 'tax_collection')) {
    $this->dbforge->drop_column('tax_collection', $txd);
}
if ($this->db->field_exists($txd, 'product_information')) {
    $this->dbforge->drop_column('product_information', $txd);
   
}

if ($this->db->field_exists($txd, 'quotation_taxinfo')) {
    $this->dbforge->drop_column('quotation_taxinfo', $txd);
   
}
 echo  'successfully_deleted';
    }
   


        $taxfield = $this->input->post('taxfield',TRUE);
        $dfvalue  = $this->input->post('default_value',TRUE);
        $nt       = $this->input->post('nt',TRUE);
        $reg_no   = $this->input->post('reg_no',TRUE);
        $id       = $this->input->post('id',TRUE);
        $ishow    = $this->input->post('is_show',TRUE);
        $this->db->empty_table('tax_settings');
         for ($x=0; $x < sizeof($taxfield); $x++) {
                     $tax    = $taxfield[$x];
                     $default  = $dfvalue[$x];
                     $rg_no   = $reg_no[$x];
                     $is_show = (!empty($ishow[$x])?$ishow[$x]:0);

          $data = array(
                'create_by' => $this->session->userdata('user_id'),
                'default_value' => $default,
                'tax_name'      => $tax,
                'nt'            => $nt,
                'reg_no'        => $rg_no,
                 ); 
         $this->db->insert('tax_settings',$data);                 
            }
            $tupfild ='';
              for ($y=0; $y < sizeof($taxfield); $y++) {
        $tupfild = 'tax'.$y;

        if (!empty($tupfild)) {
            
            if (!$this->db->field_exists($tupfild, 'product_service')) {
                $this->dbforge->add_column('product_service', [
                    $tupfild => [
                        'type' => 'TEXT'
                    ]
                ]);
            }

             if (!$this->db->field_exists($tupfild, 'tax_collection')) {
                $this->dbforge->add_column('tax_collection', [
                    $tupfild => [
                        'type' => 'TEXT'
                    ]
                ]);
            }
            if (!$this->db->field_exists($tupfild, 'product_information')) {
                $this->dbforge->add_column('product_information', [
                    $tupfild => [
                        'type' => 'TEXT'
                    ]
                ]);
            }

             if (!$this->db->field_exists($tupfild, 'quotation_taxinfo')) {
                $this->dbforge->add_column('quotation_taxinfo', [
                    $tupfild => [
                        'type' => 'TEXT'
                    ]
                ]);
            }
           echo  'successfully_inserted';
        } 
            }
           
            $this->session->set_flashdata('message', display('successfully_updated'));
            redirect("Caccounts/tax_settings"); 
    }
    // tax setting update



    /*new tax setting satyam*/
     public function add_taxes()
    {

        $CI = & get_instance();


        $CI->load->model('Web_settings');

        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();



         $data=array(
            
            'title'=>display('add_tax'),
            'setting_detail' => $setting_detail
        );
        
    //   print_r($setting_detail);

        $content = $this->parser->parse('taxes/add_tax',$data,true);
        $this->template->full_admin_html_view($content);   
    }














     public function tax_list()
    {
        $tax_list = $this->db->select('*')
                    ->from('tax_information')
                    ->get()
                    ->result();

        $data=array(
                'title'=>display('manage_tax'),
                'tax_list'=>$tax_list
            );

        $content = $this->parser->parse('taxes/manage_tax',$data,true);
        $this->template->full_admin_html_view($content);   
        
    }


     /*new tax setting satyam*/


    #===============Add TAX================#
    public function add_tax()
    {
        $data=array('title'=>display('add_tax'));
        $content = $this->parser->parse('accounts/add_tax',$data,true);

        // $content = $this->parser->parse('accounts/add_tax',$data,true);


        $this->template->full_admin_html_view($content);   
        
    }
     // ================= Income tax form start ===========
    
       public function add_incometax()
    {
        $data=array('title'=>display('add_incometax'));
        $content = $this->parser->parse('accounts/income_tax_form',$data,true);
        $this->template->full_admin_html_view($content);   
        
    }

    
    public function delete_row()
    {
        $id = $this->input->post('rowId');
        $tax_type = $this->input->post('taxType');
        $result = $this->Hrm_model->delete_payrolldata($id, $tax_type);
    }
    
    // Delete for Federal Tax
    public function delete_federal()
    {
        $id = $this->input->post('rowId');
        $result = $this->Hrm_model->delete_federaldata($id);
    }

    public function weekly_delete_row()
    {
        $id = $this->input->post('rowId');
        $result = $this->Hrm_model->delete_weeklydata($id);
    }

    public function biweekly_delete_row()
    {
        $id = $this->input->post('rowId');
        $result = $this->Hrm_model->delete_biweeklydata($id);
    }

    public function monthly_delete_row()
    {
        $id = $this->input->post('rowId');
        $result = $this->Hrm_model->delete_monthlydata($id);
    }

    public function create_tax_federal()
    {
        $tax_name = $this->input->post('tax_name', TRUE);
        $year = date("Y");

        $user_id = $this->input->post('admin_company_id');
        $decodedId = decodeBase64UrlParameter($user_id);
        $companyId = $this->input->post('adminId');

        $start_amount = $this->input->post('employer', TRUE);
        $end_amount = $this->input->post('employee', TRUE);
        $details = $this->input->post('details', TRUE);
        $single_from = $this->input->post('single_from', TRUE);
        $single_to = $this->input->post('single_to', TRUE);
        $tax_filling_from = $this->input->post('tax_filling_from', TRUE);
        $tax_filling_to = $this->input->post('tax_filling_to', TRUE);
        $married_from = $this->input->post('married_from', TRUE);
        $married_to = $this->input->post('married_to', TRUE);
        $head_household_from = $this->input->post('head_household_from', TRUE);
        $head_household_to = $this->input->post('head_household_to', TRUE);

        $this->db->where('tax', $tax_name);
        $this->db->delete('federal_tax');

        for ($i = 0, $n = count($details); $i < $n; $i++) {

            $samount = $start_amount[$i];
            $eamount = $end_amount[$i];
            $arate = $details[$i];
            $sfrom = $single_from[$i];
            $sto = $single_to[$i];
            $tffrom = $tax_filling_from[$i];
            $tfto = $tax_filling_to[$i];
            $mfrom = $married_from[$i];
            $mto = $married_to[$i];
            $hhfrom = $head_household_from[$i];
            $hhto = $head_household_to[$i];

            $data1 = array(
                'year' => $year,
                'employer' => $samount,
                'employee' => $eamount,
                'details' => $arate,
                'single' => $sfrom . "-" . $sto,
                'tax_filling' => $tffrom . "-" . $tfto,
                'married' => $mfrom . "-" . $mto,
                'head_household' => $hhfrom . "-" . $hhto,
                'tax' => $tax_name,
                'created_by' => $decodedId
            );

            $this->db->where('tax', $tax_name);
            $this->db->where('single', $sfrom . "-" . $sto);
            $existing = $this->db->get('federal_tax')->row_array();

            if ($existing) {
                $this->db->where('id', $existing['id']);
                $this->db->update('federal_tax', $data1);
            } else {
                $this->db->insert('federal_tax', $data1);
            }
        }

        $this->session->set_flashdata('message', display('save_successfully'));
        redirect(base_url('Chrm/payroll_setting?id=' . $user_id . '&admin_id=' . $companyId));
    }


    #==============TAX Entry==============#
    public function tax_entry()
    {
        $data=array('title'=>display('accounts_tax_form'));

          $tax['tax_id'] = $this->auth->generator(10);
          $tax['tax'] = $this->input->post('enter_tax',TRUE);
          $tax['description'] =$this->input->post('description',TRUE);
          $tax['state'] =$this->input->post('state',TRUE);
          $tax['tax_agency'] =$this->input->post('tax_agency',TRUE);
          $tax['account'] =$this->input->post('account',TRUE);
          $tax['show_taxonreturn'] =$this->input->post('show_taxonreturn',TRUE);
          $tax['status_type'] =$this->input->post('status_type',TRUE);
          $tax['created_by'] = $this->session->userdata('user_id');

          $tax['status'] = 1;

        $result = $this->Accounts->tax_entry($tax);

        redirect('Caccounts/manage_tax');
    }
    #==============Manage TAX==============#
      public function manage_tax()
    {
        $CI = & get_instance();
        $CI->load->model('Web_settings');



       $tax_list = $this->db->select('*')->from('tax_information')->where('created_by', $this->session->userdata('user_id'))->get()->result();
       $company_info = $this->db->select('*')->from('company_information')->where('create_by', $this->session->userdata('user_id'))->get()->result();
       $gettax_info     = $this->Accounts->gettax_info(); 
       $setting_detail = $CI->Web_settings->retrieve_setting_editdata();


        $data=array(
                'title'=>display('manage_tax'),
                'tax_list'=>$tax_list,
                'company_info'=>$company_info,
                 'gettax_info'=>$gettax_info,  
                 'setting_detail' => $setting_detail

            );
       

 
        $content = $this->parser->parse('accounts/manage_tax',$data,true);
        $this->template->full_admin_html_view($content);   
        
    }

    // ================= manage Income tax  ===============
    public function manage_income_tax(){
        $data['title']     = "manage_income_tax"; 
        $data['taxs']      = $this->Accounts->viewTaxsetup();
        $content = $this->parser->parse('accounts/manage_income_tax',$data,true);
        $this->template->full_admin_html_view($content);   
    }
   // =====================  Income tax update form =============
    public function update_taxsetup_form($id = null){
        $data['title']     = "income_tax_updateform"; 
        $data['data']      = $this->Accounts->taxsetup_updateForm($id); 
        $content = $this->parser->parse('accounts/income_tax_updateform',$data,true);
        $this->template->full_admin_html_view($content);    
    }
     // ============== Update Income tax =================
    public function update_income_tax(){
        $postData = [
                'tax_setup_id'    => $this->input->post('tax_setup_id',true),
                'start_amount'    => $this->input->post('start_amount',true),
                'end_amount'      => $this->input->post("end_amount",true),
                'rate'            => $this->input->post("rate",true),
            ];      
            if ($this->Accounts->update_taxsetup($postData)) { 
                $this->session->set_flashdata('message', display('successfully_updated'));
            } else {
                $this->session->set_flashdata('error_message',  display('please_try_again'));
            }
            redirect("Caccounts/manage_income_tax/");
    }

    public function delete_income_tax($id = null){ 
        if ($this->Accounts->taxsetup_delete($id)) {
            #set success message
            $this->session->set_flashdata('message',display('delete_successfully'));
        } else {
            #set exception message
            $this->session->set_flashdata('error_message',display('please_try_again'));
        }
        redirect("Caccounts/manage_income_tax");
    }



    #==============TAX Edit==============#
    public function tax_edit($tax_id)
    {
        
                $CI = & get_instance();

        $CI->load->model('Web_settings');

        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        
        $tax_info = $this->db->select('*')->from('tax_information')->where('tax_id',$tax_id)->where('created_by', $this->session->userdata('user_id'))->get()->result_array();


         $data=array(
                'title'=>display('accounts_tax_edit'),
                'tax_id'=>$tax_info[0]['tax_id'],
                'tax'=>$tax_info[0]['tax'],
                 'description'=>$tax_info[0]['description'],
                 'tax_agency'=>$tax_info[0]['tax_agency'],
                 'state'=>$tax_info[0]['state'],
                 'account'=>$tax_info[0]['account'],
                 'show_taxonreturn'=>$tax_info[0]['show_taxonreturn'],
                 'status_type'=>$tax_info[0]['status_type'],
                 'setting_detail' => $setting_detail

            );
            
        
        $content = $this->parser->parse('accounts/tax_edit',$data,true);
        $this->template->full_admin_html_view($content);   
        
    }
    #==============TAX Update==============#
    public function update_tax($id)
    {
         $CI = & get_instance();
       
    $CI->load->model('Web_settings');
        $data=array('title'=>display('accounts_tax_edit'));
        $tax['tax'] = $this->input->post('enter_tax',TRUE);
        $tax['description'] = $this->input->post('description',TRUE);
         $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        $tax['state'] = $this->input->post('state',TRUE);
        $tax['tax_agency'] = $this->input->post('tax_agency',TRUE);
        $tax['account'] = $this->input->post('account',TRUE);
        $tax['show_taxonreturn'] = $this->input->post('show_taxonreturn',TRUE);
        $tax['status_type'] = $this->input->post('status_type',TRUE);
        

        $result = $this->Accounts->update_tax_data($tax,$id);
        if ($result == true) {

           logEntry($this->session->userdata('user_id'), $this->session->userdata('unique_id'), $id, '', $this->session->userdata('userName'), 'Edit Tax', 'Taxes', 'Tax has been updated Successfully', 'Add', date('m-d-Y'));

           $this->session->set_userdata(array('message'=>display('successfully_updated')));
        }
        $tax_list = $this->db->select('*')
                    ->from('tax_information')
                    ->where('created_by', $this->session->userdata('user_id'))
                    ->get()
                    ->result();

        $data=array(
                'title'=> display('tax_edit'),
                'tax_list'=>$tax_list,
                 'setting_detail' => $setting_detail
            );
    //   print_r($data);

        $content = $this->parser->parse('accounts/manage_tax',$data,true);
        $this->template->full_admin_html_view($content);   
        
    }

    #==============TAX Update==============#
    public function tax_delete($id)
    {
        $tax['tax'] = $this->input->post('enter_tax',TRUE);
        
        $result = $this->db->delete('tax_information', array('tax_id' => $id)); 
       // print_r( $result);

        if ($result == true) {
            logEntry($this->session->userdata('user_id'), $this->session->userdata('unique_id'), $id, '', $this->session->userdata('userName'), 'Delete Tax', 'Taxes', 'Tax has been deleted Successfully', 'Delete', date('m-d-Y'));
           $this->session->set_userdata(array('message'=>display('successfully_delete')));
        }
        redirect('Caccounts/manage_tax');
    }

    #==============Closing reports==========#
    public function closing()
    {
      $data=array('title'=> display('closing_account'));
      $data=$this->Accounts->accounts_closing_data();
      $content = $this->parser->parse('accounts/closing_form',$data,true);
      $this->template->full_admin_html_view($content);  
    }
    #===============Accounts summary==========#
    public function summary()
    {

        $currency_details = $this->Web_settings->retrieve_setting_editdata();
        $data=array(
            'title'    =>display('accounts_summary_data'),
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            );
      
        $data['table_inflow']=$this->Accounts->table_name(2);
        $data['table_outflow']=$this->Accounts->table_name(1);
      
        $data['inflow']=$this->Accounts->accounts_summary(2);
        $data['total_inflow']=number_format($this->Accounts->sub_total, 2, '.', ',');

        $data['outflow']=$this->Accounts->accounts_summary(1);
        $data['total_outflow']=number_format($this->Accounts->sub_total, 2, '.', ',');

        $content = $this->parser->parse('accounts/summary',$data,true);
        $this->template->full_admin_html_view($content);  
    }
    #================Summary single===========#
    public function summary_single($start,$end,$account)
    {
        $data=array('title'=>   display('accounts_details_data'));
            
        //Getting all tables name.   
        $data['table_inflow']=$this->Accounts->table_name(2);
        $data['table_outflow']=$this->Accounts->table_name(1);
            
        $data['accounts']=$this->Accounts->accounts_summary_details($start,$end,$account);
       
        $content = $this->parser->parse('accounts/summary_single',$data,true);
        $this->template->full_admin_html_view($content);      
    }
    #==============Summary report date  wise========#
    public function summary_datewise()
    {
        $start=  $this->input->post('from_date',TRUE);
        $end=  $this->input->post('to_date',TRUE);
        $account=$this->input->post('accounts',TRUE);
        
        if($account != "All")
            { $url="Caccounts/summary_single/$start/$end/$account";
                redirect(base_url($url));
                exit;     
            }

        $currency_details = $this->Web_settings->retrieve_setting_editdata();
            
        $data=array(
            'title'    => display('datewise_summary_data'),
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            );
            
        //Getting all tables name.   
        $data['table_inflow']=$this->Accounts->table_name(2);
        $data['table_outflow']=$this->Accounts->table_name(1);
        
        $data['inflow']=$this->Accounts->accounts_summary_datewise($start,$end,"2");
        $data['total_inflow']=$this->Accounts->sub_total;
        
        $data['outflow']=$this->Accounts->accounts_summary_datewise($start,$end,"1");
        $data['total_outflow']=$this->Accounts->sub_total;
        
        $content = $this->parser->parse('accounts/summary',$data,true);
        $this->template->full_admin_html_view($content);  
    }
        
    #============ Cheque Manager ==============#
    public function cheque_manager()
    {

        $currency_details = $this->Web_settings->retrieve_setting_editdata();
       
        $data=array(
            'title'    => display('accounts_cheque_manager'),
            'currency' => $currency_details[0]['currency'],
            'position' => $currency_details[0]['currency_position'],
            );
        $data["cheque_manager"]=$this->Accounts->cheque_manager(30,0);
        $content = $this->parser->parse('accounts/cheque_manager',$data,true);
        $this->template->full_admin_html_view($content);
    }

    #============ Cheque Manager edit ==============#
    public function cheque_manager_edit($transection_id,$action)
    {
        $this->Accounts->data_update(array('status'=>$action),"customer_ledger",array('transaction_id'=>$transection_id));
        $this->Accounts->data_update(array('cheque_status'=>$action),"cheque_manger",array('transection_id'=>$transection_id));
        $this->session->set_userdata(array('message'=>display('cheque_ammount_asjusted')));
        redirect(base_url('Caccounts/cheque_manager'));exit;
    }

    // Add daily closing 
    public function add_daily_closing()
    {
        
        $closedata = $this->db->select('*')->from('daily_closing')->where('date',date('Y-m-d'))->get()->num_rows();
        if($closedata > 0){
         $this->session->set_userdata(array('error_message'=> 'Already Closed Today'));
        redirect(base_url('Admin_dashboard/closing'));exit;
            
        }


        $todays_date = date("Y-m-d");
        
        $data = array(
            'closing_id'        =>  $this->generator(15),           
            'last_day_closing'  =>  str_replace(',', '', $this->input->post('last_day_closing',TRUE)),
            'cash_in'           =>  str_replace(',', '', $this->input->post('cash_in',TRUE)),
            'cash_out'          =>  str_replace(',', '', $this->input->post('cash_out',TRUE)),
            'date'              =>  $todays_date,
            'amount'            =>  str_replace(',', '', $this->input->post('cash_in_hand',TRUE)),
            'status'            =>      1
        );
        $invoice_id = $this->Accounts->daily_closing_entry($data);
        
       
        $this->session->set_userdata(array('message'=> display('successfully_added')));
        redirect(base_url('Admin_dashboard/closing_report'));exit;
    }
 
    // Add expance entry
    public function add_expence_entry()
    {
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Closings');
        
        $todays_date = date("m-d-Y");
        
        $data = array(
            'expence_id'    =>  $this->generator(15),
            'date'          =>  $todays_date,
            'expence_title' =>  $this->input->post('title',TRUE),
            'description'   =>  $this->input->post('description',TRUE),
            'amount'        =>  $this->input->post('amount',TRUE),
            'status'        =>  1
        );
        
        $invoice_id = $CI->Closings->expence_entry( $data );
        $this->session->set_userdata(array('message'=> display('successfully_added')));
        redirect(base_url('cclosing'));
    }
    // Add bank entry
    public function add_banking_entry()
    {
        $CI =& get_instance();
        $this->auth->check_admin_auth();
        $CI->load->model('Closings');
        $todays_date = date("m-d-Y");
        
        $data = array(
            'banking_id'        =>  $this->generator(15),
            'date'              =>  $todays_date,
            'bank_id'           =>  $this->input->post('bank_id',TRUE),
            'deposit_type'      =>  $this->input->post('deposit_name',TRUE),
            'transaction_type'  =>  $this->input->post('transaction_type',TRUE),
            'description'       =>  $this->input->post('description',TRUE),
            'amount'            =>  $this->input->post('amount',TRUE),
            'status'            =>1
        );
        
        $invoice_id = $CI->Closings->banking_data_entry( $data );
        $this->session->set_userdata(array('message'=> display('successfully_added')));
        redirect(base_url('cclosing'));exit;
    }
    
    //Closing report
    public function closing_report()
    {
        $content =$this->laccounts->daily_closing_list();
        $this->template->full_admin_html_view($content);
    }
    // Date wise closing reports 
    public function date_wise_closing_reports()
    {           
        $from_date = $this->input->get('from_date');       
        $to_date = $this->input->get('to_date');
        
        #
        #pagination starts
        #
        $config["base_url"]     = base_url('Caccounts/date_wise_closing_reports/');
        $config["total_rows"]   = $this->Accounts->get_date_wise_closing_report_count($from_date,$to_date);
        $config["per_page"] = 5;
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
    // Random Id generator
    public function generator($lenth)
    {
        $number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","1","2","3","4","5","6","7","8","9","0");
    
        for($i=0; $i<$lenth; $i++)
        {
            $rand_value=rand(0,61);
            $rand_number=$number["$rand_value"];
        
            if(empty($con))
            { 
            $con=$rand_number;
            }
            else
            {
            $con="$con"."$rand_number";}
        }
        return $con;
    }
    // tax report
      public function tax_report()
    {
        $this->load->model('Accounts');
          $taxfield = $this->db->select('tax_name,default_value')
                ->from('tax_settings')
                ->get()
                ->result_array();
         $tablecolumn = $this->db->list_fields('tax_collection');
                $num_column = count($tablecolumn)-4;       
        $start = (!empty($this->input->get('from_date'))?$this->input->get('from_date'):date('Y-m-d'));
        $end = (!empty($this->input->get('to_date'))?$this->input->get('to_date'):date('Y-m-d'));
        $data['from_date']= $start;
        $data['to_date']  = $end;
        $data['title']    =   display('tax_report');
        $data['taxes']    = $taxfield;
        $data['taxnumber']= $num_column;
        $data['taxdata']  = $this->Accounts->taxdata($start,$end);
        $content = $this->parser->parse('accounts/tax_report',$data,true);
        $this->template->full_admin_html_view($content);      
    }
   //customer wise tax report
    public function invoice_wise_tax_report()
    {
        $this->load->model('Accounts');
          $taxfield = $this->db->select('tax_name,default_value')
                ->from('tax_settings')
                ->get()
                ->result_array();
         $tablecolumn = $this->db->list_fields('tax_collection');
                $num_column = count($tablecolumn)-4;       
        $start = (!empty($this->input->get('from_date'))?$this->input->get('from_date'):date('Y-m-d'));
        $end = (!empty($this->input->get('to_date'))?$this->input->get('to_date'):date('Y-m-d'));
        $invoice_id = (!empty($this->input->get('invoice_id'))?$this->input->get('invoice_id'):'');
        $data['invoice_id']  = $invoice_id;
        $data['from_date']   = $start;
        $data['to_date']     = $end;
        $data['customers']   = $this->Accounts->tax_customer();
        $data['title']       =  display('tax_report');
        $data['taxes']       = $taxfield;
        $data['taxnumber']   = $num_column;
        $data['taxdata']     = $this->Accounts->customer_taxdata($start,$end,$invoice_id);
        $content = $this->parser->parse('accounts/invoice_wise_tax_report',$data,true);
        $this->template->full_admin_html_view($content);      
    }

    // Insert Tax
    public function create_tax_setup()
    {
        $type = $_GET['type'];
        $tname = $this->input->post('tax_name', TRUE);
        $tax_name = str_replace("_", " ", $tname);
        $year = date("Y");
        $user_id = $this->input->post('admin_company_id', TRUE);
        $decodedId = decodeBase64UrlParameter($user_id);
        $companyId = $this->input->post('adminId', TRUE);
        $start_amount = $this->input->post('employer', TRUE);
        $end_amount = $this->input->post('employee', TRUE);
        $details = $this->input->post('details', TRUE);
        $single_from = $this->input->post('single_from', TRUE);
        $single_to = $this->input->post('single_to', TRUE);
        $tax_filling_from = $this->input->post('tax_filling_from', TRUE);
        $tax_filling_to = $this->input->post('tax_filling_to', TRUE);
        $married_from = $this->input->post('married_from', TRUE);
        $married_to = $this->input->post('married_to', TRUE);
        $head_household_from = $this->input->post('head_household_from', TRUE);
        $head_household_to = $this->input->post('head_household_to', TRUE);

        $this->db->where('tax', $tax_name);

        if ($type == 'statetax') {
            $this->db->delete('state_localtax');
        } elseif ($type == 'weekly') {
            $this->db->delete('weekly_tax_info');
        } elseif ($type == 'biweekly') {
            $this->db->delete('biweekly_tax_info');
        } elseif ($type == 'monthly') {
            $this->db->delete('monthly_tax_info');
        }

        for ($i = 0, $n = count($details); $i < $n; $i++) {
            $samount = $start_amount[$i];
            $eamount = $end_amount[$i];
            $arate = $details[$i];
            $sfrom = $single_from[$i];
            $sto = $single_to[$i];
            $tffrom = $tax_filling_from[$i];
            $tfto = $tax_filling_to[$i];
            $mfrom = $married_from[$i];
            $mto = $married_to[$i];
            $hhfrom = $head_household_from[$i];
            $hhto = $head_household_to[$i];
            
            $data1 = array(
                'year' => $year,
                'employer' => $samount,
                'employee' => $eamount,
                'details' => $arate,
                'single' => $sfrom . "-" . $sto,
                'tax_filling' => $tffrom . "-" . $tfto,
                'married' => $mfrom . "-" . $mto,
                'head_household' => $hhfrom . "-" . $hhto,
                'tax' => $tax_name,
                'created_by' => $decodedId
            );

            if ($type == 'statetax') {
                $this->db->insert('state_localtax', $data1);
            } elseif ($type == 'weekly') {
                $this->db->insert('weekly_tax_info', $data1);
            } elseif ($type == 'biweekly') {
                $this->db->insert('biweekly_tax_info', $data1);
            } elseif ($type == 'monthly') {
                $this->db->insert('monthly_tax_info', $data1);
            }
        }

        $this->session->set_flashdata('message', display('save_successfully'));
        redirect(base_url('Chrm/payroll_setting?id=' . $user_id . '&admin_id=' . $companyId));
    }

    // City Tax
    public function create_citytax_setup()
    {
        $type=$_GET['type'];
        $tname = $this->input->post('tax_name',TRUE);
        $tax_name= str_replace("_"," ",$tname);
        $year = date("Y");
        $user_id      = $this->input->post('admin_company_id',TRUE);
        $decodedId      = decodeBase64UrlParameter($user_id);
        $companyId      = $this->input->post('adminId',TRUE);
        $start_amount = $this->input->post('employer',TRUE);
        $end_amount = $this->input->post('employee',TRUE);
        $details = $this->input->post('details',TRUE);
        $single_from = $this->input->post('single_from',TRUE);
        $single_to = $this->input->post('single_to',TRUE);
        $tax_filling_from = $this->input->post('tax_filling_from',TRUE);
        $tax_filling_to = $this->input->post('tax_filling_to',TRUE);
        $married_from = $this->input->post('married_from',TRUE);
        $married_to = $this->input->post('married_to',TRUE);
        $head_household_from = $this->input->post('head_household_from',TRUE);
        $head_household_to = $this->input->post('head_household_to',TRUE);
        $this->db->where('tax',$tax_name);
        $this->db->delete('city_tax_info');

       for ($i = 0, $n = count($details); $i < $n; $i++)
       {
            $samount = $start_amount[$i];
            $eamount = $end_amount[$i];
            $arate = $details[$i];
            $sfrom = $single_from[$i];
            $sto = $single_to[$i];
            $tffrom = $tax_filling_from[$i];
            $tfto = $tax_filling_to[$i];
            $mfrom = $married_from[$i];
            $mto = $married_to[$i];
            $hhfrom = $head_household_from[$i];
            $hhto = $head_household_to[$i];
            $data1 = array(
                'year'  => $year,
                'employer'    => $samount,
                'employee'      => $eamount,
                'details'            => $arate,
                'single'   =>  $sfrom."-".$sto,
                'tax_filling' => $tffrom."-".$tfto,
                'married' => $mfrom."-".$mto,
                'head_household' => $hhfrom."-".$hhto,
                'tax'  =>$tname,
                'created_by' => $decodedId
            );

            $this->db->insert('city_tax_info', $data1);

        }
        $this->session->set_flashdata('message', display('save_successfully'));
        redirect(base_url('Chrm/payroll_setting?id=' . $user_id . '&admin_id=' . $companyId));
        if (empty($data1)) {
            redirect(base_url('Chrm/payroll_setting?id=' . $user_id . '&admin_id=' . $companyId));
        }else{
            redirect(base_url('Chrm/payroll_setting?id=' . $user_id . '&admin_id=' . $companyId));
        }
    }

    // County Tax
    public function create_countytax_setup()
    {
        $type=$_GET['type'];
        $tname = $this->input->post('tax_name',TRUE);
        $tax_name= str_replace("_"," ",$tname);
        $year = date("Y");
        $user_id      = $this->input->post('admin_company_id',TRUE);
        $decodedId      = decodeBase64UrlParameter($user_id);
        $companyId      = $this->input->post('adminId',TRUE);
        $start_amount = $this->input->post('employer',TRUE);
        $end_amount = $this->input->post('employee',TRUE);
        $details = $this->input->post('details',TRUE);
        $single_from = $this->input->post('single_from',TRUE);
        $single_to = $this->input->post('single_to',TRUE);
        $tax_filling_from = $this->input->post('tax_filling_from',TRUE);
        $tax_filling_to = $this->input->post('tax_filling_to',TRUE);
        $married_from = $this->input->post('married_from',TRUE);
        $married_to = $this->input->post('married_to',TRUE);
        $head_household_from = $this->input->post('head_household_from',TRUE);
        $head_household_to = $this->input->post('head_household_to',TRUE);
        $this->db->where('tax',$tax_name);
        $this->db->delete('county_tax_info');

       for ($i = 0, $n = count($details); $i < $n; $i++)
       {
            $samount = $start_amount[$i];
            $eamount = $end_amount[$i];
            $arate = $details[$i];
            $sfrom = $single_from[$i];
            $sto = $single_to[$i];
            $tffrom = $tax_filling_from[$i];
            $tfto = $tax_filling_to[$i];
            $mfrom = $married_from[$i];
            $mto = $married_to[$i];
            $hhfrom = $head_household_from[$i];
            $hhto = $head_household_to[$i];
            $data1 = array(
                'year'  => $year,
                'employer'    => $samount,
                'employee'      => $eamount,
                'details'            => $arate,
                'single'   =>  $sfrom."-".$sto,
                'tax_filling' => $tffrom."-".$tfto,
                'married' => $mfrom."-".$mto,
                'head_household' => $hhfrom."-".$hhto,
                'tax'  =>$tname,
                'created_by' => $decodedId
        );
        
        $this->db->insert('county_tax_info', $data1);

        }
        $this->session->set_flashdata('message', display('save_successfully'));
        redirect(base_url('Chrm/payroll_setting?id=' . $user_id . '&admin_id=' . $companyId));
        if (empty($data1)) {
            redirect(base_url('Chrm/payroll_setting?id=' . $user_id . '&admin_id=' . $companyId));
        }else{
            redirect(base_url('Chrm/payroll_setting?id=' . $user_id . '&admin_id=' . $companyId));
        }
    }
}