<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKelompok extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kelompok';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'keterangan'];

   
}
