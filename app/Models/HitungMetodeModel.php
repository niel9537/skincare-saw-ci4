<?php

namespace App\Models;

use CodeIgniter\Model;

class HitungMetodeModel extends Model
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


    // Buat query builder menggunakan Method getNilaiSubKriteria untuk mendapatkan nilai sub_kriteria
    public function getNilaiSubKriteria($idAlternatif, $idKriteria)
    {
        $builder = $this->db->table('penilaian');
        // $builder->select('nilai');
        $builder->select('sub_kriteria.nilai as n');
        $builder->join('sub_kriteria', 'penilaian.id_kriteria = sub_kriteria.id_kriteria');
        $builder->where('penilaian.id_alternatif', $idAlternatif);
        $builder->where('penilaian.id_kriteria', $idKriteria);
        // $builder->where('id_alternatif', $idAlternatif);
        // $builder->where('id_kriteria', $idKriteria);

        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getNilaiById($id_alternatif, $id_kriteria)
    {
        return $this->where('id_alternatif', $id_alternatif)
            ->where('id_kriteria', $id_kriteria)
            ->findAll();
    }

    public function getDistinctKriteria()
    {
        $builder = $this->db->table('penilaian p');
        $builder->select('p.id_kriteria, p.id_produk, k.*');
        $builder->join('kriteria k', 'p.id_kriteria = k.id_kriteria');
        $builder->groupBy('p.id_kriteria');
        $builder->orderBy('p.id_kriteria', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getDistinctAlternatif()
    {

        return $this->select('id_produk')
            ->groupBy('id_produk')
            ->orderBy('id_produk', 'ASC')
            ->find();
    }

    public function getAllPenilaian($tipe_kulit, $id_kategori)
    {
        $builder = $this->db->table('penilaian p');
        $builder->select('p.*, a.nama_produk, a.id_produk');
        $builder->join('produk a', 'p.id_produk = a.id_produk');
        $builder->where('p.id_kategori', $id_kategori);
        $builder->where('p.kode_tipekulit', $tipe_kulit);
        $builder->orderBy('p.id_produk', 'ASC');
        $builder->orderBy('p.id_kriteria', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getNilaiMaxMin()
    {
        $builder = $this->db->table('penilaian');
        $builder->select('id_kriteria, MAX(nilai) as nilaiMax, Min(nilai) as nilaiMin');
        $builder->groupBy('id_kriteria');
        $builder->orderBy('id_kriteria', 'ASC');
        $builder->orderBy('id_produk', 'ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
