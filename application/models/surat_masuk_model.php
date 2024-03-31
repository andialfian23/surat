<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_masuk_model extends CI_Model {
    
    var $table = 't_surat_masuk';
    
    public function get_datatables($column_order, $xBegin = null, $xEnd = null, $kode_fak=null)
    {
        $column_search = $column_order;
        
        $this->db->from($this->table);
        

        if($xBegin !=null){
            $this->db->where('tgl_masuk >=', $xBegin.' 00:00:00');
        }
        
        if($xEnd !=null){
            $this->db->where('tgl_masuk <=', $xEnd.' 23:59:59');
        }
        
        if($kode_fak !=null){
            $this->db->where('kode_fak',$kode_fak);
        }
 
        $i = 0;
        foreach ($column_search as $item) 
        {
            if ($_POST['search']['value']) 
            {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        
        if (isset($_POST['order'])) {
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            $this->db->order_by('tgl_masuk','ASC');
            $this->db->order_by('no_surat_masuk','ASC');
        }
        
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        } 

        $query = $this->db->get();
        if ($query) {
            return $query;
        }else{
            return false;
        }
    }

    public function total_entri($xBegin = null, $xEnd = null,$kode_fak=null)
    {
        $this->db->from($this->table);
                
        if($xBegin !=null){
            $this->db->where('tgl_masuk >=',$xBegin.' 00:00:00');
        }
        
        if($xEnd !=null){
            $this->db->where('tgl_masuk <=',$xEnd.' 23:59:59');
        }

        if($kode_fak !=null){
            $this->db->where('kode_fak',$kode_fak);
        }
        
        return $this->db->count_all_results();
    }

    public function get_surat_masuk($where){
        return $this->db->get_where($this->table,$where);
    }
}