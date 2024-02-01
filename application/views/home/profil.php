<div class="profil-cnt">
    <div class="top-profil">
        <?php
        // Ambil data pengguna dari sesi
        $user_id = $this->session->userdata('id_user');
        $user_data = $this->db->get_where('tbl_user', ['id_user' => $user_id])->row_array();

        // Tampilkan kolom profil sesuai dengan nama file gambar
        $profil_image = base_url('users/' . $user_data['profil']);
        ?>
        <div class="top1">
            <img src="<?= $profil_image ?>" alt="Profile Image">
        </div>
        <!-- // -->
        <div class="top2">
            <h1><?php echo $this->session->userdata('username'); ?></h1>
        </div>
        <div class="top3">
            <h5><?php echo $this->session->userdata('email'); ?></h5>
        </div>


    </div>