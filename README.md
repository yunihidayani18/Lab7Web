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





