<?php

namespace App\Models;

use CodeIgniter\Model;

class SliderModel extends Model
{
    protected $table            = 'slider';
    protected $primaryKey       = 'id_slider';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['judul', 'keterangan', 'foto'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}