* Nama: Yuni Hidayani
* NIM: 311910078
* Kelas: 1243B

Praktikum 1 - PHP Framework CodeIgniter 4

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

#  Praktikum 3 - View Layout & View Cell (CodeIgniter 4)

JAWABAN DARI PERTANYAAN DAN TUGAS 
1. Manfaat View Layout Dalam Pengembangan Aplikasi :
*Menghindari pengulangan kode
*Tampilan jadi konsisten
*Lebih rapi & mudah maintenance
2. Perbedaan View Cell dan View Biasa
   View Cell : Komponen reusable, Dipanggil dari view, Modular & bisa dipakai ulang. Sedangkan
   View Biasa : Tampilan biasa, Dipanggil controller, Dipanggil controller
3. Improvisasi
Filter kategori:
$model->where('kategori', 'teknologi')->findAll();

Struktur yang Digunakan
1. Layout Utama
File:
app/Views/layout/main.php

Digunakan sebagai template utama yang berisi:
-Header
-Navbar
-Content (renderSection)
-Sidebar
-Footer

2. Menggunakan Section
Contoh pada view:
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1><?= $title; ?></h1>
<p><?= $content; ?></p>
<?= $this->endSection() ?>

3. Menambahkan Sidebar (View Cell)
Pada file layout/main.php:

<section style="display:flex; gap:20px;">
    <div style="flex:3;">
        <?= $this->renderSection('content') ?>
    </div>

    <aside id="sidebar" style="flex:1;">
        <?= view_cell('App\\Cells\\ArtikelTerkini::render') ?>
    </aside>
</section>

4. Membuat View Cell
File:

app/Cells/ArtikelTerkini.php
<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;
use App\Models\ArtikelModel;

class ArtikelTerkini extends Cell
{
    public function render(): string
    {
        $model = new ArtikelModel();
        $artikel = $model->orderBy('id', 'DESC')->findAll(5);

        return view('components/artikel_terkini', [
            'artikel' => $artikel
        ]);
    }
}

5. View untuk Sidebar
File:

app/Views/components/artikel_terkini.php
<h3>Artikel Terkini</h3>
<ul>
<?php foreach ($artikel as $row): ?>
    <li>
        <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
            <?= $row['judul']; ?>
        </a>
    </li>
<?php endforeach; ?>
</ul>

# Praktikum 4 – Authentication (Login System)
Konfigurasi Awal
1. Setup Database

Membuat database:

CREATE DATABASE lab_ci4;
2. Membuat Tabel User
CREATE TABLE user (
    id INT(11) AUTO_INCREMENT,
    username VARCHAR(200),
    useremail VARCHAR(200),
    userpassword VARCHAR(255),
    PRIMARY KEY(id)
);
3. Insert User (dengan password hash)
echo password_hash('admin123', PASSWORD_DEFAULT);

Contoh hasil:

$2y$10$xxxxxxxxxxxxxxxxxxxxxxxx

Lalu insert ke database:

INSERT INTO user (username, useremail, userpassword)
VALUES ('admin', 'admin@email.com', 'HASIL_HASH');

Controller Login

File: app/Controllers/User.php

<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function login()
    {
        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $session = session();
            $model = new UserModel();

            $login = $model->where('useremail', $email)->first();

            if ($login) {
                if (password_verify($password, $login['userpassword'])) {

                    $session->set([
                        'user_id' => $login['id'],
                        'user_name' => $login['username'],
                        'user_email' => $login['useremail'],
                        'logged_in' => true
                    ]);

                    return redirect()->to('/admin/artikel');

                } else {
                    $session->setFlashdata("flash_msg", "Password salah.");
                }
            } else {
                $session->setFlashdata("flash_msg", "Email tidak terdaftar.");
            }
        }

        return view('user/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/user/login');
    }
}
 View Login

File: app/Views/user/login.php

<h2>Login</h2>

<?php if(session()->getFlashdata('flash_msg')): ?>
    <p style="color:red"><?= session()->getFlashdata('flash_msg') ?></p>
<?php endif; ?>

<form method="post">
    <p>Email:</p>
    <input type="email" name="email">

    <p>Password:</p>
    <input type="password" name="password">

    <br><br>
    <button type="submit">Login</button>
</form>
 Routing

File: app/Config/Routes.php

$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');

### Praktikum 5 - Pagination dan Pencarian
Tujuan
1. Mahasiswa mampu memahami konsep dasar Pagination.
2. Mahasiswa mampu memahami konsep dasar Pencarian.
3. Mahasaswa mampu membuat Paging dan Pencarian menggunakan Framework
Codeigniter 4.

