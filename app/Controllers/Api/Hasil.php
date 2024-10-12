<?php

namespace App\Controllers\Api;

use App\Models\HasilModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Hasil extends ResourceController
{
    use ResponseTrait;

    protected $hasilModel;

    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        $this->hasilModel = new HasilModel();
    }

    public function show($id = null)
    {
        // $data = $this->hasilModel->where('nama_suppliers',$nama_suppliers)->find();
        $data = $this->hasilModel->find($id);
        return $this->respond($data);
    }
}
