<?php

namespace App\Controllers;

use App\Models\HasilModel;
use App\Models\KategoriProdukModel;

class Hasil extends BaseController
{
    protected $hasil;
    protected $kategori;

    public function __construct()
    {
        $this->hasil = new HasilModel();
        $this->kategori = new KategoriProdukModel();
    }

    public function index($tipe_kulit = null, $id_kategori = null)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }
        // Cek apakah bulan dan id_kategori sudah ditentukan
        if ($tipe_kulit != null && $id_kategori != null) {
            // Ambil data berdasarkan tipe_kulit dan id_kategori
            $dataHasil = $this->hasil->getProduk($tipe_kulit, $id_kategori);
        } else {
            // Ambil semua data
            $dataHasil = $this->hasil->findAll();
        }

        $data = [
            'title' => 'Data Hasil',
            'tipe_kulit' => $tipe_kulit,
            'id_kategori' => $id_kategori,
            'kategoriProduk' => $this->kategori->findAll(),
            'hasil' => $dataHasil,
            'countHasil' => $this->hasil->getCountHasilUnik(),
        ];
        return view('Hasil/index', $data);
    }

    public function cetak($tipe_kulit = null, $id_kategori = null)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Ranking Produk Skincare',
            'tipe_kulit' => $tipe_kulit,
            'id_kategori' => $id_kategori,
            'hasil' => $this->hasil->getProdukRanking($tipe_kulit, $id_kategori),
        ];
        return view('Hasil/cetak', $data);
    }

    public function hapus($tipe_kulit = null, $id_kategori = null)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        // Pastikan $id_tipe_kulit dan $id_id_kategori tidak null
        if ($tipe_kulit !== null && $id_kategori !== null) {
            // Gunakan where clause untuk kondisi spesifik sebelum delete
            $this->hasil->where([
                'kode_tipekulit' => $tipe_kulit,
                'id_kategori' => $id_kategori,
            ])->delete();

            // Set pesan berhasil
            session()->setFlashdata('pesan', 'Data berhasil dihapus!');
        } else {
            // Set pesan error jika id_tipe_kulit atau id_id_kategori null
            session()->setFlashdata('pesan', 'Gagal menghapus data. ID bulan atau tahun tidak valid.');
        }

        return redirect()->to('/admin/hasil');
    }
}
