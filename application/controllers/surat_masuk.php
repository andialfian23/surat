<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_masuk extends CI_Controller {

    var $table = 't_surat_masuk';
    
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] > 2){
            redirect(base_url('dashboard'));
        }
        $this->load->model('surat_masuk_model','surat_masuk');
    }

    public function index(){
        $data['judul'] = 'Data Surat Masuk';
        $data['view'] = 'surat_masuk/index_surat_masuk';
        $data['fak'] = $this->global_model->fakultas();
        $this->load->view('index',$data);
    }

    public function create(){
        $notif = [
            'required'=> "{field} Harus di isi",
        ];
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'trim|required', $notif);
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|required', $notif);
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'trim|required', $notif);
        $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required', $notif);
        
        if ($this->form_validation->run() == FALSE){
            $data['judul'] = 'Tambah Surat Masuk';
            $data['kategori'] = $this->db->order_by('nama_kategori','ASC')->get('t_kategori_surat')->result();
            $data['view'] = 'surat_masuk/i_surat_masuk';
            $this->load->view('index',$data);
        }else{
            $this->insert();
        }
    }

    private function insert(){
        $file_surat=null;
        $lampiran=null;
        $berkas=null;
        
        $proses_upload1 = $this->global_model->upload_file('file_surat','dokumen/surat_masuk'); 
        if($proses_upload1){
            $file_surat = $proses_upload1;
        }else{
            notifikasi(false, $this->upload->display_errors());
            redirect(base_url('surat_masuk/create'));
        }

        $proses_upload2 = $this->global_model->upload_file('lampiran','dokumen/lampiran_surat_masuk'); 
        if($proses_upload2){
            $lampiran = $proses_upload2;
        }else{
            notifikasi(false, $this->upload->display_errors());
            redirect(base_url('surat_masuk/create'));
        }
        
        $proses_upload3 = $this->global_model->upload_file('berkas','dokumen/berkas_surat_masuk'); 
        if($proses_upload3){
            $berkas = $proses_upload3;
        }else{
            notifikasi(false, $this->upload->display_errors());
            redirect(base_url('surat_masuk/create'));
        }


        $values = [
            'id_kategori' => $this->input->post('id_kategori',TRUE),
            'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
            'pengirim' => $this->input->post('pengirim',TRUE),
            'nomor' => $this->input->post('nomor',TRUE),
            'perihal' => $this->input->post('perihal',TRUE),
            'file_surat' => $file_surat,
            'lampiran' => $lampiran,
            'berkas' => $berkas,
            'tindakan' => $this->input->post('tindakan',TRUE),
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $_SESSION['username'],
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $_SESSION['username'],
        ];
        $this->global_model->insert_data($this->table,$values);
        notifikasi(true,'Surat Masuk Berhasil di Ubah !!!');
        redirect(base_url('surat_masuk'));
    }

    public function edit($id_surat=null){
        if($id_surat==null){
            notifikasi(true,'Gagal Menggapus surat masuk !!!');
            redirect(base_url('surat_masuk'));
        }
        $notif = [
            'required'=> "{field} Harus di isi",
        ];
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'trim|required', $notif);
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'trim|required', $notif);
        $this->form_validation->set_rules('nomor', 'Nomor Surat', 'trim|required', $notif);
        $this->form_validation->set_rules('perihal', 'Perihal', 'trim|required', $notif);
        
        if ($this->form_validation->run() == FALSE){
            $data['judul'] = 'Edit Surat Masuk';
            $data['view'] = 'surat_masuk/e_surat_masuk';
            $data['kategori'] = $this->db->order_by('nama_kategori','ASC')->get('t_kategori_surat')->result();
            $data['surat'] = $this->surat_masuk->get_surat_masuk(['id_surat_masuk'=>$id_surat])->row();
            $this->load->view('index',$data);
        }else{
            $this->update($id_surat);
        }
    }

    private function update($id_surat=null){
        if($id_surat==null){
            notifikasi(true,'Gagal Mengubah surat masuk !!!');
        }else{
            $file_surat=null;
            $lampiran=null;
            $berkas=null;
            
            $proses_upload1 = $this->global_model->upload_file('file_surat','dokumen/surat_masuk'); 
            if($proses_upload1){
                $file_surat = $proses_upload1;
            }else{
                notifikasi(false, $this->upload->display_errors());
                redirect(base_url('surat_masuk/edit/'.$id_surat));
            }

            $proses_upload2 = $this->global_model->upload_file('lampiran','dokumen/lampiran_surat_masuk'); 
            if($proses_upload2){
                $lampiran = $proses_upload2;
            }else{
                notifikasi(false, $this->upload->display_errors());
                redirect(base_url('surat_masuk/edit/'.$id_surat));
            }
            
            $proses_upload3 = $this->global_model->upload_file('berkas','dokumen/berkas_surat_masuk'); 
            if($proses_upload3){
                $berkas = $proses_upload3;
            }else{
                notifikasi(false, $this->upload->display_errors());
                redirect(base_url('surat_masuk/edit/'.$id_surat));
            }
            
            $where = ['id_surat_masuk'=>$id_surat];
            $set = [
                'id_kategori' => $this->input->post('id_kategori',TRUE),
                'tgl_masuk' => $this->input->post('tgl_masuk',TRUE),
                'pengirim' => $this->input->post('pengirim',TRUE),
                'nomor' => $this->input->post('nomor',TRUE),
                'perihal' => $this->input->post('perihal',TRUE),
                'file_surat' => $file_surat,
                'lampiran' => $lampiran,
                'berkas' => $berkas,
                'tindakan' => $this->input->post('tindakan',TRUE),
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $_SESSION['username'],
            ];
            $this->global_model->update_data($this->table,$set,$where);
            notifikasi(true,'Surat Masuk Berhasil di Ubah !!!');
        }
        redirect(base_url('surat_masuk'));
    }

    public function delete($id_surat=null){
        if($id_surat==null){
            notifikasi(true,'Gagal Menggapus surat masuk !!!');
        }else{
            $where = ['id_surat_masuk'=>$id_surat];
            $this->global_model->delete_data($this->table,$where);
            notifikasi(true,'Surat Masuk Berhasil di Hapus !!!');
        }
        redirect(base_url('surat_masuk'));
    }

    public function show(){
        $xBegin = $this->input->post('xBegin',TRUE);
        $xEnd   = $this->input->post('xEnd',TRUE);
        $fak   = $this->input->post('fak',TRUE);
        $fak = ($fak == 'All') ? nuLL : $fak;
        
        $column_order = array('tgl_masuk', 'pengirim', 'nomor', 'perihal', 'tindakan');
                    
        $list = $this->surat_masuk->get_datatables($column_order, $xBegin, $xEnd, $fak);
        
        $data   = array();
        foreach ($list->result() as $key) {
            $row      = array();

            $row['id_surat_masuk']  = $key->id_surat_masuk;
            $row['id_kategori']     = $key->id_kategori;
            $row['tgl_masuk']       = $key->tgl_masuk;
            $row['pengirim']   	 	= $key->pengirim;
            $row['nomor']           = $key->nomor;
            $row['perihal']   	 	    = $key->perihal;
            $row['lampiran']       = $key->lampiran;
            $row['berkas']       = $key->berkas;
            $row['tindakan']       = $key->tindakan;
            $row['file_surat']  = $key->file_surat;
            
            $data[]   = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsFiltered"   => $list->num_rows(),
            "recordsTotal"      => $this->surat_masuk->total_entri($xBegin, $xEnd, $fak),
            "data"              => $data,
        );

        echo json_encode($output);
    }
}