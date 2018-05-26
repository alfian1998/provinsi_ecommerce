<?php
class Produk_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function list_produk() {
    	$sql = "SELECT 
                    a.* 
                FROM product a 
                WHERE 1 
                ORDER BY a.product_id ASC ";
    	$query = $this->db->query($sql);
    	$result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['first_image'] = $this->get_first_image($val['product_id']);
            $no++;
        }
    	return $result;
    }

    function paging_data($p = 1, $o = 0) {
        // $sql_where = $this->where_sinyal();
        //
        $sql = "SELECT 
                    COUNT(product_id) AS count_data 
                FROM product a 
                WHERE 1";
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

    function list_data($o = 0, $offset = 0, $limit = 100) {
        // $sql_where = $this->where_sinyal();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM product a 
                WHERE 1 
                ORDER BY a.product_id ASC 
                    $sql_paging";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $result[$key]['first_image'] = $this->get_first_image($val['product_id']);
            $no++;
        }
        return $result;
    }

    function get_data($product_id=null) {
        $sql = "SELECT 
                    a.*
                FROM product a 
                WHERE a.product_id=?";
        $query = $this->db->query($sql, $product_id);
        $result = $query->row_array();
        //
        $result['product_image'] = $this->image_model->get_image_by_product($result['product_id']);        
        //
        return $result;
    }

    function get_first_image($product_id=null) {
        $sql = "SELECT 
                    b.image_name 
                FROM product_image b 
                WHERE b.product_id=?
                ORDER BY b.image_id ASC LIMIT 1";
        $query = $this->db->query($sql, $product_id);
        $result = $query->row_array();
        return $result;
    }
}
