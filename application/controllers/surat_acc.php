<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_acc extends CI_Controller {

    var $table = 't_surat_keluar';
    
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] > 2){
            redirect(base_url('dashboard'));
        }
        $this->load->model('surat_keluar_model','surat_keluar');
    }

    public function index(){
        $data['judul'] = 'Approve Surat Keluar';
        $data['view'] = 'surat_acc/index_acc_surat';
        $this->load->view('index',$data);
    }

    public function update(){
        //
    }
}