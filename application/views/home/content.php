<div class="content">
    <div class="cnt">
        <?php foreach ($albums as $album) : ?>
            <a href="<?= base_url('home/foto/' . $album->id_album) ?>">
                <div class="album">
                    <div class="t">
                        <h1><?php echo $album->nama_album; ?></h1>
                    </div>
                    <div class="b">
                        <p><?php echo $album->tgl_buat; ?></p>
                        <!-- <p><?php echo $album->deskripsi; ?></p> -->
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
</body>

</html>

</body>

</html>