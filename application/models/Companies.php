<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Companies extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	   public function retrieve_company() {
        $this->db->select('*');
        $this->db->from('company_information');
        $this->db->limit('1');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }
	public function companyList($id = null)
	{
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('company_id', $id);
		$query = $this->db->get();
		// echo $this->db->last_query();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	public function editurlstdata($company_id)
    {
        $this->db->select('*');
        $this->db->from('url_st');
		$this->db->where('company_id', $company_id);
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
		
		if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
	public function editurllctxdata($company_id)
    {
        $this->db->select('*');
        $this->db->from('url_lctx');
		$this->db->where('company_id', $company_id);
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
				// echo $this->db->last_query(); die();
		
		if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
	public function editurlsstxdata($company_id)
    {
        $this->db->select('*');
        $this->db->from('url_sstx');
		$this->db->where('company_id', $company_id);
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
				// echo $this->db->last_query(); die();
		
		if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
public function editurldata($company_id)
    {
        $this->db->select('*');
        $this->db->from('url');
		$this->db->where('company_id', $company_id);
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
	
	
	#============Count Company=============#
	public function count_company()
	{
		return $this->db->count_all("company_information");
	}
	#=============Company List=============#
	public function company_list()
	{
		$this->db->select('*');
		$this->db->from('company_information');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function getemailConfig()
    {
        $this->db->select('*');
        $this->db->from('email_config');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
    public function editstatedata()
    {
        $this->db->select('*');
        $this->db->from('state_tax_id');
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
	public function editlocaldata()
    {
        $this->db->select('*');
        $this->db->from('local_tax_id');
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
	public function retrieve_localtax()
    {
        $this->db->select('*');
        $this->db->from('local_tax_id');
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }
	public function retrieve_statetax()
    {
        $this->db->select('*');
        $this->db->from('state_tax_id');
        $this->db->where('create_by', $this->session->userdata('user_id'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    public function company_info($user_id)
	{
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('create_by', $user_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function company_admin_info()
	{
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('create_by', $this->session->userdata('user_id'));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}






	public function company_details()
	{
		$this->db->select('*');
		$this->db->from('company_information');
			$this->db->where('create_by', $this->session->userdata('user_id'));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	#==============Company search list==============#
	public function company_search_item($company_id)
	{
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('company_id',$company_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	#============Insert company to database========#
	public function company_entry($data)
	{
		$this->db->insert('company_information',$data);
		
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('status',1);
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$json_product[] = array('label'=>$row->company_name,'value'=>$row->company_id);
		}
		$cache_file = './my-assets/js/admin_js/json/company.json';
		$productList = json_encode($json_product);
		file_put_contents($cache_file,$productList);
	}
	#==============Company edit data===============#
	public function retrieve_company_editdata($company_id)
	{
		$this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('company_id',$company_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//  public function retrieve_company($id) {
    //    $this->db->select('a.first_name,a.last_name,a.address,a.phone,a.company_name,b.username as email');
    //     $this->db->from('users a');
    //     $this->db->join('user_login b','b.user_id=a.user_id','left');
    //     $this->db->where('a.user_id',$id);
    //     $this->db->limit('1');
    //     $query = $this->db->get();
    //     if ($query->num_rows() > 0) {
    //         return $query->result_array();
    //     }
    //     return false;
    // }
	#==============Update company==================#
	public function update_company($data,$company_id)
	{

		$this->db->where('company_id',$company_id);
		$this->db->update('company_information',$data); 
        $this->db->select('*');
		$this->db->from('company_information');
		$this->db->where('status',1);
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$json_product[] = array('label'=>$row->company_name,'value'=>$row->company_id);
		}
		$cache_file = './my-assets/js/admin_js/json/company.json';
		$productList = json_encode($json_product);
		file_put_contents($cache_file,$productList);
		return true;
	}

	//Retrieve supplier Personal Data 
	public function supplier_personal_data($supplier_id)
	{
		$this->db->select('*');
		$this->db->from('supplier_information');
		$this->db->where('supplier_id',$supplier_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Retrieve Supplier Purchase Data 
	public function supplier_purchase_data($supplier_id)
	{
		$this->db->select('*');
		$this->db->from('product_purchase');
		$this->db->where(array('supplier_id'=>$supplier_id,'status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	//Supplier Search Data
	public function supplier_search_list($cat_id,$company_id)
	{
		$this->db->select('a.*,b.sub_category_name,c.category_name');
		$this->db->from('suppliers a');
		$this->db->join('supplier_sub_category b','b.sub_category_id = a.sub_category_id');
		$this->db->join('supplier_category c','c.category_id = b.category_id');
		$this->db->where('a.sister_company_id',$company_id);
		$this->db->where('c.category_id',$cat_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	//To get certain supplier's chalan info by which this company got products day by day
	public function suppliers_ledger($supplier_id)
	{ 
		$this->db->select('*');
		$this->db->from('supplier_ledger');
		$this->db->where('supplier_id',$supplier_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
//Retrieve supplier Transaction Summary
	public function suppliers_transection_summary($supplier_id)
	{
	 $result=array();
		$this->db->select_sum('amount','total_credit');
		$this->db->from('supplier_ledger');
		$this->db->where(array('supplier_id'=>$supplier_id,'deposit_no'=>NULL,'status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result[]=$query->result_array();	
		}
		
		$this->db->select_sum('amount','total_debit');
		$this->db->from('supplier_ledger');
		$this->db->where(array('supplier_id'=>$supplier_id,'chalan_no'=>NULL,'status'=>1));
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$result[]=$query->result_array();	
		}
		return $result;
	
	}
//Findings a certain supplier products sales information
	public function supplier_sales_details($supplier_id)
	{
		$from_date = $this->input->post('from_date');		
		$to_date = $this->input->post('to_date');
		
		$this->db->select('date,product_name,product_model,product_id,cartoon,quantity,supplier_rate,(quantity*supplier_rate) as total');
		$this->db->from('sales_report');
		$this->db->where('supplier_id',$supplier_id);
		if($from_date!=null AND $to_date!=null)
		{
			$this->db->where('date >',$from_date.' 00:00:00');
			$this->db->where('date <',$to_date.' 00:00:00');
		}
		$this->db->order_by('date','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function supplier_sales_summary($supplier_id)
	{
		$from_date = $this->input->post('from_date');		
		$to_date = $this->input->post('to_date');
		
		
		$this->db->select('date,product_name,product_model,product_id,sum(cartoon) as cartoon, sum(quantity) as quantity ,supplier_rate,sum(quantity*supplier_rate) as total');
		$this->db->from('sales_report');
		$this->db->where('supplier_id',$supplier_id);
		if($from_date!=null AND $to_date!=null)
		{
			$this->db->where('date >=',$from_date.' 00:00:00');
			$this->db->where('date <=',$to_date.' 00:00:00');
		}
		$this->db->group_by('product_id,date,supplier_rate');
		$this->db->order_by('date','desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		
		
		return false;
	}
	
	################## Ssales & Payment Details ####################
	public function sales_payment_actual($supplier_id,$limit,$start_record,$from_date=null,$to_date=null)
	{
		$this->db->select('*');
		$this->db->from('sales_actual');
		$this->db->where('supplier_id',$supplier_id);
		if($from_date!=null AND $to_date!=null)
		{
			$this->db->where('date >',$from_date.' 00:00:00');
			$this->db->where('date <',$to_date.' 00:00:00');
		}
		$this->db->limit($limit, $start_record);
		$this->db->order_by('date');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		
		return false;
	}
################## total sales & payment information ####################
	public function sales_payment_actual_total($supplier_id)
	{
		$this->db->select_sum('sub_total');
		$this->db->from('sales_actual');
		$this->db->where('supplier_id',$supplier_id);
		$this->db->where('sub_total >',0);
		$query = $this->db->get();
		$result=$query->result_array();
		$data[0]["debit"]=$result[0]["sub_total"];
	
		$this->db->select_sum('sub_total');
		$this->db->from('sales_actual');
		$this->db->where('supplier_id',$supplier_id);
		$this->db->where('sub_total <',0);
		$query = $this->db->get();
		$result=$query->result_array();
		$data[0]["credit"]=$result[0]["sub_total"];
		
		$data[0]["balance"]=$data[0]["debit"]+$data[0]["credit"];
		
		return $data;
	}
//To get certain supplier's payment info which was paid day by day
	public function supplier_paid_details($supplier_id)
	{
		$this->db->select('*');
		$this->db->from('supplier_ledger');
		$this->db->where('supplier_id',$supplier_id);
		$this->db->where('chalan_no',NULL);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
    //To get certain supplier's chalan info by which this company got products day by day
	public function supplier_chalan_details($supplier_id)
	{ 
		$this->db->select('*');
		$this->db->from('supplier_ledger');
		$this->db->where('supplier_id',$supplier_id);
		$this->db->where('deposit_no',NULL);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	// Get Company List Data
    public function getPaginatedCompany($limit, $offset, $orderField, $orderDirection, $search, $user_id)
    {   
    	$this->db->distinct();
        $this->db->select('ci.*,ul.user_id, ul.unique_id, ul.username');
        $this->db->from('company_information ci');
        $this->db->join('user_login ul', 'ul.user_id = ci.company_id');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("ci.company_name", $search);
            $this->db->or_like("ci.address", $search);
            $this->db->or_like("ci.mobile", $search);
            $this->db->or_like("ci.website", $search);
            $this->db->group_end();
        }
        $this->db->where('ci.create_by', $user_id);
        $this->db->limit($limit, $offset);
        $this->db->order_by('ci.company_id', $orderDirection);
        $query = $this->db->get();
        if ($query === false) {
            return [];
        }
        return $query->result_array();
    }

    // Get Total Employee List Data
    public function getTotalCompanyListdata($limit, $offset, $search, $user_id, $orderDirection)
	{   
		$this->db->distinct();
	    $this->db->select('ci.*,ul.user_id, ul.unique_id');
        $this->db->from('company_information ci');
        $this->db->join('user_login ul', 'ul.user_id = ci.company_id');
	    
	    if (!empty($search)) {
	        $this->db->group_start(); 
	        $this->db->like("ci.company_name", $search);
            $this->db->or_like("ci.address", $search);
            $this->db->or_like("ci.mobile", $search);
            $this->db->or_like("ci.website", $search);
	        $this->db->group_end(); 
	    }

	    $this->db->where('ci.create_by', $user_id);
	    $this->db->order_by('ci.company_id', $orderDirection);
	    $count = $this->db->count_all_results();

	    return $count; 
	}

}