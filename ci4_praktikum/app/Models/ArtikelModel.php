<?php

namespace App\Models;
use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['judul', 'isi', 'status', 'slug', 'gambar','id_kategori'];

public function getArtikel($q = null)
{
    $builder = $this->db->table('artikel');

    $builder->select('artikel.*, kategori.nama_kategori');
    $builder->join('kategori', 'kategori.id_kategori = artikel.id_kategori');

    if ($q) {
        $builder->like('judul', $q);
    }

    return $builder->get()->getResultArray();
}
}