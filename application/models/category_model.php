<?php
class Category_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_category() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_category_parent = @$_SESSION['ses_category_parent'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.category_nm LIKE '%$ses_txt_search%'";
        if($ses_category_parent != '')  $sql_where .= " AND a.category_parent = '$ses_category_parent'";
        return $sql_where;
    }

    function paging_category($p = 1, $o = 0) {
        $sql_where = $this->where_category();
        //
        $sql = "SELECT 
                    COUNT(category_id) AS count_data 
                FROM category a 
                WHERE 1 AND a.category_parent!='' 
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

    function list_category($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_category();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM category a 
                WHERE 1 AND a.category_parent!='' 
                    $sql_where 
                ORDER BY a.category_id ASC 
                    $sql_paging";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $result[$key]['cek_category'] = $this->cek_category($val['category_id']);
            $no++;
        }
        return $result;
    }

    function list_category_no_paging() {
        $sql = "SELECT 
                    a.* 
                FROM category a 
                WHERE 1 AND a.category_parent!='' AND category_st='1'
                ORDER BY a.category_id ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function list_category_rand() {
        $sql = "SELECT 
                    a.* 
                FROM category a 
                WHERE 1 AND a.category_parent!='' AND category_st='1'
                ORDER BY rand() LIMIT 7 ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function cek_category($category_id=null) {
        $sql = "SELECT 
                    a.product_id 
                FROM product a 
                WHERE 1 AND a.category_id=?";
        $query = $this->db->query($sql, $category_id);
        $result = $query->row_array();
        // 
        return $result;
    }

    function get_last_category_id($category_id=null) {
        $sql = "SELECT 
                    a.category_id 
                FROM category a 
                WHERE 1 AND a.category_parent=?
                ORDER BY a.category_id DESC LIMIT 1";
        $query = $this->db->query($sql, $category_id);
        $result = $query->row_array();
        // 
        return $result['category_id']+1;
    }

    function get_category_parent_last_category_id() {
        $sql = "SELECT 
                    a.category_parent 
                FROM category a 
                WHERE 1
                ORDER BY a.category_id DESC LIMIT 1";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['category_parent']+1;
    }

    function count_category() {
        $sql_where = $this->where_category();
        //
        $sql = "SELECT 
                    COUNT(a.category_id) AS count_data
                FROM category a 
                WHERE 1 AND a.category_parent!=''
                    $sql_where ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function list_category_parent() {
        $sql = "SELECT 
                    a.* 
                FROM category a 
                WHERE 1 AND a.category_parent='' 
                ORDER BY a.category_id ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['list_category_by_parent'] = $this->list_category_by_parent($val['category_id']);
            $no++;
        }
        return $result;
    }

    function list_category_by_parent($category_id=null) {
        $sql = "SELECT 
                    a.* 
                FROM category a 
                WHERE 1 AND a.category_parent!='' AND a.category_st='1' AND a.category_parent=?
                ORDER BY a.category_id ASC ";
        $query = $this->db->query($sql, $category_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function count_product_by_parent($category_id=null) {
        $sql = "SELECT 
                    COUNT(a.product_id) AS count_data
                FROM product a 
                LEFT JOIN category b ON a.category_id=b.category_id 
                WHERE 1 AND b.category_parent=?";
        $query = $this->db->query($sql, $category_id);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function get_category($category_id=null) {
        $sql = "SELECT a.*
                FROM category a
                WHERE a.category_id = '$category_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        return $row;
    }

    function get_category_parent($category_id=null) {
        $sql = "SELECT a.*
                FROM category a
                WHERE a.category_id = '$category_id'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        return $row;
    }

    function insert() {
        $data = $_POST;
        //
        $data['category_st'] = 1;
        //
        $outp = $this->db->insert('category', $data);
        return outp_result($outp);
    }

    function update($category_id=null) {
        $data = $_POST;
        //
        $data['category_parent'] = $data['category_parent'];
        //
        $this->db->where('category_id', $category_id);
        $outp = $this->db->update('category', $data);
        return outp_result($outp);
    }

    function delete($category_id=null) {
        $this->db->where('category_id', $category_id);
        $outp = $this->db->delete('category');
        return outp_result($outp,'delete');
    }
    
}
