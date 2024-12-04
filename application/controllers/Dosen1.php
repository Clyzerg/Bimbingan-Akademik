<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model Dosen_model
        $this->load->model('Dosen_model');
        $this->load->model('DosenProfile_model');
        $this->load->model('Comment_model');
        $this->load->model('User_model');
        $this->load->model('Notification_model');
        // Load library session
        $this->load->library('session');
        $this->load->library('form_validation');
    }
    public function index() {
        $data['judul'] = 'Daftar Data Dosen';
        $user_id = $this->session->userdata('id');
        
        // Pagination Configuration
        $this->load->library('pagination');
        
        $config['base_url'] = base_url('dosen1/index');
        $config['total_rows'] = $this->Dosen_model->get_total_profiles_count();
        $config['per_page'] = 6; // Jumlah item per halaman
        $config['uri_segment'] = 3; // Segmen URL untuk nomor halaman
    
        // Initialize pagination
        $this->pagination->initialize($config);
    
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    
        // Get data
        $data['dosen'] = $this->Dosen_model->get_profiles_with_pagination($config['per_page'], $page);
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);
        $data['pagination'] = $this->pagination->create_links(); // Pagination links
    
        $this->load->view('template/sidebar', $data);
        $this->load->view('dosen/daftar_dosen', $data);
        $this->load->view('template/footer', $data);
    }
    
   
    public function edit($id = null) {
        // Pastikan hanya admin yang dapat mengakses
        if ($this->session->userdata('level') != 1) {
            redirect('dosen1');
        }
    
        if ($id === null) {
           show_404();
        }
    
        $data['dosen'] = $this->Dosen_model->get_dosen_by_id($id);
    
        if ($this->input->post('submit')) {
            $update_data = array(
                'nidn' => $this->input->post('nidn'),
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone_number' => $this->input->post('phone_number')
            );
            $this->Dosen_model->update_dosen($id, $update_data);
            redirect('dosen1/index');
        }
        $this->load->view('template/sidebar',$data);
        $this->load->view('dosen/edit', $data);
        $this->load->view('template/footer',$data);
    }

    public function delete($id) {
        // Pastikan hanya admin yang dapat mengakses
        if ($this->session->userdata('level') != 1) {
            redirect('dosen1');
        }

        // Hapus komentar terkait terlebih dahulu
        $this->Comment_model->delete_comments_by_dosen_id($id);

        // Hapus data dosen
        $this->Dosen_model->delete_dosen($id);

        // Ubah is_profile_complete di tabel user menjadi 0
        $this->User_model->update_profile_status($id, 0);

        $this->session->set_flashdata('success_message', 'Data dosen berhasil dihapus.');

        redirect('dosen1/index');
    }
}
