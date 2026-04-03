<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuEksternalModel extends Model
{
    protected $table            = 'menu_eksternal';
    protected $primaryKey       = 'id_menu';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_menu', 'link_eksternal', 'urutan'];
    protected $useTimestamps    = true;
    protected $dateFormat       = 'datetime';
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}