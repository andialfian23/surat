<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class surat_permohonan extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        
        if($_SESSION['level'] > 2){
            redirect(base_url('dashboard'));
        }
        $this->load->model('surat_permohonan_model','s_permohonan');
    }

    public function index(){
        $data['judul'] = 'Data Surat Permohonan';
        $data['fak'] = $this->global_model->fakultas();
        $data['view'] = 'surat_permohonan/index_surat_permohonan';
        $this->load->view('index',$data);
    }

    public function show(){
        $xBegin = $this->input->post('xBegin',TRUE);
        $xEnd   = $this->input->post('xEnd',TRUE);
        $fak   = $this->input->post('fak',TRUE);
        $fak = ($fak == 'All') ? nuLL : $fak;
        
        $column_order = array('tgl_permohonan', 'no_sp', 'a.username', 'nama_surat');
                    
        $query = $this->s_permohonan->get_datatables($column_order, $xBegin, $xEnd, $fak);
        
        $data   = array();
        foreach ($query->result() as $key) {
            $row      = array();

            $row['id_sp']  = $key->id_sp;
            $row['nama_surat']     = $key->nama_surat;
            $row['tgl_permohonan']       = $key->tgl_permohonan;
            $row['pemohon']   	 	= $key->pemohon;
            $row['no_sp']           = $key->no_sp;
            
            $data[]   = $row;
        }

        $output = array(
            "draw"              => $_POST['draw'],
            "recordsFiltered"   => $query->num_rows(),
            "recordsTotal"      => $this->s_permohonan->total_entri($xBegin, $xEnd),
            "data"              => $data,
        );

        echo json_encode($output);
    }

    public function pdf($id_sp){
        $key = $this->s_permohonan->get_surat($id_sp)->row();
        // echo json_encode($key);
        // die;
        
        $params = $key->params;
        $value = $key->value_sp;
        $template = $key->template;

        // MERUBAH {$1},{$2} Nomor Surat dan Hal
        $template = str_replace('{$1}',$key->no_sp,$template);
        $template = str_replace('{$2}',$key->nama_surat,$template);

        // MENGUBAH PARAMS {$} DENGAN VALUES OTOMATIS
        $params = explode(',',$params);
        // [0] = No $
        // [1] = Label
        // [2] = Value
        $no = 1;
        foreach($params as $p){
            if($p != '' && $no > 2){
                $exp_params = explode('#',$p);
                if(strpos($template,$exp_params[0]) !== false){
                    if($exp_params[2] != 'input_by_mhs' & $exp_params[2] != 'input_by_tu'){
                        $template = str_replace($exp_params[0],$exp_params[2],$template);
                    }
                }
            }
            $no++;
        }

        // MENGUBAH {$} DENGAN VALUES YANG DI INPUTKAN USER
        $value = explode(',',$value);
        foreach($value as $v){
            if($v != ''){
                $exp_value = explode('#',$v);
                if(strpos($template,$exp_value[0]) !== false){
                    $template = str_replace($exp_value[0],$exp_value[1],$template);
                }
            }
        }

        // echo json_encode($template);
        // die;
        $data['kop_surat'] = $key->kop_surat;
        $data['isi_surat'] = $template;
        $this->load->view('surat/pdf', $data);
    }
}

?>