<!doctype html>
<html class="no-js" lang="">
<?php include "root.php"; ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>SPK Farmasi S2</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- font awesome CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu/meanmenu.min.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- summernote CSS
		============================================ -->
    <link rel="stylesheet" href="css/summernote/summernote.css">
    <!-- Range Slider CSS
		============================================ -->
    <link rel="stylesheet" href="css/themesaller-forms.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- Notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/notika-custom-icon.css">
    <!-- bootstrap select CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap-select/bootstrap-select.css">
    <!-- datapicker CSS
		============================================ -->
    <link rel="stylesheet" href="css/datapicker/datepicker3.css">
    <!-- Color Picker CSS
		============================================ -->
    <link rel="stylesheet" href="css/color-picker/farbtastic.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/chosen/chosen.css">
    <!-- notification CSS
		============================================ -->
    <link rel="stylesheet" href="css/notification/notification.css">
    <!-- dropzone CSS
		============================================ -->
    <link rel="stylesheet" href="css/dropzone/dropzone.css">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="css/wave/waves.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <?php include "header.php"; ?>
    <?php include "menu.php"; ?>
    
    <!-- Form Examples area start-->
    <div class="form-example-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-example-wrap mg-t-30">
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
                        </form>
                        <img src = "images/foot.png" style="width: 100%; position: relative;">
                        <br>
                        <form action="data_mahasiswa.php?id_pendaftaran=<?php echo $data['id_pendaftaran'] ?>" method="post" enctype="multipart/form-data">
                          <div class="form-example-int mg-t-15">
                            <div class="row">
                              <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12">
                                </div>
                                  <div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
                                    <button class="btn btn-success notika-btn-success btn-lg"><i class="fa fa-backward"></i> Kembali</button>
                                    <a target="_blank" href="cetak_hasil_mahasiswa.php?no_mahasiswa=<?php echo $data['no_mahasiswa']; ?>" class="btn btn-danger notika-btn-danger btn-lg" ><i class="fa fa-print"></i> Cetak</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modals-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="modals-list mg-t-30">
                        <div class="modals-single">
                            <div class="modals-default-cl">
                                <div class="modal fade" id="myModol" role="dialog">
                                    <div class="modal-dialog modals-default nk-deep-purple">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                              <h2 align ="center">Hasil Analisis</h>
                                              <br>
                                              <br>
                                              <br>
                                              <br>
                                                <table align="center" style="width: 100%; position: relative;">
                                                  <tr>
                                                    <td align ="left"><h2>Point yang Diperoleh</h2></td>
                                                    <td style="width: 20%;"><h2> = </h2></td>
                                                    <td align ="left"><h2><?php echo $poin ?> </h2></td>
                                                  </tr>
                                                  <tr>
                                                    <td align ="left"><h2>Rekomendasi Keputusan</h2></td>
                                                    <td><h2> = </h2></td>
                                                    <td align ="left" ><h2><?php echo $keterangan ?> </h2></td>
                                                  </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Examples area End-->
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018 
. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Footer area-->
<!-- jquery
		============================================ -->
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="js/bootstrap.min.js"></script>
    <!-- wow JS
		============================================ -->
    <script src="js/wow.min.js"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="js/jquery-price-slider.js"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="js/meanmenu/jquery.meanmenu.js"></script>
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>
    <!-- flot JS
		============================================ -->
    <script src="js/flot/jquery.flot.js"></script>
    <script src="js/flot/jquery.flot.resize.js"></script>
    <script src="js/flot/flot-active.js"></script>
    <!-- knob JS
		============================================ -->
    <script src="js/knob/jquery.knob.js"></script>
    <script src="js/knob/jquery.appear.js"></script>
    <script src="js/knob/knob-active.js"></script>
    <!-- Input Mask JS
		============================================ -->
    <script src="js/jasny-bootstrap.min.js"></script>
    <!-- icheck JS
		============================================ -->
    <script src="js/icheck/icheck.min.js"></script>
    <script src="js/icheck/icheck-active.js"></script>
    <!-- rangle-slider JS
		============================================ -->
    <script src="js/rangle-slider/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/rangle-slider/jquery-ui-touch-punch.min.js"></script>
    <script src="js/rangle-slider/rangle-active.js"></script>
    <!-- datapicker JS
		============================================ -->
    <script src="js/datapicker/bootstrap-datepicker.js"></script>
    <script src="js/datapicker/datepicker-active.js"></script>
    <!-- bootstrap select JS
		============================================ -->
    <script src="js/bootstrap-select/bootstrap-select.js"></script>
    <!--  color-picker JS
		============================================ -->
    <script src="js/color-picker/farbtastic.min.js"></script>
    <script src="js/color-picker/color-picker.js"></script>
    <!--  notification JS
		============================================ -->
    <script src="js/notification/bootstrap-growl.min.js"></script>
    <script src="js/notification/notification-active.js"></script>
    <!--  summernote JS
		============================================ -->
    <script src="js/summernote/summernote-updated.min.js"></script>
    <script src="js/summernote/summernote-active.js"></script>
    <!-- dropzone JS
		============================================ -->
    <script src="js/dropzone/dropzone.js"></script>
    <!--  wave JS
		============================================ -->
    <script src="js/wave/waves.min.js"></script>
    <script src="js/wave/wave-active.js"></script>
    <!--  chosen JS
		============================================ -->
    <script src="js/chosen/chosen.jquery.js"></script>
    <!--  Chat JS
		============================================ -->
    <script src="js/chat/jquery.chat.js"></script>
    <!--  todo JS
		============================================ -->
    <script src="js/todo/jquery.todo.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>
	<!-- tawk chat JS
		============================================ -->
    <script src="js/tawk-chat.js"></script>
    <script>$('#myModol').modal('show');</script>
</body>

</html>