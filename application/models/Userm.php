<?php

if ( !defined( 'BASEPATH' ) )
exit( 'No direct script access allowed' );

class Userm extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function user_data_get() {
        $this->db->select( '*' );
        $this->db->from( 'user_login' );
        $this->db->where( 'user_id', $this->session->userdata( 'user_id' ) );
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result_array();
    }

    // Delete Company Existing Records
    public function delete_existing_records($company_id)
    {
        $this->db->where('company_id', $company_id);
        $this->db->delete('company_information');

        $this->db->where('company_id', $company_id);
        $this->db->delete('url');
        
        $this->db->where('company_id', $company_id);
        $this->db->delete('url_st');
        
        $this->db->where('company_id', $company_id);
        $this->db->delete('url_lctx');
        
        $this->db->where('company_id', $company_id);
        $this->db->delete('url_sstx');

        $query = $this->db->get_where('company_information', array('company_id' => $company_id));
        if ($query->num_rows() > 0) {
            return false; 
        }
        
        return true; 
    }


    # ===  ===  ===  === Count Company ===  ===  ===  ===  = #
    public function count_user() {
        return $this->db->count_all( 'users' );
    }

    # ===  ===  ===  ===  = User List ===  ===  ===  ===  = #
    public function user_list() 
    {
        $uid = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if (!$uid) {
            log_message('error', 'User ID is not set in session.');
            return [];
        }

        $query = $this->db->where('cid', $uid)->get('user_login');

        if ($query === false) {
            log_message('error', 'Database query failed: ' . $this->db->last_query());
            return [];
        }
        return $query->result_array();
    }


    // Get Company List Data
    public function getPaginatedUsers($limit, $offset, $orderField, $orderDirection, $search, $user_id)
    {   
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('user_login');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("username", $search);
            $this->db->or_like("email_id", $search);
            $this->db->or_like("user_type", $search);
            $this->db->or_like("status", $search);
            $this->db->group_end();
        }
        $this->db->where('cid', $user_id);
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', $orderDirection);
        $query = $this->db->get();
        if ($query === false) {
            return [];
        }
        return $query->result_array();
    }

    // Get Total Employee List Data
    public function getTotalUserListdata($limit, $offset, $search, $user_id, $orderDirection)
    {   
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('user_login');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like("username", $search);
            $this->db->or_like("email_id", $search);
            $this->db->or_like("user_type", $search);
            $this->db->or_like("status", $search);
            $this->db->group_end();
        }
        $this->db->where('cid', $user_id);
        $this->db->order_by('id', $orderDirection);
        $count = $this->db->count_all_results();

        return $count; 
    }

    # ===  ===  ===  ===  == User search list ===  ===  ===  ===  == #
    public function user_search_item( $user_id ) {
        $this->db->select( 'users.*,user_login.user_type' );
        $this->db->from( 'user_login' );
        $this->db->join( 'users', 'users.user_id = user_login.user_id' );
        $this->db->where( 'users.user_id', $user_id );
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->result_array();
        }
        return false;
    }

    # ===  ===  ===  === Insert user to database ===  ===  == #
    public function user_entry( $data ) {
        $users = array(
            'user_id'    => $data[ 'user_id' ],
            'first_name' => $data[ 'first_name' ],
            'last_name'  => $data[ 'last_name' ],
            'logo'       => $data[ 'logo' ],
            'status'     => $data[ 'status' ],
        );
        $this->db->insert( 'users', $users );

        $user_login = array(
            'user_id'   => $data[ 'user_id' ],
            'username'  => $data[ 'email' ],
            'password'  => $data[ 'password' ],
            'user_type' => $data[ 'user_type' ],
            'status'    => $data[ 'status' ],
        );

        $this->db->insert( 'user_login', $user_login );
        $this->db->select( '*' );
        $this->db->from( 'users' );
        $this->db->where( 'status', 1 );

        $query = $this->db->get();
        foreach ( $query->result() as $row ) {
            $json_product[] = array( 'label' => $row->first_name, 'value' => $row->user_id );
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode( $json_product );
        file_put_contents( $cache_file, $productList );
    }

    public function edituser( $id ) {
        return $id;
    }
    # ===  ===  ===  ===  == User edit data ===  ===  ===  ===  === #

    public function retrieve_user_editdata($user_id) 
    {

        $this->db->select("u.*, ul.*");
        $this->db->from('users u');
        $this->db->join('user_login ul', 'ul.unique_id = u.unique_id');
        $this->db->where('u.unique_id', $user_id);   

        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->result_array();
        }
        return false;
    }

    # ===  ===  ===  ===  == Update company ===  ===  ===  ===  ===  === #

    public function update_user( $predata ) {
        $data = array(
            'first_name' => $this->input->post( 'first_name', true ),
            'last_name'  => $this->input->post( 'last_name', true ),
            'logo'       => ( !empty( $predata[ 'logo' ] )?$predata[ 'logo' ]:$this->input->post( 'old_logo' ) ),
            'status'     => $this->input->post( 'status', true )
        );

        $this->db->where( 'user_id', $predata[ 'user_id' ] );
        $this->db->update( 'users', $data );
        $password = $this->input->post( 'password' );

        $user_login = array(
            'username' => $this->input->post( 'username' ),
            'password' => ( !empty( $password )?md5( 'gef' . $this->input->post( 'password' ) ):$this->input->post( 'old_password' ) ),
            'status'   => $this->input->post( 'status', true ),
        );
        $this->db->where( 'user_id', $predata[ 'user_id' ] );
        $this->db->update( 'user_login', $user_login );

        $this->db->select( '*' );
        $this->db->from( 'users' );
        $this->db->where( 'status', 1 );
        $query = $this->db->get();
        foreach ( $query->result() as $row ) {
            $json_product[] = array( 'label' => $row->first_name, 'value' => $row->user_id );
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode( $json_product );
        file_put_contents( $cache_file, $productList );
        return true;
    }

    # ===  ===  ===  == Delete user item ===  ===  == #

    public function deleteUser($user_id) {

        $this->db->where('unique_id', $user_id );
        $this->db->delete('users' );

        $this->db->where('unique_id', $user_id );
        $this->db->delete('user_login' );

        return true;
    }

    public function delete_user( $user_id ) {
        $this->db->where( 'unique_id', $user_id );
        $this->db->delete( 'users' );

        $this->db->where( 'unique_id', $user_id );
        $this->db->delete( 'user_login' );

        $this->db->select( '*' );
        $this->db->from( 'users' );
        $this->db->where( 'status', 1 );
        $this->db->where( 'user_id', $_SESSION[ 'user_id' ] );
        $query = $this->db->get();
        foreach ( $query->result() as $row ) {
            $json_product[] = array( 'label' => $row->first_name, 'value' => $row->user_id );
        }
        $cache_file = './my-assets/js/admin_js/json/user.json';
        $productList = json_encode( $json_product );
        file_put_contents( $cache_file, $productList );
        return true;
    }

    public function getDatas($tbl, $select, $where) {
        return $this->db->select($select)->from($tbl)->where($where)->get()->result_array();
    }

    public function insertData($tbl, $data) {
        $insert = $this->db->insert($tbl, $data);
        return $this->db->insert_id();
    }

    public function updateData($tbl, $data, $where) {
        $this->db->set($data)->where($where)->update($tbl);
        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

}
