<div class="content">
    <div class="cnt">
        <?php if (empty($photos)) : ?>
            <p>Tidak Ada Foto Yang Di Upload</p>
        <?php else : ?>
            <?php foreach ($photos as $photo) : ?>
                <a href="<?= base_url() ?>home/detail_foto/<?php echo $photo->id_foto; ?>">
                    <div class="foto">
                        <div class="t-t">
                            <img src="<?= base_url() ?>fotos/<?php echo $photo->lokasi_file; ?>" alt="">
                            <!-- <p><?php echo $photo->lokasi_file; ?></p> -->
                        </div>
                        <div class="b-b">
                            <p><?php echo $photo->judul_foto; ?></p>
                            <p><?php echo $photo->tgl_unggah; ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
</body>

</html>