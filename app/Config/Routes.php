<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Visitor::index');
$routes->get('/hasil-rekomendasi', 'Visitor::hasilRekomendasi');
$routes->post('/form-rekomendasi/add', 'Visitor::saveDataFormVisitor');

$routes->get('/admin', 'Dashboard::index');
// $routes->get('/dashboard', 'Dashboard::index');
$routes->get('/admin/dashboard/pieChart', 'Dashboard::pieChart');
$routes->get('/admin/dashboard/barChart/(:any)', 'Dashboard::barChart/$1');
$routes->get('/admin/dashboard/chart/periode/(:any)', 'Dashboard::index/$1');

// login
$routes->get('/admin/login', 'Auth::index');
$routes->post('/admin/login/auth', 'Auth::auth');
// logout
$routes->get('/admin/logout', 'Auth::logout');

// routes data users
$routes->get('/admin/users', 'Users::index');
$routes->get('/admin/profile-user', 'Users::profile');
$routes->get('/admin/users/tambah', 'Users::tambah');
$routes->get('/admin/users/simpan', 'Users::simpan');
$routes->post('/admin/users/simpan', 'Users::simpan');
$routes->get('/admin/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/admin/users/update/(:num)', 'Users::update/$1');
$routes->delete('/admin/users/hapus/(:num)', 'Users::delete/$1');

// routes data kriteria
$routes->get('/admin/visitor', 'Visitor::indexAdmin');

// routes data kriteria
$routes->get('/admin/kriteria', 'Kriteria::index');
$routes->get('/admin/kriteria/kode', 'Kriteria::autoKode');
$routes->get('/admin/kriteria/tambah', 'Kriteria::tambah');
$routes->post('/admin/kriteria/simpan', 'Kriteria::simpan');
$routes->get('/admin/kriteria/edit/(:num)', 'Kriteria::edit/$1');
$routes->post('/admin/kriteria/update/(:num)', 'Kriteria::update/$1');
$routes->delete('/admin/kriteria/hapus/(:num)', 'Kriteria::delete/$1');

// routes data sub kriteria
$routes->get('/admin/sub-kriteria', 'Kriteria::indexSubKriteria');
$routes->get('/admin/sub-kriteria/tambah/(:num)', 'Kriteria::tambahSubKriteria/$1');
$routes->post('/admin/sub-kriteria/simpan/(:num)', 'Kriteria::simpanSubKriteria/$1');
$routes->get('/admin/sub-kriteria/edit/(:num)', 'Kriteria::editSubKriteria/$1');
$routes->post('/admin/sub-kriteria/update/(:num)', 'Kriteria::updateSubKriteria/$1');
$routes->delete('/admin/sub-kriteria/hapus/(:num)', 'Kriteria::deleteSubKriteria/$1');

// routes data kategori produk
$routes->get('/admin/kategori-produk', 'KategoriProduk::index');
$routes->get('/admin/kategori-produk/tambah', 'KategoriProduk::tambah');
$routes->get('/admin/kategori-produk/kode', 'KategoriProduk::autoKode');
$routes->post('/admin/kategori-produk/simpan', 'KategoriProduk::simpan');
$routes->get('/admin/kategori-produk/edit/(:num)', 'KategoriProduk::edit/$1');
$routes->post('/admin/kategori-produk/update/(:num)', 'KategoriProduk::update/$1');
$routes->delete('/admin/kategori-produk/hapus/(:num)', 'KategoriProduk::delete/$1');

// routes data produk
$routes->get('/admin/produk', 'Alternatif::index');
$routes->get('/admin/produk/tambah', 'Alternatif::tambah');
$routes->get('/admin/produk/kode', 'Alternatif::autoKode');
$routes->post('/admin/produk/simpan', 'Alternatif::simpan');
$routes->get('/admin/produk/edit/(:num)', 'Alternatif::edit/$1');
$routes->post('/admin/produk/update/(:num)', 'Alternatif::update/$1');
$routes->delete('/admin/produk/hapus/(:num)', 'Alternatif::delete/$1');

// routes data brand
$routes->get('/admin/brand', 'Brand::index');
$routes->get('/admin/brand/tambah', 'Brand::tambah');
$routes->get('/admin/brand/kode', 'Brand::autoKode');
$routes->post('/admin/brand/simpan', 'Brand::simpan');
$routes->get('/admin/brand/edit/(:num)', 'Brand::edit/$1');
$routes->post('/admin/brand/update/(:num)', 'Brand::update/$1');
$routes->delete('/admin/brand/hapus/(:num)', 'Brand::delete/$1');

// route data penilaian
$routes->get('/admin/penilaian', 'Penilaian::index');
$routes->get('/admin/penilaian/produk/(:any)/(:any)', 'Penilaian::index/$1/$2');
$routes->get('/admin/penilaian/tambah/(:num)', 'Penilaian::tambah/$1');
$routes->post('/admin/penilaian/simpan/(:num)', 'Penilaian::simpan/$1');
$routes->get('/admin/penilaian/edit/(:num)', 'Penilaian::edit/$1');
$routes->post('/admin/penilaian/update/(:num)', 'Penilaian::update/$1');
$routes->delete('/admin/alternatif/hapus/(:num)', 'Alternatif::delete/$1');

// perhitungan
$routes->get('/admin/perhitungan', 'HitungMetode::index');
$routes->get('/admin/perhitungan/produk/(:any)/(:any)', 'HitungMetode::index/$1/$2');
$routes->post('/admin/perhitungan/simpan', 'HitungMetode::simpanData');

// route hasil
$routes->get('/admin/hasil', 'Hasil::index');
$routes->get('/admin/hasil/produk/(:any)/(:any)', 'Hasil::index/$1/$2');
$routes->get('/admin/hasil/cetak/produk/(:any)/(:any)', 'Hasil::cetak/$1/$2');
$routes->get('/admin/hasil/hapus/produk/(:any)/(:any)', 'Hasil::hapus/$1/$2');