Pada praktikum ini dilakukan pengembangan fitur pagination dan pencarian data pada aplikasi portal berita menggunakan framework CodeIgniter 4. Fitur pagination digunakan untuk membatasi jumlah data yang ditampilkan pada setiap halaman, sedangkan fitur pencarian digunakan untuk mempermudah pengguna dalam mencari artikel berdasarkan kata kunci tertentu.

Langkah Praktikum
1. Membuat Pagination
Pagination digunakan agar data artikel tidak tampil sekaligus dalam satu halaman. Pada praktikum ini digunakan method:
$model->paginate(10);
Artinya setiap halaman menampilkan maksimal 10 data artikel.
2. Menambahkan Pager
Untuk menampilkan navigasi halaman digunakan:
<?= $pager->links(); ?>
Dengan fitur ini pengguna dapat berpindah halaman data artikel.

3. Membuat Form Pencarian
Pada halaman admin artikel ditambahkan form pencarian menggunakan input keyword.
Contoh form pencarian:

<form method="get">
    <input type="text" name="q">
    <input type="submit" value="Cari">
</form>

4. Menambahkan Query Pencarian
Pencarian dilakukan menggunakan Query Builder CodeIgniter 4 dengan method like().
$model->like('judul', $q)->paginate(10);
Query tersebut digunakan untuk mencari artikel berdasarkan judul.

Kesimpulan :
Pada praktikum ini berhasil diterapkan fitur pagination dan pencarian data menggunakan CodeIgniter 4. Dengan adanya pagination, tampilan data menjadi lebih terstruktur dan ringan. Sedangkan fitur pencarian membantu pengguna menemukan artikel dengan lebih cepat dan efisien.

# Praktikum 6: Relasi Tabel dan Query Builder

### Deskripsi Praktikum
Praktikum ini membahas implementasi relasi tabel pada framework CodeIgniter 4 menggunakan Query Builder JOIN. Pada praktikum ini dilakukan pembuatan tabel kategori yang dihubungkan dengan tabel artikel menggunakan foreign key, kemudian data relasi ditampilkan pada halaman admin maupun halaman artikel.

### Tujuan Praktikum
*Memahami konsep relasi tabel pada database.
*Mengimplementasikan foreign key pada MySQL.
*Menggunakan Query Builder JOIN pada CodeIgniter 4.
*Menampilkan data relasi pada halaman web.
*Membuat form tambah dan edit artikel dengan dropdown kategori.

### Langkah Praktikum
1. Membuat Tabel Kategori
Membuat tabel kategori pada database lab_ci4.

Struktur tabel:
id_kategori
nama_kategori
slug_kategori

Query SQL:
CREATE TABLE kategori (
    id_kategori INT(11) AUTO_INCREMENT,
    nama_kategori VARCHAR(100) NOT NULL,
    slug_kategori VARCHAR(100),
    PRIMARY KEY (id_kategori)
);

2. Menambahkan Foreign Key
Menambahkan kolom id_kategori pada tabel artikel dan menghubungkannya dengan tabel kategori.

3. Modifikasi Model
Menambahkan method JOIN pada ArtikelModel.php.

public function getArtikel()
{
    return $this->db->table('artikel')
        ->select('artikel.*, kategori.nama_kategori')
        ->join('kategori', 'kategori.id_kategori = artikel.id_kategori')
        ->get()
        ->getResultArray();
}

4. Modifikasi Controller
Mengubah controller agar menggunakan method getArtikel() sehingga data kategori ikut ditampilkan.

5. Modifikasi View
Menambahkan kolom kategori pada halaman admin dan halaman artikel.
Contoh tampilan:
Artikel Pertama
Kategori: Teknologi

6. Menambahkan Dropdown Kategori
Pada form tambah dan edit artikel ditambahkan dropdown kategori agar pengguna dapat memilih kategori artikel secara langsung.

### Hasil Praktikum
Hasil praktikum menunjukkan bahwa:
Relasi tabel berhasil dibuat.
Query JOIN berhasil dijalankan.
Data kategori dapat ditampilkan pada halaman admin dan halaman artikel.
Form tambah dan edit artikel berhasil menggunakan dropdown kategori.

### Kesimpulan
Pada praktikum ini berhasil diterapkan relasi tabel menggunakan foreign key dan Query Builder JOIN pada CodeIgniter 4. Dengan adanya relasi tersebut, data artikel dan kategori dapat saling terhubung sehingga pengelolaan data menjadi lebih terstruktur dan efisien.

