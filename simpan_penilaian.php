<?php
include "koneksi.php";
$kode = $_POST['kode'];
$nama_kriteria = $_POST['nama_kriteria'];
$nilai_awal = $_POST['nilai_awal'];
$nilai_akhir = $_POST['nilai_akhir'];
$id_penilaian = $_POST['id_penilaian'];
$select = mysqli_query($koneksi, "select count(id_ket_krit) as jumlah from kriteria");
$data =  mysqli_fetch_assoc($select);
$jumlah = $data['jumlah'] * 5;
$select1 = mysqli_query($koneksi, "SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
$data1 =  mysqli_fetch_assoc($select1);
$fix_kriteria = $data1['fix_kriteria'] ;
for($i=0;$i<$jumlah;$i++){
    $sql	= "insert into range_penilaian set kode_kriteria = '".$kode[$i]."' ,nilai_awal = '".$nilai_awal[$i]."',id_penilaian = '".$id_penilaian[$i]."' ,nilai_akhir = '".$nilai_akhir[$i]."',fix_kriteria = '$fix_kriteria'";
    $query	= mysqli_query($koneksi,$sql);

    if($query===true){
        echo "<script>alert('Data Berhasil Ditambahkan');
				window.location.href='setting_nilai_preferensi.php' </script>";
    }
}


?>