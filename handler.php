<?php
include "root.php";

if (isset($_GET['action'])) {
	$action=$_GET['action'];
	if ($action=="login") {
		$koneksi->login($_POST['username'],$_POST['password'],$_POST['loginas']);
	}
	if ($action=="logout") {
		session_start();
		session_destroy();
		$koneksi->redirect("index.php");
	}
	if ($action=="tambah_kriteria"){
		$tambah->tambah_kriteria($_POST['kriteria'],$_POST['atribut']);
	}
	if ($action=="simpan_kriteria"){
		$tambah->simpan_kriteria();
		$tambah->simpan_bobot_kriteria();
	}
	if ($action=="tambah_pendaftaran") {
		$tambah->tambah_pendaftaran($_POST['tahun_pendaftaran'],$_POST['gelombang']);
	}
	if ($action=="hapus_kriteria") {
		$hapus->hapus_kriteria($_GET['id_ket_krit']);
	}
	if ($action=="edit_kriteria") {
		$edit->edit_kriteria($_POST['id_kriteria'],$_POST['kriteria'],$_POST['atribut']);
	}
	if ($action=="edit_matrix_pairwise") {
		$edit->edit_matrix_pairwise($_POST['kode_banding'],$_POST['kode_pembanding'],$_POST['tingkat_kepentingan']);
	}
	if ($action=="detail_mahasiswa") {
		$tampil->detail_mahasiswa($_POST['rowid']);
	}
	if ($action=="tambah_nilai_minimum_preferensi") {
		$tambah->tambah_nilai_minimum_preferensi($_POST['nilai_minimum_preferensi']);
	}
	if ($action=="simpan_hasil_perangkingan") {
		$tambah->simpan_hasil_perangkingan($_GET['id_pendaftaran']);
	}
	if ($action=="edit_pendaftaran") {
		$edit->edit_pendaftaran($_POST['tahun_pendaftaran'],$_POST['gelombang'],$_POST['id_pendaftaran']);
	}
	if ($action=="edit_password"){
		$edit->edit_password($_POST['id'],$_POST['username'],$_POST['password'],$_POST['konfir_password']);
	}
	if ($action=="ubah_keputusan"){
		$edit->ubah_keputusan($_GET['id_perangkingan']);
	}
	if ($action=="hapus_pendaftaran") {
		$hapus->hapus_pendaftaran($_GET['id_pendaftaran']);
	}
	if ($action=="hapus_mahasiswa") {
		$hapus->hapus_mahasiswa($_GET['no_mahasiswa'],$_GET['id_pendaftaran']);
	}
	
}
?>