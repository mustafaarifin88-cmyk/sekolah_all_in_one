<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluarModel extends Model
{
    protected $table            = 'surat_keluar';
    protected $primaryKey       = 'id_surat_keluar';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kode_surat', 'nomor_surat', 'tanggal_surat', 'tujuan_surat', 
        'perihal', 'id_sifat_surat', 'lampiran'
    ];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}