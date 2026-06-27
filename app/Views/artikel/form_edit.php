<!DOCTYPE html>
<html>
<head>
    <title>Edit Artikel</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>

<div id="container">

<header>
    <h1>Edit Artikel</h1>
</header>

<section>
    <form action="/admin/artikel/update" method="post">
        <input type="hidden" name="id" value="<?= $artikel['id']; ?>">

        <p>
            <input type="text" name="judul" value="<?= $artikel['judul']; ?>">
        </p>

        <p>
            <textarea name="isi"><?= $artikel['isi']; ?></textarea>
        </p>

        <p>
            <button type="submit">Update</button>
        </p>
    </form>
</section>

</div>

</body>
</html>