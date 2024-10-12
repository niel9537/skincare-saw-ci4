<?php

namespace App\Controllers;

use App\Models\HitungMetodeModel;
use App\Models\AlternatifModel;
use App\Models\KategoriProdukModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\SubKriteriaModel;
use App\Models\HasilModel;

class HitungMetode extends BaseController
{
    protected $getHitung;
    protected $penilaian;
    protected $alternatif;
    protected $kategori;
    protected $kriteria;
    protected $subKriteria;
    protected $hasil;

    public function __construct()
    {
        $this->getHitung = new HitungMetodeModel();
        $this->penilaian = new PenilaianModel();
        $this->alternatif = new AlternatifModel();
        $this->kategori = new KategoriProdukModel();
        $this->kriteria = new KriteriaModel();
        $this->subKriteria = new SubKriteriaModel();
        $this->hasil = new HasilModel();
    }

    public function index($tipe_kulit = null, $id_kategori = null)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $kriteria = $this->getHitung->getDistinctKriteria();
        $dataPenilaian = $this->getHitung->getAllPenilaian($tipe_kulit, $id_kategori);
        $nilaiMaxMin = $this->getHitung->getNilaiMaxMin();

        $nilaiMax = [];
        foreach ($nilaiMaxMin as $nMax) {
            $nilaiMax[] = $nMax['nilaiMax'];
        }
        $nilaiMin = [];
        foreach ($nilaiMaxMin as $nMin) {
            $nilaiMin[] = $nMin['nilaiMin'];
        }

        $data = [];
        foreach ($dataPenilaian as $penilaian) {
            $data[$penilaian['nama_produk']][$penilaian['id_kriteria']] = $penilaian['nilai'];
        }
        // dd($data);

        return view('Perhitungan/index', [
            'title' => 'Perhitungan',
            'kriteria' => $kriteria,
            'nilaiAlternatif' => $data,
            'produk' => $this->alternatif->findAll(),
            'kategoriProduk' => $this->kategori->findAll(),
            'nilaiMax' => $nilaiMax,
            'nilaiMin' => $nilaiMin,
            'id_kategori' => $id_kategori,
            'tipe_kulit' => $tipe_kulit,
        ]);
    }

    public function simpanData()
    {
        $produk = $this->request->getVar('produk[]');
        $tipeKulit = $this->request->getVar('tipe_kulit[]');
        $idKategori = $this->request->getVar('id_kategori[]');
        $nilai = $this->request->getVar('nilai[]');
        // dd($tipeKulit);

        // Inisialisasi kode unik di sini, sehingga setiap baris data dalam proses ini akan memiliki kode yang sama
        $kodeUnik = uniqid('hasil-', true);

        for ($i = 0; $i < count($produk); $i++) {
            // Cek apakah data sudah ada di database
            $existingData = $this->hasil->where([
                'nama_produk' => $produk[$i],
                'kode_tipekulit' => $tipeKulit[$i],
                'id_kategori' => $idKategori[$i]
            ])->first();

            // if ($nilai[$i] >= 0.8) {
            //     $status = "Layak";
            // } else {
            //     $status = "Tidak Layak";
            // }

            $data = [
                'kode_hasil' => $kodeUnik,
                'nama_produk' => $produk[$i],
                'kode_tipekulit' => $tipeKulit[$i],
                'id_kategori' => $idKategori[$i],
                'nilai' => $nilai[$i],
                'status' => "",
            ];

            if ($existingData) {
                // Jika data sudah ada, lakukan update
                $this->hasil->update($existingData['id_hasil'], $data); // Pastikan 'id' adalah nama primary key dari tabel hasil
                session()->setFlashdata('pesan', 'Maaf, Data perhitungan sudah tersimpan di database!');
            } else {
                // Jika data belum ada, lakukan insert
                $this->hasil->save($data);
                session()->setFlashdata('pesan', 'Data perhitungan berhasil disimpan!');
            }
        }

        return redirect()->to('/admin/perhitungan/produk/' . $tipeKulit[0] . '/' . $idKategori[0]);
    }
}
