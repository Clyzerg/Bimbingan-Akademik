<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model Dosen_model
        $this->load->model('Mahasiswa_model');
        $this->load->model('Notification_model');
        // Load library session
        $this->load->library('session');
        $this->load->library('form_validation');
    }
    public function index(){
        $data['judul'] = 'Daftar Data Mahasiswa';
        $data['mahasiswa'] = $this->Mahasiswa_model->data_mahasiswa()->result();
        $user_id = $this->session->userdata('id');
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);
        $data['profileKeisi'] = $this->db->get_where('profiles', ['id' => $user_id])->num_rows();
        $user_id = $this->session->userdata('id');
        $this->load->view('template/sidebar',$data);
        $this->load->view('mahasiswa/data_mahasiswa',$data);
        $this->load->view('template/footer',$data);
    }
    public function tambah_mahasiswa(){
        $data['judul'] = 'Tambah Data Mahasiswa';
        $user_id = $this->session->userdata('id');
        $data['profileKeisi'] = $this->db->get_where('profiles', ['id' => $user_id])->num_rows();
        $this->load->view('template/sidebar',$data);
        $this->load->view('mahasiswa/add_mahasiswa',$data);
        $this->load->view('template/footer',$data);
    }
    public function mahasiswa_action(){
         // Judul halaman
         $data['judul'] = 'Halaman Tambah Dosen';
         $user_id = $this->session->userdata('id');
         $data['profileKeisi'] = $this->db->get_where('profiles', ['id' => $user_id])->num_rows();
         // Validasi form submission
         $this->form_validation->set_rules('npm', 'NPM', 'required');
         $this->form_validation->set_rules('nama_mahasiswa', 'Nama Mahasiswa', 'required');
         $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
         $this->form_validation->set_rules('alamat', 'Alamat', 'required');
 
         if ($this->form_validation->run() == FALSE) {
             // Jika validasi form gagal
             $this->load->view('template/sidebar',$data);
             $this->load->view('mahasiswa/add_mahasiswa', $data);
             $this->load->view('template/footer',$data); // Ganti dengan view form tambah dosen
         } else {
             // Jika validasi form berhasil
             $npm = $this->input->post('npm');
             $nama_mahasiswa = $this->input->post('nama_mahasiswa');
             $email = $this->input->post('email');
             $alamat = $this->input->post('alamat');
    
 
             $data_mahasiswa = array(
                 'npm' => $npm,
                 'nama_mahasiswa' => $nama_mahasiswa,
                 'email' => $email,
                 'alamat' => $alamat,
           
             );
 
             // Panggil model untuk menyimpan data
             $result = $this->Mahasiswa_model->input_data($data_mahasiswa);
 
             if ($result) {
                 // Jika penyimpanan data berhasil
                 $this->session->set_flashdata('success', 'Data dosen berhasil ditambahkan.');
                 redirect('mahasiswa1/index'); // Ganti dengan halaman daftar dosen
             } else {
                 // Jika penyimpanan data gagal
                 $this->session->set_flashdata('error', 'Gagal menambahkan data dosen.');
                 redirect('mahasiswa1/index');
    }
         }
        }
        function hapus_mahasiswa($npm)
        {
            $where = array('npm' => $npm);
            $this->Mahasiswa_model->hapus_data($where, 'mahasiswa');
            redirect('Mahasiswa1/index');
        }
        function edit_mahasiswa($npm)
        {
            $data['judul'] = 'Halaman Edit Mahasiswa';
            $user_id = $this->session->userdata('id');
            $data['profileKeisi'] = $this->db->get_where('profiles', ['id' => $user_id])->num_rows();
            $where = array('npm' => $npm);
            $data['mahasiswa'] = $this->Mahasiswa_model->edit_data($where, 'mahasiswa')->result();
            $this->load->view('template/sidebar',$data);
            $this->load->view('mahasiswa/edit_mahasiswa', $data);
            $this->load->view('template/footer',$data);
        }
        function update_mahasiswa()
	{
        $user_id = $this->session->userdata('id');
        $data['profileKeisi'] = $this->db->get_where('profiles', ['id' => $user_id])->num_rows();
		$npm = $this->input->post('npm');
		$nama_mahasiswa = $this->input->post('nama_mahasiswa');
		$email = $this->input->post('email');
		$alamat = $this->input->post('alamat');
	

		$data = array(
			'nama_mahasiswa' => $nama_mahasiswa,
			'email' => $email,
			'alamat' => $alamat,
	
		);

		$where = array(
			'npm' => $npm
		);

		$this->Mahasiswa_model->update_data($where, $data, 'mahasiswa');
		redirect('mahasiswa1/index');
	}
    }