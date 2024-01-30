<!-- Content -->
<div class="content">
    <div class="content-wrapper">
        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Edit Komentar</h1>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <!-- Form Start -->
                    <?php echo form_open('komentar/update/' . $komentar->id_komen, 'class="komentar-form"'); ?>
                    <div class="form-group">
                        <label for="id_foto">ID Foto</label>
                        <input type="text" class="form-control" id="id_foto" name="id_foto" value="<?php echo $komentar->id_foto; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $komentar->id_user; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="isi_komentar">Isi Komentar</label>
                        <textarea class="form-control" id="isi_komentar" name="isi_komentar" required><?php echo $komentar->isi_komentar; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <?php echo form_close(); ?>
                    <!-- Form End -->
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
    <style>
        .content-wrapper {
            margin: 20px;
        }

        .breadcrumb {
            background-color: #fff;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .komentar-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>

    </body>

    </html>