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
        // Upload img
        $bank_img = $_FILES['bank_img']['name'];
        if ($bank_img != '') {
            $data['bank_img'] = $this->process_file('bank_img','logo_bank','');
        }
        //
        $outp = $this->db->insert('mst_bank', $data);
        return outp_result($outp);
    }

    function update($bank_id=null) {
        $data = $_POST;
        //
        $data['update_date'] = date('Y-m-d H:i:s');
        // Upload img
        $bank_img = $_FILES['bank_img']['name'];
        if ($bank_img != '') {
            $data['bank_img'] = $this->process_file('bank_img','logo_bank',@$bank_id);
        }
        //
        $this->db->where('bank_id', $bank_id);
        $outp = $this->db->update('mst_bank', $data);
        return outp_result($outp);
    }

    function delete($bank_id=null) {
        $bank = $this->get_bank($bank_id);
        $this->delete_file_process($bank['bank_img']);
        //
        $this->db->where('bank_id', $bank_id);
        $outp = $this->db->delete('mst_bank');
        return outp_result($outp,'delete');
    }

    function process_file($src_file_name = null, $src_file_location = null, $doc_id = null) {
        $config = $this->config_model->get_config();
        // data
        $bank = $this->get_bank($doc_id);
        // directory file
        $path_dir = "assets/images/". $src_file_location."/";
        $date = date('dmy');
        //
        $result             = @$bank[$src_file_location];
        $file_tmp_name      = @$_FILES[$src_file_name]['tmp_name'];
        $file_size          = @$_FILES[$src_file_name]['size'];
        $clean_file_name    = clean_url(get_file_name(@$_FILES[$src_file_name]['name']));
        //
        $image_no = md5(md5(@$bank['bank_id']));
        //
        if($file_tmp_name != '') {
            if($doc_id == '') {
                $file_name = $this->compress_image($src_file_name, $config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name']);
            } else {                
                $file_name = $this->compress_image($src_file_name, $config['subdomain'], $date, $image_no, $path_dir, $file_tmp_name, @$_FILES[$src_file_name]['name'], @$bank[$src_file_name]);
            }   
            //
            $result = $file_name;
        }
        //
        return $result;
    }

    function compress_image($src_file_name=null, $subdomain=null, $date=null, $image_no=null, $path_dir=null, $file_tmp_name=null, $file_name=null, $old_file=null) {
        //
        $this->load->library('upload');
        $this->load->library('image_lib');
        //
        $name_img = no_upload_images($subdomain, $date, $image_no, $path_dir, $file_tmp_name, $file_name, $old_file);
        //
        $config['file_name'] = $name_img;
        $config['upload_path'] = $path_dir; //path folder
        $config['allowed_types'] = 'jpg|png|jpeg|gif'; //type yang dapat diakses bisa anda sesuaikan
 
        $this->upload->initialize($config);
        if(!empty($file_name)){
            if ($this->upload->do_upload($src_file_name)){
                $gbr = array('upload_data' => $this->upload->data()); 
                // cek resolusi gambar
                $nama_gambar = $path_dir.$gbr['upload_data']['file_name'];
                $data = getimagesize($nama_gambar);
                $width = $data[0];
                $height = $data[1];
                // pembagian
                $bagi_width = $width / 5;
                $bagi_height = $height / 5;
                //Compress Image
                $config['image_library']='gd2';
                $config['source_image'] = $gbr['upload_data']['full_path'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= $bagi_width;
                $config['height']= $bagi_height;
                $config['new_image']= $path_dir.$gbr['upload_data']['file_name'];
                $this->image_lib->initialize($config);
                // $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $this->image_lib->clear();
 
                $gambar_1=$gbr['upload_data']['file_name'];
            }
            //
            $compress_image = no_upload_images($subdomain, $date, $image_no, $path_dir, $file_tmp_name, @$gambar_1);
            return $compress_image;          
        }   
    }

    function delete_image($bank_id=null) {
        $bank = $this->get_bank($bank_id);
        $this->delete_file_process($bank['bank_img']);
        //
        $data['bank_img'] = '';
        $this->db->where('bank_id', $bank_id);
        $result = $this->db->update('mst_bank', $data);
        return $result;
    }

    function delete_file_process($bank_img=null) {
        $path_dir = "assets/images/logo_bank/";
        $result = unlink($path_dir . $bank_img);
        return $result;
    }
    
}
