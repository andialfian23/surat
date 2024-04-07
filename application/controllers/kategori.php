<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
    }
    
	public function index()
	{
        $data['judul'] = 'Kategori';
        $data['kategori'] = $this->db->get('t_kategori_surat');
        $data['view'] = 'kategori/index_kategori';
        $this->load->view('index',$data);
	}
    
	public function create()
	{
        $notif = [
            'required'=> "{field} Harus di isi",
        ];
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required', $notif);
        $this->form_validation->set_rules('jenis', 'Jenis', 'trim|required', $notif);
        
        if($this->form_validation->run() == false){
            $data['judul'] = 'Tambah Kategori';
            $data['view'] = 'kategori/i_kategori';
            $this->load->view('index',$data);
        }else{
            $this->insert();
        }
	}

    private function insert(){
        $values = [
            'nama_kategori' => $this->input->post('nama_kategori',TRUE),
            'jenis' => $this->input->post('jenis',TRUE),
        ];
        $this->db->insert('t_kategori_surat',$values);
        notifikasi(true,'Berhasil Menyimpan Database');
        redirect(base_url('kategori'));
    }
    
	public function edit($id_kategori)
	{
        $notif = [
            'required'=> "{field} Harus di isi",
        ];
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required', $notif);
        $this->form_validation->set_rules('jenis', 'Jenis', 'trim|required', $notif);
        
        if($this->form_validation->run() == false){
            $data['judul'] = 'Edit Kategori';
            $data['kategori'] = $this->db->get_where('t_kategori_surat',['id_kategori'=>$id_kategori])->row();
            $data['view'] = 'kategori/e_kategori';
            $this->load->view('index',$data);
        }else{
            $this->update($id_kategori);
        }
	}

    private function update( $id_kategori){
        $set = [
            'nama_kategori' => $this->input->post('nama_kategori',TRUE),
            'jenis' => $this->input->post('jenis',TRUE),
        ];
        $this->db->where('id_kategori',$id_kategori)->update('t_kategori_surat',$set);
        notifikasi(true,'Berhasil Mengubah Database');
        redirect(base_url('kategori'));
    }

    public function delete($id_kategori)
	{
        $this->db->where('id_kategori',$id_kategori)->delete('t_kategori_surat');
        notifikasi(true,'Berhasil Menghapus Database');
        redirect(base_url('kategori'));
	}
}