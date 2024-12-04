<?php
class Angkatan_model extends CI_Model {

    public function get_all_angkatan() {
        return $this->db->get('angkatan')->result_array();
    }
}
?>
