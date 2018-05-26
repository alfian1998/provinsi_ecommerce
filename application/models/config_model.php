<?php
class Config_model extends CI_Model {

    function __construct() {
        parent::__construct();
        //
        // session_start();
        //
        $this->load->model('image_model');
        $this->load->model('input_model');
    }

    function general() {
        $header['config']   = $this->get_config();
        $header['profile']  = $this->get_profile_user_login();
        return $header;
    }

    function get_config() {
        $sql = "SELECT * FROM app_config";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        // $row['max_upload_size'] = '500000'; // 500Kb
        // $row['max_upload_size_str'] = 'maksimal 500Kb'; 
        return $row;
    }

    function update_config($act = "") {
        $data = $_POST;
        //
        $outp = $this->db->update('app_config',$data);
        return outp_result($outp);
    }

    function get_profile_user_login() {
        $this->load->model('user_model');
        //
        $customer_id = $this->session->userdata('ses_customer_id');
        $user_id = $this->session->userdata('ses_user_id');
        if($customer_id != '') {
            $get_user = $this->user_model->get_user($customer_id);
            return $get_user;
        }elseif($user_id != '') {
            $get_user = $this->user_model->get_user_administrator($user_id);
            return $get_user;
        } else {
            return array();
        }
    }

    function validate_login() {
        $ses_login = $this->session->userdata('ses_login');        
        if($ses_login != 1) {
            redirect('login');
        }
    }

    function validate_login_administrator() {
        $ses_login_administrator = $this->session->userdata('ses_login_administrator');        
        if($ses_login_administrator != 1) {
            redirect('webmin');
        }
    }

    function auth_login($e=null, $p=null, $is_data=null) {
        $sql = "SELECT * FROM customer WHERE (customer_email='$e' OR customer_username='$e') AND customer_password=? AND customer_st='1'";
        $query = $this->db->query($sql, array(md5(md5(md5(md5(md5($p)))))));
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            //
            if($row['customer_st'] == '0') {    // not-active
                return '2';
            } else {
                $this->set_login($row['customer_id']);
                //
                $ses_data = array(
                    'ses_login'                => 1,
                    'ses_customer_id'          => $row['customer_id'],
                    'ses_customer_nm'          => $row['customer_nm'],
                    'ses_customer_chat_nm'     => $row['customer_chat_nm'],
                    'ses_customer_address'     => $row['customer_address'],
                    'ses_customer_phone'       => $row['customer_phone'],
                    'ses_customer_email'       => $row['customer_email'],
                    'ses_customer_username'    => $row['customer_username'],
                    'ses_customer_sex'         => $row['customer_sex'],
                    'ses_customer_st'          => $row['customer_st'],
                    'ses_customer_img'         => $row['customer_img'],
                    'ses_register_date'        => $row['register_date'],
                );
                $this->session->set_userdata($ses_data);
                //
                $_SESSION['ses_customer_chat_nm'] = $row['customer_chat_nm'];
                //            
                return '1';
            }            
        } else {
            return '0';
        }
    }

    function auth_login_administrator($u=null, $p=null, $is_data=null) {
        $sql = "SELECT * FROM app_user WHERE user_name=? AND user_password=? AND user_st='1'";
        $query = $this->db->query($sql, array($u, md5(md5(md5(md5(md5($p)))))));
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            //
            if($row['user_st'] == '0') {    // not-active
                return '2';
            } else {
                $this->set_login_administrator($row['user_id']);
                //
                $ses_data = array(
                    'ses_login_administrator'   => 1,
                    'ses_user_id'               => $row['user_id'],
                    'ses_user_name'             => $row['user_name'],
                    'ses_user_realname'         => $row['user_realname'],
                    'ses_user_st'               => $row['user_st'],
                    'ses_user_photo'            => $row['user_photo'],
                    'ses_user_group'            => $row['user_group'],
                );
                $this->session->set_userdata($ses_data);
                //            
                return '1';
            }            
        } else {
            return '0';
        }
    }

    function reg_login($u=null, $p=null, $is_data=null) {
        $sql = "SELECT * FROM customer WHERE customer_username=? AND customer_password=? AND customer_st='1'";
        $query = $this->db->query($sql, array($u,  md5(md5(md5(md5(md5($p)))))));
        if($query->num_rows() > 0) {
            $row = $query->row_array();
            //
            if($row['customer_st'] == '0') {    // not-active
                return '2';
            } else {
                $this->set_login($row['customer_id']);
                //
                $ses_data = array(
                    'ses_login'                => 1,
                    'ses_customer_id'          => $row['customer_id'],
                    'ses_customer_nm'          => $row['customer_nm'],
                    'ses_customer_chat_nm'     => $row['customer_chat_nm'],
                    'ses_customer_address'     => $row['customer_address'],
                    'ses_customer_phone'       => $row['customer_phone'],
                    'ses_customer_email'       => $row['customer_email'],
                    'ses_customer_username'    => $row['customer_username'],
                    'ses_customer_sex'         => $row['customer_sex'],
                    'ses_customer_st'          => $row['customer_st'],
                    'ses_customer_img'         => $row['customer_img'],
                    'ses_register_date'        => $row['register_date'],
                );
                $this->session->set_userdata($ses_data);
                //            
                return '1';
            }            
        } else {
            return '0';
        }
    }

    function set_login($customer_id) {
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE customer SET last_login='$now' WHERE customer_id=?";
        return $this->db->query($sql, $customer_id);
    }

    function set_login_administrator($user_id) {
        $sql = "UPDATE app_user SET st_login='1',last_login=now() WHERE user_id=?";
        return $this->db->query($sql, $user_id);
    }
}
