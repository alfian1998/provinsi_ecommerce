<?php
class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_user() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_usergroup = @$_SESSION['ses_usergroup'];
        $ses_status = @$_SESSION['ses_status'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.user_name LIKE '%$ses_txt_search%' OR a.user_realname LIKE '%$ses_txt_search%'";
        if($ses_usergroup != '')  $sql_where .= " AND a.user_group = '$ses_usergroup'";
        if($ses_status != '')  $sql_where .= " AND a.user_st = '$ses_status'";
        return $sql_where;
    }

    function where_usergroup() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.usergroup_nm LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function where_customer() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_status = @$_SESSION['ses_status'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.customer_nm LIKE '%$ses_txt_search%' OR a.customer_username LIKE '%$ses_txt_search%'";
        if($ses_status != '')  $sql_where .= " AND a.customer_st = '$ses_status'";
        return $sql_where;
    }

    function paging_user($p = 1, $o = 0) {
        $sql_where = $this->where_user();
        //
        $sql = "SELECT 
                    COUNT(user_id) AS count_data 
                FROM app_user a 
                WHERE 1
                    $sql_where";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '10';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_user($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_user();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.*  
                FROM app_user a 
                LEFT JOIN app_usergroup b ON a.user_group=b.usergroup_id 
                WHERE 1 
                    $sql_where 
                ORDER BY a.user_id ASC 
                    $sql_paging";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $no++;
        }
        return $result;
    }

    function count_user() {
        $sql_where = $this->where_user();
        //
        $sql = "SELECT 
                    COUNT(a.user_id) AS count_data
                FROM app_user a 
                WHERE 1 
                    $sql_where ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function paging_customer($p = 1, $o = 0) {
        $sql_where = $this->where_customer();
        //
        $sql = "SELECT 
                    COUNT(customer_id) AS count_data 
                FROM customer a 
                WHERE 1
                    $sql_where";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '10';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_customer($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_customer();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM customer a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.customer_id ASC 
                    $sql_paging";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $no++;
        }
        return $result;
    }

    function count_customer() {
        $sql_where = $this->where_customer();
        //
        $sql = "SELECT 
                    COUNT(a.customer_id) AS count_data
                FROM customer a 
                WHERE 1 
                    $sql_where ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function paging_usergroup($p = 1, $o = 0) {
        $sql_where = $this->where_usergroup();
        //
        $sql = "SELECT 
                    COUNT(usergroup_id) AS count_data 
                FROM app_usergroup a 
                WHERE 1
                    $sql_where";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '10';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_usergroup($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_usergroup();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM app_usergroup a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.usergroup_id ASC 
                    $sql_paging";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $no++;
        }
        return $result;
    }

    function get_all_usergroup() {
        $sql = "SELECT 
                    a.* 
                FROM app_usergroup a 
                WHERE 1 
                ORDER BY a.usergroup_id ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        foreach($result as $key => $val) {
         
        }
        return $result;
    }

    function count_usergroup() {
        $sql_where = $this->where_usergroup();
        //
        $sql = "SELECT 
                    COUNT(a.usergroup_id) AS count_data
                FROM app_usergroup a 
                WHERE 1 
                    $sql_where ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function get_usergroup($usergroup_id=null) {
        $sql = "SELECT * FROM app_usergroup WHERE usergroup_id=?";
        $query = $this->db->query($sql, $usergroup_id);
        return $query->row_array();
    }

	function get_user($customer_id=null) {
        $sql = "SELECT a.*
                FROM customer a
                WHERE customer_id=?";
        $query = $this->db->query($sql, $customer_id);
        $result = $query->row_array();
        //
        // $result['user_group_name'] = $this->get_user_group($result['user_group']);
        return $result;
    }

    function validate_usergroup_nm($usergroup_nm=null) {
        $sql = "SELECT a.usergroup_id FROM app_usergroup a WHERE a.usergroup_nm=?";
        $query = $this->db->query($sql, $usergroup_nm);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_user_name($user_name=null) {
        $sql = "SELECT a.user_id FROM app_user a WHERE a.user_name=?";
        $query = $this->db->query($sql, $user_name);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_user_realname($user_realname=null) {
        $sql = "SELECT a.user_id FROM app_user a WHERE a.user_realname=?";
        $query = $this->db->query($sql, $user_realname);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_user_administrator($user_id=null) {
        $sql = "SELECT a.*
                FROM app_user a
                WHERE user_id=?";
        $query = $this->db->query($sql, $user_id);
        $result = $query->row_array();
        //
        // $result['user_group_name'] = $this->get_user_group($result['user_group']);
        return $result;
    }

    function get_user_group($id=null) {
        //1:administrator,2:publisher,3:creator
        $str = '';
        if($id == '1') $str = 'Administrator';
        elseif($id == '2') $str = 'Sekolah';
        elseif($id == '3') $str = 'Creator';
        return $str;
    }

    function validate_email($email=null, $customer_id=null) {
        $sql = "SELECT a.customer_id FROM customer a WHERE a.customer_email=? AND a.customer_id !='$customer_id'";
        $query = $this->db->query($sql, $email);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_phone($phone=null) {
        $sql = "SELECT a.customer_id FROM customer a WHERE a.customer_phone=?";
        $query = $this->db->query($sql, $phone);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_username($username=null, $customer_id=null) {
        $sql = "SELECT a.customer_id FROM customer a WHERE a.customer_username=? AND a.customer_id !='$customer_id'";
        $query = $this->db->query($sql, $username);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_username_administrator($username=null, $user_id=null) {
        $sql = "SELECT a.user_id FROM app_user a WHERE a.user_name=? AND a.user_id !='$user_id'";
        $query = $this->db->query($sql, $username);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_customer_nm($customer_nm=null, $customer_id=null) {
        $sql = "SELECT a.customer_id FROM customer a WHERE a.customer_nm=? AND a.customer_id !='$customer_id'";
        $query = $this->db->query($sql, $customer_nm);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_bank_owner($bank_owner=null, $customer_id=null) {
        $sql = "SELECT a.customer_id FROM customer a WHERE a.bank_owner=? AND a.customer_id !=?";
        $query = $this->db->query($sql, array($bank_owner, $customer_id));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert() {
        $data = $_POST;
        $data['customer_password'] = md5(md5(md5(md5(md5($data['customer_password'])))));
        $data['customer_st'] = 1;   
        $data['register_date'] = date('Y-m-d H:i:s');
        $outp = $this->db->insert('customer', $data);
        return $outp;
    }

    function update_administrator($user_id=null) {
        $data = $_POST;
        $this->db->where('user_id', $user_id);
        //
        $c_password_hidden = $data['c_password_hidden'];
        unset($data['c_password_hidden']);
        $data['user_password'] = ($data['user_password'] != '' ? md5(md5(md5(md5(md5($data['user_password']))))) : $c_password_hidden);
        //
        $user_photo = $this->process_file('user_photo','administrator',@$user_id);
        if($user_photo != '') {
            $data['user_photo'] = $user_photo;    
        }        
        $outp = $this->db->update('app_user', $data);
        return $outp;
    }

    function process_file($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        if ($src_file_location == 'administrator') {
            $get_data = $this->get_user_administrator($doc_id);
        }elseif ($src_file_location == 'customer') {
            $get_data = $this->get_user($doc_id);
        }
        // directory file
        $path_dir = "assets/images/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$get_data[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES[$src_file_name]['name']));
        //
        if ($src_file_location == 'administrator') {
            $image_no = md5(md5(@$get_data['user_id']));
        }elseif ($src_file_location == 'customer') {
            $image_no = md5(md5(@$get_data['customer_id']));
        }
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name'], @$get_data[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }

    function insert_usergroup() {
        $data = $_POST;
        //
        $outp = $this->db->insert('app_usergroup', $data);
        return outp_result($outp);
    }

    function update_usergroup($usergroup_id=null) {
        $data = $_POST;
        //
        $this->db->where('usergroup_id', $usergroup_id);
        $outp = $this->db->update('app_usergroup', $data);
        return outp_result($outp);
    }

    function delete_usergroup($usergroup_id=null) {
        $this->db->where('usergroup_id', $usergroup_id);
        $outp = $this->db->delete('app_usergroup');
        return outp_result($outp,'delete');
    }

    function insert_user_administrator() {
        $data = $_POST;
        //password
        $data['user_password'] = md5(md5(md5(md5(md5($data['user_password'])))));
        unset($data['change_password']);
        //upload foto
        $user_photo = $this->process_file('user_photo','administrator');
        if($user_photo != '') {
            $data['user_photo'] = $user_photo;    
        }
        //
        $outp = $this->db->insert('app_user', $data);
        return outp_result($outp);
    }

    function update_user_administrator($user_id=null) {
        $data = $_POST;
        //password
        if(@$data['user_password'] != '') {
            $data['user_password'] = md5(md5(md5(md5(md5($data['user_password'])))));
        }
        unset($data['change_password']);
        //upload foto
        $user_photo = $this->process_file('user_photo','administrator',$user_id);
        if($user_photo != '') {
            $data['user_photo'] = $user_photo;    
        }
        //
        $this->db->where('user_id', $user_id);
        $outp = $this->db->update('app_user', $data);
        return outp_result($outp);
    }

    function delete_user_administrator($user_id=null) {
        $administrator = $this->get_user_administrator($user_id);
        $this->delete_file_process($administrator['user_photo'], 'administrator');
        //
        $this->db->where('user_id', $user_id);
        $outp = $this->db->delete('app_user');
        return outp_result($outp,'delete');
    }

    function delete_customer($customer_id=null) {
        $customer = $this->get_user($customer_id);
        $this->delete_file_process($customer['customer_img'], 'customer');
        //
        $this->db->where('customer_id', $customer_id);
        $outp = $this->db->delete('customer');
        return outp_result($outp,'delete');
    }

    function update_customer($customer_id=null) {
        $data = $_POST;
        //
        $this->db->where('customer_id', $customer_id);
        $outp = $this->db->update('customer', $data);
        return outp_result($outp);
    }

    function delete_image($user_id=null) {
        $user_administrator = $this->get_user_administrator($user_id);
        $this->delete_file_process($user_administrator['user_photo'], 'administrator');
        //
        $data['user_photo'] = '';
        $this->db->where('user_id', $user_id);
        $result = $this->db->update('app_user', $data);
        return $result;
    }

    function delete_file_process($photo=null, $folder_photo=null) {
        $path_dir = "assets/images/".$folder_photo."/";
        $result = unlink($path_dir . $photo);
        return $result;
    }

}