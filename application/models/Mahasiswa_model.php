<?php

class Mahasiswa_model extends CI_model
{
    function data_mahasiswa(){
		return $this->db->get('mahasiswa');
	}
	public function input_data($data)
    {
        // Insert data ke dalam tabel
        $this->db->insert('mahasiswa', $data);

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

}