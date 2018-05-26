<?php
class Region_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_provinsi() {
        $ses_txt_search_provinsi = @$_SESSION['ses_txt_search_provinsi'];
        //
        $sql_where = "";
        if($ses_txt_search_provinsi != '')  $sql_where .= " AND a.id_prov LIKE '%$ses_txt_search_provinsi%' OR a.nama LIKE '%$ses_txt_search_provinsi%'";
        return $sql_where;
    }

    function where_kabupaten($id_prov=null) {
        $ses_txt_search_kabupaten = @$_SESSION['ses_txt_search_kabupaten'];
        //
        $sql_where = "";
        if($ses_txt_search_kabupaten != '')  $sql_where .= " AND a.id_kab LIKE '%$ses_txt_search_kabupaten%' OR a.nama LIKE '%$ses_txt_search_kabupaten%' AND a.id_prov='$id_prov'";
        return $sql_where;
    }

    function where_kecamatan($id_kab=null) {
        $ses_txt_search_kecamatan = @$_SESSION['ses_txt_search_kecamatan'];
        //
        $sql_where = "";
        if($ses_txt_search_kecamatan != '')  $sql_where .= " AND a.id_kec LIKE '%$ses_txt_search_kecamatan%' OR a.nama LIKE '%$ses_txt_search_kecamatan%' AND a.id_kab='$id_kab'";
        return $sql_where;
    }

    function where_kelurahan($id_kec=null) {
        $ses_txt_search_kelurahan = @$_SESSION['ses_txt_search_kelurahan'];
        //
        $sql_where = "";
        if($ses_txt_search_kelurahan != '')  $sql_where .= " AND a.id_kel LIKE '%$ses_txt_search_kelurahan%' OR a.nama LIKE '%$ses_txt_search_kelurahan%' AND a.id_kec='$id_kec'";
        return $sql_where;
    }

    function list_address_provinsi() {
        $sql = "SELECT 
                    a.* 
                FROM mst_provinsi a 
                WHERE 1 AND id_prov='33'";
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

    function list_all_provinsi() {
        $sql = "SELECT 
                    a.* 
                FROM mst_provinsi a 
                WHERE 1 ";
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

    function list_address_kabupaten() {
        $sql = "SELECT 
                    a.* 
                FROM mst_kabupaten a 
                WHERE 1 AND a.id_prov='33'";
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

    function paging_provinsi($p = 1, $o = 0) {
        $sql_where = $this->where_provinsi();
        //
        $sql = "SELECT 
                    COUNT(a.id_prov) AS count_data 
                FROM mst_provinsi a 
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

    function list_provinsi($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_provinsi();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_provinsi a 
                WHERE 1
                    $sql_where 
                ORDER BY a.id_prov ASC 
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

    function count_provinsi() {
        $sql_where = $this->where_provinsi();
        //
        $sql = "SELECT 
                    COUNT(a.id_prov) AS count_data
                FROM mst_provinsi a 
                WHERE 1
                    $sql_where ";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function paging_kabupaten($p = 1, $o = 0, $id_prov = null) {
        $sql_where = $this->where_kabupaten($id_prov);
        //
        $sql = "SELECT 
                    COUNT(a.id_kab) AS count_data 
                FROM mst_kabupaten a 
                WHERE 1 AND id_prov=?
                    $sql_where";
        $query = $this->db->query($sql, $id_prov);
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

    function list_kabupaten($o = 0, $offset = 0, $limit = 100, $id_prov = null) {
        $sql_where = $this->where_kabupaten($id_prov);
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_kabupaten a 
                WHERE 1 AND id_prov=?
                    $sql_where 
                ORDER BY a.id_kab ASC 
                    $sql_paging";
        $query = $this->db->query($sql, $id_prov);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $no++;
        }
        return $result;
    }

    function count_kabupaten($id_prov = null) {
        $sql_where = $this->where_kabupaten($id_prov);
        //
        $sql = "SELECT 
                    COUNT(a.id_kab) AS count_data
                FROM mst_kabupaten a 
                WHERE 1 AND a.id_prov=?
                    $sql_where ";
        $query = $this->db->query($sql, $id_prov);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function paging_kecamatan($p = 1, $o = 0, $id_kab = null) {
        $sql_where = $this->where_kecamatan($id_kab);
        //
        $sql = "SELECT 
                    COUNT(a.id_kec) AS count_data 
                FROM mst_kecamatan a 
                WHERE 1 AND id_kab=?
                    $sql_where";
        $query = $this->db->query($sql, $id_kab);
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

    function list_kecamatan($o = 0, $offset = 0, $limit = 100, $id_kab = null) {
        $sql_where = $this->where_kecamatan($id_kab);
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_kecamatan a 
                WHERE 1 AND id_kab=?
                    $sql_where 
                ORDER BY a.id_kec ASC 
                    $sql_paging";
        $query = $this->db->query($sql, $id_kab);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $no++;
        }
        return $result;
    }

    function count_kecamatan($id_kab = null) {
        $sql_where = $this->where_kecamatan($id_kab);
        //
        $sql = "SELECT 
                    COUNT(a.id_kab) AS count_data
                FROM mst_kecamatan a 
                WHERE 1 AND a.id_kab=?
                    $sql_where ";
        $query = $this->db->query($sql, $id_kab);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function paging_kelurahan($p = 1, $o = 0, $id_kec = null) {
        $sql_where = $this->where_kelurahan($id_kec);
        //
        $sql = "SELECT 
                    COUNT(a.id_kel) AS count_data 
                FROM mst_kelurahan a 
                WHERE 1 AND id_kec=?
                    $sql_where";
        $query = $this->db->query($sql, $id_kec);
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

    function list_kelurahan($o = 0, $offset = 0, $limit = 100, $id_kec = null) {
        $sql_where = $this->where_kelurahan($id_kec);
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_kelurahan a 
                WHERE 1 AND id_kec=?
                    $sql_where 
                ORDER BY a.id_kel ASC 
                    $sql_paging";
        $query = $this->db->query($sql, $id_kec);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no+$offset;
            $no++;
        }
        return $result;
    }

    function count_kelurahan($id_kec = null) {
        $sql_where = $this->where_kecamatan($id_kec);
        //
        $sql = "SELECT 
                    COUNT(a.id_kel) AS count_data
                FROM mst_kelurahan a 
                WHERE 1 AND a.id_kec=?
                    $sql_where ";
        $query = $this->db->query($sql, $id_kec);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function get_all_kelurahan($wilayah_id=null) {
        $sql_where = $this->where_wilayah_kel();
        //
        $sql = "SELECT 
                    a.* 
                FROM mst_wilayah a 
                WHERE wilayah_parent='$wilayah_id'
                    $sql_where 
                ORDER BY a.wilayah_id ASC ";
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

    function validate_prov_by_id($id_prov=null) {
        $sql = "SELECT a.id_prov FROM mst_provinsi a WHERE a.id_prov=?";
        $query = $this->db->query($sql, $id_prov);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_prov_by_nama($nama=null) {
        $sql = "SELECT a.nama FROM mst_provinsi a WHERE a.nama=?";
        $query = $this->db->query($sql, $nama);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_kab_by_id($id_kab=null, $id_prov=null) {
        $sql = "SELECT a.id_kab FROM mst_kabupaten a WHERE a.id_kab=? AND a.id_prov=?";
        $query = $this->db->query($sql, array($id_kab, $id_prov));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_kab_by_nama($nama=null, $id_prov=null) {
        $sql = "SELECT a.nama FROM mst_kabupaten a WHERE a.nama=? AND a.id_prov=?";
        $query = $this->db->query($sql, array($nama, $id_prov));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_kec_by_id($id_kec=null, $id_kab=null) {
        $sql = "SELECT a.id_kec FROM mst_kecamatan a WHERE a.id_kec=? AND a.id_kab=?";
        $query = $this->db->query($sql, array($id_kec, $id_kab));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_kec_by_nama($nama=null, $id_kab=null) {
        $sql = "SELECT a.nama FROM mst_kecamatan a WHERE a.nama=? AND a.id_kab=?";
        $query = $this->db->query($sql, array($nama, $id_kab));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }



    function validate_kel_by_id($id_kel=null, $id_kec=null) {
        $sql = "SELECT a.id_kel FROM mst_kelurahan a WHERE a.id_kel=? AND a.id_kec=?";
        $query = $this->db->query($sql, array($id_kel, $id_kec));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_kel_by_nama($nama=null, $id_kec=null) {
        $sql = "SELECT a.nama FROM mst_kelurahan a WHERE a.nama=? AND a.id_kec=?";
        $query = $this->db->query($sql, array($nama, $id_kec));
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_all_customer_kabupaten($customer_provinsi=null) {
        $sql = "SELECT * FROM mst_kabupaten WHERE id_prov=? ORDER BY id_kab ASC";
        $query = $this->db->query($sql, $customer_provinsi);
        return $query->result_array();
    }

    function get_all_customer_kecamatan($customer_kabupaten=null) {
        $sql = "SELECT * FROM mst_kecamatan WHERE id_kab=? ORDER BY id_kec ASC";
        $query = $this->db->query($sql, $customer_kabupaten);
        return $query->result_array();
    }

    function get_all_customer_kelurahan($customer_kecamatan=null) {
        $sql = "SELECT * FROM mst_kelurahan WHERE id_kec=? ORDER BY id_kel ASC";
        $query = $this->db->query($sql, $customer_kecamatan);
        return $query->result_array();
    }

    function get_provinsi($id_prov=null) {
        $sql = "SELECT * FROM mst_provinsi WHERE id_prov=?";
        $query = $this->db->query($sql, $id_prov);
        return $query->row_array();
    }

    function get_kabupaten($id_kab=null) {
        $sql = "SELECT * FROM mst_kabupaten WHERE id_kab=?";
        $query = $this->db->query($sql, $id_kab);
        return $query->row_array();
    }

    function get_kecamatan($id_kec=null) {
        $sql = "SELECT * FROM mst_kecamatan WHERE id_kec=?";
        $query = $this->db->query($sql, $id_kec);
        return $query->row_array();
    }

    function get_kelurahan($id_kel=null) {
        $sql = "SELECT * FROM mst_kelurahan WHERE id_kel=?";
        $query = $this->db->query($sql, $id_kel);
        return $query->row_array();
    }

    function insert_prov() {
        $data = $_POST;
        $outp = $this->db->insert('mst_provinsi', $data);
        return outp_result($outp);
    }

    function update_prov($id_prov=null) {
        $data = $_POST;
        $this->db->where('id_prov', $id_prov);
        $outp = $this->db->update('mst_provinsi', $data);
        return outp_result($outp);
    }

    function delete_prov($id_prov=null) {
        $this->db->where('id_prov', $id_prov);
        $outp = $this->db->delete('mst_provinsi');
        return outp_result($outp,'delete');
    }

    function insert_kab() {
        $data = $_POST;
        $outp = $this->db->insert('mst_kabupaten', $data);
        return outp_result($outp);
    }

    function update_kab($id_kab=null) {
        $data = $_POST;
        $this->db->where('id_kab', $id_kab);
        $outp = $this->db->update('mst_kabupaten', $data);
        return outp_result($outp);
    }

    function delete_kab($id_kab=null) {
        $this->db->where('id_kab', $id_kab);
        $outp = $this->db->delete('mst_kabupaten');
        return outp_result($outp,'delete');
    }

    function insert_kec() {
        $data = $_POST;
        $outp = $this->db->insert('mst_kecamatan', $data);
        return outp_result($outp);
    }

    function update_kec($id_kec=null) {
        $data = $_POST;
        $this->db->where('id_kec', $id_kec);
        $outp = $this->db->update('mst_kecamatan', $data);
        return outp_result($outp);
    }

    function delete_kec($id_kec=null) {
        $this->db->where('id_kec', $id_kec);
        $outp = $this->db->delete('mst_kecamatan');
        return outp_result($outp,'delete');
    }

    function insert_kel() {
        $data = $_POST;
        $outp = $this->db->insert('mst_kelurahan', $data);
        return outp_result($outp);
    }

    function update_kel($id_kel=null) {
        $data = $_POST;
        $this->db->where('id_kel', $id_kel);
        $outp = $this->db->update('mst_kelurahan', $data);
        return outp_result($outp);
    }

    function delete_kel($id_kel=null) {
        $this->db->where('id_kel', $id_kel);
        $outp = $this->db->delete('mst_kelurahan');
        return outp_result($outp,'delete');
    }
    
}
