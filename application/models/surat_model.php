<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_model extends CI_Model {
    public function get_data(){
        return $this->db->select('a.*, nama_kategori, jenis')
        ->from('t_surat_permohonan as a')
        ->join('t_sample_surat as b','a.id_sample_surat=b.id_sample_surat','INNER')
        ->join('t_kategori_surat as c','b.id_kategori=c.id_kategori','INNER')
        ->order_by('tgl_permohonan','DESC')
        ->get();
    }
}