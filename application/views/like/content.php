<!-- Content -->
<div class="content">
    <h2>Table Content</h2>
    <a href="<?= base_url('like/add') ?>"><button>Tambah Like</button></a>
    <table>
        <thead>
            <tr>
                <th>ID Like</th>
                <th>ID Foto</th>
                <th>ID User</th>
                <th>Tanggal Like</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($likes as $like) { ?>
                <tr>
                    <td><?php echo $like->id_like; ?></td>
                    <td><?php echo $like->id_foto; ?></td>
                    <td><?php echo $like->id_user; ?></td>
                    <td><?php echo $like->tgl_like; ?></td>
                    <td>
                        <!-- Tambahkan tombol Edit dan Delete dengan link ke fungsi di controller -->
                        <a href="<?php echo base_url('like/edit/' . $like->id_like); ?>" class="btn btn-warning">Edit</a>
                        <a href="<?php echo base_url('like/delete/' . $like->id_like); ?>" class="btn btn-danger" onclick="return confirm('Yakin mau hapus?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>

</html>