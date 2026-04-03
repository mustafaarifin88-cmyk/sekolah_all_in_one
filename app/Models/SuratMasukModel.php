<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukModel extends Model
{
    protected $table            = 'surat_masuk';
    protected $primaryKey       = 'id_surat_masuk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kode_surat', 'nomor_surat', 'tanggal_surat', 'tanggal_diterima', 
        'dari', 'perihal', 'id_sifat_surat', 'tujuan_id_guru', 'lampiran'
    ];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}