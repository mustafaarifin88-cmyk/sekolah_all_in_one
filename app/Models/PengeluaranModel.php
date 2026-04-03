<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table            = 'pengeluaran_keuangan';
    protected $primaryKey       = 'id_pengeluaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tanggal', 'nama_pengeluaran', 'jumlah_pengeluaran', 'keterangan'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}