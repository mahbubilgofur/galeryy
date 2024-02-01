<div class="edit-profil-cnt">
    <div class="sidbar-profil">
        <!-- Isi sidebar di sini -->
        <a href="<?= base_url('home/editprofil') ?>">Edit Profil</a>
        <a href="<?= base_url('home/edit_album') ?>">Edit Album</a>
        <a href="<?= base_url('home/edit_foto') ?>">Edit Foto</a>
    </div>
    <div class="content-profil-cnt">
        <div class="cnt-profil-kanan">
            <div class="top-profil-cnt">
                <p>Edit Profil</p>
            </div>
            <?php echo form_open_multipart('home/update/' . $user->id_user, 'class="user-form"'); ?>
            <div class="mid-profil-cnt">
                <input type="file" class="form-control" id="profil_image" name="profil_image" accept="image/*">
                <?php if (!empty($user->profil)) : ?>
                    <div class="mt-2">
                        <img src="<?php echo base_url('users/' . $user->profil); ?>" alt="Profil Image" class="img-thumbnail" style="max-width: 200px;">
                    </div>
                <?php endif; ?>
                <input type="hidden" name="old_profil_image" value="<?php echo $user->profil; ?>">
            </div>

            <div class="bottom-profil-cnt">
                <div class="input-form-cnt">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user->username; ?>" required>
                </div>

                <div class="input-form-cnt">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="email" value="<?= set_value('email', $user->email); ?>">
                    <?php echo form_error('email'); ?>
                </div>

                <div class="simpan-profil">
                    <input type="submit" name="simpan_profil" value="Simpan">
                </div>
            </div>

            <?php echo form_close(); ?>


        </div>
    </div>
</div>
</body>

</html>