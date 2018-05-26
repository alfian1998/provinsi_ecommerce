<?php
class Slideshow_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function where_slideshow() {
        $ses_txt_search = @$_SESSION['ses_txt_search'];
        //
        $sql_where = "";
        if($ses_txt_search != '')  $sql_where .= " AND a.slideshow_title LIKE '%$ses_txt_search%'";
        return $sql_where;
    }

    function paging_slideshow($p = 1, $o = 0) {
        $sql_where = $this->where_slideshow();
        //
        $sql = "SELECT 
                    COUNT(slideshow_id) AS count_data 
                FROM mst_slideshow a 
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

    function list_slideshow($o = 0, $offset = 0, $limit = 100) {
        $sql_where = $this->where_slideshow();
        $sql_paging = " LIMIT ".$offset.",".$limit;
        //
    	$sql = "SELECT 
                    a.* 
                FROM mst_slideshow a 
                WHERE 1 
                    $sql_where 
                ORDER BY a.slideshow_st DESC, a.slideshow_id DESC 
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

    function get_slideshow($slideshow_id=null) {
        $sql = "SELECT * FROM mst_slideshow WHERE slideshow_id=?";
        $query = $this->db->query($sql, $slideshow_id);
        $result = $query->row_array();
        //
        $result['slideshow_images'] = $this->image_model->get_image_by_slideshow($result['slideshow_id']);        
        return $result;
    }

    function get_slideshow_active() {
        $sql = "SELECT * FROM mst_slideshow WHERE slideshow_st='1'";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            $result = $query->row_array();
            $result['slideshow_images'] = $this->image_model->get_image_by_slideshow($result['slideshow_id']);      
        } else {
            $result = false;
        }          
        return $result;
    }

    function insert() {
        $data = $_POST;
        $data_slideshow['slideshow_title']  = $data['slideshow_title'];
        $data_slideshow['slideshow_description'] = $data['slideshow_description'];
        $data_slideshow['slideshow_url']    = $data['slideshow_url'];
        $data_slideshow['slideshow_date']   = date('Y-m-d H:i:s');
        $data_slideshow['slideshow_st']     = $data['slideshow_st'];
        //
        if($data['slideshow_st'] == '1') $this->update_status_all('0');  // deactive
        //
        $outp = $this->db->insert('mst_slideshow', $data_slideshow);
        //
        $slideshow_id = $this->db->insert_id();
        $this->image_model->insert_from_slideshow($slideshow_id);
        //     
        return outp_result($outp);
    }

    function update($id=null) {
        $data = $_POST;
        $data_slideshow['slideshow_title']  = $data['slideshow_title'];
        $data_slideshow['slideshow_description'] = $data['slideshow_description'];
        $data_slideshow['slideshow_url']    = $data['slideshow_url'];
        $data_slideshow['slideshow_date']   = date('Y-m-d H:i:s');
        $data_slideshow['slideshow_st']     = $data['slideshow_st'];
        //
        if($data['slideshow_st'] == '1') $this->update_status_all('0');  // deactive
        //
        $this->db->where('slideshow_id', $id);
        $outp = $this->db->update('mst_slideshow', $data_slideshow);
        //
        $slideshow_id = $id;
        $this->image_model->insert_from_slideshow($slideshow_id);
        //       
        return outp_result($outp);
    }

    function update_status_all($slideshow_st=null) {
        $sql = "UPDATE mst_slideshow SET slideshow_st=?";
        $query = $this->db->query($sql, $slideshow_st);
        return $query;
    }

    function delete($id=null) {
        $this->db->where('slideshow_id', $id);
        $outp = $this->db->delete('mst_slideshow');
        //
        $this->image_model->delete_from_slideshow($id);
        //
        return outp_result($outp,'delete');
    }
    

}
