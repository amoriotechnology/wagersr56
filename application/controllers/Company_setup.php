<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company_setup extends CI_Controller {
	
	public $company_id;
	function __construct() {
      parent::__construct(); 
      $this->db->query('SET SESSION sql_mode = ""');
		$this->load->library('auth');
		$this->load->library('lcompany');
		$this->load->library('session');
		$this->load->model('Companies');
		$this->auth->check_admin_auth();

    }
    #==============Company page load===========#
	public function index()
	{
		$content = $this->lcompany->company_add_form();
		$this->template->full_admin_html_view($content);
	}
	#===============Company Search Item===========#
	public function company_search_item()
	{	
		$company_id = $this->input->post('company_id');
        $content = $this->lcompany->company_search_item($company_id);
		$this->template->full_admin_html_view($content);
	}


	#===============Companybranch===========#
	public function company_branch()
	{	
        $content = $this->lcompany->company_branch_total();
		$this->template->full_admin_html_view($content);
	}


	#================Manage Company==============#
	public function manage_company() 
	{
       $id = isset($_GET['id']) ? $_GET['id'] : '';
       $admin_id = isset($_GET['admin_id']) ? $_GET['admin_id'] : '';
       $decodedId = decodeBase64UrlParameter($id);
       $companyLists = $this->Companies->company_info($decodedId);
       $content = $this->parser->parse('company/company', $companyLists, true);
        $this->template->full_admin_html_view($content);
    }

	#===============Company update form================#
	public function company_update_form()
	{	
		$company_id = $_GET['company_id'];
		$content = $this->lcompany->company_edit_data($company_id);
		$this->template->full_admin_html_view($content);
	}

	// Compnay listing Function
	public function companyLists() 
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
        $totalItems     = $this->Companies->getTotalCompanyListdata($limit, $start, $search, $decodedId, $orderDirection);
        $items          = $this->Companies->getPaginatedCompany($limit, $start, $orderField, $orderDirection, $search, $decodedId);
        $data           = [];
        $i              = $start + 1;
        foreach ($items as $item) { 

            $edit = '<a href="' . base_url("Company_setup/company_update_form?id=" . $encodedId . "&admin_id=" . $encodedAdmin . "&company_id=" . $item["company_id"]) . '" class="btnclr btn m-b-5 m-r-2" data-toggle="tooltip" data-placement="left" title="" data-original-title="Update"><i class="fa fa-pencil" aria-hidden="true"></i></a>';

            $company_id   = encodeBase64UrlParameter($item['company_id']);
            $admin_id   = encodeBase64UrlParameter($item['unique_id']);

            $redirect = '<a href="' . base_url("chrm/manage_employee?id=" . $company_id . "&admin_id=" . $admin_id) . '" class="btnclr btn m-b-5 m-r-2" data-toggle="tooltip" data-placement="left" title="Hr" data-original-title="Hr" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>';

            $row     = [
                "company_id"             => $i,
                "username"           => $item['username'],
                "company_name"           => $item['company_name'],
                "address"                => $item['address'],
                "mobile"                 => $item['mobile'],
                "website"                => $item['website'],
                'action'                 => $edit . " " . $redirect,
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

	#===============Company update===================#
public function company_update()
{
	$CI = & get_instance();
	$CI->load->model('Web_settings');
	$setting_detail = $CI->Web_settings->retrieve_setting_editdata();
	$company_id  = $this->input->post('company_id',true);
	$url = $CI->Companies->editurldata($company_id);
	$url_st = $CI->Companies->editurlstdata($company_id);
	$url_lctx = $CI->Companies->editurllctxdata($company_id);
	$url_sstx = $CI->Companies->editurlsstxdata($company_id);
	$data=array(
		'company_id' 	=> $company_id,
		'company_name'  => $this->input->post('company_name',true),
		
		'email' 		=> $this->input->post('email',true),
		'address' 		=> $this->input->post('address',true),
		'mobile' 		=> $this->input->post('mobile',true),
		'website' 		=> $this->input->post('website',true),
		'Bank_Name'      => $this->input->post('Bank_Name',true),
		'Account_Number'      => $this->input->post('Account_Number',true),
		'Bank_Routing_Number'      => $this->input->post('Bank_Routing_Number',true),
		'Bank_Address'      => $this->input->post('Bank_Address',true),
		'Federal_Pin_Number'      => $this->input->post('Federal_Pin_Number',true),
		'url'      => $this->input->post('url',true),
		'url_st'      => $this->input->post('url_st',true),
		'url_lctx'      => $this->input->post('url_lctx',true),
		'url_sstx'      => $this->input->post('url_sstx',true),
		'st_tax_id'      => $this->input->post('statetx',true),
		'lc_tax_id'      => $this->input->post('localtx',true),
		'State_Sales_Tax_Number'      => $this->input->post('State_Sales_Tax_Number',true),
		'status' 	    => 1
		);
		// echo $this->db->last_query();die();
		// print_r($data); die();
	$this->Companies->update_company($data,$company_id);
	$this->session->set_userdata(array('message'=>display('successfully_updated')));
	redirect(base_url('Company_setup/manage_company'));
}		
}