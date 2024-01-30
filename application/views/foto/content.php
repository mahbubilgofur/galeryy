<!-- Content -->
<div class="content">
    <h2>Table Content</h2>
    <a href="<?= base_url('foto/add') ?>"><button>Tambah Foto</button></a>
    <table>
        <thead>
            <tr>
                <th>ID Foto</th>
                <th>Judul Foto</th>
                <th>Deskripsi Foto</th>
                <th>Tanggal Unggah</th>
                <th>ID Album</th>
                <th>ID User</th>
                <th>Lokasi File</th>
                <th>Preview</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fotos as $foto) { ?>
                <tr>
                    <td><?php echo $foto->id_foto; ?></td>
                    <td><?php echo $foto->judul_foto; ?></td>
                    <td><?php echo $foto->deskripsi_foto; ?></td>
                    <td><?php echo $foto->tgl_unggah; ?></td>
                    <td><?php echo $foto->id_album; ?></td>
                    <td><?php echo $foto->id_user; ?></td>
                    <td><?php echo $foto->lokasi_file; ?></td>
                    <td>
                        <img src="<?= base_url('fotos/' . $foto->lokasi_file); ?>" alt="Preview" width="100">
                    </td>
                    <td>
                        <!-- Tambahkan tombol Edit dan Delete dengan link ke fungsi di controller -->
                        <a href="<?php echo base_url('foto/edit/' . $foto->id_foto); ?>" class="btn btn-warning">Edit</a>
                        <a href="<?php echo base_url('foto/delete/' . $foto->id_foto); ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>

</html>