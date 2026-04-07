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
