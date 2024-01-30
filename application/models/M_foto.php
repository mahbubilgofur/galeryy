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
    // mengambil data album
    public function getAlbumsWithFoto()
    {
        $this->db->select('tbl_foto.*, tbl_album.nama_album');
        $this->db->from('tbl_foto');
        $this->db->join('tbl_album', 'tbl_foto.id_album = tbl_album.id_album');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getAlbumsdanId_user($id_user)
    {
        // Fetch album data from the database based on id_user
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tbl_album'); // Ganti 'your_album_table_name' dengan nama tabel yang sesuai

        // Check if there are records
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array(); // Return an empty array if no records found
        }
    }
    // menampilkan data foto sesuai id_user
    public function getFotoByIdUser($id_user)
    {
        // Sesuaikan dengan nama tabel dan kolom pada database Anda
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('tbl_foto');

        // Kembalikan hasil query
        return $query->result();
    }
}
