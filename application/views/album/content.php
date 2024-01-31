<!-- Content -->
<div class="content">
    <h2>Table Content</h2>
    <a href="<?= base_url('album/add') ?>"><button>Tambah Album</button></a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Album</th>
                <th>Deskripsi</th>
                <th>Tanggal Dibuat</th>
                <th>ID User</th>
                <th>Cover</th> <!-- Tambahkan kolom Cover di sini -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($albums as $album) { ?>
                <tr>
                    <td><?php echo $album->id_album; ?></td>
                    <td><?php echo $album->nama_album; ?></td>
                    <td><?php echo $album->deskripsi; ?></td>
                    <td><?php echo $album->tgl_buat; ?></td>
                    <td><?php echo $album->id_user; ?></td>
                    <td>
                        <?php if (!empty($album->cover)) { ?>
                            <img src="<?= base_url('albums/' . $album->cover); ?>" alt="Cover" width="50" height="50">
                        <?php } else { ?>
                            No Cover
                        <?php } ?>
                    </td>
                    <td>
                        <!-- Tambahkan tombol Edit dan Delete dengan link ke fungsi di controller -->
                        <a href="<?php echo base_url('album/edit/' . $album->id_album); ?>" class="btn btn-warning">Edit</a>
                        <a href="<?php echo base_url('album/delete/' . $album->id_album); ?>" class="btn btn-danger" onclick="return confirm('yakin mau hapus?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>

</html>