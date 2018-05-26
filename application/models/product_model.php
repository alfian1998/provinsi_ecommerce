<?php
class Product_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_product() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_category = @$_SESSION['ses_category'];
        $ses_qty_unit = @$_SESSION['ses_qty_unit'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.product_nm LIKE '%$ses_txt_search%'";
        if($ses_category != '')  $sql_where .= " AND a.category_id = '$ses_category'";
        if($ses_qty_unit != '')  $sql_where .= " AND a.qty_unit = '$ses_qty_unit'";
        return $sql_where;
    }

    function get_product_id($product_id=null) {
        $var_1 = substr($product_id, 0, 32);
        $var_2 = substr($product_id, 32, 32);
        $var_3 = substr($product_id, 64, 32);
        //
        return $var_2;
    }

    function list_product_new() {
        $sql_limit = " LIMIT 5";
        //
        $sql = "SELECT 
                    a.*, b.*, e.nama AS prov_nm, f.nama AS kab_nm, g.nama AS kec_nm, h.nama AS kel_nm  
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND product_st = '1' 
                ORDER BY a.product_id DESC
                    $sql_limit";
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

    function list_product_recommendat($category_id = null) {
        $sql = "SELECT 
                    a.*, b.*, e.nama AS prov_nm, f.nama AS kab_nm, g.nama AS kec_nm, h.nama AS kel_nm  
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND category_id=? AND product_st = '1'
                ORDER BY rand() LIMIT 10";
        $query = $this->db->query($sql, $category_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['first_image'] = $this->get_first_image($val['product_id']);
            $no++;
        }
        return $result;
    }

    function paging_product($p = 1, $o = 0) {
        $sql_where = $this->where_product();
        //
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        //
        $sql = "SELECT 
                    COUNT(product_id) AS count_data 
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '1' 
                    $sql_where ";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '8';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_product($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_product();
        //
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '1' 
                    $sql_where 
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

    function paging_product_draft($p = 1, $o = 0) {
        $sql_where = $this->where_product();
        //
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        //
        $sql = "SELECT 
                    COUNT(product_id) AS count_data 
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '2'
                    $sql_where ";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '8';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_product_draft($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_product();
        //
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '2' 
                    $sql_where 
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

    function paging_product_not_sold($p = 1, $o = 0) {
        $sql_where = $this->where_product();
        //
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        //
        $sql = "SELECT 
                    COUNT(product_id) AS count_data 
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '3'
                    $sql_where ";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '8';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_product_not_sold($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_product();
        //
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.* 
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '3' 
                    $sql_where 
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

    function paging_product_by_category($p = 1, $o = 0, $category_id=null) {
        // $sql_where = $this->where_product();
        //
        $sql = "SELECT 
                    COUNT(product_id) AS count_data 
                FROM product a 
                WHERE 1 AND a.category_id='$category_id' AND product_st = '1'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '5';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_product_by_category($o = 0, $offset = 0, $limit = 100, $category_id=null) {
        // $sql_where = $this->where_product();
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.*, e.nama AS prov_nm, f.nama AS kab_nm, g.nama AS kec_nm, h.nama AS kel_nm   
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND a.category_id='$category_id' AND product_st = '1' 
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

    function paging_product_by_category_gridview($p = 1, $o = 0, $category_id=null) {
        $ses_urutan = @$_SESSION['ses_urutan'];
        if ($ses_urutan == 'terbaru') {
            $sql_ses_urutan = "ORDER BY a.product_id DESC";
        }else if($ses_urutan == 'termurah') {
            $sql_ses_urutan = "ORDER BY a.price ASC";
        }else if($ses_urutan == 'termahal') {
            $sql_ses_urutan = "ORDER BY a.price DESC";
        }else{
            $sql_ses_urutan = "ORDER BY a.product_id ASC";
        }
        //
        $ses_kata_kunci = @$_SESSION['ses_kata_kunci'];
        $sql_ses_kata_kunci = "";
        if($ses_kata_kunci != '')  $sql_ses_kata_kunci .= " AND a.product_nm LIKE '%$ses_kata_kunci%' OR b.customer_nm LIKE '%$ses_kata_kunci%' AND a.category_id='$category_id'";
        // kabupaten
        $ses_kabupaten = @$_SESSION['ses_kabupaten'];
        $sql_ses_kabupaten = "";
        if($ses_kabupaten != '')  $sql_ses_kabupaten .= " AND b.customer_kabupaten = '$ses_kabupaten'";
        // kecamatan
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        $sql_ses_kecamatan = "";
        if($ses_kecamatan != '')  $sql_ses_kecamatan .= " AND b.customer_kecamatan = '$ses_kecamatan'";
        // kelurahan
        $ses_kelurahan = @$_SESSION['ses_kelurahan'];
        $sql_ses_kelurahan = "";
        if($ses_kelurahan != '')  $sql_ses_kelurahan .= " AND b.customer_kelurahan = '$ses_kelurahan'";
        //
        $sql = "SELECT 
                    COUNT(product_id) AS count_data 
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND a.category_id='$category_id' AND product_st = '1' $sql_ses_kata_kunci $sql_ses_kabupaten $sql_ses_kecamatan $sql_ses_kelurahan
                $sql_ses_urutan";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '8';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_product_by_category_gridview($o = 0, $offset = 0, $limit = 100, $category_id=null) {
        $ses_urutan = @$_SESSION['ses_urutan'];
        if ($ses_urutan == 'terbaru') {
            $sql_ses_urutan = "ORDER BY a.product_id DESC";
        }else if($ses_urutan == 'termurah') {
            $sql_ses_urutan = "ORDER BY a.price ASC";
        }else if($ses_urutan == 'termahal') {
            $sql_ses_urutan = "ORDER BY a.price DESC";
        }else{
            $sql_ses_urutan = "ORDER BY a.product_id ASC";
        }
        //
        $ses_kata_kunci = @$_SESSION['ses_kata_kunci'];
        $sql_ses_kata_kunci = "";
        if($ses_kata_kunci != '')  $sql_ses_kata_kunci .= " AND a.product_nm LIKE '%$ses_kata_kunci%' OR b.customer_nm LIKE '%$ses_kata_kunci%' AND a.category_id='$category_id'";
        // kabupaten
        $ses_kabupaten = @$_SESSION['ses_kabupaten'];
        $sql_ses_kabupaten = "";
        if($ses_kabupaten != '')  $sql_ses_kabupaten .= " AND b.customer_kabupaten = '$ses_kabupaten'";
        // kecamatan
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        $sql_ses_kecamatan = "";
        if($ses_kecamatan != '')  $sql_ses_kecamatan .= " AND b.customer_kecamatan = '$ses_kecamatan'";
        // kelurahan
        $ses_kelurahan = @$_SESSION['ses_kelurahan'];
        $sql_ses_kelurahan = "";
        if($ses_kelurahan != '')  $sql_ses_kelurahan .= " AND b.customer_kelurahan = '$ses_kelurahan'";
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.*, e.nama AS prov_nm, f.nama AS kab_nm, g.nama AS kec_nm, h.nama AS kel_nm   
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND a.category_id='$category_id' AND product_st = '1' $sql_ses_kata_kunci $sql_ses_kabupaten $sql_ses_kecamatan $sql_ses_kelurahan 
                $sql_ses_urutan 
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

    function paging_product_by_category_listview($p = 1, $o = 0, $category_id=null) {
        $ses_urutan = @$_SESSION['ses_urutan'];
        if ($ses_urutan == 'terbaru') {
            $sql_ses_urutan = "ORDER BY a.product_id DESC";
        }else if($ses_urutan == 'termurah') {
            $sql_ses_urutan = "ORDER BY a.price ASC";
        }else if($ses_urutan == 'termahal') {
            $sql_ses_urutan = "ORDER BY a.price DESC";
        }else{
            $sql_ses_urutan = "ORDER BY a.product_id ASC";
        }
        //
        $ses_kata_kunci = @$_SESSION['ses_kata_kunci'];
        $sql_ses_kata_kunci = "";
        if($ses_kata_kunci != '')  $sql_ses_kata_kunci .= " AND a.product_nm LIKE '%$ses_kata_kunci%' OR b.customer_nm LIKE '%$ses_kata_kunci%' AND a.category_id='$category_id'";
        // kabupaten
        $ses_kabupaten = @$_SESSION['ses_kabupaten'];
        $sql_ses_kabupaten = "";
        if($ses_kabupaten != '')  $sql_ses_kabupaten .= " AND b.customer_kabupaten = '$ses_kabupaten'";
        // kecamatan
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        $sql_ses_kecamatan = "";
        if($ses_kecamatan != '')  $sql_ses_kecamatan .= " AND b.customer_kecamatan = '$ses_kecamatan'";
        // kelurahan
        $ses_kelurahan = @$_SESSION['ses_kelurahan'];
        $sql_ses_kelurahan = "";
        if($ses_kelurahan != '')  $sql_ses_kelurahan .= " AND b.customer_kelurahan = '$ses_kelurahan'";
        //
        $sql = "SELECT 
                    COUNT(product_id) AS count_data 
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND a.category_id='$category_id' AND product_st = '1' $sql_ses_kata_kunci $sql_ses_kabupaten $sql_ses_kecamatan $sql_ses_kelurahan
                $sql_ses_urutan";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '5';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_product_by_category_listview($o = 0, $offset = 0, $limit = 100, $category_id=null) {
        $ses_urutan = @$_SESSION['ses_urutan'];
        if ($ses_urutan == 'terbaru') {
            $sql_ses_urutan = "ORDER BY a.product_id DESC";
        }else if($ses_urutan == 'termurah') {
            $sql_ses_urutan = "ORDER BY a.price ASC";
        }else if($ses_urutan == 'termahal') {
            $sql_ses_urutan = "ORDER BY a.price DESC";
        }else{
            $sql_ses_urutan = "ORDER BY a.product_id ASC";
        }
        //
        $ses_kata_kunci = @$_SESSION['ses_kata_kunci'];
        $sql_ses_kata_kunci = "";
        if($ses_kata_kunci != '')  $sql_ses_kata_kunci .= " AND a.product_nm LIKE '%$ses_kata_kunci%' OR b.customer_nm LIKE '%$ses_kata_kunci%' AND a.category_id='$category_id'";
        // kabupaten
        $ses_kabupaten = @$_SESSION['ses_kabupaten'];
        $sql_ses_kabupaten = "";
        if($ses_kabupaten != '')  $sql_ses_kabupaten .= " AND b.customer_kabupaten = '$ses_kabupaten'";
        // kecamatan
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        $sql_ses_kecamatan = "";
        if($ses_kecamatan != '')  $sql_ses_kecamatan .= " AND b.customer_kecamatan = '$ses_kecamatan'";
        // kelurahan
        $ses_kelurahan = @$_SESSION['ses_kelurahan'];
        $sql_ses_kelurahan = "";
        if($ses_kelurahan != '')  $sql_ses_kelurahan .= " AND b.customer_kelurahan = '$ses_kelurahan'";
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.*, e.nama AS prov_nm, f.nama AS kab_nm, g.nama AS kec_nm, h.nama AS kel_nm   
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND a.category_id='$category_id' AND product_st = '1' $sql_ses_kata_kunci $sql_ses_kabupaten $sql_ses_kecamatan $sql_ses_kelurahan 
                $sql_ses_urutan 
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

    function paging_product_search($p = 1, $o = 0) {
        $ses_urutan = @$_SESSION['ses_urutan'];
        if ($ses_urutan == 'terbaru') {
            $sql_ses_urutan = "ORDER BY a.product_id DESC";
        }else if($ses_urutan == 'termurah') {
            $sql_ses_urutan = "ORDER BY a.price ASC";
        }else if($ses_urutan == 'termahal') {
            $sql_ses_urutan = "ORDER BY a.price DESC";
        }else{
            $sql_ses_urutan = "ORDER BY a.product_id ASC";
        }
        //
        $ses_search = @$_SESSION['ses_search'];
        $sql_ses_search = "";
        if($ses_search != '')  $sql_ses_search .= " AND a.product_nm LIKE '%$ses_search%'";
        // kabupaten
        $ses_kabupaten = @$_SESSION['ses_kabupaten'];
        $sql_ses_kabupaten = "";
        if($ses_kabupaten != '')  $sql_ses_kabupaten .= " AND b.customer_kabupaten = '$ses_kabupaten'";
        // kecamatan
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        $sql_ses_kecamatan = "";
        if($ses_kecamatan != '')  $sql_ses_kecamatan .= " AND b.customer_kecamatan = '$ses_kecamatan'";
        // kelurahan
        $ses_kelurahan = @$_SESSION['ses_kelurahan'];
        $sql_ses_kelurahan = "";
        if($ses_kelurahan != '')  $sql_ses_kelurahan .= " AND b.customer_kelurahan = '$ses_kelurahan'";
        //
        $sql = "SELECT 
                    COUNT(product_id) AS count_data 
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND product_st = '1' $sql_ses_search $sql_ses_kabupaten $sql_ses_kecamatan $sql_ses_kelurahan
                $sql_ses_urutan";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        $this->load->library('paging');
        $cfg['page'] = $p;
        $cfg['per_page'] = '8';
        $cfg['num_rows'] = $count_data;
        $this->paging->init($cfg);        
        return $this->paging;
    }

    function list_product_search($o = 0, $offset = 0, $limit = 100) {
        $ses_urutan = @$_SESSION['ses_urutan'];
        if ($ses_urutan == 'terbaru') {
            $sql_ses_urutan = "ORDER BY a.product_id DESC";
        }else if($ses_urutan == 'termurah') {
            $sql_ses_urutan = "ORDER BY a.price ASC";
        }else if($ses_urutan == 'termahal') {
            $sql_ses_urutan = "ORDER BY a.price DESC";
        }else{
            $sql_ses_urutan = "ORDER BY a.product_id ASC";
        }
        //
        $ses_search = @$_SESSION['ses_search'];
        $sql_ses_search = "";
        if($ses_search != '')  $sql_ses_search .= " AND a.product_nm LIKE '%$ses_search%'";
        // kabupaten
        $ses_kabupaten = @$_SESSION['ses_kabupaten'];
        $sql_ses_kabupaten = "";
        if($ses_kabupaten != '')  $sql_ses_kabupaten .= " AND b.customer_kabupaten = '$ses_kabupaten'";
        // kecamatan
        $ses_kecamatan = @$_SESSION['ses_kecamatan'];
        $sql_ses_kecamatan = "";
        if($ses_kecamatan != '')  $sql_ses_kecamatan .= " AND b.customer_kecamatan = '$ses_kecamatan'";
        // kelurahan
        $ses_kelurahan = @$_SESSION['ses_kelurahan'];
        $sql_ses_kelurahan = "";
        if($ses_kelurahan != '')  $sql_ses_kelurahan .= " AND b.customer_kelurahan = '$ses_kelurahan'";
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.*, e.nama AS prov_nm, f.nama AS kab_nm, g.nama AS kec_nm, h.nama AS kel_nm   
                FROM product a 
                LEFT JOIN customer b ON a.customer_id=b.customer_id
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE 1 AND a.product_st = '1' $sql_ses_search $sql_ses_kabupaten $sql_ses_kecamatan $sql_ses_kelurahan 
                $sql_ses_urutan 
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

    function get_product($product_id=null) {
        $sql = "SELECT a.*, b.*, c.*, d.category_nm AS parent_nm, e.nama AS prov_nm, f.nama AS kab_nm, g.nama AS kec_nm, h.nama AS kel_nm 
                FROM product a
                LEFT JOIN customer b ON a.customer_id=b.customer_id 
                LEFT JOIN category c ON a.category_id=c.category_id 
                LEFT JOIN category d ON c.category_parent=d.category_id 
                LEFT JOIN mst_provinsi e ON b.customer_provinsi=e.id_prov 
                LEFT JOIN mst_kabupaten f ON b.customer_kabupaten=f.id_kab 
                LEFT JOIN mst_kecamatan g ON b.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON b.customer_kelurahan=h.id_kel 
                WHERE md5(md5(md5(md5(md5(a.product_id)))))=?";
        $query = $this->db->query($sql, $product_id);
        $row = $query->row_array();
        //
        $row['first_image'] = $this->get_first_image($row['product_id']);
        $row['product_image'] = $this->image_model->get_image_by_product($row['product_id']);        
        //
        return $row;
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

    function count_on_sale() {
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        //
        $sql = "SELECT 
                    COUNT(a.product_id) AS count_data
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '1'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function count_draft() {
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        //
        $sql = "SELECT 
                    COUNT(a.product_id) AS count_data
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '2'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function count_not_sold() {
        $ses_customer_id = $this->session->userdata('ses_customer_id');
        //
        $sql = "SELECT 
                    COUNT(a.product_id) AS count_data
                FROM product a 
                WHERE 1 AND a.customer_id = '$ses_customer_id' AND product_st = '3'";
        $query = $this->db->query($sql);
        $result = $query->row_array();
        // 
        return $result['count_data'];
    }

    function update_hit($product_id = "") {
        $sql = "UPDATE product SET hit = hit+1 WHERE product_id=?";
        $query = $this->db->query($sql, $product_id);
        return $query;
    }
}
