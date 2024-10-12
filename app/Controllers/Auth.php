<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Auth extends BaseController
{
    protected $user;
    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->user = new UsersModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('login', $data);
    }

    public function auth()
    {
        //ambil data dari form
        $data = $this->request->getPost();

        //ambil data user di database yang usernamenya sama 
        $user = $this->user->where('username', $data['username'])->first();

        if ($user) {
            // cek password, jika benar buat session dan arahkan ke halaman utama
            $authenticatePassword = password_verify($data['password'], $user['password']);
            // dd($authenticatePassword); // outputnya false
            if ($authenticatePassword) {
                $ses_data = [
                    'id_user' => $user['id_user'], // Harusnya mengambil dari $user bukan $data
                    'username' => $user['username'], // Ini juga, untuk memastikan data yang disimpan sesuai dengan yang ada di database
                    'nama' => $user['nama'], // Ini juga, untuk memastikan data yang disimpan sesuai dengan yang ada di database
                    'email' => $user['email'], // Ini juga, untuk memastikan data yang disimpan sesuai dengan yang ada di database
                    'role' => $user['role'], // Pastikan 'role' ini ada di tabel user Anda
                    'login' => TRUE
                ];
                $this->session->set($ses_data);
                return redirect()->to('/admin');
            } else {
                $this->session->setFlashdata('msg', 'Password salah');
                return redirect()->to('/admin/login');
            }
        } else {
            $this->session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to('/admin/login');
        }
    }

    public function logout()
    {
        $session = session();
        $this->session->destroy();
        return redirect()->to('/admin/login');
    }
}
