<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriBeritaModel extends Model
{
    protected $table            = 'kategori_berita';
    protected $primaryKey       = 'id_kategori_b';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_kategori'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}