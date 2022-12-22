<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPemenang extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pemenang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['hadiah', 'anggota', 'keterangan'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function daftarPemenang()
    {
        $mm = $this->db->table('pemenang as p');
        $mm->select('p.hadiah, p.anggota, p.keterangan, h.nama as namaHadiah, h.nominal, h.level, a.nama as namaAnggota, a.alamat, a.kelompok');
        $mm->join('hadiah as h', 'h.kode = p.hadiah');
        $mm->join('peserta as a', 'a.nia = p.anggota');
        $mm->orderBy('h.nominal', 'ASC');
        $data = $mm->get();
        if(!$data) return false;
        return $data->getResult();
    }
    public function pemenangHadiah($kode)
    {
        $mm = $this->db->table('pemenang as p');
        $mm->select('p.hadiah, p.anggota, p.keterangan, h.nominal, h.level, a.nama as namaAnggota, a.kelompok, a.alamat');
        $mm->join('hadiah as h', 'h.kode = p.hadiah');
        $mm->join('peserta as a', 'a.nia = p.anggota');
        $mm->where('p.hadiah', $kode);
        $mm->orderBy('p.id', 'ASC');
        $data = $mm->get();
        if(!$data) return false;
        return $data->getResult();
    }

}
