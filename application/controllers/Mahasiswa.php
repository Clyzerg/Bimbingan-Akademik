<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
	public function __construct()
    {
        parent::__construct();

        // Model
      
        $this->load->model('User_model');
        $this->load->model('Semester_model');
        $this->load->model('MahasiswaProfile_model');
        $this->load->model('Angkatan_model');
        $this->load->model('Notification_model');
     
        
   

        // Session
        $level = $this->session->userdata('level');

        // Akses Manajemen
        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            if($level === '1') 
            {
                redirect('admin');
    
            } else if($level === '2')
            {
                redirect('dosen');
                
            }

        }
    }

	public function index()
	{
		// Title
        $data['judul'] = 'Halaman Mahasiswa';
   
            
            $user_id = $this->session->userdata('id');
            $data['semester'] = $this->Semester_model->get_all_semesters();
            $data['profile'] = $this->MahasiswaProfile_model->get_profile_with_angkatan($user_id);
            $data['angkatan'] = $this->Angkatan_model->get_all_angkatan();
            

   
    $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($user_id);
    $data['unread_count'] = count($data['notifications']);
            $this->load->view('template/sidebar', $data);
            $this->load->view('mahasiswa_profile/detail', $data);
            $this->load->view('template/footer', $data);
        }
       
        
        
	}
    

