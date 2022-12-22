<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPemenang;

class Home extends Controller
{
    use ResponseTrait;
    public function index()
    {
        return view('welcome_message');
    }

    public function daftarPemenang()
    {
        $mm = new ModelPemenang();
        $data = $mm->daftarPemenang();
        return $this->respond($data, 200);
    }
}
