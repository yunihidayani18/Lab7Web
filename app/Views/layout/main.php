<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?? 'Web'; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>
<body>

<div id="container">

<header>
    <h1>Layout Sederhana</h1>
</header>

<nav>
    <a href="<?= base_url('/') ?>">Home</a>
    <a href="<?= base_url('/artikel') ?>">Artikel</a>
    <a href="<?= base_url('/about') ?>">About</a>
    <a href="<?= base_url('/contact') ?>">Kontak</a>
</nav>

<section style="display:flex; gap:20px;">

    <div style="flex:3;">
        <?= $this->renderSection('content') ?>
    </div>

    <aside id="sidebar" style="flex:1;">
        <?= view_cell('App\\Cells\\ArtikelTerkini::render') ?>
    </aside>

</section>

<footer>
    <p>&copy; 2021 - Universitas Pelita Bangsa</p>
</footer>

</div>

</body>
</html>