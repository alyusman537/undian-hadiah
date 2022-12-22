<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHadiah extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hadiah';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = ['kode', 'nama', 'nominal', 'level', 'qty', 'qty_pemenang', 'keterangan', 'foto'];

    public function daftarHadiah()
    {
        $mm = $this->db->table('hadiah');
        $mm->select('*');
        $mm->where('qty != qty_pemenang');
        $mm->orderBy('level', 'ASC');
        $data = $mm->get();

        if(!$data) return false;
        return $data->getResult();
    }
}
