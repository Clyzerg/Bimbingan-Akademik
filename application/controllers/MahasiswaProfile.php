<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MahasiswaProfile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MahasiswaProfile_model');
        $this->load->model('Angkatan_model'); // Load model angkatan
        $this->load->model('Semester_model');
        $this->load->model('DosenProfile_model');
        $this->load->model('Notification_model');
    }

    public function check() {
        $mahasiswa_id = $this->session->userdata('id');

    // Ambil notifikasi untuk mahasiswa
    $this->load->model('Notification_model');
    $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($mahasiswa_id);
    $data['unread_count'] = count($data['notifications']);
        $data['angkatan'] = $this->Angkatan_model->get_all_angkatan();
        $data['semester'] = $this->Semester_model->get_all_semesters();
        $data['dosen_list'] = $this->DosenProfile_model->get_all_dosen();
        $data['judul'] = 'Harap Lengkapi Profile !';
        $user_id = $this->session->userdata('id');
        $is_profile_complete = $this->session->userdata('is_profile_complete');

        if (!$user_id) {
            redirect('auth/login');
        }

        if ($is_profile_complete) {
            redirect('mahasiswa');
        } else {
            $data['profile'] = $this->MahasiswaProfile_model->get_profile($user_id);
            $data['angkatan'] = $this->Angkatan_model->get_all_angkatan();
            $data['semester'] = $this->Semester_model->get_all_semesters();
            $data['dosen_list'] = $this->DosenProfile_model->get_all_dosen();
            $this->load->view('template/sidebar', $data);
            $this->load->view('mahasiswa_profile/update', $data);
            $this->load->view('template/footer', $data);
        }
    }

    public function update() {
        $user_id = $this->session->userdata('id');
        $nim = $this->input->post('nim');
        $email = $this->input->post('email');
        $phone_number = $this->input->post('phone_number');
    
        // Cek apakah NIM, email, atau nomor HP sudah digunakan oleh mahasiswa lain
        $existing_profile = $this->MahasiswaProfile_model->check_unique_profile($user_id, $nim, $email, $phone_number);
    
        if ($existing_profile) {
            // Jika ditemukan NIM, email, atau nomor HP yang sama, simpan pesan error ke flashdata
            $this->session->set_flashdata('error_message', 'NPM, Email, atau Nomor Handphone sudah terdaftar, Harap pastikan masukkan NPM yang belum terdaftar !');
            redirect('mahasiswaprofile/check');
        } else {
            // Proses upload foto profil jika ada
            $foto_profil = null;
            if (!empty($_FILES['foto_profil']['name'])) {
                $config['upload_path'] = './uploads/foto_profil/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048; // Max size in KB
    
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('foto_profil')) {
                    $upload_data = $this->upload->data();
                    $foto_profil = $upload_data['file_name'];
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error_message', $error);
                    redirect('mahasiswaprofile/check');
                    return;
                }
            }
    
            // Data profil yang akan diupdate
            $profile_data = array(
                'user_id' => $user_id,
                'nim' => $nim,
                'full_name' => $this->input->post('full_name'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'agama' => $this->input->post('agama'),
                'jenkel' => $this->input->post('jenkel'),
                'email' => $email,
                'address' => $this->input->post('address'),
                'phone_number' => $phone_number,
                'angkatan_id' => $this->input->post('angkatan_id'),
                'dosen_id' => $this->input->post('dosen_id'),
                'foto_profil' => $foto_profil // Tambahkan foto profil
            );
    
            $this->MahasiswaProfile_model->update_profile($user_id, $profile_data);
            $this->MahasiswaProfile_model->mark_profile_complete($user_id);
            $this->session->set_userdata('is_profile_complete', 1);
    
            redirect('mahasiswa');
        }
    }
    
    
    public function edit() {
        $user_id = $this->session->userdata('id');

    // Ambil notifikasi untuk mahasiswa
    $this->load->model('Notification_model');
    $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($user_id);
    $data['unread_count'] = count($data['notifications']);
        $data['judul'] = 'Edit Profile Mahasiswa';
       
        $data['profile'] = $this->MahasiswaProfile_model->get_profile($user_id);
        $data['semester'] = $this->Semester_model->get_all_semesters();
        $data['angkatan'] = $this->Angkatan_model->get_all_angkatan();
        $data['dosen'] = $this->DosenProfile_model->get_all_dosen();
        $this->load->view('template/sidebar', $data);
        $this->load->view('mahasiswa_profile/edit', $data);
        $this->load->view('template/footer', $data);
    }
   
    public function edit_proccess() {
        $user_id = $this->session->userdata('id');
       
        // Konfigurasi upload foto profil
        $config['upload_path'] = './uploads/foto_profil/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = 2048; // Maksimal ukuran file dalam KB
    
        $this->load->library('upload', $config);
        
        // Cek apakah ada file foto profil yang diupload
        if ($this->upload->do_upload('foto_profil')) {
            $foto_profil_data = $this->upload->data();
            $foto_profil = $foto_profil_data['file_name'];
        } else {
            // Jika tidak ada file yang diupload, gunakan foto profil yang lama
            $foto_profil = $this->input->post('existing_foto_profil');
        }
        $profile_data = array(
            'user_id' => $this->input->post('id'),
            'nim' => $this->input->post('nim'),
            'full_name' => $this->input->post('full_name'),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'agama' => $this->input->post('agama'),
            'jenkel' => $this->input->post('jenkel'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'phone_number' => $this->input->post('phone_number'),
            'angkatan_id' => $this->input->post('angkatan_id'),
            'dosen_id' => $this->input->post('dosen_id'), // Tambahkan dosen_id
            'foto_profil' => $foto_profil // Tambahkan foto profil
        );

        $this->MahasiswaProfile_model->update_profile1($user_id, $profile_data);
        redirect('mahasiswa');
    }
    
    public function detail() {
        $user_id = $this->session->userdata('id');

    // Ambil notifikasi untuk mahasiswa
    $this->load->model('Notification_model');
    $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($user_id);
    $data['unread_count'] = count($data['notifications']);
    $data['judul'] = 'Detail Profile Mahasiswa';
       
        $data['semester'] = $this->Semester_model->get_all_semesters();
        $data['profile'] = $this->MahasiswaProfile_model->get_profile_with_angkatan($user_id);
        $data['angkatan'] = $this->Angkatan_model->get_all_angkatan();
        $this->load->view('template/sidebar', $data);
        $this->load->view('mahasiswa_profile/detail', $data);
        $this->load->view('template/footer', $data);
    }
    public function all_profiles() {
        $user_id = $this->session->userdata('id');
        $data['judul'] = 'Daftar Mahasiswa';
    $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($user_id);
    $data['unread_count'] = count($data['notifications']);
    $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);
    $data['dosen_list'] = $this->MahasiswaProfile_model->get_all_dosen_from_mahasiswa_profile();
        
        
        $dosen_id = $this->input->get('dosen_id');
        if ($dosen_id) { 
            $data['profile'] = $this->MahasiswaProfile_model->get_profiles_by_dosen($dosen_id);
        } else {
            $data['profile'] = $this->MahasiswaProfile_model->get_all_profiles_complete();
        }
        $this->load->view('template/sidebar', $data);
        $this->load->view('mahasiswa_profile/all_profiles', $data);
        $this->load->view('template/footer', $data);
    }
    public function index3(){
        $data['judul'] = 'Daftar Bimbingan';
    
        // Ambil data dosen untuk dropdown filter
        $data['dosen_list'] = $this->MahasiswaProfile_model->get_all_dosen_from_mahasiswa_profile();
    
        // Filter berdasarkan dosen
        $dosen_id = $this->input->get('dosen_id');
        if ($dosen_id) {
            $data['bimbingan'] = $this->Bimbingan_model->get_bimbingan_by_dosen($dosen_id);
        } else {
            $data['bimbingan'] = $this->Bimbingan_model->get_all_bimbingan();
        }
    
        $this->load->view('template/sidebar', $data);
        $this->load->view('bimbingan/index', $data);
        $this->load->view('template/footer', $data);
    }
    public function delete($user_id) {
        $this->load->model('MahasiswaProfile_model');
        $this->MahasiswaProfile_model->delete_profile($user_id);
        redirect('MahasiswaProfile/all_profiles');
    }
    public function all_profiles1() {
        $data['judul'] = 'Daftar Mahasiswa';
        $user_id = $this->session->userdata('id');
    
        // Ambil notifikasi untuk mahasiswa
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);
    
        // Tambahkan model MahasiswaProfile_model
        $this->load->model('MahasiswaProfile_model');
        
        // Panggil metode yang disesuaikan dengan ID dosen
        $data['profile'] = $this->MahasiswaProfile_model->get_profiles_by_dosen($user_id);
        
        // Model lainnya
        $this->load->model('Semester_model');
        $data['semester'] = $this->Semester_model->get_all_semesters();
        
        $this->load->model('Angkatan_model');
        $data['angkatan'] = $this->Angkatan_model->get_all_angkatan();
        
        $this->load->view('template/sidebar', $data);
        $this->load->view('mahasiswa_profile/all_profiles', $data);
        $this->load->view('template/footer', $data);
    }
    
    
    
}

