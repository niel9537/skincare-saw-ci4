<?php

namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id_produk';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['kode_produk', 'nama_produk', 'foto_produk', 'id_brand', 'id_kategori', 'tipe_kulit', 'link_produk', 'created_at', 'update_at'];

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
        $builder = $this->db->table('produk');
        $builder->select("MAX(CAST(SUBSTRING(kode_produk, 4) AS UNSIGNED)) as kodeMax", FALSE);
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $kode = $row->kodeMax;

            // Menghapus karakter non-angka dan mengkonversi ke integer
            $number = intval(preg_replace('/[^0-9]/', '', $kode));
            // var_dump($number);

            // Debug: Output number after conversion
            log_message('debug', 'Number extracted: ' . $number);

            // Menambahkan 1 ke angka tersebut
            $newNumber = $number + 1;

            // $newKode = 'PR-' . $newNumber;
            // Membentuk kode baru dengan format 'PR-' diikuti oleh angka baru
            $newKode = 'PR-' . sprintf('%d', $newNumber); // Gunakan sprintf untuk format angka jika perlu
        } else {
            // Jika tidak ada data, mulai dari 'PR-1'
            $newKode = 'PR-1';
        }

        return $newKode;
    }


    public function getAllProduk()
    {
        $builder = $this->db->table('produk'); // Menggunakan tabel produk sebagai basis
        $builder->select('produk.*, kategori_produk.nama_kategori_produk, brand.nama_brand'); // Sesuaikan kolom yang diinginkan
        $builder->join('kategori_produk', 'kategori_produk.id_kategori = produk.id_kategori', 'left'); // Join dengan tabel kategori_produk
        $builder->join('brand', 'brand.id_brand = produk.id_brand', 'left'); // Join dengan tabel brand
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getProduk($tipe_kulit, $id_kategori)
    {
        $builder = $this->builder();
        $builder->select('*');
        $builder->where('id_kategori', $id_kategori);
        $builder->where('tipe_kulit', $tipe_kulit);
        $query = $builder->get();

        return $query->getResultArray();
    }
}
