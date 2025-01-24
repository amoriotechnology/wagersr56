<?php
error_reporting(1);
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Hrm_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
public function state_tax_list()
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('tax');
    $this->db->distinct();
    $this->db->where('tax_type', 'state_tax');
    $this->db->or_where('tax_type', 'living_state_tax');
    $this->db->where('created_by', $user_id);
    $query = $this->db->get('tax_history');
   if ($query->num_rows() > 0) {
    return $query->result_array();
   }
}
// To update the tax range - Payroll setting
public function  insert_taxesname($postData){
    $postData= str_replace("+"," ",$postData);
        $data1 = array( 
      'status' => 0
);
    $this->db->where('created_by',$this->session->userdata('user_id'));
$this->db->update('state_and_tax', $data1);
        $data=array(
            'status' => 1,
        );
        $this->db->where('state',$postData);
        $this->db->update('state_and_tax', $data);
    }
                              //=========================General======================//
    public function employeerDetailsdata( $user_id)
    {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->where('company_id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
       }
    }

    public function get_company_info($user_id)
    {
       if (!$user_id) {
           return false;
       }
       try {
           $this->db->select('*');
           $this->db->from('company_information');
           $this->db->where('company_id', $user_id);
           $query = $this->db->get();
           if ($query === false) {
               return false;
           }
           if ($query->num_rows() > 0) {
               return $query->result_array();
           }
           return false;
       } catch (Exception $e) {
           log_message('error', 'Error in get_company_info: ' . $e->getMessage());
           return false;
       }
    }

    public function getDatas($table, $select, $where) {
        return $this->db->select($select)->from($table)->where($where)->get()->result_array();
    }
    
    public function employee_data_get($id) 
    {
        $this->db->select("eh.id,eh.first_name,eh.middle_name,eh.last_name");
        $this->db->from('timesheet_info ti');
        $this->db->join('employee_history eh', 'eh.id = ti.templ_name');
        $this->db->where('ti.uneditable', 1);
        $this->db->where('ti.create_by', $id);
        $this->db->group_by('eh.id,eh.first_name,eh.middle_name,eh.last_name, ti.templ_name');
        $query = $this->db->get();    
        return $query->result_array();
    }
    public function timesheet_data_get() {
        $this->db->select("*");
        $this->db->from('timesheet_info');
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();    
        return $query->result_array();
    }
    public function stateTaxlist($id)
{
    $this->db->select('tax');
    $this->db->distinct();
    $this->db->where('tax_type', 'state_tax');
    $this->db->where('created_by', $id);
    $this->db->order_by('tax', 'desc');
    $query = $this->db->get('tax_history');
    if ($query->num_rows() > 0) {
        return $query->result_array();
   }
}

  //=========================General======================//
    public function getPaginatedEmployee($limit, $offset, $orderField, $orderDirection, $search, $Id) {
        $this->db->select('e.*,d.designation as des_name');
        $this->db->from('employee_history e');
        $this->db->join('designation d', 'd.id = e.designation AND e.designation IS NOT NULL AND e.e_type != 2', 'left');
        if ($search != "") {
            $this->db->group_start();
            $this->db->like('first_name', $search);
            $this->db->or_like('d.designation', $search);
            $this->db->or_like('e.phone', $search);
            $this->db->or_like('e.email', $search);
            $this->db->or_like('e.social_security_number', $search);
            $this->db->or_like('e.employee_type', $search);
            $this->db->or_like('e.payroll_type', $search);
            $this->db->or_like('e.routing_number', $search);
            $this->db->or_like('e.account_number', $search);
            $this->db->or_like('e.employee_tax', $search);
            $this->db->or_like('e.created_date', $search);
            $this->db->group_end();
        }
        $this->db->where('e.is_deleted', 0);
        $this->db->where('e.create_by', $Id);
        $this->db->limit($limit);
        $this->db->order_by('e.id', $orderDirection);
        $query  = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function updateData($table, $data, $where) {
        $this->db->set($data)->where($where)->update($table);
        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

 public function curn_info_default($currency_details, $decodedId) {
        $this->db->select('*');
        $this->db->from('currency_tbl');
        $this->db->where('icon', $currency_details);
        $query = $this->db->get();
        return $query->result_array();
    }
   public function getTotalEmployee($search, $Id) 
   {
        $this->db->select('e.first_name,e.middle_name,e.last_name,d.id,d.designation as des_name');
        $this->db->from('employee_history e');
        $this->db->join('designation d', 'd.id = e.designation'); 
        if ($search != "") {
            $this->db->or_like(array('e.first_name' => $search, 'd.designation'            => $search, 'e.phone'         => $search, 'e.email'        => $search,
                'e.zip' => $search, 'e.social_security_number' => $search, 'e.employee_type' => $search, 'e.payroll_type' => $search));
        }
        $this->db->where('e.is_deleted', 0);
        $this->db->where('e.create_by', $Id);
        $query = $this->db->get();
        return $query->num_rows();
    }
public function state_tax_list_employer()
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('tax');
    $this->db->distinct();
    $this->db->where('tax_type', 'state_tax');
    $this->db->where('created_by', $user_id);
    $query = $this->db->get('tax_history_employer');
   if ($query->num_rows() > 0) {
        return $query->result_array();
    }
}
    public function get_employee_sal($id,$user_id)
    {
        $this->db->select('h_rate,total_hours,extra_amount, SUM(extra_ytd) as extraytd , SUM(ytd) as ytd,SUM(sc_amount) as sc_amount');
        $this->db->from('timesheet_info');
        $this->db->where('templ_name', $id);
        $this->db->where('create_by', $user_id);
        $query = $this->db->get();
          if ($query->num_rows() > 0) {
            return $query->result_array();
         }
        return true;
    }

  public function total_unemployment($id, $user_id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('SUM(u_tax) as unempltotal');
        $this->db->from('tax_history_employer');
        $this->db->where('employee_id', $id);
        $this->db->where('tax', 'Unemployment');
        $this->db->where('tax_type','state_tax');
        $this->db->where('created_by', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }
public function get_employee_sal_ytd($id, $user_id,$timesheet) {
    $this->db->select('SUM(total_amount) as overalltotal');
    $this->db->from('info_payslip');
    $this->db->where('templ_name', $id);
     $this->db->where('timesheet_id !=', $timesheet);
    
  //  $this->db->where_in('tax', ['Income tax', 'Unemployment', 'NJ WF Work dev']);
    $this->db->where('create_by', $user_id);
    $this->db->group_by('templ_name');
    
     $query = $this->db->get();

   if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return true;
}

public function get_f1099nec_info($selectedValue)
      {
          $user_id = $this->session->userdata('user_id');
          $this->db->select("employee_history.*,tax_history.sales_c_amount ,  SUM(tax_history.sales_c_amount) as  sumofsc ,  SUM(tax_history.f_tax) as  sumofftax ,SUM(tax_history.amount) as  sumofamount ");
          $this->db->from('employee_history');
          $this->db->join('tax_history', 'employee_history.id = tax_history.employee_id');
          $this->db->where('employee_history.create_by', $user_id);
          $this->db->where('employee_history.id', $selectedValue);
          $this->db->where('tax_history.tax', 'Income tax');
          $query = $this->db->get();
           if ($query !== false && $query->num_rows() > 0) {
              return $query->result_array();
          }
          return false;
      }
      public function no_salecommission($selectedValue)
      {
          $user_id = $this->session->userdata('user_id');
          $this->db->select("SUM(extra_amount) as sc_nocomission");
          $this->db->from('timesheet_info');
          $this->db->where('timesheet_info.create_by', $user_id);
          $this->db->where('templ_name', $selectedValue);
        $query = $this->db->get();
             if ($query !== false && $query->num_rows() > 0) {
                return $query->result_array();
            }
            return false;
        }
            public function emp_yes_salecommission($selectedValue)
            {
                $this->load->library('session'); 
                $user_id = $this->session->userdata('user_id');
                $this->db->select("SUM(b.extra_amount) as emp_sc_amount");
                $this->db->from('employee_history AS a'); 
                $this->db->join('timesheet_info AS b', 'b.templ_name = a.id'); 
                $this->db->where('a.choice', 'No'); 
                $this->db->where('a.sales_partner', 'Sales_Partner'); 
                $this->db->where('b.templ_name', $selectedValue);
                $query = $this->db->get();
                if ($query !== false && $query->num_rows() > 0) {
                    return $query->result_array();
                }
                return false;
            }
public function get_data_salespartner()
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('*');
    $this->db->from('timesheet_info a'); 
    $this->db->join('employee_history b', 'b.id = a.templ_name', 'left'); 
    $this->db->where('b.choice','No');
    $this->db->where('a.create_by', $user_id); 
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
    return [];
    }
}

public function get_data_salespartner_another()
{
$user_id = $this->session->userdata('user_id');
$this->db->select('*');
$this->db->from('timesheet_info a');
$this->db->join('employee_history b', 'b.id = a.templ_name', 'left');
$this->db->where('b.sales_partner','Sales_Partner'); 
$this->db->where('a.create_by', $user_id);
$query = $this->db->get();
if ($query->num_rows() > 0) {
    return $query->result_array();
} else {
    return [];
}
}


