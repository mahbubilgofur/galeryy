<div class="content">
    <div class="cnt-awl">
        <?php foreach ($albums as $album) : ?>
            <a href="<?= base_url('home/foto/' . $album->id_album) ?>">
                <div class="album">
                    <div class="t">
                        <img src="<?= base_url() ?>albums/<?php echo $album->cover; ?>" alt="">
                    </div>
                    <div class="b">
                        <h1><?php echo $album->nama_album; ?></h1>
                        <!-- <p><?php echo $album->deskripsi; ?></p> -->
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="content-album-fotos">
        <?php foreach ($fotos as $foto) : ?>
            <div class="foto-cont">
                <img src="<?= base_url() ?>fotos/<?php echo $foto->lokasi_file; ?>" alt="">
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>

</html>

</body>

</html>