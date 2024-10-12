<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table      = 'kriteria';
    protected $primaryKey = 'id_kriteria';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['kode_kriteria', 'kriteria', 'type', 'bobot', 'ada_pilihan'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    // membuat kode alternatif auto
    public function generateCode()
    {
        $builder = $this->table('alternatif');
        $builder->selectMax('kode_kriteria', 'kodeMax');
        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $row = $query->getRow();
            $kodeMax = $row->kodeMax;

            // Mengambil angka dari kode terakhir (menghapus 'A' dan mengkonversi ke integer)
            $number = intval(substr($kodeMax, 1));

            // Menambahkan 1 ke angka tersebut
            $newNumber = $number + 1;

            // Membentuk kode baru dengan format 'C' diikuti oleh angka baru
            $newKode = 'C' . $newNumber;
        } else {
            // Jika tidak ada data, mulai dari 'A1'
            $newKode = 'C1';
        }

        return $newKode;
    }

    public function getPilihanSubKriteria()
    {
        $builder = $this->db->table('kriteria');
        // Gunakan COUNT(DISTINCT column_name) untuk menghitung jumlah nilai unik
        $builder->select('ada_pilihan as pilihan');
        $query = $builder->get();

        return $query->getRow()->pilihan;
    }
}
