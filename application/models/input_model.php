<?php
class Input_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function insert() {
        $data = $_POST;   
        //
        $data_post['produk_nm']     = $data['produk_nm'];
        $data_post['produk_desc']   = $data['produk_desc'];
        $data_post['produk_harga']  = anti_injection($data['produk_harga']);
        $outp = $this->db->insert('tbl_produk', $data_post);        
        //
        $id_produk = $this->db->insert_id();
        $this->image_model->insert_from_product($id_produk);
        //
        return outp_result($outp);
    }

    function update($id_produk=null) {
        $data = $_POST;
        //
        $data_post['produk_nm']     = $data['produk_nm'];
        $data_post['produk_desc']   = $data['produk_desc'];
        $data_post['produk_harga']  = anti_injection($data['produk_harga']);
        $this->db->where('id_produk', $id_produk);
        $outp = $this->db->update('tbl_produk', $data_post);        
        //
        $this->image_model->insert_from_product($id_produk,'update');
        //
        return outp_result($outp);
    }

    function delete($id_produk=null) {
        $this->db->where('id_produk', $id_produk);
        $outp = $this->db->delete('tbl_produk');
        //
        $this->image_model->delete_from_product($id_produk);
        //
        return outp_result($outp,'delete');
    }
}
