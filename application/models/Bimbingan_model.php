<?php
class Bimbingan_model extends CI_Model {

    public function count_bimbingan($dosen_id = NULL, $mahasiswa_id = NULL) {
        $this->db->select('COUNT(bimbingan.id) as total');
        $this->db->from('bimbingan');
        $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id', 'left');
    
        if ($dosen_id) {
            // Mengambil dosen_id dari mahasiswa_profiles jika ada filter berdasarkan dosen
            $this->db->where('mahasiswa_profiles.dosen_id', $dosen_id);
        }
        if ($mahasiswa_id) {
            // Mengambil mahasiswa berdasarkan ID atau nama/NPM jika ada filter berdasarkan mahasiswa
            $this->db->where('bimbingan.mahasiswa_id', $mahasiswa_id);
            $this->db->or_like('mahasiswa_profiles.full_name', $mahasiswa_id);
            $this->db->or_like('mahasiswa_profiles.npm', $mahasiswa_id);
        }
    
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['total'];
    }
    
    public function count_bimbingan_by_mahasiswa($mahasiswa_id) {
        $this->db->where('mahasiswa_id', $mahasiswa_id);
        return $this->db->count_all_results('bimbingan');
    }

    public function get_bimbingan($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('bimbingan');
            return $query->result_array();
        }

