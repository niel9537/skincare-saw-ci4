<?php

namespace App\Controllers;

use App\Models\PenilaianModel;
use App\Models\AlternatifModel;
use App\Models\KategoriProdukModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;

class Penilaian extends BaseController
{
    protected $penilaian;
    protected $alternatif;
    protected $kategori;
    protected $kriteria;
    protected $subKriteria;
    protected $dataBulan;
    protected $dataTahun;

    public function __construct()
    {
        $this->penilaian = new PenilaianModel();
        $this->alternatif = new AlternatifModel();
        $this->kategori = new KategoriProdukModel();
        $this->kriteria = new KriteriaModel();
        $this->subKriteria = new SubKriteriaModel();

        // membuat bulan untuk keperluan periode
        $this->dataBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        // membuat range tahun untuk keperluan periode
        $thnAwal = 2022;
        $thnAkhir = intval(date('Y'));
        $jumlahThn = $thnAkhir - $thnAwal;
        $this->dataTahun = [];
        for ($i = 0; $i <= $jumlahThn; $i++) {
            $this->dataTahun[] = $thnAwal + $i;
        }
    }

    public function index($tipe_kulit = null, $id_kategori = null)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $produkList = $this->alternatif->getProduk($tipe_kulit, $id_kategori);
        // dd($produkList);
        foreach ($produkList as $key => $produk) {
            // Memeriksa apakah sudah ada penilaian untuk produk ini
            $isPenilaianExists = $this->penilaian->where('id_produk', $produk['id_produk'])->countAllResults() > 0;
            $produkList[$key]['isPenilaianExists'] = $isPenilaianExists;
        }

        $data = [
            'title' => 'Penilaian',
            'produkList' => $produkList,
            'produk' => $this->alternatif->findAll(),
            'kategoriProduk' => $this->kategori->findAll(),
            'id_kategori' => $id_kategori,
            'tipe_kulit' => $tipe_kulit,
        ];

        return view('Penilaian/index', $data);
    }

    public function tambah($id)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        // $ambil data id alternatif
        $produk = $this->alternatif->find($id);

        // Dapatkan semua data kriteria
        $kriteriaList = $this->kriteria->findAll();

        // Inisialisasi array untuk menyimpan data subkriteria
        $subkriteriaData = [];

        // Looping data kriteria
        foreach ($kriteriaList as $kriteria) {

            // Dapatkan data subkriteria berdasarkan ID kriteria
            $subkriteria = $this->subKriteria->where('id_kriteria', $kriteria['id_kriteria'])->findAll();

            // Tambahkan data subkriteria ke dalam array
            $subkriteriaData[] = [
                'kriteria' => $kriteria,
                'subkriteria' => $subkriteria,
            ];
        }

        $data = [
            'title' => 'Tambah Penilaian',
            'produk' => $produk,
            'kriteria' => $kriteriaList,
            'subkriteriaData' => $subkriteriaData,
            'tipe_kulit' => $this->request->getVar('tipe_kulit'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'kategoriProduk' => $this->kategori->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('Penilaian/tambah', $data);
    }

    public function simpan($id)
    {
        // Dapatkan array dari input
        $tipe_kulit = $this->request->getVar('tipe_kulit');
        $id_kategori = $this->request->getVar('id_kategori');
        $idKriteria = $this->request->getVar('idKriteria[]');
        $nilai = $this->request->getVar('nilai[]');

        // Melakukan validasi untuk setiap elemen dalam array
        foreach ($idKriteria as $index => $value) {
            if (!$this->validate([
                'idKriteria' => 'required',
                'nilai' => 'required'
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/admin/penilaian/tambah/' . $id)->withInput()->with('validation', $validation);
            }

            // Menyimpan setiap entry
            $this->penilaian->save([
                'kode_tipekulit' => $tipe_kulit,
                'id_kategori' => $id_kategori,
                'id_produk' => $id,
                'id_kriteria' => $value,
                'nilai' => $nilai[$index]
            ]);
        }

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Berhasil ditambahkan!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/penilaian/produk/' . $tipe_kulit . '/' . $id_kategori);
    }

    public function edit($id)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $tipe_kulit = $this->request->getVar('tipe_kulit');
        $id_kategori = $this->request->getVar('id_kategori');
        // $ambil data id alternatif
        $idProduk = $this->alternatif->find($id);

        // Dapatkan semua data kriteria
        $kriteriaList = $this->kriteria->findAll();

        // Inisialisasi array untuk menyimpan data subkriteria
        $penilaianData = [];

        // Looping data kriteria
        foreach ($kriteriaList as $kriteria) {
            $idKriteria = $kriteria['id_kriteria'];

            // Dapatkan data penilaian berdasarkan ID produk dan ID kriteria
            $penilaian = $this->penilaian->where([
                'id_produk' => $id,
                'id_kriteria' => $idKriteria
            ])->orderBy('nilai', 'ASC')->findAll();

            // dapatkan data subkriteria berdasarkan id kriteria
            $kriteriaSub = $this->subKriteria->where('id_kriteria', $idKriteria)->findAll();

            // Tambahkan data penilaian ke dalam array
            $penilaianData[] = [
                'kriteria' => $kriteria,
                'subkriteria' => $kriteriaSub,
                'penilaian' => $penilaian,
            ];
        }

        $data = [
            'title' => 'Edit Penilaian',
            'id_produk' => $idProduk,
            'tipe_kulit' => $tipe_kulit,
            'id_kategori' => $id_kategori,
            'kriteria' => $kriteriaList,
            'penilaianData' => $penilaianData,
            'kategoriProduk' => $this->kategori->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('Penilaian/edit', $data);
    }

    public function update($id)
    {
        // Dapatkan array dari input
        $tipe_kulit = $this->request->getVar('tipe_kulit');
        $id_kategori = $this->request->getVar('id_kategori');
        $idKriteria = $this->request->getVar('idKriteria[]');
        $nilai = $this->request->getVar('nilai[]');

        // dd($idAlternatif);
        $this->penilaian->where('id_produk', $id)->delete();

        // Melakukan validasi untuk setiap elemen dalam array
        foreach ($idKriteria as $index => $value) {
            if (!$this->validate([
                'idKriteria' => 'required',
                'nilai' => 'required'
            ])) {
                $validation = \Config\Services::validation();
                return redirect()->to('/admin/penilaian/edit/' . $id)->withInput()->with('validation', $validation);
            }


            // Menyimpan setiap entry
            $this->penilaian->save([
                'kode_tipekulit' => $tipe_kulit,
                'id_kategori' => $id_kategori,
                'id_produk' => $id,
                'id_kriteria' => $value,
                'nilai' => $nilai[$index]
            ]);
        }

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Penilaian alternatif berhasil diupdate!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/penilaian/produk/' . $tipe_kulit . '/' . $id_kategori);
    }
}
