<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // // Memeriksa apakah pengguna telah login
        // if (!$this->session->userdata('email')) {
        //     redirect('login');
        // }

        // // Mendapatkan role_id dari sesi
        // $role_id = $this->session->userdata('role_id');

        // if ($role_id == 2) {
        //     // Jika role_id adalah 2, arahkan ke halaman tertentu atau berikan pesan kesalahan
        //     redirect('home');
        // }
        // Jika role_id adalah 1 atau jenis lain yang diizinkan, biarkan pengguna melanjutkan

        $this->load->model('M_user');
        $this->load->model('M_album');
        $this->load->model('M_foto');
        $this->load->model('M_like');
        $this->load->model('M_komentar');
    }
    public function index()
    {
        $DATA['data_user'] = $this->M_user->getuser();
        $DATA['albums'] = $this->M_album->getAlbums();
        $this->load->view('home/header', $DATA);
        $this->load->view('home/content', $DATA);
    }
    public function foto($id_album)
    {
        $DATA['data_user'] = $this->M_user->getuser();
        $DATA['photos'] = $this->M_foto->getFoto_id_album($id_album);
        $this->load->view('home/header', $DATA);
        $this->load->view('home/foto', $DATA);
    }

    public function detail_foto($id_foto)
    {
        $DATA['foto'] = $this->M_foto->getIdFoto($id_foto);
        $DATA['data_user'] = $this->M_user->getuser();
        // $DATA['photos'] = $this->M_foto->getFoto_id_album($);
        $this->load->view('home/header', $DATA);
        $this->load->view('home/detail_foto', $DATA);
    }

    public function like()
    {
        $id_foto = $this->input->post('id_foto');
        $id_user = $this->session->userdata('id_user');

        // Logika untuk menyimpan data like ke dalam tabel tbl_like
        $this->load->model('M_like');
        $like_data = $this->M_like->check_like($id_foto, $id_user);

        if (!$like_data) {
            // Belum dilike, tambahkan like
            $id_like = $this->M_like->add_like($id_foto, $id_user);
            echo json_encode(array('status' => 'liked', 'id_like' => $id_like));
        } else {
            // Sudah dilike, hapus like
            $this->M_like->remove_like($like_data->id_like);
            echo json_encode(array('status' => 'unliked'));
        }
    }
    public function check_role()
    {
        // Logika untuk memeriksa role_id (sesuaikan dengan struktur user Anda)
        $role_id = $this->session->userdata('role_id');

        if ($role_id == 1 || $role_id == 2) {
            echo json_encode(array('status' => 'authenticated'));
        } else {
            echo json_encode(array('status' => 'unauthenticated'));
        }
    }
    // Contoh di dalam controller Home
    public function get_status_like()
    {
        $id_foto = $this->input->post('id_foto');
        $id_user = $this->session->userdata('id_user');

        $this->load->model('M_like');
        $like_data = $this->M_like->check_like($id_foto, $id_user);

        if ($like_data) {
            echo json_encode(array('status' => 'liked'));
        } else {
            echo json_encode(array('status' => 'unliked'));
        }
    }
    // menghitung jumlah data di tbL like

    public function upload()
    {
        $this->load->view('home/header');
        $this->load->view('home/upload');
    }
    public function upload_album()
    {
        $this->load->view('home/header');
        $this->load->view('home/upload_album');
    }

    public function add_album()
    {
        // Periksa apakah pengguna sudah login
        if (!$this->session->userdata('id_user')) {
            // Redirect ke halaman login atau tangani kasus jika pengguna belum login
            redirect('login');
        }

        // Dapatkan ID pengguna yang sedang login
        $id_user = $this->session->userdata('id_user');

        // Set rules for form validation
        $this->form_validation->set_rules('nama_album', 'Nama Album', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        // Logika pengiriman formulir untuk membuat album
        if ($this->form_validation->run() == TRUE) {
            // Form validation successful
            $data = array(
                'nama_album' => $this->input->post('nama_album'),
                'deskripsi' => $this->input->post('deskripsi'),
                'tgl_buat' => date('Y-m-d H:i:s'), // Tanggal dibuat diisi dengan waktu sekarang
                'id_user' => $id_user, // Gunakan ID pengguna yang sedang login
            );

            $this->M_album->insertAlbum($data);

            // Redirect atau tampilkan pesan keberhasilan
            redirect('home');
        } else {
            // Form validation failed or form not submitted

            // Load views
            $this->load->view('home/header');
            $this->load->view('home/upload_album');
        }
    }
}
