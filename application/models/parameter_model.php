<?php
class Parameter_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_parameter() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_parameter_group = @$_SESSION['ses_parameter_group'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.parameter_nm LIKE '%$ses_txt_search%' OR a.parameter_val LIKE '%$ses_txt_search%'";
        if($ses_parameter_group != '')  $sql_where .= " AND a.parameter_group LIKE '%$ses_parameter_group%'";
        return $sql_where;
    }

    function paging_parameter($p = 1, $o = 0) {
        $sql_where = $this->where_parameter();
        //
        $sql = "SELECT 
                    COUNT(parameter_id) AS count_data 
                FROM app_parameter a 
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

    function list_parameter($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_parameter();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM app_parameter a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.parameter_group ASC 
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

    function validate_id($parameter_group=null, $parameter_nm=null, $parameter_id=null) {
        $sql = "SELECT a.parameter_id FROM app_parameter a WHERE a.parameter_group='$parameter_group' AND a.parameter_nm='$parameter_nm' AND a.parameter_id='$parameter_id'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_parameter_group() {
        $sql = "SELECT * FROM app_parameter GROUP BY parameter_group";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function get_all_parameter_nm($parameter_group=null) {
        $sql = "SELECT * FROM app_parameter WHERE parameter_group=? GROUP BY parameter_nm ORDER BY parameter_nm ASC";
        $query = $this->db->query($sql, $parameter_group);
        return $query->result_array();
    }

    function get_parameter($parameter_group=null, $parameter_nm=null, $parameter_id=null) {
        $sql = "SELECT * FROM app_parameter WHERE parameter_group='$parameter_group' AND parameter_nm='$parameter_nm' AND parameter_id='$parameter_id'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function insert() {
        $data = $_POST;
        $outp = $this->db->insert('app_parameter', $data);
        return outp_result($outp);
    }

    function update($parameter_group=null, $parameter_nm=null, $parameter_id=null) {
        $data = $_POST;
        $this->db->where('parameter_group', $parameter_group);
        $this->db->where('parameter_nm', $parameter_nm);
        $this->db->where('parameter_id', $parameter_id);
        $outp = $this->db->update('app_parameter', $data);
        return outp_result($outp);
    }

    function delete($parameter_group=null, $parameter_nm=null, $parameter_id=null) {
        $this->db->where('parameter_group', $parameter_group);
        $this->db->where('parameter_nm', $parameter_nm);
        $this->db->where('parameter_id', $parameter_id);
        $outp = $this->db->delete('app_parameter');
        return outp_result($outp,'delete');
    }
    
}
