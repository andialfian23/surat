<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class permohonan extends CI_Controller{
    
    public function __construct(){
        parent::__construct();
        if(!isset($_SESSION['level'])){
            redirect(base_url('auth'));
        }
        $this->load->model('surat_permohonan_model','permohonan');
        $this->load->model('smpl_surat_model','smpl_surat');
    }

    public function index(){
        $data['judul'] = 'Daftar Surat Permohonan';
        $data['fak'] = $this->global_model->fakultas();
        $data['view'] = 'permohonan/index_sp';
        $this->load->view('index',$data);
    }

    public function show(){
        $xBegin = $this->input->post('xBegin',TRUE);
        $xEnd   = $this->input->post('xEnd',TRUE);
        $fak   = $this->input->post('fak',TRUE);
        $fak = ($fak == 'All') ? nuLL : $fak;
        
        $column_order = array('tgl_permohonan', 'no_sp', 'a.username', 'nama_surat');
                    
        $query = $this->permohonan->get_datatables($column_order, $xBegin, $xEnd, $fak);
        
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
            "recordsTotal"      => $this->permohonan->total_entri($xBegin, $xEnd),
            "data"              => $data,
        );

        echo json_encode($output);
    }

    public function create(){
        $kode_fak=(!empty($_SESSION['kode_fak']))? $_SESSION['kode_fak'] : 0;
        $data['judul'] = 'Buat Surat Permohonan';
        $data['fak'] = $this->global_model->fakultas();
        $data['sample'] = $this->smpl_surat->get_data(null,'permohonan',$kode_fak);
        $data['view'] = 'permohonan/tambah_sp';
        $this->load->view('index',$data);
    }

    public function insert(){
        $status = 0;
        $pesan = 'Gagal Menyimpan Surat Permohonan';

        $id_sample = $this->input->post('surat',TRUE);
        $tanggal = $this->input->post('tanggal',TRUE);
        $value_sp = $this->input->post('value_sp');
        $value_sp = str_replace('null','',$value_sp);
        
        $values = [
            'id_sample_surat' => $id_sample,
            'tgl_permohonan'  => $tanggal,
            'username' => $_SESSION['username'],
            'no_sp' => null,
            'value_sp' => $value_sp,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),   
        ];
        $insert = $this->global_model->insert_data('t_surat_permohonan',$values);

        if($insert){
            $status = 1;
            $pesan = 'Berhasil Menyimpan Surat Permohonan';
        }

        $output = [
            'status' => $status,
            'pesan' => $pesan,
        ];
        echo json_encode($output);
    }

    public function delete($id_sp){
        $where = ['id_sp'=>$id_sp];
        $delete = $this->global_model->delete_data('t_surat_permohonan',$where);
        notifikasi(true,'Berhasil Menghapus Surat Permohonan');
        redirect(base_url('permohonan'));
    }

    public function get_sample(){
        $id_sample = $this->input->post('id',TRUE);
        $kode_fak = (!empty($_SESSION['kode_fak']))? $_SESSION['kode_fak'] : 0;
        $sample = $this->smpl_surat->get_data($id_sample,null,$kode_fak)->row();

        $params =  explode('|',$sample->params);
        $form_input = null;
        $no =1;
        foreach($params as $p){
            if($p != '' && $no > 2){
                $exp_params = explode('#',$p);
                $params_no = str_replace('[','',str_replace(']','',$exp_params[0]));
                $label = $exp_params[1];
                $hidden = '';
                if($exp_params[2] == 'input_by_tu'){
                    $hidden = ($_SESSION['level']>2) ? 'd-none' : '';
                }else if($exp_params[2] == 'input_by_mhs'){
                    $hidden = ($_SESSION['level']>2) ? '' : 'd-none';
                }else{
                    $hidden = 'd-none';
                }
                $form_input .= '<div class="form-group '.$hidden.'">
                        <label for="inp_'.$no.'">'.$label.'</label>
                        <input type="text" class="form-control form-control-sm" data-no="'.$params_no.'" id="inp_'.$no.'" />
                    </div>'; 
            }
            $no++;
        }
        
        echo json_encode($form_input);
    }
    
    public function pdf($id_sp){
        $key = $this->permohonan->get_surat($id_sp)->row();
        $nomor    = $key->no_sp;
        $nama_surat = $key->nama_surat;
        $tanggal  = date('d M Y',strtotime($key->tgl_permohonan));
        $params   = $key->params;
        $value    = $key->value_sp;
        $template = $key->template;
        
        // MENGUBAH params no DENGAN VALUES OTOMATIS (selain input by tu & input by mhs)
        $no = 1;
        $params = explode('|',$params);
        foreach($params as $p){
            if($p != ''){
                $exp_params = explode('#',$p);
                // [0] = Param No [no]
                // [1] = Label
                // [2] = Value
                if(strpos($template,$exp_params[0]) !== false){
                    if($exp_params[2] != 'input_by_mhs' & $exp_params[2] != 'input_by_tu'){
                        if($exp_params[2] =='sesuai_format'){
                            $value_ubah = $nomor;  // merubah [no] sesuai format nomor
                        } else if($exp_params[2] =='nama_surat'){
                            $value_ubah = $nama_surat;  // merubah [no] sesuai nama surat
                        }else if($exp_params[2] =='tanggal_surat'){
                            $value_ubah = $tanggal;     // merubah [no] sesuai tanggal
                        }else {
                            $value_ubah = $exp_params[2];  // merubah params lainnya
                        }
                        $template = str_replace($exp_params[0], $value_ubah, $template);
                    }
                }
            }
            $no++;
        }

        // MENGUBAH [no] DENGAN VALUES YANG DI INPUTKAN USER
        $value = explode('|',$value);
        foreach($value as $v){
            if($v != ''){
                $exp_value = explode('#',$v);
                if(strpos($template,$exp_value[0]) !== false){
                    $template = str_replace($exp_value[0],$exp_value[1],$template);
                }
            }
        }

        $data['judul']      = $nama_surat;
        $data['kop_surat']  = $key->kop_surat;
        $data['isi_surat']  = $template;
        $this->load->view('permohonan/pdf', $data);
    }
}

?>