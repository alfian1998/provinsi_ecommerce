<?php
class Checkout_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        //
        $this->load->model('product_model');
    }

    function list_bulan() {
        $arr = list_bulan();
        $result = '';
        foreach($arr as $key => $val) {
            $result .= "'".$val."'";
            $result .= ",";
        }
        $result = substr($result, 0, -1);
        return $result;
    }

    function get_bulan() {
        $sql = "SELECT month(created_date) as id_bulan
                FROM pembeli
                GROUP BY id_bulan
                ORDER BY id_bulan ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function list_jumlah_pembeli() {
        $arr = $this->get_all_jumlah_pembeli();
        $result = '';
        foreach($arr as $key => $val) {
            $result .= "".$val."";
            $result .= ",";
        }
        $result = substr($result, 0, -1);
        return $result;
    }

    function get_all_jumlah_pembeli() {
        $arr = list_bulan();
        $result = array();
        foreach($arr as $key => $val) {
            $result[$key] = $this->get_jumlah_pembeli_by_month($key);
        }
        return $result;
    }

    function get_jumlah_pembeli_by_month($month=null) {
        $year = date('Y');
        $sql = "SELECT COUNT(billing_id) AS jumlah
                FROM billing
                WHERE YEAR(billing_date)=? AND MONTH(billing_date)=?";
        $query = $this->db->query($sql, array($year, $month));
        $row = $query->row_array();
        return (@$row['jumlah'] != '' ? @$row['jumlah'] : '0');
    }

    function count_buyer($status, $bulan, $search) {
        if ($status == '') {
            $sql_status = " AND a.bayar_st IS NOT NULL";
        }elseif ($status == 'sudah_bayar') {
            $sql_status = " AND a.bayar_st = '1'";
        }elseif ($status == 'belum_bayar') {
            $sql_status = " AND a.bayar_st = '2'";
        }elseif ($status == 'konfirmasi') {
            $sql_status = " AND a.transfer_st = '2'";
        }elseif ($status == 'sudah_diterima') {
            $sql_status = " AND a.diterima_st = '1'";
        }
        //
        if ($bulan != '') {
            $sql_bulan = " AND MONTH(a.billing_date) = '$bulan'";
        }elseif ($bulan == '') {
            $sql_bulan = "";
        }
        //
        if ($search !='') {
            $sql_search = " AND b.pembeli_nm LIKE '%$search%' OR c.customer_nm LIKE '%$search%' OR a.billing_id LIKE '%$search%'";
        }elseif ($search == '') {
            $sql_search = "";
        }
        //
        $sql = "SELECT 
                    COUNT(a.billing_id) AS count_data 
                FROM billing a 
                LEFT JOIN pembeli b ON a.pembeli_id=b.pembeli_id
                LEFT JOIN customer c ON b.customer_id=c.customer_id
                WHERE 1 $sql_status $sql_bulan $sql_search ";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        return $count_data;
    }

    function count_buyer_customer($customer_id) {
        //
        $sql = "SELECT 
                    COUNT(a.billing_id) AS count_data 
                FROM billing a 
                LEFT JOIN pembeli b ON a.pembeli_id=b.pembeli_id
                LEFT JOIN customer c ON b.customer_id=c.customer_id
                WHERE 1 AND";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        //
        return $count_data;
    }

    function list_checkout($billing_id=null, $customer_id=null) {
        if ($customer_id !='') {
            $sql_customer_id = " AND a.customer_id='$customer_id'";
        }else {
            $sql_customer_id = "";
        }
        //
        $sql = "SELECT 
                    a.*, b.product_nm, c.customer_nm   
                FROM checkout a 
                LEFT JOIN product b ON a.product_id=b.product_id
                LEFT JOIN customer c ON a.customer_id=c.customer_id
                WHERE 1 AND a.billing_id='$billing_id' $sql_customer_id 
                ORDER BY a.billing_id ASC";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['first_image'] = $this->product_model->get_first_image($val['product_id']);
            $no++;
        }
        return $result;
    }

    function list_checkout_non_customer_id($billing_id=null) {
        $sql = "SELECT 
                    a.*, b.product_nm, c.customer_nm   
                FROM checkout a 
                LEFT JOIN product b ON a.product_id=b.product_id
                LEFT JOIN customer c ON a.customer_id=c.customer_id
                WHERE 1 AND a.billing_id=?
                ORDER BY a.billing_id ASC";
        $query = $this->db->query($sql, $billing_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['first_image'] = $this->product_model->get_first_image($val['product_id']);
            $no++;
        }
        return $result;
    }

    function list_seller($billing_id, $email) {
        // billing_id
        if ($billing_id =='null') {
            $sql_billing_id = "";
        }else{
            $sql_billing_id = " AND a.billing_id='$billing_id'";
        }
        // email
        if ($email =='null') {
            $sql_email = "";
        }else{
            $sql_email = " AND (c.pembeli_email='$email' OR e.customer_email='$email')";
        }
        //
        $sql = "SELECT 
                    a.*, b.*, c.*, d.customer_nm, d.customer_img, d.customer_id   
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON b.customer_id=d.customer_id
                LEFT JOIN customer e ON c.customer_id=e.customer_id
                WHERE 1 $sql_billing_id $sql_email
                GROUP BY b.customer_id";
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

    function get_tahun() {
        $sql = "SELECT 
                    YEAR(a.billing_date) as tahun
                FROM billing a 
                GROUP BY YEAR(a.billing_date)";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        return $result;
    }

    function get_checkout($billing_id, $email) {
        // billing_id
        if ($billing_id =='null') {
            $sql_billing_id = "";
        }else{
            $sql_billing_id = " AND a.billing_id='$billing_id'";
        }
        // email
        if ($email =='null') {
            $sql_email = "";
        }else{
            $sql_email = " AND (c.pembeli_email='$email' OR d.customer_email='$email')";
        }
        //
        $sql = "SELECT 
                    a.*, b.*, c.*, d.*, c.customer_id AS customer_id_pembeli, e.nama AS provinsi, f.nama AS kabupaten, g.nama AS kecamatan, h.nama AS kelurahan 
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON c.customer_id=d.customer_id
                LEFT JOIN mst_provinsi e ON c.pembeli_provinsi=e.id_prov OR d.customer_provinsi=e.id_prov
                LEFT JOIN mst_kabupaten f ON c.pembeli_kabupaten=f.id_kab OR d.customer_kabupaten=f.id_kab
                LEFT JOIN mst_kecamatan g ON c.pembeli_kecamatan=g.id_kec OR d.customer_kecamatan=g.id_kec
                LEFT JOIN mst_kelurahan h ON c.pembeli_kelurahan=h.id_kel OR d.customer_kelurahan=h.id_kel
                WHERE 1 $sql_billing_id $sql_email
                GROUP BY a.billing_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function get_jumlah_harga($billing_id, $customer_id) {
        $sql = "SELECT 
                    SUM(a.product_sub_price) AS jumlah_harga
                FROM checkout a 
                WHERE 1 AND a.billing_id='$billing_id' AND a.customer_id='$customer_id' 
                GROUP BY a.billing_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function get_only_checkout($billing_id, $customer_id) {
        $sql = "SELECT 
                    a.* 
                FROM checkout a 
                WHERE 1 AND a.billing_id='$billing_id' AND a.customer_id='$customer_id'
                GROUP BY a.billing_id";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function list_checkout_by_customer_id($billing_id, $customer_id) {
        $sql = "SELECT 
                    a.*, b.*  
                FROM checkout a 
                LEFT JOIN product b ON a.product_id=b.product_id
                WHERE 1 AND a.billing_id='$billing_id' AND a.customer_id='$customer_id'";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['first_image'] = $this->product_model->get_first_image($val['product_id']);
            $no++;
        }
        return $result;
    }

    function check_kirim_st($billing_id=null, $customer_id=null) {
        if ($customer_id !='') {
            $sql_customer_id = " AND a.customer_id='$customer_id'";
        }else{
            $sql_customer_id = "";
        }
        //
        $sql = "SELECT a.*
                FROM checkout a 
                WHERE 1 AND a.billing_id='$billing_id' AND a.kirim_st='2' $sql_customer_id";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        return $row;
    }

    function kirim_st($billing_id=null, $customer_id=null) {
        if ($customer_id !='') {
            $sql_customer_id = " AND a.customer_id='$customer_id'";
        }else{
            $sql_customer_id = "";
        }
        //
        $sql = "SELECT a.*
                FROM checkout a 
                WHERE 1 AND a.billing_id='$billing_id' $sql_customer_id";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        return $row;
    }

    function get_kirim_date($billing_id=null, $customer_id=null) {
        if ($customer_id !='') {
            $sql_customer_id = " AND a.customer_id='$customer_id'";
        }else {
            $sql_customer_id = "";
        }
        //
        $sql = "SELECT a.kirim_date
                FROM checkout a 
                WHERE 1 AND a.billing_id='$billing_id' $sql_customer_id
                GROUP BY a.kirim_date";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        //
        return $row;
    }

    function paging_all_buyer($p = 1, $o = 0, $status, $search) {
        if ($status == '') {
            $sql_status = " AND a.bayar_st IS NOT NULL";
        }elseif ($status == 'sudah_bayar') {
            $sql_status = " AND a.bayar_st = '1'";
        }elseif ($status == 'belum_bayar') {
            $sql_status = " AND a.bayar_st = '2'";
        }elseif ($status == 'konfirmasi') {
            $sql_status = " AND a.transfer_st = '2'";
        }elseif ($status == 'sudah_diterima') {
            $sql_status = " AND a.diterima_st = '1'";
        }
        //
        if ($search !='') {
            $sql_search = " AND b.pembeli_nm LIKE '%$search%' OR c.customer_nm LIKE '%$search%' OR a.billing_id LIKE '%$search%'";
        }elseif ($search == '') {
            $sql_search = "";
        }
        //
        $sql = "SELECT 
                    COUNT(a.billing_id) AS count_data 
                FROM billing a 
                LEFT JOIN pembeli b ON a.pembeli_id=b.pembeli_id
                LEFT JOIN customer c ON b.customer_id=c.customer_id
                WHERE 1 $sql_status $sql_search ";
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

    function get_all_buyer($o = 0, $offset = 0, $limit = 100, $status, $search) {
        if ($status == '') {
            $sql_status = " AND a.bayar_st IS NOT NULL";
        }elseif ($status == 'sudah_bayar') {
            $sql_status = " AND a.bayar_st = '1'";
        }elseif ($status == 'belum_bayar') {
            $sql_status = " AND a.bayar_st = '2'";
        }elseif ($status == 'konfirmasi') {
            $sql_status = " AND a.transfer_st = '2'";
        }elseif ($status == 'sudah_diterima') {
            $sql_status = " AND a.diterima_st = '1'";
        }
        //
        if ($search !='') {
            $sql_search = " AND b.pembeli_nm LIKE '%$search%' OR c.customer_nm LIKE '%$search%' OR a.billing_id LIKE '%$search%'";
        }elseif ($search == '') {
            $sql_search = "";
        }
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, b.*, c.customer_nm 
                FROM billing a 
                LEFT JOIN pembeli b ON a.pembeli_id=b.pembeli_id
                LEFT JOIN customer c ON b.customer_id=c.customer_id
                WHERE 1 $sql_status $sql_search
                ORDER BY a.billing_id DESC, a.billing_date DESC, a.bayar_date DESC, a.transfer_date DESC, a.diterima_date DESC
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

    function paging_buyer_by_customer_id($p = 1, $o = 0, $customer_id=null, $status=null, $bulan=null, $search=null) {
        if ($status == '') {
            $sql_status = " AND a.bayar_st IS NOT NULL";
        }elseif ($status == 'sudah_bayar') {
            $sql_status = " AND a.bayar_st = '1'";
        }elseif ($status == 'belum_bayar') {
            $sql_status = " AND a.bayar_st = '2'";
        }elseif ($status == 'konfirmasi') {
            $sql_status = " AND a.transfer_st = '2'";
        }elseif ($status == 'sudah_diterima') {
            $sql_status = " AND a.diterima_st = '1'";
        }
        //
        if ($bulan != '') {
            $sql_bulan = " AND MONTH(a.billing_date) = '$bulan'";
        }elseif ($bulan == '') {
            $sql_bulan = "";
        }
        //
        if ($search !='') {
            $sql_search = " AND c.pembeli_nm LIKE '%$search%' OR d.customer_nm LIKE '%$search%' OR a.billing_id LIKE '%$search%'";
        }elseif ($search == '') {
            $sql_search = "";
        }
        //
        $sql = "SELECT 
                    COUNT(a.billing_id) AS count_data 
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id 
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON c.customer_id=d.customer_id
                WHERE 1 AND a.bayar_st IS NOT NULL AND b.customer_id='$customer_id' $sql_status $sql_bulan $sql_search";
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

    function get_buyer_by_customer_id($o = 0, $offset = 0, $limit = 100, $customer_id=null, $status=null, $bulan=null, $search=null) {
        if ($status == '') {
            $sql_status = " AND a.bayar_st IS NOT NULL";
        }elseif ($status == 'sudah_bayar') {
            $sql_status = " AND a.bayar_st = '1'";
        }elseif ($status == 'belum_bayar') {
            $sql_status = " AND a.bayar_st = '2'";
        }elseif ($status == 'konfirmasi') {
            $sql_status = " AND a.transfer_st = '2'";
        }elseif ($status == 'sudah_diterima') {
            $sql_status = " AND a.diterima_st = '1'";
        }
        //
        if ($bulan != '') {
            $sql_bulan = " AND MONTH(a.billing_date) = '$bulan'";
        }elseif ($bulan == '') {
            $sql_bulan = "";
        }
        //
        if ($search !='') {
            $sql_search = " AND c.pembeli_nm LIKE '%$search%' OR d.customer_nm LIKE '%$search%' OR a.billing_id LIKE '%$search%'";
        }elseif ($search == '') {
            $sql_search = "";
        }
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, c.*, d.customer_nm  
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id 
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON c.customer_id=d.customer_id
                WHERE 1 AND a.bayar_st IS NOT NULL AND b.customer_id='$customer_id' $sql_status $sql_bulan $sql_search
                GROUP BY a.billing_id 
                ORDER BY a.billing_id DESC, a.billing_date DESC, a.bayar_date DESC, a.transfer_date DESC  
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

    function paging_send_pay_customer($p = 1, $o = 0, $customer_id=null) {
        $sql = "SELECT 
                    COUNT(a.billing_id) AS count_data 
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id 
                WHERE 1 AND b.bayar_customer_st='1' AND b.customer_id='$customer_id'";
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

    function get_send_pay_customer($o = 0, $offset = 0, $limit = 100, $customer_id=null) {
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, c.*, d.customer_nm, SUM(b.product_sub_price) AS nominal_diterima, b.bayar_customer_date, b.bayar_customer_img  
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id 
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON c.customer_id=d.customer_id
                WHERE 1 AND b.bayar_customer_st='1' AND b.customer_id='$customer_id'
                GROUP BY a.billing_id 
                ORDER BY b.bayar_customer_date DESC, a.billing_date DESC, a.bayar_date DESC, a.transfer_date DESC  
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

    function paging_not_send_pay_customer($p = 1, $o = 0, $customer_id=null) {
        $sql = "SELECT 
                    COUNT(a.billing_id) AS count_data 
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id 
                WHERE 1 AND a.diterima_st = '1' AND b.customer_id='$customer_id'";
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

    function get_not_send_pay_customer($o = 0, $offset = 0, $limit = 100, $customer_id=null) {
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, c.*, d.customer_nm, SUM(b.product_sub_price) AS nominal_diterima, b.bayar_customer_date 
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id 
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON c.customer_id=d.customer_id
                WHERE 1 AND a.diterima_st = '1' AND b.customer_id='$customer_id'
                GROUP BY a.billing_id 
                ORDER BY a.billing_date DESC, a.billing_date DESC, a.bayar_date DESC, a.transfer_date DESC  
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

    function paging_buyer($p = 1, $o = 0, $status=null, $bulan=null, $search=null) {
        if ($status == '') {
            $sql_status = " AND a.bayar_st IS NOT NULL";
        }elseif ($status == 'sudah_bayar') {
            $sql_status = " AND a.bayar_st = '1'";
        }elseif ($status == 'belum_bayar') {
            $sql_status = " AND a.bayar_st = '2'";
        }elseif ($status == 'konfirmasi') {
            $sql_status = " AND a.transfer_st = '2'";
        }elseif ($status == 'sudah_diterima') {
            $sql_status = " AND a.diterima_st = '1'";
        }
        //
        if ($bulan != '') {
            $sql_bulan = " AND MONTH(a.billing_date) = '$bulan'";
        }elseif ($bulan == '') {
            $sql_bulan = "";
        }
        //
        if ($search !='') {
            $sql_search = " AND c.pembeli_nm LIKE '%$search%' OR d.customer_nm LIKE '%$search%' OR a.billing_id LIKE '%$search%'";
        }elseif ($search == '') {
            $sql_search = "";
        }
        //
        $sql = "SELECT 
                    COUNT(a.billing_id) AS count_data 
                FROM billing a 
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON c.customer_id=d.customer_id
                WHERE 1 $sql_status $sql_bulan $sql_search";
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

    function get_buyer($o = 0, $offset = 0, $limit = 100, $status=null, $bulan=null, $search=null) {
        if ($status == '') {
            $sql_status = " AND a.bayar_st IS NOT NULL";
        }elseif ($status == 'sudah_bayar') {
            $sql_status = " AND a.bayar_st = '1'";
        }elseif ($status == 'belum_bayar') {
            $sql_status = " AND a.bayar_st = '2'";
        }elseif ($status == 'konfirmasi') {
            $sql_status = " AND a.transfer_st = '2'";
        }elseif ($status == 'sudah_diterima') {
            $sql_status = " AND a.diterima_st = '1'";
        }
        //
        if ($bulan != '') {
            $sql_bulan = " AND MONTH(a.billing_date) = '$bulan'";
        }elseif ($bulan == '') {
            $sql_bulan = "";
        }
        //
        if ($search !='') {
            $sql_search = " AND  c.pembeli_nm LIKE '%$search%' OR d.customer_nm LIKE '%$search%' OR a.billing_id LIKE '%$search%'";
        }elseif ($search == '') {
            $sql_search = "";
        }
        //
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
        $sql = "SELECT 
                    a.*, c.*, d.customer_nm  
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id 
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON c.customer_id=d.customer_id
                WHERE 1 $sql_status $sql_bulan $sql_search
                GROUP BY a.billing_id 
                ORDER BY a.billing_id DESC, a.bayar_date DESC, a.transfer_date DESC, a.diterima_date DESC 
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

    function list_report_buyer() {
        $billing_date = @$_SESSION['ses_billing_date'];
        if ($billing_date !='') {
            $ses_billing_date = date('Y-m-d',strtotime(@$_SESSION['ses_billing_date']));
        }else{
            $ses_billing_date = "";
        }
        $ses_status = @$_SESSION['ses_status'];
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        $ses_bulan = @$_SESSION['ses_bulan'];
        $ses_tahun = @$_SESSION['ses_tahun'];
        //
        if ($ses_bulan !='') {
            $sql_bulan = " AND MONTH(a.billing_date) = '$ses_bulan'";
        }else{
            $sql_bulan = "";
        }
        //
        if ($ses_tahun !='') {
            $sql_tahun = " AND YEAR(a.billing_date) = '$ses_tahun'";
        }else{
            $sql_tahun = "";
        }
        //
        if ($ses_billing_date !='') {
            $sql_billing_date = " AND DATE(a.billing_date) = '$ses_billing_date'";
        }else{
            $sql_billing_date = "";
        }
        //
        if ($ses_status == '') {
            $sql_status = " AND a.bayar_st IS NOT NULL";
        }elseif ($ses_status == 'sudah_bayar') {
            $sql_status = " AND a.bayar_st = '1'";
        }elseif ($ses_status == 'belum_bayar') {
            $sql_status = " AND a.bayar_st = '2'";
        }elseif ($ses_status == 'konfirmasi') {
            $sql_status = " AND a.transfer_st = '2'";
        }elseif ($ses_status == 'sudah_diterima') {
            $sql_status = " AND a.diterima_st = '1'";
        }
        //
        if ($ses_txt_search !='') {
            $sql_search = " AND  c.pembeli_nm LIKE '%$ses_txt_search%' OR a.billing_id LIKE '%$ses_txt_search%'";
        }elseif ($ses_txt_search == '') {
            $sql_search = "";
        }
        //
        $sql = "SELECT 
                    a.*, c.*, d.customer_nm  
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id 
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON c.customer_id=d.customer_id
                WHERE 1 $sql_status $sql_search $sql_billing_date $sql_bulan $sql_tahun
                GROUP BY a.billing_id 
                ORDER BY a.billing_id DESC, a.bayar_date DESC, a.transfer_date DESC, a.diterima_date DESC ";
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

    function list_seller_by_billing_id($billing_id) {
        $sql = "SELECT 
                    a.*, b.*, c.*, d.customer_nm, d.customer_img, d.customer_id, SUM(b.product_sub_price) AS jumlah_harga, d.bank_id, d.bank_owner, d.bank_no_rek, e.*   
                FROM billing a 
                LEFT JOIN checkout b ON a.billing_id=b.billing_id
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN customer d ON b.customer_id=d.customer_id
                LEFT JOIN mst_bank e ON d.bank_id=e.bank_id
                WHERE 1 AND a.billing_id=?
                GROUP BY b.customer_id";
        $query = $this->db->query($sql, $billing_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function get_product_by_billing_id($billing_id=null, $customer_id=null) {
        if ($customer_id !='') {
            $sql_customer_id = " AND a.customer_id='$customer_id'";
        }else {
            $sql_customer_id = "";
        }
        //
        $sql = "SELECT 
                    a.*, b.product_nm 
                FROM checkout a 
                LEFT JOIN product b ON a.product_id=b.product_id
                WHERE 1 AND a.billing_id=? $sql_customer_id 
                ORDER BY a.billing_id DESC";
        $query = $this->db->query($sql, $billing_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function get_checkout_group_by($billing_id=null) {
        $sql = "SELECT 
                    a.* 
                FROM checkout a 
                WHERE 1 AND a.billing_id=?
                GROUP BY a.customer_id ";
        $query = $this->db->query($sql, $billing_id);
        $result = $query->result_array();
        // 
        $no=1;
        foreach($result as $key => $val) {
            $result[$key]['no'] = $no;
            $no++;
        }
        return $result;
    }

    function get_billing($billing_id=null) {
        $sql = "SELECT * FROM billing WHERE billing_id=?";
        $query = $this->db->query($sql, $billing_id);
        return $query->row_array();
    }

    function get_billing_edit($billing_id=null) {
        $sql = "SELECT a.*, b.*, c.customer_nm  
                FROM billing a 
                LEFT JOIN pembeli b ON a.pembeli_id=b.pembeli_id
                LEFT JOIN customer c ON b.customer_id=c.customer_id
                WHERE a.billing_id=?";
        $query = $this->db->query($sql, $billing_id);
        return $query->row_array();
    }

    function get_checkout_by_billing($billing_id=null) {
        $sql = "SELECT a.* 
                FROM checkout a 
                WHERE a.billing_id=?";
        $query = $this->db->query($sql, $billing_id);
        return $query->row_array();
    }

    function get_checkout_by_customer_id($billing_id=null, $customer_id=null) {
        $sql = "SELECT a.* 
                FROM checkout a 
                WHERE a.billing_id='$billing_id' AND a.customer_id='$customer_id'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }

    function sum_checkout($billing_id=null, $customer_id=null) {
        if ($customer_id !='') {
            $sql_customer_id = " AND a.customer_id='$customer_id'";
        }else {
            $sql_customer_id = "";
        }
        //
        $sql = "SELECT 
                    SUM(product_price) AS sum_data 
                FROM checkout a 
                WHERE 1 AND a.billing_id='$billing_id' $sql_customer_id";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $sum_data = $row['sum_data'];
        //        
        return $sum_data;
    }

    function get_checkout_kirim_st($billing_id=null) {
        $sql = "SELECT 
                    COUNT(a.checkout_id) AS count_data 
                FROM checkout a 
                WHERE 1 AND a.billing_id='$billing_id' AND a.kirim_st='2'";
        $query = $this->db->query($sql);
        $row = $query->row_array();
        $count_data = $row['count_data'];
        return $count_data;
    }

    function get_detail_data($billing_id=null) {
        $sql = "SELECT a.*, b.*, c.*, d.product_nm, e.customer_nm, f.nama AS provinsi_nm, g.nama AS kabupaten_nm, h.nama AS kecamatan_nm, i.nama AS kelurahan_nm, c.customer_id AS customer_id_pembeli  
                FROM billing a
                LEFT JOIN checkout b ON a.billing_id=b.billing_id
                LEFT JOIN pembeli c ON a.pembeli_id=c.pembeli_id
                LEFT JOIN product d ON b.product_id=d.product_id
                LEFT JOIN customer e ON c.customer_id=e.customer_id
                LEFT JOIN mst_provinsi f ON c.pembeli_provinsi=f.id_prov
                LEFT JOIN mst_kabupaten g ON c.pembeli_kabupaten=g.id_kab
                LEFT JOIN mst_kecamatan h ON c.pembeli_kecamatan=h.id_kec
                LEFT JOIN mst_kelurahan i ON c.pembeli_kelurahan=i.id_kel
                WHERE a.billing_id=?";
        $query = $this->db->query($sql, $billing_id);
        $row = $query->row_array();
        //
        return $row;
    }

    function get_data_checkout($customer_id=null) {
        $sql = "SELECT a.*, b.nama AS provinsi_nm, c.nama AS kabupaten_nm, d.nama AS kecamatan_nm, e.nama AS kelurahan_nm, z.* 
                FROM checkout a
                LEFT JOIN customer z ON a.customer_id=z.customer_id
                LEFT JOIN mst_provinsi b ON z.customer_provinsi=b.id_prov
                LEFT JOIN mst_kabupaten c ON z.customer_kabupaten=c.id_kab
                LEFT JOIN mst_kecamatan d ON z.customer_kecamatan=d.id_kec
                LEFT JOIN mst_kelurahan e ON z.customer_kelurahan=e.id_kel
                WHERE a.customer_id=?";
        $query = $this->db->query($sql, $customer_id);
        $row = $query->row_array();
        //
        return $row;
    }

    function count_qty_product($product_id=null) {
        $sql = "SELECT a.* 
                FROM product a
                WHERE a.product_id=?";
        $query = $this->db->query($sql, $product_id);
        $row = $query->row_array();
        //
        return $row;
    }

    function get_billing_id() {
        $date = date('ymd');
        $lebar = 4;
        //
        $sql = "SELECT a.billing_id 
                FROM billing a
                WHERE 1 AND a.billing_id LIKE '$date%' ORDER BY billing_id DESC LIMIT 1";
        $query = $this->db->query($sql);
        $row = $query->num_rows();
        //
        if($row == 0) {
            $nomor=1;
        }else {
            $result = $query->row_array();
            $nomor=intval(substr($result['billing_id'],strlen($date)))+1;
        }
        if($lebar>0) {
            $angka = $date.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
        } else {
            $angka = $date.$nomor;
        }
        //
        return $angka;
    }

    function get_pembeli_id() {
        $lebar = 1;
        //
        $sql = "SELECT a.pembeli_id 
                FROM pembeli a
                WHERE 1 AND a.pembeli_id ORDER BY pembeli_id DESC LIMIT 1";
        $query = $this->db->query($sql);
        $row = $query->num_rows();
        //
        if($row == 0) {
            $nomor=1;
        }else {
            $result = $query->row_array();
            $nomor=intval($result['pembeli_id'])+1;
        }
        if($lebar>0) {
            $angka = str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
        } else {
            $angka = $nomor;
        }
        //
        return $angka;
    }

    function validate_email($email=null) {
        $sql = "SELECT a.pembeli_id FROM pembeli a WHERE a.pembeli_email=?";
        $query = $this->db->query($sql, $email);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function validate_phone($phone=null) {
        $sql = "SELECT a.pembeli_id FROM pembeli a WHERE a.pembeli_phone=?";
        $query = $this->db->query($sql, $phone);
        if($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert() {
        $data = $_POST;
        // Insert ke tabel Pembeli
        $pembeli['pembeli_id'] = $data['pembeli_id'];
        $pembeli['pembeli_nm'] = $data['pembeli_nm'];
        $pembeli['customer_id'] = ($data['customer_id_pembeli'] == '') ? NULL : $data['customer_id_pembeli'];
        $pembeli['pembeli_email'] = $data['pembeli_email'];
        $pembeli['pembeli_phone'] = $data['pembeli_phone'];
        $pembeli['pembeli_provinsi'] = $data['pembeli_provinsi'];
        $pembeli['pembeli_kabupaten'] = $data['pembeli_kabupaten'];
        $pembeli['pembeli_kecamatan'] = $data['pembeli_kecamatan'];
        $pembeli['pembeli_kelurahan'] = $data['pembeli_kelurahan'];
        $pembeli['pembeli_kodepos'] = $data['pembeli_kodepos'];
        $pembeli['pembeli_address'] = $data['pembeli_address'];
        $pembeli['pembeli_tp'] = ($data['customer_id_pembeli'] == '') ? 2 : 1;
        $pembeli['created_date'] = date('Y-m-d H:i:s');

        // Insert ke tabel Billing
        $billing['billing_id'] = $data['billing_id'];
        $billing['pembeli_id'] = $data['pembeli_id'];
        $billing['billing_desc'] = $data['billing_desc'];
        $billing['product_total_price'] = $data['product_total_price'];
        $billing['billing_date'] = date('Y-m-d H:i:s');
        //
        $outp = $this->db->insert('billing', $billing);
        $outp = $this->db->insert('pembeli', $pembeli);
        //
        $id = $this->db->insert_id();
        // $this->insert_checkout($data['billing_id']);
        $this->insert_checkout($id);
        //
        return outp_result($outp);
    }

    function insert_checkout($id=null) {
        $data = $_POST;
        //
        $checkout_date = date('Y-m-d H:i:s');
        $kirim_st = 2;
        $bayar_customer_st = 2;
        //
        foreach($data['product_id'] as $key => $val) {
            $product_id = $val;
            if($product_id != '') {
                $checkout['product_id'] = @$data['product_id'][$key];
                $checkout['billing_id'] = @$data['billing_id'];
                $checkout['customer_id'] = @$data['customer_id'][$key];
                $checkout['product_qty'] = @$data['product_qty'][$key];
                $checkout['product_qty_unit'] = @$data['product_qty_unit'][$key];
                $checkout['product_price'] = @$data['product_price'][$key];
                $checkout['product_sub_price'] = @$data['product_sub_price'][$key];
                $checkout['checkout_date'] = @$checkout_date;
                $checkout['kirim_st'] = @$kirim_st;
                $checkout['bayar_customer_st'] = @$bayar_customer_st;
                //
                $result = $this->db->insert('checkout', $checkout);
            }
        }
        return @$result;
    }

    function update_payment($billing_id=null) {
        $data = $_POST;
        //get data billing
        $billing = $this->get_billing($billing_id);
        // tabel billing
        $billing['bayar_st'] = 2;
        $billing['bayar_date'] = NULL;
        $billing['transfer_date'] = NULL;
        $billing['diterima_date'] = NULL;
        $billing['billing_date'] = $billing['billing_date'];
        // table product
        //
        $this->db->where('billing_id', $billing_id);
        $outp = $this->db->update('billing', $billing);
        //
        $this->update_product();
        //
        return $outp;
    }

    function update_product() {
        $data = $_POST;
        //
        foreach($data['product_id'] as $key => $val) {
            $product_id = $val;
            //
            $qty_product = $this->count_qty_product($product_id);
            //
            if($product_id != '') {
                $product['qty'] = $qty_product['qty'] - @$data['qty'][$key];
                //
                $this->db->where('product_id', $product_id);
                $result = $this->db->update('product', $product);
            }
        }
        return @$result;
    }

    function update_status($billing_id=null) {
        $data = $_POST;
        //get data billing
        $billing = $this->get_billing($billing_id);
        //
        if ($data['bayar_st'] == '2') {
            $data['bayar_date'] = NULL;
            $data['billing_date'] = $billing['billing_date'];
            $data['transfer_st'] = 2;
            $data['transfer_date'] = $billing['transfer_date'];
            $data['diterima_date'] = NULL;
        }else{
            $data['bayar_date'] = date('Y-m-d H:i:s');
            $data['transfer_st'] = 1;
            $data['billing_date'] = $billing['billing_date'];
            $data['transfer_date'] = $billing['transfer_date'];
            $data['diterima_date'] = NULL;
        }
        //
        $this->db->where('billing_id', $billing_id);
        $outp = $this->db->update('billing', $data);
        return outp_result($outp);
    }

    function update_kirim_st($billing_id=null, $customer_id=null) {
        $data = $_POST;
        //
        if ($data['kirim_st'] == '2') {
            $data['kirim_date'] = NULL;
            $data['jasa_nm'] = NULL;
            $data['no_resi'] = NULL;
        }else{
            $data['kirim_date'] = date('Y-m-d H:i:s');
            $data['kirim_st'] = 1;
        }
        //
        $array = array('billing_id' => $billing_id, 'customer_id' => $customer_id);
        $this->db->where($array);
        $outp = $this->db->update('checkout', $data);
        return $outp;
    }

    function upload_transfer($billing_id = "") {
        $data = $_POST;
        // get data billing
        $billing = $this->get_billing($billing_id);
        //
        $transfer_img = $_FILES['transfer_img']['name'];
        if ($transfer_img != '') {
            $data_change['transfer_img'] = $this->process_file('transfer_img','transfer_pembeli',@$billing_id);
        }
        //
        $data_change['transfer_date'] = date('Y-m-d H:i:s');
        $data_change['diterima_date'] = NULL;
        $data_change['billing_date'] = $billing['billing_date'];
        $data_change['bayar_date'] = NULL;
        $data_change['transfer_st'] = 2;
        //
        $this->db->where('billing_id', $billing_id);
        $outp = $this->db->update('billing',$data_change);
        return outp_result($outp);
    }

    function update_confirm($billing_id = "") {
        $data = $_POST;
        // get data billing
        $billing = $this->get_billing($billing_id);
        //
        $data_change['diterima_st'] = $data['diterima_st'];
        $data_change['diterima_date'] = date('Y-m-d H:i:s');
        $data_change['transfer_date'] = $billing['transfer_date'];
        $data_change['billing_date'] = $billing['billing_date'];
        $data_change['bayar_date'] = $billing['bayar_date'];
        //
        $this->db->where('billing_id', $billing_id);
        $outp = $this->db->update('billing',$data_change);
        return outp_result($outp);
    }

    function update_buyer_customer_st($billing_id, $customer_id) {
        $data = $_POST;
        // get data checkout
        $checkout = $this->get_only_checkout($billing_id,$customer_id);
        //upload image
        $bayar_customer_img = $_FILES['bayar_customer_img']['name'];
        if ($bayar_customer_img != '') {
            $data_change['bayar_customer_img'] = $this->process_file('bayar_customer_img','transfer_admin',@$billing_id);
        }
        //
        $data_change['bayar_customer_st'] = $data['bayar_customer_st'];
        $data_change['bayar_customer_date'] = date('Y-m-d H:i:s');
        $data_change['checkout_date'] = $checkout['checkout_date'];
        $data_change['kirim_date'] = $checkout['kirim_date'];
        //
        $array = array('billing_id' => $billing_id, 'customer_id' => $customer_id);
        $this->db->where($array);
        $outp = $this->db->update('checkout',$data_change);
        return outp_result($outp);
    }

    function process_file($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $billing = $this->get_billing($doc_id);
        // directory file
        $path_dir = "assets/images/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$billing[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES[$src_file_name]['name']));
        //
        // $image_no = md5(md5(@$billing['customer_id']));
        $image_no = md5(md5(@$doc_id));
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name']);
            } else {                
                $file_name = upload_post_image($config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name'], @$billing[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }

    function get_nama_bulan($ses_bulan=null) {
        $list_bulan = list_bulan();
        $result = '';
        foreach ($list_bulan as $key => $val) {
            if($ses_bulan == $key){
                $result = @$val;
            }
        }
        return $result;
    }

    function export_excel_harian_1(){
        // Get session
        $billing_date         = isset_session('ses_billing_date');
        $ses_status           = isset_session('ses_status');
        $ses_txt_search       = isset_session('ses_txt_search');
        $ses_tampilan_data_1  = isset_session('ses_tampilan_data_1');
        $ses_tampilan_data_2  = isset_session('ses_tampilan_data_2');
        //
        if ($billing_date !='') {
            $ses_billing_date = date('Y-m-d',strtotime($billing_date));
        }else {
            $ses_billing_date = "";
        }
        //
        $ses_billing_date     = ($ses_billing_date != '') ? convert_date_indo(@$ses_billing_date) : 'SEMUA';
        $ses_status           = ($ses_status != '') ? replace_status(@$ses_status) : 'SEMUA';
        $ses_txt_search       = ($ses_txt_search != '') ? @$ses_txt_search : 'SEMUA';

        // Data
        $list_buyer = $this->list_report_buyer();

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/report_per_day.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        // $title_rekap = "RESUME JUMLAH DATA MENARA TELEKOMUNIKASI DI WILAYAH KABUPATEN KEBUMEN";
        $title_file  = "Laporan Data Pembeli Harian";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("F7", ": ".$ses_billing_date);
        $PHPExcel->getActiveSheet()->setCellValue("F8", ": ".$ses_status);
        $PHPExcel->getActiveSheet()->setCellValue("F9", ": ".$ses_txt_search);
        $PHPExcel->getActiveSheet()->setCellValue("F11", ": ".count($list_buyer)." Pembeli");

        //align center
        $align_center = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        //align left
        $align_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        
        $i=$start_row=14;
        //Populating Body
        $no=1;
        foreach($list_buyer as $row){
            //
            $check_kirim_st = $this->check_kirim_st($row['billing_id']);
            //Status Pembelian
            $status_pembelian = "";
            $status_pembelian_1 = "";
            $status_pembelian_2 = "";
            if ($row['diterima_st'] == '1'){
                $status_pembelian = "(Sudah Diterima Pembeli) ";
            }else{
                if ($row['transfer_st'] == '2'){
                    $status_pembelian = "(Menunggu Konfirmasi Admin) ";
                }else{
                    if ($row['bayar_st'] == '1'){
                        $status_pembelian_1 = "(Sudah Bayar) ";
                    }elseif($row['bayar_st'] == '2'){
                        $status_pembelian_1 = "(Belum Bayar) ";
                    }
                }
                if ($check_kirim_st == '') {
                    $status_pembelian_2 = "(Sudah Dikirim Semua) ";
                }elseif($check_kirim_st !='') {
                    if ($row['bayar_st'] == '1') {
                        $status_pembelian_2 = "(Belum Dikirim Semua) ";
                    }
                }
            }
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", ($row['customer_id'] !='') ? $row['customer_nm'] : $row['pembeli_nm'] ); 
            $PHPExcel->getActiveSheet()->setCellValue("F$i", $row['billing_id']);
            $PHPExcel->getActiveSheet()->setCellValue("G$i", "Rp ".digit($row['product_total_price']));
            $PHPExcel->getActiveSheet()->setCellValue("I$i", convert_date_indo($row['billing_date']));
            $PHPExcel->getActiveSheet()->setCellValue("L$i", ($row['bayar_st'] == '1') ? convert_date_indo($row['bayar_date']) : '-');
            $PHPExcel->getActiveSheet()->setCellValue("O$i", ($row['diterima_st'] == '1') ? convert_date_indo($row['diterima_date']) : '-');
            $PHPExcel->getActiveSheet()->setCellValue("R$i", $status_pembelian.$status_pembelian_1.$status_pembelian_2);
            //
            $no++;
            $i++;
            $end_row = $i;

            //merge & center Nama Pembeli
            $PHPExcel->getActiveSheet()->getStyle("C$i:E$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("C$i:E$i");
            //merge & center Nominal
            $PHPExcel->getActiveSheet()->getStyle("G$i:H$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("G$i:H$i");
            //merge & center Tanggal Pembelian
            $PHPExcel->getActiveSheet()->getStyle("I$i:K$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("I$i:K$i");
            //merge & center Tanggal Bayar
            $PHPExcel->getActiveSheet()->getStyle("L$i:N$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("L$i:N$i");
            //merge & center Tanggal Diterima
            $PHPExcel->getActiveSheet()->getStyle("O$i:Q$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("O$i:Q$i");
            //merge & left Status Pembelian
            $PHPExcel->getActiveSheet()->getStyle("R$i:U$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("R$i:U$i");
            //align left
            $PHPExcel->getActiveSheet()->getStyle("G$i:H$i")->applyFromArray($align_left);
        }

        // Word Wrap
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setWrapText(true); 
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        
        //Creating Border -------------------------------------------------------------------
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
        );
        $last_cell = "U".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B13:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }

    function export_excel_harian_2(){
        // Get session
        $billing_date         = isset_session('ses_billing_date');
        $ses_status           = isset_session('ses_status');
        $ses_txt_search       = isset_session('ses_txt_search');
        $ses_tampilan_data_1  = isset_session('ses_tampilan_data_1');
        $ses_tampilan_data_2  = isset_session('ses_tampilan_data_2');
        //
        if ($billing_date !='') {
            $ses_billing_date = date('Y-m-d',strtotime($billing_date));
        }else {
            $ses_billing_date = "";
        }
        //
        $ses_billing_date     = ($ses_billing_date != '') ? convert_date_indo(@$ses_billing_date) : 'SEMUA';
        $ses_status           = ($ses_status != '') ? replace_status(@$ses_status) : 'SEMUA';
        $ses_txt_search       = ($ses_txt_search != '') ? @$ses_txt_search : 'SEMUA';

        // Data
        $list_buyer = $this->list_report_buyer();

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/report_per_day.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        // $title_rekap = "RESUME JUMLAH DATA MENARA TELEKOMUNIKASI DI WILAYAH KABUPATEN KEBUMEN";
        $title_file  = "Laporan Data Pembeli Harian";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("F7", ": ".$ses_billing_date);
        $PHPExcel->getActiveSheet()->setCellValue("F8", ": ".$ses_status);
        $PHPExcel->getActiveSheet()->setCellValue("F9", ": ".$ses_txt_search);
        $PHPExcel->getActiveSheet()->setCellValue("F11", ": ".count($list_buyer)." Pembeli");

        //align center
        $align_center = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        //align left
        $align_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        //fill color
        $fill_color_yellow = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF33')
            )
        );
        $fill_color_green = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '99FF99')
            )
        );
        $fill_color_header = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccd9ff')
            )
        );
        
        $i=$start_row=14;
        //Populating Body
        $no=1;
        foreach($list_buyer as $row){
        $check_kirim_st = $this->check_kirim_st($row['billing_id']);
        $list_seller = $this->list_seller_by_billing_id($row['billing_id']);
            //Status Pembelian
            $status_pembelian = "";
            $status_pembelian_1 = "";
            $status_pembelian_2 = "";
            if ($row['diterima_st'] == '1'){
                $status_pembelian = "(Sudah Diterima Pembeli) ";
            }else{
                if ($row['transfer_st'] == '2'){
                    $status_pembelian = "(Menunggu Konfirmasi Admin) ";
                }else{
                    if ($row['bayar_st'] == '1'){
                        $status_pembelian_1 = "(Sudah Bayar) ";
                    }elseif($row['bayar_st'] == '2'){
                        $status_pembelian_1 = "(Belum Bayar) ";
                    }
                }
                if ($check_kirim_st == '') {
                    $status_pembelian_2 = "(Sudah Dikirim Semua) ";
                }elseif($check_kirim_st !='') {
                    if ($row['bayar_st'] == '1') {
                        $status_pembelian_2 = "(Belum Dikirim Semua) ";
                    }
                }
            }
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", ($row['customer_id'] !='') ? $row['customer_nm'] : $row['pembeli_nm'] ); 
            $PHPExcel->getActiveSheet()->setCellValue("F$i", $row['billing_id']);
            $PHPExcel->getActiveSheet()->setCellValue("G$i", "Rp ".digit($row['product_total_price']));
            $PHPExcel->getActiveSheet()->setCellValue("I$i", convert_date_indo($row['billing_date']));
            $PHPExcel->getActiveSheet()->setCellValue("L$i", ($row['bayar_st'] == '1') ? convert_date_indo($row['bayar_date']) : '-');
            $PHPExcel->getActiveSheet()->setCellValue("O$i", ($row['diterima_st'] == '1') ? convert_date_indo($row['diterima_date']) : '-');
            $PHPExcel->getActiveSheet()->setCellValue("R$i", $status_pembelian.$status_pembelian_1.$status_pembelian_2);

            //Fill Color Nama Pembeli
            $PHPExcel->getActiveSheet()->getStyle("B$i:U$i")->applyFromArray($fill_color_yellow);

            $is_seller = $i+1;
            $no_seller=1;
            foreach($list_seller as $seller) {
            $kirim_st = $this->checkout_model->kirim_st($row['billing_id'], $seller['customer_id']);
            $list_product = $this->checkout_model->list_checkout_by_customer_id($seller['billing_id'], $seller['customer_id']);

                $PHPExcel->getActiveSheet()->setCellValue("D$is_seller", $seller["customer_nm"]); 
                //Fill Color Nama Pembeli
                $PHPExcel->getActiveSheet()->getStyle("D$is_seller:E$is_seller")->applyFromArray($fill_color_green);
                //merge & center Nama Pembeli
                $PHPExcel->getActiveSheet()->getStyle("D$is_seller:E$is_seller")->applyFromArray($align_left);
                $PHPExcel->getActiveSheet()->mergeCells("D$is_seller:U$is_seller");
                //
                $is_header_product = $is_seller+1;
                $is_product = $is_seller+2;
                $no_product=1;
                //
                $PHPExcel->getActiveSheet()->setCellValue("D$is_header_product", "No"); 
                $PHPExcel->getActiveSheet()->setCellValue("E$is_header_product", "Nama Produk"); 
                $PHPExcel->getActiveSheet()->setCellValue("G$is_header_product", "Jumlah"); 
                $PHPExcel->getActiveSheet()->setCellValue("I$is_header_product", "Nominal Per Produk"); 
                $PHPExcel->getActiveSheet()->setCellValue("N$is_header_product", "Status Pengiriman"); 
                //bold text
                $PHPExcel->getActiveSheet()->getStyle("D$is_header_product:Q$is_header_product")->getFont()->setBold(true);
                //align center
                $PHPExcel->getActiveSheet()->getStyle("D$is_header_product")->applyFromArray($align_center);
                $PHPExcel->getActiveSheet()->getStyle("G$is_header_product")->applyFromArray($align_center);
                $PHPExcel->getActiveSheet()->getStyle("I$is_header_product")->applyFromArray($align_center);
                $PHPExcel->getActiveSheet()->getStyle("N$is_header_product")->applyFromArray($align_center);
                //merge
                $PHPExcel->getActiveSheet()->mergeCells("E$is_header_product:F$is_header_product");
                $PHPExcel->getActiveSheet()->mergeCells("G$is_header_product:H$is_header_product");
                $PHPExcel->getActiveSheet()->mergeCells("I$is_header_product:M$is_header_product");
                $PHPExcel->getActiveSheet()->mergeCells("N$is_header_product:P$is_header_product");
                $PHPExcel->getActiveSheet()->getRowDimension($is_header_product)->setRowHeight(21);
                //fill color
                $PHPExcel->getActiveSheet()->getStyle("D$is_header_product:P$is_header_product")->applyFromArray($fill_color_header);
                //
                foreach ($list_product as $product) {
                    $PHPExcel->getActiveSheet()->setCellValue("D$is_product", $no_product); 
                    $PHPExcel->getActiveSheet()->setCellValue("E$is_product", $product["product_nm"]); 
                    $PHPExcel->getActiveSheet()->setCellValue("G$is_product", $product["product_qty"]." ".$product['product_qty_unit']); 
                    $PHPExcel->getActiveSheet()->setCellValue("I$is_product", "Rp ".digit($product["product_price"])." x ".$product['product_qty']." ".$product['product_qty_unit']." = Rp ".digit($product['product_sub_price'])); 
                    $PHPExcel->getActiveSheet()->setCellValue("N$is_product", ($kirim_st['kirim_st'] == '1') ? 'Sudah Dikirim' : 'Belum Dikirim'); 
                    //align center
                    $PHPExcel->getActiveSheet()->getStyle("D$is_product")->applyFromArray($align_center);
                    $PHPExcel->getActiveSheet()->getStyle("G$is_product")->applyFromArray($align_center);
                    $PHPExcel->getActiveSheet()->getStyle("I$is_product")->applyFromArray($align_center);
                    $PHPExcel->getActiveSheet()->getStyle("N$is_product")->applyFromArray($align_center);
                    //merge
                    $PHPExcel->getActiveSheet()->mergeCells("E$is_product:F$is_product");
                    $PHPExcel->getActiveSheet()->mergeCells("G$is_product:H$is_product");
                    $PHPExcel->getActiveSheet()->mergeCells("I$is_product:M$is_product");
                    $PHPExcel->getActiveSheet()->mergeCells("N$is_product:P$is_product");
                    //
                    $no_product++;
                    $is_product++;
                }
                //
                $no_seller++;
                // $is_seller++;
                $is_seller = $is_product;
            }   
            //
            $no++;
            $i = $is_seller;
            $end_row = $i;

            //merge & center Nama Pembeli
            $PHPExcel->getActiveSheet()->getStyle("C$i:E$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("C$i:E$i");
            //merge & center Nominal
            $PHPExcel->getActiveSheet()->getStyle("G$i:H$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("G$i:H$i");
            //merge & center Tanggal Pembelian
            $PHPExcel->getActiveSheet()->getStyle("I$i:K$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("I$i:K$i");
            //merge & center Tanggal Bayar
            $PHPExcel->getActiveSheet()->getStyle("L$i:N$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("L$i:N$i");
            //merge & center Tanggal Diterima
            $PHPExcel->getActiveSheet()->getStyle("O$i:Q$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("O$i:Q$i");
            //merge & left Status Pembelian
            $PHPExcel->getActiveSheet()->getStyle("R$i:U$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("R$i:U$i");
            //align left
            $PHPExcel->getActiveSheet()->getStyle("G$i:H$i")->applyFromArray($align_left);
        }

        // Word Wrap
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setWrapText(true); 
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        
        //Creating Border -------------------------------------------------------------------
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
        );
        $last_cell = "U".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B13:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }

    function export_excel_bulanan_1(){
        // Get session
        $ses_bulan            = isset_session('ses_bulan');
        $ses_tahun            = isset_session('ses_tahun');
        $ses_status           = isset_session('ses_status');
        $ses_txt_search       = isset_session('ses_txt_search');
        $ses_tampilan_data_1  = isset_session('ses_tampilan_data_1');
        $ses_tampilan_data_2  = isset_session('ses_tampilan_data_2');
        //
        $nama_bulan = $this->get_nama_bulan($ses_bulan);
        //
        $ses_bulan            = ($ses_bulan != '') ? @$nama_bulan : 'SEMUA';
        $ses_tahun            = ($ses_tahun != '') ? @$ses_tahun : 'SEMUA';
        $ses_status           = ($ses_status != '') ? replace_status(@$ses_status) : 'SEMUA';
        $ses_txt_search       = ($ses_txt_search != '') ? @$ses_txt_search : 'SEMUA';

        // Data
        $list_buyer = $this->list_report_buyer();

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/report_per_month.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        // $title_rekap = "RESUME JUMLAH DATA MENARA TELEKOMUNIKASI DI WILAYAH KABUPATEN KEBUMEN";
        $title_file  = "Laporan Data Pembeli Bulanan";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("F7", ": ".$ses_bulan." - ".$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("F8", ": ".$ses_status);
        $PHPExcel->getActiveSheet()->setCellValue("F9", ": ".$ses_txt_search);
        $PHPExcel->getActiveSheet()->setCellValue("F11", ": ".count($list_buyer)." Pembeli");

        //align center
        $align_center = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        //align left
        $align_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        
        $i=$start_row=14;
        //Populating Body
        $no=1;
        foreach($list_buyer as $row){
            //
            $check_kirim_st = $this->check_kirim_st($row['billing_id']);
            //Status Pembelian
            $status_pembelian = "";
            $status_pembelian_1 = "";
            $status_pembelian_2 = "";
            if ($row['diterima_st'] == '1'){
                $status_pembelian = "(Sudah Diterima Pembeli) ";
            }else{
                if ($row['transfer_st'] == '2'){
                    $status_pembelian = "(Menunggu Konfirmasi Admin) ";
                }else{
                    if ($row['bayar_st'] == '1'){
                        $status_pembelian_1 = "(Sudah Bayar) ";
                    }elseif($row['bayar_st'] == '2'){
                        $status_pembelian_1 = "(Belum Bayar) ";
                    }
                }
                if ($check_kirim_st == '') {
                    $status_pembelian_2 = "(Sudah Dikirim Semua) ";
                }elseif($check_kirim_st !='') {
                    if ($row['bayar_st'] == '1') {
                        $status_pembelian_2 = "(Belum Dikirim Semua) ";
                    }
                }
            }
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", ($row['customer_id'] !='') ? $row['customer_nm'] : $row['pembeli_nm'] ); 
            $PHPExcel->getActiveSheet()->setCellValue("F$i", $row['billing_id']);
            $PHPExcel->getActiveSheet()->setCellValue("G$i", "Rp ".digit($row['product_total_price']));
            $PHPExcel->getActiveSheet()->setCellValue("I$i", convert_date_indo($row['billing_date']));
            $PHPExcel->getActiveSheet()->setCellValue("L$i", ($row['bayar_st'] == '1') ? convert_date_indo($row['bayar_date']) : '-');
            $PHPExcel->getActiveSheet()->setCellValue("O$i", ($row['diterima_st'] == '1') ? convert_date_indo($row['diterima_date']) : '-');
            $PHPExcel->getActiveSheet()->setCellValue("R$i", $status_pembelian.$status_pembelian_1.$status_pembelian_2);
            //
            $no++;
            $i++;
            $end_row = $i;

            //merge & center Nama Pembeli
            $PHPExcel->getActiveSheet()->getStyle("C$i:E$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("C$i:E$i");
            //merge & center Nominal
            $PHPExcel->getActiveSheet()->getStyle("G$i:H$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("G$i:H$i");
            //merge & center Tanggal Pembelian
            $PHPExcel->getActiveSheet()->getStyle("I$i:K$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("I$i:K$i");
            //merge & center Tanggal Bayar
            $PHPExcel->getActiveSheet()->getStyle("L$i:N$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("L$i:N$i");
            //merge & center Tanggal Diterima
            $PHPExcel->getActiveSheet()->getStyle("O$i:Q$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("O$i:Q$i");
            //merge & left Status Pembelian
            $PHPExcel->getActiveSheet()->getStyle("R$i:U$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("R$i:U$i");
            //align left
            $PHPExcel->getActiveSheet()->getStyle("G$i:H$i")->applyFromArray($align_left);
        }

        // Word Wrap
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setWrapText(true); 
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        
        //Creating Border -------------------------------------------------------------------
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
        );
        $last_cell = "U".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B13:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }

    function export_excel_bulanan_2(){
        // Get session
        $ses_bulan            = isset_session('ses_bulan');
        $ses_tahun            = isset_session('ses_tahun');
        $ses_status           = isset_session('ses_status');
        $ses_txt_search       = isset_session('ses_txt_search');
        $ses_tampilan_data_1  = isset_session('ses_tampilan_data_1');
        $ses_tampilan_data_2  = isset_session('ses_tampilan_data_2');
        //
        $nama_bulan = $this->get_nama_bulan($ses_bulan);
        //
        $ses_bulan            = ($ses_bulan != '') ? @$nama_bulan : 'SEMUA';
        $ses_tahun            = ($ses_tahun != '') ? @$ses_tahun : 'SEMUA';
        $ses_status           = ($ses_status != '') ? replace_status(@$ses_status) : 'SEMUA';
        $ses_txt_search       = ($ses_txt_search != '') ? @$ses_txt_search : 'SEMUA';

        // Data
        $list_buyer = $this->list_report_buyer();

        $this->load->file(APPPATH.'libraries/PHPExcel.php');
        $master_cetak = BASEPATH.'master_cetak/report_per_month.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);
        $PHPExcel->setActiveSheetIndex(0);
        
        // Header        
        // $title_rekap = "RESUME JUMLAH DATA MENARA TELEKOMUNIKASI DI WILAYAH KABUPATEN KEBUMEN";
        $title_file  = "Laporan Data Pembeli Bulanan";     
        //

        // $PHPExcel->getActiveSheet()->setCellValue("B3", $title_rekap);
        $PHPExcel->getActiveSheet()->setCellValue("F7", ": ".$ses_bulan." - ".$ses_tahun);
        $PHPExcel->getActiveSheet()->setCellValue("F8", ": ".$ses_status);
        $PHPExcel->getActiveSheet()->setCellValue("F9", ": ".$ses_txt_search);
        $PHPExcel->getActiveSheet()->setCellValue("F11", ": ".count($list_buyer)." Pembeli");

        //align center
        $align_center = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        //align left
        $align_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        //fill color
        $fill_color_yellow = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFFF33')
            )
        );
        $fill_color_green = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '99FF99')
            )
        );
        $fill_color_header = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ccd9ff')
            )
        );
        
        $i=$start_row=14;
        //Populating Body
        $no=1;
        foreach($list_buyer as $row){
        $check_kirim_st = $this->check_kirim_st($row['billing_id']);
        $list_seller = $this->list_seller_by_billing_id($row['billing_id']);
            //Status Pembelian
            $status_pembelian = "";
            $status_pembelian_1 = "";
            $status_pembelian_2 = "";
            if ($row['diterima_st'] == '1'){
                $status_pembelian = "(Sudah Diterima Pembeli) ";
            }else{
                if ($row['transfer_st'] == '2'){
                    $status_pembelian = "(Menunggu Konfirmasi Admin) ";
                }else{
                    if ($row['bayar_st'] == '1'){
                        $status_pembelian_1 = "(Sudah Bayar) ";
                    }elseif($row['bayar_st'] == '2'){
                        $status_pembelian_1 = "(Belum Bayar) ";
                    }
                }
                if ($check_kirim_st == '') {
                    $status_pembelian_2 = "(Sudah Dikirim Semua) ";
                }elseif($check_kirim_st !='') {
                    if ($row['bayar_st'] == '1') {
                        $status_pembelian_2 = "(Belum Dikirim Semua) ";
                    }
                }
            }
            //
            $PHPExcel->getActiveSheet()->setCellValue("B$i", $no);                   
            $PHPExcel->getActiveSheet()->setCellValue("C$i", ($row['customer_id'] !='') ? $row['customer_nm'] : $row['pembeli_nm'] ); 
            $PHPExcel->getActiveSheet()->setCellValue("F$i", $row['billing_id']);
            $PHPExcel->getActiveSheet()->setCellValue("G$i", "Rp ".digit($row['product_total_price']));
            $PHPExcel->getActiveSheet()->setCellValue("I$i", convert_date_indo($row['billing_date']));
            $PHPExcel->getActiveSheet()->setCellValue("L$i", ($row['bayar_st'] == '1') ? convert_date_indo($row['bayar_date']) : '-');
            $PHPExcel->getActiveSheet()->setCellValue("O$i", ($row['diterima_st'] == '1') ? convert_date_indo($row['diterima_date']) : '-');
            $PHPExcel->getActiveSheet()->setCellValue("R$i", $status_pembelian.$status_pembelian_1.$status_pembelian_2);

            //Fill Color Nama Pembeli
            $PHPExcel->getActiveSheet()->getStyle("B$i:U$i")->applyFromArray($fill_color_yellow);

            $is_seller = $i+1;
            $no_seller=1;
            foreach($list_seller as $seller) {
            $kirim_st = $this->checkout_model->kirim_st($row['billing_id'], $seller['customer_id']);
            $list_product = $this->checkout_model->list_checkout_by_customer_id($seller['billing_id'], $seller['customer_id']);

                $PHPExcel->getActiveSheet()->setCellValue("D$is_seller", $seller["customer_nm"]); 
                //Fill Color Nama Pembeli
                $PHPExcel->getActiveSheet()->getStyle("D$is_seller:E$is_seller")->applyFromArray($fill_color_green);
                //merge & center Nama Pembeli
                $PHPExcel->getActiveSheet()->getStyle("D$is_seller:E$is_seller")->applyFromArray($align_left);
                $PHPExcel->getActiveSheet()->mergeCells("D$is_seller:U$is_seller");
                //
                $is_header_product = $is_seller+1;
                $is_product = $is_seller+2;
                $no_product=1;
                //
                $PHPExcel->getActiveSheet()->setCellValue("D$is_header_product", "No"); 
                $PHPExcel->getActiveSheet()->setCellValue("E$is_header_product", "Nama Produk"); 
                $PHPExcel->getActiveSheet()->setCellValue("G$is_header_product", "Jumlah"); 
                $PHPExcel->getActiveSheet()->setCellValue("I$is_header_product", "Nominal Per Produk"); 
                $PHPExcel->getActiveSheet()->setCellValue("N$is_header_product", "Status Pengiriman"); 
                //bold text
                $PHPExcel->getActiveSheet()->getStyle("D$is_header_product:Q$is_header_product")->getFont()->setBold(true);
                //align center
                $PHPExcel->getActiveSheet()->getStyle("D$is_header_product")->applyFromArray($align_center);
                $PHPExcel->getActiveSheet()->getStyle("G$is_header_product")->applyFromArray($align_center);
                $PHPExcel->getActiveSheet()->getStyle("I$is_header_product")->applyFromArray($align_center);
                $PHPExcel->getActiveSheet()->getStyle("N$is_header_product")->applyFromArray($align_center);
                //merge
                $PHPExcel->getActiveSheet()->mergeCells("E$is_header_product:F$is_header_product");
                $PHPExcel->getActiveSheet()->mergeCells("G$is_header_product:H$is_header_product");
                $PHPExcel->getActiveSheet()->mergeCells("I$is_header_product:M$is_header_product");
                $PHPExcel->getActiveSheet()->mergeCells("N$is_header_product:P$is_header_product");
                $PHPExcel->getActiveSheet()->getRowDimension($is_header_product)->setRowHeight(21);
                //fill color
                $PHPExcel->getActiveSheet()->getStyle("D$is_header_product:P$is_header_product")->applyFromArray($fill_color_header);
                //
                foreach ($list_product as $product) {
                    $PHPExcel->getActiveSheet()->setCellValue("D$is_product", $no_product); 
                    $PHPExcel->getActiveSheet()->setCellValue("E$is_product", $product["product_nm"]); 
                    $PHPExcel->getActiveSheet()->setCellValue("G$is_product", $product["product_qty"]." ".$product['product_qty_unit']); 
                    $PHPExcel->getActiveSheet()->setCellValue("I$is_product", "Rp ".digit($product["product_price"])." x ".$product['product_qty']." ".$product['product_qty_unit']." = Rp ".digit($product['product_sub_price'])); 
                    $PHPExcel->getActiveSheet()->setCellValue("N$is_product", ($kirim_st['kirim_st'] == '1') ? 'Sudah Dikirim' : 'Belum Dikirim'); 
                    //align center
                    $PHPExcel->getActiveSheet()->getStyle("D$is_product")->applyFromArray($align_center);
                    $PHPExcel->getActiveSheet()->getStyle("G$is_product")->applyFromArray($align_center);
                    $PHPExcel->getActiveSheet()->getStyle("I$is_product")->applyFromArray($align_center);
                    $PHPExcel->getActiveSheet()->getStyle("N$is_product")->applyFromArray($align_center);
                    //merge
                    $PHPExcel->getActiveSheet()->mergeCells("E$is_product:F$is_product");
                    $PHPExcel->getActiveSheet()->mergeCells("G$is_product:H$is_product");
                    $PHPExcel->getActiveSheet()->mergeCells("I$is_product:M$is_product");
                    $PHPExcel->getActiveSheet()->mergeCells("N$is_product:P$is_product");
                    //
                    $no_product++;
                    $is_product++;
                }
                //
                $no_seller++;
                // $is_seller++;
                $is_seller = $is_product;
            }   
            //
            $no++;
            $i = $is_seller;
            $end_row = $i;

            //merge & center Nama Pembeli
            $PHPExcel->getActiveSheet()->getStyle("C$i:E$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("C$i:E$i");
            //merge & center Nominal
            $PHPExcel->getActiveSheet()->getStyle("G$i:H$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("G$i:H$i");
            //merge & center Tanggal Pembelian
            $PHPExcel->getActiveSheet()->getStyle("I$i:K$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("I$i:K$i");
            //merge & center Tanggal Bayar
            $PHPExcel->getActiveSheet()->getStyle("L$i:N$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("L$i:N$i");
            //merge & center Tanggal Diterima
            $PHPExcel->getActiveSheet()->getStyle("O$i:Q$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->mergeCells("O$i:Q$i");
            //merge & left Status Pembelian
            $PHPExcel->getActiveSheet()->getStyle("R$i:U$i")->applyFromArray($align_left);
            $PHPExcel->getActiveSheet()->mergeCells("R$i:U$i");
            //align left
            $PHPExcel->getActiveSheet()->getStyle("G$i:H$i")->applyFromArray($align_left);
        }

        // Word Wrap
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setWrapText(true); 
        // $PHPExcel->getActiveSheet()->getStyle("D12:AC$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        
        //Creating Border -------------------------------------------------------------------
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
        );
        $last_cell = "U".($i-1);
        $PHPExcel->getActiveSheet()->getStyle("B13:$last_cell")->applyFromArray($styleArray);
        //-----------------------------------------------------------------------------------
        
        // Save it as file ------------------------------------------------------------------
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="'.$title_file.'.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        //-----------------------------------------------------------------------------------
    
    }

}
