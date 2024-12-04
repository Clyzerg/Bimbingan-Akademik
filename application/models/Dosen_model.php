<?php

class Dosen_model extends CI_model
{
    function data_dosen(){
		return $this->db->get('dosen');
	}
	public function input_data($data)
    {
        // Insert data ke dalam tabel
        $this->db->insert('dosen', $data);

    }
    function hapus_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	function edit_data($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	public function get_profiles_with_pagination($limit, $start) {
        $this->db->select('dosen_profiles.*, user.is_profile_complete');
        $this->db->from('dosen_profiles');
        $this->db->join('user', 'dosen_profiles.user_id = user.id');
        $this->db->where('user.is_profile_complete', 1);
        $this->db->limit($limit, $start);
        return $this->db->get()->result_array();
    }
    
    public function get_total_profiles_count() {
        $this->db->from('dosen_profiles');
        $this->db->join('user', 'dosen_profiles.user_id = user.id');
        $this->db->where('user.is_profile_complete', 1);
        return $this->db->count_all_results();
    }
    
	public function get_all_dosen() {
        $this->db->select('*');
        $this->db->from('dosen_profiles');
        return $this->db->get()->result_array();
    }

    public function get_dosen_by_id($id) {
        return $this->db->get_where('dosen_profiles', array('user_id' => $id))->row_array();
    }

    public function update_dosen($id, $data) {
        $this->db->where('user_id', $id);
        return $this->db->update('dosen_profiles', $data);
    }

    public function delete_dosen($id) {
        $this->db->where('user_id', $id);
        return $this->db->delete('dosen_profiles');
    }
	
}