<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class surat extends CI_Controller {

    var $table = 't_surat';
    
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] < 3){
            redirect(base_url('dashboard'));
        }
        $this->load->model('surat_model','surat');
    }

    public function index(){
        $data['judul'] = 'Data Surat';
        $data['view'] = 'surat/index_surat';
        $this->load->view('index',$data);
    }

    public function create(){
        $data['judul'] = 'Tambah Surat';
        $data['view'] = 'surat/i_surat';
        $this->load->view('index',$data);
    }

    public function insert(){
        //
    }

    public function edit($id_surat){
        $data['judul'] = 'Edit Surat';
        $data['view'] = 'surat/e_surat';
        $this->load->view('index',$data);
    }

    public function update(){
        //
    }

    public function delete($id_surat){
        //
    }
}