<?php
include "koneksi.php";
$no_mahasiswa = $_GET['no_mahasiswa'];

echo "<table border = 1 >";
$select1 = mysqli_query($koneksi, "select * from data_mahasiswa where no_mahasiswa = '$no_mahasiswa' ");
while($data1 =  mysqli_fetch_assoc($select1)){
    $kode_kriteria = $data1['kode_kriteria'];
    $fix_kriteria = $data1['fix_kriteria'];
    $nama_mahasiswa = $data1['nama_mahasiswa'];
    $jenis_kelamin = $data1['jenis_kelamin'];
    $asal_ptn = $data1['asal_ptn'];
    $nilai_kriteria = $data1['nilai_kriteria'];
    $id_mahasiswa = $data1['id_mahasiswa'];
    $id_pendaftaran = $data1['id_pendaftaran'];

    echo "<tr>";
    echo "<td>".$id_mahasiswa."</td>";
    echo "<td>".$no_mahasiswa."</td>";
    echo "<td>".$id_pendaftaran."</td>";
    echo "<td>".$nama_mahasiswa."</td>";
    echo "<td>".$jenis_kelamin."</td>";
    echo "<td>".$asal_ptn."</td>";
    echo "<td>".$nilai_kriteria."</td>";
    echo "<td>".$kode_kriteria."</td>";
    echo "</tr>";

    $sql = "update data_konversi_data_mahasiswa set nama_mahasiswa = '$nama_mahasiswa' ,jenis_kelamin = '$jenis_kelamin',asal_ptn = '$asal_ptn', nilai_kriteria = '".$nilai_kriteria."' where kode_kriteria = '".$kode_kriteria."' and no_mahasiswa = '$no_mahasiswa' ";
    $query = mysqli_query($koneksi,$sql);
}
echo "</table>";
if($query===true){
    echo "<script>alert('Data Berhasil DI KONVERT');
            window.location.href='data_mahasiswa.php?id_pendaftaran=$id_pendaftaran' </script>";
}
?>