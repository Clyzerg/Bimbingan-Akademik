<?php
class Notification_model extends CI_Model {

    // Menambahkan notifikasi baru
    public function add_notification($mahasiswa_id, $dosen_id, $message) {
        $data = [
            'mahasiswa_id' => $mahasiswa_id,
            'dosen_id' => $dosen_id,
            'message' => $message,
            'is_read' => 0, // Status notifikasi belum dibaca
        ];
        $this->db->insert('notifications', $data);
    }

    // Mendapatkan notifikasi berdasarkan dosen_id
    public function get_notifications_by_dosen($dosen_id) {
        $this->db->select('notifications.*, mahasiswa_profiles.full_name');
        $this->db->from('notifications');
        $this->db->join('mahasiswa_profiles', 'notifications.mahasiswa_id = mahasiswa_profiles.user_id');
        $this->db->where('notifications.dosen_id', $dosen_id); // Hanya notifikasi untuk dosen yang sedang login
        $this->db->where('mahasiswa_profiles.dosen_id', $dosen_id); // Pastikan hanya notifikasi dari mahasiswa yang dibimbing oleh dosen tersebut
        $this->db->where('message LIKE', '%ingin melakukan bimbingan%'); // Menampilkan hanya pesan bimbingan dari mahasiswa
        $this->db->order_by('notifications.created_at', 'DESC');
        return $this->db->get()->result_array();
    }
    
    
    
    

    // Menandai notifikasi sebagai telah dibaca
    public function mark_as_read($notification_id) {
        $this->db->set('is_read', 1);
        $this->db->where('id', $notification_id);
        $this->db->update('notifications');
    }
    public function get_notifications_for_mahasiswa($mahasiswa_id) {
        $this->db->select('*');
        $this->db->from('notifications');
        $this->db->where('mahasiswa_id', $mahasiswa_id);
        $this->db->where('message', 'Bimbingan yang kamu lakukan sudah di approve.');
        $this->db->where('is_read', 0); // Hanya ambil notifikasi yang belum dibaca
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    

}
