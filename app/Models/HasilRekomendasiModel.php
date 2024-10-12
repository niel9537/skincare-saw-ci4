<?php

namespace App\Models;

use CodeIgniter\Model;

class HasilRekomendasiModel extends Model
{
    protected $table      = 'hasil_rekomendasi';
    protected $primaryKey = 'id_hasil_rekomendasi';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['id_visitor', 'id_kategori_produk', 'kode_tipekulit', 'id_produk', 'skor_produk', 'link_produk'];

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

    public function getNilaiSkorRekomendasi($id)
    {
        $builder = $this->db->table('visitor t1');
        $builder->select('t1.*, t2.*, t3.nama_produk, t3.foto_produk, t3.link_produk');
        $builder->join('hasil_rekomendasi t2', 't1.id_visitor = t2.id_visitor');
        $builder->join('produk t3', 't2.id_produk = t3.id_produk');
        $builder->where('t2.id_visitor', $id);
        $builder->orderBy('t2.skor_produk', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getResultArray();
    }
}
