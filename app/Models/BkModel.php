<?php

namespace App\Models;

use CodeIgniter\Model;

class BkModel extends Model
{
    protected $table            = 'bk';
    protected $primaryKey       = 'id_bk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'id_siswa', 'judul_kasus', 'keterangan'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}