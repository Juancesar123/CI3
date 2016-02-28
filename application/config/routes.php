<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login';
$route['login'] = 'Login';
$route['laman_muka'] = 'Laman_muka';
$route['Pengajuan%20Anggaran/Pengajuan%20Ter-ACC'] = 'Pengajuan_ter_acc';
$route['Pengawasan%20Anggaran/Konfirmasi'] = 'Konfirmasi';
$route['Pengawasan%20Anggaran/Notifikasi'] = 'Notifikasi';
$route['Adendum'] = 'adendum';
$route['Mutasi%20Anggaran'] = 'mutasi_anggaran';
#validasi login
$route['valid'] = 'Login/validasi_login';
$route['logout'] = 'Login/logout';

#route for manajemen pengguna
$route['Manajemen%20Pengguna'] = 'Manajemen_pengguna';
$route['Manajemen%20Pengguna/Tabel%20Manajemen%20Pengguna'] = 'Manajemen_pengguna/view_tabel_manajemen_pengguna';
$route['Manajemen%20Pengguna/Tabel%20Delete%20Manajemen%20Pengguna'] = 'Manajemen_pengguna/view_delete_tabel_manajemen_pengguna';
$route['Manajemen%20Pengguna/Tambah%20Data%20Action'] = 'Manajemen_pengguna/add';
$route['Manajemen%20Pengguna/Ubah%20Data%20Form'] = 'Manajemen_pengguna/edit_form';
$route['Manajemen%20Pengguna/Ubah%20Data%20Action'] = 'Manajemen_pengguna/edit';
$route['Manajemen%20Pengguna/Ubah%20Gambar%20Form'] = 'Manajemen_pengguna/edit_change_image_form';
$route['Manajemen%20Pengguna/Ubah%20Gambar%20Action'] = 'Manajemen_pengguna/edit_change_image';
$route['Manajemen%20Pengguna/Hapus%20Data%20Temporary%20Form'] = 'Manajemen_pengguna/delete_temporary_form';
$route['Manajemen%20Pengguna/Hapus%20Data%20Temporary%20Action'] = 'Manajemen_pengguna/delete_temporary';
$route['Manajemen%20Pengguna/Hapus%20Data%20Form'] = 'Manajemen_pengguna/delete_form';
$route['Manajemen%20Pengguna/Hapus%20Data%20Action'] = 'Manajemen_pengguna/delete';
$route['Manajemen%20Pengguna/Kembalikan%20Data%20Action'] = 'Manajemen_pengguna/restore';

#route for bagian
$route['Perencanaan%20Anggaran/Bagian'] = 'Bagian';
$route['Perencanaan%20Anggaran/Bagian/Tabel%20Bagian'] = 'Bagian/view_tabel_bagian';
$route['Perencanaan%20Anggaran/Bagian/Tambah%20Data%20Action'] = 'Bagian/add';
$route['Perencanaan%20Anggaran/Bagian/Ubah%20Data%20Form'] = 'Bagian/edit_form';
$route['Perencanaan%20Anggaran/Bagian/Ubah%20Data%20Action'] = 'Bagian/edit';
$route['Perencanaan%20Anggaran/Bagian/Hapus%20Data%20Form'] = 'Bagian/delete_form';
$route['Perencanaan%20Anggaran/Bagian/Hapus%20Data%20Action'] = 'Bagian/delete';

#route for Rencana perbagian
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian'] = 'Rencana_per_bagian';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tabel%20Rencana%20Perbagian'] = 'Rencana_per_bagian/view_tabel_rencana_per_bagian';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Detail%20Data%20Form'] = 'Rencana_per_bagian/detail_form';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Detail%20Data%20Form2'] = 'Rencana_per_bagian/detail_form_2';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Restore%20Data%20Form'] = 'Rencana_per_bagian/restore_form';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Restore%20Data%20Action'] = 'Rencana_per_bagian/restore';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tambah%20Data%20Form'] = 'Rencana_per_bagian/add_form';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tambah%20Data%20Action'] = 'Rencana_per_bagian/add';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Ubah%20Data%20Form'] = 'Rencana_per_bagian/edit_form';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Ubah%20Data%20Action'] = 'Rencana_per_bagian/edit';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Sementara%20Data%20Action'] = 'Rencana_per_bagian/delete_temporary';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Data%20Action'] = 'Rencana_per_bagian/delete';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Tambah%20Mata%20Anggaran%20Action'] = 'Rencana_per_bagian/add_mata_anggaran';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Ubah%20Mata%20Anggaran%20Form'] = 'Rencana_per_bagian/edit_mata_anggaran_form';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Ubah%20Mata%20Anggaran%20Action'] = 'Rencana_per_bagian/edit_mata_anggaran';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Mata%20Anggaran%20Form'] = 'Rencana_per_bagian/delete_mata_anggaran_form';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Mata%20Anggaran%20Action'] = 'Rencana_per_bagian/delete_mata_anggaran';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Hapus%20Sementara%20Mata%20Anggaran%20Action'] = 'Rencana_per_bagian/delete_temporary_mata_anggaran';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Restore%20Data%20Detail%20Form'] = 'Rencana_per_bagian/restore_detail_form';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Restore%20Data%20Detail%20Action'] = 'Rencana_per_bagian/restore_detail';
$route['Perencanaan%20Anggaran/Rencana%20Per%20Bagian/Upload%20Data%20Action'] = 'Rencana_per_bagian/upload';

