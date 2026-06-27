<?php

namespace App\Controllers;

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
        $model = new ArtikelModel();

        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi'   => $this->request->getVar('isi'),
        ];

        $model->insert($data);

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data artikel berhasil ditambahkan.'
            ]
        ];

        return $this->respondCreated($response);
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

    $data = [
        'judul' => $this->request->getVar('judul'),
        'isi'   => $this->request->getVar('isi'),
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