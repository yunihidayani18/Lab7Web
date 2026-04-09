Praktikum 1 - PHP Framework CodeIgniter 4

* Nama: Yuni Hidayani
* NIM: 311910078
* Kelas: 1243B

Instalasi CodeIgniter 4

1. Mengunduh CodeIgniter dari website resmi
2. Mengekstrak file ke folder:

   ```
   htdocs/lab11_ci/ci4
   ```
3. Menjalankan project di browser:

   ```
   http://localhost:8080
   ```

Menjalankan Server

Server dijalankan menggunakan perintah berikut:

```
php spark serve
```

---
Konfigurasi Routing

Routing digunakan untuk mengatur URL pada aplikasi.

File: `app/Config/Routes.php`

```php
$routes->get('/', 'Home::index');
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');
$routes->get('/page/tos', 'Page::tos');
```

Pembuatan Controller

Controller digunakan untuk mengatur logika aplikasi.

File: `app/Controllers/Page.php`

```php
public function about()
{
    return view('about', [
        'title' => 'About',
        'content' => 'Ini halaman About'
    ]);
}
```

-Pembuatan View

View digunakan untuk menampilkan halaman web.

Contoh: `app/Views/about.php`

```php
<?= $this->include('template/header'); ?>

<h1><?= $title; ?></h1>
<p><?= $content; ?></p>

<?= $this->include('template/footer'); ?>
```

-Pembuatan Template

Template digunakan agar tampilan konsisten di semua halaman.

# Header (`header.php`)

```php
<link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
```

# Footer (`footer.php`)

```php
<footer>
    <p>© 2026 - Praktikum Web</p>
</footer>
```

-Pembuatan CSS

File CSS digunakan untuk memperindah tampilan.

Lokasi: `public/style.css`

```css
body {
    font-family: Arial;
    background: #f4f4f4;
}
```

---Hasil Tampilan

Halaman yang berhasil dibuat:

* Halaman About
* Halaman Contact
* Halaman FAQ
* Halaman Terms of Services

Kesimpulan

* CodeIgniter 4 menggunakan konsep MVC
* Controller mengatur logika aplikasi
* View mengatur tampilan
* Template membuat tampilan konsisten
* CSS memperindah tampilan web

Link Repository :
https://github.com/username/Lab7Web



# Laporan Praktikum Web 2 – CodeIgniter 4 (CRUD Artikel)

## Deskripsi Praktikum

Pada praktikum ini dilakukan pembuatan aplikasi web sederhana menggunakan framework **CodeIgniter 4** dengan fitur **CRUD (Create, Read, Update, Delete)** pada data artikel.

## Langkah-Langkah Praktikum

### 1. Membuat Database

Membuat database dengan nama `lab_ci4` dan tabel `artikel` dengan field:

* id
* judul
* isi
* slug
* status

---

### 2. Membuat Model

File: `ArtikelModel.php`

Digunakan untuk mengelola data artikel dari database.

---

### 3. Membuat Controller

File: `Artikel.php`

Controller berisi beberapa method:

* `index()` → menampilkan daftar artikel
* `view()` → menampilkan detail artikel
* `admin_index()` → halaman admin
* `add()` → tambah artikel
* `edit()` → edit artikel
* `delete()` → hapus artikel

---

### 4. Membuat View

# Halaman utama
Menampilkan daftar artikel

# Halaman detail
Menampilkan isi artikel berdasarkan slug

# Halaman admin
Menampilkan data artikel dalam bentuk tabel

# Form tambah
Digunakan untuk input artikel baru

# Form edit
Digunakan untuk mengubah data artikel

### 5. Routing

Menambahkan routing di `Routes.php`:

```php
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:segment)', 'Artikel::view/$1');

$routes->get('/admin/artikel', 'Artikel::admin_index');
$routes->add('/admin/artikel/add', 'Artikel::add');
$routes->add('/admin/artikel/edit/(:num)', 'Artikel::edit/$1');
$routes->get('/admin/artikel/delete/(:num)', 'Artikel::delete/$1');
```

---

## Implementasi CRUD

###  Create (Tambah Data)
Menambahkan artikel melalui form `form_add.php`

###  Read (Tampil Data)
Menampilkan artikel di:

* halaman utama
* halaman admin

###  Update (Edit Data)
Mengubah data artikel melalui `form_edit.php`

###  Delete (Hapus Data)
Menghapus artikel dari database

##***  Tampilan

Aplikasi menggunakan file CSS (`style.css`) yang disimpan di folder `public` untuk memperindah tampilan.

##  Kesimpulan

Pada praktikum ini berhasil dibuat aplikasi CRUD sederhana menggunakan CodeIgniter 4.
Mahasiswa memahami konsep MVC (Model, View, Controller) serta routing dan integrasi database.



