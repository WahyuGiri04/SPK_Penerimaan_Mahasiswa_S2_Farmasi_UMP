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
                                            <h2>Ubah Nilai Matrix</h2>
                                            <br>
                                            <form action="handler.php?action=edit_matrix_pairwise" method="post" enctype="multipart/form-data">
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="bootstrap-select fm-cmp-mg">
                                                        <select required name="kode_banding" class="selectpicker">
                                                            <?php  
                                                            $query=$koneksi->con->query("select * from kriteria");
                                                            $no=1;
                                                            while ($data=$query->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?= $data['kode_kriteria'] ?>"><?= $data['kode_kriteria'] ?> (<?= $data['nama_ket_krit'] ?>) </option>
                                                            <?php
                                                            }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="bootstrap-select fm-cmp-mg">
                                                        <select required name="tingkat_kepentingan" class="selectpicker">
                                                            <option value="1" >Sama penting satu sama lain (1)</option>
                                                            <option value="2" >Lemah (2)</option>
                                                            <option value="3" >Agak penting  dibanding yang lain (3)</option>
                                                            <option value="4" >Moderat Plus (4)</option>
                                                            <option value="5" >Lebih penting dibanding yang lain (5)</option>
                                                            <option value="6" >Kuat (6)</option>
                                                            <option value="7" >Sangat penting dibanding yang lain (7)</option>
                                                            <option value="8" >Sangat Sangat Kuat (8)</option>
                                                            <option value="9" >Mutlak penting dibanding yang lain (9)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="bootstrap-select fm-cmp-mg">
                                                        <select required name="kode_pembanding" class="selectpicker">
                                                            <?php  
                                                            $query=$koneksi->con->query("select * from kriteria");
                                                            $no=1;
                                                            while ($data=$query->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?= $data['kode_kriteria'] ?>"><?= $data['kode_kriteria'] ?> (<?= $data['nama_ket_krit'] ?>) </option>
                                                            <?php
                                                            }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                    <div class="bootstrap-select fm-cmp-mg">
                                                        <br>
                                                        <button class="btn btn-danger notika-btn-danger"> <i class="fa fa-edit"></i> Ubah Nilai </button>
                                                    </div>
                                                </div>
                                            </form>
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
                        <div class="bsc-tbl">
                            <table class="table table-sc-ex">
                            <?php $tampil->tampil_pembobotan_kriteria();?> 
                            </table>
                            <br><br>
                            <a href="hasil_analisis.php" class="btn btn-warning notika-btn-warning" ><i class="fa fa-forward"></i> Analaisis AHP </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Normal Table area End-->
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
</body>

</html>