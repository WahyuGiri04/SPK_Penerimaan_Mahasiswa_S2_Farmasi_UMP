<?php 
session_start();
$id = $_SESSION['id'];
if (!isset($_SESSION['username'])) {
	$koneksi->redirect("index.php");
}
?>
<div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="#"><img src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"> <?php echo $_SESSION['username']; ?> <span><i class="fa fa-user"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd chat-dd animated zoomIn">
                                    <div class="hd-message-info">

                                        <a href="setting_akun.php">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">
                                                    <i class="fa fa-cogs"></i>
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>Seting Akun</h3>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="handler.php?action=logout">
                                            <div class="hd-message-sn">
                                                <div class="hd-message-img chat-img">
                                                    <i class="fa fa-sign-out"></i>
                                                </div>
                                                <div class="hd-mg-ctn">
                                                    <h3>Log Out</h3>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>