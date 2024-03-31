<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sample_surat extends CI_Controller {

    var $table = 't_sample_surat';
    
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] > 2){
            redirect(base_url('dashboard'));
        }
        $this->load->model('smpl_surat_model','smpl_surat');
    }

    public function index(){
        $data['judul'] = 'Data Surat';
        $data['sample_surat'] = $this->smpl_surat->get_data()->result();
        $data['view'] = 'sample_surat/index_sample_surat';
        $this->load->view('index',$data);
    }

    public function create(){
        $notif = [
            'required'=> "{field} Harus di isi",
        ];
        $this->form_validation->set_rules('nama_surat', 'Nama Surat', 'trim|required', $notif);
        $this->form_validation->set_rules('format_nomor', 'Format Nomor Surat', 'trim|required', $notif);
        
        if ($this->form_validation->run() == FALSE){
            $data['judul'] = 'Tambah Surat';
            $data['kategori'] = $this->db->order_by('nama_kategori','ASC')->get('t_kategori_surat')->result();
            $data['view'] = 'sample_surat/i_sample_surat';
            $this->load->view('index',$data);
        }else{
            $this->insert();
        }
    }

    private function insert(){
        $kop_surat = null;
        $proses_upload1 = $this->global_model->upload_file('kop_surat','images/kop_surat'); 
        if($proses_upload1){
            $kop_surat = $proses_upload1;
        }else{
            notifikasi(false, $this->upload->display_errors());
            redirect(base_url('surat_masuk/create'));
        }
        
        $values = [
            'nama_surat' => $this->input->post('nama_surat',TRUE),
            'id_kategori' => $this->input->post('id_kategori',TRUE),
            'kode_fak' => $_SESSION['kode_fak'],
            'kop_surat' => $kop_surat,
            'template' => $this->input->post('template',TRUE),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_at' => $_SESSION['username'],
            'updated_at' => $_SESSION['username'],
        ];
        $this->global_model->insert_data($this->table, $values);
        notifikasi(true,'Sample Surat Keluar Berhasil di Buat !!!');
        redirect(base_url('sample_surat'));
    }

    public function edit($id_surat){
        $data['judul'] = 'Edit Surat';
        $data['kategori'] = $this->db->order_by('nama_kategori','ASC')->get('t_kategori_surat')->result();
        $data['view'] = 'sample_surat/e_surat';
        $this->load->view('index',$data);
    }

    public function update(){
        //
    }

    public function delete($id_surat){
        if($id_surat==null){
            notifikasi(true,'Gagal Menggapus sample surat !!!');
        }else{
            $where = ['id_sample_surat'=>$id_surat];
            $this->global_model->delete_data($this->table,$where);
            notifikasi(true,'Sample Surat Keluar Berhasil di Hapus !!!');
        }
        redirect(base_url('sample_surat'));
    }

}