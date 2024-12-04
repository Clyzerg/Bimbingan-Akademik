<?php
class Level_model extends CI_Model {

    public function get_all_levels() {
        return $this->db->get('level')->result_array();
    }
}
?>
