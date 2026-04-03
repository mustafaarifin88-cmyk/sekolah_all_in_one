<?php

namespace App\Models;

use CodeIgniter\Model;

class PangkatGuruModel extends Model
{
    protected $table            = 'riwayat_pangkat_guru';
    protected $primaryKey       = 'id_riwayat_pkt';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_guru', 'golongan', 'no_sk', 'tmt_pangkat', 'tahun_sk'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}