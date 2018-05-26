<?php
class Selling_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_category() {
        $sql = "SELECT a.* 
                FROM category a
                WHERE 1 
                ORDER BY a.category_id ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    function get_all_qty_unit() {
        $sql = "SELECT a.* 
                FROM app_parameter a
                WHERE 1 AND parameter_nm = 'UNIT'
                ORDER BY a.parameter_val ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    function get_parameter() {
        $sql = "SELECT a.* 
                FROM app_parameter a 
                WHERE 1 AND parameter_nm = 'UNIT'
                ORDER BY a.parameter_val ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    function insert() {
        $data = $_POST;   
        //
        $customer_id = $this->session->userdata('ses_customer_id');
        //
        $data_post['customer_id']       = $customer_id;
        $data_post['category_id']       = $data['category_id'];
        $data_post['product_nm']        = $data['product_nm'];
        $data_post['product_desc']      = $data['product_desc'];
        $data_post['product_st']        = 1;
        $data_post['price']             = anti_injection($data['price']);
        $data_post['price_currency']    = 'Rp';
        $data_post['qty']               = $data['qty'];
        $data_post['qty_unit']          = $data['qty_unit'];
        $data_post['post_date']         = date('Y-m-d H:i:s');
        $outp = $this->db->insert('product', $data_post);        
        //
        $product_id = $this->db->insert_id();
        $this->image_model->insert_from_product($product_id);
        //
        return outp_result($outp);
    }

    function update($product_id=null) {
        $data = $_POST;
        //
        $data_post['category_id']       = $data['category_id'];
        $data_post['product_nm']        = $data['product_nm'];
        $data_post['product_desc']      = $data['product_desc'];
        $data_post['product_st']        = $data['product_st'];
        $data_post['price']             = anti_injection($data['price']);
        $data_post['price_before']      = $data['price_before'];
        $data_post['price_currency']    = 'Rp';
        $data_post['qty']               = $data['qty'];
        $data_post['qty_unit']          = $data['qty_unit'];
        // $data_post['post_date']         = date('Y-m-d H:i:s');
        $this->db->where('product_id', $product_id);
        $outp = $this->db->update('product', $data_post);        
        //
        $this->image_model->insert_from_product($product_id,'update');
        //
        return outp_result($outp);
    }

    function delete($product_id=null) {
        $this->db->where('product_id', $product_id);
        $outp = $this->db->delete('product');
        //
        $this->image_model->delete_from_product($product_id);
        //
        return outp_result($outp,'delete');
    }
}
