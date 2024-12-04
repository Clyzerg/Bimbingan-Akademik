<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model {

    public function insert_comment($data) {
        return $this->db->insert('comments', $data);
    }
    public function update_comment_by_bimbingan($bimbingan_id, $dosen_id, $data)
    {
        $this->db->where('bimbingan_id', $bimbingan_id);
        $this->db->where('dosen_id', $dosen_id);
        return $this->db->insert('comments', $data);
    }
    public function get_comments_by_bimbingan($bimbingan_id) {
        $this->db->select('comments.*, dosen_profiles.full_name as dosen_name');
        $this->db->from('comments');
        $this->db->join('dosen_profiles', 'comments.dosen_id = dosen_profiles.user_id');
        $this->db->where('comments.bimbingan_id', $bimbingan_id);
        return $this->db->get()->result_array(); // Mengembalikan array dari hasil query
    }
    
    public function delete_comments_by_dosen_id($dosen_id) {
        $this->db->where('dosen_id', $dosen_id);
        $this->db->delete('comments');
    }
    public function get_comments_by_bimbingan_id($bimbingan_id) {
        $this->db->select('comments.comment, comments.is_approved, comments.created_at, dosen_profiles.full_name as dosen_name');
        $this->db->from('comments');
        $this->db->join('dosen_profiles', 'comments.dosen_id = dosen_profiles.user_id');
        $this->db->where('comments.bimbingan_id', $bimbingan_id);
        return $this->db->get()->result_array();
    }
    public function get_comments_by_mahasiswa_id($mahasiswa_id) {
        $this->db->select('comments.comment, comments.is_approved, comments.created_at, dosen_profiles.full_name as dosen_name');
        $this->db->from('comments');
        $this->db->join('bimbingan', 'comments.bimbingan_id = bimbingan.id');
        $this->db->join('dosen_profiles', 'comments.dosen_id = dosen_profiles.user_id');
        $this->db->where('bimbingan.mahasiswa_id', $mahasiswa_id);
        return $this->db->get()->result_array();
    }
    
    public function get_comments_by_bimbingan_id1($bimbingan_id) {
        $this->db->select('comments.comment, comments.is_approved, comments.created_at, dosen_profiles.full_name as dosen_name');
        $this->db->from('comments');
        $this->db->join('dosen_profiles', 'comments.dosen_id = dosen_profiles.user_id');
        $this->db->where('comments.bimbingan_id', $bimbingan_id);
        return $this->db->get()->result_array();
    }
    
    }
    

