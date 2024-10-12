<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table      = 'penilaian';
    protected $primaryKey = 'id_penilaian';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['kode_tipekulit', 'id_kategori', 'id_produk', 'id_kriteria', 'nilai'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function findAllPenilaian()
    {
        $builder = $this->builder();
        $builder->select('*');
        $builder->join('produk', 'produk.id_produk = penilaian.id_produk');
        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan semua baris hasil sebagai array
    }

    public function findPenilaian()
    {
        $builder = $this->builder();
        $builder->select('*');
        $builder->join('produk', 'penilaian.id_produk = produk.id_produk');

        // menambahkan kondisi jika $id disediakan
        if ($id == null) {
            // Menambahkan filter berdasarkan ID
            $builder->where('penilaian.id_penilaian', $id);
            $query = $builder->get();
            return $query->getRowArray(); // Mengembalikan satu baris hasil sebagai array
        }

        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan semua baris hasil sebagai array
    }

    // Dalam model AlternatifModel atau model yang relevan
    public function getPenilaianByAlternatifAndKriteria($idAlternatif, $idKriteria)
    {
        $builder = $this->db->table('penilaian');
        $builder->select('penilaian.nilai, sub_kriteria.nilai as nilai_sub_kriteria');
        $builder->join('sub_kriteria', 'penilaian.nilai = sub_kriteria.id_sub_kriteria', 'left'); // Sesuaikan dengan kondisi join Anda
        $builder->where('penilaian.id_produk', $idAlternatif);
        $builder->where('penilaian.id_kriteria', $idKriteria);
        $query = $builder->get();

        return $query->getRowArray(); // Untuk single result atau getResultArray() untuk multiple results
    }
}
