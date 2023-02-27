<?php
	include "functionku.php";
	if(cek_login()){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?=$config['app_name']?></title>
		<link rel="shortcut icon" type="image/x-icon" href="<?=$config['logo']?>">
		<link href="<?=resources('css/style_ori.css')?>" rel="stylesheet" />
		<link href="<?=resources('css/styles.css')?>" rel="stylesheet" />
		<link href="<?=resources('css/datatables.min.css')?>" rel="stylesheet" />
		<?php include 'opencss.php'; ?>
		<script src="<?=resources('js/all.js')?>" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="?page=dashboard">Mapin Apps</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li class="">
                            <a class="dropdown-item pt-4 pb-4"  href="?page=profile">
                            <img src="" alt="" class="fas fa-user fa-fw" style="width: 40px; height:40px;">
                            </a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="?page=profile">Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="?page=editprofile">Edit Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" onclick="return confirm_alert('Logout','Apakah anda ingin keluar?')" href="<?=process('logout')?>">Logout</a></li>
                    </ul>
                </li>
            </ul>    
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu p-2">
						<?php
							if(isset($_GET['page'])){
								$page = explode('_',$_GET['page']);
								$page = $page[0];
								if($page == 'bab'){
									$page = 'materi';
								}
							}else{
								$page = 'dashboard';
							}
						?>
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Utama</div>
                            <a class="nav-link <?=($page == 'dashboard' ? 'active' : '')?>" href="?page=dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-house"></i></div>Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
							<a class="nav-link <?=($page == 'mapel' ? 'active' : '')?>" href="?page=mapel">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-book"></i></div>Mata Pelajaran
                            </a>
                            <a class="nav-link <?=($page == 'materi' ? 'active' : '')?>" href="?page=materi">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-book-open"></i></div>Materi
                            </a>
                            <a class="nav-link <?=($page == 'quiz' ? 'active' : '')?>" href="?page=quiz">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-clipboard-question"></i></div>Quiz
                            </a>
                            <a class="nav-link <?=($page == 'promo' ? 'active' : '')?>" href="?page=promo">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-tags"></i></div>Promo
                            </a>
                            <a class="nav-link <?=($page == 'artikel' ? 'active' : '')?>" href="?page=artikel">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-receipt"></i></div>Artikel
                            </a>
                            <a class="nav-link <?=($page == 'user' ? 'active' : '')?>" href="?page=user">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-user"></i></div>User
                            </a>
                            <a class="nav-link <?=($page == 'history' ? 'active' : '')?>" href="?page=history">
                                <div class="sb-nav-link-icon"><i class="fas fa-solid fa-clock-rotate-left"></i></div>History
                            </a>

                            <div class="sb-sidenav-menu-heading">Lainnya</div>
                            <a class="nav-link <?=($page == 'charts' ? 'active' : '')?>" href="?page=charts">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Charts
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?=$_SESSION['user']['user_name']?>
                    </div>
                </nav>
            </div>
            <?php include 'openpage.php'; ?>
        </div>
		
		<div class="position-fixed top-0 end-0 p-3 mt-5" style="z-index: 11">
		  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
			<div id="message-type" class="toast-header">
			  <strong id="message-title" class="me-auto">Bootstrap</strong>
			  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
			</div>
			<div id="message-text" class="toast-body">
			  Hello, world! This is a toast message.
			</div>
		  </div>
		</div>
	
		<script src="<?=resources('js/bootstrap.bundle.min.js')?>" crossorigin="anonymous"></script>
		<script src="<?=resources('js/jquery-3.6.3.min.js')?>" crossorigin="anonymous"></script>
		<script src="<?=resources('js/sweetalert2.js')?>" crossorigin="anonymous"></script>
		<script src="<?=resources('js/datatables.min.js')?>" crossorigin="anonymous"></script>
		<script src="<?=resources('js/pdfmake.min.js')?>" crossorigin="anonymous"></script>
		<script src="<?=resources('js/vfs_fonts.js')?>" crossorigin="anonymous"></script>
		<?php include 'openjs.php'; ?>
		<script src="<?=resources('js/scripts.js')?>" crossorigin="anonymous"></script>
		<script>
			$( document ).ready(function() {
				$('.data-tables').DataTable();
				<?php
					$toast = get_flash('toast');
					if(!empty($toast)){
						echo 'toast_alert("'.$toast['title'].'","'.$toast['text'].'","'.$toast['type'].'")';
					}
				?>
			});
		</script>
    </body>
</html>
<?php
	}else{
		redirect(base_url('login.php'));
	}
?>