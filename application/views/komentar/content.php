<!-- Content -->
<div class="content">
    <h2>Table Content</h2>
    <a href="<?= base_url('komentar/add') ?>"><button>Tambah Komentar</button></a>
    <table>
        <thead>
            <tr>
                <th>ID Komentar</th>
                <th>ID Foto</th>
                <th>ID User</th>
                <th>Isi Komentar</th>
                <th>Tanggal Komentar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($komentars as $komentar) { ?>
                <tr>
                    <td><?php echo $komentar->id_komen; ?></td>
                    <td><?php echo $komentar->id_foto; ?></td>
                    <td><?php echo $komentar->id_user; ?></td>
                    <td><?php echo $komentar->isi_komentar; ?></td>
                    <td><?php echo $komentar->tgl_komentar; ?></td>
                    <td>
                        <!-- Tambahkan tombol Edit dan Delete dengan link ke fungsi di controller -->
                        <a href="<?php echo base_url('komentar/edit/' . $komentar->id_komen); ?>" class="btn btn-warning">Edit</a>
                        <a href="<?php echo base_url('komentar/delete/' . $komentar->id_komen); ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>

</html>