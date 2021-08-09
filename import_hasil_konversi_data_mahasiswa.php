<?php
include "root.php";

        $id_pendaftaran = $_GET['id_pendaftaran'] ;
        $query_1 = $koneksi->con->query("SELECT * FROM fix_kriteria ORDER BY fix_kriteria DESC LIMIT 1");
		$data_1 = $query_1->fetch_assoc();
        $fix_kriteria = $data_1['fix_kriteria'];
        $query_4 = $koneksi->con->query("SELECT * FROM fix_kriteria where fix_kriteria ='$fix_kriteria'");
        $i = 0 ;
        while($data_4 = $query_4->fetch_assoc()){
            $kode_kriteteria = $data_4['kode_kriteria'];
            $query_2 = $koneksi->con->query("SELECT * FROM data_mahasiswa where id_pendaftaran = '$id_pendaftaran' and kode_kriteria = '$kode_kriteteria' order by kode_kriteria");
            while($data_2 = $query_2->fetch_assoc()){
                $nilai = $data_2['nilai_kriteria'];
                $kode = $data_2['kode_kriteria'];
                $nama = $data_2['nama_mahasiswa'];
                $jenis_kelamin = $data_2['jenis_kelamin'];
                $no_mahasiswa = $data_2['no_mahasiswa'];
                $asal_ptn = $data_2['asal_ptn'];
                $query_3 = $koneksi->con->query("SELECT * FROM range_penilaian where kode_kriteria = '$kode' and fix_kriteria ='$fix_kriteria' order by kode_kriteria");
                    while($data_3 = $query_3->fetch_assoc()){
                        $nilai_awal = $data_3['nilai_awal'];
                        $id_penilaian = $data_3['id_penilaian'];
                        $nilai_akhir = $data_3['nilai_akhir'];
                        if(($nilai_awal <= $nilai)&($nilai <= $nilai_akhir)){
                             $nilai_kriteria = $id_penilaian ;
                        }
                    }
                   
                $i++;
                $query_insert = $koneksi->con->query("INSERT into data_konversi_data_mahasiswa values('','$id_pendaftaran','$no_mahasiswa','$nama','$jenis_kelamin','$asal_ptn','$nilai_kriteria','$kode','$fix_kriteria')");
            }
        }

        $query_5 = $koneksi->con->query("SELECT * FROM `data_mahasiswa` WHERE id_pendaftaran='$id_pendaftaran' GROUP BY no_mahasiswa");
        while($data_5=$query_5->fetch_assoc()){
            $no_mahasiswa1 = $data_5['no_mahasiswa'];
            $nama_mahasiswa1 = $data_5['nama_mahasiswa'];
            $query_insert_1 = $koneksi->con->query("INSERT INTO perangkingan set id_pendaftaran ='$id_pendaftaran', no_mahasiswa = '$no_mahasiswa1', nama_mahasiswa = '$nama_mahasiswa1' ");
    
        }


        $q_jumlah_data = $koneksi->con->query("SELECT COUNT(id_mahasiswa) as jumlah FROM data_konversi_data_mahasiswa WHERE id_pendaftaran ='$id_pendaftaran'");
        $data_jumlah = $q_jumlah_data->fetch_assoc();
        $jumlah_data = $data_jumlah['jumlah'];

        $q_jumlah_data1 = $koneksi->con->query("SELECT COUNT(id_mahasiswa) as jumlah FROM data_mahasiswa WHERE id_pendaftaran ='$id_pendaftaran'");
        $data_jumlah1 = $q_jumlah_data1->fetch_assoc();
        $jumlah_data1 = $data_jumlah1['jumlah'];

		if ($jumlah_data=$jumlah_data1) {
            $koneksi->alert("Data Kriteria Berhasil Di Konvert");
            echo $jumlah_data1." / ".$jumlah_data;
			$koneksi->redirect("data_mahasiswa.php?id_pendaftaran=$id_pendaftaran");
		}
		else{
			$koneksi->alert("Data Kriteria Gagal Di Konver");
		}
?>