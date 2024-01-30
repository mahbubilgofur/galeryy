<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="<?= base_url() ?>css/home.css">
</head>

<body>
    <header>
        <div class="logo">
            <h1>Gallery</h1>
        </div>
        <div class="mid-h">
            <form action="">
                <div class="cari">
                    <input type="text" placeholder="Cari.......">
                </div>
            </form>
        </div>
        <div class="navigation">
            <a href="<?= base_url('/') ?>"><img src="<?= base_url('img/home.png') ?>" alt=""></a>
            <?php if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 2) : ?>
                <a href="<?= base_url() ?>home/upload"><img src="<?= base_url('img/upload.png') ?>" alt=""></a>
                <span><?php echo $this->session->userdata('username'); ?></span>
                <a href="<?= base_url() ?>login/logout"><img src="<?= base_url('img/logout.png') ?>" alt=""></a>
            <?php else : ?>
                <a href="<?= base_url() ?>login"><img src="<?= base_url('img/profil.png') ?>" alt=""></a>
            <?php endif; ?>
        </div>
    </header>