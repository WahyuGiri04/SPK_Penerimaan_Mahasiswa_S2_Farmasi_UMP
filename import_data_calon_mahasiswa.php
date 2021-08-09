<?php
include "root.php";

$sql = $koneksi->con->query("SELECT * FROM tb_pendaftaran ORDER BY id_pendaftaran DESC LIMIT 1");
$data_sql = $sql->fetch_assoc();
 $id_pendaftaran = $data_sql['id_pendaftaran'];
 "<br>";

$sql_1 = $koneksi->con->query("SELECT * FROM `fix_kriteria` ORDER BY fix_kriteria DESC LIMIT 1");
$data_sql_1 = $sql_1->fetch_assoc();
 $fix_kriteria = $data_sql_1['fix_kriteria'];
 "<br>";

$data_nilai_mahasiswa = ($_POST['data_calon_mahasiswa']);
$kode_kriteria = $_POST['kode'];
 $jumlah_kriteria = count($_POST['data_calon_mahasiswa']);
 "<br>";

 $no_mahasiswa = $_POST['no_mahasiswa'];
 $nama_mahasiswa = $_POST['nama_mahasiswa'];
 $jenis_kelamin = $_POST['jenis_kelamin'];
 $asal_ptn = $_POST['asal_ptn'];

$sql_2 = $koneksi->con->query("SELECT * FROM pv Where fix_pv = '$fix_kriteria' ORDER BY id_pv ASC");
while($data_sql_2 = $sql_2->fetch_array()){
    $pv[] = $data_sql_2['pv'];
}


 "<br>";

 $tanggal_pendaftaran = date('d-M-Y');

for($i=0; $i < $jumlah_kriteria; $i++){

    $insert_data = $koneksi->con->query("INSERT INTO data_mahasiswa SET id_pendaftaran = '$id_pendaftaran', no_mahasiswa = '$no_mahasiswa', nama_mahasiswa = '$nama_mahasiswa',jenis_kelamin = '$jenis_kelamin', asal_ptn = '$asal_ptn', nilai_kriteria = '$data_nilai_mahasiswa[$i]', kode_kriteria = '$kode_kriteria[$i]', fix_kriteria = '$fix_kriteria' ");

    $nilai_preferensi += $pv[$i] * $data_nilai_mahasiswa[$i];
     "<br>";

}

$nilai_preferensi;

$query_nilai_minimum = $koneksi->con->query("SELECT * FROM nilai_minimum_preferensi where fix_kriteria = '$fix_kriteria'");
$data_nilai_minimum = $query_nilai_minimum->fetch_assoc();
$nilai_minimum = $data_nilai_minimum['nilai_minimum'];

if($nilai_preferensi >= $nilai_minimum){
    $keterangan = 1 ;
}else{
    $keterangan = 2 ;
}

$query_insert_1 = $koneksi->con->query("INSERT INTO perangkingan set id_pendaftaran ='$id_pendaftaran', no_mahasiswa = '$no_mahasiswa', nama_mahasiswa = '$nama_mahasiswa', nilai_preferensi = '$nilai_preferensi', tanggal_pendaftaran = '$tanggal_pendaftaran',keterangan = '$keterangan' ");

if ($insert_data===true) {
    $koneksi->alert("Data Calon Mahasiswa Berhasil Di Tambahkan");
    $koneksi->redirect("detail_data_mahasiswa.php?no_mahasiswa=$no_mahasiswa");
}
else{
    $koneksi->alert("Data Calon Mahasiswa Gagal Di Tambahkan");
}

?>