<?php
class Bank_Account_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_bank_account() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.no_rek LIKE '%$ses_txt_search%' OR a.bank_address LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_bank_account($p = 1, $o = 0) {
        $sql_where = $this->where_bank_account();
        //
        $sql = "SELECT 
                    COUNT(bank_account_id) AS count_data 
                FROM bank_account a 
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

    function list_bank_account($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_bank_account();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.* 
                FROM bank_account a 
                LEFT JOIN mst_bank b ON a.bank_id=b.bank_id 
                WHERE 1 
                    $sql_where 
                ORDER BY a.bank_account_id ASC 
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

    function get_all_bank_account() {
        $sql = "SELECT 
                    a.*, b.* 
                FROM bank_account a 
                LEFT JOIN mst_bank b ON a.bank_id=b.bank_id 
                WHERE 1 
                ORDER BY a.bank_account_id ASC ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $no++;
        }
        return $result;
    }

    function get_bank_account($bank_account_id=null) {
        $sql = "SELECT * FROM bank_account WHERE bank_account_id=?";
        $query = $this->db->query($sql, $bank_account_id);
        return $query->row_array();
    }

    function count_bank_account() {
        $sql_where = $this->where_bank_account();
        //
        $sql = "SELECT 
                    COUNT(a.bank_account_id) AS count_data
                FROM bank_account a 
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
        $outp = $this->db->insert('bank_account', $data);
        return outp_result($outp);
    }

    function update($bank_account_id=null) {
        $data = $_POST;
        //
        $this->db->where('bank_account_id', $bank_account_id);
        $outp = $this->db->update('bank_account', $data);
        return outp_result($outp);
    }

    function delete($bank_account_id=null) {
        $this->db->where('bank_account_id', $bank_account_id);
        $outp = $this->db->delete('bank_account');
        return outp_result($outp,'delete');
    }
    
}
