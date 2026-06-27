<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php if($artikel): foreach($artikel as $row): ?>
    <h2><?= $row['judul']; ?></h2>
    <p>Kategori: <?= $row['nama_kategori']; ?></p>
    <p><?= substr($row['isi'], 0, 200); ?></p>
<?php endforeach; else: ?>
    <h2>Belum ada data</h2>
<?php endif; ?>

<?= $this->endSection() ?>