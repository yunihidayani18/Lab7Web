<?= $this->include('template/admin_header'); ?>
<h2><?= $title; ?></h2>
<form action="<?= base_url('/admin/artikel/update'); ?>" method="post">

    <input type="hidden"
           name="id"
           value="<?= $artikel['id']; ?>">

    <p>
        <input type="text"
               name="judul"
               value="<?= $artikel['judul']; ?>">
    </p>

    <p>
        <textarea name="isi"
                  cols="50"
                  rows="10"><?= $artikel['isi']; ?></textarea>
    </p>
<p>
    <select name="id_kategori">

        <?php foreach ($kategori as $k): ?>

            <option value="<?= $k['id_kategori']; ?>"
                <?= ($k['id_kategori'] == $artikel['id_kategori']) ? 'selected' : ''; ?>>

                <?= $k['nama_kategori']; ?>

            </option>

        <?php endforeach; ?>

    </select>
</p>
    <p>
        <input type="submit"
               value="Simpan"
               class="btn btn-large">
    </p>

</form>
<?= $this->include('template/admin_footer'); ?>