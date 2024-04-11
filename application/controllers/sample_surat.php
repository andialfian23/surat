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
        $data['judul'] = 'Tambah Sample Surat';
        $data['kategori'] = $this->db->order_by('nama_kategori','ASC')->get('t_kategori_surat')->result();
        $data['view'] = 'sample_surat/i_sample_surat';
        $this->load->view('index',$data);
    }

    public function insert(){
        $status= 0;
        $pesan = 'Gagal Menyimpan Sample Surat';
        $kop_surat = null;
        
        $proses_upload1 = $this->global_model->upload_file('kop_surat','images/kop_surat'); 
        if($proses_upload1){
            $kop_surat = $proses_upload1;
        }

        $params = str_replace('null','',$this->input->post('params',TRUE));
        
        $values = [
            'nama_surat' => $this->input->post('nama_surat',TRUE),
            'id_kategori' => $this->input->post('id_kategori',TRUE),
            // 'kode_fak' => $_SESSION['kode_fak'],
            'kode_fak' => 6,
            'kop_surat' => $kop_surat,
            'format_nomor' => $this->input->post('format_nomor',TRUE),
            'params' => $params,
            'template' => $this->input->post('template',TRUE),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'created_by' => $_SESSION['username'],
            'updated_by' => $_SESSION['username'],
        ];
        $insert = $this->global_model->insert_data($this->table, $values);

        if($insert){
            $status= 1;
            $pesan = 'Berhasil Menyimpan Sample Surat';
        }
        
        $output = [
            'status' => $status,
            'pesan' => $pesan,
            'insert' => $insert,
        ];
        
        echo json_encode($output);
    }

    public function edit($id_sample){
        $data['judul'] = 'Edit Surat';
        $data['sample'] = $this->smpl_surat->get_data($id_sample)->row();
        $data['kategori'] = $this->db->order_by('nama_kategori','ASC')->get('t_kategori_surat')->result();
        $data['view'] = 'sample_surat/e_sample_surat';
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
            $sample = $this->smpl_surat->get_data($id_sample)->row();
            unlink(FCPATH . 'images/kop_surat/' . $sample->kop_surat);
            $this->global_model->delete_data($this->table,$where);
            notifikasi(true,'Sample Surat Keluar Berhasil di Hapus !!!');
        }
        redirect(base_url('sample_surat'));
    }

    public function detail($id_sample){
        $data['judul'] = 'Detail Sample Surat';
        $data['sample'] = $this->smpl_surat->get_data($id_sample)->row();
        $data['view'] = 'sample_surat/detail_sample';
        $this->load->view('index',$data);
    }

    public function kategori(){
        $jenis = $this->input->post('jenis',TRUE);
        $output = [
            'status' => 1,
            'data' => $this->global_model->kategori($jenis)->result()
        ];
        echo json_encode($output);
    }
}