<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1><?= $artikel['judul']; ?></h1>
<p><?= $artikel['isi']; ?></p>

<?= $this->endSection() ?>