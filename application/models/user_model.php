<?php
class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
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

}