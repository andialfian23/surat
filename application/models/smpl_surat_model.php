<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class smpl_surat_model extends CI_Model {
    
    var $table = 't_sample_surat';
    
    public function get_data()
    {
        $this->db->select('k.nama_kategori, s.*');
        $this->db->from($this->table.' s');
        $this->db->join('t_kategori_surat as k','s.id_kategori=k.id_kategori','INNER');
        $this->db->order_by('nama_surat','ASC');
        return $this->db->get();
    }
}