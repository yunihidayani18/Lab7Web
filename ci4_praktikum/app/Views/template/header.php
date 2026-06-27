<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand" href="#">Admin Portal Berita</a>

        <div class="navbar-nav">
              <a class="nav-link text-white"
                 href="<?= base_url('/admin/artikel'); ?>">
                  Dashboard
              </a>
            <a class="nav-link text-white"
               href="<?= base_url('/admin/artikel'); ?>">
               Artikel
            </a>

            <a class="nav-link text-white"
               href="<?= base_url('/admin/artikel/add'); ?>">
               Tambah Artikel
            </a>
        </div>

    </div>
</nav>

<div class="container mt-4">