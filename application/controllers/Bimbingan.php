<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bimbingan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Bimbingan_model');
        $this->load->model('MahasiswaProfile_model');
        $this->load->model('Comment_model');
        $this->load->model('BimbinganSession_model');
        $this->load->model('Semester_model');
        $this->load->model('Notification_model');
    }
    public function pilih_semester() {
        // Mengambil data sesi bimbingan yang terbuka
        $mahasiswa_id = $this->session->userdata('id');
    
        // Ambil notifikasi untuk mahasiswa
        $this->load->model('Notification_model');
        $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($mahasiswa_id);
        $data['unread_count'] = count($data['notifications']);
        
        // Judul halaman
        $data['judul'] = 'Halaman Mahasiswa';
        
        // Mengambil data semua semester
        $data['semester'] = $this->Semester_model->get_all_semesters();
        
        // Mengambil semester yang sudah diambil oleh mahasiswa
        $data['taken_semesters'] = $this->BimbinganSession_model->get_taken_semesters($mahasiswa_id);
        
        // Mengirim data ke view
        $this->load->view('template/sidebar', $data);
        $this->load->view('mahasiswa/pilih_semester', $data);
        $this->load->view('template/footer', $data);
    }
    
    
    public function create() {
        // Ambil mahasiswa_id dari session
        $mahasiswa_id = $this->session->userdata('id');
    
        // Ambil notifikasi untuk mahasiswa
        $this->load->model('Notification_model');
        $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($mahasiswa_id);
        $data['unread_count'] = count($data['notifications']);
    
        // Ambil semester_id dari POST data
        $semester_id = $this->input->post('semester_id');
    
        // Ambil sesi bimbingan terbuka
        $open_sessions = $this->BimbinganSession_model->get_open_sessions();
    
        // Ambil semester berdasarkan sesi bimbingan terbuka
        $open_semesters = array();
        foreach ($open_sessions as $session) {
            $open_semesters[] = $session['semester_id'];
        }
    
        // Ambil semester yang sudah diambil oleh mahasiswa
        $taken_semesters = $this->BimbinganSession_model->get_taken_semesters($mahasiswa_id);
        $taken_semester_ids = array_column($taken_semesters, 'semester_id');
    
        // Ambil semester yang terbuka
        $data['semesters'] = $this->Semester_model->get_all_semesters();
    
        // Ambil semester yang terbuka dan sudah diambil
        $data['open_semesters'] = array_filter($data['semesters'], function($semester) use ($open_semesters) {
            return in_array($semester['id'], $open_semesters);
        });
    
        // Jika semester_id tidak ada atau bukan sesi yang terbuka, redirect kembali
        if (!$semester_id || !in_array($semester_id, $open_semesters)) {
            $this->session->set_flashdata('message', 'Sesi bimbingan untuk semester ini belum dibuka atau tidak valid. Hubungi Prodi untuk membuka bimbingan!');
            redirect('bimbingan/pilih_semester');
        }
    
        // Lanjutkan proses jika semester_id valid dan sesi bimbingan terbuka
        $data['judul'] = 'Bimbingan';
        $data['taken_semester_ids'] = $taken_semester_ids; // Kirim semester yang sudah diambil ke view
        $this->load->view('template/sidebar', $data);
        $this->load->view('bimbingan/add', ['semester_id' => $semester_id, 'semesters' => $data['open_semesters'], 'taken_semester_ids' => $taken_semester_ids]);
        $this->load->view('template/footer', $data);
    }
    
    
    
    
    
    

    public function add() {
        $data['judul'] = 'Tambah Bimbingan';
        $data['profile'] = $this->MahasiswaProfile_model->get_profile($this->session->userdata('id'));
        $data['semesters'] = $this->Semester_model->get_all_semesters();
      
        $this->load->view('template/sidebar',$data);
        $this->load->view('bimbingan/add', $data);
        $this->load->view('template/footer',$data);
    }

    public function insert() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $this->load->library('upload', $config);
    
        // Upload KRS
        if (!$this->upload->do_upload('krs')) {
            $data['krs_error'] = $this->upload->display_errors();
        } else {
            $krs_data = $this->upload->data();
        }
    
        // Upload KHS
        if (!$this->upload->do_upload('khs')) {
            $data['khs_error'] = $this->upload->display_errors();
        } else {
            $khs_data = $this->upload->data();
        }
    
        // Jika tidak ada error pada upload
        if (empty($data['krs_error']) && empty($data['khs_error'])) {
            $mahasiswa_id = $this->session->userdata('id');
            $semester_id = $this->input->post('semester_id'); // Ambil semester_id dari POST data
    
            // Verifikasi apakah mahasiswa_id ada di mahasiswa_profiles
            $this->load->model('MahasiswaProfile_model');
            $mahasiswa_exists = $this->MahasiswaProfile_model->check_mahasiswa_exists($mahasiswa_id);
    
            if (!$mahasiswa_exists) {
                $this->session->set_flashdata('message', 'ID Mahasiswa tidak ditemukan dalam profil.');
                redirect('bimbingan/index');
            }
    
            // Cek apakah semester_id valid dan sesi bimbingan terbuka
            $session = $this->BimbinganSession_model->get_session_by_semester($semester_id);
    
            if (!$session || $session['is_open'] != 1) {
                // Jika sesi bimbingan tidak terbuka, tampilkan pesan error
                $this->session->set_flashdata('message', 'Sesi bimbingan untuk semester ini belum dibuka. Hubungi Prodi untuk membuka bimbingan !');
                redirect('bimbingan/pilih_semester');
            } else {
                // Jika sesi bimbingan terbuka, lanjutkan dengan menyimpan data bimbingan
                $bimbingan_data = [
                    'mahasiswa_id' => $mahasiswa_id,
                    'ipk' => $this->input->post('ipk'),
                    'semester_id' => $semester_id, // Simpan semester_id
                    'krs' => $krs_data['file_name'],
                    'khs' => $khs_data['file_name'],
                ];
    
                // Insert data bimbingan
                $this->Bimbingan_model->insert_bimbingan($bimbingan_data);
    
                // Ambil dosen_id dari profil mahasiswa
                $dosen_id = $this->MahasiswaProfile_model->get_dosen_pembimbing($mahasiswa_id);
    
                // Ambil NIM dari profil mahasiswa
                $nim_mahasiswa = $this->MahasiswaProfile_model->get_nim_by_mahasiswa($mahasiswa_id);
    
                // Jika dosen pembimbing ditemukan, tambahkan notifikasi
                if ($dosen_id && $nim_mahasiswa) {
                    $this->load->model('Notification_model');
                    $message = 'Mahasiswa dengan NIM ' . $nim_mahasiswa . ' ingin melakukan bimbingan.';
                    $this->Notification_model->add_notification($mahasiswa_id, $dosen_id, $message);
                }
    
                redirect('bimbingan/index');
            }
        } else {
            // Jika ada error pada upload, kembali ke halaman add
            $this->add();
        }
    }
    
    
    public function index1() {
        $data['judul'] = 'Daftar Bimbingan';
        $user_id = $this->session->userdata('id');
        
        // Ambil notifikasi untuk dosen
        $this->load->model('Notification_model');
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);
        
        // Ambil daftar mahasiswa bimbingan dosen
        $this->load->model('MahasiswaProfile_model');
        $data['mahasiswa_list'] = $this->MahasiswaProfile_model->get_mahasiswa_by_dosen($user_id);
        
        // Load pagination library
        $this->load->library('pagination');
        
        // Ambil nilai dari filter yang dipilih
        $mahasiswa_id = $this->input->get('mahasiswa_id');
        $search_query = $this->input->get('search_query'); // Ambil nilai pencarian
        
        // Config pagination
        $config['base_url'] = base_url('bimbingan/index1');
        $config['total_rows'] = $mahasiswa_id ? 
            $this->Bimbingan_model->count_bimbingan_by_mahasiswa($mahasiswa_id,  $search_query) : 
            $this->Bimbingan_model->count_bimbingan_by_dosen($user_id,  $search_query);
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        
        // Initialize pagination
        $this->pagination->initialize($config);
        
        // Get current page from URL
        $page = $this->uri->segment(3, 0);
        
        // Filter berdasarkan mahasiswa jika ada parameter mahasiswa_id
        if ($mahasiswa_id) {
            $data['bimbingan'] = $this->Bimbingan_model->get_bimbingan_by_mahasiswa($mahasiswa_id, $search_query, $config['per_page'], $page);
        } else {
            $data['bimbingan'] = $this->Bimbingan_model->get_bimbingan_by_dosen($user_id, $search_query, $config['per_page'], $page);
        }
        
        // Pagination links
        $data['pagination_links'] = $this->pagination->create_links();
        
        // Load view dengan data yang diperlukan
        $this->load->view('template/sidebar', $data);
        $this->load->view('bimbingan/index', $data);
        $this->load->view('template/footer', $data);
    }
    
    
    
    

    public function index() {
        $data['judul'] = 'Daftar Bimbingan';
        $mahasiswa_id = $this->session->userdata('id');
        $search_query = $this->input->get('search_query');
        // Pagination configuration
        $this->load->library('pagination');
    
        $config['base_url'] = base_url('bimbingan/index');
        $config['total_rows'] = $this->Bimbingan_model->count_bimbingan_by_mahasiswa($mahasiswa_id,$search_query);
        $config['per_page'] = 6; // Jumlah data per halaman
        $config['uri_segment'] = 3; // Segment ke-3 dari URL
        $config['num_links'] = 2; // Jumlah link yang ditampilkan di kiri dan kanan halaman aktif
    
      
    
        $this->pagination->initialize($config);
    
        $page = $this->uri->segment(3);
        $data['pagination_links'] = $this->pagination->create_links();
    
        // Ambil data bimbingan dengan limit dan offset
        $limit = $config['per_page'];
        $start = $page;
        $data['bimbingan'] = $this->Bimbingan_model->get_bimbingan_by_mahasiswa($mahasiswa_id, $search_query, $limit, $start);
    
        // Ambil notifikasi untuk mahasiswa
        $this->load->model('Notification_model');
        $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($mahasiswa_id, $search_query);
        $data['unread_count'] = count($data['notifications']);
    
        $this->load->view('template/sidebar', $data);
        $this->load->view('bimbingan/index', $data);
        $this->load->view('template/footer', $data);
    }
    


    public function index3() {
        $data['judul'] = 'Daftar Bimbingan';
        
        // Ambil data dosen dan mahasiswa untuk dropdown filter
        $data['dosen_list'] = $this->MahasiswaProfile_model->get_all_dosen_from_mahasiswa_profile();
        $data['mahasiswa_list'] = $this->MahasiswaProfile_model->get_all_mahasiswa_from_mahasiswa_profile();
        
        // Ambil nilai dari filter yang dipilih
        $dosen_id = $this->input->get('dosen_id');
        $mahasiswa_id = $this->input->get('mahasiswa_id');
        $search_query = $this->input->get('search_query'); // Ambil nilai pencarian
        
        // Load pagination library
        $this->load->library('pagination');
        
        // Config pagination
        $config['base_url'] = base_url('bimbingan/index3');
        $config['total_rows'] = $this->Bimbingan_model->count_bimbingan($dosen_id, $mahasiswa_id, $search_query);
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        
        // Set pagination group numbers
        $config['num_links'] = 2; // Number of links on each side of the current page
        
        // Initialize pagination
        $this->pagination->initialize($config);
        
        // Get current page from URL
        $page = $this->uri->segment(3, 0);
        
        // Cek filter yang dipilih dan tampilkan data yang sesuai
        if ($dosen_id && $mahasiswa_id) {
            $data['bimbingan'] = $this->Bimbingan_model->get_bimbingan_by_dosen_and_mahasiswa($dosen_id, $mahasiswa_id, $search_query, $config['per_page'], $page);
        } elseif ($dosen_id) {
            $data['bimbingan'] = $this->Bimbingan_model->get_bimbingan_by_dosen($dosen_id, $search_query, $config['per_page'], $page);
        } elseif ($mahasiswa_id) {
            $data['bimbingan'] = $this->Bimbingan_model->get_bimbingan_by_mahasiswa($mahasiswa_id, $search_query, $config['per_page'], $page);
        } else {
            $data['bimbingan'] = $this->Bimbingan_model->get_all_bimbingan($search_query, $config['per_page'], $page);
        }
        
        // Pagination links
        $data['pagination_links'] = $this->pagination->create_links();
        
        $this->load->view('template/sidebar', $data);
        $this->load->view('bimbingan/index', $data);
        $this->load->view('template/footer', $data);
    }
    
    
    
    
    public function acc_bimbingan($bimbingan_id) {
        // Load model bimbingan
        $this->load->model('Bimbingan_model');
        
        // Set status is_acc menjadi 1
        $this->Bimbingan_model->update_acc_status($bimbingan_id, 1);
        
        // Redirect kembali ke halaman bimbingan
        redirect('bimbingan/view/' . $bimbingan_id);
    }
    

    public function view($bimbingan_id) {
        $data['judul'] = 'Detail Bimbingan';
        $user_id = $this->session->userdata('id');
        $data['bimbingan'] = $this->Bimbingan_model->get_bimbingan_by_id($bimbingan_id);
        $data['comments'] = $this->Comment_model->get_comments_by_bimbingan($bimbingan_id);
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($user_id);
        $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($user_id);
        $data['unread_count'] = count($data['notifications']);
        $this->load->view('template/sidebar', $data);
        $this->load->view('bimbingan/view', $data);
        $this->load->view('template/footer',$data);
    }
    public function add_comment() {
        $comment_data = [
            'bimbingan_id' => $this->input->post('bimbingan_id'),
            'dosen_id' => $this->session->userdata('id'),
            'is_approved' => 1, // Setujui saat komentar ditambahkan
            'comment' => $this->input->post('comment')
        ];
    
        $this->Comment_model->insert_comment($comment_data);
    
        // Ambil mahasiswa_id berdasarkan bimbingan_id
        $this->load->model('Bimbingan_model');
        $mahasiswa_id = $this->Bimbingan_model->get_mahasiswa_id_by_bimbingan($comment_data['bimbingan_id']);
    
        // Buat notifikasi untuk mahasiswa
        $this->load->model('Notification_model');
        $message = 'Bimbingan yang kamu lakukan sudah di approve.';
        $this->Notification_model->add_notification($mahasiswa_id, $comment_data['dosen_id'], $message);
    
        redirect('bimbingan/view/' . $comment_data['bimbingan_id']);
    }
    
    public function delete($id) {
        // Hapus data terkait di tabel comments
        $this->db->where('bimbingan_id', $id);
        $this->db->delete('comments');
    
        // Hapus data di tabel bimbingan
        $this->db->where('id', $id);
        $this->db->delete('bimbingan');
    
        redirect('bimbingan/index');
    }
    

    public function chart_ipk($mahasiswa_id = null) {
        $current_user_id = $this->session->userdata('id');

    // Ambil notifikasi untuk mahasiswa
    $this->load->model('Notification_model');
    $data['notifications'] = $this->Notification_model->get_notifications_for_mahasiswa($current_user_id);
    $data['unread_count'] = count($data['notifications']);
        $user_level = $this->session->userdata('level');
        
        $data['notifications'] = $this->Notification_model->get_notifications_by_dosen($current_user_id);
    
        // Jika admin yang mengakses halaman
        if ($user_level == 1) {
            if ($mahasiswa_id !== null) {
                $data['ipk_data'] = $this->Bimbingan_model->get_ipk_by_mahasiswa($mahasiswa_id);
                $data['judul'] = 'Grafik IPK Mahasiswa';
            } else {
                // Jika tidak ada ID mahasiswa yang disediakan, redirect ke halaman bimbingan
                $this->session->set_flashdata('message', 'ID mahasiswa diperlukan.');
                redirect('bimbingan/index');
            }
        } 
        // Jika dosen yang mengakses halaman
        else if ($user_level == 2 && $mahasiswa_id !== null) {
            $data['ipk_data'] = $this->Bimbingan_model->get_ipk_by_mahasiswa($mahasiswa_id);
            $data['judul'] = 'Grafik IPK Mahasiswa';
        } 
        // Jika mahasiswa yang mengakses halaman
        else if ($user_level == 3) { 
            $data['ipk_data'] = $this->Bimbingan_model->get_ipk_by_mahasiswa($current_user_id);
            $data['judul'] = 'Grafik IPK Anda';
        } else {
            // Jika tidak ada ID mahasiswa yang disediakan untuk dosen atau admin, redirect ke halaman bimbingan
            $this->session->set_flashdata('message', 'Akses ditolak.');
            redirect('bimbingan/index');
        }
    
        // Cek apakah ada data IPK
        if (empty($data['ipk_data'])) {
            $this->session->set_flashdata('message', 'IPK belum diinputkan.');
            redirect('bimbingan/index');
        } else {
            $this->load->view('template/sidebar', $data);
            $this->load->view('mahasiswa/chart_ipk', $data);
            $this->load->view('template/footer', $data);
        }
    }
    
    public function print_bimbingan($bimbingan_id) {
    // Ambil data bimbingan berdasarkan ID
    $bimbingan = $this->Bimbingan_model->get_bimbingan_by_id1($bimbingan_id);
    $mahasiswa_id = $bimbingan['mahasiswa_id']; 

    // Ambil data komentar dosen terkait bimbingan
    $data['bimbingan'] = $bimbingan;
    $data['comments'] = $this->Bimbingan_model->get_comments_by_mahasiswa_id($mahasiswa_id);
    
    // Ambil status ACC dari bimbingan
    $data['acc_status'] = $bimbingan['acc']; // Ambil acc dari tabel bimbingan

    // Load view untuk print
    $this->load->view('bimbingan/print_bimbingan', $data);
}

    
    
    

    

}
