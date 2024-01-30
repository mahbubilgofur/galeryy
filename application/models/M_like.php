<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_like extends CI_Model
{
    public function getLikes()
    {
        // Ambil data like dari tabel 'tbl_like'
        $query = $this->db->get('tbl_like');
        return $query->result();
    }

    public function getLikeById($id)
    {
        // Ambil data like berdasarkan ID dari tabel 'tbl_like'
        $query = $this->db->get_where('tbl_like', array('id_like' => $id));
        return $query->row();
    }

    public function insertLike($data)
    {
        // Insert data like ke dalam tabel 'tbl_like'
        $this->db->insert('tbl_like', $data);
    }

    public function updateLike($id, $data)
    {
        // Update data like berdasarkan ID di dalam tabel 'tbl_like'
        $this->db->where('id_like', $id);
        $this->db->update('tbl_like', $data);
    }

    public function deleteLike($id)
    {
        // Hapus data like berdasarkan ID dari tabel 'tbl_like'
        $this->db->delete('tbl_like', array('id_like' => $id));
    }
    // public function check_like($id_foto, $id_user)
    // {
    //     $this->db->where('id_foto', $id_foto);
    //     $this->db->where('id_user', $id_user);
    //     return $this->db->get('tbl_like')->row();
    // }

    // public function add_like($id_foto, $id_user)
    // {
    //     $data = array(
    //         'id_foto' => $id_foto,
    //         'id_user' => $id_user,
    //         'tgl_like' => date('Y-m-d H:i:s')
    //     );
    //     $this->db->insert('tbl_like', $data);
    //     return $this->db->insert_id();
    // }

    // public function remove_like($id_like)
    // {
    //     $this->db->where('id_like', $id_like);
    //     $this->db->delete('tbl_like');
    // }
    public function check_like($id_foto, $id_user)
    {
        $this->db->where('id_foto', $id_foto);
        $this->db->where('id_user', $id_user);
        return $this->db->get('tbl_like')->row(); // Menggunakan row() untuk mendapatkan satu baris data
    }

    public function add_like($id_foto, $id_user)
    {
        $data = array(
            'id_foto' => $id_foto,
            'id_user' => $id_user,
            'tgl_like' => date('Y-m-d H:i:s')
        );

        $this->db->insert('tbl_like', $data);

        // Mengembalikan id_like jika menggunakan Auto Increment pada id_like
        return $this->db->insert_id();
    }

    public function remove_like($id_like)
    {
        $this->db->where('id_like', $id_like);
        $this->db->delete('tbl_like');

        // Mengembalikan jumlah baris yang terpengaruh (0 jika tidak ada yang dihapus)
        return $this->db->affected_rows();
    }
    // Model M_like mengih
    public function get_like_count($id_foto)
    {
        $this->db->where('id_foto', $id_foto);
        return $this->db->count_all_results('tbl_like');
    }
}
