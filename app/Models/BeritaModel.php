<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table            = 'berita';
    protected $primaryKey       = 'id_berita';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kategori_b', 'judul_berita', 'isi_berita', 'thumbnail', 
        'status_publish', 'tanggal_publish', 'id_user'
    ];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}