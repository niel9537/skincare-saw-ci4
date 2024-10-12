<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;

class Kriteria extends BaseController
{
    protected $kriteria;
    protected $subKriteria;

    public function __construct()
    {
        $this->kriteria = new KriteriaModel();
        $this->subKriteria = new SubKriteriaModel();
    }

    public function index()
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        // Kirim data ke view
        return view('Kriteria/index', [
            'title' => 'Data Kriteria',
            'kriteria' => $this->kriteria->findAll(),
        ]);
    }

    public function autoKode()
    {
        return json_encode($this->kriteria->generateCode());
    }

    public function tambah()
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        // session dipindahkan ke basecontroller
        $data = [
            'title' => 'Tambah Data Kriteria',
            'validation' => \Config\Services::validation()
        ];
        return view('kriteria/tambah', $data);
    }

    public function simpan()
    {
        // validasi input
        if (!$this->validate([
            'kriteria' => [
                // 'rules' => 'required|is_unique[kriteria.kriteria]',
                'errors' => [
                    'required' => 'kriteria {field} harus diisi!',
                    // 'is_unique' => 'kriteria {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/kriteria/simpan')->withInput()->with('validation', $validation);
        }

        $this->kriteria->save([
            'kode_kriteria' => $this->request->getVar('kode'),
            'kriteria' => $this->request->getVar('kriteria'),
            'type' => $this->request->getVar('type'),
            'bobot' => $this->request->getVar('bobot'),
            'ada_pilihan' => $this->request->getVar('adaPilihan'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Kriteria berhasil ditambahkan!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/kriteria');
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
            'title' => 'Edit Kriteria',
            'kriteria' => $this->kriteria->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('/kriteria/edit', $data);
    }

    public function update($id)
    {
        // validasi input
        if (!$this->validate([
            'alternatif' => [
                // 'rules' => 'required|is_unique[alternatif.alternatif]',
                'errors' => [
                    'required' => 'kriteria {field} harus diisi!',
                    // 'is_unique' => 'alternatif {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/kriteria/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->kriteria->save([
            'id_kriteria' => $id,
            'kode_kriteria' => $this->request->getVar('kode'),
            'kriteria' => $this->request->getVar('kriteria'),
            'type' => $this->request->getVar('type'),
            'bobot' => $this->request->getVar('bobot'),
            'ada_pilihan' => $this->request->getVar('adaPilihan'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Kriteria berhasil diupdate!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/kriteria');
    }

    public function delete($id)
    {
        // Pengecekan session login
        if (session()->get('login') != "login") {
            // Jika tidak ada session 'login', redirect ke halaman login dengan pesan error
            session()->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/admin/login');
        }

        $this->kriteria->delete($id);

        // pesan berhasil didelete
        $isipesan = '<script> alert("Data berhasil dihapus!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/kriteria');
    }

    // controller untuk sub kriteria
    public function indexSubKriteria()
    {
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

        // Kirim data ke view
        return view('SubKriteria/index', [
            'subkriteriaData' => $subkriteriaData,
            'title' => 'Data Sub Kriteria',
            'kriteria' => $this->kriteria->findAll(),
        ]);
    }

    public function tambahSubKriteria($id)
    {
        // session dipindahkan ke basecontroller
        $data = [
            'title' => 'Tambah Data Kriteria',
            'kriteria' => $this->kriteria->find($id),
            'validation' => \Config\Services::validation()
        ];
        return view('SubKriteria/tambah', $data);
    }

    public function simpanSubKriteria($id)
    {
        // validasi input
        if (!$this->validate([
            'kriteria' => [
                // 'rules' => 'required|is_unique[kriteria.kriteria]',
                'errors' => [
                    'required' => 'kriteria {field} harus diisi!',
                    // 'is_unique' => 'kriteria {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/kriteria/simpanSubKriteria/' . $id)->withInput()->with('validation', $validation);
        }

        $this->subKriteria->save([
            'id_kriteria' => $id,
            'sub_kriteria' => $this->request->getVar('subKriteria'),
            'nilai' => $this->request->getVar('nilai'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Sub kriteria berhasil ditambahkan!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/sub-kriteria');
    }

    public function editSubKriteria($id)
    {
        $idkriteria = $this->request->getVar('id_kriteria');
        $data = [
            'title' => 'Edit Kriteria',
            'subKriteria' => $this->subKriteria->find($id),
            'kriteria' => $this->kriteria->where('id_kriteria', $idkriteria)->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('SubKriteria/edit', $data);
    }

    public function updateSubKriteria($id)
    {
        // validasi input
        if (!$this->validate([
            'subKriteria' => [
                // 'rules' => 'required|is_unique[sub_kriteria.subKriteria]',
                'errors' => [
                    'required' => 'kriteria {field} harus diisi!',
                    // 'is_unique' => 'alternatif {field} sudah ada!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/admin/sub-kriteria/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->subKriteria->save([
            'id_sub_kriteria' => $id,
            'id_kriteria' => $this->request->getVar('idKriteria'),
            'sub_kriteria' => $this->request->getVar('subKriteria'),
            'nilai' => $this->request->getVar('nilai'),
        ]);

        // pesan data berhasil ditambah
        $isipesan = '<script> alert("Sub Kriteria berhasil diupdate!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/sub-kriteria');
    }

    public function deleteSubKriteria($id)
    {
        $this->subKriteria->delete($id);

        // pesan berhasil didelete
        $isipesan = '<script> alert("Data berhasil dihapus!") </script>';
        session()->setFlashdata('pesan', $isipesan);

        return redirect()->to('/admin/sub-kriteria');
    }
}
