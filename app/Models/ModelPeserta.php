<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPeserta extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'peserta';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nia', 'nama', 'alamat', 'kelompok'];

    public function listPeserta()
    {
        $mm = $this->db->table('peserta as p');
        $mm->select('p.nia, p.nama , p.alamat, p.kelompok, k.keterangan as namaKelompok');
        $mm->join('kelompok as k', 'k.kode = p.kelompok');
        $mm->orderBy('k.keterangan', 'ASC');
        $data = $mm->get();
        if(!$data) return false;
        return $data->getResult();
    }
}
