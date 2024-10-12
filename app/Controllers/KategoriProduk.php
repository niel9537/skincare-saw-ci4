<?php

namespace App\Controllers;

use App\Models\KategoriProdukModel;

class KategoriProduk extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriProdukModel();
    }

    public function index()
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Data Kategori Produk',
            'kategoriProduk' => $this->kategori->findAll() // Gunakan data Kategori berdasarkan periode
        ];
        return view('Kategori-produk/index', $data);
    }

    public function tambah()
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Data Kategori',
            'validation' => \Config\Services::validation()
        ];
        return view('Kategori-produk/tambah', $data);
    }

    public function simpan()
    {
        // validasi input
        if (!$this->validate([
            'Kategori' => [
                // 'rules' => 'required|is_unique[nama_Kategori.Kategori]',
                'errors' => [
                    'required' => 'nama {field} harus diisi!',
                    // 'is_unique' => 'Kategori {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/kategori-produk/simpan')->withInput()->with('validation', $validation);
        }

        $this->kategori->save([
            'nama_kategori_produk' => $this->request->getVar('nama_kategori'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Kategori Produk berhasil ditambahkan!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/kategori-produk');
    }

    public function edit($id)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $data = [
            'title' => 'Edit Kategori',
            'kategori' => $this->kategori->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('Kategori-produk/edit', $data);
    }

    public function update($id)
    {
        // dd($id);
        // $id = $this->request->getVar('id');
        // validasi input
        // if (!$this->validate([
        //     'kategori' => [
        //         // 'rules' => 'required|is_unique[nama_Kategori_produk.kategori]',
        //         'errors' => [
        //             'required' => 'nama {field} harus diisi!',
        //             // 'is_unique' => 'Kategori {field} sudah ada!'
        //         ]
        //     ]
        // ])) {
        //     $validation = \Config\Services::validation();
        //     return redirect()->to('/admin/kategori-produk/edit/' . $id)->withInput()->with('validation', $validation);
        // }

        $this->kategori->save([
            'id_kategori' => $id,
            'nama_kategori_produk' => $this->request->getVar('nama_kategori'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Kategori berhasil diupdate!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/kategori-produk');
    }

    public function delete($id)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $this->kategori->delete($id);

        // pesan berhasil didelete
        $isipesan = '<script> alert("Data berhasil dihapus!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/kategori-produk');
    }
}
