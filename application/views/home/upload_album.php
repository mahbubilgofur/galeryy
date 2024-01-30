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
        background-color: black;
        flex-direction: column;
        width: 200px;
        height: 300px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .upload_albb {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background-color: black;
        width: 100%;
        height: 100%;
    }

    h2 {
        color: #333;
    }

    label {
        color: white;
        margin-bottom: 5px;
        align-self: flex-start;
    }

    .form-input {
        width: 100%;
        height: 30px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border-radius: 4px;
        margin-left: 30px;
    }

    .textarea-input {
        width: 100%;
        height: 60px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border-radius: 4px;
        margin-left: 30px;
    }

    .submit-btn {
        background-color: #4caf50;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .submit-btn:hover {
        background-color: #45a049;
    }
</style>
<div class="upload_alb">
    <div class="upload_alb-b">
        <h2>Add Album</h2>
        <?php echo validation_errors(); ?>
        <?php echo form_open('home/add_album'); ?>
        <div class="upload_albb">
            <label for="nama_album">Nama Album:</label>
            <input type="text" name="nama_album" class="form-input" value="<?php echo set_value('nama_album'); ?>" />
            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" class="textarea-input"><?php echo set_value('deskripsi'); ?></textarea>
            <input type="submit" value="Submit" class="submit-btn" />
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</body>

</html>