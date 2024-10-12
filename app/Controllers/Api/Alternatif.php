<?php

namespace App\Controllers\Api;

use App\Models\AlternatifModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Alternatif extends ResourceController
{
    use ResponseTrait;

    protected $alternatifModel;

    public function __construct()
    {
        // $this->db = \Config\Database::connect();
        $this->alternatifModel = new AlternatifModel();
    }

    public function show($id = null)
    {
        // $data = $this->alternatifModel->where('nama_suppliers',$nama_suppliers)->find();
        $data = $this->alternatifModel->find($id);
        return $this->respond($data);
    }
}
