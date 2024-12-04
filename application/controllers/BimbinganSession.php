<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BimbinganSession extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('BimbinganSession_model');
}

public function toggle_session($semester) {
    if ($semester === 'ganjil') {
        $this->BimbinganSession_model->toggle_ganjil();
        $status = $this->BimbinganSession_model->get_open_sessions_ganjil();
        $this->session->set_flashdata('message', 'Sesi bimbingan untuk semester ganjil ' . ($status ? 'berhasil dibuka.' : 'berhasil ditutup.'));
    } elseif ($semester === 'genap') {
        $this->BimbinganSession_model->toggle_genap();
        $status = $this->BimbinganSession_model->get_open_sessions_genap();
        $this->session->set_flashdata('message', 'Sesi bimbingan untuk semester genap ' . ($status ? 'berhasil dibuka.' : 'berhasil ditutup.'));
    }
    redirect('bimbingansession/index');
}

public function index() {
    $data['ganjil_open'] = $this->BimbinganSession_model->get_open_sessions_ganjil();
    $data['genap_open'] = $this->BimbinganSession_model->get_open_sessions_genap();
    $data['judul'] = 'Halaman Admin';
    $this->load->view('template/sidebar', $data);
    $this->load->view('admin/sessions', $data);
    $this->load->view('template/footer', $data);
}
}