# Praktikum 7 — Upload File Gambar
### Deskripsi Praktikum
Pada praktikum ini dilakukan implementasi upload file gambar pada aplikasi portal berita menggunakan framework CodeIgniter 4. Fitur upload digunakan untuk menambahkan gambar pada setiap artikel yang dibuat sehingga tampilan artikel menjadi lebih menarik dan informatif.
### Tujuan
1. Mahasiswa mampu memahami konsep dasar File Upload.
2. Mahasaswa mampu membuat File Upload menggunakan Framework Codeigniter 4.
### Langkah Praktikum
1. Menambahkan Kolom Gambar pada Database
Menambahkan kolom gambar pada tabel artikel untuk menyimpan nama file gambar.
Query SQL:
ALTER TABLE artikel
ADD gambar VARCHAR(255);

2. Modifikasi Controller Artikel
Melakukan perubahan pada method add() di Artikel.php untuk menangani proses upload gambar.
Kode upload file:
$file = $this->request->getFile('gambar');
$file->move(ROOTPATH . 'public/gambar');

Kode penyimpanan nama file:
'gambar' => $file->getName(),

3. Modifikasi Form Tambah Artikel
Menambahkan atribut enctype pada tag form agar dapat mengirim file upload.
<form action="" method="post" enctype="multipart/form-data">
   
4. Menambahkan Input File
Menambahkan field input file pada form tambah artikel.
<p>
    <input type="file" name="gambar">
</p>

5. Membuat Folder Upload
Membuat folder:
public/gambar
Folder ini digunakan untuk menyimpan file gambar yang diupload.

### Hasil Praktikum
Hasil dari praktikum ini yaitu:
Form upload gambar berhasil ditambahkan.
File gambar berhasil diupload ke folder public/gambar.
Nama file gambar berhasil disimpan ke database.
Artikel dapat memiliki gambar sesuai upload pengguna.

### Kesimpulan
Pada praktikum ini berhasil diterapkan fitur upload file gambar menggunakan CodeIgniter 4. Dengan adanya fitur upload gambar, artikel menjadi lebih menarik dan pengelolaan media pada website dapat dilakukan dengan lebih baik.

# Praktikum 8: AJAX
### Deskripsi Praktikum
Pada praktikum ini dilakukan implementasi AJAX pada aplikasi portal berita menggunakan framework CodeIgniter 4 dan jQuery. AJAX digunakan untuk mengambil data artikel dari server tanpa melakukan reload halaman sehingga proses menampilkan data menjadi lebih cepat dan interaktif.

### Tujuan
1. Memahami konsep AJAX dan cara kerjanya.
2. Mampu mengimplementasikan AJAX pada aplikasi web dengan CodeIgniter 4.
3. Melatih kemampuan problem solving dan debugging.

### Langkah Praktikum
1. Menyiapkan jQuery
Membuat folder:
public/assets/js
Kemudian menambahkan file:
jquery-4.0.0.min.js
File jQuery digunakan untuk menjalankan AJAX pada halaman web.
2. Membuat AjaxController
Membuat file controller:
app/Controllers/AjaxController.php
Controller digunakan untuk menampilkan halaman AJAX dan mengirim data artikel dalam format JSON.
Contoh method:
public function getData()
{
    $model = new ArtikelModel();

    $data = $model->findAll();

    return $this->response->setJSON($data);
}
3. Menambahkan Route AJAX
Menambahkan route pada file:
app/Config/Routes.php
Kode route:
$routes->get('/ajax', 'AjaxController::index');
$routes->get('/ajax/getData', 'AjaxController::getData');
4. Membuat View AJAX
Membuat file view:
app/Views/ajax/index.php
View digunakan untuk menampilkan tabel artikel yang datanya diambil menggunakan AJAX.
5. Membuat AJAX Request
Menggunakan jQuery AJAX untuk mengambil data artikel dari server.
Contoh kode:
$.ajax({

    url: "<?= base_url('ajax/getData') ?>",

    method: "GET",

    dataType: "json",

    success: function(data) {

        console.log(data);
    }

});
6. Menampilkan Data ke Tabel
Data JSON yang diterima kemudian ditampilkan ke dalam tabel HTML menggunakan JavaScript dan jQuery.

### Hasil Praktikum
Hasil dari praktikum ini yaitu:
* Data artikel berhasil diambil menggunakan AJAX.
* Data ditampilkan tanpa reload halaman.
* JSON response berhasil diproses menggunakan jQuery.
* Halaman menjadi lebih interaktif dan dinamis.

### Kesimpulan
Pada praktikum ini berhasil diterapkan AJAX menggunakan jQuery dan CodeIgniter 4. Dengan AJAX, proses pengambilan data dapat dilakukan tanpa reload halaman sehingga aplikasi menjadi lebih cepat dan responsif.



