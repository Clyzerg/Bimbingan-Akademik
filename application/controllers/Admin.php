<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));

        // Model
	
        $this->load->model('User_model');
        $this->load->model('Dosen_model');
        $this->load->model('MahasiswaProfile_model');
        $this->load->model('DosenProfile_model');
        $this->load->model('Bimbingan_model');
        
        // Library
		$this->load->library('form_validation'); 

        // Session
        $level = $this->session->userdata('level');

        // Akses Manajemen
        if(!$this->session->userdata('logged_in')) : 
            redirect('auth');
        else :
            if($level === '2') :
                redirect('dosen');
            elseif($level === '3') : 
                redirect('mahasiswa');
            endif;
        endif;

    }
	public function index()
	{
        
       $data['judul'] = 'Halaman Admin';

            $data['total_users'] = $this->User_model->get_total_users();
            $data['total_mahasiswa'] = $this->MahasiswaProfile_model->get_total_mahasiswa();
            $data['total_dosen'] = $this->DosenProfile_model->get_total_dosen();
            $data['total_bimbingan'] = $this->Bimbingan_model->get_total_bimbingan();
            $this->load->view('template/sidebar',$data);
            $this->load->view('admin/index',$data);
            $this->load->view('template/footer',$data);
          
        } 
           public function dosen_list(){

            $data['judul'] = 'Daftar Data Dosen';
            $data['dosen'] = $this->Dosen_model->data_dosen()->result();

            $this->load->view('template/sidebar',$data);
            $this->load->view('dosen/daftar_dosen',$data);
            $this->load->view('template/footer',$data);
        }
     

        }
    
	
