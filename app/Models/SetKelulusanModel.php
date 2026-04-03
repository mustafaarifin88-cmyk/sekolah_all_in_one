<?php

namespace App\Models;

use CodeIgniter\Model;

class SetKelulusanModel extends Model
{
    protected $table            = 'setting_kelulusan';
    protected $primaryKey       = 'id_setting_lulus';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tahun_ajar', 'tanggal_terbit', 'jam_terbit', 'status'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}