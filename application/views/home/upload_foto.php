<style>
    .upload_alb {
        width: 100%;
        height: 100vh;
        background-color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .upload_alb-b {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.218);
        flex-direction: column;
        width: 500px;
        height: 400px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .upload_albb {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    .type {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
    }

    p {
        font-size: 13px;
    }

    .atr {
        margin-left: 40px;
        display: flex;
        width: 100%;
        justify-content: space-between;
    }

    .kml-alb {
        background-color: black;
        color: rgb(0, 155, 155);
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .kml-alb:hover {
        background-color: rgb(0, 155, 155);
        transition: all 0.9s;
        color: black;
    }

    h2 {
        color: #333;
    }

    label {
        color: rgb(0, 155, 155);
        margin-bottom: 5px;
        align-self: flex-start;
        margin-left: 20px;
    }

    .form-input {
        width: 100%;
        height: 30px;
        margin-bottom: 15px;
        border-radius: 4px;
        margin-left: 40px;
        border: 1px black;
    }

    .textarea-input {
        border: 1px black;
        width: 100%;
        height: 60px;
        margin-bottom: 15px;
        border-radius: 4px;
        margin-left: 40px;
    }

    .submit-btn {
        background-color: black;
        color: rgb(0, 155, 155);
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: rgb(0, 155, 155);
        transition: all 0.9s;
        color: black;
    }
</style>
<div class="upload_alb">
    <div class="upload_alb-b">
        <h2>Add Foto</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('home/add_foto'); ?>
        <div class="upload_albb">
            <label for="judul_foto">Nama Album:</label>
            <input type="text" name="judul_foto" class="form-input" required />
            <label for="id_labum">Pilih Nama Album :</label>
            <select name="id_album" class="form-input" required>
                <?php foreach ($data_album as $album) : ?>
                    <option value="<?php echo $album->id_album; ?>"><?php echo $album->nama_album; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="deskripsi_foto">Deskripsi:</label>
            <textarea name="deskripsi_foto" class="textarea-input" required><?php echo set_value('deskripsi_foto'); ?></textarea>
            <label for="lokasi_file">Upload Foto:</label>
            <div class="type">
                <input type="file" name="lokasi_file" class="form-input" required />
                <p>Maksimal Ukuran 1 MB</p>
            </div>
            <div class="atr">
                <a href="<?= base_url('home/upload') ?>">
                    <div class="kml-alb">Kembali</div>
                </a>
                <input type="submit" value="Simpan" class="submit-btn" />
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</body>

</html>