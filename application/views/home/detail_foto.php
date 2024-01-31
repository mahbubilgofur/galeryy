<div class="c-content">
    <div class="isi_cnt">
        <div class="left-content">
            <img src="<?= base_url() ?>fotos/<?php echo $foto->lokasi_file; ?>" alt="">
        </div>
        <div class="bottom-content">
            <div class="top-c">
                <div class="top-cc">
                    <p>mahbubgofur123</p>
                </div>
                <div class="top-ccc">
                    <?php echo $foto->deskripsi_foto; ?>
                </div>
            </div>
            <div class="bottom-mid">
                <!-- Tampilan untuk Tombol Like -->
                <?php if ($role_id == 1 || $role_id == 2) : ?>
                    <?php if ($is_liked) : ?>
                        <a href="<?= base_url('home/remove_like/' . $fotos['id_foto']); ?>">💖 Unlike</a>
                    <?php else : ?>
                        <a href="<?= base_url('home/add_like/' . $fotos['id_foto']); ?>">🤍 Like</a>
                    <?php endif; ?>
                <?php else : ?>
                    <a href="<?= base_url('login') ?>">
                        <p>🤍</p>
                    </a>
                <?php endif; ?>
                <p>💬</p>
            </div>
            <div class="bottom-c">
                <?php foreach ($komentars as $komentar) : ?>
                    <div class="komen-user">
                        <div class="komen-user1">
                            <h4><?= $komentar['username'] ?></h4>
                        </div>
                        <div class="komen-user2">
                            <p><?= $komentar['isi_komentar'] ?></p>
                        </div>
                        <div class="tgl-komen">
                            <p><?= $komentar['tgl_komentar'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <form action="<?= base_url('home/add_komentar') ?>" method="post">
                <div class="bottom-m">
                    <input type="hidden" name="id_foto" value="<?= $fotos['id_foto'] ?>">
                    <input type="text" name="isi_komentar" id="" placeholder="Komentar.....">
                    <a type="submit">=></a>
                </div>
            </form>
        </div>
    </div>
</div>


</body>

</html>