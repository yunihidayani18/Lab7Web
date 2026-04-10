<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2><?= $title; ?></h2>

<form action="" method="post">
    <p>
        <input type="text" name="judul" placeholder="Judul">
    </p>
    <p>
        <textarea name="isi" placeholder="Isi artikel"></textarea>
    </p>
    <p>
        <button type="submit">Simpan</button>
    </p>
</form>

<?= $this->endSection() ?>