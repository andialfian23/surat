<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class global_model extends CI_model {

    public function insert_data($table, $values){
        return $this->db->insert($table, $values);
    }

    public function update_data($table, $set, $where){
        $this->db->where($where);
        return $this->db->update($table, $set);
    }

    public function delete_data($table, $where){
        return $this->db->delete($table, $where);
    }

    // login
    public function auth($username,$password){
        return $this->db->select('*')->from('t_user')
        ->where('username',$username)
        ->where('password',md5($password))->get();
    }

    //fakultas
    public function fakultas(){
        // KODE FAK
        // 1 | FISIP	
        // 2 | FKIP
        // 3 | FEB
        // 4 | FAPERTA
        // 5 | FAI
        // 6 | FT
        // 7 | FH
        return [
            [
                'kode_fak' => 1,
                'nama_fak' => 'FISIP'
            ], [
                'kode_fak' => 2,
                'nama_fak' => 'FKIP'
            ], [
                'kode_fak' => 3,
                'nama_fak' => 'Ekonomi Bisnis'
            ], [
                'kode_fak' => 4,
                'nama_fak' => 'Pertanian'
            ], [
                'kode_fak' => 5,
                'nama_fak' => 'Agama Islam'
            ], [
                'kode_fak' => 6,
                'nama_fak' => 'Teknik'
            ], [
                'kode_fak' => 7,
                'nama_fak' => 'Hukum'
            ],
        ];
    }

    //kategori 
    public function kategori($jenis=null){
        if($jenis!=null){
            $this->db->where('jenis',$jenis);
        }

        return $this->db->get('t_kategori_surat');
    }

    // upload file
    public function upload_file($field, $lokasi){
        $config['upload_path'] = './'.$lokasi;
        $config['allowed_types'] = 'pdf|jpg|png';
        $config['max_size'] = '7000';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($field)) {
            return $this->upload->data('file_name');
        } else {
            return false;
        }
    }
}

?>