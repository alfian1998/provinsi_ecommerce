<?php
class Bank_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_bank() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.bank_nm LIKE '%$ses_txt_search%' OR a.bank_short_nm LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_bank($p = 1, $o = 0) {
        $sql_where = $this->where_bank();
        //
        $sql = "SELECT 
                    COUNT(bank_id) AS count_data 
                FROM mst_bank a 
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

    function list_bank($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_bank();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_bank a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.bank_id ASC 
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

    function get_all_bank() {
        $sql = "SELECT 
                    a.* 
                FROM mst_bank a 
                WHERE 1 
                ORDER BY a.bank_id ASC";
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

    function get_bank($bank_id=null) {
        $sql = "SELECT * FROM mst_bank WHERE bank_id=?";
        $query = $this->db->query($sql, $bank_id);
        return $query->row_array();
    }

    function count_bank() {
        $sql_where = $this->where_bank();
        //
        $sql = "SELECT 
                    COUNT(a.bank_id) AS count_data
                FROM mst_bank a 
                WHERE 1 
                    $sql_where ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function validate_bank_nm($bank_nm=null) {
        $sql = "SELECT a.bank_id FROM mst_bank a WHERE a.bank_nm=?";
        $query = $this->db->query($sql, $bank_nm);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert() {
        $data = $_POST;
        //
        $data['post_date'] = date('Y-m-d H:i:s');
        //
        $outp = $this->db->insert('mst_bank', $data);
        return outp_result($outp);
    }

    function update($bank_id=null) {
        $data = $_POST;
        //
        $data['update_date'] = date('Y-m-d H:i:s');
        //
        $this->db->where('bank_id', $bank_id);
        $outp = $this->db->update('mst_bank', $data);
        return outp_result($outp);
    }

    function delete($bank_id=null) {
        $this->db->where('bank_id', $bank_id);
        $outp = $this->db->delete('mst_bank');
        return outp_result($outp,'delete');
    }
    
}
