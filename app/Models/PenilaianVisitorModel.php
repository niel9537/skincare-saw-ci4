<?php

namespace App\Models;

use CodeIgniter\Model;

class PenilaianVisitorModel extends Model
{
    protected $table      = 'kriteria_visitor';
    protected $primaryKey = 'id_kriteria_visitor';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_visitor', 'id_kriteria', 'id_sub_kriteria', 'nilai_kriteria'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function getSubKriteria()
    {
        $builder = $this->builder();
        $builder->select('kriteria_visitor.*, sub_kriteria.*');
        $builder->join('sub_kriteria', 'sub_kriteria.id_sub_kriteria = kriteria_visitor.id_sub_kriteria');
        $query = $builder->get();
        return $query->getResultArray(); // Mengembalikan semua baris hasil sebagai array
    }
}
