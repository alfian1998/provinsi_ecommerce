<?php
class Payment_Terms_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_data() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.text LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_data($p = 1, $o = 0) {
        $sql_where = $this->where_data();
        //
        $sql = "SELECT 
                    COUNT(id) AS count_data 
                FROM payment_terms a 
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

    function list_data($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_data();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM payment_terms a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.id ASC 
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

    function get_all_data() {
        $sql = "SELECT 
                    a.* 
                FROM payment_terms a 
                WHERE 1 
                ORDER BY a.id ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $no++;
        }
        return $result;
    }

    function get_data($id=null) {
        $sql = "SELECT * FROM payment_terms WHERE id=?";
        $query = $this->db->query($sql, $id);
        return $query->row_array();
    }

    function count_data() {
        $sql_where = $this->where_data();
        //
        $sql = "SELECT 
                    COUNT(a.id) AS count_data
                FROM payment_terms a 
                WHERE 1 
                    $sql_where ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function insert() {
        $data = $_POST;
        //
        $data['date'] = date('Y-m-d H:i:s');
        //
        $outp = $this->db->insert('payment_terms', $data);
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        //
        $this->db->where('id', $id);
        $outp = $this->db->update('payment_terms', $data);
        return outp_result($outp);
    }

    function delete($id=null) {
        $this->db->where('id', $id);
        $outp = $this->db->delete('payment_terms');
        return outp_result($outp,'delete');
    }
    
}
