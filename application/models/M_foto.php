<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_foto extends CI_Model
{
    public function getFotos()
    {
        // Ambil data foto dari database
        return $this->db->get('tbl_foto')->result();
    }

    public function insertFoto($data)
    {
        // Insert data foto ke database
        $this->db->insert('tbl_foto', $data);
    }

    public function getFotoById($id)
    {
        // Ambil data foto berdasarkan ID
        return $this->db->get_where('tbl_foto', array('id_foto' => $id))->row();
    }

    public function updateFoto($id, $data)
    {
        // Update data foto berdasarkan ID
        $this->db->where('id_foto', $id);
        $this->db->update('tbl_foto', $data);
    }

    public function deleteFoto($id)
    {
        // Hapus data foto berdasarkan ID
        $this->db->delete('tbl_foto', array('id_foto' => $id));
    }
    public function getFoto_id_album($id_album)
    {
        $this->db->select('*');
        $this->db->from('tbl_foto');
        $this->db->where('id_album', $id_album);
        $query = $this->db->get();
        return $query->result();
    }
    public function getIdFoto($id_foto)
    {
        $this->db->where('id_foto', $id_foto);
        $query = $this->db->get('tbl_foto');
        return $query->row(); // Assuming you want to retrieve a single photo
    }
}
