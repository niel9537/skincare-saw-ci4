<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table      = 'visitor';
    protected $primaryKey = 'id_visitor';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['nama_visitor', 'email'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // query ambil selisih nilai max dan min berdasarkan id_kriteria
    public function getNilaiRangePerKriteria()
    {
        $builder = $this->db->table('sub_kriteria');
        $builder->select('id_kriteria, MAX(nilai) - MIN(nilai) AS dataNilai');
        $builder->groupBy('id_kriteria');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getLastIDVisitor()
    {
        $builder = $this->builder();
        $builder->selectMax('id_visitor');
        $query = $builder->get();

        return $query->getRow();
    }

    public function getAllDataVisitor()
    {
        $builder = $this->builder();
        $builder->select('visitor.*, hasil_rekomendasi.*');
        $builder->join('hasil_rekomendasi', 'hasil_rekomendasi.id_visitor = visitor.id_visitor');
        $builder->orderBy('hasil_rekomendasi.skor_produk', 'DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
