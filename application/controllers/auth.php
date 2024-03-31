<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller {
    
	public function index()
	{
        $this->load->view('auth/login');
	}

    public function login(){
        $output = [];

        $status = 0;

        $this->form_validation->set_rules('username', 'Username', 'trim|required', ['required'=> "{field} Harus di isi"]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required'=> "{field} Harus di isi"]);

        if ($this->form_validation->run() == FALSE){
            $output = [
                'status' => $status,
                'pesan' => 'Login Gagal',
                'form_error' => [
                    'username' => form_error('username'),
                    'password' => form_error('password'),
                ],
            ];
        }else{
            $username = $this->input->post('username',TRUE);
            $password = $this->input->post('password',TRUE);
    
            $cek_login = $this->global_model->auth($username,$password);
            if($cek_login->num_rows() > 0){
                $user = $cek_login->row();
                $url = 'dashboard';
                $_SESSION['username'] = $username;
                $_SESSION['level'] = $user->level;
               
                $output = [
                    'status' => 1,
                    'pesan' => 'Login Berhasil',
                    'base_url' => $url, 
                ];
            }else{
                $output = [
                    'status' => 0,
                    'pesan' => 'Username atau Password Salah',
                    'form_error' => [
                        'username' => '',
                        'password' => '',
                    ],
                ];
            }
        }

        echo json_encode($output);
    }

    public function logout(){
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level');
        
        notifikasi(true,'Berhasil Logout !!!');
        redirect(base_url('auth'));
    }
}