<?php
class MahasiswaProfile_model extends CI_Model {

    public function get_profile($user_id) {
        return $this->db->get_where('mahasiswa_profiles', array('user_id' => $user_id))->row_array();
    }
    public function get_all_dosen_from_dosen_profiles() {
        $this->db->select('dosen_profiles.user_id, dosen_profiles.full_name');
        $this->db->from('dosen_profiles');
        $this->db->join('mahasiswa_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_all_mahasiswa_from_mahasiswa_profile() {
        $this->db->select('mahasiswa_profiles.user_id, mahasiswa_profiles.full_name, dosen_profiles.full_name AS dosen_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id', 'left');
        $this->db->group_by('mahasiswa_profiles.user_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_dosen_from_mahasiswa_profiles() {
        $this->db->distinct();
        $this->db->select('dosen_profiles.user_id, dosen_profiles.full_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id');
        $this->db->order_by('dosen_profiles.full_name');
        return $this->db->get()->result_array();
    }
    public function get_all_dosen_from_mahasiswa_profile() {
        $this->db->select('dosen_profiles.user_id, dosen_profiles.full_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id');
        $this->db->group_by('dosen_profiles.user_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_mahasiswa_by_dosen($dosen_id) {
        $this->db->select('mahasiswa_profiles.user_id, mahasiswa_profiles.full_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->where('mahasiswa_profiles.dosen_id', $dosen_id);
        $this->db->group_by('mahasiswa_profiles.user_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_all_mahasiswa_with_dosen() {
        $this->db->select('mahasiswa_profiles.user_id, mahasiswa_profiles.full_name,');
        $this->db->from('mahasiswa_profiles');
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id', 'left');
        $this->db->group_by('mahasiswa_profiles.user_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    public function check_mahasiswa_exists($mahasiswa_id) {
        $this->db->where('user_id', $mahasiswa_id);
        $query = $this->db->get('mahasiswa_profiles');
        return $query->num_rows() > 0;
    }
    public function update_profile($user_id, $profile_data) {
        $this->db->where('user_id', $user_id);
        $this->db->insert('mahasiswa_profiles', $profile_data);
    }
    public function check_unique_profile($user_id, $nim, $email, $phone_number) {
        $this->db->where('user_id !=', $user_id);
        $this->db->group_start()
                 ->where('nim', $nim)
                 ->or_where('email', $email)
                 ->or_where('phone_number', $phone_number)
                 ->group_end();
        $query = $this->db->get('mahasiswa_profiles');
    
        if ($query->num_rows() > 0) {
            return true; // Duplikat ditemukan
        }
        return false; // Tidak ada duplikat
    }
    
    public function mark_profile_complete($user_id) {
        $this->db->where('id', $user_id);
        $this->db->update('user', array('is_profile_complete' => 1));
    }
    public function update_profile1($user_id, $profile_data) {
        $this->db->where('user_id', $user_id);
        $this->db->update('mahasiswa_profiles', $profile_data);
    }
    public function get_profile_with_angkatan($user_id) {
        $this->db->select('mahasiswa_profiles.*, angkatan.tahun as angkatan_tahun, dosen_profiles.full_name as dosen_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->join('angkatan', 'angkatan.id = mahasiswa_profiles.angkatan_id', 'left');
        
        $this->db->join('dosen_profiles', 'dosen_profiles.user_id = mahasiswa_profiles.dosen_id', 'left');
        $this->db->where('mahasiswa_profiles.user_id', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_all_profiles_complete() {
        $this->db->select('mahasiswa_profiles.*, angkatan.tahun as angkatan_tahun, dosen_profiles.full_name as dosen_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->join('angkatan', 'mahasiswa_profiles.angkatan_id = angkatan.id');
        $this->db->join('user', 'mahasiswa_profiles.user_id = user.id');
        
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id');
        $this->db->where('user.is_profile_complete', 1);
        return $this->db->get()->result_array();
    }
    public function get_profiles_by_dosen1($dosen_id) {
        $this->db->select('mahasiswa_profiles.*, dosen_profiles.full_name as dosen_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->join('dosen_profiles', 'dosen_profiles.id = mahasiswa_profiles.dosen_id', 'left');
        $this->db->where('mahasiswa_profiles.dosen_id', $dosen_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_profiles_by_dosen($dosen_id) {
        $this->db->select('mahasiswa_profiles.*, angkatan.tahun as angkatan_tahun, dosen_profiles.full_name as dosen_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->join('angkatan', 'mahasiswa_profiles.angkatan_id = angkatan.id');
        $this->db->join('user', 'mahasiswa_profiles.user_id = user.id');
      
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id');
        $this->db->where('mahasiswa_profiles.dosen_id', $dosen_id);
        $this->db->where('user.is_profile_complete', 1);
        return $this->db->get()->result_array();
    }
    
    public function delete_profile($user_id) {
        // Delete from mahasiswa_profiles table
        $this->db->where('user_id', $user_id);
        $this->db->delete('mahasiswa_profiles');
        
        // Delete from user table
        $this->db->where('id', $user_id);
        $this->db->delete('user');
    }
    public function get_total_mahasiswa() {
        return $this->db->count_all('mahasiswa_profiles');
    }
    public function get_selected_semester($user_id) {
        $this->db->select('semester_id');
        $this->db->from('mahasiswa_profiles');
        $this->db->where('user_id', $user_id);
        $result = $this->db->get()->row_array();
        return $result ? $result['semester_id'] : null;
    }
    public function update_dosen($mahasiswa_id, $dosen_id) {
        $this->db->set('dosen_id', $dosen_id);
        $this->db->where('id', $mahasiswa_id);
        return $this->db->update('mahasiswa_profile');
    }
    public function get_dosen_pembimbing($mahasiswa_id) {
        $this->db->select('dosen_id');
        $this->db->from('mahasiswa_profiles');
        $this->db->where('user_id', $mahasiswa_id);
        return $this->db->get()->row()->dosen_id;
    }
    public function get_nim_by_mahasiswa($mahasiswa_id) {
        $this->db->select('nim');
        $this->db->from('mahasiswa_profiles');
        $this->db->where('user_id', $mahasiswa_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->nim;
        } else {
            return null;
        }
    }
    public function get_nama_by_mahasiswa($mahasiswa_id) {
        $this->db->select('full_name');
        $this->db->from('mahasiswa_profiles');
        $this->db->where('user_id', $mahasiswa_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->nama;
        } else {
            return null;
        }
    }
    
}
