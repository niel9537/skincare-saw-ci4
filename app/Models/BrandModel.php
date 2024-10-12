<?php

namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    protected $table      = 'brand';
    protected $primaryKey = 'id_brand';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['kode_brand', 'nama_brand'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // membuat kode produk auto
    public function generateCode()
    {
        $builder = $this->builder();
        $builder->selectMax('kode_brand', 'kodeMax');
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $kodeMax = $row->kodeMax;

            // Mengambil angka dari kode terakhir (menghapus 'BR' dan mengkonversi ke integer)
            // $number = intval(substr($kodeMax, 2));
            // Menghapus karakter non-angka dan mengkonversi ke integer
            $number = intval(preg_replace('/[^0-9]/', '', $kodeMax));

            // Menambahkan 1 ke angka tersebut
            $newNumber = $number + 1;

            // Membentuk kode baru dengan format 'A' diikuti oleh angka baru

        } else {
            // Jika tidak ada data, mulai dari 'A1'
            $newKode = 'BR001';
        }

        return $newKode;
    }
}
