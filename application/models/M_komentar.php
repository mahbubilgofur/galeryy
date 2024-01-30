<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_komentar extends CI_Model
{
    public function getKomentars()
    {
        // Ambil semua data dari tabel tbl_komentar
        return $this->db->get('tbl_komentar')->result();
    }

    public function insertKomentar($data)
    {
        // Masukkan data ke dalam tabel tbl_komentar
        return $this->db->insert('tbl_komentar', $data);
    }

    public function getKomentarById($id)
    {
        // Ambil data komentar berdasarkan ID
        return $this->db->get_where('tbl_komentar', array('id_komen' => $id))->row();
    }

    public function updateKomentar($id, $data)
    {
        // Update data komentar berdasarkan ID
        $this->db->where('id_komen', $id);
        return $this->db->update('tbl_komentar', $data);
    }

    public function deleteKomentar($id)
    {
        // Hapus data komentar berdasarkan ID
        return $this->db->delete('tbl_komentar', array('id_komen' => $id));
    }
}
