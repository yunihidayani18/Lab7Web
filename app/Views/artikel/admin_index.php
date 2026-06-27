<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2><?= $title; ?></h2>

<table border="1">
<tr>
    <th>ID</th>
    <th>Judul</th>
    <th>Status</th>
</tr>

<?php foreach ($artikel as $row): ?>
<tr>
    <td><?= $row['id']; ?></td>
    <td><?= $row['judul']; ?></td>
    <td><?= $row['status']; ?></td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>