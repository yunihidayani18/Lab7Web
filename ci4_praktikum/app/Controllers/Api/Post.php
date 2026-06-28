<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    use ResponseTrait;

    // tampil semua data
    public function index()
    {
        $model = new ArtikelModel();
        $data['artikel'] = $model->orderBy('id', 'DESC')->findAll();

        return $this->respond($data);
    }

    // tambah data
    public function create()
{
    $model = new \App\Models\ArtikelModel();

    $json = $this->request->getJSON(true);

    $data = [
        'judul'  => $json['judul'] ?? '',
        'isi'    => $json['isi'] ?? '',
        'status' => $json['status'] ?? 0,
        'slug'   => url_title($json['judul'] ?? '', '-', true),
        'gambar' => 'default.jpg',
        'id_kategori' => null
    ];

    try {
        $model->insert($data);

        return $this->respondCreated([
            'status' => 201,
            'message' => 'Data berhasil ditambahkan'
        ]);
    } catch (\Exception $e) {
        return $this->respond([
            'error' => $e->getMessage()
        ], 500);
    }
}

    // tampil satu data
    public function show($id = null)
    {
        $model = new ArtikelModel();

        $data = $model->where('id', $id)->first();

        if ($data) {
            return $this->respond($data);
        }

        return $this->failNotFound('Data tidak ditemukan.');
    }

    // update data
  public function update($id = null)
{
    $model = new ArtikelModel();

   $dataJson = $this->request->getJSON(true);

$data = [
    'judul'  => $dataJson['judul'],
    'isi'    => $dataJson['isi'],
    'status' => $dataJson['status']
];

    $model->update($id, $data);

    $response = [
        'status' => 200,
        'error' => null,
        'messages' => [
            'success' => 'Data artikel berhasil diubah.'
        ]
    ];

    return $this->respond($response);
}

    // hapus data
    public function delete($id = null)
    {
        $model = new ArtikelModel();

        $data = $model->where('id', $id)->first();

        if ($data) {
            $model->delete($id);

            return $this->respondDeleted([
                'status' => 200,
                'messages' => [
                    'success' => 'Data artikel berhasil dihapus.'
                ]
            ]);
        }

        return $this->failNotFound('Data tidak ditemukan.');
    }
}