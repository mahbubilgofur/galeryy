<!-- Content -->
<div class="content">
    <h2>Table Content</h2>
    <a href="<?= base_url('user/add') ?>"><button>tambah</button></a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_user as $row) { ?>
                <tr>
                    <td><?php echo $row->id_user; ?></td>
                    <td><?php echo $row->username; ?></td>
                    <td><?php echo $row->password; ?></td>
                    <td><?php echo $row->email; ?></td>
                    <td><?php echo $row->nama_lengkap; ?></td>
                    <td><?php echo $row->alamat; ?></td>
                    <td><?php echo $row->role_id; ?></td>
                    <td>
                        <!-- Tambahkan tombol Edit dan Delete dengan link ke fungsi di controller -->
                        <a href="<?php echo base_url('user/edit/' . $row->id_user); ?>" class="btn btn-warning">Edit</a>
                        <a href="<?php echo base_url('user/delete/' . $row->id_user); ?>" class="btn btn-danger" onclick="return confirm('yakin mau hapus?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </tbody>
    </table>
</div>
</div>

</body>

</html>