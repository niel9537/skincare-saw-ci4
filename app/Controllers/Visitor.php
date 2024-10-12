<?php

namespace App\Controllers;

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;
use App\Models\KategoriProdukModel;
use App\Models\visitorModel;
use App\Models\PenilaianVisitorModel;
use App\Models\HitungMetodeModel;
use App\Models\HasilRekomendasiModel;

class Visitor extends BaseController
{
    protected $alternatif;
    protected $kriteria;
    protected $subKriteria;
    protected $kategori;
    protected $visitor;
    protected $penilaianVisitor;
    protected $getHitung;
    protected $hasilRekomendasi;

    public function __construct()
    {

        $this->alternatif = new AlternatifModel();
        $this->kriteria = new KriteriaModel();
        $this->subKriteria = new subKriteriaModel();
        $this->kategori = new KategoriProdukModel();
        $this->visitor = new VisitorModel();
        $this->penilaianVisitor = new PenilaianVisitorModel();
        $this->getHitung = new HitungMetodeModel();
        $this->hasilRekomendasi = new HasilRekomendasiModel();
    }

    public function index()
    {
        // Dapatkan semua data kriteria
        $kriteriaList = $this->kriteria->findAll();

        // Inisialisasi array untuk menyimpan data subkriteria
        $dataKriteria = [];

        // Looping data kriteria
        foreach ($kriteriaList as $kriteria) {
            // Dapatkan data subkriteria berdasarkan ID kriteria
            $subkriteria = $this->subKriteria->where('id_kriteria', $kriteria['id_kriteria'])->findAll();

            // Tambahkan data subkriteria ke dalam array
            $dataKriteria[] = [
                'kriteria' => $kriteria,
                'subkriteria' => $subkriteria,
            ];
        }

        $data = [
            'title' => 'Form Rekomendasi',
            'dataKriteria' => $dataKriteria,
            'kategoriProduk' => $this->kategori->findAll()
        ];
        return view('/hasil-rekomendasi/index', $data);
    }


    public function addPenilaian()
    {
        // Ambil data dari form menggunakan request
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $kategoriProduk = $this->request->getPost('katProduk');
        $tipeKulit = $this->request->getPost('tipeKulit');
        $idKriteria = $this->request->getPost('idKriteria');
        $nilai = $this->request->getPost('nilai');

        // Buat array untuk menyimpan data ke penilaian_temp
        $dataPenilaian = [];

        // Loop data kriteria dan nilai yang didapat dari form
        for ($i = 0; $i < count($idKriteria); $i++) {
            $nilaiData = explode('|', $nilai[$i]);
            $dataPenilaian[] = [
                'kode_tipekulit' => $tipeKulit,
                'id_kategori' => $kategoriProduk,
                'id_produk' => 0, // Isi ini sesuai produk yang ingin dinilai atau 0 jika belum ada
                'id_kriteria' => $idKriteria[$i],
                'nilai' => $nilaiData[0],
                'nama' => $nama,
                'email' => $email,
            ];
        }

        // Simpan data ke tabel penilaian_temp
        $penilaianTempModel = new \App\Models\PenilaianTempModel();
        $penilaianTempModel->insertBatch($dataPenilaian);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/')->with('success', 'Data berhasil disimpan.');
    }

    public function indexAdmin()
    {

        $data = [
            'title' => 'Data Pengunjung',
            'visitor' => $this->visitor->findAll(),
            'kategoriProduk' => $this->kategori->findAll(),
            'produk' => $this->alternatif->findAll(),
            'kriteria' => $this->kriteria->findAll(),
            'detailVisitor' => $this->visitor->getAllDataVisitor(),
            'nilaiKriteria' => $this->penilaianVisitor->findAll(),
            'subKriteria' => $this->subKriteria->findAll()
        ];
        return view('visitor/index', $data);
    }

