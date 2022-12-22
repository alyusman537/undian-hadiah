<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPemenang;
use App\Models\ModelPeserta;
use App\Models\ModelKelompok;
use App\Models\ModelHadiah;

class Undian extends BaseController
{
    use ResponseTrait;
    public function index()
    {
        return view ('undian');
    }
    public function daftarHadiah()
    {
        $mm = new ModelHadiah();
        $data = $mm->daftarHadiah();
        return $this->respond($data, 200);
    }

    public function hadiahByKode($kode)
    {
        $mm = new ModelHadiah();

        $data = $mm->where('kode', $kode)->first();
        if($data['qty_pemenang'] == $data['qty']) return $this->fail('Hadiah sudah kosong.');
        return $this->respond($data, 200);
    }
    public function listPeserta()
    {
        $mm= new ModelPeserta();
        $data = $mm->listPeserta();
        return $this->respond($data, 200);
    }
    public function pesertaByNia($nia)
    {
        $mm = new ModelPeserta();
        $pp = new ModelKelompok();
        $ww = new ModelPemenang();
        
        $cekPemenang = $ww->where(['anggota' => $nia, 'deleted_at' => NULL])->first();
        if($cekPemenang) return  $this->fail('Nomor Anggota '.$nia.' tidak berhak mengikuti undian Lagi.');

        $peserta = $mm->where('nia', $nia)->first();
        $kelompok = $pp->select('keterangan')->where('kode', $peserta['kelompok'])->first();
        $data = [
            'peserta' => $peserta,
            'kelompok' => $kelompok
        ];
        return $this->respond($data, 200);
    }
    public function daftarPemenang($kode)
    {
        $mm = new ModelPemenang();
        $data = $mm->pemenangHadiah($kode);//getWhere(['hadiah' => $kode, 'deleted_at' => NULL])->getResult();
        return $this->respond($data, 200);
    }
    public function simpanPemenang()
    {
        $mm = new ModelPemenang();
        $hh = new ModelHadiah();
        $json = $this->request->getJSON();

        $cekHadiah = $mm->where(['hadiah'=> $json->hadiah, 'deleted_at' => NULL])->countAllResults();
        $cekQtyHadiah = $hh->where('kode', $json->hadiah)->first();
        $cekPemenang = $mm->where(['anggota' => $json->anggota, 'deleted_at' => NULL])->first();
        if($cekPemenang) return  $this->fail('Nomor Anggota '.$json->anggota.' tidak berhak mengikuti undian Lagi.');
        if($cekHadiah == $cekQtyHadiah['qty']) return $this->fail('Hadiah sudah kosong.');
        $data = [
            'hadiah'    => $json->hadiah,
            'anggota'   => $json->anggota,
            'keterangan'    => $json->keterangan
        ];
        // return $this->respond($cekPemenang);
        $mm->save($data);
        $hh->set(['qty_pemenang' => (int)$cekQtyHadiah['qty_pemenang']+1]);
        $hh->where('kode', $json->hadiah);
        $hh->update();
        return $this->respond($data);
    }
}
