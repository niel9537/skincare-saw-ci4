<?php

namespace App\Controllers\Api;

use App\Models\KriteriaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Kriteria extends ResourceController
{
    use ResponseTrait;

    protected $kriteriaModel;

    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        $this->kriteriaModel = new KriteriaModel();
    }

    public function show($id = null)
    {
        // $data = $this->kriteriaModel->where('nama_suppliers',$nama_suppliers)->find();
        $data = $this->kriteriaModel->find($id);
        return $this->respond($data);
    }
}
