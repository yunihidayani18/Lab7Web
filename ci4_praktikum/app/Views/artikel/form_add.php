<?= $this->include('template/header'); ?>

<h2><?= $title; ?></h2>

<form action="<?= base_url('/admin/artikel/add'); ?>" method="post" enctype="multipart/form-data">

    <p>
        <input type="text"
               name="judul"
               placeholder="Judul Artikel">
    </p>

    <p>
        <textarea name="isi"
                  cols="50"
                  rows="10"
                  placeholder="Isi Artikel"></textarea>
    </p>

    <p>
        <select name="status">
            <option value="0">Draft</option>
            <option value="1">Publish</option>
        </select>
    </p>

    <p>
        <select name="id_kategori">

            <?php foreach ($kategori as $k): ?>

                <option value="<?= $k['id_kategori']; ?>">
                    <?= $k['nama_kategori']; ?>
                </option>

            <?php endforeach; ?>

        </select>
    </p>
<p>
    <input type="file" name="gambar">
</p>
    <p>
        <input type="submit" value="Kirim">
    </p>

</form>

<?= $this->include('template/footer'); ?>