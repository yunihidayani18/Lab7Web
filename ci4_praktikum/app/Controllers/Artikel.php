<?php

namespace App\Controllers;
use App\Models\ArtikelModel;
use App\Models\KategoriModel;
use CodeIgniter\Exceptions\PageNotFoundException;
class Artikel extends BaseController
{
   public function index()
{
    $title = 'Daftar Artikel';

    $model = new ArtikelModel();

    $q = $this->request->getGet('q');

    $artikel = $model->getArtikel($q);

    return view('artikel/index', [
        'title' => $title,
        'artikel' => $artikel,
        'q' => $q
    ]);
}
public function admin_index()
{
    $title = 'Daftar Artikel (Admin)';

    $model = new ArtikelModel();
    $kategoriModel = new KategoriModel();

    $q = $this->request->getVar('q') ?? '';
    $kategori_id = $this->request->getVar('kategori_id') ?? '';
    $page = $this->request->getVar('page') ?? 1;

    $builder = $model->table('artikel')
        ->select('artikel.*, kategori.nama_kategori')
        ->join('kategori', 'kategori.id_kategori = artikel.id_kategori');

    if ($q != '') {
        $builder->like('artikel.judul', $q);
    }

    if ($kategori_id != '') {
        $builder->where('artikel.id_kategori', $kategori_id);
    }

    $artikel = $builder->paginate(10, 'default', $page);
    $pager = $model->pager->getDetails();

    $data = [
        'title' => $title,
        'q' => $q,
        'kategori_id' => $kategori_id,
        'artikel' => $artikel,
        'pager' => $pager
    ];

    if ($this->request->isAJAX()) {
        return $this->response->setJSON($data);
    } else {
        $data['kategori'] = $kategoriModel->findAll();
        return view('artikel/admin_index', $data);
    }
}
public function add()
{
    $kategoriModel = new KategoriModel();

    $validation = \Config\Services::validation();

    if (strtolower($this->request->getMethod()) === 'post') {
    
        $validation->setRules([
            'judul' => 'required'
        ]);

      if ($validation->withRequest($this->request)->run()) {
    

            $file = $this->request->getFile('gambar');

            if ($file && $file->isValid()) {
                $file->move(ROOTPATH . 'public/gambar');
                $gambar = $file->getName();
            } else {
                $gambar = null;
            }

            $artikel = new ArtikelModel();

           $result = $artikel->insert([
    'judul' => $this->request->getPost('judul'),
    'isi' => $this->request->getPost('isi'),
    'status' => $this->request->getPost('status'),
    'id_kategori' => $this->request->getPost('id_kategori'),
    'slug' => url_title($this->request->getPost('judul')),
    'gambar' => $gambar,
]);

if (!$result) {
    print_r($artikel->errors());
    die();
}

return redirect()->to('/admin/artikel');


        }
    }

    $data = [
        'title' => 'Tambah Artikel',
        'kategori' => $kategoriModel->findAll(),
    ];

    return view('artikel/form_add', $data);
}
public function edit($id)
{
    $model = new ArtikelModel();

    $kategoriModel = new \App\Models\KategoriModel();

    $artikel = $model->find($id);

    $kategori = $kategoriModel->findAll();

    $data = [
        'artikel' => $artikel,
        'kategori' => $kategori,
        'title' => 'Edit Artikel',
    ];

    return view('artikel/form_edit', $data);
}
public function update()
{
    $model = new \App\Models\ArtikelModel();

    $model->update($this->request->getPost('id'), [
        'judul' => $this->request->getPost('judul'),
        'isi'   => $this->request->getPost('isi'),
        'id_kategori' => $this->request->getPost('id_kategori')
    ]);

    return redirect()->to('/admin/artikel');
}
public function delete($id)
{
    $model = new \App\Models\ArtikelModel();
    $model->delete($id);

    return redirect()->to('/admin/artikel');
}
}