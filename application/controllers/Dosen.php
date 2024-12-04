<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        // Model		
       
        $this->load->model('User_model');
        $this->load->model('Dosen_model');
        $this->load->model('DosenProfile_model');
        $this->load->model('Notification_model');

        
        // Library
		$this->load->library('form_validation'); 

        // Session
        $level = $this->session->userdata('level');

        if(!$this->session->userdata('logged_in')) {
            redirect('auth');
        } else {
            if($level === '1') 
            {
                redirect('admin');
    
            } else if($level === '3')
            {
                redirect('mahasiswa');
                
            }

        }
    }

	public function index()
	{
        $data['judul'] = 'Halaman Dosen';
        $user_id = $this->session->userdata('id');
        $data['profile'] = $this->DosenProfile_model->get_profile($user_id);
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);
            $this->load->view('template/sidebar',$data);
            $this->load->view('dosen_profile/detail',$data);
            $this->load->view('template/footer',$data);
    }

   
   
}
