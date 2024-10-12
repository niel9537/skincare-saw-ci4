<?php

namespace App\Controllers;

use App\Models\BrandModel;

class Brand extends BaseController
{
    protected $brand;

    public function __construct()
    {
        $this->brand = new BrandModel();
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
            'title' => 'Data Brand',
            'brand' => $this->brand->findAll() // Gunakan data brand berdasarkan periode
        ];
        return view('brand/index', $data);
    }

    public function autoKode()
    {
        return json_encode($this->brand->generateCode());
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
            'title' => 'Tambah Data Brand',
            'validation' => \Config\Services::validation()
        ];
        return view('brand/tambah', $data);
    }

    public function simpan()
    {
        // validasi input
        if (!$this->validate([
            'brand' => [
                // 'rules' => 'required|is_unique[nama_brand.brand]',
                'errors' => [
                    'required' => 'nama {field} harus diisi!',
                    // 'is_unique' => 'brand {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/brand/simpan')->withInput()->with('validation', $validation);
        }

        $this->brand->save([
            'kode_brand' => $this->request->getVar('kode'),
            'nama_brand' => $this->request->getVar('nama_brand'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Brand berhasil ditambahkan!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/brand');
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
            'title' => 'Edit Brand',
            'brand' => $this->brand->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('/brand/edit', $data);
    }

    public function update($id)
    {
        // validasi input
        if (!$this->validate([
            'brand' => [
                // 'rules' => 'required|is_unique[nama_brand.brand]',
                'errors' => [
                    'required' => 'nama {field} harus diisi!',
                    // 'is_unique' => 'brand {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/brand/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->brand->save([
            'id_brand' => $id,
            'kode_brand' => $this->request->getVar('kode'),
            'nama_brand' => $this->request->getVar('nama_brand'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Brand berhasil diupdate!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/brand');
    }

    public function delete($id)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $this->brand->delete($id);

        // pesan berhasil didelete
        $isipesan = '<script> alert("Data berhasil dihapus!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/brand');
    }
}
