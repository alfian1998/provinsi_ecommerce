<?php
class Customer_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_customer($customer_id) {
        $sql = "SELECT a.* 
                FROM customer a
                WHERE 1 AND a.customer_id=?";
        $query = $this->db->query($sql, $customer_id);
        $row = $query->row_array();
        //
        return $row;
    }

    function get_customer_complete($customer_id) {
        $sql = "SELECT a.*, b.nama AS provinsi_nm, c.nama AS kabupaten_nm, d.nama AS kecamatan_nm, e.nama AS kelurahan_nm  
                FROM customer a
                LEFT JOIN mst_provinsi b ON a.customer_provinsi=b.id_prov
                LEFT JOIN mst_kabupaten c ON a.customer_kabupaten=c.id_kab
                LEFT JOIN mst_kecamatan d ON a.customer_kecamatan=d.id_kec
                LEFT JOIN mst_kelurahan e ON a.customer_kelurahan=e.id_kel 
                WHERE 1 AND a.customer_id=?";
        $query = $this->db->query($sql, $customer_id);
        $row = $query->row_array();
        //
        return $row;
    }

    function validate_account($customer_id) {
        $sql = "SELECT a.customer_id 
                FROM customer a 
                WHERE (a.customer_img IS NULL 
                        OR a.customer_phone IS NULL 
                        OR a.customer_sex IS NULL
                        OR a.customer_img ='' 
                        OR a.customer_phone ='' 
                        OR a.customer_sex ='') 
                    AND a.customer_id=?";
        $query = $this->db->query($sql, $customer_id);
        $row = $query->row_array();
        //
        return $row;
    }

    function validate_address($customer_id) {
        $sql = "SELECT a.customer_id 
                FROM customer a 
                WHERE (a.customer_provinsi IS NULL 
                        OR a.customer_kabupaten IS NULL 
                        OR a.customer_kecamatan IS NULL
                        OR a.customer_kelurahan IS NULL
                        OR a.customer_kodepos IS NULL
                        OR a.customer_address IS NULL
                        OR a.customer_provinsi ='' 
                        OR a.customer_kabupaten ='' 
                        OR a.customer_kecamatan =''
                        OR a.customer_kelurahan =''
                        OR a.customer_kodepos =''
                        OR a.customer_address ='') 
                    AND a.customer_id=?";
        $query = $this->db->query($sql, $customer_id);
        $row = $query->row_array();
        //
        return $row;
    }

    function validate_bank_account($customer_id) {
        $sql = "SELECT a.customer_id 
                FROM customer a 
                WHERE (a.bank_id IS NULL 
                        OR a.bank_owner IS NULL 
                        OR a.bank_no_rek IS NULL
                        OR a.bank_id ='' 
                        OR a.bank_owner ='' 
                        OR a.bank_no_rek ='') 
                    AND a.customer_id=?";
        $query = $this->db->query($sql, $customer_id);
        $row = $query->row_array();
        //
        return $row;
    }

    function delete_image($customer_id=null) {
        $customer = $this->get_customer($customer_id);
        $this->delete_file_process($customer['customer_img']);
        //
        $data['customer_img'] = '';
        $this->db->where('customer_id', $customer_id);
        $result = $this->db->update('customer', $data);
        return $result;
    }

    function delete_file_process($customer_img=null) {
        $path_dir = "assets/images/customer/";
        $result = unlink($path_dir . $customer_img);
        return $result;
    }

    function update($customer_id = "") {
        $data = $_POST;
        //
        $data_change['customer_username'] = $data['customer_username'];
        $data_change['customer_nm'] = $data['customer_nm'];
        $data_change['customer_email'] = $data['customer_email'];
        $data_change['customer_phone'] = $data['customer_phone'];
        $data_change['customer_sex'] = $data['customer_sex'];
        //
        if(@$data['customer_password'] != '') {
            $data_change['customer_password'] = md5(md5(md5(md5(md5($data['customer_password'])))));
        }
        //
        $customer_img = $_FILES['customer_img']['name'];
        if ($customer_img != '') {
            $data_change['customer_img'] = $this->process_file('customer_img','customer',@$customer_id);
        }
        //
        $this->db->where('customer_id', $customer_id);
        $outp = $this->db->update('customer',$data_change);
        return outp_result($outp);
    }

    function update_address($customer_id = "") {
        $data = $_POST;
        //
        $data_change['customer_provinsi'] = $data['customer_provinsi'];
        $data_change['customer_kabupaten'] = $data['customer_kabupaten'];
        $data_change['customer_kecamatan'] = $data['customer_kecamatan'];
        $data_change['customer_kelurahan'] = $data['customer_kelurahan'];
        $data_change['customer_kodepos'] = $data['customer_kodepos'];
        $data_change['customer_address'] = $data['customer_address'];
        //
        $this->db->where('customer_id', $customer_id);
        $outp = $this->db->update('customer',$data_change);
        return outp_result($outp);
    }

    function update_bank_account($customer_id = "") {
        $data = $_POST;
        //
        $data_change['bank_id'] = $data['bank_id'];
        $data_change['bank_owner'] = $data['bank_owner'];
        $data_change['bank_no_rek'] = $data['bank_no_rek'];
        //
        $this->db->where('customer_id', $customer_id);
        $outp = $this->db->update('customer',$data_change);
        return outp_result($outp);
    }

    function process_file($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $customer = $this->get_customer($doc_id);
        // directory file
        $path_dir = "assets/images/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$customer[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES[$src_file_name]['name']));
        //
        $image_no = md5(md5(@$customer['category_id']));
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name'], @$customer[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }

}
