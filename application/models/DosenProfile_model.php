<?php
class DosenProfile_model extends CI_Model {

    public function get_profile($user_id) {
        return $this->db->get_where('dosen_profiles', array('user_id' => $user_id))->row_array();
    }
    public function get_all_dosen() {
        return $this->db->get('dosen_profiles')->result_array();
    }
    public function get_all_dosen1() {
        $this->db->select('user_id as user_id, full_name');
        $this->db->from('dosen_profiles');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function check_unique_profile($user_id, $nidn, $email, $phone_number, $nik, $full_name) {
        $this->db->where('nidn', $nidn);
        $this->db->where('full_name', $full_name);
        $this->db->or_where('email', $email);
        $this->db->or_where('phone_number', $phone_number);
        $this->db->or_where('nik', $nik);
        $this->db->where('user_id !=', $user_id); // Mengecualikan profil dosen yang sedang di-update
    
        $query = $this->db->get('dosen_profiles');
        return $query->row(); // Mengembalikan hasil jika ditemukan data yang sama
    }
    
    public function update_profile($user_id, $profile_data) {
        $this->db->where('user_id', $user_id);
        $this->db->insert('dosen_profiles', $profile_data);
    }

    public function mark_profile_complete($user_id) {
        $this->db->where('id', $user_id);
        $this->db->update('user', array('is_profile_complete' => 1));
    }
    public function update_profile1($user_id, $profile_data) {
        $this->db->where('user_id', $user_id);
        $this->db->update('dosen_profiles', $profile_data);
    }
    public function get_total_dosen() {
        return $this->db->count_all('dosen_profiles');
    }
    public function get_dosen_by_id($dosen_id) {
        $this->db->select('*');
        $this->db->from('dosen_profiles');
        $this->db->where('user_id', $dosen_id);
        return $this->db->get()->row_array();
    }
}
