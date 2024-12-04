<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Level_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['judul'] = 'Tambah User';
        $data['level'] = $this->Level_model->get_all_levels();
        $this->load->view('template/sidebar', $data);
        $this->load->view('manage_user/add', $data);
        $this->load->view('template/footer',$data);
    }

    public function add() {
        // Ambil data dari form
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $level = $this->input->post('level');
        
        // Periksa jika username kosong
        if (empty($username)) {
            $this->session->set_flashdata('error', 'Username tidak boleh kosong.');
            redirect('user/index'); // Redirect ke halaman input
            return;
        }
        
        // Cek apakah username sudah ada di database
        $this->db->where('username', $username);
        $query = $this->db->get('user');
        
        if ($query->num_rows() > 0) {
            // Username sudah ada, tampilkan pesan kesalahan
            $this->session->set_flashdata('error', 'Username sudah ada, silakan gunakan username lain.');
            redirect('user/index'); // Redirect ke halaman input
            return;
        }
        
        // Hash password
        $hashed_password = md5($password);
        
        // Data array
        $data = array(
            'username' => $username,
            'password' => $hashed_password,
            'level' => $level,
            'is_profile_complete' => 0 // Default value
        );
        
        // Insert user data
        $this->User_model->insert_user($data);
        
        // Set flashdata untuk pesan sukses
        $this->session->set_flashdata('message', 'User berhasil ditambahkan.');
        
        // Redirect based on level
        if ($level == 2) {
            redirect('user/list');
        } else if ($level == 3) {
            redirect('user/list');
        } else {
            redirect('user/list');
        }
    }
    
    
    

    
    public function list() {
        $this->load->library('pagination');
    
        // Configurasi pagination
        $config['base_url'] = base_url('User/list');
        $config['total_rows'] = $this->User_model->get_user_count();
        $config['per_page'] = 10; // Jumlah data per halaman
        $config['uri_segment'] = 3; // Segment URI yang menentukan halaman saat ini
    
        // Styling pagination (gunakan CSS sesuai template Anda)
       
    
        $this->pagination->initialize($config);
    
        $page = $this->uri->segment(3);
        $data['user'] = $this->User_model->get_users($config['per_page'], $page);
        $data['level'] = $this->Level_model->get_all_levels();
        $data['pagination'] = $this->pagination->create_links(); // Dapatkan links pagination
    
        $data['judul'] = 'Daftar User';
        $this->load->view('template/sidebar', $data);
        $this->load->view('manage_user/list', $data);
        $this->load->view('template/footer', $data);
    }
    
    public function edit($id) {
        $data['judul'] = 'Edit User';
        $data['user'] = $this->User_model->get_user_by_id($id);
        $data['level'] = $this->Level_model->get_all_levels();
    
        if (empty($data['user'])) {
            show_404();
        }
    
        $this->load->view('template/sidebar', $data);
        $this->load->view('manage_user/edit', $data);
        $this->load->view('template/footer',$data);
    }
    public function update() {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
       
    
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'), PASSWORD_BCRYPT),
                'level' => $this->input->post('level')
               
            );
    
            $this->User_model->update_user($id, $data);
            $this->session->set_flashdata('message', 'User berhasil diupdate');
            redirect('user/list');
        }
}
}
?>
