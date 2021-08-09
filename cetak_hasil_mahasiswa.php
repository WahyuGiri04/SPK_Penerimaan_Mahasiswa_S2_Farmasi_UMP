                    <?php include "root.php"; ?>
                    <?php 
                            $no_mahasiswa = $_GET['no_mahasiswa'];
                            $query=$koneksi->con->query("SELECT * FROM `data_mahasiswa` where no_mahasiswa='$no_mahasiswa'");
                            $data=$query->fetch_assoc(); 
                        ?>
                    <img src = "images/kop_surat.png" style="width: 100%; position: relative;">
                        <br><br><br><br><br>
                        <form method="post" enctype="multipart/form-data">
                          <h2 align="center">Hasil Analisis </h2>
                          <table style="width: 90%;" align="center">
                            <tr align="left">
                              <td style="width: 20%;" align="left" class="input-lg"><b>No Mahasiswa</b></td>
                              <td style="width: 1%;" align="left" class="input-lg"> : </td>
                              <td align="left" class="input-lg"> <?php echo $data['no_mahasiswa'] ?></td>
                            </tr>
                            <tr>
                              <td class="input-lg"><b>Nama Mahasiswa</b></td>
                              <td class="input-lg"> : </td>
                              <td class="input-lg"> <?php echo $data['nama_mahasiswa'] ?></td>
                            </tr>
                            <tr>
                              <td class="input-lg"><b>Jenis Kelamin</b></td>
                              <td class="input-lg"> : </td>
                              <td class="input-lg"> <?php echo $data['jenis_kelamin'] ?></td>
                            </tr>
                            <tr>
                              <td class="input-lg"><b>Asal PTN/PTS</b></td>
                              <td class="input-lg"> : </td>
                              <td class="input-lg"> <?php echo $data['asal_ptn'] ?></td>
                            </tr>
                          </table>
                          <br>
                          <table style="width: 90%;" align="center">
                            <tr align="left">
                              <td align="left" class="input-lg">Detail Analisis Perolehan Poin</td>
                            </tr>
                          </table>
                          <table style="width: 80%;" align="right">
                            <thead>
                              <td style="width: 30%;" align="left" class="input-lg"><b>Nama Kriteria</b></td>
                              <td align="left" class="input-lg"><b> Nilai x Bobot </b></td>
                              <td align="left" class="input-lg"><b>Hasil Point</b></td>
                            </thead>

                            <?php
                                $query1 = $koneksi->con->query("SELECT count(id_mahasiswa) as jumlah, fix_kriteria FROM `data_mahasiswa` where no_mahasiswa='$no_mahasiswa'");
                                $data1 = $query1->fetch_assoc();
                                $jumlah_data = $data1['jumlah'];
                                $fix_kriteria = $data1['fix_kriteria'];
                                $query4 = $koneksi->con->query("SELECT count(id_ket_krit) as jumlah FROM `fix_kriteria` where fix_kriteria = '$fix_kriteria' ");
                                $data4 = $query4->fetch_assoc();
                                $jumlah_kriteria = $data4['jumlah'];
                                
                                $query2 = $koneksi->con->query("SELECT * FROM `data_mahasiswa` where no_mahasiswa='$no_mahasiswa'");
                                while($data2=$query2->fetch_assoc()){
                                    $nilai_kriteria[] = $data2['nilai_kriteria'];
                                    $id_mahasiswa[] = $data2['id_mahasiswa'];
                                }
                                $query3 = $koneksi->con->query("SELECT * FROM `fix_kriteria` where fix_kriteria='$fix_kriteria' ");
                                while($data3=$query3->fetch_assoc()){
                                    $nama_kriteria[] = $data3['nama_ket_krit'];
                                    $kode_kriteria[] = $data3['kode_kriteria'];
                                }
                                $sql_2 = $koneksi->con->query("SELECT * FROM pv Where fix_pv = '$fix_kriteria' ORDER BY id_pv ASC");
                                while($data_sql_2 = $sql_2->fetch_array()){
                                    $pv[] = $data_sql_2['pv'];
                                }
                                for($i = 0; $i < $jumlah_data ; $i++){
                                    echo "<tr>";
                                    for($j = 0; $j < 1 ; $j++){
                                        $nama_krit[$i][$j] = $nama_kriteria[$i];
                                        $nilai_krit[$i][$j] = $nilai_kriteria[$i];
                                        $id_mhs[$i][$j] = $id_mahasiswa[$i];
                                        $bobot[$i][$j] = $pv[$i];
                                    ?>
                                    <tr>
                                      <td style="width: 30%;" align="left" class="input-lg"><?php echo $nama_krit[$i][$j]; ?></td>
                                      <td align="left" class="input-lg"><?php echo round($nilai_krit[$i][$j],2) ; ?> x <?php echo round(($bobot[$i][$j]),3) ; ?> </td>
                                      <td align="left" class="input-lg"><?php echo round(($bobot[$i][$j]*$nilai_krit[$i][$j]),2) ; ?> Point</td>
                                    </tr>
                                    <?php
                                    }
                                }
                                
                            ?>
                            <?php 
                            $sql_point = $koneksi->con->query("SELECT * FROM perangkingan WHERE no_mahasiswa = '$no_mahasiswa'"); 
                            $data_point = $sql_point->fetch_assoc();
                            $poin = $data_point['nilai_preferensi'];
                            $ket = $data_point['keterangan'];
                            if($ket==1){
                              $keterangan = "DITERIMA";
                            }else{
                              $keterangan = "DITOLAK";
                            }
                            ?>
                            <tr>
                              <td align="right" class="input-lg"><b>Jumlah</b></td>
                              <td>:</td>
                              <td align="left" class="input-lg"><?php echo round($poin,3); ?> Point</td>
                            <tr>
                          </table>
                          <br><br><br>
                          <table style="width: 90%;" align="center">
                            <tr align="left">
                              <td style="width: 30%;" align="left"><font size="5px"><b>Rekomendasi Keputusan</b></font></td>
                              <td style="width: 1%;" align="left" class="input-lg">:</td>
                              <td align="left"><font size="30px"><b><?php echo $keterangan; ?></b></font></td>
                            </tr>
                          </table>
                          
<script type="text/javascript"> 
  window.addEventListener("load", window.print());
</script>