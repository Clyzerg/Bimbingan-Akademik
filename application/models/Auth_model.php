<?php
class Auth_model extends CI_Model {

    public function user_validation($username, $password) {
        // Ambil user berdasarkan username
        $this->db->where('username', $username);
        $user = $this->db->get('user')->row();

        // Periksa apakah user ada dan password yang diinput sama dengan password di database
        if ($user && md5($password) === $user->password) {
            return $user;
        }

        return false;
    }
 

        
    }
    



