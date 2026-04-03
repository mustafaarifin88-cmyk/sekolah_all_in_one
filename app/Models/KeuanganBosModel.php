<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganBosModel extends Model
{
    protected $table            = 'dana_bos';
    protected $primaryKey       = 'id_bos';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['jumlah_dana_masuk', 'tanggal_terima', 'tahun_anggaran'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}