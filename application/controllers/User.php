<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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

        $this->load->model('M_user');
    }
    public function index()
    {
        $user = $this->M_user->getuser();
        $DATA = array('data_user' => $user);

        $this->load->view('admin/sidebar');
        $this->load->view('user/content', $DATA);
    }

    public function add()
    {
        $this->load->view('admin/sidebar');
        $this->load->view('user/add');
    }
    public function add_user()
    {
        // Form submission logic for creating user
        if ($this->input->post()) {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => $this->input->post('email'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'alamat' => $this->input->post('alamat'),
                'role_id' => 2,
            );

            $this->M_user->insert_user($data);

            // Redirect or show success message
            redirect('user');
        } else {
            $this->load->view('admin/sidebar');
            $this->load->view('user/add');
        }
    }

    public function edit($id)
    {
        $data['user'] = $this->M_user->getUserById($id);
        $this->load->view('admin/sidebar');
        $this->load->view('user/edit', $data);
    }
    public function update($id)
    {
        // Form submission logic for updating user
        if ($this->input->post()) {
            $data = array(
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'email' => $this->input->post('email'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'alamat' => $this->input->post('alamat'),
                'role_id' => $this->input->post('role_id'),
            );

            $this->M_user->updateUser($id, $data);

            // Redirect or show success message
            redirect('user');
        } else {
            // Load the edit view if no form submission
            $data['user'] = $this->M_user->getUserById($id);

            if (!$data['user']) {
                // Handle if user is not found
                show_404();
            }

            $this->load->view('admin/sidebar');
            $this->load->view('user/edit', $data);
        }
    }

    public function delete($id)
    {
        // Logic for deleting user
        $this->M_user->deleteUser($id);

        // Redirect or show success message
        redirect('user');
    }
}
