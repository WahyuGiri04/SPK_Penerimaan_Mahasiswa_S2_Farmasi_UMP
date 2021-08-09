
    <!-- Pengaturan menu dalam tanpilan PC-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li><a href="home.php"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <?php 
                        $query = $koneksi->con->query("select count(id_ket_krit) as jumlah from fix_kriteria");
                        $data = $query->fetch_assoc();
                        $jumlah = $data['jumlah'];
                        session_start(); 
                        i?>

                            <li><a data-toggle="tab" href="#kriteria"><i class="fa fa-tasks"></i> Kriteria</a>
                            </li>
                            <?php
                            if($jumlah > 0){?>
                                <li><a data-toggle="tab" href="#data_mahasiswa"><i class="fa fa-table"></i>Data Mahasiswa</a>
                                </li>
                            <?php
                            }else{

                            }
                            ?>
                            <li><a data-toggle="tab" href="#laporan"><i class="fa fa-book"></i> Laporan</a>
                            </li>

                    </ul>
                    <div class="tab-content custom-menu-content">
                        <div id="kriteria" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="fix_kriteria.php"><i class="fa fa-list"></i> Kriteria</a>
                                </li>
                                <li><a href="detail_analisis_ahp.php"><i class="fa fa-list-ol"></i> Detail Analisis Kriteria</a>
                                </li>
                            </ul>
                        </div>
                        <div id="data_mahasiswa" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="input_data_calon_mahasiswa.php"><i class="fa fa-upload"></i> Masukkan Data Calon Mahasiswa</a>
                                </li>
                                <li><a href="data_pendaftaran.php"><i class="fa fa-file"></i> Lihat Data Calon Mahasiswa</a>
                                </li>
                            </ul>
                        </div>
                        <div id="perangkingan" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="hasil_perangkingan.php"><i class="fa fa-archive"></i> Hasil Perangkingan</a>
                                </li>
                            </ul>
                        </div>
                        <div id="laporan" class="tab-pane notika-tab-menu-bg animated flipInX">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="laporan.php"><i class="fa fa-book"></i> Laporan dan Cetak</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->