<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenProfile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('DosenProfile_model');
        $this->load->model('Notification_model');
    }

    public function check() {
        $data['judul'] = 'Lengkapi Profile !!';
        $user_id = $this->session->userdata('id');
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);
        $is_profile_complete = $this->session->userdata('is_profile_complete');

        if (!$user_id) {
            redirect('auth/login');
        }

        if ($is_profile_complete) {
            redirect('dosen');
        } else {
            $data['profile'] = $this->DosenProfile_model->get_profile($user_id);
            $this->load->view('template/sidebar', $data);
            $this->load->view('dosen_profile/update', $data);
            $this->load->view('template/footer', $data);
        }
    }

    public function update() {
        $user_id = $this->session->userdata('id');
        $nidn = $this->input->post('nidn');
        $nik = $this->input->post('nik');
        $full_name = $this->input->post('full_name');
        $email = $this->input->post('email');
        $phone_number = $this->input->post('phone_number');
        
        // Cek apakah NIDN, email, atau nomor HP sudah digunakan oleh dosen lain
        $existing_profile = $this->DosenProfile_model->check_unique_profile($user_id, $nidn, $email, $phone_number, $nik, $full_name);
        
        if ($existing_profile) {
            $this->session->set_flashdata('error_message', 'NIDN, email, atau nomor HP sudah terdaftar, Harap Gunakan NIDN , email atau Nomor Hp yang belum terdaftar !');
            redirect('dosenprofile/check');
        } else {
            // Proses upload foto
            $config['upload_path'] = './uploads/foto_profil';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048; // 2MB
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('foto_profil')) {
                $upload_data = $this->upload->data();
                $foto_profil = $upload_data['file_name'];
            } else {
                $foto_profil = null;
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error_message', $error);
                redirect('dosenprofile/check');
            }
    
            // Jika tidak ada duplikat, lanjutkan dengan update
            $profile_data = array(
                'user_id' => $this->input->post('id'),
                'nidn' => $nidn,
                'nik' => $nik,
                'full_name' => $full_name,
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'email' => $email,
                'address' => $this->input->post('address'),
                'phone_number' => $phone_number,
                'jabatan' => $this->input->post('jabatan'),
                'kepangkatan' => $this->input->post('kepangkatan'),
                'jenjang_pendidikan' => $this->input->post('jenjang_pendidikan'),
                'bidang_studi' => $this->input->post('bidang_studi'),
                'perguruan_tinggi' => $this->input->post('perguruan_tinggi'),
                'tahun_lulus' => $this->input->post('tahun_lulus'),
                'foto_profil' => $foto_profil
            );
    
            $this->DosenProfile_model->update_profile($user_id, $profile_data);
            $this->DosenProfile_model->mark_profile_complete($user_id);
            $this->session->set_userdata('is_profile_complete', 1);
    
            redirect('dosen');
        }
    }
    
    
    public function edit() {
        $data['judul'] = 'Edit Profile Dosen';
        $user_id = $this->session->userdata('id');
        $data['profile'] = $this->DosenProfile_model->get_profile($user_id);
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);

        $this->load->view('template/sidebar', $data);
        $this->load->view('dosen_profile/edit', $data);
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
            'nidn' => $this->input->post('nidn'),
            'full_name' => $this->input->post('full_name'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'phone_number' => $this->input->post('phone_number'),
            'jabatan' => $this->input->post('jabatan'),
            'kepangkatan' => $this->input->post('kepangkatan'),
            'jenjang_pendidikan' => $this->input->post('jenjang_pendidikan'),
            'bidang_studi' => $this->input->post('bidang_studi'),
            'perguruan_tinggi' => $this->input->post('perguruan_tinggi'),
            'tahun_lulus' => $this->input->post('tahun_lulus'),
            'foto_profil' => $foto_profil // Tambahkan foto profil
        );
    
        // Periksa kesamaan data
        $duplicate = $this->is_duplicate($profile_data);
    
        if ($duplicate) {
            $this->session->set_flashdata('error', $duplicate);
            redirect('dosenprofile/edit/' . $user_id); // Redirect ke halaman edit
            return;
        }
    
        // Update profile
        $this->DosenProfile_model->update_profile1($user_id, $profile_data);
    
        // Redirect setelah berhasil
        $this->session->set_flashdata('message', 'Profile berhasil diperbarui.');
        redirect('dosen');
    }
    
    private function is_duplicate($profile_data) {
        $this->db->where('email', $profile_data['email']);
        $this->db->where('user_id !=', $profile_data['user_id']); // Exclude current user
        $query = $this->db->get('dosen_profiles');
        if ($query->num_rows() > 0) {
            return 'Email sudah digunakan oleh pengguna lain.';
        }
    
        $this->db->where('full_name', $profile_data['full_name']);
        $this->db->where('user_id !=', $profile_data['user_id']); // Exclude current user
        $query = $this->db->get('dosen_profiles');
        if ($query->num_rows() > 0) {
            return 'Nama sudah digunakan oleh pengguna lain.';
        }
    
        $this->db->where('nidn', $profile_data['nidn']);
        $this->db->where('user_id !=', $profile_data['user_id']); // Exclude current user
        $query = $this->db->get('dosen_profiles');
        if ($query->num_rows() > 0) {
            return 'NIDN sudah digunakan oleh pengguna lain.';
        }
    
        return false;
    }
    
    
    
    
    public function detail() {
        $data['judul'] = 'Detail Profile Dosen';
        $user_id = $this->session->userdata('id');
        $data['profile'] = $this->DosenProfile_model->get_profile($user_id);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dosen_profile/detail', $data);
        $this->load->view('template/footer', $data);
    }
}
