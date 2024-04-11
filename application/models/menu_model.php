<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class menu_model extends CI_Model {
    
    public function menu_admin(){
        return [
            [
				'has-sub' => FALSE,
				'menu_link' => 'dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'fas fa-home'
			],[
				'has-sub' => TRUE,
				'menu_text' => 'Surat',
				'menu_icon' => 'fas fa-mail-bulk',
				'menu_child' =>	[
					[
						'menu_link' => 'sample_surat',
						'menu_text' => 'Sample Surat',
					],[
						'menu_link' => 'surat_keluar',
						'menu_text' => 'Surat Keluar',
					],[
						'menu_link' => 'surat_masuk',
						'menu_text' => 'Surat Masuk',
					],[
						'menu_link' => 'surat_permohonan',
						'menu_text' => 'Surat Permohonan',
					],[
						'menu_link' => 'surat_acc',
						'menu_text' => 'Surat Acc',
					],
				],
			],[
				'has-sub' => FALSE,
				'menu_link' => 'kategori',
				'menu_text' => 'Kategori',
				'menu_color' => '',
				'menu_icon' => 'fas fa-certificate'
			],
        ];
    }

    public function menu_tu(){
        return [
            [
				'has-sub' => FALSE,
				'menu_link' => 'dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'fas fa-home'
			],[
				'has-sub' => TRUE,
				'menu_text' => 'Surat',
				'menu_icon' => 'fas fa-mail-bulk',
				'menu_child' =>	[
					[
						'menu_link' => 'sample_surat',
						'menu_text' => 'Sample Surat',
					], [
						'menu_link' => 'surat_keluar',
						'menu_text' => 'Surat Keluar',
					], [
						'menu_link' => 'surat_masuk',
						'menu_text' => 'Surat Masuk',
					],[
						'menu_link' => 'surat_permohonan',
						'menu_text' => 'Surat Permohonan',
					],[
						'menu_link' => 'surat_masuk',
						'menu_text' => 'Surat Acc',
					],
				],
			],
        ];
    }

    public function menu_mhs(){
		return [
            [
				'has-sub' => FALSE,
				'menu_link' => 'dashboard',
				'menu_text' => 'Dashboard',
				'menu_color' => '',
				'menu_icon' => 'fas fa-home'
			],[
				'has-sub' => FALSE,
				'menu_link' => 'surat_permohonan',
				'menu_text' => 'Pengajuan Surat',
				'menu_color' => '',
				'menu_icon' => 'fas fa-mail-bulk'
			],
        ];
    }
    
}

?>