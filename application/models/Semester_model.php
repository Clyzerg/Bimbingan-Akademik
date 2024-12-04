<?php
class Semester_model extends CI_Model {

    public function get_all_semesters() {
        return $this->db->get('semester')->result_array();
    }
}
