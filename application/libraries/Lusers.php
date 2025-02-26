<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lusers {
    #==============user list================#

    public function user_list() {
        $CI = & get_instance();
        
        $CI->load->model('Web_settings');

        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();

        $user_list = $CI->Userm->user_list();

        $user_data_get = $CI->Userm->user_data_get();

        $i = 0;
       
        if (!empty($user_list)) {
            foreach ($user_list as $k => $v) {
                $i++;
                $user_list[$k]['sl'] = $i;
            }
        }
        $data = array(
            'title'     => display('manage_users'),
            'user_list' => $user_list,
            'user_data_get'=> $user_data_get,
            'setting_detail'=> $setting_detail,
         );
        $userList = $CI->parser->parse('users/user', $data, true);
        return $userList;
    }

    public function edit_user($id)
    {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $user = $CI->Userm->edituser($id);
        echo $user;
        exit;
    }   

    public function ad_user()
    {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $CI->load->model('Web_settings');
        $setting_detail = $CI->Web_settings->retrieve_setting_editdata();
        $get_employee_data = $CI->Web_settings->get_employee_data();
        $data = array(
            'title' => display('manage_users'),
            'setting_detail' => $setting_detail,
            'get_employee_data' => $get_employee_data
        );
        $userForm = $CI->parser->parse('users/ad_user_form', $data, true);
        return $userForm;
    }




    #=============User Search item===============#

    public function user_search_item($user_id) {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $user_list = $CI->Userm->user_search_item($user_id);
        $i = 0;
        foreach ($user_list as $k => $v) {
            $i++;
            $user_list[$k]['sl'] = $i;
        }
        $data = array(
            'title'     => display('manage_users'),
            'user_list' => $user_list
        );
        $userList = $CI->parser->parse('users/user', $data, true);
        return $userList;
    }



   
    #==============User add form===========#
 
    public function index($cid = "") {
        $CI = & get_instance();
        $CI->load->model('Userm');
        
        $data = array(
            'title' => display('manage_users')
        );
        if(!empty($cid)) {
            $data['cmpy_record'] = $CI->Userm->getDatas('company_information' , '*', ['company_id ' => $cid]);
            $data['user_record'] = $CI->Userm->getDatas('user_login' , '*', ['cid ' => $cid]);
        }

        $userForm = $CI->parser->parse('users/add_user_form', $data, true);
        return $userForm;
    }


    public function useraddforms() {
        $CI = & get_instance();
          $CI->load->model('Companies');
         $cl=$CI->Companies->company_list();
        
            $data['company_info']=$cl;

        $data = array(
            'title' => display('manage_users'),
            'company_info'=>$cl,
        );
        $userForm = $CI->parser->parse('users/add_admin', $data, true);
        return $userForm;
    }

     #==============User edit form===========#

    public function company_edit_form($data) {
           $CI = & get_instance();
      
        $userForm = $CI->parser->parse('user/edit_company_form', $data, true);
        return $userForm;
    }

    //  public function manage_company() {
    //     $CI = & get_instance();
    //     $CI->load->model('Companies');
    //     $cl=$CI->Companies->company_list();
        
    //         $data['company_info']=$cl;
        
    //     $userForm = $CI->parser->parse('users/mange_company',$data, true);
    //     return $userForm;
    // }

    #================Insert user==========#

    public function insert_user($data) {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $CI->Userm->user_entry($data);
        return true;
    }

    #===============User edit form==============#


    public function user_add_form1() {
        $CI = & get_instance();
          $CI->load->model('Companies');
         $cl=$CI->Companies->company_list();
        
            $data['company_info']=$cl;

        $data = array(
            'title' => display('manage_users'),
            'company_info'=>$cl,
        );
        $userForm = $CI->parser->parse('users/add_admin', $data, true);
        return $userForm;
    }

    public function user_edit_data($id) {
        $CI = & get_instance();
        $CI->load->model('Userm');
        $CI->load->model('Web_settings');
        $user_detail = $CI->Userm->retrieve_user_editdata($id);
        $get_employee_data = $CI->Web_settings->get_employee_data();
        $data = array(
            'title'      => display('user_edit'),
            'userList'   => $user_detail,
            'get_employee_data' => $get_employee_data
        );

        $companyList = $CI->parser->parse('users/edit_users', $data, true);
        return $companyList;
    }


public function addusers()
{
    $CI=   $CI = & get_instance();
    $data=array(
        'title'=>'we',
        );  
     $userList = $CI->parser->parse('users/aduserform', $data, true);
        return $userList;
    
}
}

?>