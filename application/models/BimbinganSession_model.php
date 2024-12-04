<?php

class BimbinganSession_model extends CI_Model {

public function open_session($semester_id) {
    $this->db->where('semester_id', $semester_id);
    $this->db->update('bimbingan_session', ['is_open' => 1]);
}

public function close_session($semester_id) {
    $this->db->where('semester_id', $semester_id);
    $this->db->update('bimbingan_session', ['is_open' => 0]);
}

public function get_sessions() {
    return $this->db->get('bimbingan_session')->result_array();
}
public function get_open_sessions() {
        return $this->db->get_where('bimbingan_session', ['is_open' => 1])->result_array();
    }

    public function get_session_by_semester($semester_id) {
        return $this->db->get_where('bimbingan_session', ['semester_id' => $semester_id])->row_array();
    }
    public function toggle_ganjil() {
        $status = $this->get_open_sessions_ganjil();
        $new_status = $status ? 0 : 1;
        $this->db->where('semester_id IN (1, 3, 5)', NULL, FALSE);
        $this->db->update('bimbingan_session', ['is_open' => $new_status]);
    }

    public function toggle_genap() {
        $status = $this->get_open_sessions_genap();
        $new_status = $status ? 0 : 1;
        $this->db->where('semester_id IN (2, 4, 6)', NULL, FALSE);
        $this->db->update('bimbingan_session', ['is_open' => $new_status]);
    }

    public function get_open_sessions_ganjil() {
        return $this->db->where('semester_id IN (1, 3, 5) AND is_open = 1')->count_all_results('bimbingan_session') > 0;
    }

    public function get_open_sessions_genap() {
        return $this->db->where('semester_id IN (2, 4, 6) AND is_open = 1')->count_all_results('bimbingan_session') > 0;
    }
    public function get_taken_semesters($mahasiswa_id) {
        $this->db->select('semester_id');
        $this->db->where('mahasiswa_id', $mahasiswa_id);
        return $this->db->get('bimbingan')->result_array(); // Asumsikan ada tabel bimbingan yang menyimpan data ini
    }
    
}
