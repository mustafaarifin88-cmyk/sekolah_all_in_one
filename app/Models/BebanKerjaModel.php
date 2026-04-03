<?php

namespace App\Models;

use CodeIgniter\Model;

class BebanKerjaModel extends Model
{
    protected $table            = 'beban_kerja_guru';
    protected $primaryKey       = 'id_beban';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_guru', 'jumlah_jam_kerja'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}