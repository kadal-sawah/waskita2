<?php

defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';

$route['hardcopy'] = 'Hardcopy/index';
$route['penilaianperorangan/aktivitasdate/(:any)'] = 'penilaianperorangan/AktivitasDate/$1';
$route['penilaianperorangan/aktivitasdate/(:any)/(:any)'] = 'penilaianperorangan/AktivitasDate/$1/$2';

// Penilaian Perorangan
$route['penilaianperorangan/get'] = 'penilaianperorangan/get';
$route['penilaianperorangan/store'] = 'penilaianperorangan/store';
$route['penilaianperorangan/update'] = 'penilaianperorangan/update';
$route['penilaianperorangan/dokumen'] = 'penilaianperorangan/dokumen';

$route['penilaianperorangan/(:any)'] = 'penilaianperorangan/index/$1';

//Laporan begin

//laporan Prorangan
$route['laporanperorangan/get'] = 'laporanperorangan/get';
$route['laporanperorangan/getdetail'] = 'laporanperorangan/getdetail';
$route['laporanperorangan/(:any)'] = 'laporanperorangan/index/$1';

//laporan kelompok
$route['laporankelompok/get'] = 'Laporankelompok/get';
$route['laporankelompok/(:any)'] = 'Laporankelompok/index/$1';

//Laporan end

$route['penilaiankelompok/get/(:any)'] = 'penilaiankelompok/get/$1';
$route['penilaiankelompok/get'] = 'penilaiankelompok/get';
$route['penilaiankelompok/storeposko'] = 'penilaiankelompok/StorePosko';
$route['penilaiankelompok/getTeleponTelegram'] = 'penilaiankelompok/getTeleponTelegram';
$route['penilaiankelompok/storeteltelpon'] = 'penilaiankelompok/StoreTelTelpon';
$route['penilaiankelompok/storeakivitasasisten'] = 'penilaiankelompok/StoreAkivitasAsisten';
$route['penilaiankelompok/storeakivitaspanglimakas'] = 'penilaiankelompok/StoreAktivitasPanglimaKas';
$route['penilaiankelompok/dokumen'] = 'penilaiankelompok/dokumen';
$route['penilaiankelompok/ajaxaktivitas'] = 'penilaiankelompok/ajaxaktivitas';
$route['penilaiankelompok/ajaxposko'] = 'penilaiankelompok/ajaxposko';
$route['penilaiankelompok/ajaxproduk'] = 'penilaiankelompok/ajaxproduk';
// $route['penilaiankelompok/ajaxproduk2'] = 'penilaiankelompok/ajaxproduk2';
$route['penilaiankelompok/ajaxtipe'] = 'penilaiankelompok/ajaxtipe';
$route['penilaiankelompok/ajaxtel'] = 'penilaiankelompok/ajaxtel';
$route['penilaiankelompok/store'] = 'penilaiankelompok/store';
$route['penilaiankelompok/storetel'] = 'penilaiankelompok/storetel';
$route['penilaiankelompok/update'] = 'penilaiankelompok/update';
$route['penilaiankelompok/updatetel'] = 'penilaiankelompok/updatetel';
$route['penilaiankelompok/(:any)'] = 'penilaiankelompok/index/$1';

// Penilaian Kelompok
$route['penilai/soalkelompok/get'] = 'Penilaiankelompok/get';
$route['penilai/soalkelompok/store'] = 'Penilaiankelompok/store';
$route['penilai/soalkelompok/update'] = 'Penilaiankelompok/update';
$route['penilai/soalkelompok/(:any)'] = 'Penilaiankelompok/index/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;
