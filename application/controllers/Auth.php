<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
        public function __construct() {
            parent::__construct();
            $this->load->model('Auth_model');
            $this->load->model('User_model');
            $this->load->model('DosenProfile_model');
            $this->load->model('MahasiswaProfile_model');
        }
    
        // Halaman login untuk Admin
        public function admin_login() {
            $data['judul'] = 'Halaman Login Admin';
    
            if ($this->session->userdata('logged_in')) {
                if ($this->session->userdata('level') === '1') {
                    redirect('admin');
                } else {
                    $this->session->set_flashdata('login_error', '<div class="alert alert-danger" role="alert">Anda tidak memiliki akses ke halaman ini.</div>');
                    redirect('auth/login');
                }
            } else {
                $this->load->view('auth/admin', $data); // view folder auth file admin_login.php
            }
        }
    
        // Halaman login untuk Dosen dan Mahasiswa
public function login() {
            $data['judul'] = 'Halaman Login';
    
            if ($this->session->userdata('logged_in')) {
                if ($this->session->userdata('level') === '1') {
                    redirect('admin');
                } else if ($this->session->userdata('level') === '2') {
                    redirect('dosen');
                } else if ($this->session->userdata('level') === '3') {
                    redirect('mahasiswa');
                }
            } else {
                $this->load->view('auth/login', $data); // view folder auth file login.php
            }
        }
    
        // Proses login untuk Admin
        public function admin_auth_process() {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
        
            $user = $this->Auth_model->user_validation($username, $password);
        
            if ($user && $user->level === '1') { // Jika admin
                $sesi = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'level' => $user->level,
                    'is_profile_complete' => $user->is_profile_complete,
                    'logged_in' => TRUE,
                ];
        
                $this->session->set_userdata($sesi);
                redirect('admin');
            } else {
                $this->session->set_flashdata('login_error', '<div class="alert alert-danger" role="alert">Anda tidak memiliki akses kehalaman ini !</div>');
                redirect('auth/admin_login');
            }
        }
    
        // Proses login untuk Dosen dan Mahasiswa
        public function auth_process() {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            

            
            $user = $this->Auth_model->user_validation($username, $password);
        
            if ($user && $user->level !== '1') { // Jika bukan admin
                $sesi = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'level' => $user->level,
                    'is_profile_complete' => $user->is_profile_complete,
                    'logged_in' => TRUE,
                ];
        
                $this->session->set_userdata($sesi);
                $this->redirect_user();
            } else {
                $this->session->set_flashdata('login_error', '<div class="alert alert-danger" role="alert">Username atau Password yang anda masukkan tidak terdaftar.</div>');
                redirect('auth/login');
            }
        }
    
        private function redirect_user() {
            if ($this->session->userdata('level') === '2') { // Dosen
                if ($this->session->userdata('is_profile_complete')) {
                    redirect('dosen');
                } else {
                    redirect('DosenProfile/check');
                }
            } else if ($this->session->userdata('level') === '3') { // Mahasiswa
                if ($this->session->userdata('is_profile_complete')) {
                    redirect('mahasiswa');
                } else {
                    redirect('MahasiswaProfile/check');
                }
            } else { // Jika admin mencoba mengakses halaman dosen atau mahasiswa
                $this->session->set_flashdata('login_error', '<div class="alert alert-danger" role="alert">Anda tidak memiliki akses ke halaman ini.</div>');
                redirect('auth/admin_login');
            }
        }
    
        public function logout() {
            $this->session->sess_destroy();
            redirect('auth/login');
        }
        
        public function logoutall() {
            $this->session->sess_destroy();
            redirect('auth/login');
        }
    }
    
