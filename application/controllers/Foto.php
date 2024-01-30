<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Foto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Memeriksa apakah pengguna telah login
        if (!$this->session->userdata('email')) {
            redirect('login');
        }
        // Mendapatkan role_id dari sesi
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 2) {
            // Jika role_id adalah 2, arahkan ke halaman tertentu atau berikan pesan kesalahan
            redirect('home');
        }

        // Load model 'M_foto' untuk mengakses database
        $this->load->model('M_foto');
    }

    public function index()
    {
        // Ambil data foto dari database
        $data['fotos'] = $this->M_foto->getFotos();

        // Load view
        $this->load->view('admin/sidebar');
        $this->load->view('foto/content', $data);
    }

    public function add()
    {
        // Load view untuk menambahkan foto
        $this->load->view('admin/sidebar');
        $this->load->view('foto/add');
    }

    public function add_foto()
    {
        // Form submission logic for creating foto
        if ($this->input->post()) {
            // Konfigurasi upload gambar
            $config['upload_path'] = './fotos/'; // Sesuaikan dengan folder tempat menyimpan gambar
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024;  // Maksimal 1 MB

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('lokasi_file')) {
                $upload_data = $this->upload->data();
                $data = array(
                    'judul_foto' => $this->input->post('judul_foto'),
                    'deskripsi_foto' => $this->input->post('deskripsi_foto'),
                    'tgl_unggah' => date('Y-m-d H:i:s'),
                    'lokasi_file' => $upload_data['file_name'],
                    'id_album' => $this->input->post('id_album'),
                    'id_user' => $this->input->post('id_user'),
                );

                $this->M_foto->insertFoto($data);

                // Redirect or show success message
                redirect('foto');
            } else {
                // Jika upload gagal, tampilkan pesan error
                $error = array('error' => $this->upload->display_errors());
                $this->load->view('admin/sidebar');
                $this->load->view('foto/add', $error);
            }
        } else {
            // Load view jika form tidak disubmit
            $this->load->view('admin/sidebar');
            $this->load->view('foto/add');
        }
    }

    public function edit($id)
    {
        $data['foto'] = $this->M_foto->getFotoById($id);
        $this->load->view('admin/sidebar');
        $this->load->view('foto/edit', $data);
    }

    public function update($id)
    {
        // Form submission logic for updating foto
        if ($this->input->post()) {
            // Check if a new file is uploaded
            if (!empty($_FILES['lokasi_file']['name'])) {
                // Konfigurasi upload gambar
                $config['upload_path'] = './fotos/'; // Sesuaikan dengan folder tempat menyimpan gambar
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 1024;  // Maksimal 1 MB

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('lokasi_file')) {
                    // If upload is successful, update with new file
                    $upload_data = $this->upload->data();
                    $data = array(
                        'judul_foto' => $this->input->post('judul_foto'),
                        'deskripsi_foto' => $this->input->post('deskripsi_foto'),
                        'tgl_unggah' => date('Y-m-d H:i:s'),
                        'lokasi_file' => $upload_data['file_name'],
                        'id_album' => $this->input->post('id_album'),
                        'id_user' => $this->input->post('id_user'),
                    );

                    $this->M_foto->updateFoto($id, $data);

                    // Delete the old file if needed, uncomment the line below if you want to delete the old file
                    // unlink('./fotos/' . $this->input->post('old_lokasi_file'));

                    // Redirect or show success message
                    redirect('foto');
                } else {
                    // Jika upload gagal, tampilkan pesan error
                    $error = array('error' => $this->upload->display_errors());
                    $data['foto'] = $this->M_foto->getFotoById($id);
                    $this->load->view('admin/sidebar');
                    $this->load->view('foto/edit', $data + $error);
                }
            } else {
                // If no new file is uploaded, update without changing the file
                $data = array(
                    'judul_foto' => $this->input->post('judul_foto'),
                    'deskripsi_foto' => $this->input->post('deskripsi_foto'),
                    'tgl_unggah' => date('Y-m-d H:i:s'),
                    'id_album' => $this->input->post('id_album'),
                    'id_user' => $this->input->post('id_user'),
                );

                $this->M_foto->updateFoto($id, $data);

                // Redirect or show success message
                redirect('foto');
            }
        } else {
            // Load the edit view if no form submission
            $data['foto'] = $this->M_foto->getFotoById($id);

            if (!$data['foto']) {
                // Handle if foto is not found
                show_404();
            }

            $this->load->view('admin/sidebar');
            $this->load->view('foto/edit', $data);
        }
    }

    public function delete($id)
    {
        // Logic for deleting foto
        $this->M_foto->deleteFoto($id);

        // Redirect or show success message
        redirect('foto');
    }
}
