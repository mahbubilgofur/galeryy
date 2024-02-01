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
        $DATA['fotos'] = $this->M_foto->getFotos();
        $DATA['data_user'] = $this->M_user->getuser();
        $DATA['albums'] = $this->M_album->getAlbums();
        $this->load->view('home/header', $DATA);
        $this->load->view('home/content', $DATA);
    }
    public function foto($id_album)
    {
        $DATA['data_user'] = $this->M_user->getuser();
        $DATA['photos'] = $this->M_foto->getFoto_id_album($id_album);
        $DATA['likes'] = array();
        // foreach ($DATA['photos'] as $photo) {
        //     $jumlah_like = $this->M_like->hitungjumlahlike($photo->id_foto);
        //     $DATA['likes'][$photo->id_foto] = $jumlah_like;

        //     $jumlah_komentar = $this->M_komentar->hitungJumlahKomentarByIdFoto($photo->id_foto);
        //     $DATA['komentars'][$photo->id_foto] = $jumlah_komentar;
        // }
        foreach ($DATA['photos'] as $photo) {
            $jumlah_like = $this->M_like->hitungjumlahlike($photo['id_foto']);
            $DATA['likes'][$photo['id_foto']] = $jumlah_like;

            $jumlah_komentar = $this->M_komentar->hitungJumlahKomentarByIdFoto($photo['id_foto']);
            $DATA['komentars'][$photo['id_foto']] = $jumlah_komentar;
        }

        $this->load->view('home/header', $DATA);
        $this->load->view('home/foto', $DATA);
    }

    public function detail_foto($id_foto)
    {
        $DATA['foto'] = $this->M_foto->getIdFoto($id_foto);
        $DATA['profils'] = $this->M_foto->getUser_andid_foto($id_foto);
        $DATA['fotos'] = $this->M_like->getFotoById($id_foto);
        $DATA['data_user'] = $this->M_user->getuser();
        $DATA['role_id'] = $this->session->userdata('role_id');
        $DATA['is_liked'] = $this->is_liked($id_foto);
        $DATA['komentars'] = $this->M_komentar->getCommentsByFotoId($id_foto);
        $this->load->view('home/header', $DATA);
        $this->load->view('home/detail_foto', $DATA);
    }

    public function add_komentar()
    {
        $role_id = $this->session->userdata('role_id');
        if ($role_id != 1 && $role_id != 2) {
            // Tambahkan logika atau tindakan lain jika role_id tidak memenuhi syarat
            redirect('login'); // Ganti dengan URL yang sesuai
            return;
        }

        $id_user = $this->session->userdata('id_user');
        $isi_komentar = $this->input->post('isi_komentar');
        $tgl_komentar = date('Y-m-d H:i:s');
        $id_foto = $this->input->post('id_foto'); // Ambil id_foto dari formulir

        // Memastikan isi_komentar tidak kosong
        if (empty($isi_komentar)) {
            // Handle error, bisa menampilkan pesan kesalahan atau melakukan tindakan lain
            redirect(base_url('home/detail_foto/' . $id_foto)); // Ganti dengan redirect atau tindakan lain yang sesuai
        }

        $data = array(
            'id_foto' => $id_foto,
            'id_user' => $id_user,
            'isi_komentar' => $isi_komentar,
            'tgl_komentar' => $tgl_komentar
        );

        $this->M_komentar->add_komentar($data);

        // Redirect atau lakukan hal lain sesuai kebutuhan
        redirect(base_url('home/detail_foto/' . $id_foto));
    }

    public function add_like($id_foto)
    {
        // Lakukan verifikasi role_id atau kondisi lain yang diperlukan
        $role_id = $this->session->userdata('role_id');
        if ($role_id != 1 && $role_id != 2) {
            // Tambahkan logika atau tindakan lain jika role_id tidak memenuhi syarat
            redirect('login'); // Ganti dengan URL yang sesuai
            return;
        }

        // Lakukan penambahan like
        $id_user = $this->session->userdata('id_user'); // Sesuaikan dengan cara Anda mengelola sesi login
        $this->M_like->add_like($id_foto, $id_user);

        // Redirect kembali ke halaman foto atau halaman lain yang sesuai
        redirect('home/detail_foto/' . $id_foto);
    }

    // Fungsi untuk memeriksa apakah foto sudah dilike oleh pengguna
    private function is_liked($id_foto)
    {
        $id_user = $this->session->userdata('id_user'); // Sesuaikan dengan cara Anda mengelola sesi login
        return $this->M_like->isLiked($id_foto, $id_user);
    }
    public function remove_like($id_foto)
    {
        // Lakukan verifikasi role_id atau kondisi lain yang diperlukan
        $role_id = $this->session->userdata('role_id');
        if ($role_id != 1 && $role_id != 2) {
            // Tambahkan logika atau tindakan lain jika role_id tidak memenuhi syarat
            redirect('login'); // Ganti dengan URL yang sesuai
            return;
        }

        // Lakukan penghapusan like
        $id_user = $this->session->userdata('id_user'); // Sesuaikan dengan cara Anda mengelola sesi login
        $this->M_like->remove_like($id_foto, $id_user);

        // Redirect kembali ke halaman foto atau halaman lain yang sesuai
        redirect('home/detail_foto/' . $id_foto); // Ganti dengan URL yang sesuai
    }
    public function upload()
    {
        $this->load->view('home/header');
        $this->load->view('home/upload');
    }
    public function upload_album()
    {
        if (!$this->session->userdata('role_id')) {
            // Redirect to the login page or handle the case if the user is not logged in
            redirect('login');
        }
        $this->load->view('home/header');
        $this->load->view('home/upload_album');
    }
    public function upload_foto()
    {
        // Check if the user is logged in
        if (!$this->session->userdata('role_id')) {
            // Redirect to the login page or handle the case if the user is not logged in
            redirect('login');
        }

        // Get the id_user from the session
        $id_user = $this->session->userdata('id_user');

        // Fetch albums with joined foto data for the view based on id_user
        $data['data_album'] = $this->M_foto->getAlbumsdanId_user($id_user);

        $this->load->view('home/header');
        $this->load->view('home/upload_foto', $data);
    }


    public function add_album()
    {
        // Periksa apakah pengguna sudah login
        if (!$this->session->userdata('role_id')) {
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

            // Konfigurasi upload gambar
            $config['upload_path'] = './albums/';
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size'] = 1024;  // Maksimal 1 MB

            // Load library upload
            $this->load->library('upload', $config);

            // Lakukan upload gambar jika ada
            if ($this->upload->do_upload('cover')) {
                // Upload berhasil
                $upload_data = $this->upload->data();
                $cover_path = $upload_data['file_name'];

                // Data album
                $data = array(
                    'nama_album' => $this->input->post('nama_album'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'tgl_buat' => date('Y-m-d H:i:s'), // Tanggal dibuat diisi dengan waktu sekarang
                    'id_user' => $id_user, // Gunakan ID pengguna yang sedang login
                    'cover' => $cover_path // Menyimpan nama file gambar ke dalam kolom cover
                );

                $this->M_album->insertAlbum($data);

                // Redirect atau tampilkan pesan keberhasilan
                redirect('home');
            } else {
                // Upload gagal, tampilkan pesan error
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
                return;
            }
        } else {
            // Form validation failed or form not submitted

            // Load views
            $this->load->view('home/header');
            $this->load->view('home/upload_album');
        }
    }


    public function add_foto()
    {
        if ($this->input->post()) {
            if (!$this->session->userdata('role_id')) {
                redirect('login');
            }

            $config['upload_path'] = './fotos/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('lokasi_file')) {
                $upload_data = $this->upload->data();

                // Get id_user from session
                $id_user = $this->session->userdata('id_user');

                $data = array(
                    'judul_foto' => $this->input->post('judul_foto'),
                    'deskripsi_foto' => $this->input->post('deskripsi_foto'),
                    'tgl_unggah' => date('Y-m-d H:i:s'),
                    'lokasi_file' => $upload_data['file_name'],
                    'id_album' => $this->input->post('id_album'),
                    'id_user' => $id_user, // Set id_user from session
                );

                $this->M_foto->insertFoto($data);

                redirect('home'); // Redirect or show success message
            } else {
                $error = array('error' => $this->upload->display_errors());
                $data['albums'] = $this->M_album->getAlbums(); // Fetch albums for the view
                $this->load->view('home/header');
                $this->load->view('home/upload_album', $error);
            }
        } else {
            $data['albums'] = $this->M_album->getAlbums(); // Fetch albums for the view
            $this->load->view('home/header');
            $this->load->view('home/upload_album', $data);
        }
    }


    public function profil()
    {
        if (!$this->session->userdata('role_id')) {
            // Redirect to the login page or handle the case if the user is not logged in
            redirect('login');
        }
        $id_user = $this->session->userdata('id_user');
        $data['albums'] = $this->M_album->getIdalbumadnduser($id_user);
        $this->load->view('home/header');
        $this->load->view('home/profil', $data);
        $this->load->view('home/content-profil', $data);
    }
    public function profil_foto()
    {
        // Pastikan user sudah login dengan role_id tertentu
        if (!$this->session->userdata('role_id')) {
            // Redirect to the login page or handle the case if the user is not logged in
            redirect('login');
        }

        // Dapatkan id_user dari session
        $id_user = $this->session->userdata('id_user');

        // Load model M_album dan M_foto
        $this->load->model('M_foto');


        // Panggil fungsi getFotoByIdUser dari model M_foto
        $DATA['fotos'] = $this->M_foto->getFotoByIdUser($id_user);

        // Load view dengan data yang telah diambil
        $this->load->view('home/header');
        $this->load->view('home/profil', $DATA);
        $this->load->view('home/content-foto', $DATA);
    }
    public function profil_like()
    {
        // Pastikan user sudah login dengan role_id tertentu
        if (!$this->session->userdata('role_id')) {
            // Redirect to the login page or handle the case if the user is not logged in
            redirect('login');
        }

        // Dapatkan id_user dari session
        $id_user = $this->session->userdata('id_user');

        // Load model M_like
        $this->load->model('M_like');

        // Panggil fungsi getLikedPhotosByIdUser dari model M_like
        $liked_photos = $this->M_like->getLikedPhotosByIdUser($id_user);

        // Kirim data foto yang sudah di-like ke view
        $data['liked_photos'] = $liked_photos;

        // Load view dengan data yang telah diambil
        $this->load->view('home/header');
        $this->load->view('home/profil', $data);
        $this->load->view('home/content-like', $data);
    }




    // halamancari
    public function cari_foto()
    {
        $this->load->view('home/header');
        $this->load->view('home/fitur-cari');
    }


    public function editprofil($id_user)
    {
        // Periksa apakah id_user valid atau sesuai dengan pengguna yang sedang login
        if (!$id_user || $id_user != $this->session->userdata('id_user')) {
            // Redirect atau tampilkan pesan error jika id_user tidak valid
            redirect('home'); // Ganti dengan URL yang sesuai
        }
        // Load model
        $this->load->model('M_user');
        $data['user'] = $this->M_user->getUserById($id_user);
        $this->load->view('home/header');
        $this->load->view('home/content-edit-profil', $data);
    }
    public function update($id)
    {
        // Form submission logic for updating user
        if ($this->input->post()) {
            $config['upload_path'] = './users/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 1024;

            $this->load->library('upload', $config);

            // Check if the profil_image file is submitted
            if (!empty($_FILES['profil_image']['name'])) {
                if ($this->upload->do_upload('profil_image')) {
                    $upload_data = $this->upload->data();

                    // Delete the old image if it exists
                    $old_image_path = FCPATH . 'users/' . $this->input->post('old_profil_image');
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }

                    // Move the uploaded image to the user's profile directory with the original name
                    $profil_image = $upload_data['file_name'];
                    rename($upload_data['full_path'], FCPATH . 'users/' . $profil_image);
                } else {
                    // Jika upload gambar gagal, set pesan error dan kembali ke halaman edit profil
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('user/edit/' . $id);
                }
            }

            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),

            );



            // Update user data including the new profil_image if submitted
            $data['profil'] = isset($profil_image) ? $profil_image : $this->input->post('old_profil_image');
            $this->M_user->updateUser($id, $data);

            // Redirect or show success message
            redirect('home/editprofil/' . $id);
        } else {
            // Load the edit view if no form submission
            $data['user'] = $this->M_user->getUserById($id);

            if (!$data['user']) {
                // Handle if user is not found
                show_404();
            }

            $this->load->view('home/header');
            $this->load->view('home/content-edit-profil', $data);
        }
    }



    // private function updateProfil($id_user)
    // {
    //     // Load model
    //     $this->load->model('M_user');

    //     // Validasi form    
    //     $this->form_validation->set_rules('username', 'Username', 'required');
    //     $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

    //     // Ambil data pengguna dari model
    //     $user_data = $this->M_user->get_data_user($id_user);

    //     // Tentukan apakah kolom profil akan diubah atau tidak
    //     $upload_profil = $this->input->post('upload_profil');

    //     if ($this->form_validation->run() == FALSE) {
    //         // Validasi gagal, kembali ke halaman edit profil dengan pesan error
    //         $this->session->set_flashdata('error', validation_errors());
    //         redirect('home/editprofil/' . $id_user);
    //     } else {
    //         // Data yang akan diupdate
    //         $data = array(
    //             'username' => $this->input->post('username'),
    //             'email' => $this->input->post('email')
    //         );

    //         // Tentukan apakah kolom profil akan diubah atau tidak
    //         $upload_profil = $this->input->post('upload_profil');

    //         if ($upload_profil) {
    //             // Proses update profil dengan mengganti gambar profil
    //             $config['upload_path'] = './users/';
    //             $config['allowed_types'] = 'jpg|jpeg|png';
    //             $config['max_size'] = 1024;

    //             $this->load->library('upload', $config);

    //             // Jika file gambar diunggah
    //             if ($this->upload->do_upload('profil_image')) {
    //                 $upload_data = $this->upload->data();
    //                 $profil_image = $id_user . '_' . date('YmdHis') . $upload_data['file_ext']; // Buat nama file baru dengan format id_user_tgljam.ext

    //                 $new_image_path = FCPATH . 'users/' . $profil_image;

    //                 // Delete the old image if it exists
    //                 $old_image_path = FCPATH . 'users/' . $user_data->profil;
    //                 if (file_exists($old_image_path)) {
    //                     unlink($old_image_path);
    //                 }

    //                 // Move the uploaded image to the user's profile directory with the new name
    //                 rename($upload_data['full_path'], $new_image_path);

    //                 // Tambahkan kolom profil ke data yang akan diupdate
    //                 $data['profil'] = $profil_image;
    //             } else {
    //                 // Jika upload gambar gagal, set pesan error dan kembali ke halaman edit profil
    //                 $this->session->set_flashdata('error', $this->upload->display_errors());
    //                 redirect('home/editprofil/' . $id_user);
    //             }
    //         }

    //         // Update data user hanya jika ada perubahan pada username atau email atau profil
    //         if (
    //             $data['username'] !== $user_data->username ||
    //             $data['email'] !== $user_data->email ||
    //             isset($data['profil'])
    //         ) {
    //             // Update data user
    //             $this->M_user->updateUserProfile($id_user, $data);

    //             // Set pesan berhasil dan kembali ke halaman edit profil
    //             $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
    //             redirect('home/editprofil/' . $id_user);
    //         } else {
    //             // Tidak ada perubahan, kembali ke halaman edit profil
    //             redirect('home/editprofil/' . $id_user);
    //         }
    //     }
    // }




    public function edit_album()
    {
        $this->load->view('home/header');
        $this->load->view('home/content-edit-profil_album');
    }
    public function edit_foto()
    {
        $this->load->view('home/header');
        $this->load->view('home/content-edit-profil_foto');
    }
}
