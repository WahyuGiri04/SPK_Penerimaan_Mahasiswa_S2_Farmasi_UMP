<?php
include "root.php";
$id_mahasiswa = $_POST['id_mahasiswa'];
$no_mahasiswa = $_POST['no_mahasiswa'];
$id_pendaftaran = $_POST['id_pendaftaran'];
$nama_mahasiswa = $_POST['nama_mahasiswa'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$asal_ptn = $_POST['asal_ptn'];
$nilai_kriteria = $_POST['nilai_kriteria'];
$fix_kriteria = $_POST['fix_kriteria'];

$select = $koneksi->con->query("select count(id_mahasiswa) as jumlah from data_mahasiswa where no_mahasiswa = '$no_mahasiswa' ");
$data = $select->fetch_array();
$jumlah = $data['jumlah'];
$jumlah ;


$select1 = $koneksi->con->query("SELECT * FROM pv Where fix_pv = '$fix_kriteria' ORDER BY id_pv ASC");
while($data1 = $select1->fetch_array()){
    $pv[] = $data1['pv'];
}
$nilai_preferensi = 0 ;



for($i = 0 ; $i < $jumlah ; $i++){

    $sql = "update data_mahasiswa set nama_mahasiswa = '$nama_mahasiswa' ,jenis_kelamin = '$jenis_kelamin',asal_ptn = '$asal_ptn', nilai_kriteria = '".$nilai_kriteria[$i]."' where id_mahasiswa = '".$id_mahasiswa[$i]."' ";
    $query = $koneksi->con->query($sql);
    $nilai_preferensi += $pv[$i] * $nilai_kriteria[$i];
  
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

$sql2 = "UPDATE perangkingan set nama_mahasiswa = '$nama_mahasiswa', nilai_preferensi ='$nilai_preferensi',keterangan = '$keterangan' where no_mahasiswa = '$no_mahasiswa'";
$query2 = $koneksi->con->query($sql2);

if($query===true){
    echo "<script>alert('Data Berhasil DI UBAH');
          window.location.href='detail_data_mahasiswa.php?no_mahasiswa=$no_mahasiswa' </script>";
}

?>