// New State Tax Report - Madhu
public function other_tax_report(){
    $user_id = $this->session->userdata('user_id');
    $this->db->select('a.tax,a.tax_type,a.time_sheet_id,d.month,a.amount,c.first_name,c.last_name');
    $this->db->from('tax_history a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->where('a.tax_type', 'other_working_tax');
    $this->db->where('a.created_by', $this->session->userdata('user_id'));
    $query = $this->db->get();
    return $query->result_array();
}
public function other_tax_employer_report(){
    $user_id = $this->session->userdata('user_id');
    $this->db->select('a.tax,a.tax_type,a.time_sheet_id,d.month,a.amount,c.first_name,c.last_name');
    $this->db->from('tax_history_employer a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->where('a.tax_type', 'other_working_tax');
    $this->db->where('a.created_by', $this->session->userdata('user_id'));
    $query = $this->db->get();
    return $query->result_array();
}
public function other_tax_report_search($emp_name=null,$date=null){
    $user_id = $this->session->userdata('user_id');
    $this->db->select('a.tax,a.tax_type,a.time_sheet_id,d.month,a.amount,c.first_name,c.last_name');
    $this->db->from('tax_history a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->where('a.tax_type', 'other_working_tax');
    $this->db->where('a.created_by', $this->session->userdata('user_id'));
  if ($date) {
        $dates = explode(' to ', $date);
        $start_date = date('m/d/Y', strtotime($dates[0]));
        $end_date = date('m/d/Y', strtotime($dates[1]));
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(d.start, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->or_where("STR_TO_DATE(d.end, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->where("STR_TO_DATE(d.end, '%m/%d/%Y') <= STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->group_end();
    }
    if ($emp_name !== 'Any') {
        $trimmed_emp_name = trim($emp_name); 
        $this->db->like("TRIM(CONCAT(c.first_name, ' ', c.last_name))", $trimmed_emp_name);
    }
    $query = $this->db->get();
    return $query->result_array();
}
public function other_tax_employer_report_search($emp_name=null,$date=null){
    $user_id = $this->session->userdata('user_id');
    $this->db->select('a.tax,a.tax_type,a.time_sheet_id,d.month,a.amount,c.first_name,c.last_name');
    $this->db->from('tax_history_employer a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->where('a.tax_type', 'other_working_tax');
    $this->db->where('a.created_by', $this->session->userdata('user_id'));
if ($date) {
        $dates = explode(' - ', $date);
        $start_date = date('m/d/Y', strtotime($dates[0]));
        $end_date = date('m/d/Y', strtotime($dates[1]));
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(d.start, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->or_where("STR_TO_DATE(d.end, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->where("STR_TO_DATE(d.end, '%m/%d/%Y') <= STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->group_end();
    }
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->like("TRIM(CONCAT(c.first_name, ' ', c.last_name))", $trimmed_emp_name);
    }
    $query = $this->db->get();
    return $query->result_array();
}
public function working_state_tax_report_search($tax_name = null, $emp_name = null, $date = null)
{
  $user_id = $this->session->userdata('user_id');
  $this->db->select('tax_history.*, c.*, d.*, tax, tax_type, time_sheet_id, month, amount, first_name, last_name');
  $this->db->from('tax_history'); 
  $this->db->join('employee_history c', 'c.id = tax_history.employee_id');
  $this->db->join('timesheet_info d', 'tax_history.time_sheet_id = d.timesheet_id');
  $this->db->where('tax_type', 'state_tax');
  $this->db->where('created_by', $user_id);
  $this->db->where('tax', $tax_name);
 $this->db->order_by('tax', 'desc');
  if ($date) {
    $dates = explode(' - ', $date);
    $start_date = date('m/d/Y', strtotime($dates[0]));
    $end_date = date('m/d/Y', strtotime($dates[1]));
    $this->db->group_start();
    $this->db->where("(d.start BETWEEN '$start_date' AND '$end_date')");
    $this->db->or_where("(d.end BETWEEN '$start_date' AND '$end_date')");
    $this->db->where("(d.end <= '$end_date')");
    $this->db->group_end();
  }
  if ($emp_name !== 'All') {
    $trimmed_emp_name = trim($emp_name);
    $this->db->like("TRIM(CONCAT(c.first_name, ' ', c.last_name))", $trimmed_emp_name);
  }
  $this->db->group_by('time_sheet_id');
  $query = $this->db->get();
  return $query->result_array();
}
public function bankdataDetails()
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('*');
    $this->db->from('bank_add');
    $this->db->where('created_by', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
   }
}
public function get_employeeTypedata()
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('*');
    $this->db->from('employee_type');
    $this->db->where('created_by', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
   }
}
public function get_data_pay_partner($d1=null,$empid,$timesheetid){
    $this->db->select('sum(extra_amount) as amount , job_title');
    $this->db->from('timesheet_info');
    $this->db->where('templ_name',$empid);
    $this->db->where('create_by', $this->session->userdata('user_id'));
  $this->db->where('month <=', date('Y-m-d'));
$this->db->where("STR_TO_DATE(SUBSTRING_INDEX(month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE);
  $this->db->group_by('job_title');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
        }
        public function get_data_pay_SalesCommission($d1=null,$empid,$timesheetid){
    $this->db->select('sum(extra_amount) as amount , job_title');
    $this->db->from('timesheet_info');
    $this->db->where('templ_name',$empid);
    $this->db->where('create_by', $this->session->userdata('user_id'));
  $this->db->where('month <=', date('Y-m-d'));
$this->db->where("STR_TO_DATE(SUBSTRING_INDEX(month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$d1', '%m/%d/%Y')", NULL, FALSE);
  $this->db->group_by('job_title');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
        }
    // Total Income Tax - Madhu
    public function getTotalIncomeTax($search, $date, $employee_name = 'All', $decodedId, $taxname)
    {
        if ($date) {
            $date_range = $this->parse_date_range($date);
            $this->db->where("d.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
        }
        if ($employee_name !== 'All' && $employee_name !== null) {
            $trimmed_emp_name = trim($employee_name);
            $this->db->group_start();
            $this->db->like("TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name))", $trimmed_emp_name);
            $this->db->or_like("TRIM(CONCAT_WS(' ', c.first_name, c.last_name))", $trimmed_emp_name);
            $this->db->group_end();
        }
    
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("d.timesheet_id", $search);
            $this->db->or_like("c.first_name", $search);
            $this->db->or_like("c.last_name", $search);
            $this->db->or_like("c.middle_name", $search);
            $this->db->or_like("c.employee_tax", $search);
            $this->db->like("d.month", $search);
            $this->db->like("d.cheque_date", $search);
            $this->db->group_end();
        }
        if ($taxname) {
            $this->db->where('a.tax', $taxname);
        }
    
        $this->db->where('a.tax_type', 'state_tax');
        $this->db->where('b.create_by', $decodedId);

        $this->db->select('COUNT(DISTINCT a.time_sheet_id) as count');
        $this->db->from('tax_history a');
        $this->db->join('employee_history c', 'c.id = a.employee_id');
        $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
        $this->db->join('info_payslip b', 'a.time_sheet_id = b.timesheet_id', 'left');
    
        $query = $this->db->get();
        if ($query === false) {
            return false;
        }
        $result = $query->row_array();
        return $result['count'] ?? 0;
    }

public function citydelete_tax($citytax = null, $city) {
    $this->db->where('tax', $city . '-' . $citytax);
    $this->db->where('created_by', $this->session->userdata('user_id'));
    $this->db->where('Type', 'City'); 
    $this->db->delete('state_and_tax');
    if ($citytax) {
        $sql = "UPDATE state_and_tax SET tax = REPLACE(REPLACE(tax, ?, ''), ',', ',') WHERE created_by=? AND state=? AND Type='City'";
        $query = $this->db->query($sql, array($citytax, $this->session->userdata('user_id'), $city));
    } else {
        $this->db->where('state', $city);
        $this->db->where('created_by', $this->session->userdata('user_id'));
        $this->db->where('Type', 'City'); 
        $this->db->delete('state_and_tax');
    }
    $sql1 = "UPDATE state_and_tax SET tax = TRIM(BOTH ',' FROM tax) WHERE Type='City'";
    $query1 = $this->db->query($sql1);
    $sql3 = "UPDATE state_and_tax SET tax = REPLACE(REPLACE(tax, ',,', ','), ',', ',') WHERE created_by=? AND state=? AND Type='City'";
    $query3 = $this->db->query($sql3, array($this->session->userdata('user_id'), $city));
    return true;
}
public function federal_tax_report($emp_name = null, $date = null, $status = null)
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('SUBSTRING_INDEX(ti.start, " - ", 1) AS start');
    $this->db->select('SUBSTRING_INDEX(ti.end, " - ", -1) AS end');
    $this->db->select('ti.month');
       $this->db->select('c.*');
    $this->db->select('b.f_tax AS f_ftax');
    $this->db->select('b.m_tax AS m_mtax');
    $this->db->select('b.s_tax AS s_stax');
    $this->db->select('b.u_tax AS u_utax');
    $this->db->select('ti.timesheet_id AS timesheet');
    $this->db->from('timesheet_info ti');
    $this->db->join('info_payslip b', 'b.timesheet_id = ti.timesheet_id', 'left');
    $this->db->join('employee_history c', 'c.id = b.templ_name', 'inner');
    if ($date) {
        $dates = explode(' - ', $date);
        $start_date = date('m/d/Y', strtotime($dates[0]));
        $end_date = date('m/d/Y', strtotime($dates[1]));
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(ti.start, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->or_where("STR_TO_DATE(ti.end, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->or_where("STR_TO_DATE(ti.start, '%m/%d/%Y') <= STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE(ti.end, '%m/%d/%Y') >= STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->group_end();
    }
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('ti.create_by', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
public function federal_tax()
{
    $user_id = $this->session->userdata('user_id');
$this->db->select('a.timesheet_id, b.f_tax, c.first_name, c.middle_name, c.last_name, c.employee_tax, a.month');
$this->db->from('timesheet_info a');
$this->db->join('info_payslip b', 'b.templ_name = a.templ_name AND b.timesheet_id = a.timesheet_id');
$this->db->join('employee_history c', 'c.id = b.templ_name');
$this->db->where('a.create_by',  $user_id);
$this->db->group_by('a.timesheet_id, b.f_tax, c.first_name, c.middle_name, c.last_name, c.employee_tax, a.month');
$query = $this->db->get();
   if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
public function social_tax_report($emp_name = null, $tax_choice = null, $selectState = null, $taxType = null, $date = null)
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('d.time_sheet_id,c.first_name,c.middle_name,c.last_name, d.amount');
$this->db->from('timesheet_info a');
$this->db->join('info_payslip b', 'b.templ_name = a.templ_name');
$this->db->join('employee_history c', 'c.id = b.templ_name');
$this->db->join('tax_history_employer d', 'd.time_sheet_id = a.timesheet_id', 'left');
  if ($date) {
  $dates = explode(' - ', $date);
$this->db->where("(a.start BETWEEN '$dates[0]' AND '$dates[1]' OR a.end BETWEEN '$dates[0]' AND '$dates[1]' AND a.end <= '$dates[1]')");
}
  if ($tax_choice =='living_state_tax') {
 $this->db->like("TRIM(d.tax_type)", 'living_state_tax', 'both', false);
}
if ($selectState !== '') {
        $trimmed_selectState = trim($selectState);
        $this->db->like("TRIM(CONCAT(d.code))", $trimmed_selectState);
    }
  if ($taxType !== '') {
        $trimmed_taxType = trim($taxType);
        $this->db->like("TRIM(d.tax)", $trimmed_taxType, 'both', false);
    }
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('a.create_by', $user_id);
$this->db->group_by('c.first_name,c.middle_name,c.last_name, d.time_sheet_id, d.amount');
$query = $this->db->get();
$resultRows = [];
foreach ($query->result_array() as $row) {
    $templ_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
    if (isset($resultRows[$templ_name])) {
        $resultRows[$templ_name]['totalAmount'] += $row['amount'];
    } else {
        $resultRows[$templ_name] = [
            'templ_name' => $templ_name,
            'totalAmount' => $row['amount']
        ];
    }
}
$resultRows = array_values($resultRows);
return $resultRows;
}
public function social_tax_employee_report($emp_name = null, $tax_choice = null, $selectState = null, $taxType = null, $date = null)
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('d.time_sheet_id, c.first_name,c.middle_name,c.last_name, d.amount');
$this->db->from('timesheet_info a');
$this->db->join('info_payslip b', 'b.templ_name = a.templ_name');
$this->db->join('employee_history c', 'c.id = b.templ_name');
$this->db->join('tax_history  d', 'd.time_sheet_id = a.timesheet_id', 'left');
if ($date) {
        $dates = explode(' - ', $date);
$this->db->where("(a.start BETWEEN '$dates[0]' AND '$dates[1]' OR a.end BETWEEN '$dates[0]' AND '$dates[1]' AND a.end <= '$dates[1]')");
}
  if ($tax_choice =='living_state_tax') {
 $this->db->like("TRIM(d.tax_type)", 'living_state_tax', 'both', false);
}
  if ($selectState !== '') {
        $trimmed_selectState = trim($selectState);
        $this->db->like("TRIM(CONCAT(d.code))", $trimmed_selectState);
    }
  if ($taxType !== '') {
        $trimmed_taxType = trim($taxType);
        $this->db->like("TRIM(d.tax)", $trimmed_taxType, 'both', false);
    }
    if ($emp_name !== 'Any') {
        $trimmed_emp_name = trim($emp_name); 
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('a.create_by', $user_id);
$this->db->group_by('c.first_name,c.middle_name,c.last_name, d.time_sheet_id, d.amount');
$query = $this->db->get();
$resultRows = [];
foreach ($query->result_array() as $row) {
    $templ_name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
    if (isset($resultRows[$templ_name])) {
        $resultRows[$templ_name]['totalAmountEmployee'] += $row['amount'];
    } else {
        $resultRows[$templ_name] = [
            'templ_name' => $templ_name,
            'totalAmountEmployee' => $row['amount']
        ];
    }
}
$resultRows = array_values($resultRows);
return $resultRows;
}


public function employe($emp_name = null, $date = null)
{
    $user_id = $this->session->userdata('user_id');
    $subquery = "(SELECT DISTINCT b.timesheet_id
                 FROM info_payslip b
                 JOIN timesheet_info a ON a.timesheet_id = b.timesheet_id
                 WHERE b.create_by = '$user_id'";
    if ($date) {
        $dates = explode(' - ', $date);
        $start_date = date('Y-m-d', strtotime($dates[0]));
        $end_date = date('Y-m-d', strtotime($dates[1]));
        $subquery .= " AND (STR_TO_DATE(a.start, '%m/%d/%Y') BETWEEN '$start_date' AND '$end_date'
                        OR STR_TO_DATE(a.end, '%m/%d/%Y') BETWEEN '$start_date' AND '$end_date'
                        OR STR_TO_DATE(a.start, '%m/%d/%Y') <= '$start_date' AND STR_TO_DATE(a.end, '%m/%d/%Y') >= '$end_date')";
    }
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $subquery .= " AND (TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name)) LIKE '%$trimmed_emp_name%'
                        OR TRIM(CONCAT_WS(' ', c.first_name, c.last_name)) LIKE '%$trimmed_emp_name%')";
    }
    $subquery .= ")";
    $this->db->select('a.month, b.timesheet_id, c.employee_tax, b.templ_name, c.first_name, c.middle_name, c.last_name,
        b.f_tax AS f_ftax, b.m_tax AS m_mtax, b.s_tax AS s_stax, b.u_tax AS u_utax');
    $this->db->from('info_payslip b');
    $this->db->join('employee_history c', 'c.id = b.templ_name');
    $this->db->join('timesheet_info a', 'a.timesheet_id = b.timesheet_id');
    $this->db->where("b.timesheet_id IN $subquery", NULL, FALSE);
    $this->db->order_by('b.timesheet_id', 'desc');
    $query = $this->db->get();
    return $query->result_array();
}
                                          //===============================Reports===============================//
public function parse_date_range($date = null)
{ 
    if ($date) {
         $dates = explode(' to ', $date);
         $start_date = DateTime::createFromFormat('m-d-Y', trim($dates[0]))->format('Y-m-d');
         $end_date = DateTime::createFromFormat('m-d-Y', trim($dates[1]))->format('Y-m-d');
         return array(
            'start_date' => date('m/d/Y', strtotime($start_date)),
            'end_date'   => date('m/d/Y', strtotime($end_date))
        );
    }
    return null;
}
// Federal Income tax Index -  Report                         
public function employr($emp_name = null, $date = null, $id)
{
    $this->db->distinct();
    $this->db->select('a.id,b.f_tax AS f_ftax, b.m_tax AS m_mtax, b.s_tax AS s_stax, b.u_tax AS u_utax, c.employee_tax, b.time_sheet_id as timesheet, b.created_by, c.first_name, c.middle_name, c.last_name, a.end');
    $this->db->from('tax_history_employer b');
    $this->db->join('employee_history c', 'c.id = b.employee_id');
    $this->db->join('timesheet_info a', 'a.timesheet_id = b.time_sheet_id');
    $this->db->where('b.created_by', $id);
    $this->db->where('b.tax_type', 'state_tax');
    $this->db->where('b.tax_type !=', 'living_state_tax');
    $this->db->group_start();
    $this->db->like('b.tax', 'Unemployment');
    $this->db->or_like('b.tax', 'unemployment');
    $this->db->group_end();
    $this->db->group_by('b.f_tax, b.m_tax, b.s_tax, b.u_tax, b.time_sheet_id, b.created_by, c.first_name, c.middle_name, c.last_name, c.employee_tax, a.end, a.id');
    if ($emp_name !== 'All' && $emp_name !== null) {
        $trimmed_emp_name = trim($emp_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', c.first_name, c.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    if ($date) {
        $date_range = $this->parse_date_range($date);
        $this->db->group_start();
        $this->db->where("(a.end) BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
        $this->db->group_end();
    }

    $this->db->order_by('a.id', 'desc');
    $query = $this->db->get();
    return $query->result_array();
}


// Paginated Federal income tax - Report
public function getPaginatedfederalincometax($limit, $offset, $orderField, $orderDirection, $search, $date = null, $emp_name = 'All', $decodedId)
{ 
    $subquery = "(SELECT DISTINCT b.timesheet_id FROM info_payslip b JOIN timesheet_info a ON a.timesheet_id = b.timesheet_id WHERE b.create_by = '$decodedId'";

    if ($date) {
        $date_range = $this->parse_date_range($date);
        $subquery .= " AND (a.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}')";
    }

    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $subquery .= " AND (TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name)) LIKE '%$trimmed_emp_name%' OR TRIM(CONCAT_WS(' ', c.first_name, c.last_name)) LIKE '%$trimmed_emp_name%')";
    }
    $subquery .= ")";

    $this->db->select('a.month, a.id, b.timesheet_id as timesheet, c.employee_tax, b.templ_name, a.cheque_date, c.first_name, c.middle_name, c.last_name, b.f_tax AS f_tax, b.m_tax AS m_tax, b.s_tax AS s_tax, b.u_tax AS u_tax, te.u_tax as unemployment');
    $this->db->from('info_payslip b');
    $this->db->join('employee_history c', 'c.id = b.templ_name');
    $this->db->join('timesheet_info a', 'a.timesheet_id = b.timesheet_id');
    $this->db->join('tax_history_employer te', 'te.time_sheet_id = a.timesheet_id');
    $this->db->where("b.timesheet_id IN $subquery", NULL, FALSE);

    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("b.timesheet_id", $search);
        $this->db->or_like("c.first_name", $search);
        $this->db->or_like("c.last_name", $search);
        $this->db->or_like("c.middle_name", $search);
        $this->db->or_like("c.employee_tax", $search);
        $this->db->or_like("a.month", $search);
        $this->db->or_like("a.cheque_date", $search);
        $this->db->or_like("b.f_tax", $search);
        $this->db->or_like("b.s_tax", $search);
        $this->db->or_like("b.m_tax", $search);
        $this->db->or_like("te.u_tax", $search);
        $this->db->group_end();
    }

    $this->db->where("b.create_by", $decodedId);
    $this->db->limit($limit, $offset);
    $this->db->order_by('a.id', $orderDirection);

    $this->db->group_by("b.timesheet_id, a.month, a.id, c.first_name, c.middle_name, c.last_name, c.employee_tax, b.f_tax, b.m_tax, b.s_tax, b.u_tax, a.cheque_date, b.templ_name");

    $query = $this->db->get();
 if ($query === false) {
        return false;
    }
    return $query->result_array();
}

// Paginated Federal income tax - Report
    public function getTotalfederalincometax($search, $date, $emp_name = 'All', $decodedId)
    {
        $subquery = "(SELECT DISTINCT b.timesheet_id FROM info_payslip b JOIN timesheet_info a ON a.timesheet_id = b.timesheet_id WHERE b.create_by = '$decodedId'";
        if ($date) {
    $date_range = $this->parse_date_range($date);
    $subquery .= " AND (a.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}')";
            }    
         if ($emp_name !== 'All') {
            $trimmed_emp_name = trim($emp_name);
            $subquery .= " AND (TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name)) LIKE '%$trimmed_emp_name%' OR TRIM(CONCAT_WS(' ', c.first_name, c.last_name)) LIKE '%$trimmed_emp_name%')";
        }
        $subquery .= ")";
        $this->db->select('a.month, a.id');
        $this->db->from('info_payslip b');
        $this->db->join('employee_history c', 'c.id = b.templ_name');
        $this->db->join('timesheet_info a', 'a.timesheet_id = b.timesheet_id');
        $this->db->where("b.timesheet_id IN $subquery", NULL, FALSE);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("b.timesheet_id", $search);
            $this->db->or_like("c.first_name", $search);
            $this->db->or_like("c.last_name", $search);
            $this->db->or_like("c.middle_name", $search);
            $this->db->or_like("c.employee_tax", $search);
            $this->db->or_like("a.month", $search);
            $this->db->or_like("a.cheque_date", $search);
            $this->db->or_like("b.f_tax", $search);
            $this->db->or_like("b.s_tax", $search);
            $this->db->or_like("b.m_tax", $search);
            $this->db->or_like("b.u_tax", $search);
            $this->db->group_end();
        }
        $this->db->where("b.create_by", $decodedId);
        $this->db->order_by('a.id', 'desc');
        $query = $this->db->get();
        if ($query === false) {
            return false;
        }
        return $query->num_rows();
    }
    //Federal Overall Summary - Madhu
public function getPaginatedSocialTaxSummary($limit, $offset, $orderField, $orderDirection, $search, $date = null, $emp_name = 'All', $decodedId)
{
    $subquery = "(SELECT DISTINCT b.timesheet_id FROM info_payslip b JOIN timesheet_info a ON a.timesheet_id = b.timesheet_id WHERE b.create_by = '$decodedId'";
   if ($date) {
    $date_range = $this->parse_date_range($date);
    $subquery .= " AND (a.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}')";
}
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $subquery .= " AND (TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name)) LIKE '%$trimmed_emp_name%' OR TRIM(CONCAT_WS(' ', c.first_name, c.last_name)) LIKE '%$trimmed_emp_name%')";
    }
    $subquery .= ")";
    $this->db->select('b.timesheet_id, b.f_tax AS f_ftax, b.m_tax AS m_mtax, b.s_tax AS s_stax, b.u_tax AS u_utax, b.templ_name, c.*, a.* , te.u_tax as unemployment');
    $this->db->from('info_payslip b');
    $this->db->join('employee_history c', 'c.id = b.templ_name');
    $this->db->join('timesheet_info a', 'a.timesheet_id = b.timesheet_id');
    $this->db->join('tax_history_employer te', 'te.time_sheet_id = a.timesheet_id');
    $this->db->where("b.timesheet_id IN $subquery", NULL, FALSE);
    $this->db->where("b.create_by", $decodedId);
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->or_like("c.first_name", $search);
        $this->db->or_like("c.last_name", $search);
        $this->db->or_like("c.middle_name", $search);
        $this->db->or_like("c.employee_tax", $search);
        $this->db->or_like("b.total_amount", $search);
        $this->db->or_like("b.net_amount", $search);
        $this->db->or_like("b.f_tax", $search);
        $this->db->or_like("b.s_tax", $search);
        $this->db->or_like("b.m_tax", $search);
        $this->db->or_like("te.u_tax", $search);
        $this->db->group_end();
    }
    $this->db->limit($limit, $offset);
    $this->db->order_by('a.id', $orderDirection);
    $query = $this->db->get();
    if ($query === false) {
        return false;
    }
    $result = $query->result_array();
    if (count($result) > 0) {
        $sums = array();
        foreach ($result as $row) {
            $employee_id = $row['templ_name'];
            if (!isset($sums[$employee_id])) {
                $sums[$employee_id] = array(
                    'employee_id' => $employee_id,
                    'first_name' => $row['first_name'],
                    'middle_name' => $row['middle_name'],
                    'last_name' => $row['last_name'],
                    'employee_tax' => $row['employee_tax'],
                    'total_s_tax' => 0,
                    'total_m_tax' => 0,
                    'total_u_tax' => 0,
                    'total_f_tax' => 0
                );
            }
            $sums[$employee_id]['total_s_tax'] += $row['s_stax'];
            $sums[$employee_id]['total_m_tax'] += $row['m_mtax'];
            $sums[$employee_id]['total_u_tax'] += $row['u_utax'];
            $sums[$employee_id]['total_f_tax'] += $row['f_ftax'];
        }
        return array_values($sums);
    }
    return false;
}
// Federal Overall Summary - Report
public function social_tax_sumary($date = null, $emp_name = 'All')
{  $user_id = $this->session->userdata('user_id');
 $this->db->select('b.*, c.*, b.timesheet_id, d.*');
    $this->db->from('info_payslip b');
    $this->db->join('employee_history c', 'c.id = b.templ_name');
    $this->db->join('timesheet_info d', 'd.timesheet_id = b.timesheet_id');
    $this->db->where('b.create_by', $user_id);
        $this->db->where('d.uneditable', 1);
    $this->db->group_by('d.timesheet_id');
    if ($date) {
    $date_range = $this->parse_date_range($date);
    $this->db->group_start();
$this->db->where("(d.end) BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
$this->db->group_end();
}
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $subquery .= " AND (TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name)) LIKE '%$trimmed_emp_name%' OR TRIM(CONCAT_WS(' ', c.first_name, c.last_name)) LIKE '%$trimmed_emp_name%')";
    }
     $this->db->order_by('d.id', 'desc');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        $result = $query->result_array();
        $sums = array();
        foreach ($result as $row) {
            $employee_id = $row['templ_name'];
            if (!isset($sums[$employee_id])) {
                $sums[$employee_id] = array(
                    'employee_id' => $employee_id,
                    'first_name' => $row['first_name'],
                    'middle_name' => $row['middle_name'],
                    'last_name' => $row['last_name'],
                    's_stax_sum' => 0,
                    'm_mtax_sum' => 0,
                    'u_utax_sum' => 0,
                    'f_ftax_sum' => 0
                );
            }
            $sums[$employee_id]['s_stax_sum'] += $row['s_tax'];
            $sums[$employee_id]['m_mtax_sum'] += $row['m_tax'];
            $sums[$employee_id]['u_utax_sum'] += $row['u_tax'];
            $sums[$employee_id]['f_ftax_sum'] += $row['f_tax'];
        }
        return array_values($sums);
    }
    return false;
}
// Federal Overall Summary - Report
public function social_tax_employer($id, $date = '', $emp_name = null)
{

    
    $this->db->select('b.time_sheet_id, c.first_name, c.middle_name, c.last_name, b.employee_id, b.s_tax, b.m_tax, b.u_tax, b.f_tax');
    $this->db->from('tax_history_employer b');
    $this->db->join('employee_history c', 'c.id = b.employee_id');
    $this->db->join('timesheet_info ti', 'ti.timesheet_id = b.time_sheet_id');
    $this->db->where('b.created_by', $id);

   
    if ($date) {
        $date_range = $this->parse_date_range($date);
        $this->db->where('ti.end >=', $date_range['start_date']);
        $this->db->where('ti.end <=', $date_range['end_date']);
    }


    if ($emp_name !== 'All' && $emp_name !== '') {
        $trimmed_emp_name = trim($emp_name);
        
       
        $this->db->group_start(); 
        $this->db->like("CONCAT_WS(' ', TRIM(c.first_name), TRIM(c.middle_name), TRIM(c.last_name))", $trimmed_emp_name);
        $this->db->or_like("CONCAT_WS(' ', TRIM(c.first_name), TRIM(c.last_name))", $trimmed_emp_name);
        $this->db->group_end(); 
    }

  
    $this->db->order_by('ti.id', 'desc');
    
   
    $query = $this->db->get();


   
    if ($query->num_rows() > 0) {
        $result = $query->result_array();
        $sums = array(); 

foreach ($result as $row) {
    $employee_id = $row['employee_id'];
    $timesheet_id = $row['time_sheet_id'];

  
    if (!isset($sums[$employee_id])) {
        $sums[$employee_id] = array(
            'employee_id' => $employee_id,
            'first_name' => $row['first_name'],
            'middle_name' => $row['middle_name'],
            'last_name' => $row['last_name'],
            's_stax_sum_er' => 0,
            'm_mtax_sum_er' => 0,
            'u_utax_sum_er' => 0,
            'f_ftax_sum_er' => 0,
            'processed_timesheets' => array() 
        );
    }


    if (isset($sums[$employee_id]['processed_timesheets'][$timesheet_id])) {
      
        if ($row['u_tax'] != 0 && !$sums[$employee_id]['processed_timesheets'][$timesheet_id]['u_tax_processed']) {
            $sums[$employee_id]['u_utax_sum_er'] += $row['u_tax'];
            $sums[$employee_id]['processed_timesheets'][$timesheet_id]['u_tax_processed'] = true;
        }
        continue;
    }

   
    $sums[$employee_id]['s_stax_sum_er'] += $row['s_tax'];
    $sums[$employee_id]['m_mtax_sum_er'] += $row['m_tax'];
    $sums[$employee_id]['f_ftax_sum_er'] += $row['f_tax'];

   
    if ($row['u_tax'] != 0) {
        $sums[$employee_id]['u_utax_sum_er'] += $row['u_tax'];
    }

   
    $sums[$employee_id]['processed_timesheets'][$timesheet_id] = [
        'u_tax_processed' => ($row['u_tax'] != 0) 
    ];
}





    
        return array_values($sums);
    }


    return false;
}





// State Overall Tax Summary - Report - Madhu
public function state_summary_employer($id,$emp_name = null, $tax_choice = null, $selectState = null, $date = null,$tax_type=null)
{
   $this->db->select('DISTINCT a.timesheet_id, (b.total_amount) as gross , (b.net_amount) as net,a.cheque_date, d.code, c.id, c.first_name, c.middle_name, c.last_name, d.tax_type, d.tax, (d.amount) as total_amount', false);
    $this->db->from('timesheet_info a');
    $this->db->join('info_payslip b', 'b.timesheet_id = a.timesheet_id');
    $this->db->join('employee_history c', 'c.id = b.templ_name');
    $this->db->join('tax_history d', 'd.time_sheet_id = a.timesheet_id', 'left');
     if ($date) {
    $date_range = $this->parse_date_range($date);
    $this->db->where('a.end >=', $date_range['start_date']);
$this->db->where('a.end <=', $date_range['end_date']);
}
    if ($tax_choice == 'All') {
        $this->db->where("(TRIM(d.tax_type) = 'state_tax' OR TRIM(d.tax_type) = 'living_state_tax')");
    } elseif (trim($tax_choice) == 'state_tax') {
        $this->db->where("TRIM(d.tax_type)", 'state_tax');
    } elseif (trim($tax_choice) == 'living_state_tax') {
        $this->db->where("TRIM(d.tax_type)", 'living_state_tax');
    }
    if ($selectState !== '') {
        $trimmed_selectState = trim($selectState);
        $this->db->where("TRIM(d.code)", $trimmed_selectState);
    }
     if ($tax_type !== '') {
        $trimmed_taxType = trim($tax_type);
        $this->db->like("TRIM(d.tax)", $trimmed_taxType, 'none');
    }
       if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('a.create_by', $id);
    $this->db->group_by('b.net_amount,a.cheque_date,b.total_amount,a.timesheet_id,d.code, c.id, c.first_name, c.middle_name, c.last_name, d.tax_type, d.tax,d.amount');
    $query = $this->db->get();
    $resultRows = $query->result_array();
    return $resultRows;
}

public function so_tax_report_employee($employee_name = null, $date = null, $status = null)
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('c.id,c.first_name,(b.total_amount) as gross,(b.net_amount) as net, c.middle_name, c.last_name, c.employee_tax, ti.cheque_date');
    $this->db->select('(b.f_tax) AS fftax');
    $this->db->select('(b.m_tax) AS mmtax');
    $this->db->select('(b.s_tax) AS sstax');
    $this->db->select('(b.u_tax) AS uutax');
    $this->db->from('timesheet_info ti');
    $this->db->join('info_payslip b', 'b.timesheet_id = ti.timesheet_id', 'left');
    $this->db->join('employee_history c', 'c.id = b.templ_name', 'inner');
  if ($date) {
     $date_range = $this->parse_date_range($date);
       $this->db->where('ti.end >=', $date_range['start_date']);
        $this->db->where('ti.end <=', $date_range['end_date']);
}
   if ($employee_name !== 'All') {
        $trimmed_emp_name = trim($employee_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('ti.create_by', $user_id);
    $this->db->where('ti.uneditable', '1');
    $this->db->order_by('c.id', 'DESC');
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
        $resultRows = $query->result_array();
        $employeeSummary = [];
        foreach ($resultRows as $row) {
            $employeeId = $row['id'];
            $gross = $row['gross'];
            $net = $row['net'];
            if (!isset($employeeSummary[$employeeId])) {
                $employeeSummary[$employeeId] = [
                    'id' => $employeeId,
                    'first_name' => $row['first_name'],
                    'middle_name' => $row['middle_name'],
                    'last_name' => $row['last_name'],
                    'employee_tax' => $row['employee_tax'],
                    'cheque_date' => $row['cheque_date'], 
                    'gross' => 0,
                    'net' => 0,
                    'fftax' => 0,
                    'mmtax' => 0,
                    'sstax' => 0,
                    'uutax' => 0,
                ];
            }
            $employeeSummary[$employeeId]['gross'] += $gross;
            $employeeSummary[$employeeId]['net'] += $net;
            $employeeSummary[$employeeId]['fftax'] += $row['fftax'];
            $employeeSummary[$employeeId]['mmtax'] += $row['mmtax'];
            $employeeSummary[$employeeId]['sstax'] += $row['sstax'];
            $employeeSummary[$employeeId]['uutax'] += $row['uutax'];
        }
        return array_values($employeeSummary);
    }
    return false;
}
public function so_tax_report_employer($emp_name = null, $date = null, $status = null)
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('c.first_name, c.middle_name, c.last_name ,c.id, c.employee_tax,ti.cheque_date,ti.timesheet_id');
    $this->db->select('(b.f_tax) AS fftax');
    $this->db->select('(b.m_tax) AS mmtax');
    $this->db->select('(b.s_tax) AS sstax');
    $this->db->select('(b.u_tax) AS uutax');
    $this->db->from('tax_history_employer b');
    $this->db->join('timesheet_info ti', 'b.time_sheet_id = ti.timesheet_id', 'left');
    $this->db->join('employee_history c', 'c.id = b.employee_id', 'inner');
 if ($date) {
     $date_range = $this->parse_date_range($date);
       $this->db->where('ti.end >=', $date_range['start_date']);
        $this->db->where('ti.end <=', $date_range['end_date']);
}
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('ti.uneditable', '1');
    $this->db->where('ti.create_by', $user_id);
     $this->db->order_by('c.id', 'DESC');
    $this->db->group_by('c.id,c.first_name, c.middle_name, c.last_name, c.employee_tax,ti.start,ti.end,b.f_tax,b.m_tax,b.s_tax,b.u_tax,ti.cheque_date');
     $query = $this->db->get();
  
     if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
// Total Federal Overall Tax Summary - Report - Madhu
public function getSocialOveralltax($search, $date, $emp_name = 'All', $decodedId)
{
    $subquery = "(SELECT DISTINCT b.timesheet_id FROM info_payslip b JOIN timesheet_info a ON a.timesheet_id = b.timesheet_id WHERE b.create_by = '$decodedId'";
     if ($date) {
     $date_range = $this->parse_date_range($date);
     $subquery .= " AND (a.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}')";
}
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $subquery .= " AND (TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name)) LIKE '%$trimmed_emp_name%' OR TRIM(CONCAT_WS(' ', c.first_name, c.last_name)) LIKE '%$trimmed_emp_name%')";
    }
    $subquery .= ")";
    $this->db->select('first_name, middle_name, last_name');
    $this->db->from('employee_history');
    $this->db->where("create_by", $decodedId);
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->or_like("first_name", $search);
        $this->db->or_like("last_name", $search);
        $this->db->or_like("middle_name", $search);
        $this->db->or_like("employee_tax", $search);
        $this->db->group_end();
    }
    $query = $this->db->get();
    if ($query === false) {
        return false;
    }
    return $query->num_rows();
}
// State Overall Tax Summary - Report - Madhu
public function state_summary_employee($id,$emp_name = null, $tax_choice = null, $selectState = null, $date = null,$tax_type=null)
{
    $this->db->select('DISTINCT a.timesheet_id, d.code, c.id,(b.total_amount) as gross ,b.net_amount as net, c.first_name, c.middle_name, c.last_name, d.tax_type, d.tax, (d.amount) as total_amount', false);
    $this->db->from('timesheet_info a');
    $this->db->join('info_payslip b', 'b.templ_name = a.templ_name');
    $this->db->join('employee_history c', 'c.id = b.templ_name');
    $this->db->join('tax_history_employer d', 'd.time_sheet_id = a.timesheet_id', 'left');
       if ($date) {
     $date_range = $this->parse_date_range($date);
       $this->db->where('a.end >=', $date_range['start_date']);
        $this->db->where('a.end <=', $date_range['end_date']);
}
    if ($tax_choice == 'All') {
        $this->db->where("(TRIM(d.tax_type) = 'state_tax' OR TRIM(d.tax_type) = 'living_state_tax')");
    } elseif ($tax_choice == 'state_tax') {
        $this->db->where("TRIM(d.tax_type)", 'state_tax');
    } elseif ($tax_choice == 'living_state_tax') {
        $this->db->where("TRIM(d.tax_type)", 'living_state_tax');
    }
    if ($selectState !== '') {
        $trimmed_selectState = trim($selectState);
        $this->db->where("TRIM(d.code)", $trimmed_selectState);
    }
     if ($tax_type !== '') {
        $trimmed_taxType = trim($tax_type);
        $this->db->like("TRIM(d.tax)", $trimmed_taxType, 'none');
    }
      if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('a.create_by', $id);
    $this->db->group_by('a.timesheet_id, d.code, c.id, c.first_name, c.middle_name, c.last_name, d.tax_type, d.tax,d.amount');
      $this->db->order_by('a.id', 'DESC');
    $query = $this->db->get();
    $resultRows = $query->result_array();
    return $resultRows;
}
// State Tax Report - Madhu
public function statetaxreport($id,$employee_name=null,$url,$date=null)
{
    $this->db->select('a.tax,a.tax_type,a.time_sheet_id,d.month,a.amount,a.weekly,a.biweekly,a.monthly,c.first_name,c.last_name,c.middle_name');
    $this->db->from('tax_history a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->where('a.tax_type', 'state_tax'); $this->db->order_by('a.tax', 'desc');
     if ($date) {
       $date_range = $this->parse_date_range($date);
         $this->db->where("d.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
}
  if ($employee_name !== 'All' && $employee_name !== null) {
        $trimmed_emp_name = trim($employee_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', c.first_name, c.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    $this->db->where('a.created_by', $id);
    $this->db->where('a.tax', $url);
    $query = $this->db->get();
    return $query->result_array();
}
// State Tax Report
public function living_state_tax_report($employee_name=null,$url, $date = null,$id)
{
    $this->db->select('a.tax, a.tax_type, a.time_sheet_id,d.cheque_date, d.month, a.amount, c.first_name, c.last_name,c.employee_tax,c.working_state_tax,c.living_state_tax');
    $this->db->from('tax_history a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->where('a.tax_type', 'living_state_tax');
    $this->db->order_by('a.tax', $orderDirection);
   if ($date) {
        $date_range = $this->parse_date_range($date);
        $this->db->where("d.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
    }
   if ($employee_name !== 'All') {
        $trimmed_emp_name = trim($employee_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('a.created_by', $id);
    $this->db->where('a.tax', $url);
    $query = $this->db->get();
   
    return $query->result_array();
}
// Individual State_tax Report
public function employer_state_tax_report($employee_name=null,$url,$date=null,$id )
{
    if(trim($url) != 'Income tax'){
    
    $this->db->select('a.tax,a.tax_type,a.time_sheet_id,d.month,a.amount,c.first_name,c.last_name');
    $this->db->from('tax_history_employer a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->where('a.tax_type', 'state_tax');$this->db->order_by('a.tax', 'ASC');
     if ($date) {
                $date_range = $this->parse_date_range($date);
                $this->db->where("d.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
            }
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('a.created_by', $id);
    $this->db->where('a.tax', $url);
    $query = $this->db->get();
 
    return $query->result_array();
    }
}
// Individual State_tax Report
public function employer_living_state_tax_report($employee_name=null,$url,$date=null,$id)
{
    if(trim($url) != 'Income tax'){
    $user_id = $this->session->userdata('user_id');
    $this->db->select('a.tax,a.tax_type,a.time_sheet_id,d.cheque_date,d.month,a.amount,c.first_name,c.last_name,c.employee_tax,c.working_state_tax,c.living_state_tax');
    $this->db->from('tax_history_employer a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->where('a.tax_type', 'living_state_tax');$this->db->order_by('a.tax', 'ASC');
  if ($date) {
    $date_range = $this->parse_date_range($date);
    $this->db->where("d.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
}
        if ($employee_name !== 'All') {
        $trimmed_emp_name = trim($employee_name);
        $this->db->like("CONCAT(TRIM(c.first_name), ' ', TRIM(c.middle_name), ' ', TRIM(c.last_name))", $trimmed_emp_name, 'both', false);
    }
    $this->db->where('a.created_by', $id);
    $this->db->where('a.tax', $url);
    $query = $this->db->get();
    return $query->result_array();
    }
}
public function state_tax_report($limit, $start, $orderField, $orderDirection, $search, $taxname, $date, $employee_name='All', $decodedId)
{
    if ($date) {
        $date_range = $this->parse_date_range($date);
        $this->db->where("d.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
    }
    if ($employee_name !== 'All' && $employee_name !== null) {
        $trimmed_emp_name = trim($employee_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', c.first_name, c.middle_name, c.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', c.first_name, c.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    $this->db->select('a.tax, a.tax_type, a.time_sheet_id, d.month, d.cheque_date, a.amount, a.weekly, a.biweekly, a.monthly, c.*, te.u_tax');
    $this->db->from('tax_history a');
    $this->db->join('employee_history c', 'c.id = a.employee_id');
    $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
    $this->db->join('info_payslip b', 'a.time_sheet_id = b.timesheet_id', 'left');
    $this->db->join('tax_history_employer te', 'te.time_sheet_id = d.timesheet_id');
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("d.timesheet_id", $search);
        $this->db->or_like("c.first_name", $search);
        $this->db->or_like("c.last_name", $search);
        $this->db->or_like("c.middle_name", $search);
        $this->db->or_like("c.employee_tax", $search);
        $this->db->or_like("d.month", $search);
        $this->db->or_like("d.cheque_date", $search);
        $this->db->or_like("a.amount", $search);
        $this->db->or_like("te.amount", $search);
        $this->db->group_end();
    }
    if ($taxname) {
        $this->db->where('a.tax', $taxname);
    }
    $this->db->where('a.tax_type', 'state_tax');
    $this->db->where('b.create_by', $decodedId);
    $this->db->distinct();
    $this->db->limit($limit, $start);
    $this->db->order_by('a.id', $orderDirection);
    $query = $this->db->get();
    if (!$query) {
        $error = $this->db->error();
        echo 'Query failed: ' . $error['message'];
        exit;
    }
    return $query->result_array();
}
                      //===============================Reports===============================//
                        //============================Forms===================================//
public function total_amountofthis_qt($quarter, $id)
{
    $this->db->select('SUM(c.total_amount) as OverallTotal');
    $this->db->from('timesheet_info a');
    $this->db->join('employee_history b', 'b.id = a.templ_name', 'left');
    $this->db->join('info_payslip c', 'c.timesheet_id = a.timesheet_id', 'left');
    $this->db->where("b.payroll_type NOT LIKE 'Sales Partner'");
    $this->db->where('a.quarter',$quarter);
    $this->db->where('a.create_by', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return false;
    }
}
public function info_for_wrf($id)
{
    $this->db->select('
        b.id, b.first_name, b.middle_name, b.last_name, b.social_security_number, 
        c.total_amount, a.ytd, a.extra_amount, a.sc_amount
    ');
    $this->db->from('timesheet_info a');
    $this->db->join('employee_history b', 'b.id = a.templ_name', 'left');
    $this->db->join('info_payslip c', 'c.timesheet_id = a.timesheet_id', 'left');
    $this->db->where('a.create_by', $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        $result = $query->result_array();
        $employee_data = [];

        foreach ($result as $row) {
            $employee_id = $row['id'];
            if (!isset($employee_data[$employee_id])) {
                $employee_data[$employee_id] = [
                    'id' => $row['id'],
                    'first_name' => $row['first_name'],
                    'middle_name' => $row['middle_name'],
                    'last_name' => $row['last_name'],
                    'social_security_number' => $row['social_security_number'],
                    'sum_ytd' => 0,
                    'sum_extra_amount' => 0,
                    'sc_amount' => $row['sc_amount'],
                    'total_amount' => $row['total_amount']
                ];
            }
            $employee_data[$employee_id]['sum_ytd'] += $row['ytd'];
            $employee_data[$employee_id]['sum_extra_amount'] += $row['extra_amount'];
        }
        foreach ($employee_data as $key => $data) {
            $employee_data[$key]['total_amount'] = $data['sum_ytd'] + $data['sum_extra_amount'];
        }
        return $employee_data;
    } else {
        return false;
    }
}


public function total_amt_wr30($id)
{
  $this->db->select('SUM(c.total_amount) AS OverallTotal, COUNT(*) AS count');
  $this->db->from('timesheet_info a');
  $this->db->join('employee_history b', 'b.id = a.templ_name', 'left');
  $this->db->join('info_payslip c', 'c.timesheet_id = a.timesheet_id', 'left');
  $this->db->where("b.payroll_type NOT LIKE 'Sales Partner'");
  $this->db->where('a.create_by', $id);
  $query = $this->db->get();
  if ($query->num_rows() > 0) {
    return $query->result_array();
  } else {
    return false;
  }
}

// Sum Employee Above 7000  - form 940
public function getAboveAmount($user_id)
{
    $this->db->select('SUM(total_amount) AS totalAmount, templ_name');
    $this->db->from('info_payslip');
    $this->db->where('total_amount >=', 7000);
    $this->db->where('create_by', $user_id);
    $this->db->group_by('templ_name');
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        $result = $query->result_array();
        
        $totalAboveAmount = 0;  
        foreach ($result as &$row) {
            if ($row['totalAmount'] > 7000) {
                $row['adjustedTotalAmount'] = $row['totalAmount'] - 7000;  
            } else {
                $row['adjustedTotalAmount'] = 0; 
            }

            $totalAboveAmount += $row['adjustedTotalAmount'];

            $row['aboveAmount'] = $totalAboveAmount;
        }

        return $totalAboveAmount;
    }
    
    return false;
}


// Sum Quater Wise Unemployment - form 940

public function sumQuaterwiseunemploymentamount($user_id)
{
    $this->db->select('SUM(b.u_tax) as unemploymentAmount, a.quarter');
    $this->db->from('timesheet_info a');
    $this->db->join('tax_history_employer b', 'b.time_sheet_id = a.timesheet_id', 'left');
    $this->db->where('a.create_by', $user_id);
    $this->db->group_by('a.quarter'); 
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        $result = $query->result_array();
        $quarterSums = [
            'Q1' => 0,
            'Q2' => 0,
            'Q3' => 0,
            'Q4' => 0
        ];

        foreach ($result as $row) {
            $quarterSums[$row['quarter']] = $row['unemploymentAmount'];
        }

        return $quarterSums;
    }

    return false;
}



public function f940_excess_emp($user_id)
{
    $this->db->select('SUM(total_amount) AS totalAmount');       
    $this->db->from('info_payslip');
    $this->db->where('total_amount >=', 7000);
    $this->db->where('create_by', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}

public function getQuarterlyMonthData($user_id,$quarter)
{
    $currentYear = date('Y');
    switch ($quarter) {
        case 'Q1':
            $months = [1, 2, 3]; 
            break;
        case 'Q2':
            $months = [4, 5, 6];
            break;
        case 'Q3':
            $months = [7, 8, 9]; 
            break;
        case 'Q4':
            $months = [10, 11, 12];
            break;
        default:
            return false; 
    }
    $results = [];
   foreach ($months as $month) {
        $startDate = str_pad($month, 2, '0', STR_PAD_LEFT) . '/01/' . $currentYear; 
        $endDate = str_pad($month, 2, '0', STR_PAD_LEFT) . '/' . date('t', strtotime($currentYear . '/' . str_pad($month, 2, '0', STR_PAD_LEFT) . '/01')) . '/' . $currentYear; 
        $this->db->select('SUM(a.amount) as amount');
        $this->db->from('tax_history a');
        $this->db->join('timesheet_info b', 'b.timesheet_id = a.time_sheet_id');
        $this->db->where('a.tax LIKE', '%Income%');
        $this->db->where('b.quarter', $quarter);
        $this->db->where('a.code', 'NJ');
        $this->db->where('b.create_by', $user_id);
        $this->db->where('b.end >=', $startDate);
        $this->db->where('b.end <=', $endDate);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $results[] = [
                'month' => $month,
                'amount' => $query->row()->amount
            ];
        } else {
            $results[] = [
                'month' => $month,
                'amount' => 0
            ];
        }
    }
    return $results;
}
 
public function fetchQuarterlyData($user_id, $quarter)
{
    $currentYear = date('Y');
    $quarters = [
        'Q1' => ['01', '02', '03'], 
        'Q2' => ['04', '05', '06'], 
        'Q3' => ['07', '08', '09'], 
        'Q4' => ['10', '11', '12'] 
    ];
    if (!isset($quarters[$quarter])) {
        return false;
    }
    $months = $quarters[$quarter];
    $results = [];
    foreach ($months as $index => $month) {
        $monthStart = date('m/01/Y', strtotime("$currentYear-$month-01"));
        $monthEnd = date('m/t/Y', strtotime($monthStart));
        $this->db->select("
            COUNT(DISTINCT CASE WHEN a.end >= '$monthStart' AND a.end <= '$monthEnd' THEN a.templ_name END) AS total_count
        ");
        $this->db->from('timesheet_info a');
        $this->db->join('employee_history b', 'b.id = a.templ_name', 'left');
        $this->db->where(['a.create_by' => $user_id]);
        $query = $this->db->get();
        $results['month_' . ($index + 1) . '_total_count'] = $query->num_rows() > 0 ? $query->row()->total_count : 0;
    }
    return $results;
}



    public function info_info_for_salescommssion_data($user_id,$quarter)
{

$this->db->select('SUM(b.sales_c_amount) as SaleOverallTotal');
$this->db->from('timesheet_info a');
$this->db->join('tax_history b', 'b.time_sheet_id = a.timesheet_id', 'left');
$this->db->join('employee_history c', 'c.id = a.templ_name', 'left');
$this->db->where('a.quarter',$quarter); 
$this->db->where('b.tax','Income tax'); 
$this->db->where('a.create_by',$user_id); 
$this->db->where('c.choice','Yes'); 
$this->db->where("a.payroll_type NOT LIKE 'Sales Partner'");
$query = $this->db->get();
 if ($query->num_rows() > 0) {
    return $query->result_array();
} else {
    return false;
}
}

public function info_for_nj($user_id,$quarter)
{
    $this->db->select('sum(c.total_amount) as OverallTotal, b.social_security_number, b.first_name, b.middle_name, b.last_name');
    $this->db->from('timesheet_info a'); 
    $this->db->join('employee_history b', 'b.id = a.templ_name', 'left'); 
    $this->db->join('info_payslip c', 'c.timesheet_id = a.timesheet_id', 'left'); 
    $this->db->where("b.payroll_type NOT LIKE 'Sales Partner'");
    $this->db->where('a.quarter',$quarter);
    $this->db->where('a.create_by', $user_id); 
    $this->db->group_by('b.social_security_number, b.first_name, b.middle_name, b.last_name');
 
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return false;
    }
}

public function uc2a_retrievedata($quarter, $user_id)
{
    $this->db->select('sum(c.total_amount) as OverallTotal, b.social_security_number, b.first_name, b.middle_name, b.last_name');
    $this->db->from('timesheet_info a'); 
    $this->db->join('employee_history b', 'b.id = a.templ_name', 'left'); 
    $this->db->join('info_payslip c', 'c.timesheet_id = a.timesheet_id', 'left'); 
    $this->db->where("b.payroll_type NOT LIKE 'Sales Partner'");
    $this->db->where('a.quarter',$quarter);
    $this->db->where('a.create_by', $user_id); 
    $this->db->group_by('b.social_security_number, b.first_name, b.middle_name, b.last_name');
 
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return false;
    }
}

   public function get_941_sc_info($user_id,$selectedValue)
      {
      
        $this->db->select('SUM(a.sc) AS salebalanceamount');       
        $this->db->distinct(); 
        $this->db->from('info_payslip a');
        $this->db->join('employee_history b', 'b.id = a.templ_name');
        $this->db->join('timesheet_info c', 'c.templ_name = a.templ_name');
        $this->db->where('b.choice', 'No');
        $this->db->where('a.create_by', $user_id);
        $this->db->where('c.quarter', $selectedValue);
        $this->db->group_by('c.timesheet_id');  
        $query = $this->db->get();
        if ($query !== false && $query->num_rows() > 0) {
            return $query->result_array();
        } 
        return false;
      }
                        public function get_taxinfomation($user_id,$selectedValue)
{

$this->db->select('ti.timesheet_id');
$this->db->select('SUM(ip.s_tax) AS sum_s_tax');
$this->db->select('SUM(ip.f_tax) AS sum_f_tax');
$this->db->select('SUM(ip.u_tax) AS sum_u_tax');
$this->db->select('SUM(ip.m_tax) AS sum_m_tax');
$this->db->select('SUM(ip.sales_c_amount) AS sc_sum_total_amount');
$this->db->select('SUM(ip.total_amount) AS sum_total_amount');
$this->db->from('timesheet_info ti');
$this->db->join('info_payslip ip', 'ti.timesheet_id = ip.timesheet_id', 'inner');
$this->db->where('ti.create_by', $user_id);
$this->db->where('ti.quarter', $selectedValue);
$this->db->where('ti.uneditable', '1');
$this->db->group_by('ti.timesheet_id');
$query = $this->db->get();
 if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
                        public function so_total_amount($user_id,$selectedValue)
{
$query = $this->db->select('SUM(b.total_amount) as tamount,a.timesheet_id')->from('timesheet_info a')
                  ->join('info_payslip b', 'b.templ_name = a.templ_name')->join('employee_history c', 'c.id = b.templ_name')
                  ->join('tax_history_employer d', 'd.time_sheet_id = a.timesheet_id', 'left')
                  ->where('a.create_by', $user_id)->where('a.quarter', $selectedValue)
                  ->group_by('b.total_amount,a.timesheet_id')
                  ->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}


public function get_total_customersData($user_id) 
{

    $this->db->select('COUNT(DISTINCT templ_name) AS employee_count');
    $this->db->from('info_payslip');
    $this->db->where('info_payslip.create_by', $user_id);
    $query = $this->db->get();
    if ($query) {
    return $query->result_array();
    } else {
    log_message('error', 'Database error in get_total_customersData: ' . $this->db->_error_message());
    return 0; 
    }
}
                          public function total_local_tax($user_id)
   {
      
       $this->db->select('SUM(amount) as overalltotal_localtax');       
       $this->db->from('tax_history');
       $this->db->where('created_by', $user_id);
       $this->db->where_in('tax_type', ['local_tax' , 'living_local_tax']);
       $query = $this->db->get();
       if ($query->num_rows() > 0) {
           return $query->result_array();
       }
       return false;
   }
    public function sum_of_tax_amount($user_id)
{
    $this->db->select('SUM(tax_history.amount) as amount');
    $this->db->from('tax_history');
    $this->db->where('tax_history.created_by', $user_id);
    $this->db->where("tax_history.tax LIKE '%Income tax%'");
    $this->db->join('employee_history', 'employee_history.id = tax_history.employee_id', 'inner');
    $this->db->where('(employee_history.sales_partner IS NULL OR employee_history.sales_partner = "")');
     $query = $this->db->get();
   if ($query->num_rows() > 0) {
        $row = $query->row();
        return $row->amount;  
    }
    
    return false;
}

                           public function get_sc_info($user_id)
      {
         
          $this->db->select('SUM(a.sc) AS salebalanceamount');       
          $this->db->from('info_payslip a');
          $this->db->join('employee_history b', 'b.id = a.templ_name');
          $this->db->where('b.choice', 'Yes');
          $this->db->where('a.create_by', $user_id);
          $query = $this->db->get();
          if ($query !== false && $query->num_rows() > 0) {
              return $query->result_array();
          } 
          return false;
      }
   

    public function getoveralltaxdata($id)
    {
      
        $currentYear = date('Y');
        $this->db->select('a.*, b.*, c.*,b.f_tax as f_ftax,b.m_tax as m_mtax,b.s_tax as s_stax,b.u_tax as u_utax,a.timesheet_id as timesheet,d.s_tax as stax,d.m_tax as mtax,d.f_tax as ftax,d.u_tax as utax, d.tax_type, d.tax');
        $this->db->from('timesheet_info a');
        $this->db->join('info_payslip b', 'b.templ_name = a.templ_name');
        $this->db->join('employee_history c', 'c.id = b.templ_name');
        $this->db->join('tax_history_employer d', 'd.time_sheet_id = a.timesheet_id','left');
        $this->db->where("a.start LIKE '%$currentYear'");
         $this->db->where('c.id', $id);
        $this->db->group_by('a.timesheet_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	public function w2get_payslip_info($id)
{
  
    $this->db->select('SUM(total_amount) as overalltotal_amount ,SUM(f_tax) as  ftotal_amount ,SUM(s_tax) as  stotal_amount , SUM(m_tax) as  mtotal_amount');
    $this->db->from('info_payslip');
    $this->db->where('templ_name', $id);
    $this->db->where('tax IS NOT NULL');
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
public function tax_statecode_info($id)
{
    $this->db->select('code, tax_type');
    $this->db->from('tax_history');
    $this->db->where('employee_id', $id);
     $this->db->group_by('code, tax_type'); 
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
public function getother_tax($id)
{

    $this->db->select('code,tax, SUM(amount) AS amount'); 
    $this->db->from('tax_history');
    $this->db->where('employee_id', $id);
    $this->db->where("(tax_type = 'other_tax' OR tax_type = 'other_working_tax')");
    $this->db->group_by('code,tax'); 
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
    public function w2total_state_tax($id)
    {
        $this->db->select('ROUND(SUM(amount), 2) as overalltotal_statetax');
        $this->db->from('tax_history');
        $this->db->where('employee_id', $id);
        $this->db->where_in('tax_type', ['state_tax']);
        $this->db->where_in('tax', ['Income tax' ]); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	public function w2totalstatetaxworking($id)
    {
        $this->db->select('ROUND(SUM(amount), 2) as overalltotal_statetaxworking');
        $this->db->from('tax_history');
        $this->db->where('employee_id', $id);
        $this->db->where_in('tax_type', ['living_state_tax']); 
        $this->db->where("tax LIKE '%Income tax%'");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	public function getcounty_tax($id)
{
    
     $this->db->select('code,tax, SUM(amount) AS amount');
    $this->db->from('tax_history');
    $this->db->where('employee_id', $id);
    $this->db->where("(tax_type = 'living_county_tax' OR tax_type = 'working_county_tax')");
    $this->db->group_by('code,tax'); 
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
 public function w2total_local_tax($id)
    {
       
        $this->db->select('code, ROUND(SUM(amount), 2) as overalltotal_localtax');
        $this->db->from('tax_history');
        $this->db->where('employee_id', $id);
        $this->db->where_in('tax_type', ['local_tax']);
        $this->db->group_by('code'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	public function w2total_livinglocaldata($id)
{

    $this->db->select('ROUND(SUM(amount), 2) as livinglocaltax');
    $this->db->from('tax_history');
    $this->db->where('employee_id', $id);
    $this->db->where_in('tax_type', ['living_local_tax']);
    $this->db->group_by('code, tax_type'); 
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
 public function gettaxother_info($id)
    {
      
        $this->db->select('code,tax, SUM(amount) as amount'); 
        $this->db->from('tax_history');
        $this->db->where('employee_id', $id);
        $this->db->where("(tax_type = 'state_tax' OR tax_type = 'living_state_tax' OR tax_type = 'other_tax' OR tax_type = 'other_working_tax')");
        $this->db->where("tax NOT LIKE '%Income Tax%'");
        $this->db->group_by('code,tax'); 
        $this->db->order_by('tax'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function get_payslip_info($id)  {
       
        $this->db->select(' SUM(total_amount) as overalltotal_amount , SUM(f_tax) as  ftotal_amount , SUM(s_tax) as  stotal_amount ,  SUM(m_tax) as  mtotal_amount , sales_c_amount');
        $this->db->from('info_payslip');
        $this->db->where('tax IS NOT NULL');
        $this->db->where('create_by', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           return $query->result_array();
       }
       return false;
   }

    public function get_employer_federaltax($user_id)
    {
      
       $this->db->select('*');
       $this->db->from('user_login');
       $this->db->where('user_id', $user_id);
       $this->db->where('u_type', '2');
       $this->db->where('security_code IS NOT NULL');
       $query = $this->db->get();
       if ($query->num_rows() > 0) {
           return $query->result_array();
       }
       return false;
    }

                          //============================Forms===================================//
      //===============================Sales Commission ====================================//
    public function sc_info_count($templ_name, $payperiod) {
    $date = explode('-', $payperiod);
    $formattedStartDate = date('Y-m-d', strtotime($date[0]));
    $formattedendDate = date('Y-m-d', strtotime($date[1]));
    $this->db->select('b.sc, a.commercial_invoice_number, a.gtotal');
    $this->db->from('invoice a');
    $this->db->join('employee_history b', 'a.user_emp_id = b.id');
    $this->db->join('payment c', 'a.payment_id = c.payment_id');
    $this->db->where('a.paid_amount = a.gtotal');
    $this->db->where('a.user_emp_id', $templ_name);
    $this->db->where('a.sales_by', $this->session->userdata('user_id'));
    $this->db->where('c.payment_date >=', $formattedStartDate);
    $this->db->where('c.payment_date <=', $formattedendDate);
    // $this->db->group_start();
    // $this->db->where('c.balance', '0.00');
    // $this->db->or_where('c.balance', '0.0');
    // $this->db->or_where('c.balance', '0');
    // $this->db->group_end();
    $query = $this->db->get();
    $result['sc'] = $query->result_array();
    $tempArray = [];
    $filteredResult = [];
    foreach ($result['sc'] as $row) {
        $invoiceNumber = $row['commercial_invoice_number'];
        if (!in_array($invoiceNumber, $tempArray)) {
            $tempArray[] = $invoiceNumber;
            $filteredResult[] = $row;
        }
    }
    $result['sc'] = $filteredResult;
    $count = count($filteredResult);
    $result['count'] = $count;
    $total_gtotal = 0;
    foreach ($filteredResult as $row) {
        $total_gtotal += $row['gtotal'];
    }
    $result['total_gtotal'] = $total_gtotal;
    $scValue = isset($filteredResult[0]['sc']) ? $filteredResult[0]['sc'] : 0;
    $sc_totalAmount = $total_gtotal;
    if ($sc_totalAmount != 0) {
        $scValuePercentage = ($scValue / $sc_totalAmount) * 100;
        $scValueAmount = ($scValuePercentage / 100) * $sc_totalAmount;
    } else {
        $scValueAmount = 0;
    }

    return [
        'sc' => $scValue / 100, 
        'total_gtotal' => $total_gtotal,
        'count' => $count,
        's_commision_amount' => ($scValue / 100) * $total_gtotal,
        'scValueAmount' => $scValueAmount,
    ];
}
      //===============================Sales Commision =====================================//

public function getEmployeeContributions($emp_name = null, $date = null){
        $this->db->select('a.time_sheet_id,d.month,a.amount,c.*');
        $this->db->from('tax_history a');
          $this->db->join('employee_history c', 'c.id = a.employee_id');
           $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
          if ($emp_name !== 'Any') {
        $trimmed_emp_name = trim($emp_name); 
        $this->db->like("TRIM(CONCAT(c.first_name, ' ', c.last_name))", $trimmed_emp_name);
    }
if ($date) {
        $dates = explode(' - ', $date);
        $start_date = date('m/d/Y', strtotime($dates[0]));
        $end_date = date('m/d/Y', strtotime($dates[1]));
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(d.start, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->or_where("STR_TO_DATE(d.end, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->where("STR_TO_DATE(d.end, '%m/%d/%Y') <= STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->group_end();
    }
 $this->db->where('a.created_by',$this->session->userdata('user_id'));
   $this->db->where_in('a.tax_type',  'living_county_tax');
        $query = $this->db->get();
        return $query->result_array(); 
    }
public function getEmployeeContributions_local($emp_name = null, $date = null){
        $this->db->select('a.time_sheet_id,d.month,a.amount,c.*');
        $this->db->from('tax_history a');
          $this->db->join('employee_history c', 'c.id = a.employee_id');
           $this->db->join('timesheet_info d', 'a.time_sheet_id = d.timesheet_id');
           if ($date) {
        $dates = explode(' - ', $date);
        $start_date = date('m/d/Y', strtotime($dates[0]));
        $end_date = date('m/d/Y', strtotime($dates[1]));
        $this->db->group_start();
        $this->db->where("STR_TO_DATE(d.start, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->or_where("STR_TO_DATE(d.end, '%m/%d/%Y') BETWEEN STR_TO_DATE('$start_date', '%m/%d/%Y') AND STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->where("STR_TO_DATE(d.end, '%m/%d/%Y') <= STR_TO_DATE('$end_date', '%m/%d/%Y')");
        $this->db->group_end();
    }
           if ($emp_name !== 'Any') {
     $trimmed_emp_name = trim($emp_name); 
        $this->db->like("TRIM(CONCAT(c.first_name, ' ', c.last_name))", $trimmed_emp_name);
    }
 $this->db->where('a.created_by',$this->session->userdata('user_id'));
   $this->db->where_in('a.tax_type',  'living_local_tax');
        $query = $this->db->get();
 return $query->result_array(); 
    }
public function countydelete_tax($countytax = null, $county) {
    $this->db->where('tax', $county . '-' . $countytax);
    $this->db->where('created_by', $this->session->userdata('user_id'));
    $this->db->where('Type', 'County');
    $this->db->delete('state_and_tax');
    if ($countytax) {
        $sql = "UPDATE state_and_tax SET tax = REPLACE(REPLACE(tax, ?, ''), ',', ',') WHERE created_by=? AND state=? AND Type='County'";
        $query = $this->db->query($sql, array($countytax, $this->session->userdata('user_id'), $county));
    } else {
        $this->db->where('state', $county);
        $this->db->where('created_by', $this->session->userdata('user_id'));
        $this->db->where('Type', 'County');
        $this->db->delete('state_and_tax');
    }
    $sql1 = "UPDATE state_and_tax SET tax = TRIM(BOTH ',' FROM tax) WHERE Type='County'";
    $query1 = $this->db->query($sql1);
    $sql3 = "UPDATE state_and_tax SET tax = REPLACE(REPLACE(tax, ',,', ','), ',', ',') WHERE created_by=? AND state=? AND Type='County'";
    $query3 = $this->db->query($sql3, array($this->session->userdata('user_id'), $county));
    return true;
}
public function get_info_city_tax(){
      $this->db->select('*');
           $this->db->from('state_and_tax');
           $this->db->where('created_by',$this->session->userdata('user_id'));
           $this->db->where('Type','City');
           $query = $this->db->get();
           if ($query->num_rows() > 0) {
              return $query->result_array();
           }
            return true;
   }
public function get_info_county_tax(){
    $this->db->select('*');
         $this->db->from('state_and_tax');
         $this->db->where('created_by',$this->session->userdata('user_id'));
         $this->db->where('Type','County');
         $query = $this->db->get();
         if ($query->num_rows() > 0) {
            return $query->result_array();
         }
          return true;
}

public function checkTimesheetInfo($employeeId, $selectedDate) 
{
    $this->db->where('templ_name', $employeeId);
    $this->db->like('month', $selectedDate, 'both');
    $query = $this->db->get('timesheet_info');
    return $query->num_rows() > 0;
}

   public function employee_bankDetails()
   {
        $this->db->select('*');
        $this->db->from('bank_add');
        $this->db->where('created_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
   }

public function state_tax(){
        $this->db->select('state');
        $this->db->from('state_and_tax');
        $this->db->where('created_by',$this->session->userdata('user_id'));
        $this->db->where('Type','State');
        $query = $this->db->get();
       if ($query->num_rows() > 0) {
           return $query->result_array();
        }
         return true;
         }
    public function expenses_data_get() {
        $this->db->select("*");
        $this->db->from('expense');
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();    
        return $query->result_array();
    }
    public function officeloan_data_get() {
        $this->db->select("*");
        $this->db->from('person_ledger');
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();    
        return $query->result_array();
    }
       public function office_loan_list(){
        $this->db->select('*');
        $this->db->from('person_ledger');
         $this->db->where('create_by',$this->session->userdata('user_id'));
         $query = $this->db->get();
         if ($query->num_rows() > 0) {
           return $query->result_array();
         }
         return false;
    }
    public function empl_data_info(){
        $this->db->select('*');
        $this->db->from('timesheet_info');
         $this->db->where('create_by',$this->session->userdata('user_id'));
         $query = $this->db->get();
         if ($query->num_rows() > 0) {
           return $query->result_array();
         }
         return false;
    }
// Retrieve Federal Tax - Madhu
public function federal_tax_info($tax_type,$employee_status,$final,$federal_range, $user_id)
{
    $this->db->select('employee, employer, details');
    $this->db->from('federal_tax');
    $this->db->like('tax',$tax_type);
    $this->db->where($employee_status,$federal_range);
    $this->db->where('created_by',$user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
       return $query->result_array();
    }else{
        return 0;
    }
}





public function deleteDuplicateTaxRecords() {
        $sql = "DELETE t1 FROM tax_history t1 INNER JOIN tax_history t2 ON t1.id > t2.id AND t1.tax = t2.tax
                AND t1.code = t2.code AND t1.amount = t2.amount AND t1.created_by = t2.created_by AND t1.time_sheet_id = t2.time_sheet_id
                WHERE t1.weekly IS NULL AND t1.monthly IS NULL AND t1.biweekly IS NULL;";    
        return $this->db->query($sql);
    }

private function format_time($time) {
    if (is_string($time)) {
        list($hours, $minutes, $seconds) = explode(':', $time);
        $hours = (int)$hours;
        $minutes = (int)$minutes;
        $hours += ($minutes >= 60) ? (int)($minutes / 60) : 0;
        $minutes = $minutes % 60;
        return str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutes, 2, '0', STR_PAD_LEFT);
    }
    return '00:00';
}


// Employee Details - Madhu
public function employee_info($templ_name, $user_id)
{
    $this->db->select('a.*,b.designation as des');
    $this->db->from('employee_history a');
    $this->db->join('designation b','a.designation=b.id');
    $this->db->where('a.id', $templ_name);
    $this->db->where('a.create_by',$user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
       return $query->result_array();
    }
    return true;
}
// Timesheet Details - Madhu
public function timesheet_info_data($timesheet_id, $user_id)
{
    $this->db->select('*');
    $this->db->from('timesheet_info');
    $this->db->where('timesheet_id', $timesheet_id);
    $this->db->where('create_by',$user_id);
    $query = $this->db->get();
     if ($query->num_rows() > 0) {
       return $query->result_array();
     }
    return true;
}
    public function delete_off_loan($transaction_id){
        $this->db->where('transaction_id', $transaction_id);
        $this->db->delete('person_ledger');
        return true;
      }
      public function get_data_payslip(){
          $this->db->select('a.*,b.*,c.*');
          $this->db->from('timesheet_info a');
          $this->db->join('employee_history b' , 'a.templ_name = b.id');
          $this->db->join('tax_history c' , 'c.time_sheet_id  = a.timesheet_id');
           $this->db->group_by('c.time_sheet_id'); 
          $this->db->where('a.uneditable', '1');
          $this->db->where("a.payroll_type != 'Sales Partner'");
          $this->db->where('a.create_by',$this->session->userdata('user_id'));
          if($_SESSION['u_type'] ==3){
          $this->db->where('a.unique_id',$this->session->userdata('unique_id'));
          }
          $this->db->order_by('a.id', 'desc');
          $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return [];
            }
        }
 
     
    public function office_loan_datas($transaction_id){
        $this->db->select('*');
        $this->db->from('person_ledger');
        $this->db->where('transaction_id', $transaction_id);
         $this->db->where('create_by',$this->session->userdata('user_id'));
         $query = $this->db->get();
         if ($query->num_rows() > 0) {
           return $query->result_array();
         }
         return false;
    }
  public function timesheet_list(){
  $this->db->select('*');
    $this->db->from('timesheet_info a');
        $this->db->join('employee_history b' , 'a.templ_name = b.id');
         $this->db->where('a.create_by',$this->session->userdata('user_id'));
          if($_SESSION['u_type'] ==3){
          $this->db->where('a.unique_id',$this->session->userdata('unique_id'));
          }
         $this->db->order_by('a.id', 'desc'); 
         $query = $this->db->get();
         if ($query->num_rows() > 0) {
           return $query->result_array();
         }
         return false;
    }
    // Update Expense
    public function update_expense_id($id)
    {
        $data = array(
            'emp_name'  => $this->input->post('person_id',TRUE),
            'expense_name' => $this->input->post('expense_name',TRUE),
            'expense_date' => $this->input->post('expense_date',TRUE),
            'expense_amount' => $this->input->post('expense_amount',TRUE),
            'total_amount' => $this->input->post('total_amount',TRUE),
            'expense_payment_date' => $this->input->post('expense_payment_date',TRUE),
             'status' => $this->input->post('status',TRUE),
            'description' => $this->input->post('description',TRUE),
            'unique_id'  =>$this->input->post('unique_id',TRUE),
        );
        $this->db->where('id', $id);
        $this->db->update('expense', $data);
        return true;
    }
public function expense_list(){
      $this->db->select('*');
        $this->db->from('expense');
        $this->db ->where('create_by',$this->session->userdata('user_id'));
         if($_SESSION['u_type'] ==3){
              $this->db ->where('unique_id',$this->session->userdata('unique_id'));
         }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
}
    //Get expense by id
    public function get_expense_by_id($id) {
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
public function administrator_info($ads_id){
        $this->db->select('*');
        $this->db->from('administrator');
        $this->db->where('adm_id',$ads_id);
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
           return $query->result_array();
         }
        return true;
    }
    // Pdf Download Expense
    public function pdf_expense($id)
    {
        $this->db->select('*');
        $this->db->from('expense');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
 public function tax_info($id){
    $this->db->select('*');
    $this->db->from('info_payslip');
   $this->db->where('timesheet_id' , $id);
 $query = $this->db->get(); 
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
  }
public function time_sheet_data($id){
    $this->db->select('*');
    $this->db->from('timesheet_info a');
    $this->db->join('timesheet_info_details b' , 'a.timesheet_id = b.timesheet_id');
    $this->db->where('a.timesheet_id' , $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
}
    public function administrator_data(){
        $this->db->select('*');
        $this->db->from('administrator');
         $this->db->where('create_by',$this->session->userdata('user_id'));
         $query = $this->db->get();
         if ($query->num_rows() > 0) {
           return $query->result_array();
         }
         return false;
    }
    public function employee_name1() {
        $this->db->select('*');
        $this->db->from('employee_history');
          $this->db->where('create_by',$this->session->userdata('user_id'));
         $query = $this->db->get();
       if ($query->num_rows() > 0) {
        return $query->result_array();
    }
        return false;
    }
public function employee_partner($id) {
 $this->db->select('a.*,a.id as emp_id');
        $this->db->from('employee_history a');
        $this->db->where('a.id', $id);
             $this->db->where('a.create_by',$this->session->userdata('user_id'));
            $query = $this->db->get();
       if ($query->num_rows() > 0) {
        return $query->result_array();
    }
        return false;
    }
public function employee_name($id) {
 $this->db->select('a.*,a.id as emp_id,b.designation');
        $this->db->from('employee_history a');
        $this->db->where('a.id', $id);
           $this->db->join('designation  b', 'b.id =a.designation');
             $this->db->where('a.create_by',$this->session->userdata('user_id'));
            $query = $this->db->get();
       if ($query->num_rows() > 0) {
        return $query->result_array();
    }
        return false;
    }
    public function employeeinfo() {
        $this->db->select('*');
        $this->db->from('timesheet_info');
         $this->db->where('create_by',$this->session->userdata('user_id'));
         $query = $this->db->get();
       if ($query->num_rows() > 0) {
        return $query->result_array();
    }
        return false;
    }
    public function insert_adsrs_data($data) {
      $this->db->insert('administrator', $data);
        $this->db->select('*');
        $this->db->from('administrator');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_payment_terms(){
        $this->db->select('*');
        $this->db->from('payment_terms');
        $this->db->where('create_by' ,$this->session->userdata('user_id'));
        $query = $this->db->get();
         return $query->result_array();
    }
    public function insert_duration_data($postData){
        $data=array(
            'duration_name' => $postData,
            'create_by' => $this->session->userdata('user_id')
        );
           $this->db->insert('duration', $data);
        $this->db->select('*');
        $this->db->from('duration');
        $this->db->where('create_by' ,$this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_dailybreak(){
        $this->db->select('*');
        $this->db->from('dailybreak');
        $this->db->where('create_by' ,$this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_duration_data(){
        $this->db->select('*');
        $this->db->from('duration');
        $this->db->where('create_by' ,$this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getemp_data($value)
    {
        $this->db->select('a.*,b.*');
        $this->db->from('employee_history a');
        $this->db->where('a.id', $value);
        $this->db->join('designation  b', 'b.id =a.designation');
        $this->db->where('a.create_by',$this->session->userdata('user_id'));
        $query = $this->db->get()->result();
        return $query;
    }

    public function insert_dailybreak_data($postData){
        $data=array(
            'dailybreak_name' => $postData,
            'create_by' => $this->session->userdata('user_id')
        );
        $this->db->insert('dailybreak', $data);
        $this->db->select('*');
        $this->db->from('dailybreak');
        $this->db->where('create_by' ,$this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
    }

public function timesheet_data($id) {
    $this->db->select('*')->from('employee_history a');
    $this->db->join('timesheet_info b','a.id = b.templ_name');
    $this->db->where('b.timesheet_id', $id);
    $this->db->where('a.create_by', $this->session->userdata('user_id'));
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
    //Count designation
    public function count_designation() {
        return $this->db->count_all("designation");
    }
public function create_designation($data = []){
$data['create_by']=$this->session->userdata('user_id');
return $this->db->insert('designation',$data);
}

public function designation_info($postData) {
    $data = array(
        'designation' => $postData,
        'create_by' => $this->session->userdata('user_id')
    );
    $this->db->insert('designation', $data);
    $this->db->select('*')->from('designation');
    $this->db->where('create_by', $this->session->userdata('user_id'));
    $query = $this->db->get();
    return $query->result_array(); 
}

public function city_tax(){
    $this->db->select('city_tax');
           $this->db->from('city_tax');
           $this->db->where('created_by',$this->session->userdata('user_id'));
          $query = $this->db->get();
          if ($query->num_rows() > 0) {
              return $query->result_array();
           }
            return true;
   }
public function paytype_dropdown(){
        $this->db->select('payment_type');
        $this->db->from('payment_type');
       $this->db->where('create_by', $this->session->userdata('user_id'));
         $this->db->order_by('payment_type','asc');
       $query = $this->db->get();
         if ($query->num_rows() > 0) {
             return $query->result_array();
         }
        }
           public function city_tax_dropdown(){
            $this->db->select('city_tax');
            $this->db->from('city_tax');
           $this->db->where('created_by', $this->session->userdata('user_id'));
             $this->db->order_by('city_tax','asc');
           $query = $this->db->get();
             if ($query->num_rows() > 0) {
                 return $query->result_array();
             }
            }
    public function designation_dropdown()
    {
        $this->db->select('*');
        $this->db->from('designation');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query->result_array();
    }
    //designation List
    public function designation_list() {
        $this->db->select('*');
        $this->db->from('designation');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    //Retrieve designation Edit Data
    public function designation_editdata($id) {
        $this->db->select('*');
        $this->db->from('designation');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    //Update Categories
    public function update_designation($data = []) {
        $this->db->where('id', $data['id']);
        $this->db->update('designation', $data);
        return true;
    }
    // Delete designation Item
    public function delete_designation($id) {
        $this->db->where('id', $id);
        $this->db->delete('designation');
        return true;
    }
   public function create_employee($data = []){
     $this->db->insert('employee_history',$data);
     $id =$this->db->insert_id();
     $coa = $this->headcode();
           if($coa->HeadCode!=NULL){
                $headcode=$coa->HeadCode+1;
           }else{
                $headcode="502040001";
            }
    $c_acc=$id.'-'.$data['first_name'].''.$data['last_name'];
  $createby=$this->session->userdata('user_id');
  $createdate=date('Y-m-d H:i:s');
    $employee_coa = [
             'HeadCode'         => $headcode,
             'HeadName'         => $c_acc,
             'PHeadName'        => 'Employee Ledger',
             'HeadLevel'        => '3',
             'IsActive'         => '1',
             'IsTransaction'    => '1',
             'IsGL'             => '0',
             'HeadType'         => 'L',
             'IsBudget'         => '0',
             'IsDepreciation'   => '0',
             'DepreciationRate' => '0',
             'CreateBy'         => $createby,
             'CreateDate'       => $createdate,
        ];
        $this->db->insert('acc_coa',$employee_coa);
        return true;
   }
public function delete_tax($tax = null, $state) {
    $this->db->where('tax', $state . '-' . $tax);
    $this->db->where('create_by', $this->session->userdata('user_id'));
    $this->db->where('Type', 'State'); 
    $this->db->delete('state_and_tax');
    if ($tax) {
        $sql = "UPDATE state_and_tax SET tax = REPLACE(REPLACE(tax, ?, ''), ',', ',') WHERE created_by=? AND state=? AND Type='State'";
        $query = $this->db->query($sql, array($tax, $this->session->userdata('user_id'), $state));
    } else {
        $this->db->where('state', $state);
        $this->db->where('created_by', $this->session->userdata('user_id'));
        $this->db->where('Type', 'State');
        $this->db->delete('state_and_tax');
    }
    $sql1 = "UPDATE state_and_tax SET tax = TRIM(BOTH ',' FROM tax) WHERE Type='State'";
    $query1 = $this->db->query($sql1);
    $sql3 = "UPDATE state_and_tax SET tax = REPLACE(REPLACE(tax, ',,', ','), ',', ',') WHERE created_by=? AND state=? AND Type='State'";
    $query3 = $this->db->query($sql3, array($this->session->userdata('user_id'), $state));
    return true;
}
   public function employee_list()
   {
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
           return $query->result_array();
        }
        return false;
    }
    // Get Employee List Data
    public function getEmployeeListdata($limit, $offset, $orderField, $orderDirection, $search)
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("first_name", $search);
            $this->db->or_like("middle_name", $search);
            $this->db->or_like("last_name", $search);
            $this->db->or_like("designation", $search);
            $this->db->or_like("phone", $search);
            $this->db->or_like("email", $search);
            $this->db->or_like("blood_group", $search);
            $this->db->or_like("social_security_number", $search);
            $this->db->or_like("routing_number", $search);
            $this->db->or_like("employee_tax", $search);
            $this->db->group_end();
        }
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', $orderDirection);
        $query = $this->db->get();
        if ($query === false) {
            return [];
        }
        return $query->result_array();
    }
        public function getdesignation($id, $decodedId) 
        {
        $this->db->select("*");
        $this->db->from("designation");
        $this->db->where("id", $id);
        $this->db->where("create_by", $decodedId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }
    }
   public function editAttachment($emp_id, $decodedId)
    {
        $this->db->select('id,attachment_id,files,image_dir,created_by,sub_menu');
        $this->db->from('attachments');
        $this->db->where('attachment_id', $emp_id);
        $this->db->where('created_by', $decodedId);
        $query = $this->db->get();
         if ($query->num_rows() > 0) {
        }
    }
public function getAllEmployee($id){
$this->db->select('first_name,middle_name,last_name,id');
$this->db->from('employee_history');
$this->db->where('sales_partner is Null');
$this->db->where('create_by', $id);
$query = $this->db->get();
$resultRows = $query->result_array();
return $resultRows;
}
    // Get Total Employee List Data
    public function getTotalEmployeeListdata($search)
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        if (!empty($search)) {
            $this->db->like("first_name", $search);
            $this->db->or_like("middle_name", $search);
            $this->db->or_like("last_name", $search);
            $this->db->or_like("designation", $search);
            $this->db->or_like("phone", $search);
            $this->db->or_like("email", $search);
            $this->db->or_like("blood_group", $search);
            $this->db->or_like("social_security_number", $search);
            $this->db->or_like("routing_number", $search);
            $this->db->or_like("employee_tax", $search);
            $this->db->or_like("employee_tax", $search);
            $this->db->group_end();
        }
        $this->db->where('create_by',$this->session->userdata('user_id'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query === false) {
            return false;
        }
        return $query->num_rows();
    }
   // Employee Edit data
   public function employee_editdata($id){
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
   }
public function payroll_editdata($id){
        $this->db->select('*');
        $this->db->from('payroll_type');
        $this->db->where('id', $id);
        $this->db->where('created_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    public function employeestype_editdata($id){
        $this->db->select('*');
        $this->db->from('employee_type');
        $this->db->where('id', $id);
        $this->db->where('created_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
     public function headcode(){
        $query=$this->db->query("SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadLevel='3' And HeadCode LIKE '50204000%'");
        return $query->row();
    }
// update employee
    public function update_employee($id, $postData)
    {
        $this->db->where('id', $id);
        $this->db->update('employee_history',$postData);
        return true;
    }
    
    // Update Sales Partner
    public function update_salespartner($id, $data_salespartner)
    {
        $this->db->where('id', $id);
        $this->db->update('employee_history',$data_salespartner);
        return true;
    }
public function getTaxdetailsdata($tax){
        $this->db->select('*');
        $this->db->from('state_localtax');
        $this->db->where('tax', $tax);
         $this->db->where('create_by',$this->session->userdata('user_id'));
         $query = $this->db->get();
         if ($query->num_rows() > 0) {
           return $query->result_array();
         }
         return false;
    }
    //delete employee
    public function delete_employee($id) 
    {
        $this->db->where('id', $id);
        $this->db->delete('employee_history');
        $this->db->where('id', $id);
        $this->db->delete('payroll_type');
        $this->db->where('id', $id);
        $this->db->delete('employee_type');
        return true;
    }
    // Delete Timesheet Data - Madhu
    public function deleteTimesheetdata($id) 
    {
        $this->db->where('timesheet_id',$id);
        $this->db->delete('timesheet_info');
       
        $this->db->where('timesheet_id',$id);
        $this->db->delete('timesheet_info_details'); 
        $this->db->where('time_sheet_id',$id);
        $this->db->delete('tax_history'); 
        $this->db->where('timesheet_id',$id);
        $this->db->delete('info_payslip'); 
        $this->db->where('time_sheet_id',$id);
        $this->db->delete('tax_history_employer');  
        return true;
    }
    public function employee_detl($id, $user_id){
        $this->db->select('*');
        $this->db->from('employee_history a');
        $this->db->join('designation b','a.designation = b.id');
        $this->db->where('a.id', $id);
        $this->db->where('a.create_by',$user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function employee_salespartner($id, $user_id)
    {
        $this->db->select('*');
        $this->db->from('employee_history');
        $this->db->where('id', $id);
        $this->db->where('create_by',$user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
    
    public function employee_details($id){
        $this->db->select('*');
        $this->db->from('employee_history ');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
   }
   public function get_customersData()
   {
        $this->db->select('*');
        $this->db->from('employee_history ');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
   }
 

  
     



 
 
   public function employeeDetailsdata($id = null)
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('*');
    $this->db->from('employee_history');
    $this->db->where('id', $id);
    $this->db->where('create_by', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
   }
}
 

       public function count_payslip()
   {
    $user_id = $this->session->userdata('user_id');
       $this->db->select('COUNT(timesheet_info.timesheet_id) as totalts');
       $this->db->from('timesheet_info');
       $this->db->where('timesheet_info.create_by', $user_id);
       $query = $this->db->get();
       if ($query->num_rows() > 0) {
           return $query->result_array();
       }
       return false;
   }


        

    // w2 state tax Working Tax
    
      public function sum_of_hourly()
    {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('SUM(tax_history.amount) as amount');
        $this->db->from('tax_history');
        $this->db->where('tax_history.created_by', $user_id);
        $this->db->where('tax_history.weekly IS NULL', null, false);
        $this->db->where('tax_history.biweekly IS NULL', null, false);
        $this->db->where('tax_history.monthly IS NULL', null, false);
       $this->db->where("tax_history.tax LIKE '%Income tax%'");
       $this->db->join('employee_history', 'employee_history.id = tax_history.employee_id', 'inner');
        $this->db->where('(employee_history.sales_partner IS NULL OR employee_history.sales_partner = "")');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
  public function w2total_statedata($id)
    {
        $user_id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('tax_history');
        $this->db->where('created_by', $user_id);
        $this->db->where('employee_id', $id);
        $this->db->where_in('tax_type', ['living_state_tax', 'state_tax']);
        $this->db->group_by('code, tax_type'); 
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

//Used in f940
public function get_paytotal()
{
   $user_id = $this->session->userdata('user_id');
    $this->db->select('SUM(total_amount) as total_grosspay');
    $this->db->from('info_payslip');
    $this->db->where('tax IS NOT NULL');
    $this->db->where('create_by', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
       return $query->result_array();
    }
    return false;
}
// Used in Payroll Setting
public function timesheet_data_emp()
{
    $user_id = $this->session->userdata('user_id');
    $this->db->select('*');
    $this->db->from('timesheet_info a');
    $this->db->join('employee_history b', 'b.id = a.templ_name', 'left');
    $this->db->where('a.uneditable', 1); 
    $this->db->where('a.create_by', $user_id); 
    $this->db->where('(b.sales_partner IS NULL OR b.sales_partner = "")');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    } else {
        return false;
    }
}


public function getPaginatedpayslip($limit, $offset, $orderField, $orderDirection, $search, $date = null, $emp_name = 'All')
{
    $this->db->select('a.*,b.*,c.*, a.amount as total_period');

    if ($date) {
        $date_range = $this->parse_date_range($date);
        $this->db->where("a.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
    }

    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', b.first_name, b.middle_name, b.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', b.first_name, b.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    $this->db->from('timesheet_info a');
    $this->db->join('employee_history b' , 'a.templ_name = b.id');
    $this->db->join('tax_history c' , 'c.time_sheet_id  = a.timesheet_id');
    $this->db->group_by('c.time_sheet_id'); 
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("a.timesheet_id", $search);
        $this->db->or_like("b.first_name", $search);
        $this->db->or_like("b.last_name", $search);
        $this->db->or_like("b.middle_name", $search);
        $this->db->or_like("b.employee_tax", $search);
        $this->db->or_like("a.total_hours", $search);
        $this->db->or_like("a.extra_hour", $search);
        $this->db->group_end();
    }
    $this->db->where('a.uneditable', '1');
    $this->db->where("a.payroll_type != 'Sales Partner'");
    $this->db->where('a.create_by',$this->session->userdata('user_id'));
    if($_SESSION['u_type'] ==3){
        $this->db->where('a.unique_id',$this->session->userdata('unique_id'));
    }
    $this->db->limit($limit, $offset);
    $this->db->order_by('a.id', $orderDirection); 
    $query = $this->db->get();
    
    if ($query === false) {
        return false;
    }
    return $query->result_array();
}

public function getPaginatedscchoiceyes($limit, $offset, $orderField, $orderDirection, $search, $date = null, $emp_name = 'All')
{
    $this->db->select('a.*,b.*,c.*');
    if ($date) {
        $date_range = $this->parse_date_range($date);
        $this->db->where("a.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
    }
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', b.first_name, b.middle_name, b.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', b.first_name, b.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    $this->db->from('timesheet_info a');
    $this->db->join('tax_history b', 'a.timesheet_id = b.time_sheet_id');
    $this->db->join('employee_history c', 'a.templ_name = c.id'); 
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("a.timesheet_id", $search);
        $this->db->or_like("b.first_name", $search);
        $this->db->or_like("b.last_name", $search);
        $this->db->or_like("b.middle_name", $search);
        $this->db->or_like("b.employee_tax", $search);
        $this->db->or_like("a.total_hours", $search);
        $this->db->or_like("a.extra_hour", $search);
        $this->db->group_end();
    }
    $this->db->where('c.choice', 'Yes');
    $this->db->where('a.payroll_type', 'Sales Partner');
    $this->db->limit($limit, $offset);
    $this->db->order_by('a.id', $orderDirection); 
    $query = $this->db->get();
    if ($query === false) {
        return [];
    }
    return $query->result_array();
}
public function getPaginatedscpayslip($limit, $offset, $orderField, $orderDirection, $search, $date = null, $emp_name = 'All')
{
    $this->db->select('a.*,b.*');
    if ($date) {
        $date_range = $this->parse_date_range($date);
        $this->db->where("a.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
    }
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', b.first_name, b.middle_name, b.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', b.first_name, b.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    $this->db->from('timesheet_info a');
    $this->db->join('employee_history b' , 'a.templ_name = b.id');
    $this->db->group_by('a.timesheet_id');  
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("a.timesheet_id", $search);
        $this->db->or_like("b.first_name", $search);
        $this->db->or_like("b.last_name", $search);
        $this->db->or_like("b.middle_name", $search);
        $this->db->or_like("b.employee_tax", $search);
        $this->db->or_like("a.total_hours", $search);
        $this->db->or_like("a.extra_hour", $search);
        $this->db->group_end();
    }
    $this->db->where('a.uneditable', '1');
    $this->db->where('a.payroll_type', 'Sales Partner');
    $this->db->where('b.choice', 'No');
    $this->db->limit($limit, $offset);
    $this->db->order_by('a.id', $orderDirection); 
    $query = $this->db->get();
    if ($query === false) {
        return [];
    }
    return $query->result_array();
}
public function getTotalpayslip($search, $date, $emp_name = 'All')
{
    $this->db->select('a.*,b.*,c.*');
    if ($date) {
        $date_range = $this->parse_date_range($date);
        $this->db->where("a.end BETWEEN '{$date_range['start_date']}' AND '{$date_range['end_date']}'");
    }
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', b.first_name, b.middle_name, b.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', b.first_name, b.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    $this->db->from('timesheet_info a');
    $this->db->join('employee_history b' , 'a.templ_name = b.id');
    $this->db->join('tax_history c' , 'c.time_sheet_id  = a.timesheet_id');
    $this->db->group_by('c.time_sheet_id'); 
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("a.timesheet_id", $search);
        $this->db->or_like("b.first_name", $search);
        $this->db->or_like("b.last_name", $search);
        $this->db->or_like("b.middle_name", $search);
        $this->db->or_like("b.employee_tax", $search);
        $this->db->or_like("a.total_hours", $search);
        $this->db->or_like("a.extra_hour", $search);
        $this->db->group_end();
    }
    $this->db->where('a.uneditable', '1');
    $this->db->where("a.payroll_type != 'Sales Partner'");
    $this->db->where('a.create_by',$this->session->userdata('user_id'));
    if($_SESSION['u_type'] ==3){
        $this->db->where('a.unique_id',$this->session->userdata('unique_id'));
    }
    $this->db->order_by('a.id', 'desc'); 
    $query = $this->db->get();
    if ($query === false) {
        return false;
    }
    return $query->num_rows();
}
// Mangetime Sheet Data - Madhu
public function getPaginatedmanagetimesheetlist($limit, $offset, $orderField, $orderDirection, $search, $emp_name = 'All')
{
    $this->db->select('a.*,b.*');
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', b.first_name, b.middle_name, b.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', b.first_name, b.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    $this->db->from('timesheet_info a');
    $this->db->join('employee_history b' , 'a.templ_name = b.id');
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->or_like("b.first_name", $search);
        $this->db->or_like("b.last_name", $search);
        $this->db->or_like("b.middle_name", $search);
        $this->db->or_like("a.payroll_type", $search);
        $this->db->or_like("a.total_hours", $search);
        $this->db->or_like("a.month", $search);
        $this->db->group_end();
    }
    $this->db->where('a.create_by',$this->session->userdata('user_id'));
    $this->db->limit($limit, $offset);
    $this->db->order_by('a.id', $orderDirection);
    $query = $this->db->get();
    if ($query === false) {
        return [];
    }
    return $query->result_array();
}

public function getTotalmanagetimesheetlist($search, $emp_name = 'All')
{
    $this->db->select('a.*,b.*');
    if ($emp_name !== 'All') {
        $trimmed_emp_name = trim($emp_name);
        $this->db->group_start();
        $this->db->like("TRIM(CONCAT_WS(' ', b.first_name, b.middle_name, b.last_name))", $trimmed_emp_name);
        $this->db->or_like("TRIM(CONCAT_WS(' ', b.first_name, b.last_name))", $trimmed_emp_name);
        $this->db->group_end();
    }
    $this->db->from('timesheet_info a');
    $this->db->join('employee_history b' , 'a.templ_name = b.id');
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->or_like("b.first_name", $search);
        $this->db->or_like("b.last_name", $search);
        $this->db->or_like("b.middle_name", $search);
        $this->db->or_like("a.payroll_type", $search);
        $this->db->or_like("a.total_hours", $search);
        $this->db->or_like("a.month", $search);
        $this->db->group_end();
    }
    $this->db->where('a.create_by',$this->session->userdata('user_id'));
    $this->db->order_by('a.id', 'desc'); 
    $query = $this->db->get();
    if ($query === false) {
        return false;
    }
    return $query->num_rows();
}
// Logs Entry 
// Paginated Federal income tax
public function getPaginatedLogs($limit, $offset, $orderField, $orderDirection, $search, $date = null, $status = 'All', $decodedId)
{
    if ($date) {
        $dates = explode(' to ', $date);
        $start_date = $dates[0];
        $end_date = $dates[1];
        $this->db->where("c_date BETWEEN '$start_date' AND '$end_date'");
    }
    if ($status !== 'All' && $status !== null) {
        $this->db->group_start();
        $this->db->like("status", $status);
        $this->db->group_end();
    }
    $subquery .= ")";
    $this->db->select('*');
    $this->db->from('log_entry');
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("user_id", $search);
        $this->db->or_like("admin_id", $search);
        $this->db->or_like("field_id", $search);
        $this->db->or_like("hint", $search);
        $this->db->or_like("username", $search);
        $this->db->or_like("user_ipaddress", $search);
        $this->db->or_like("user_actions", $search);
        $this->db->or_like("module", $search);
        $this->db->or_like("details", $search);
        $this->db->or_like("status", $search);
        $this->db->or_like("c_date", $search);
        $this->db->or_like("c_time", $search);
        $this->db->group_end();
    }
    $this->db->where("user_id", $decodedId);
    $this->db->limit($limit, $offset);
    $this->db->order_by($orderField, $orderDirection);
    $query = $this->db->get();
    if ($query === false) {
        return false;
    }
    return $query->result_array();
}
// Total Logs 
public function getTotalLogs($search, $date, $status = 'All', $decodedId)
{
    if ($date) {
        $dates = explode(' to ', $date);
        $start_date = $dates[0];
        $end_date = $dates[1];
        $this->db->where("c_date BETWEEN '$start_date' AND '$end_date'");
    }
    if ($status !== 'All' && $status !== null) {
        $this->db->group_start();
        $this->db->like("status", $status);
        $this->db->group_end();
    }
    $subquery .= ")";
    $this->db->select('*');
    $this->db->from('log_entry');
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like("user_id", $search);
        $this->db->or_like("admin_id", $search);
        $this->db->or_like("field_id", $search);
        $this->db->or_like("hint", $search);
        $this->db->or_like("username", $search);
        $this->db->or_like("user_ipaddress", $search);
        $this->db->or_like("user_actions", $search);
        $this->db->or_like("module", $search);
        $this->db->or_like("details", $search);
        $this->db->or_like("status", $search);
        $this->db->or_like("c_date", $search);
        $this->db->or_like("c_time", $search);
        $this->db->group_end();
    }
    $this->db->where("user_id", $decodedId);
    $this->db->limit($limit, $offset);
    $this->db->order_by($orderField, $orderDirection);
    $query = $this->db->get();
    if ($query === false) {
        return false;
    }
    return $query->num_rows();
}
//Retrieve Company Information - Madhu
public function retrieve_companyinformation($user_id) 
{
    $this->db->select('*');
    $this->db->from('company_information');
    $this->db->where('company_id', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
}
//Retrieve Company name, Address, mobile, email, reg_number, website, address  - Madhu
public function retrieve_companydata($user_id) 
{
    $this->db->select('*');
    $this->db->from('invoice_content');
    $this->db->where('uid', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
}
public function insertData($table, $data) {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
}

public function bank_entry($user_id) 
{
    $this->db->select('*');
    $this->db->from('bank_add');
    $this->db->where('created_by', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
}
   

//Latest code - Surya - Starts //
//to get the cumulative amount of country taxes
public function  available_country_tax($employee_id,$user_id,$start_date)
{
$this->db->select('COUNT(*) as row_count,SUM(info_payslip.s_tax) as total_social_tax, 
SUM(info_payslip.m_tax) as total_medicare_tax, SUM(info_payslip.f_tax) as total_fed_tax, SUM(info_payslip.u_tax) as total_unemp_tax,
SUM(info_payslip.total_amount) as total_amount, SUM(timesheet_info.total_hours) as total_hours');
$this->db->from('timesheet_info');
$this->db->join('info_payslip', 'timesheet_info.timesheet_id = info_payslip.timesheet_id');
$this->db->where('info_payslip.templ_name', $employee_id);
$this->db->where('info_payslip.create_by', $user_id);
$this->db->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE(' $start_date', '%m/%d/%Y')", NULL, FALSE);
$query = $this->db->get();
if ($query->num_rows() > 0) {
    $result = $query->row_array();
    return $result;
}
return [];
}
// To get the state tax details - Used in payslip and time_list functions
public function get_state_details($find, $table, $where, $state, $user_id)
{
    $this->db->select($find)->from($table)->where($where, $state)->where('created_by', $user_id);
    $query = $this->db->get();
    if ($query === false) {
        return [];
    }
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return [];
}
// To get the state tax details - Used in state_tax function
public function working_state_tax($taxname, $employee_status, $final, $local_tax_range, $stateTax = "", $user_id, $payroll, $payroll_frequency)
{
    $this->db->select('employee, employer, tax, details, single, tax_filling, married, head_household');
    if (strpos($taxname, 'Income') !== false) {
        if ($payroll == 'Hourly' || $payroll == 'Fixed') {
            switch ($payroll_frequency) {
                case 'Weekly':
                    $this->db->from('weekly_tax_info');
                    break;
                case 'Bi-Weekly':
                    $this->db->from('biweekly_tax_info');
                    break;
                case 'Monthly':
                    $this->db->from('monthly_tax_info');
                    break;
                default:
                    $this->db->from('state_localtax');
                    break;
            }
        }
    } else {
        $this->db->from('state_localtax');  
    }
    $this->db->where($employee_status, $local_tax_range);
    if ($stateTax != "") {
        $this->db->like('tax', $stateTax);
    }
    $this->db->where('created_by', $user_id);
    $query = $this->db->get();
    if ($query === false) {
        return false;
    }
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
     return true; 
}
//To get the tax amount of current timesheet_id
public function get_tax_history($tax_type,$tax,$timesheet)
{
    $this->db->select('amount')->from('tax_history')
    ->where('tax_type', $tax_type)
    ->where('tax', $tax)
    ->where('time_sheet_id', $timesheet);
    $query= $this->db->get();
    if ($query->num_rows() > 0) {
    $result = $query->row_array();
    return $result['amount'];
    }else{
    return null;
    }
}
//To get the cumulative state tax amount of specific employee
public function get_cumulative_tax_amount($tax, $end, $employee, $tax_type) 
{
    $this->db->select('SUM(tax_history.amount) as total_amount')
    ->from('tax_history')
    ->join('timesheet_info', 'tax_history.time_sheet_id = timesheet_info.timesheet_id')
    ->where('timesheet_info.templ_name', $employee)
    ->where('tax_history.tax', $tax)
    ->where('tax_history.tax_type', $tax_type)
    ->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$end', '%m/%d/%Y')", NULL, FALSE);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    $result = $query->row_array();
    return $result['total_amount']; 
    } else {
    return null;
    }
}
//To get the cumulative country tax amount of specific employee
public function sum_of_country_tax($end_date = null, $empid, $timesheetid, $user_id)
{
    $this->db->select('
        SUM(info_payslip.s_tax) as t_s_tax, 
        SUM(info_payslip.m_tax) as t_m_tax,
        SUM(info_payslip.f_tax) as t_f_tax, 
        SUM(info_payslip.u_tax) as t_u_tax, 
        SUM(info_payslip.total_amount) as t_amount,
        SUM(timesheet_info.ytd) as ytd_salary,
        SUM(timesheet_info.sc_amount) as sc_amount,
        SUM(timesheet_info.extra_ytd) as ytd_overtime_salary,
        SUM(info_payslip.sc) as sc,
        SUM(timesheet_info.total_hours) as ytd_days,
        SUM(timesheet_info.hour) as ytd_hours_excl_overtime,
        SEC_TO_TIME(SUM(TIME_TO_SEC(timesheet_info.total_hours))) as total_hours,
        SEC_TO_TIME(SUM(TIME_TO_SEC(timesheet_info.extra_hour))) as ytd_hours_only_overtime,
        SEC_TO_TIME(SUM(TIME_TO_SEC(timesheet_info.hour))) as ytd_hours_excl_overtime_in_time
    ');
    $this->db->from('timesheet_info');
    $this->db->join('info_payslip', 'timesheet_info.timesheet_id = info_payslip.timesheet_id');
    $this->db->where('info_payslip.templ_name', $empid);
    $this->db->where('info_payslip.create_by', $user_id);
    
    if ($end_date) {
        $this->db->where("STR_TO_DATE(SUBSTRING_INDEX(timesheet_info.month, ' - ', -1), '%m/%d/%Y') <= STR_TO_DATE('$end_date', '%m/%d/%Y')", NULL, FALSE);
    }
 $query = $this->db->get();
   if ($query->num_rows() > 0) {
        return $query->result_array();
    }

    return false;
}

// All Federal Taxes - Madhu
public function allFederaltaxes($taxType, $user_id)
{
    $this->db->select('*');
    $this->db->from('federal_tax');
    $this->db->where('tax', $taxType);
    $this->db->where('created_by', $user_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
    return $query->result_array();
    }
    return [];
}
//Get Overall Working hour
public function get_overtime_data($id = null) 
{
    $this->db->select('*');
    $this->db->from('working_time');
    if (!empty($id)) {
        $this->db->where('created_by', $id);
    } else {
        $this->db->where('created_by', $this->session->userdata('user_id'));
    }
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}
public function add_payment_type($postData)
{
    $data=array(
        'payment_type' => $postData,
        'create_by' => $this->session->userdata('user_id')
    );
    $this->db->insert('payment_type', $data);
    $this->db->select('*');
    $this->db->from('payment_type');
    $this->db->where('create_by' ,$this->session->userdata('user_id'));
    $query = $this->db->get();
    return $query->result_array();
}

// Delete Tax List
public function delete_payrolldata($id, $tax_type)
{
    $this->db->where('id', $id);    
    if($tax_type == 'citytax'){
      $delete = $this->db->delete('city_tax_info');
    }else if($tax_type == 'countytax'){
      $delete = $this->db->delete('county_tax_info');
    }else{
      $delete = $this->db->delete('state_localtax');
    }
    return $delete;
}

// Delete Federal Tax List
public function delete_federaldata($id)
{
    $this->db->where('id', $id);    
    $delete = $this->db->delete('federal_tax');
    return $delete;
}

public function delete_weeklydata($id)
{
    $this->db->where('id', $id);    
    $delete = $this->db->delete('weekly_tax_info');
    return $delete;
}

public function delete_biweeklydata($id)
{
    $this->db->where('id', $id);    
    $delete = $this->db->delete('biweekly_tax_info');
    return $delete;
}

public function delete_monthlydata($id)
{
    $this->db->where('id', $id);    
    $delete = $this->db->delete('monthly_tax_info');
    return $delete;
}

public function getUsers($id, $admin_id)
{   
    $this->db->select('*');
    $this->db->from('user_login');
    $this->db->where('user_id', $id);
    $this->db->where('unique_id', $admin_id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return false;
}

}