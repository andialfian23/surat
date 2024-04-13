<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class keluar extends CI_Controller {

    var $table = 't_surat_keluar';
    
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] < 3){
            redirect(base_url('dashboard'));
        }
        $this->load->model('surat_keluar_model','surat_keluar');
    }

    public function index(){
        $data['judul'] = 'Data Surat';
        $data['view'] = 'keluar/index_sk';
        $this->load->view('index',$data);
    }

    public function create(){
        $data['judul'] = 'Buat Surat Keluar';
        $data['view'] = 'keluar/tambah_sk';
        $this->load->view('index',$data);
    }

    public function insert(){
        //
    }

    public function edit($id_surat){
        $data['judul'] = 'Edit Surat Keluar';
        $data['view'] = 'keluar/edit_sk';
        $this->load->view('index',$data);
    }

    public function update(){
        //
    }

    public function delete($id_surat){
        //
    }
}