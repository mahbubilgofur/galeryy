<?php

class M_user extends CI_Model
{

    public function getuser()
    {
        // Ambil data user dari tabel, sesuaikan dengan struktur tabel di database Anda
        $query = $this->db->get('tbl_user');
        return $query->result();
    }

    public function insert_user($data)
    {
        // Masukkan data user ke dalam tabel, sesuaikan dengan struktur tabel di database Anda
        $this->db->insert('tbl_user', $data);
    }

    public function getUserById($id)
    {
        // Ambil data user berdasarkan ID, sesuaikan dengan struktur tabel di database Anda
        $query = $this->db->get_where('tbl_user', array('id_user' => $id));
        return $query->row();
    }

    public function updateUser($id, $data)
    {
        // Perbarui data user berdasarkan ID, sesuaikan dengan struktur tabel di database Anda
        $this->db->where('id_user', $id);
        $this->db->update('tbl_user', $data);
    }

    public function deleteUser($id)
    {
        // Hapus data user berdasarkan ID, sesuaikan dengan struktur tabel di database Anda
        $this->db->where('id_user', $id);
        $this->db->delete('tbl_user');
    }
    public function get_user_by_email($email)
    {
        $query = $this->db->get_where('tbl_user', array('email' => $email));
        return $query->row();
    }
}