    public function saveDataFormVisitor()
    {
        $katProduk = $this->request->getPost('katProduk');
        $tipeKulit = $this->request->getPost('tipeKulit');

        // 1. ambil data untuk keperluan menghitung matrik normalisasi
        $idVisitor = $this->visitor->getLastIDVisitor();
        // dd($idVisitor->id_visitor);
        $kriteria = $this->getHitung->getDistinctKriteria();
        $bobotKriteria = $this->kriteria->findAll();
        $dataPenilaian = $this->getHitung->getAllPenilaian($tipeKulit, $katProduk);
        $nilaiMaxMin = $this->getHitung->getNilaiMaxMin();

        $nilaiMax = [];
        foreach ($nilaiMaxMin as $nMax) {
            $nilaiMax[] = $nMax['nilaiMax'];
        }
        $nilaiMin = [];
        foreach ($nilaiMaxMin as $nMin) {
            $nilaiMin[] = $nMin['nilaiMin'];
        }

        $bobot_kriteria = [];
        foreach ($bobotKriteria as $dataBobot) {
            $bobot_kriteria[] = $dataBobot['bobot'];
        }
        // dd($bobot);

        $data = [];
        $produkMapping = [];
        $normalisasi = [];
        foreach ($dataPenilaian as $penilaian) {
            $data[$penilaian['nama_produk']][$penilaian['id_kriteria']] = $penilaian['nilai'];
            $produkMapping[$penilaian['nama_produk']] = $penilaian['id_produk'];
        }

        // 2. Melakukan perhitungan normalisasi
        foreach ($data as $nama_produk => $nilaiKriteria) {
            foreach ($kriteria as $index => $key) {
                $nilai = array_key_exists($key['id_kriteria'], $nilaiKriteria) ? $nilaiKriteria[$key['id_kriteria']] : 0;
                if ($nilai !== 0) {
                    if ($key['type'] == "Benefit") {
                        $nilaiDiBagi = $nilai / $nilaiMax[$index];
                    } else { // asumsikan tipe selain "Benefit" adalah "Cost"
                        $nilaiDiBagi = $nilaiMin[$index] / $nilai;
                    }
                } else {
                    $nilaiDiBagi = $nilai; // Jika tidak ada nilai, tetapkan 0 sebagai output
                }
                // Menyimpan hasil normalisasi
                $normalisasi[$nama_produk][$key['id_kriteria']] = round($nilaiDiBagi, 3);
                // dd($nilaiMax[$index]);
            }
        }


        // 3. menghitung nilai inputan user lalu normalisasikan
        $nilaiRange = $this->visitor->getNilaiRangePerKriteria();
        $nilaiAndId = $this->request->getPost('nilai');
        $kriteria_id = $this->request->getPost('idKriteria');
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');

        // Inisialisasi array untuk menampung nilai skor dan ID subkriteria
        $nilaiInputanUser = [];
        $idSubkriteria = [];

        $totalNilaiInputUser = 0;
        foreach ($nilaiAndId as $nilai) {
            list($nilaiSkor, $idSub) = explode('|', $nilai);
            // Memasukkan nilai skor ke dalam array nilaiInputanUser
            $nilaiInputanUser[] = $nilaiSkor;
            $totalNilaiInputUser += $nilaiSkor;
            // Memasukkan ID subkriteria ke dalam array idSubkriteria
            $idSubkriteria[] = $idSub;
        }

        // var_dump($nilaiRange);
        $nilaiInputanUserNormalized = [];
        foreach ($nilaiInputanUser as $index => $nilai) {

            if (isset($kriteria_id[$index])) { // Pastikan elemen idKriteria ada
                $idKriteria = intVal($kriteria_id[$index]);
                $id = ($idKriteria - 1);
                if (isset($nilaiRange[$id])) { // Pastikan ada range untuk id ini
                    $range = $nilaiRange[$id]['dataNilai'];
                    // $nilaiInputanUserNormalized[] = $nilai / $range;
                    $nilaiInputanUserNormalized[] = $nilai / $totalNilaiInputUser;
                }
            }
        }
        // dd($nilaiInputanUserNormalized);

        // 4. hitung untuk mendapatkan skor atau nilai rekomendasi
        $skorProduk = []; // Untuk menyimpan skor akhir setiap produk

        foreach ($normalisasi as $nama_produk => $nilaiKriteria) {
            $skor = 0; // Skor awal untuk produk ini
            foreach ($nilaiKriteria as $id_kriteria => $nilaiNormalisasi) {
                // Pastikan kriteria ada dalam input pengguna dan bobot kriteria
                if (isset($nilaiInputanUserNormalized[$id_kriteria]) && isset($bobot_kriteria[$id_kriteria])) {
                    $skor += $nilaiNormalisasi * $bobot_kriteria[$id_kriteria] * $nilaiInputanUserNormalized[$id_kriteria];
                }
            }
            // Simpan skor beserta id_produk yang sesuai
            $id_produk = $produkMapping[$nama_produk] ?? null; // Gunakan null coalescing operator sebagai fallback
            if ($id_produk) {
                $skorProduk[] = [
                    'id_produk' => $id_produk,
                    'nama_produk' => $nama_produk,
                    'skor' => $skor,
                ];
            }
        }

        // $id_unik_transaksi = uniqid('id-hr-', true);
        $id = intval($idVisitor->id_visitor) + 1;
        // if ($idVisitor->id_visitor == null) {
        //     $id = 1;
        // } else {
        //     $id = intval($idVisitor->id_visitor) + 1;
        // }

        // 1. Simpan data ke tabel visitor
        $this->visitor->save([
            'nama_visitor' => $nama,
            'email' => $email,
        ]);

        // 2. Simpan data ke tabel kriteria_visitor
        foreach ($kriteria_id as $i => $value) {
            $this->penilaianVisitor->save([
                'id_visitor' => $id,
                'id_kriteria' => $value,
                'id_sub_kriteria' => $idSubkriteria[$i],
                'nilai_kriteria' => $nilaiInputanUser[$i]
            ]);
        }

        // 3. Loop untuk menyimpan data ke tabel hasil_rekomendasi
        foreach ($skorProduk as $produk) {
            $this->hasilRekomendasi->save([
                'id_visitor' => $id,
                'id_kategori_produk' => $katProduk,
                'kode_tipekulit' => $tipeKulit,
                'id_produk' => $produk['id_produk'],
                'skor_produk' => $produk['skor']
            ]);
        }


        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Berikut hasil rekomendasi produk skincare anda!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/hasil-rekomendasi');
    }

    public function hasilRekomendasi()
    {
        $idVisitor = $this->visitor->getLastIDVisitor();
        $id = intVal($idVisitor->id_visitor);
        // dd($id);
        $data = [
            'title' => 'Hasil Rekomendasi',
            'hasilRekomendasi' => $this->hasilRekomendasi->getNilaiSkorRekomendasi($id)
        ];
        return view('/hasil-rekomendasi/hasil-rekomendasi', $data);
    }
}
