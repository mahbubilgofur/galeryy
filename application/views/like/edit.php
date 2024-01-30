<div class="content">
    <div class="content-wrapper">
        <div class="container-fluid">

            <!-- Page Content -->
            <h1>Edit Like</h1>
            <hr>

            <div class="row">
                <div class="col-md-6">
                    <!-- Form Start -->
                    <?php echo form_open('like/update/' . $like->id_like, 'class="like-form"'); ?>
                    <div class="form-group">
                        <label for="id_foto">ID Foto</label>
                        <input type="text" class="form-control" id="id_foto" name="id_foto" value="<?php echo $like->id_foto; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_user">ID User</label>
                        <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $like->id_user; ?>" required>
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

    <!-- Styles -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }

        .content-wrapper {
            margin: 20px;
        }

        .breadcrumb {
            background-color: #fff;
        }

        .like-form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        button {
            cursor: pointer;
        }
    </style>
</div>
</body>

</html>