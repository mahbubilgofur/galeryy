<div class="mid-profil">
    <a href="<?= base_url('home/profil') ?>" class="albummm">Album</a>
    <a href="<?= base_url('home/profil_foto') ?>">Foto</a>
    <a href="<?= base_url('home/profil_like') ?>">Like</a>
</div>
<div class="bottom-profil">
    <?php foreach ($albums as $album) : ?>
        <div class="album-profil">
            <div class="top-prl">
                <h1><?php echo $album->nama_album; ?></h1>
            </div>
            <div class="bottom-prl">
                <h5><?php echo $album->tgl_buat; ?></h5>
            </div>
        </div>
    <?php endforeach; ?>

</div>
</div>
</body>

</html>

</body>

</html>