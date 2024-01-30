<div class="c-content">
    <div class="isi_cnt">
        <div class="left-content">
            <img src="<?= base_url() ?>fotos/<?php echo $foto->lokasi_file; ?>" alt="">
        </div>
        <div class="bottom-content">
            <div class="top-c">
                <div class="top-cc">
                    <p>mahbubgofur123</p>
                </div>
                <div class="top-ccc">
                    <?php echo $foto->deskripsi_foto; ?>
                </div>
            </div>
            <div class="bottom-mid">
                <!-- <button class="like-btn" data-id-foto="1">🤍</button> -->
                <button class="like-btn" data-id-foto="1">🤍 <span class="like-count">0</span></button>
                <p>💬0</p>
            </div>
            <div class="bottom-c">

            </div>
            <form action="">
                <div class="bottom-m">
                    <input type="text" name="" id="" placeholder="Komentar.....">
                    <a href="<?= base_url('#') ?>">=></a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Modifikasi script jQuery -->
<script>
    $(document).ready(function() {
        // Mendapatkan status like saat halaman dimuat
        var id_foto = $('.like-btn').data('id-foto');

        // Memeriksa role_id sebelum melakukan like
        $.ajax({
            type: 'POST',
            url: '<?= base_url('home/check_role'); ?>',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'authenticated') {
                    // Role_id sudah sesuai, lanjutkan dengan mendapatkan status like
                    getStatusLike(id_foto);
                } else {
                    // Belum login atau role_id tidak sesuai, tidak perlu mendapatkan status like
                }
            }
        });

        // Fungsi mendapatkan status like
        function getStatusLike(id_foto) {
            $.ajax({
                type: 'POST',
                url: '<?= base_url('home/get_status_like'); ?>', // Tambahkan metode untuk mendapatkan status like di controller
                data: {
                    id_foto: id_foto
                },
                dataType: 'json',
                success: function(response) {
                    // Atur tampilan tombol "like" berdasarkan status like yang didapatkan
                    if (response.status === 'liked') {
                        $('.like-btn[data-id-foto="' + id_foto + '"]').html('💖');
                    } else {
                        $('.like-btn[data-id-foto="' + id_foto + '"]').html('🤍');
                    }
                }
            });
        }

        // Fungsi likePhoto ditempatkan di luar fungsi .ready
        function likePhoto(id_foto) {
            // Melakukan like jika role_id sudah sesuai
            $.ajax({
                type: 'POST',
                url: '<?= base_url('home/like'); ?>',
                data: {
                    id_foto: id_foto
                },
                dataType: 'json',
                success: function(response) {
                    // Atur tampilan tombol "like" berdasarkan respons dari server
                    if (response.status === 'liked') {
                        $('.like-btn[data-id-foto="' + id_foto + '"]').html('💖');
                    } else {
                        $('.like-btn[data-id-foto="' + id_foto + '"]').html('🤍');
                    }
                }
            });
        }

        // Mendapatkan status like saat halaman dimuat
        getStatusLike(id_foto);

        // Menambahkan event click untuk tombol "like"
        $('.like-btn').on('click', function() {
            var id_foto = $(this).data('id-foto');

            // Memeriksa role_id sebelum melakukan like
            $.ajax({
                type: 'POST',
                url: '<?= base_url('home/check_role'); ?>',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'authenticated') {
                        // Role_id sudah sesuai, lanjutkan dengan fungsi like
                        likePhoto(id_foto);
                    } else {
                        // Belum login atau role_id tidak sesuai, arahkan ke /login
                        window.location.href = '<?= base_url('login'); ?>';
                    }
                }
            });
        });
    });
</script>



</body>

</html>