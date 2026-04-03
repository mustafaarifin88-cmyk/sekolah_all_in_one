<?php

namespace App\Models;

use CodeIgniter\Model;

class SertifikasiModel extends Model
{
    protected $table            = 'sertifikasi_guru';
    protected $primaryKey       = 'id_sertifikasi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_guru', 'nama_sertifikasi', 'tahun', 'keterangan'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}