        $query = $this->db->get_where('bimbingan', array('id' => $id));
        return $query->row_array();
    }
    public function update_acc_status($bimbingan_id, $status) {
        // Update status bimbingan berdasarkan ID
        $this->db->where('id', $bimbingan_id);
        $this->db->update('bimbingan', array('acc' => $status));
    }
    
    
    public function get_total_bimbingan_by_dosen($dosen_id) {
        $this->db->from('bimbingan');
        $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
        $this->db->where('mahasiswa_profiles.dosen_id', $dosen_id);
        return $this->db->count_all_results();
    }
    public function get_mahasiswa_id_by_bimbingan($bimbingan_id) {
        $this->db->select('mahasiswa_id');
        $this->db->from('bimbingan');
        $this->db->where('id', $bimbingan_id);
        $query = $this->db->get();
        return $query->row()->mahasiswa_id;
    }
    
    public function insert_bimbingan($data) {
        $this->db->insert('bimbingan', $data);
        return $this->db->insert_id();
    }
    public function get_bimbingan_by_mahasiswa($mahasiswa_id, $search_query, $limit, $start) {
        $this->db->select('
            bimbingan.*, 
            comments.is_approved, 
            mahasiswa_profiles.full_name AS mahasiswa_name, 
            mahasiswa_profiles.nim, 
            dosen_profiles.full_name AS dosen_name
        ');
        $this->db->from('bimbingan');
        $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
        $this->db->join('comments', 'bimbingan.id = comments.bimbingan_id', 'left');
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id', 'left'); // join dengan tabel dosen_profiles
    
        // Filter berdasarkan mahasiswa_id
        $this->db->where('bimbingan.mahasiswa_id', $mahasiswa_id);
        
        // Tambahkan kondisi pencarian jika ada
        if ($search_query) {
            $this->db->group_start(); // Mulai grup pencarian
            $this->db->like('mahasiswa_profiles.full_name', $search_query);
            $this->db->or_like('mahasiswa_profiles.nim', $search_query);
            $this->db->or_like('dosen_profiles.dosen_id', $search_query); // Sesuaikan dengan field yang relevan di tabel bimbingan
            $this->db->group_end(); // Akhiri grup pencarian
        }
        
        $this->db->limit($limit, $start);
        $this->db->order_by('bimbingan.created_at', 'DESC');
        
        return $this->db->get()->result_array();
    }
    
    public function get_all_bimbingan1($limit, $start) {
        $this->db->select('
            bimbingan.*, 
            comments.is_approved, 
            mahasiswa_profiles.nim, 
            mahasiswa_profiles.full_name AS mahasiswa_name, 
            dosen_profiles.full_name AS dosen_name
        ');
        $this->db->from('bimbingan');
        $this->db->join('comments', 'bimbingan.id = comments.bimbingan_id', 'left');
        $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id', 'left'); 
        $this->db->limit($limit, $start);// Join dengan dosen_profiles
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_all_bimbingan($search_query, $limit, $start) {
        $this->db->select('
            bimbingan.*, 
            comments.is_approved, 
            mahasiswa_profiles.nim, 
            mahasiswa_profiles.full_name AS mahasiswa_name, 
            dosen_profiles.full_name AS dosen_name
        ');
        $this->db->from('bimbingan');
        $this->db->join('comments', 'bimbingan.id = comments.bimbingan_id', 'left');
        $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
        $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id', 'left');
        if ($search_query) {
            $this->db->group_start(); // Mulai grup pencarian
            $this->db->like('mahasiswa_profiles.full_name', $search_query);
            $this->db->or_like('mahasiswa_profiles.nim', $search_query);
            $this->db->or_like('mahasiswa_profiles.dosen_id', $search_query); // Sesuaikan dengan field yang relevan di tabel bimbingan
            $this->db->group_end(); // Akhiri grup pencarian
        }
        
        $this->db->order_by('bimbingan.created_at', 'DESC');
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
    
    public function get_bimbingan_by_id($bimbingan_id) {
        $this->db->select('bimbingan.*, mahasiswa_profiles.full_name, mahasiswa_profiles.nim, angkatan.tahun as angkatan_tahun');
        $this->db->from('bimbingan');
        $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
        $this->db->join('angkatan', 'mahasiswa_profiles.angkatan_id = angkatan.id');
        $this->db->where('bimbingan.id', $bimbingan_id);
        return $this->db->get()->row_array();
    }
    public function get_bimbingan_by_id1($bimbingan_id) {
        $this->db->select('bimbingan.*, mahasiswa_profiles.full_name, mahasiswa_profiles.nim, mahasiswa_profiles.user_id as mahasiswa_id, mahasiswa_profiles.foto_profil, angkatan.tahun as angkatan_tahun');
        $this->db->from('bimbingan');
        $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
        $this->db->join('angkatan', 'mahasiswa_profiles.angkatan_id = angkatan.id');
        $this->db->where('bimbingan.id', $bimbingan_id);
        return $this->db->get()->row_array();
    }
    
    public function get_comments_by_mahasiswa_id($mahasiswa_id) {
        $this->db->select('comments.comment, comments.is_approved, comments.created_at, dosen_profiles.full_name as dosen_name, bimbingan.semester_id');
        $this->db->from('comments');
        $this->db->join('dosen_profiles', 'comments.dosen_id = dosen_profiles.user_id');
        $this->db->join('bimbingan', 'comments.bimbingan_id = bimbingan.id');
        $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
        $this->db->where('mahasiswa_profiles.user_id', $mahasiswa_id);
        return $this->db->get()->result_array();
    }
    
    public function get_bimbingan_with_comments($user_id) {
        $this->db->select('bimbingan.*, comments.is_approved');
        $this->db->from('bimbingan');
        $this->db->join('comments', 'comments.bimbingan_id = bimbingan.id', 'left');
        $this->db->where('bimbingan.id', $user_id);
        return $this->db->get()->result_array();
    }
    
        public function delete_bimbingan($id) {
            // Hapus data dari tabel bimbingan
            $this->db->where('id', $id);
            return $this->db->delete('bimbingan');
        }
        public function get_ipk_by_mahasiswa($mahasiswa_id) {
            $this->db->select('semester_id, ipk');
            $this->db->from('bimbingan');
            $this->db->where('mahasiswa_id', $mahasiswa_id);
            $query = $this->db->get();
            return $query->result_array();
        }
        public function get_total_bimbingan() {
            return $this->db->count_all('bimbingan');
        }
        public function count_bimbingan_by_dosen($user_id) {
            $this->db->select('COUNT(bimbingan.id) AS total');
            $this->db->from('bimbingan');
            $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
            $this->db->where('mahasiswa_profiles.dosen_id', $user_id);
            $query = $this->db->get();
            $result = $query->row();
            return $result->total;
        }
        
        public function get_bimbingan_by_dosen($dosen_id, $search_query, $limit, $start) {
            $this->db->select('
                bimbingan.*, 
                mahasiswa_profiles.full_name AS mahasiswa_name, 
                mahasiswa_profiles.nim, 
                dosen_profiles.full_name AS dosen_name, 
                comments.is_approved
            ');
            $this->db->from('bimbingan');
            $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
            $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id', 'left'); // Join dengan dosen_profiles
            $this->db->join('comments', 'bimbingan.id = comments.bimbingan_id', 'left');
            
            // Filter berdasarkan dosen_id
            $this->db->where('mahasiswa_profiles.dosen_id', $dosen_id);
            
            // Tambahkan kondisi pencarian jika ada
            if ($search_query) {
                $this->db->group_start(); // Mulai grup pencarian
                $this->db->like('mahasiswa_profiles.full_name', $search_query);
                $this->db->or_like('mahasiswa_profiles.nim', $search_query);
                $this->db->or_like('mahasiswa_profiles.dosen_id', $search_query); // Sesuaikan dengan field yang relevan di tabel bimbingan
                $this->db->group_end(); // Akhiri grup pencarian
            }
            
            $this->db->order_by('bimbingan.created_at', 'DESC');
            $this->db->limit($limit, $start);
            
            return $this->db->get()->result_array();
        }
        
        public function get_bimbingan_by_dosen1($dosen_id, $limit, $offset) {
            $this->db->select('
                bimbingan.*, 
                mahasiswa_profiles.full_name AS mahasiswa_name, 
                mahasiswa_profiles.nim, 
                 semester.semester AS semester, 
                dosen_profiles.full_name AS dosen_name, 
                comments.is_approved
            ');
            $this->db->from('bimbingan');
            $this->db->join('mahasiswa_profiles', 'bimbingan.mahasiswa_id = mahasiswa_profiles.user_id');
            $this->db->join('dosen_profiles', 'mahasiswa_profiles.dosen_id = dosen_profiles.user_id', 'left'); // Join dengan dosen_profiles
            $this->db->join('comments', 'bimbingan.id = comments.bimbingan_id', 'left');
            $this->db->join('semester', 'bimbingan.semester_id = semester.id');
            $this->db->where('mahasiswa_profiles.dosen_id', $dosen_id);
            $this->db->limit($limit, $offset);  // Sesuaikan dengan dosen_id
            return $this->db->get()->result_array();
        }
        
        
      
        
    }