#route for Pengajuan Anggaran Baru
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru'] = 'Pengajuan_baru';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tabel%20Pengajuan%20Baru'] = 'Pengajuan_baru/view_tabel_pengajuan_baru';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Action'] = 'Pengajuan_baru/upload';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tambah%20Data%20Action'] = 'Pengajuan_baru/add';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Form'] = 'Pengajuan_baru/edit_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Action'] = 'Pengajuan_baru/edit';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Form'] = 'Pengajuan_baru/delete_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Action'] = 'Pengajuan_baru/delete';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Detail%20Data%20Form'] = 'Pengajuan_baru/detail_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20File%20Pengajuan%20Action'] = 'Pengajuan_baru/upload_file_pengajuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20File%20Pengajuan%20Form'] = 'Pengajuan_baru/edit_file_pengajuan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20File%20Pengajuan%20Action'] = 'Pengajuan_baru/edit_file_pengajuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20File%20Pengajuan%20Form'] = 'Pengajuan_baru/delete_file_pengajuan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20File%20Pengajuan%20Action'] = 'Pengajuan_baru/delete_file_pengajuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Surat%20Pengajuan%20Action'] = 'Pengajuan_baru/upload_surat_pengajuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Surat%20Pengajuan%20Form'] = 'Pengajuan_baru/edit_surat_pengajuan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Surat%20Pengajuan%20Action'] = 'Pengajuan_baru/edit_surat_pengajuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Surat%20Pengajuan%20Form'] = 'Pengajuan_baru/delete_surat_pengajuan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Surat%20Pengajuan%20Action'] = 'Pengajuan_baru/delete_surat_pengajuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Surat%20Persetujuan%20Action'] = 'Pengajuan_baru/upload_surat_persetujuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Surat%20Persetujuan%20Form'] = 'Pengajuan_baru/edit_surat_persetujuan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Surat%20Persetujuan%20Action'] = 'Pengajuan_baru/edit_surat_persetujuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Surat%20Persetujuan%20Form'] = 'Pengajuan_baru/delete_surat_persetujuan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Surat%20Persetujuan%20Action'] = 'Pengajuan_baru/delete_surat_persetujuan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tambah%20Data%20Penerimaan%20Dana%20Action'] = 'Pengajuan_baru/add_penerimaan_dana';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Penerimaan%20Dana%20Form'] = 'Pengajuan_baru/edit_penerimaan_dana_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Penerimaan%20Dana%20Action'] = 'Pengajuan_baru/edit_penerimaan_dana';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Penerimaan%20Dana%20Form'] = 'Pengajuan_baru/delete_penerimaan_dana_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Penerimaan%20Dana%20Action'] = 'Pengajuan_baru/delete_penerimaan_dana';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Tambah%20Data%20Persetujuan%20Dekanat%20Action'] = 'Pengajuan_baru/add_persetujuan_dekanat';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Persetujuan%20Dekanat%20Form'] = 'Pengajuan_baru/edit_persetujuan_dekanat_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Persetujuan%20Dekanat%20Action'] = 'Pengajuan_baru/edit_persetujuan_dekanat';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Persetujuan%20Dekanat%20Form'] = 'Pengajuan_baru/delete_persetujuan_dekanat_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Persetujuan%20Dekanat%20Action'] = 'Pengajuan_baru/delete_persetujuan_dekanat';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Laporan%20Kegiatan%20Action'] = 'Pengajuan_baru/upload_laporan_kegiatan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Laporan%20Kegiatan%20Form'] = 'Pengajuan_baru/edit_laporan_kegiatan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Laporan%20Kegiatan%20Action'] = 'Pengajuan_baru/edit_laporan_kegiatan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Laporan%20Kegiatan%20Form'] = 'Pengajuan_baru/delete_laporan_kegiatan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Laporan%20Kegiatan%20Action'] = 'Pengajuan_baru/delete_laporan_kegiatan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Unggah%20Data%20Laporan%20Keuangan%20Action'] = 'Pengajuan_baru/upload_laporan_keuangan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Laporan%20Keuangan%20Form'] = 'Pengajuan_baru/edit_laporan_keuangan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Ubah%20Data%20Laporan%20Keuangan%20Action'] = 'Pengajuan_baru/edit_laporan_keuangan';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Laporan%20Keuangan%20Form'] = 'Pengajuan_baru/delete_laporan_keuangan_form';
$route['Pengajuan%20Anggaran/Pengajuan%20Anggaran%20Baru/Hapus%20Data%20Laporan%20Keuangan%20Action'] = 'Pengajuan_baru/delete_laporan_keuangan';

#route for laporan
$route['Pengawasan%20Anggaran/Laporan'] = 'Laporan';
$route['Pengawasan%20Anggaran/Laporan/Tabel%20Laporan'] = 'Laporan/view_tabel_laporan';
$route['Pengawasan%20Anggaran/Laporan/Detail%20Laporan'] = 'Laporan/view_detail_laporan';


#route for kasir
$route['Kasir'] = 'kasir';
$route['Kasir/Detail%20Tabel%20Kasir'] = 'kasir/detail_view_tabel_kasir';
$route['Kasir/Tabel%20Kasir'] = 'kasir/view_tabel_kasir_by_id';
$route['Kasir/Tambah%20Data%20Kasir%20Action'] = 'kasir/add';
$route['Kasir/Tambah%20Data%20Kasir%20Form'] = 'kasir/add_form';
$route['Kasir/Ubah%20Data%20Kasir%20Action'] = 'kasir/edit';
$route['Kasir/Ubah%20Data%20Kasir%20Form'] = 'kasir/edit_form';
$route['Kasir/Hapus%20Data%20Kasir%20Action'] = 'kasir/delete';
$route['Kasir/Hapus%20Data%20Kasir%20Form'] = 'kasir/delete_form';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
