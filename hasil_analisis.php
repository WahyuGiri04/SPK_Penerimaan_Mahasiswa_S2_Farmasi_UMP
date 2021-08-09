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

    <!-- Normal Table area Start-->
    <div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-ctn">
                    <div class="basic-tb-hd">
                     <h2>Hasil Analisis</h2>
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
    <div class="normal-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list">
                        <div class="basic-tb-hd">
                            <h2>Pembobotan Matrix</h2>
                        </div>
                        <div class="bsc-tbl">
                            <table class="table table-sc-ex">
                                <?php $tampil->tampil_pembobotan_kriteria();?> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list mg-t-30">
                        <div class="basic-tb-hd">
                            <h2>Prioritas Vektor</h2>
                        </div>
                        <div class="bsc-tbl-bdr">
                        <table class="table">
                            <tr valign="top">
                                <td>
                                <table class="table table-bordered">
                                    <?php $tampil->tampil_hitung_prioritas_vektor();?> 
                                </table>
                                </td>
                                <td>
                                <table class="table table-bordered">
                                    <?php $tampil->tampil_hasil_prioritas_vektor();?> 
                                </table>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list mg-t-30">
                        <div class="basic-tb-hd">
                            <h2>Matrix Kosnistensi</h2>
                        </div>
                        <div class="bsc-tbl-cds">
                          <table border="0">
                            <tr>
                                <td>
                                <table class="table table-bordered">
                                  <?php $tampil->tampil_pembobotan_kriteria();?> 
                                </table>
                                </td>
                                <td valign="center" align="center"> x </td>
                                <td valign="top">
                                <table class="table table-bordered">
                                    <?php $tampil->tampil_hasil_prioritas_vektor();?> 
                                </table>
                                </td>
                                <td valign="center" align="center"> = </td>
                                <td valign="top">
                                <table class="table table-bordered">
                                    <?php $tampil->tampil_hasil_matrix_konsistensi();?> 
                                </table>
                                </td>
                            </tr>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list mg-t-30">
                        <div class="basic-tb-hd">
                            <h2>Eigen Max</h2>
                            <p><img src="images/rumus/rumus_eigen_max.png"></p>
                        </div>
                        <div class="bsc-tbl-st">
                            <table border="0" style="width: 50%; position: relative;"> 
                            <?php $tampil->eigen_max();?> 
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list mg-t-30">
                        <div class="basic-tb-hd">
                            <h2>Nilai Konsistensi</h2>
                            <p><img src="images/rumus/rumus_ci.png"></p>
                        </div>
                        <div class="bsc-tbl-bdr">
                          <br>
                            <table style="width: 20%; position: relative;">
                              <?php $tampil->ci();?> 
                            </table>
                            <br>
                            <h4>Tabel Consistensi Ratio</h4>
                            <br>
                            <table class="table table-bordered">
                              <tr>
                                <td><font size="3"><b>N</font></td>
                                <td><font size="3"><b>1</font></td>
                                <td><font size="3"><b>2</font></td>
                                <td><font size="3"><b>3</font></td>
                                <td><font size="3"><b>4</font></td>
                                <td><font size="3"><b>5</font></td>
                                <td><font size="3"><b>6</font></td>
                                <td><font size="3"><b>7</font></td>
                                <td><font size="3"><b>8</font></td>
                                <td><font size="3"><b>9</font></td>
                              </tr>
                              <tr>
                                <td><font size="3"><b>Random Consistensi Index (CI)</font></td>
                                <td><font size="3"><b>0</font></td>
                                <td><font size="3"><b>0</font></td>
                                <td><font size="3"><b>0,52</font></td>
                                <td><font size="3"><b>0,89</font></td>
                                <td><font size="3"><b>1,11</font></td>
                                <td><font size="3"><b>1,25</font></td>
                                <td><font size="3"><b>1,35</font></td>
                                <td><font size="3"><b>1,40</td>
                                <td><font size="3"><b>1,45</td>
                              </tr>
                            </table>
                            <br>
                            <table  style="width: 20%; position: relative;">
                              <tr>
                                <td rowspan="3"><font size="6">CR</font></td>
                                <td rowspan="3"><font size="6">=</font></td>
                                <td align="center"><font size="6" >CI</font></td>
                              </tr>
                              <tr>
                                <td valign="top"><hr size="1px" color="black" /></td>
                              </tr>
                              <tr>
                                <td align="center"><font size="6" >RI</font></td>
                              </tr>
                              <tr>
                                <td rowspan="3"><font size="6">CR</font></td>
                                <td rowspan="3"><font size="6">=</font></td>
                                <td align="center"><font size="6" ><?php $tampil->cr(); echo round($cr,4); ?> </font></td>
                              </tr>
                            </table>
                            <br>
                            <h2>Karena nilai CR ≤ 0,1 maka <b><?php $tampil->cr(); echo $keterangan ; ?></b> </h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="normal-table-list">
                        <div class="bsc-tbl">
                            <table>
                                <tr>
                                  <?php $tampil->cr(); echo $tombol ; ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Normal Table area End-->
    <div class="modals-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="modals-list mg-t-30">
                        <div class="modals-single">
                            <div class="modals-default-cl">
                                <div class="modal fade" id="myModalnine" role="dialog">
                                    <div class="modal-dialog modals-default nk-red">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <h2>Hasil Analisis</h2>
                                                <table align="center" style="width: 20%; position: relative;">
                                                  <tr>
                                                    <td rowspan="3"><h2>CR</h2></td>
                                                    <td rowspan="3"><h2> = </h2></td>
                                                    <td align="center"><h2><?php $tampil->cr(); echo round($cr,4); ?> </h2></td>
                                                  </tr>
                                                </table>
                                                <br>
                                                <h2>Karena nilai CR ≤ 0,1 maka <b><?php $tampil->cr(); echo $keterangan ; ?></b> </h2>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" href="setting_bobot.php" class="btn btn-default" ><i class='fa fa-backward'></i> Kembali ke Matrix Pairwise</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-info-circle'></i> Lihat Detail</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="myModalfourteen" role="dialog">
                                    <div class="modal-dialog modals-default nk-blue">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                              <h2>Hasil Analisis</h2>
                                                <table align="center" style="width: 20%; position: relative;">
                                                  <tr>
                                                    <td rowspan="3"><h2>CR</h2></td>
                                                    <td rowspan="3"><h2> = </h2></td>
                                                    <td align="center"><h2><?php $tampil->cr(); echo round($cr,4); ?> </h2></td>
                                                  </tr>
                                                </table>
                                                <br>
                                                <h2>Karena nilai CR ≤ 0,1 maka <b><?php $tampil->cr(); echo $keterangan ; ?></b> </h2>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" href="handler.php?action=simpan_kriteria" class="btn btn-default" ><i class='fa fa-save'></i> Simpan Data Kriteria</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-info-circle'></i> Lihat Detail</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="myModol" role="dialog">
                                    <div class="modal-dialog modals-default nk-deep-purple">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                              <h2>Hasil Analisis</h2>
                                                <table align="center" style="width: 20%; position: relative;">
                                                  <tr>
                                                    <td rowspan="3"><h2>CR</h2></td>
                                                    <td rowspan="3"><h2> = </h2></td>
                                                    <td align="center"><h2><?php $tampil->cr(); echo round($cr,4); ?> </h2></td>
                                                  </tr>
                                                </table>
                                                <br>
                                                <h2>Karena nilai CR ≤ 0,1 maka <b><?php $tampil->cr(); echo $keterangan ; ?></b> </h2>
                                            </div>
                                            <div class="modal-footer">
                                                <a type="button" href="setting_bobot.php" class="btn btn-default" ><i class='fa fa-save'></i> Simpan Data Kriteria</a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class='fa fa-info-circle'></i> Lihat Detail</button>
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
    <!-- Start Footer area-->
    <div class="footer-copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-copy-right">
                        <p>Copyright © 2018 . All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
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

    <?php $tampil->cr(); echo $script ; ?>

</body>

</html>