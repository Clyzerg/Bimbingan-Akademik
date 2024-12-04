<?php

class User_model extends CI_model
{
    public function get_user_count() {
        return $this->db->count_all('user');
    }
    
    public function get_users($limit, $start) {
        $this->db->select('user.*, level.level');
        $this->db->from('user');
        $this->db->join('level', 'user.level = level.id');
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }
    public function getAllUsers()
    {
        return $this->db->get('user');

    } 
    public function add_user($user_data) {
        $user_data['password'] = md5($user_data['password']);
        $this->db->insert('user', $user_data);
    }
        public function insert_user($data) {
            $this->db->insert('user', $data);
        }
        public function get_all_users() {
            $this->db->select('user.*, level.level');
            $this->db->from('user');
            $this->db->join('level', 'user.level = level.id');
            return $this->db->get()->result_array();
        }
        
        public function get_user_by_id($id) {
            $this->db->select('user.*, level.level');
            $this->db->from('user');
            $this->db->join('level', 'user.level = level.id');
            $this->db->where('user.id', $id);
            return $this->db->get()->row_array();
        }
        
        public function update_user($id, $data) {
            $this->db->where('id', $id);
            $this->db->update('user', $data);
        }
        public function update_profile_status($id, $status) {
            $this->db->where('id', $id);
            $this->db->update('user', ['is_profile_complete' => $status]);
        }
        public function get_total_users() {
            return $this->db->count_all('user');
        }
        public function get_total_mahasiswa() {
            $this->db->where('level', 'mahasiswa'); // Misalnya mahasiswa memiliki level 'mahasiswa'
            return $this->db->count_all_results('user');
        }
        
    }
    ?>
    
    
