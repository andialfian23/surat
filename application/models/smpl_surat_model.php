<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class smpl_surat_model extends CI_Model {
    
    var $table = 't_sample_surat';
    
    public function get_data($id_sample=null,$jenis=null,$kode_fak=0)
    {
        $this->db->select('k.nama_kategori,k.jenis, s.*');
        $this->db->from($this->table.' s');
        $this->db->join('t_kategori_surat as k','s.id_kategori=k.id_kategori','INNER');

        if($id_sample!=null){
            $this->db->where('id_sample_surat',$id_sample);
        }
        
        if($jenis!=null){
            $this->db->where('jenis',$jenis);
        }
        
        if($kode_fak!=0){
            $this->db->where('kode_fak',$kode_fak);
        }

        $this->db->order_by('nama_surat','ASC');
        return $this->db->get();
    }
}