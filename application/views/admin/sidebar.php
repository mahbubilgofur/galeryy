<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="<?= base_url() ?>css/admin.css">
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h1>Admin</h1>
            <a href="<?= base_url('admin') ?>">Dashboard</a>
            <a href="<?= base_url('album') ?>">Album</a>
            <a href="<?= base_url('foto') ?>">Foto</a>
            <a href="<?= base_url('user') ?>">User</a>
            <a href="<?= base_url('komentar') ?>">Komentar</a>
            <a href="<?= base_url('like') ?>">Like</a>
            <a href="<?= base_url('login/logout') ?>">Logout</a>
        </div>